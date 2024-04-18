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

    titlePlanejado: 'Planejado x Produzido ',
    titleTipoProd: 'Tipo de Produtos ',
    titleComparativo: 'Comparativo ',

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
    iconHeaderAguaKg: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>', 
    iconHeaderEnergia: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderEnergiaKg : '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderLenha: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderLenhaKg: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
     
    iconHeaderParadas: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderPerdas: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderPolpas: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderPolpasKg: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    chartPrevReal: null,
    loadingCharts: false,
    modalLoadingCharts: true,
    TotMeses: null,
    TotDias: 0,
    parametros: {
        valida: false,
        dti: null,
        dtf:  null,
        agrupamento: '',
        unidade: '',
        ano: '',
        mes: '',
        dia: '', 
    },
    parametrosXLS:{
      dt_comparativa_ano: null,
      dt_comparativa_dia: null,
      dt_comparativa_mes: null,
      dtf: null,
      dti: null
    },

    init() {

      $('#indicadores-parametros #parametro-ano').on('select2:select', () => {
        var Ano =$('#indicadores-parametros #parametro-ano').val();
        var Mes =$('#indicadores-parametros #parametro-mes').val();
        if(Ano){
          if(Mes){
            this.TotDias = this.TotMeses[Ano][Number(Mes)];
          }
        } 
      });
          
      $('#indicadores-parametros #parametro-mes').on('select2:select', () => { 
        var Ano =$('#indicadores-parametros #parametro-ano').val();
        var Mes =$('#indicadores-parametros #parametro-mes').val(); 
        if(Ano){
          if(Mes){
            this.TotDias = this.TotMeses[Ano][Number(Mes)]; 
          }
        }  
      });

 

      this.getDataChart1();
 
    },

  
    getDataChart1() { 

        this.iconHeaderProdTo = this.iconCarregando;
        this.iconHeaderProdKg = this.iconCarregando;
        this.iconHeaderProdCx = this.iconCarregando;
      
        this.iconHeaderAgua = this.iconCarregando;
        this.iconHeaderAguaKg = this.iconCarregando;
        
        this.iconHeaderEnergia = this.iconCarregando;
        this.iconHeaderEnergiaKg = this.iconCarregando;
        this.iconHeaderLenha = this.iconCarregando;
        this.iconHeaderLenhaKg = this.iconCarregando;
        
        this.iconHeaderParadas = this.iconCarregando;
        this.iconHeaderPerdas = this.iconCarregando;
        this.iconHeaderPolpas = this.iconCarregando;
        this.iconHeaderPolpasKg = this.iconCarregando;

        this.loadingCharts = true;
        this.parametros.dia = $('#parametro-dia').val();
        this.parametros.mes = $('#parametro-mes').val();
        this.parametros.ano = $('#parametro-ano').val();
        this.parametros.unidade = $('#parametro-visao').val();
        
        axios.post('/colonial/prod_prev_real-json',this.parametros)
            .then((res) => {
 
                this.parametrosXLS.dt_comparativa_ano= res.data.request.dt_comparativa_ano;
                this.parametrosXLS.dt_comparativa_mes= res.data.request.dt_comparativa_mes;
                this.parametrosXLS.dt_comparativa_dia= res.data.request.dt_comparativa_dia;
                this.parametrosXLS.dti= res.data.request.dti;
                this.parametrosXLS.dtf= res.data.request.dtf;

                this.titlePlanejado = 'Planejado x Produzido '+res.data.request.ds_unid;
                this.titleTipoProd = 'Tipo de Produtos '+res.data.request.ds_unid;
                this.titleComparativo = 'Comparativo '+res.data.request.ds_unid;

                this.chartPrevReal = null;
                this.parametros.dti = res.data.request.dti;
                this.parametros.dtf = res.data.request.dtf;
                this.iconHeaderAgua = res.data.request.hidrico+'<span class="headerUnidade"> (m³/h)</span>';
                this.iconHeaderAguaKg = res.data.request.AguaKg+'<span class="headerUnidade"> (m³/kg)</span>';
                this.iconHeaderEnergia = res.data.request.energia+'<span class="headerUnidade"> (Kw) </span>';
                this.iconHeaderEnergiaKg = res.data.request.EnergiaKg+'<span class="headerUnidade"> (Kw/kg) </span>';
                this.iconHeaderLenha = res.data.request.lenha+'<span class="headerUnidade"> (M3) </span>';
                this.iconHeaderLenhaKg = res.data.request.LenhaKg+'<span class="headerUnidade"> (m3/kg) </span>';
                this.iconHeaderPerdas = res.data.request.perda;
                this.iconHeaderParadas = res.data.request.perda+'<span class="headerUnidade"> (Min)</span>';
                this.iconHeaderPolpas = res.data.request.polpa+'<span class="headerUnidade"> (Kg) </span>';
                this.iconHeaderPolpasKg = res.data.request.PolpaKg+'<span class="headerUnidade"> (kg/kg) </span>';

                this.iconHeaderProdTo = res.data.request.ProduzidoTo+'<span class="headerUnidade"> (T) </span>';
                this.iconHeaderProdKg = res.data.request.ProduzidoKg+'<span class="headerUnidade"> (Kg) </span>';
                this.iconHeaderProdCx = res.data.request.ProduzidoCx+'<span class="headerUnidade"> (Cx) </span>';
 
                this.ProduzidoCx = res.data.request.ProduzidoCx;
                this.ProduzidoKg= res.data.request.ProduzidoKg;
                this.ProduzidoTo= res.data.request.ProduzidoTo;
                this.PlanejadoCx= res.data.request.PlanejadoCx;
                this.PlanejadoKg= res.data.request.PlanejadoKg;
                this.PlanejadoTo= res.data.request.PlanejadoTo;
                this.TotMeses = res.data.request.Meses;
                this.parametros.valida = true;
                $('#indicadores-parametros #parametro-ano').val(res.data.request.ano).trigger('change');
                $('#indicadores-parametros #parametro-mes').val(res.data.request.mes).trigger('change');
                if(res.data.request.ano){
                  if(res.data.request.mes){
                    this.TotDias = this.TotMeses[res.data.request.ano][Number(res.data.request.mes)];
                  }
                } 
                console.log(res.data);

                /* Grafico Planejado x Produzido */ 
                var chart = AmCharts.makeChart("chartdivPrevProd", {
                  "type": "serial",
                  "theme": "none",
                  "categoryField": "label",
                  "rotate": false,
                  "startDuration": 1,
                  "categoryAxis": {
                    "gridPosition": "start",
                    "position": "left",
                    "labelRotation": 20
                  },
                  "trendLines": [],
                  "graphs": [
                    {
                      "balloonText": "Planejado: <b>[[value]]</b>",
                      "fillAlphas": 0.8,
                      "id": "AmGraph-1",
                      "lineAlpha": 0.2,
                      "title": "planejado",
                      "labelText": "[[value]]",
                      "type": "column",
                      "valueField": "planejado",
                      "fillColorsField": "color_planejado", 
                
                    },
                    {
                      "balloonText": "Produzido: <b>[[value]]</b>",
                      "fillAlphas": 0.8,
                      "id": "AmGraph-2",
                      "lineAlpha": 0.2,
                      "title": "produzido",
                      "labelText": "[[value]]",
                      "type": "column",
                      "valueField": "produzido",
                      "fillColorsField": "color_produzido"
                    }
                  ],
                  "guides": [],
                  "valueAxes": [
                    {
                      "id": "ValueAxis-1",
                      "position": "top",
                      "axisAlpha": 0
                    }
                  ],
                  "allLabels": [],
                  "balloon": {},
                  "titles": [],
                  "dataProvider": res.data.previsto
                
                });
                    
                /* Grafico Produtos */ 
                var chart = AmCharts.makeChart("chartdivProdutos", {
                  "type": "serial",
                  "theme": "none",
                  "rotate": true, 
                  "dataProvider": res.data.produtos,
                 
                  "startDuration": 1,
                  "graphs": [{
                    "balloonText": "<b>[[category]]: [[value]]</b>",
                    "fillColorsField": "color",
                    "fillAlphas": 0.9,
                    "labelText": "[[value]]",
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "qtde"
                  }],
                  "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                  },
                  "categoryField": "produto",
                  "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 45
                  } 
                
                });

                /*Comparativo*/
                if(res.data.request.agrupamento=='D'){

                  var chart = AmCharts.makeChart("chartdiv_comparativo", {
                      "type": "serial",
                      "theme": "none",
                      "categoryField": "label",
                      "rotate": false,
                      "startDuration": 1,
                      "categoryAxis": {
                          "gridPosition": "start",
                          "position": "left",
                          "labelRotation": 20
                      },
                      "trendLines": [],
                      "graphs": [
                          {
                              "balloonText": "<b>[[label]]</b> <br> "+res.data.graficoAnos01+" : [[value]]",
                              "fillAlphas": 0.8,
                              "id": "AmGraph-1",
                              "lineAlpha": 0.2,
                              "title": res.data.graficoAnos01,
                              "labelText": "[[value]]",
                              "type": "column",
                              "valueField": "ano01",
                              "fillColorsField": "color01"
                          },
                          {
                              "balloonText": "<b>[[label]]</b> <br> "+res.data.graficoAnos02+" : [[value]]",
                              "fillAlphas": 0.8,
                              "id": "AmGraph-2",
                              "lineAlpha": 0.2,
                              "title": res.data.graficoAnos02,
                              "labelText": "[[value]]",
                              "type": "column",
                              "valueField": "ano02",
                              "fillColorsField": "color02", 

                          },
                          {
                              "balloonText": "<b>[[label]]</b> <br> "+res.data.graficoAnos03+" : [[value]]",
                              "fillAlphas": 0.8,
                              "id": "AmGraph-3",
                              "lineAlpha": 0.2,
                              "title": res.data.graficoAnos03,
                              "labelText": "[[value]]",
                              "type": "column",
                              "valueField": "ano03",
                              "fillColorsField": "color03"
                          }
                      ],
                      "guides": [],
                      "valueAxes": [
                          {
                              "id": "ValueAxis-1",
                              "position": "top",
                              "axisAlpha": 0
                          }
                      ],
                      "allLabels": [],
                      "balloon": {},
                      "titles": [],
                      "dataProvider":  res.data.ComparativoAno

                  });

                }else{

                   
                  var chart = AmCharts.makeChart("chartdiv_comparativo", {
                      "theme": "none",
                      "type": "serial",
                      "startDuration": 2,
                      "dataProvider": res.data.comparativo,
                        "graphs": [{
                            "balloonText": "[[category]]: <b>[[value]]</b>",
                            "fillColorsField": "color",
                            "fillAlphas": 1,
                            "lineAlpha": 0.1,
                            "type": "column",
                            "valueField": "visits"
                        }],
                      "depth3D": 20,
                      "angle": 30,
                        "chartCursor": {
                            "categoryBalloonEnabled": false,
                            "cursorAlpha": 0,
                            "zoomable": false
                        },
                        "categoryField": "country",
                        "categoryAxis": {
                            "gridPosition": "start",
                            "labelRotation": 30
                        }  
                  });
                
                }
                 
                /*Agua*/
                var chart = AmCharts.makeChart("chartdiv_agua", {
                  "theme": "none",
                  "type": "serial",
                  "startDuration": 2,
                  "dataProvider": res.data.GraficoAgua,
                  "graphs": [{
                      "balloonText": "[[category]]: <b>[[value]]</b>",
                      "colorField": "color",
                      "fillAlphas": 0.85,
                      "lineAlpha": 0.1,
                      "type": "column",
                      "topRadius":1,
                      "valueField": "visits"
                  }],
                  "depth3D": 40,
                  "angle": 30,
                  "chartCursor": {
                      "categoryBalloonEnabled": false,
                      "cursorAlpha": 0,
                      "zoomable": false
                  },
                  "categoryField": "country",
                  "categoryAxis": {
                      "gridPosition": "start",
                      "axisAlpha":0,
                      "gridAlpha":0

                  } 

                }, 0);

                /*Energia*/
                var chart = AmCharts.makeChart("chartdiv_energia", {
                  "theme": "none",
                  "type": "serial",
                  "startDuration": 2,
                  "dataProvider": res.data.GraficoEnergia,
                  "graphs": [{
                      "balloonText": "[[category]]: <b>[[value]]</b>",
                      "colorField": "color",
                      "fillAlphas": 0.85,
                      "lineAlpha": 0.1,
                      "type": "column",
                      "topRadius":1,
                      "valueField": "visits"
                  }],
                  "depth3D": 40,
                  "angle": 30,
                  "chartCursor": {
                      "categoryBalloonEnabled": false,
                      "cursorAlpha": 0,
                      "zoomable": false
                  },
                  "categoryField": "country",
                  "categoryAxis": {
                      "gridPosition": "start",
                      "axisAlpha":0,
                      "gridAlpha":0

                  } 

                }, 0);

                /*Lenha*/
                var chart = AmCharts.makeChart("chartdiv_lenha", {
                  "theme": "none",
                  "type": "serial",
                  "startDuration": 2,
                  "dataProvider": res.data.GraficoLenha,
                  "graphs": [{
                      "balloonText": "[[category]]: <b>[[value]]</b>",
                      "colorField": "color",
                      "fillAlphas": 0.85,
                      "lineAlpha": 0.1,
                      "type": "column",
                      "topRadius":1,
                      "valueField": "visits"
                  }],
                  "depth3D": 40,
                  "angle": 30,
                  "chartCursor": {
                      "categoryBalloonEnabled": false,
                      "cursorAlpha": 0,
                      "zoomable": false
                  },
                  "categoryField": "country",
                  "categoryAxis": {
                      "gridPosition": "start",
                      "axisAlpha":0,
                      "gridAlpha":0

                  } 

                }, 0);

                /*Polpa*/
                var chart = AmCharts.makeChart("chartdiv_polpa", {
                  "theme": "none",
                  "type": "serial",
                  "startDuration": 2,
                  "dataProvider": res.data.GraficoPolpa,
                  "graphs": [{
                      "balloonText": "[[category]]: <b>[[value]]</b>",
                      "colorField": "color",
                      "fillAlphas": 0.85,
                      "lineAlpha": 0.1,
                      "type": "column",
                      "topRadius":1,
                      "valueField": "visits"
                  }],
                  "depth3D": 40,
                  "angle": 30,
                  "chartCursor": {
                      "categoryBalloonEnabled": false,
                      "cursorAlpha": 0,
                      "zoomable": false
                  },
                  "categoryField": "country",
                  "categoryAxis": {
                      "gridPosition": "start",
                      "axisAlpha":0,
                      "gridAlpha":0

                  } 

                }, 0);
  
                /*Parada*/
                var chart = AmCharts.makeChart("chartdiv_parada", {
                  "theme": "none",
                  "type": "serial",
                  "startDuration": 2,
                  "dataProvider": res.data.GraficoParada,
                  "graphs": [{
                      "balloonText": "[[category]]: <b>[[value]]</b>",
                      "colorField": "color",
                      "fillAlphas": 0.85,
                      "lineAlpha": 0.1,
                      "type": "column",
                      "topRadius":1,
                      "valueField": "visits"
                  }],
                  "depth3D": 40,
                  "angle": 30,
                  "chartCursor": {
                      "categoryBalloonEnabled": false,
                      "cursorAlpha": 0,
                      "zoomable": false
                  },
                  "categoryField": "country",
                  "categoryAxis": {
                      "gridPosition": "start",
                      "axisAlpha":0,
                      "gridAlpha":0 
                  } 

                }, 0);

                /*TipoParada*/
                var chart = AmCharts.makeChart( "chartdiv_tp_parada", {
                  "type": "pie",
                  "theme": "none",
                  "dataProvider": res.data.GraficoTp_parada,
                  "valueField": "litres",
                  "titleField": "country",
                   "balloon":{
                   "fixedPosition":true
                  },
                  "labelRadius": 5, 
                  "marginTop": 0,
                  "marginBottom": 0,
                  "marginLeft": 0,
                  "marginRight": 0,
                } );

                /*Perda*/
                var chart = AmCharts.makeChart("chartdiv_perda", {
                  "theme": "none",
                  "type": "serial",
                  "startDuration": 2,
                  "dataProvider": res.data.GraficoPerda,
                  "graphs": [{
                      "balloonText": "[[category]]: <b>[[value]]</b>",
                      "colorField": "color",
                      "fillAlphas": 0.85,
                      "lineAlpha": 0.1,
                      "type": "column",
                      "topRadius":1,
                      "valueField": "visits"
                  }],
                  "depth3D": 40,
                  "angle": 30,
                  "chartCursor": {
                      "categoryBalloonEnabled": false,
                      "cursorAlpha": 0,
                      "zoomable": false
                  },
                  "categoryField": "country",
                  "categoryAxis": {
                      "gridPosition": "start",
                      "axisAlpha":0,
                      "gridAlpha":0 
                  } 

                }, 0);

                /*TipoPerda*/
                var chart = AmCharts.makeChart( "chartdiv_tp_perda", {
                  "type": "pie",
                  "theme": "none",
                  "dataProvider": res.data.GraficoTpPerda,
                  "valueField": "litres",
                  "titleField": "country",
                   "balloon":{
                   "fixedPosition":true
                  },
                  "labelRadius": 5, 
                  "marginTop": 0,
                  "marginBottom": 0,
                  "marginLeft": 0,
                  "marginRight": 0,
                } );
            })
            .catch((err) => { 
              console.log(err.response.data);
              toastr.error(err.response.data.errors,"Erro") 
            })
            .finally(() => this.loadingCharts = false);



    },
    xls(tipo){ 
      
      location.href = '/colonial/prod_prev_real-xls/'+tipo+'?dtf='+this.parametros.dtf+'&dti='+this.parametros.dti;
      toastr['success']('XLS gerado com sucesso');
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
