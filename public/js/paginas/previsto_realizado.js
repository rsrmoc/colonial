/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************************!*\
  !*** ./resources/js/paginas/previsto_realizado.js ***!
  \****************************************************/
var chart1Ctx = document.querySelector('#chart-1');
var chart2Ctx = document.querySelector('#chart-2');
var chart3Ctx = document.querySelector('#chart-3');
var chart4Ctx = document.querySelector('#chart-4');
var chartPrevReal = document.querySelector('#chart-prev_realizado');
Alpine.data('app', function () {
  return {
    chart1: null,
    chart2: null,
    chart3: null,
    chart4: null,
    dadosParada: null,
    dadosPerda: null,
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
    tabProdDetalhes: null,
    tabPerdaDetalhes: null,
    tabParadaDetalhes: null,
    tabDetalhes: null,
    graficoBarra: "<div style='text-align: center;margin-top: 110px;'> <img src='/assets/images/grafico-barra.png'> </div>",
    graficoBarraTipo: "<div style='text-align: center;margin-top: 40px;'> <img src='/assets/images/grafico-barra.png'> </div>",
    graficoBarra2: "<div style='text-align: center;margin-top: 25px;'> <img src='/assets/images/grafico-barra.png'> </div>",
    graficoPizza: "<div style='text-align: center;margin-top: 110px;'> <img src='/assets/images/grafico-pizza.png'> </div>",
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
    tabPorPerdas: null,
    iconHeaderProdTo: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderProdKg: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderProdCx: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderAgua: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderAguaKg: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderEnergia: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderEnergiaKg: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderLenha: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderLenhaKg: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderParadas: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderPerdas: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderPolpas: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderPolpasKg: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderPolpasTb: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
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
      dtf: null,
      agrupamento: '',
      unidade: '',
      ano: '',
      mes: '',
      dia: ''
    },
    parametrosXLS: {
      dt_comparativa_ano: null,
      dt_comparativa_dia: null,
      dt_comparativa_mes: null,
      dtf: null,
      dti: null
    },
    dadosCards: {
      ano: '',
      mes: '',
      dia: '',
      indicador: ''
    },
    listaCards: null,
    init: function init() {
      var _this = this;
      $('#indicadores-parametros #parametro-ano').on('select2:select', function () {
        var Ano = $('#indicadores-parametros #parametro-ano').val();
        var Mes = $('#indicadores-parametros #parametro-mes').val();
        if (Ano) {
          if (Mes) {
            _this.TotDias = _this.TotMeses[Ano][Number(Mes)];
          }
        }
      });
      $('#indicadores-parametros #parametro-mes').on('select2:select', function () {
        var Ano = $('#indicadores-parametros #parametro-ano').val();
        var Mes = $('#indicadores-parametros #parametro-mes').val();
        if (Ano) {
          if (Mes) {
            _this.TotDias = _this.TotMeses[Ano][Number(Mes)];
          }
        }
      });
      this.getDataChart1();
    },
    getDataChart1: function getDataChart1() {
      var _this2 = this;
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
      this.iconHeaderPolpasTb = this.iconCarregando;
      this.loadingCharts = true;
      this.parametros.dia = $('#parametro-dia').val();
      this.parametros.mes = $('#parametro-mes').val();
      this.parametros.ano = $('#parametro-ano').val();
      this.parametros.unidade = $('#parametro-visao').val();
      axios.post('/colonial/prod_prev_real-json', this.parametros).then(function (res) {
        _this2.parametrosXLS.dt_comparativa_ano = res.data.request.dt_comparativa_ano;
        _this2.parametrosXLS.dt_comparativa_mes = res.data.request.dt_comparativa_mes;
        _this2.parametrosXLS.dt_comparativa_dia = res.data.request.dt_comparativa_dia;
        _this2.parametrosXLS.dti = res.data.request.dti;
        _this2.parametrosXLS.dtf = res.data.request.dtf;
        _this2.titlePlanejado = 'Planejado x Produzido ' + res.data.request.ds_unid;
        _this2.titleTipoProd = 'Tipo de Produtos ' + res.data.request.ds_unid;
        _this2.titleComparativo = 'Comparativo ' + res.data.request.ds_unid;
        _this2.chartPrevReal = null;
        _this2.parametros.dti = res.data.request.dti;
        _this2.parametros.dtf = res.data.request.dtf;
        _this2.iconHeaderAgua = res.data.request.hidrico + '<span class="headerUnidade"> (m³/h)</span>';
        _this2.iconHeaderAguaKg = res.data.request.AguaKg + '<span class="headerUnidade"> (m³/kg)</span>';
        _this2.iconHeaderEnergia = res.data.request.energia + '<span class="headerUnidade"> (Kw) </span>';
        _this2.iconHeaderEnergiaKg = res.data.request.EnergiaKg + '<span class="headerUnidade"> (Kw/kg) </span>';
        _this2.iconHeaderLenha = res.data.request.lenha + '<span class="headerUnidade"> (M3) </span>';
        _this2.iconHeaderLenhaKg = res.data.request.LenhaKg + '<span class="headerUnidade"> (m3/kg) </span>';
        _this2.iconHeaderPerdas = res.data.request.perda;
        _this2.iconHeaderParadas = res.data.request.parada + '<span class="headerUnidade"> (Min)</span>';
        _this2.iconHeaderPolpas = res.data.request.polpa + '<span class="headerUnidade"> (Kg) </span>';
        _this2.iconHeaderPolpasTb = res.data.request.PolpaTb + '<span class="headerUnidade"> (Tb) </span>';
        _this2.iconHeaderPolpasKg = res.data.request.PolpaKg + '<span class="headerUnidade"> (kg/kg) </span>';
        _this2.iconHeaderProdTo = res.data.request.ProduzidoTo + '<span class="headerUnidade"> (T) </span>';
        _this2.iconHeaderProdKg = res.data.request.ProduzidoKg + '<span class="headerUnidade"> (Kg) </span>';
        _this2.iconHeaderProdCx = res.data.request.ProduzidoCx + '<span class="headerUnidade"> (Cx) </span>';
        _this2.iconHeaderPerdasEmb = res.data.request.embalagens;
        _this2.iconHeaderPerdasPol = res.data.request.polpas;
        _this2.iconHeaderPerdasIns = res.data.request.insumos;
        _this2.iconHeaderPerdasOut = res.data.request.outros;
        _this2.ProduzidoCx = res.data.request.ProduzidoCx;
        _this2.ProduzidoKg = res.data.request.ProduzidoKg;
        _this2.ProduzidoTo = res.data.request.ProduzidoTo;
        _this2.PlanejadoCx = res.data.request.PlanejadoCx;
        _this2.PlanejadoKg = res.data.request.PlanejadoKg;
        _this2.PlanejadoTo = res.data.request.PlanejadoTo;
        _this2.ProduzidoCxPerc = res.data.request.ProduzidoCxPerc + '%';
        _this2.ProduzidoKgPerc = res.data.request.ProduzidoKgPerc + '%';
        _this2.ProduzidoToPerc = res.data.request.ProduzidoToPerc + '%';
        _this2.TotMeses = res.data.request.Meses;
        _this2.parametros.valida = true;
        $('#indicadores-parametros #parametro-ano').val(res.data.request.ano).trigger('change');
        $('#indicadores-parametros #parametro-mes').val(res.data.request.mes).trigger('change');
        if (res.data.request.ano) {
          if (res.data.request.mes) {
            _this2.TotDias = _this2.TotMeses[res.data.request.ano][Number(res.data.request.mes)];
          }
        }
        console.log(res.data);

        /* Grafico Planejado x Produzido */
        var chart = AmCharts.makeChart("chartdivPrevProd", {
          "decimalSeparator": ",",
          "thousandsSeparator": ".",
          "type": "serial",
          "fontSize": 12,
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
          "graphs": [{
            "balloonText": "Planejado: <b>[[value]] (" + res.data.request.ds_unidade + ") </b>",
            "fillAlphas": 0.8,
            "id": "AmGraph-1",
            "lineAlpha": 0.2,
            "title": "Planejado",
            "labelText": "[[value]]",
            "type": "column",
            "valueField": "planejado",
            "fillColorsField": "color_planejado",
            "lineColor": "#008000",
            "labelRotation": 270,
            "dashLength": 2
          }, {
            "balloonText": "Produzido: <b>[[value]] (" + res.data.request.ds_unidade + ")</b>",
            "fillAlphas": 0.8,
            "id": "AmGraph-2",
            "lineAlpha": 0.2,
            "title": "Produzido",
            "labelText": "[[value]]",
            "type": "column",
            "valueField": "produzido",
            "fillColorsField": "color_produzido",
            "lineColor": "#FF0F00",
            "labelRotation": 270,
            "dashLength": 2
          }],
          "listeners": [{
            "event": "clickGraphItem",
            "method": function method(event) {
              _this2.getDetalhesProducao(event.item.dataContext);

              //console.log(event);
              //console.log(event.item.dataContext);
              //alert(event.item.category); 
            }
          }],

          "valueAxes": [{
            "axisAlpha": 0.2,
            "id": "v1",
            "minimum": 0
          }],
          "dataProvider": res.data.previsto
        });
        if (!res.data.previsto) {
          $("#chartdivPrevProd").html(_this2.graficoBarra);
        }

        /* Grafico Porcentagem Produzida */
        var chart = AmCharts.makeChart("chartdivPercProd", {
          "decimalSeparator": ",",
          "thousandsSeparator": ".",
          "type": "serial",
          "fontSize": 12,
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
          "graphs": [{
            "balloonText": "Produzido : <b>[[value]] (%)  </b>",
            "fillAlphas": 0.8,
            "id": "AmGraph-1",
            "lineAlpha": 0.2,
            "title": "% de Produção",
            "labelText": "[[value]]",
            "type": "column",
            "valueField": "producao",
            "fillColorsField": "color_producao",
            "lineColor": "#2A0CD0"
          }],
          "valueAxes": [{
            "axisAlpha": 0.2,
            "id": "v1",
            "minimum": 0
          }],
          "listeners": [{
            "event": "clickGraphItem",
            "method": function method(event) {
              _this2.getDetalhesProducao(event.item.dataContext);

              //console.log(event);
              //console.log(event.item.dataContext);
              //alert(event.item.category); 
            }
          }],

          "dataProvider": res.data.prod_per
        });
        if (!res.data.prod_per) {
          $("#chartdivPercProd").html(_this2.graficoBarra2);
        }

        /* Grafico Produtos */
        var chart = AmCharts.makeChart("chartdivProdutos", {
          "decimalSeparator": ",",
          "thousandsSeparator": ".",
          "fontSize": 11,
          "type": "serial",
          "theme": "none",
          "rotate": true,
          "dataProvider": res.data.produtos,
          "startDuration": 1,
          "graphs": [{
            "balloonText": "<b>[[category]]: [[value]] (" + res.data.request.ds_unidade + ") </b>",
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
        if (!res.data.produtos) {
          $("#chartdivProdutos").html(_this2.graficoBarra);
        }

        /*Comparativo*/
        if (res.data.request.agrupamento == 'D') {
          if (res.data.ComparativoAno) {
            var chart = AmCharts.makeChart("chartdiv_comparativo", {
              "decimalSeparator": ",",
              "thousandsSeparator": ".",
              "fontSize": 12,
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
              "graphs": [{
                "balloonText": "<b>[[label]]</b> <br> <b>" + res.data.graficoAnos01 + "</b> : [[value]] (" + res.data.request.ds_unidade + ")",
                "fillAlphas": 0.8,
                "id": "AmGraph-1",
                "lineAlpha": 0.2,
                "title": res.data.graficoAnos01,
                "labelText": "[[value]]",
                "type": "column",
                "valueField": "ano01",
                "fillColorsField": "color01",
                "lineColor": "#008000",
                "labelRotation": 270,
                "dashLength": 2
              }, {
                "balloonText": "<b>[[label]]</b> <br> <b>" + res.data.graficoAnos02 + " </b>: [[value]] (" + res.data.request.ds_unidade + ")",
                "fillAlphas": 0.8,
                "id": "AmGraph-2",
                "lineAlpha": 0.2,
                "title": res.data.graficoAnos02,
                "labelText": "[[value]]",
                "type": "column",
                "valueField": "ano02",
                "fillColorsField": "color02",
                "lineColor": "#2A0CD0",
                "labelRotation": 270,
                "dashLength": 2
              }, {
                "balloonText": "<b>[[label]]</b> <br> <b>" + res.data.graficoAnos03 + "</b> : [[value]] (" + res.data.request.ds_unidade + ")",
                "fillAlphas": 0.8,
                "id": "AmGraph-3",
                "lineAlpha": 0.2,
                "title": res.data.graficoAnos03,
                "labelText": "[[value]]",
                "type": "column",
                "valueField": "ano03",
                "fillColorsField": "color03",
                "lineColor": "#FF0F00",
                "labelRotation": 270,
                "dashLength": 2
              }],
              "guides": [],
              "valueAxes": [{
                "id": "ValueAxis-1",
                "position": "top",
                "axisAlpha": 0
              }],
              "allLabels": [],
              "balloon": {},
              "titles": [],
              "dataProvider": res.data.ComparativoAno
            });
          } else {
            $("#chartdiv_agua").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-barra.png'><br>#Sem Informações </div>");
          }
        } else {
          if (res.data.comparativo) {
            var chart = AmCharts.makeChart("chartdiv_comparativo", {
              "decimalSeparator": ",",
              "thousandsSeparator": ".",
              "theme": "none",
              "type": "serial",
              "startDuration": 2,
              "dataProvider": res.data.comparativo,
              "graphs": [{
                "balloonText": "[[category]]: <b>[[value]]  (" + res.data.request.ds_unidade + ")</b>",
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
          } else {
            $("#chartdiv_comparativo").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-barra.png'><br>#Sem Informações </div>");
          }
        }

        /*Agua*/
        if (res.data.GraficoAgua) {
          var chart = AmCharts.makeChart("chartdiv_agua", {
            "decimalSeparator": ",",
            "thousandsSeparator": ".",
            "fontSize": 12,
            "theme": "none",
            "type": "serial",
            "startDuration": 2,
            "dataProvider": res.data.GraficoAgua,
            "graphs": [{
              "balloonText": " DIA [[category]] :  <b>[[value]] (M3)</b>",
              "colorField": "color",
              "fillAlphas": 0.85,
              "lineAlpha": 0.1,
              "type": "column",
              "labelText": "[[value]]",
              "topRadius": 1,
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
              "axisAlpha": 0,
              "gridAlpha": 0
            }
          }, 0);
        } else {
          $("#chartdiv_agua").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-barra.png'><br>#Sem Informações </div>");
        }

        /*Energia*/
        if (res.data.GraficoEnergia) {
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
              "labelText": "[[value]]",
              "topRadius": 1,
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
              "axisAlpha": 0,
              "gridAlpha": 0
            }
          }, 0);
        } else {
          $("#chartdiv_energia").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-barra.png'><br>#Sem Informações </div>");
        }

        /*Lenha*/
        if (res.data.GraficoLenha) {
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
              "labelText": "[[value]]",
              "topRadius": 1,
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
              "axisAlpha": 0,
              "gridAlpha": 0
            }
          }, 0);
        } else {
          $("#chartdiv_lenha").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-barra.png'><br>#Sem Informações </div>");
        }

        /*Polpa*/
        if (res.data.GraficoPolpa) {
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
              "labelText": "[[value]]",
              "topRadius": 1,
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
              "axisAlpha": 0,
              "gridAlpha": 0
            }
          }, 0);
        } else {
          $("#chartdiv_polpa").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-barra.png'><br>#Sem Informações </div>");
        }

        /*Parada*/
        if (res.data.GraficoParada) {
          var chart = AmCharts.makeChart("chartdiv_parada", {
            "decimalSeparator": ",",
            "thousandsSeparator": ".",
            "theme": "none",
            "type": "serial",
            "startDuration": 2,
            "dataProvider": res.data.GraficoParada,
            "graphs": [{
              "balloonText": " DIA [[category]] :  <b>[[value]] ( Minutos )</b>",
              "colorField": "color",
              "fillAlphas": 0.85,
              "lineAlpha": 0.1,
              "labelText": "[[value]]",
              "type": "column",
              "topRadius": 1,
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
              "axisAlpha": 0,
              "gridAlpha": 0
            },
            "listeners": [{
              "event": "clickGraphItem",
              "method": function method(event) {
                _this2.getDetalheParada(event.item.dataContext);
              }
            }]
          }, 0);
        } else {
          $("#chartdiv_parada").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-barra.png'><br>#Sem Informações </div>");
        }

        /*TipoParada*/
        if (res.data.GraficoTp_parada) {
          var chart = AmCharts.makeChart("chartdiv_tp_parada", {
            "decimalSeparator": ",",
            "thousandsSeparator": ".",
            "type": "serial",
            "theme": "none",
            "rotate": true,
            "dataProvider": res.data.GraficoTp_parada,
            "valueAxes": [{
              "axisAlpha": 0.2,
              "id": "v1",
              "minimum": 0
            }],
            "startDuration": 1,
            "graphs": [{
              "balloonText": "<b>[[category]]: [[value]] ( Minutos ) </b>",
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
            },
            "listeners": [{
              "event": "clickGraphItem",
              "method": function method(event) {
                _this2.getDetalheParada(event.item.dataContext);
              }
            }]
          });
        } else {
          $("#chartdiv_tp_parada").html("<div style='text-align: center;'> <img style='padding-top: 40px;' src='/assets/images/grafico-barra.png'><br>#Sem Informações </div>");
        }

        /*EquipamentoParada*/
        if (res.data.GraficoEquip_parada) {
          var chart = AmCharts.makeChart("chartdiv_Equip_parada", {
            "decimalSeparator": ",",
            "thousandsSeparator": ".",
            "type": "serial",
            "theme": "none",
            "rotate": true,
            "dataProvider": res.data.GraficoEquip_parada,
            "valueAxes": [{
              "axisAlpha": 0.2,
              "id": "v1",
              "minimum": 0
            }],
            "startDuration": 1,
            "graphs": [{
              "balloonText": "<b>[[category]]: [[value]] ( Minutos ) </b>",
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
            },
            "listeners": [{
              "event": "clickGraphItem",
              "method": function method(event) {
                _this2.getDetalheParada(event.item.dataContext);
              }
            }]
          });
        } else {
          $("#chartdiv_Equip_parada").html("<div style='text-align: center;'> <img style='padding-top: 40px;' src='/assets/images/grafico-barra.png'><br>#Sem Informações </div>");
        }

        /*Perda*/
        if (res.data.GraficoPerda) {
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
              "labelText": "[[value]]",
              "type": "column",
              "topRadius": 1,
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
              "axisAlpha": 0,
              "gridAlpha": 0
            },
            "listeners": [{
              "event": "clickGraphItem",
              "method": function method(event) {
                _this2.getDetalhePerda(event.item.dataContext);
              }
            }]
          }, 0);
        } else {
          $("#chartdiv_perda").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-barra.png'><br>#Sem Informações </div>");
        }

        /*GrupoPerda*/
        if (res.data.GraficoGrupoPerda) {
          var chart = AmCharts.makeChart("chartdiv_grupo_perda", {
            "decimalSeparator": ",",
            "thousandsSeparator": ".",
            "type": "serial",
            "theme": "none",
            "rotate": true,
            "dataProvider": res.data.GraficoGrupoPerda,
            "valueAxes": [{
              "axisAlpha": 0.2,
              "id": "v1",
              "minimum": 0
            }],
            "startDuration": 1,
            "graphs": [{
              "balloonText": "<b>[[category]]: [[value]]   </b>",
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
            },
            "listeners": [{
              "event": "clickGraphItem",
              "method": function method(event) {
                _this2.getDetalhePerda(event.item.dataContext);
              }
            }]
          });
        } else {
          $("#chartdiv_grupo_perda").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-pizza.png'><br>#Sem Informações </div>");
        }

        /*TipoPerda*/
        if (res.data.GraficoTpPerda) {
          var chart = AmCharts.makeChart("chartdiv_tp_perda", {
            "decimalSeparator": ",",
            "thousandsSeparator": ".",
            "type": "serial",
            "theme": "none",
            "rotate": true,
            "dataProvider": res.data.GraficoTpPerda,
            "valueAxes": [{
              "axisAlpha": 0.2,
              "id": "v1",
              "minimum": 0
            }],
            "startDuration": 1,
            "graphs": [{
              "balloonText": "<b>[[category]]: [[value]]   </b>",
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
            },
            "listeners": [{
              "event": "clickGraphItem",
              "method": function method(event) {
                _this2.getDetalhePerda(event.item.dataContext);
              }
            }]
          });
        } else {
          $("#chartdiv_tp_perda").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-pizza.png'><br>#Sem Informações </div>");
        }

        /*PorcentagemPerda*/
        if (res.data.GraficoPorcPerda) {
          _this2.tabPorPerdas = res.data.GraficoPorcPerda;
          var chart = AmCharts.makeChart("chartdiv_porc_perda", {
            "decimalSeparator": ",",
            "thousandsSeparator": ".",
            "type": "serial",
            "theme": "none",
            "rotate": true,
            "dataProvider": res.data.GraficoPorcPerda,
            "valueAxes": [{
              "axisAlpha": 0.2,
              "id": "v1",
              "minimum": 0
            }],
            "startDuration": 1,
            "graphs": [{
              "balloonText": "<b>[[category]]: [[value]]   </b>",
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
            },
            "listeners": [{
              "event": "clickGraphItem",
              "method": function method(event) {

                // this.getDetalhePerda(event.item.dataContext);   
              }
            }]
          });
        } else {
          $("#chartdiv_porc_perda").html("<div style='text-align: center;'> <img style='padding-top: 150px;' src='/assets/images/grafico-pizza.png'><br>#Sem Informações </div>");
        }
      })["catch"](function (err) {
        console.log(err.response.data);
        toastr.error(err.response.data.message, "Erro");
      })["finally"](function () {
        return _this2.loadingCharts = false;
      });
    },
    xls: function xls(tipo) {
      location.href = '/colonial/prod_prev_real-xls/' + tipo + '?dtf=' + this.parametros.dtf + '&dti=' + this.parametros.dti;
      toastr['success']('XLS gerado com sucesso');
    },
    getDetalheParada: function getDetalheParada(dados) {
      var _this3 = this;
      console.log(dados);
      $("#modalDetalhesParada").modal();
      this.modalLoadingCharts = true;
      dados.indicador = 'parada';
      if (dados.sub_grupo == 'dt') {
        this.tituloDetalhesModal = 'Data: ' + dados.dt;
      }
      if (dados.sub_grupo == 'tipo') {
        this.tituloDetalhesModal = 'Tipos de Parada: ' + dados.produto;
      }
      if (dados.sub_grupo == 'equip') {
        this.tituloDetalhesModal = 'Equipamento: ' + dados.produto;
      }
      axios.post('/colonial/prod_prev_real-detalhes', dados).then(function (res) {
        console.log(res.data);
        _this3.dadosParada = res.data.dadosParada;
      })["catch"](function (err) {
        console.log(err.response.data);
        toastr.error(err.response.data.message, "Erro");
      })["finally"](function () {
        return _this3.modalLoadingCharts = false;
      });
    },
    getDetalhePerda: function getDetalhePerda(dados) {
      var _this4 = this;
      console.log(dados);
      $("#modalDetalhesPerda").modal();
      this.modalLoadingCharts = true;
      dados.indicador = 'perda';
      if (dados.sub_grupo == 'dt') {
        this.tituloDetalhesModal = 'Data: ' + dados.dt;
      }
      if (dados.sub_grupo == 'tipo') {
        this.tituloDetalhesModal = 'Tipos de Perda: ' + dados.produto;
      }
      if (dados.sub_grupo == 'grupo') {
        this.tituloDetalhesModal = 'Grupo de Produto: ' + dados.produto;
      }
      axios.post('/colonial/prod_prev_real-detalhes', dados).then(function (res) {
        console.log(res.data);
        _this4.dadosPerda = res.data.dadosPerda;
      })["catch"](function (err) {
        console.log(err.response.data);
        toastr.error(err.response.data.message, "Erro");
      })["finally"](function () {
        return _this4.modalLoadingCharts = false;
      });
    },
    getDetalhesProducao: function getDetalhesProducao(dados) {
      var _this5 = this;
      console.log(dados);
      this.modalLoadingCharts = true;
      $("#modalDetalhesProducao").modal();
      this.hidricoDetalhes = this.tabCarregando;
      this.energiaDetalhes = this.tabCarregando;
      this.lenhaDetalhes = this.tabCarregando;
      this.perdaDetalhes = this.tabCarregando;
      this.paradaDetalhes = this.tabCarregando;
      this.polpaDetalhes = this.tabCarregando;
      this.produzido_cxDetalhes = this.tabCarregando;
      this.produzido_kgDetalhes = this.tabCarregando;
      this.produzido_toDetalhes = this.tabCarregando;
      dados.indicador = 'producao';
      axios.post('/colonial/prod_prev_real-detalhes', dados).then(function (res) {
        console.log(res.data);
        if (dados.agrupamento == 'P') {
          _this5.tituloDetalhesModal = 'PRODUTO: ' + res.data.data;
        } else {
          _this5.tituloDetalhesModal = 'DATA: ' + res.data.data;
        }
        _this5.hidricoDetalhes = res.data.hidrico + '<span class="headerUnidade"> (m³/h)</span>';
        _this5.energiaDetalhes = res.data.energia + '<span class="headerUnidade"> (kw)</span>';
        _this5.lenhaDetalhes = res.data.lenha + '<span class="headerUnidade"> (m³)</span>';
        _this5.perdaDetalhes = res.data.perda;
        _this5.paradaDetalhes = res.data.parada + '<span class="headerUnidade"> (min)</span>';
        _this5.polpaDetalhes = res.data.polpa + '<span class="headerUnidade"> (kg)</span>';
        _this5.produzido_cxDetalhes = res.data.produzido_cx + '<span class="headerUnidade"> (Cx)</span>';
        _this5.produzido_kgDetalhes = res.data.produzido_kg + '<span class="headerUnidade"> (Kg)</span>';
        _this5.produzido_toDetalhes = res.data.produzido_to + '<span class="headerUnidade"> (To)</span>';
        _this5.tabProdDetalhes = res.data.listaProducao;
        _this5.tabPerdaDetalhes = res.data.dadosPerda;
        _this5.tabParadaDetalhes = res.data.dadosParada;
        _this5.totais_toDetalhes = res.data.totais;
      })["catch"](function (err) {
        console.log(err.response.data);
        toastr.error(err.response.data.message, "Erro");
      })["finally"](function () {
        return _this5.modalLoadingCharts = false;
      });
    },
    getDetalhecards: function getDetalhecards(tipo) {
      var _this6 = this;
      this.modalLoadingCharts = true;
      $("#modalDetalhesCards").modal();
      if (tipo == 'producao_cards') {
        this.dadosCards.dia = $('#parametro-dia').val();
        this.dadosCards.mes = $('#parametro-mes').val();
        this.dadosCards.ano = $('#parametro-ano').val();
        this.dadosCards.indicador = 'producao_cards';
        var dt = this.dadosCards.ano;
        if (this.dadosCards.mes) {
          dt = this.dadosCards.mes + '/' + dt;
          if (this.dadosCards.dia) {
            dt = this.dadosCards.dia + '/' + dt;
          }
        }
        this.tituloDetalhesModal = 'PRODUÇÃO: ' + dt;
      }
      if (tipo == 'polpa_cards') {
        this.dadosCards.dia = $('#parametro-dia').val();
        this.dadosCards.mes = $('#parametro-mes').val();
        this.dadosCards.ano = $('#parametro-ano').val();
        this.dadosCards.indicador = 'polpa_cards';
        var dt = this.dadosCards.ano;
        if (this.dadosCards.mes) {
          dt = this.dadosCards.mes + '/' + dt;
          if (this.dadosCards.dia) {
            dt = this.dadosCards.dia + '/' + dt;
          }
        }
        this.tituloDetalhesModal = 'CONSUMO DE POLPAS: ' + dt;
      }
      if (tipo == 'agua_cards') {
        this.dadosCards.dia = $('#parametro-dia').val();
        this.dadosCards.mes = $('#parametro-mes').val();
        this.dadosCards.ano = $('#parametro-ano').val();
        this.dadosCards.indicador = 'agua_cards';
        var dt = this.dadosCards.ano;
        if (this.dadosCards.mes) {
          dt = this.dadosCards.mes + '/' + dt;
          if (this.dadosCards.dia) {
            dt = this.dadosCards.dia + '/' + dt;
          }
        }
        this.tituloDetalhesModal = 'CONSUMO DE AGUA: ' + dt;
      }
      if (tipo == 'energia_cards') {
        this.dadosCards.dia = $('#parametro-dia').val();
        this.dadosCards.mes = $('#parametro-mes').val();
        this.dadosCards.ano = $('#parametro-ano').val();
        this.dadosCards.indicador = 'energia_cards';
        var dt = this.dadosCards.ano;
        if (this.dadosCards.mes) {
          dt = this.dadosCards.mes + '/' + dt;
          if (this.dadosCards.dia) {
            dt = this.dadosCards.dia + '/' + dt;
          }
        }
        this.tituloDetalhesModal = 'CONSUMO DE ENERGIA: ' + dt;
      }
      if (tipo == 'lenha_cards') {
        this.dadosCards.dia = $('#parametro-dia').val();
        this.dadosCards.mes = $('#parametro-mes').val();
        this.dadosCards.ano = $('#parametro-ano').val();
        this.dadosCards.indicador = 'lenha_cards';
        var dt = this.dadosCards.ano;
        if (this.dadosCards.mes) {
          dt = this.dadosCards.mes + '/' + dt;
          if (this.dadosCards.dia) {
            dt = this.dadosCards.dia + '/' + dt;
          }
        }
        this.tituloDetalhesModal = 'CONSUMO DE LENHA: ' + dt;
      }
      if (tipo == 'parada_cards') {
        this.dadosCards.dia = $('#parametro-dia').val();
        this.dadosCards.mes = $('#parametro-mes').val();
        this.dadosCards.ano = $('#parametro-ano').val();
        this.dadosCards.indicador = 'parada_cards';
        var dt = this.dadosCards.ano;
        if (this.dadosCards.mes) {
          dt = this.dadosCards.mes + '/' + dt;
          if (this.dadosCards.dia) {
            dt = this.dadosCards.dia + '/' + dt;
          }
        }
        this.tituloDetalhesModal = 'PARADA DE LINHA: ' + dt;
      }
      if (tipo == 'perdaE_cards') {
        this.dadosCards.dia = $('#parametro-dia').val();
        this.dadosCards.mes = $('#parametro-mes').val();
        this.dadosCards.ano = $('#parametro-ano').val();
        this.dadosCards.indicador = 'perdaE_cards';
        var dt = this.dadosCards.ano;
        if (this.dadosCards.mes) {
          dt = this.dadosCards.mes + '/' + dt;
          if (this.dadosCards.dia) {
            dt = this.dadosCards.dia + '/' + dt;
          }
        }
        this.tituloDetalhesModal = 'PERDAS DE EMBALAGEM: ' + dt;
      }
      if (tipo == 'perdaI_cards') {
        this.dadosCards.dia = $('#parametro-dia').val();
        this.dadosCards.mes = $('#parametro-mes').val();
        this.dadosCards.ano = $('#parametro-ano').val();
        this.dadosCards.indicador = 'perdaI_cards';
        var dt = this.dadosCards.ano;
        if (this.dadosCards.mes) {
          dt = this.dadosCards.mes + '/' + dt;
          if (this.dadosCards.dia) {
            dt = this.dadosCards.dia + '/' + dt;
          }
        }
        this.tituloDetalhesModal = 'PERDAS DE INSUMO: ' + dt;
      }
      if (tipo == 'perdaP_cards') {
        this.dadosCards.dia = $('#parametro-dia').val();
        this.dadosCards.mes = $('#parametro-mes').val();
        this.dadosCards.ano = $('#parametro-ano').val();
        this.dadosCards.indicador = 'perdaP_cards';
        var dt = this.dadosCards.ano;
        if (this.dadosCards.mes) {
          dt = this.dadosCards.mes + '/' + dt;
          if (this.dadosCards.dia) {
            dt = this.dadosCards.dia + '/' + dt;
          }
        }
        this.tituloDetalhesModal = 'PERDAS DE POLPA: ' + dt;
      }
      console.log(this.dadosCards);
      axios.post('/colonial/prod_prev_real-detalhes', this.dadosCards).then(function (res) {
        console.log(res);
        _this6.listaCards = res.data.lista;
      })["catch"](function (err) {
        console.log(err.response.data);
        toastr.error(err.response.data.message, "Erro");
      })["finally"](function () {
        return _this6.modalLoadingCharts = false;
      });
    },
    formatTextLabel: function formatTextLabel(value) {
      var formatNumber = new Intl.NumberFormat();
      value = value.toString();
      return formatNumber.format(value);
      return value.toLocaleString('pt-br', {
        minimumFractionDigits: 2
      });
      var pattern = /(-?\d+)(\d{3})/;
      while (pattern.test(value)) value = value.replace(pattern, "$1,$2");
      return value;
    }
  };
});
/******/ })()
;