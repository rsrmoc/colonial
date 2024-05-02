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
    totais_toDetalhes: null,
    tituloDetalhesModal: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i>', 
    hidricoDetalhes: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i>', 
    energiaDetalhes: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i>',
    lenhaDetalhes: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i>',
    perdaDetalhes: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i>', 
    paradaDetalhes: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i>',
    polpaDetalhes: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i>',
    produzido_cxDetalhes: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i>', 
    produzido_kgDetalhes: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i>', 
    produzido_toDetalhes: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i>',
    tabProdDetalhes:null,
    tabPerdaDetalhes:null,
    tabParadaDetalhes:null,
    tabDetalhes: null, 
    graficoBarra: "<div style='text-align: center;margin-top: 150px;'> <img src='/assets/images/grafico-barra.png'> </div>",
    graficoBarra2: "<div style='text-align: center;margin-top: 25px;'> <img src='/assets/images/grafico-barra.png'> </div>",
    graficoPizza: "<div style='text-align: center;margin-top: 150px;'> <img src='/assets/images/grafico-pizza.png'> </div>",
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
    ProduzidoCxPerc: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i>',
    ProduzidoKgPerc: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i>',
    ProduzidoToPerc: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i>',
    
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
    
    iconHeaderPerdasEmb: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderPerdasPol: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderPerdasIns: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderPerdasOut: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
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
                this.iconHeaderParadas = res.data.request.parada+'<span class="headerUnidade"> (Min)</span>';
                this.iconHeaderPolpas = res.data.request.polpa+'<span class="headerUnidade"> (Kg) </span>';
                this.iconHeaderPolpasKg = res.data.request.PolpaKg+'<span class="headerUnidade"> (kg/kg) </span>';

                this.iconHeaderProdTo = res.data.request.ProduzidoTo+'<span class="headerUnidade"> (T) </span>';
                this.iconHeaderProdKg = res.data.request.ProduzidoKg+'<span class="headerUnidade"> (Kg) </span>';
                this.iconHeaderProdCx = res.data.request.ProduzidoCx+'<span class="headerUnidade"> (Cx) </span>';
                this.iconHeaderPerdasEmb = res.data.request.embalagens;
                this.iconHeaderPerdasPol = res.data.request.polpas;
                this.iconHeaderPerdasIns = res.data.request.insumos;
                this.iconHeaderPerdasOut = res.data.request.outros;

 
                this.ProduzidoCx = res.data.request.ProduzidoCx;
                this.ProduzidoKg= res.data.request.ProduzidoKg;
                this.ProduzidoTo= res.data.request.ProduzidoTo;
                this.PlanejadoCx= res.data.request.PlanejadoCx;
                this.PlanejadoKg= res.data.request.PlanejadoKg;
                this.PlanejadoTo= res.data.request.PlanejadoTo;
                
                this.ProduzidoCxPerc= res.data.request.ProduzidoCxPerc+'%';
                this.ProduzidoKgPerc= res.data.request.ProduzidoKgPerc+'%';
                this.ProduzidoToPerc= res.data.request.ProduzidoToPerc+'%';

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
                  "decimalSeparator": ",",
                  "thousandsSeparator": ".",
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
                  "titles": [{
                    "text": "Traffic incidents per year",
                    "size": 15
                  }],
                  "legend": {
                    "align": "center",
                    "useGraphSettings": true,
                    "equalWidths": false, 
                    "valueAlign": "left",
                    "valueText": "[[value]] ([[percents]]%)",
                    "valueWidth": 100
                },
                  "trendLines": [],
                  "graphs": [
                    {
                      "balloonText": "Planejado: <b>[[value]] ("+res.data.request.ds_unidade+") </b>",
                      "fillAlphas": 0.8,
                      "id": "AmGraph-1",
                      "lineAlpha": 0.2,
                      "title": "Planejado",
                      "labelText": "[[value]]",
                      "type": "column",
                      "valueField": "planejado",
                      "fillColorsField": "color_planejado", 
                      "lineColor": "#008000",
                
                    },
                    {
                      "balloonText": "Produzido: <b>[[value]] ("+res.data.request.ds_unidade+")</b>",
                      "fillAlphas": 0.8,
                      "id": "AmGraph-2",
                      "lineAlpha": 0.2,
                      "title": "Produzido",
                      "labelText": "[[value]]",
                      "type": "column",
                      "valueField": "produzido",
                      "fillColorsField": "color_produzido",
                      "lineColor": "#FF0F00",
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
                if(!res.data.previsto){
                  $("#chartdivPrevProd").html(this.graficoBarra);
                }
                
                /* Grafico Porcentagem Produzida */ 
                var chart = AmCharts.makeChart("chartdivPercProd", {
                  "decimalSeparator": ",",
                  "thousandsSeparator": ".",
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
                  "legend": {
                    "align": "center",
                    "useGraphSettings": true,
                    "equalWidths": false, 
                    "valueAlign": "left",
                    "valueText": "[[value]] ([[percents]]%)",
                    "valueWidth": 100
                  },
                  "trendLines": [],
                  "graphs": [
                    {
                      "balloonText": "Produzido (%): <b>[[value]] ("+res.data.request.ds_unidade+")  </b>",
                      "fillAlphas": 0.8,
                      "id": "AmGraph-1",
                      "lineAlpha": 0.2,
                      "title": "% de Produção",
                      "labelText": "[[value]]",
                      "type": "column",
                      "valueField": "producao",
                      "fillColorsField": "color_producao", 
                      "lineColor": "#2A0CD0",
                
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
                  "listeners": [{
                    "event": "clickGraphItem",
                    "method":(event) => {
                      
                      this.getDetalhesProducao(event.item.dataContext); 
                      
                      //console.log(event);
                      //console.log(event.item.dataContext);
                      //alert(event.item.category); 
                    }
                  }],
                  "allLabels": [],
                  "balloon": {},
                  "titles": [],
                  "dataProvider": res.data.prod_per 
                });
 
                if(!res.data.prod_per){
                  $("#chartdivPercProd").html(this.graficoBarra2);
                }
                    
                /* Grafico Produtos */ 
                var chart = AmCharts.makeChart("chartdivProdutos", {
                  "decimalSeparator": ",",
                  "thousandsSeparator": ".",
                  "type": "serial",
                  "theme": "none",
                  "rotate": true, 
                  "dataProvider": res.data.produtos,
                 
                  "startDuration": 1,
                  "graphs": [{
                    "balloonText": "<b>[[category]]: [[value]] ("+res.data.request.ds_unidade+") </b>",
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
                if(!res.data.produtos){
                  $("#chartdivProdutos").html(this.graficoBarra);
                }

                /*Comparativo*/
                if(res.data.request.agrupamento=='D'){
 
                  if(res.data.ComparativoAno){
                    var chart = AmCharts.makeChart("chartdiv_comparativo", {
                      "decimalSeparator": ",",
                      "thousandsSeparator": ".",
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
                      "legend": {
                        "align": "center",
                        "useGraphSettings": true,
                        "equalWidths": false, 
                        "valueAlign": "left",
                        "valueText": "[[value]] ([[percents]]%)",
                        "valueWidth": 100
                      },
                      "trendLines": [],
                      "graphs": [
                          {
                              "balloonText": "<b>[[label]]</b> <br> <b>"+res.data.graficoAnos01+"</b> : [[value]] ("+res.data.request.ds_unidade+")",
                              "fillAlphas": 0.8,
                              "id": "AmGraph-1",
                              "lineAlpha": 0.2,
                              "title": res.data.graficoAnos01,
                              "labelText": "[[value]]",
                              "type": "column",
                              "valueField": "ano01",
                              "fillColorsField": "color01",
                              "lineColor": "#008000"
                          },
                          {
                              "balloonText": "<b>[[label]]</b> <br> <b>"+res.data.graficoAnos02+" </b>: [[value]] ("+res.data.request.ds_unidade+")",
                              "fillAlphas": 0.8,
                              "id": "AmGraph-2",
                              "lineAlpha": 0.2,
                              "title": res.data.graficoAnos02,
                              "labelText": "[[value]]",
                              "type": "column",
                              "valueField": "ano02",
                              "fillColorsField": "color02", 
                              "lineColor": "#2A0CD0"

                          },
                          {
                              "balloonText": "<b>[[label]]</b> <br> <b>"+res.data.graficoAnos03+"</b> : [[value]] ("+res.data.request.ds_unidade+")",
                              "fillAlphas": 0.8,
                              "id": "AmGraph-3",
                              "lineAlpha": 0.2,
                              "title": res.data.graficoAnos03,
                              "labelText": "[[value]]",
                              "type": "column",
                              "valueField": "ano03",
                              "fillColorsField": "color03",
                              "lineColor": "#FF0F00"
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
                    $("#chartdiv_agua").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-barra.png'><br>#Sem Informações </div>");
                  }
                  
                }else{
 
                  if(res.data.comparativo){
                    var chart = AmCharts.makeChart("chartdiv_comparativo", {
                      "decimalSeparator": ",",
                      "thousandsSeparator": ".",
                      "theme": "none",
                      "type": "serial",
                      "startDuration": 2,
                      "dataProvider": res.data.comparativo,
                        "graphs": [{
                            "balloonText": "[[category]]: <b>[[value]]  ("+res.data.request.ds_unidade+")</b>",
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
                  }else{
                    $("#chartdiv_comparativo").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-barra.png'><br>#Sem Informações </div>");
                  }
 
                }
                 
                /*Agua*/ 
                if(res.data.GraficoAgua){
                  var chart = AmCharts.makeChart("chartdiv_agua", {
                    "decimalSeparator": ",",
                    "thousandsSeparator": ".",
                    "theme": "none",
                    "type": "serial",
                    "startDuration": 2,
                    "dataProvider": res.data.GraficoAgua,
                    "graphs": [{
                        "balloonText": " DIA [[category]] :  <b>[[value]] (m³/h)</b>",
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
                }else{
                  $("#chartdiv_agua").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-barra.png'><br>#Sem Informações </div>");
                }

                /*Energia*/ 
                if(res.data.GraficoEnergia){
                  var chart = AmCharts.makeChart("chartdiv_energia", {
                    "decimalSeparator": ",",
                    "thousandsSeparator": ".",
                    "theme": "none",
                    "type": "serial",
                    "startDuration": 2,
                    "dataProvider": res.data.GraficoEnergia,
                    "graphs": [{ 
                        "balloonText": " DIA [[category]] :  <b>[[value]] (Kw)</b>",
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
                }else{
                  $("#chartdiv_energia").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-barra.png'><br>#Sem Informações </div>");
                }

                /*Lenha*/ 
                if(res.data.GraficoLenha){
                  var chart = AmCharts.makeChart("chartdiv_lenha", {
                    "decimalSeparator": ",",
                    "thousandsSeparator": ".",
                    "theme": "none",
                    "type": "serial",
                    "startDuration": 2,
                    "dataProvider": res.data.GraficoLenha,
                    "graphs": [{
                      "balloonText": " DIA [[category]] :  <b>[[value]] (M3)</b>",
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
                }else{
                  $("#chartdiv_lenha").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-barra.png'><br>#Sem Informações </div>");
                }

                /*Polpa*/
                if(res.data.GraficoPolpa){
                  var chart = AmCharts.makeChart("chartdiv_polpa", {
                    "decimalSeparator": ",",
                    "thousandsSeparator": ".",
                    "theme": "none",
                    "type": "serial",
                    "startDuration": 2,
                    "dataProvider": res.data.GraficoPolpa,
                    "graphs": [{ 
                        "balloonText": " DIA [[category]] :  <b>[[value]] (kg)</b>",
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
                }else{
                  $("#chartdiv_polpa").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-barra.png'><br>#Sem Informações </div>");
                }
 
                /*Parada*/ 
                if(res.data.GraficoParada){
                  var chart = AmCharts.makeChart("chartdiv_parada", {
                    "decimalSeparator": ",",
                    "thousandsSeparator": ".",
                    "theme": "none",
                    "type": "serial",
                    "startDuration": 2,
                    "dataProvider": res.data.GraficoParada,
                    "graphs": [{ 
                        "balloonText": " DIA [[category]] :  <b>[[value]] (Min)</b>",
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
                }else{ 
                  $("#chartdiv_parada").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-barra.png'><br>#Sem Informações </div>");
                }

                /*TipoParada*/
                if(res.data.GraficoTp_parada){
                  var chart = AmCharts.makeChart( "chartdiv_tp_parada", {
                    "decimalSeparator": ",",
                    "thousandsSeparator": ".",
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
                }else{
                  $("#chartdiv_tp_parada").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-pizza.png'><br>#Sem Informações </div>");
                }

                /*Perda*/ 
                if(res.data.GraficoPerda){
                  var chart = AmCharts.makeChart("chartdiv_perda", {
                    "decimalSeparator": ",",
                    "thousandsSeparator": ".",
                    "theme": "none",
                    "type": "serial",
                    "startDuration": 2,
                    "dataProvider": res.data.GraficoPerda,
                    "graphs": [{ 
                        "balloonText": " DIA [[category]] :  <b>[[value]]</b>",
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
                }else{ 
                  $("#chartdiv_perda").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-barra.png'><br>#Sem Informações </div>");
                }

                /*TipoPerda*/ 
                if(res.data.GraficoGrupoPerda){ 
                  var chart = AmCharts.makeChart( "chartdiv_grupo_perda", {
                    "decimalSeparator": ",",
                    "thousandsSeparator": ".",
                    "type": "pie",
                    "theme": "none",
                    "dataProvider": res.data.GraficoGrupoPerda,
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
                }else{
                  $("#chartdiv_grupo_perda").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-pizza.png'><br>#Sem Informações </div>");
                }

                /*TipoPerda*/ 
                if(res.data.GraficoTpPerda){ 
                  var chart = AmCharts.makeChart( "chartdiv_tp_perda", {
                    "decimalSeparator": ",",
                    "thousandsSeparator": ".",
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
                }else{
                  $("#chartdiv_tp_perda").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-pizza.png'><br>#Sem Informações </div>");
                }

            })
            .catch((err) => { 
              console.log(err.response.data); 
              toastr.error(err.response.data.message,"Erro") 
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

    getDetalhesProducao(dados){
     
      console.log(dados);
      this.modalLoadingCharts = true;
      $("#modalDetalhesProducao").modal(); 
      this.hidricoDetalhes =  this.tabCarregando;
      this.energiaDetalhes =  this.tabCarregando;
      this.lenhaDetalhes = this.tabCarregando;
      this.perdaDetalhes =  this.tabCarregando;
      this.paradaDetalhes =  this.tabCarregando;
      this.polpaDetalhes =  this.tabCarregando; 
      this.produzido_cxDetalhes =  this.tabCarregando;
      this.produzido_kgDetalhes  =  this.tabCarregando;
      this.produzido_toDetalhes =  this.tabCarregando;
      
 
      axios.post('/colonial/prod_prev_real-detalhes',dados)
      .then((res) => {
        console.log(res.data);
 

        if(dados.agrupamento=='P'){
          this.tituloDetalhesModal = 'PRODUTO: '+res.data.data;
        }else{
          this.tituloDetalhesModal = 'DATA: '+res.data.data;
        }

        this.hidricoDetalhes =  res.data.hidrico+'<span class="headerUnidade"> (m³/h)</span>';
        this.energiaDetalhes =  res.data.energia+'<span class="headerUnidade"> (kw)</span>';
        this.lenhaDetalhes = res.data.lenha+'<span class="headerUnidade"> (m³)</span>';
        this.perdaDetalhes =  res.data.perda;
        this.paradaDetalhes =  res.data.parada+'<span class="headerUnidade"> (min)</span>';
        this.polpaDetalhes =  res.data.polpa+'<span class="headerUnidade"> (kg)</span>';

        this.produzido_cxDetalhes =  res.data.produzido_cx+'<span class="headerUnidade"> (Cx)</span>';
        this.produzido_kgDetalhes  =  res.data.produzido_kg+'<span class="headerUnidade"> (Kg)</span>';
        this.produzido_toDetalhes =  res.data.produzido_to+'<span class="headerUnidade"> (To)</span>';
        this.tabProdDetalhes = res.data.listaProducao;
        this.tabPerdaDetalhes = res.data.dadosPerda;
        this.tabParadaDetalhes = res.data.dadosParada;

        this.totais_toDetalhes = res.data.totais;

      })
      .catch((err) => { 
        console.log(err.response.data); 
        toastr.error(err.response.data.message,"Erro") 
      })
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
