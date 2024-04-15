const chart1Ctx = document.querySelector('#chart-1');
const chart2Ctx = document.querySelector('#chart-2');
const chart3Ctx = document.querySelector('#chart-3');
const chart4Ctx = document.querySelector('#chart-4');
 
const chartPrevReal = document.querySelector('#chart-prev_realizado');
 

Alpine.data('app', () => ({
    chart1: null,
    chart2: null,
    chart3: null,
    chart4: null,
    relacaoDetelhes: null,
    tituloDetalhes: null,
    tabDetalhes: null, 
    iconCarregando: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    tabCarregando: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i>',

    ProduzidoCx: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i>',
    ProduzidoKg: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i>',
    ProduzidoTo: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i>',
    PlanejadoCx: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i>',
    PlanejadoKg: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i>',
    PlanejadoTo: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i>',
    
    iconHeaderProdTo: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderProdKg: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderProdCx: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    
    iconHeaderAgua: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderEnergia: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderLenha: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderParadas: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderPerdas: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderPolpas: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    chartPrevReal: null,
    loadingCharts: false,
    modalLoadingCharts: true,
    parametros: {
        dti: null,
        dtf:  null,
        agrupamento: '',
        unidade: '',
        ano: '',
        mes: '',
        dia: '',
    },

    init() {
          
        this.getDataChart1();
 
    },

  
    getDataChart1() { 
        this.loadingCharts = true;
        this.parametros.dia = $('#parametro-dia').val();
        this.parametros.mes = $('#parametro-mes').val();
        this.parametros.ano = $('#parametro-ano').val();
        this.parametros.unidade = $('#parametro-visao').val();
        
        axios.post('/colonial/prod_prev_real-json',this.parametros)
            .then((res) => {
                this.parametros.dti = res.data.request.dti;
                this.parametros.dtf = res.data.request.dtf;
                this.iconHeaderAgua = res.data.request.hidrico+'<span class="headerUnidade"> (m³/h)</span>';
                this.iconHeaderEnergia = res.data.request.energia+'<span class="headerUnidade"> (Kw) </span>';
                this.iconHeaderLenha = res.data.request.lenha+'<span class="headerUnidade"> (M3) </span>';
                this.iconHeaderPerdas = res.data.request.perda;
                this.iconHeaderParadas = res.data.request.perda+'<span class="headerUnidade"> (Min)</span>';
                this.iconHeaderPolpas = res.data.request.polpa+'<span class="headerUnidade"> (Kg) </span>';

                this.iconHeaderProdTo = res.data.request.ProduzidoTo+'<span class="headerUnidade"> (T) </span>';
                this.iconHeaderProdKg = res.data.request.ProduzidoKg+'<span class="headerUnidade"> (Kg) </span>';
                this.iconHeaderProdCx = res.data.request.ProduzidoCx+'<span class="headerUnidade"> (Cx) </span>';

                this.ProduzidoCx = res.data.request.ProduzidoCx;
                this.ProduzidoKg= res.data.request.ProduzidoKg;
                this.ProduzidoTo= res.data.request.ProduzidoTo;
                this.PlanejadoCx= res.data.request.PlanejadoCx;
                this.PlanejadoKg= res.data.request.PlanejadoKg;
                this.PlanejadoTo= res.data.request.PlanejadoTo;

                console.log(res.data);

                /* Grafico Planejado x Produzido */ 
                am5.ready(function() {  
                      var root = am5.Root.new("chartdivPrevProd"); 
                        root.setThemes([
                        am5themes_Animated.new(root)
                      ]); 
                      var chart = root.container.children.push(am5xy.XYChart.new(root, {
                        panX: false,
                        panY: false,
                        paddingLeft: 0,
                        /*
                        wheelX: "panX",
                        wheelY: "zoomX",
                        */
                        layout: root.verticalLayout
                  
                      })); 
                      var legend = chart.children.push(
                        am5.Legend.new(root, {
                            centerX: am5.p50,
                            x: am5.p50
                        })
                      );
                      
                      // Data
                      var colors = chart.get("colors");

                      var data = res.data.previsto
               
                      var xRenderer = am5xy.AxisRendererX.new(root, {
                        cellStartLocation: 0.1,
                        cellEndLocation: 0.9,
                        minorGridEnabled: true
                      })
                  
                      var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                        categoryField: "year",
                        renderer: xRenderer,
                        tooltip: am5.Tooltip.new(root, {})
                      }));
                  
                      xRenderer.grid.template.setAll({
                      location: 1
                      })
                  
                      xAxis.data.setAll(data);
                      
                      var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                        renderer: am5xy.AxisRendererY.new(root, {
                            strokeOpacity: 0.1
                        })
                      }));
               
                      function makeSeries(name, fieldName, total,color) {

                            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                name: name,
                                xAxis: xAxis,
                                yAxis: yAxis,
                                valueYField: fieldName,
                                categoryXField: "year"
                            }));
                      
                            series.columns.template.setAll({
                                tooltipText: "{name} em {categoryX}\n{valueY}",
                                width: am5.percent(90),
                                tooltipY: 0,
                                strokeOpacity: 0 
                            });
                            series.set("fill", am5.color(color));
                            series.data.setAll(data); 
                            series.appear();
                        
                            series.bullets.push(function () {
                                return am5.Bullet.new(root, {
                                locationY: 0,
                                sprite: am5.Label.new(root, {
                                    text: "{valueY}",
                                    fill: root.interfaceColors.get("alternativeText"),
                                    centerY: 50,
                                    centerX: am5.p50,
                                    populateText: true
                                })
                                });
                            });
                      
                            /*Onclick*/
                            series.columns.template.events.on("click", function(ev) {
                                console.log("Clicked on a column", ev.target);
                            });
                      
                            legend.data.push(series);
                          
                            if (total) {
                                series.bullets.push(function() {
                                var totalLabel = am5.Label.new(root, {
                                    
                                    centerY: am5.p100,
                                    centerX: am5.p50,
                                    populateText: true,
                                    textAlign: "center"
                                });
                            
                            
                                return am5.Bullet.new(root, {
                                    locationX: 0.5,
                                    locationY: 0.9,
                                    sprite: totalLabel
                                });
                                });
                            }
                      }
            
                      makeSeries("Planejado", "europe",true,"#008000");
                      makeSeries("Produzido", "namerica",true,"#EF4836"); 
                    
                      chart.appear(1000, 100);
          
                });   
                    
                /* Grafico Produtos */ 
                am5.ready(function() {
                             
                    var allData = { 
                      "PRODUTO": res.data.produtos
                    };
                   
                    var root = am5.Root.new("chartdivProdutos");
                    
                    root.numberFormatter.setAll({
                      numberFormat: "#a",
                     
                      bigNumberPrefixes: [
                        { number: 1e6, suffix: "M" },
                        { number: 1e9, suffix: "B" }
                      ],
                     
                      smallNumberPrefixes: []
                    });
                  
                    var stepDuration = 2000;
                    
                    root.setThemes([am5themes_Animated.new(root)]);
                      
                    var chart = root.container.children.push(am5xy.XYChart.new(root, {
                      panX: true,
                      panY: true,
                      wheelX: "none",
                      wheelY: "none",
                      paddingLeft: 0
                    }));
                    
                    chart.zoomOutButton.set("forceHidden", true);
                      
                    var yRenderer = am5xy.AxisRendererY.new(root, {
                      minGridDistance: 20,
                      inversed: true,
                      minorGridEnabled: true
                    });
                    
                    yRenderer.grid.template.set("visible", false);
                    
                    var yAxis = chart.yAxes.push(am5xy.CategoryAxis.new(root, {
                      maxDeviation: 0,
                      categoryField: "network",
                      renderer: yRenderer
                    }));
                  
                    var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
                      maxDeviation: 0,
                      min: 0,
                      strictMinMax: true,
                      extraMax: 0.1,
                      renderer: am5xy.AxisRendererX.new(root, {})
                    }));
                  
                    xAxis.set("interpolationDuration", stepDuration / 10);
                    xAxis.set("interpolationEasing", am5.ease.linear);
                     
                    var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                      xAxis: xAxis,
                      yAxis: yAxis,
                      valueXField: "value",
                      categoryYField: "network"
                    }));
                     
                    series.columns.template.setAll({ cornerRadiusBR: 5, cornerRadiusTR: 5 });
                     
                    series.columns.template.adapters.add("fill", function (fill, target) {   
                      return gera_cor();
                    });
                    
                    series.columns.template.adapters.add("stroke", function (stroke, target) {
                      return '#ffffff';
                    });

                    function gera_cor(){
                      var hexadecimais = '0123456789ABCDEF';
                      var cor = '#'; 
                      // Pega um número aleatório no array acima
                      for (var i = 0; i < 6; i++ ) {
                      //E concatena à variável cor
                          cor += hexadecimais[Math.floor(Math.random() * 16)];
                      }
                      return cor;
                  }
                     
                    series.columns.template.setAll({
                        tooltipText: "{network} :  {value}",
                        width: am5.percent(95),
                        tooltipY: 0
                    });
                    
                    series.bullets.push(function () {
                      return am5.Bullet.new(root, {
                        locationX: 1,
                        sprite: am5.Label.new(root, {
                          text: "{valueXWorking.formatNumber('#.# a')}",
                          fill: root.interfaceColors.get("alternativeText"),
                          centerX: am5.p100,
                          centerY: am5.p50,
                          populateText: true
                        })
                      });
                    });
                  
              
                    function getSeriesItem(category) {
                      for (var i = 0; i < series.dataItems.length; i++) {
                        var dataItem = series.dataItems[i];
                        if (dataItem.get("categoryY") == category) {
                          return dataItem;
                        }
                      }
                    }
                   
                    function sortCategoryAxis() {
                      // sort by value
                      series.dataItems.sort(function (x, y) {
                        return y.get("valueX") - x.get("valueX"); // descending 
                      });
                     
                      am5.array.each(yAxis.dataItems, function (dataItem) { 
                        var seriesDataItem = getSeriesItem(dataItem.get("category"));
                    
                        if (seriesDataItem) { 
                          var index = series.dataItems.indexOf(seriesDataItem); 
                          var deltaPosition =
                            (index - dataItem.get("index", 0)) / series.dataItems.length; 
                          if (dataItem.get("index") != index) {
                            dataItem.set("index", index); 
                            dataItem.set("deltaPosition", -deltaPosition); 
                            dataItem.animate({
                              key: "deltaPosition",
                              to: 0,
                              duration: stepDuration / 2,
                              easing: am5.ease.out(am5.ease.cubic)
                            });
                          }
                        }
                      }); 
                      yAxis.dataItems.sort(function (x, y) {
                        return x.get("index") - y.get("index");
                      });
                    }
                    
                    var year = 'PRODUTO';
                   
                    var sortInterval = setInterval(function () {
                      sortCategoryAxis();
                    }, 100);
                    
                    function setInitialData() {
                      var d = allData[year]; 
                      for (var n in d) {
                        series.data.push({ network: n, value: d[n] });
                        yAxis.data.push({ network: n });
                      }
                    }
                   
                    setInitialData();
                    setTimeout(function () {
                      year++;
                      updateData();
                    }, 50);
                   
                    series.appear(3000);
                    chart.appear(3000, 100);
                  
                }); // end am5.ready()
  
            })
            .catch((err) => { toastr.error("error",err) })
            .finally(() => this.loadingCharts = false);



    },

    getDataChartDetalhes(dados) { 

      $("#modalDetalhes").modal(); 
      this.modalLoadingCharts = true;
      $('#chartDetalhe').html(); 
      axios.post('/colonial/prod_prev_real-detalhes',dados)
      .then((res) => { 
          console.log(res);
          this.relacaoDetelhes = res.data.relacao;
          this.tituloDetalhes = res.data.titulo;
          this.tabDetalhes = res.data.tab;

          var chart = AmCharts.makeChart("chartDetalhe", {
              "type": "serial",
              "theme": "none",
              "marginRight": 0,
              "marginLeft": 0,
              "dataProvider": res.data.dias,
              "startDuration": 1,
              "titles": [{
                "text": res.data.grafico_titulo
              }, 
              {
                  "text":res.data.data_titulo,
                  "bold": false
              }],
              "graphs": [{
                "balloonText": "<b>[[category]]: [[value]]</b>",
                "fillColorsField": "color",
                "fillAlphas": 0.9,
                "lineAlpha": 0.2,
                "labelText": "[[value]]",
                "type": "column",
                "valueField": "visits"
              },{
                "balloonText": "Previsto : [[value]]",
                "bullet": "round", 
                "bulletBorderAlpha": 1, 
                "bulletSize": 8,
                "hideBulletsCount": 80,
                "lineThickness": 3,
                "useLineColorForBulletBorder": true,
                "bulletColor": "#FFFFFF",
                "bulletSizeField": "townSize",
                "dashLengthField": "dashLength",
                "lineColor": "#ed7d31",
                "descriptionField": "townName",
                "labelPosition": "right",
                "labelText": "[[townName2]]",
                "legendValueText": "[[value]]/[[description]]",
                "title": "latitude/city",
                "fillAlphas": 0,
                "valueField": "latitude",
                "valueAxis": "latitudeAxis" 
            } ],
              "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
              },
              "categoryField": "country",
              "categoryAxis": {
                "gridPosition": "start",
                "labelRotation": 25
              } 

            }); 
      })
      .catch((err) => { toastr.error("error",err) })
      .finally(() => this.modalLoadingCharts = false); 

    },
    
    formatTextLabel(value){
      const formatNumber = new Intl.NumberFormat()
      value = value.toString(); 
      return formatNumber.format(value);
      return value.toLocaleString('pt-br', {minimumFractionDigits: 2});
      var pattern = /(-?\d+)(\d{3})/;
      while (pattern.test(value))
          value = value.replace(pattern, "$1,$2");
      return value;
    }

}));
