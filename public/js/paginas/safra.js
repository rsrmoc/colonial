/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/paginas/safra.js ***!
  \***************************************/
var chart1Ctx = document.querySelector('#chart-1');
var chart2Ctx = document.querySelector('#chart-2');
var chart3Ctx = document.querySelector('#chart-3');
var chart4Ctx = document.querySelector('#chart-4');
var chartPrevReal = document.querySelector('#chart-prev_realizado');
Alpine.data('app', function () {
  return {
    graficoBarra: "<div style='text-align: center;margin-top: 110px;'> <img src='/assets/images/grafico-barra.png'> </div>",
    graficoBarraTipo: "<div style='text-align: center;margin-top: 40px;'> <img src='/assets/images/grafico-barra.png'> </div>",
    graficoBarra2: "<div style='text-align: center;margin-top: 25px;'> <img src='/assets/images/grafico-barra.png'> </div>",
    graficoPizza: "<div style='text-align: center;margin-top: 110px;'> <img src='/assets/images/grafico-pizza.png'> </div>",
    iconCarregando: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderMoagemTotal: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderMoagemTotalTb: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderMoagemEstoque: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderMoagemEstoqueTb: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderMoagemConsumida: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderMoagemConsumidaTb: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderTomateInNatura: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderBrix: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderBrixMedio: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderPerdas: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderPerdasPerc: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderMoagemDiaria: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderMoagemDiariaTb: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderMoagemEstDiaria: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderMoagemEstDiariaTb: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderDataDiaria: null,
    titleMoagemDiaria: 'Produção de Polpas Diária ',
    titleMoagemDiariaEstoque: 'Entrada de Polpas Diária para o Estoque ',
    titleMoagemDiariaConsumida: 'Entrada de Polpas Diária Consumida ',
    titleComparacaoFornec: 'Comparação entre Fornecedores ',
    titleMoagem: 'Moagem Diária ',
    tableFornecedores: null,
    tituloDetalhesModal: null,
    modalLoadingCharts: false,
    dadosRecTomate: null,
    dadosModalMoagemDiaria: null,
    parametros: {
      valida: false,
      dti: null,
      dtf: null,
      agrupamento: '',
      unidade: '',
      ano: '',
      mes: '',
      dia: '',
      tipo: ''
    },
    TotDias: 0,
    TotMeses: null,
    loadingCharts: false,
    init: function init() {
      var _this = this;
      $('#indicadores-parametros #parametro-ano').on('select2:select', function () {
        var Ano = $('#indicadores-parametros #parametro-ano').val();
        var Mes = $('#indicadores-parametros #parametro-mes').val();
        console.log(Ano + ' - M' + Mes);
        if (Ano) {
          if (Mes) {
            _this.TotDias = _this.TotMeses[Ano][Number(Mes)];
          }
        }
      });
      $('#indicadores-parametros #parametro-mes').on('select2:select', function () {
        var Ano = $('#indicadores-parametros #parametro-ano').val();
        var Mes = $('#indicadores-parametros #parametro-mes').val();
        console.log(Ano + ' - M' + Mes);
        if (Ano) {
          if (Mes) {
            _this.TotDias = _this.TotMeses[Ano][Number(Mes)];
          }
        }
      });
      this.getDataChartPrincipal();
    },
    getDetalhesMoagemDiaria: function getDetalhesMoagemDiaria(dados) {
      var _this2 = this;
      this.tituloDetalhesModal = "Moagem Diaria - " + dados.label;
      $("#modalMoagemDiaria").modal();
      this.modalLoadingCharts = true;
      console.log(dados);
      axios.post('/colonial/safra-detalhes', dados).then(function (res) {
        console.log(res);
        _this2.dadosModalMoagemDiaria = res.data.lista;
      })["catch"](function (err) {
        console.log(err.response.data);
        toastr.error(err.response.data.message, "Erro");
      })["finally"](function () {
        return _this2.modalLoadingCharts = false;
      });
    },
    getDataChartPrincipal: function getDataChartPrincipal() {
      var _this3 = this;
      this.loadingCharts = true;
      this.parametros.dia = $('#parametro-dia').val();
      this.parametros.mes = $('#parametro-mes').val();
      this.parametros.ano = $('#parametro-ano').val();
      this.parametros.unidade = $('#parametro-visao').val();
      this.iconHeaderMoagemTotal = this.iconCarregando;
      this.iconHeaderMoagemTotalTb = this.iconCarregando;
      this.iconHeaderMoagemEstoque = this.iconCarregando;
      this.iconHeaderMoagemEstoqueTb = this.iconCarregando;
      this.iconHeaderMoagemConsumida = this.iconCarregando;
      this.iconHeaderMoagemConsumidaTb = this.iconCarregando;
      this.iconHeaderTomateInNatura = this.iconCarregando;
      this.iconHeaderBrix = this.iconCarregando;
      this.iconHeaderPerdas = this.iconCarregando;
      this.iconHeaderPerdasPerc = this.iconCarregando;
      this.iconHeaderMoagemDiaria = this.iconCarregando;
      this.iconHeaderMoagemDiariaTb = this.iconCarregando;
      this.iconHeaderMoagemEstDiaria = this.iconCarregando;
      this.iconHeaderMoagemEstDiariaTb = this.iconCarregando;
      this.iconHeaderDataDiaria = null;
      axios.post('/colonial/safra-json', this.parametros).then(function (res) {
        console.log(res);
        _this3.iconHeaderMoagemTotal = res.data.request.MoagemTotalKg + '<span class="headerUnidade"> (T) </span>';
        _this3.iconHeaderMoagemTotalTb = res.data.request.MoagemTotalTb + '<span class="headerUnidade"> (Tb) </span>';
        _this3.iconHeaderMoagemEstoque = res.data.request.MoagemEstoqueKg + '<span class="headerUnidade"> (T) </span>';
        _this3.iconHeaderMoagemEstoqueTb = res.data.request.MoagemEstoqueTb + '<span class="headerUnidade"> (Tb) </span>';
        _this3.iconHeaderMoagemConsumida = res.data.request.MoagemConsumidaKg + '<span class="headerUnidade"> (T) </span>';
        _this3.iconHeaderMoagemConsumidaTb = res.data.request.MoagemConsumidaTb + '<span class="headerUnidade"> (Tb) </span>';
        _this3.iconHeaderTomateInNatura = res.data.request.TomateInNatura + '<span class="headerUnidade"> (Kg) </span>';
        _this3.iconHeaderBrix = res.data.request.Brix + '<span class="headerUnidade">   </span>';
        _this3.iconHeaderPerdas = res.data.request.PerdasTotal + '<span class="headerUnidade"> (Kg) </span>';
        _this3.iconHeaderPerdasPerc = res.data.request.PerdasTotalPerc + '<span class="headerUnidade"> (%) </span>';
        _this3.iconHeaderMoagemDiaria = res.data.request.MoagemDiariaKg + '<span class="headerUnidade"> (T) </span>';
        _this3.iconHeaderMoagemDiariaTb = res.data.request.MoagemDiariaTb + '<span class="headerUnidade"> (Tb) </span>';
        _this3.iconHeaderMoagemEstDiaria = res.data.request.MoagemEstDiariaKg + '<span class="headerUnidade"> (T) </span>';
        _this3.iconHeaderMoagemEstDiariaTb = res.data.request.MoagemEstDiariaTb + '<span class="headerUnidade"> (Tb) </span>';
        _this3.iconHeaderDataDiaria = res.data.request.Datadiaria;
        _this3.parametros.dti = res.data.request.dti;
        _this3.parametros.dtf = res.data.request.dtf;
        _this3.tableFornecedores = res.data.table_fornecedor;

        /* Grafico Moagem Diaria */
        _this3.titleMoagem = 'Moagem Diária [ T ]  ';
        var chart = AmCharts.makeChart("chartdivMoagemDiaria", {
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
          "graphs": [{
            "balloonText": "Produzido : <b>[[value]]    </b>",
            "fillAlphas": 1,
            "id": "AmGraph-1",
            "lineAlpha": 0.2,
            "title": "% de Produção",
            "labelText": "[[value]]",
            "type": "column",
            "valueField": "producao",
            "fillColorsField": "color_producao",
            "lineColor": "#ff3f33"
          }],
          "valueAxes": [{
            "axisAlpha": 0.2,
            "id": "v1",
            "minimum": 0
          }],
          "listeners": [{
            "event": "clickGraphItem",
            "method": function method(event) {
              _this3.getDetalhesMoagemDiaria(event.item.dataContext);
            }
          }],
          "dataProvider": res.data.MoagemDiaria
        });
        if (!res.data.MoagemDiaria) {
          $("#chartdivMoagemDiaria").html(_this3.graficoBarra);
        }

        /* Grafico Moagem Diaria */
        _this3.titleMoagemDiaria = 'Produção de Polpa Diária  [ T ] ';
        var chart = AmCharts.makeChart("chartdivMoagemTotal", {
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
          "graphs": [{
            "balloonText": "Produzido : <b>[[value]]   </b>",
            "fillAlphas": 1,
            "id": "AmGraph-1",
            "lineAlpha": 0.2,
            "title": "% de Produção",
            "labelText": "[[value]]",
            "type": "column",
            "valueField": "producao",
            "fillColorsField": "color_producao",
            "lineColor": "#ff3f33"
          }],
          "valueAxes": [{
            "axisAlpha": 0.2,
            "id": "v1",
            "minimum": 0
          }],
          "listeners": [{
            "event": "clickGraphItem",
            "method": function method(event) {

              // this.getDetalhesPolpaTotal(event.item.dataContext); 
            }
          }],
          "dataProvider": res.data.MoagemTotal
        });
        if (!res.data.MoagemTotal) {
          $("#chartdivMoagemTotal").html(_this3.graficoBarra);
        }

        /* Grafico Moagem Consumida */
        _this3.titleMoagemDiariaConsumida = 'Polpas Consumida Diária ' + res.data.request.ds_unid;
        var chart = AmCharts.makeChart("chartdivMoagemConsumida", {
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
          "graphs": [{
            "balloonText": "Produzido : <b>[[value]]   </b>",
            "fillAlphas": 1,
            "id": "AmGraph-1",
            "lineAlpha": 0.2,
            "title": "% de Produção",
            "labelText": "[[value]]",
            "type": "column",
            "valueField": "producao",
            "fillColorsField": "color_producao",
            "lineColor": "#ff7519"
          }],
          "valueAxes": [{
            "axisAlpha": 0.2,
            "id": "v1",
            "minimum": 0
          }],
          "listeners": [{
            "event": "clickGraphItem",
            "method": function method(event) {

              //this.getDetalhesProducao(event.item.dataContext); 
            }
          }],
          "dataProvider": res.data.MoagemConsumida
        });
        if (!res.data.MoagemConsumida) {
          $("#chartdivMoagemConsumida").html(_this3.graficoBarra);
        }

        /* Grafico Moagem Estoque */
        _this3.titleMoagemDiariaEstoque = 'Entrada de Polpas para o Estoque Diária ' + res.data.request.ds_unid;
        var chart = AmCharts.makeChart("chartdivMoagemEstoque", {
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
          "graphs": [{
            "balloonText": "Produzido : <b>[[value]]   </b>",
            "fillAlphas": 1,
            "id": "AmGraph-1",
            "lineAlpha": 0.2,
            "title": "% de Produção",
            "labelText": "[[value]]",
            "type": "column",
            "valueField": "producao",
            "fillColorsField": "color_producao",
            "lineColor": "#ff7519"
          }],
          "valueAxes": [{
            "axisAlpha": 0.2,
            "id": "v1",
            "minimum": 0
          }],
          "listeners": [{
            "event": "clickGraphItem",
            "method": function method(event) {

              //this.getDetalhesProducao(event.item.dataContext); 
            }
          }],
          "dataProvider": res.data.MoagemEstoque
        });
        if (!res.data.MoagemEstoque) {
          $("#chartdivMoagemEstoque").html(_this3.graficoBarra);
        }

        /* Grafico Fornecedores */
        var chart = AmCharts.makeChart("chartdivFornecedor", {
          "decimalSeparator": ",",
          "thousandsSeparator": ".",
          "fontSize": 11,
          "type": "serial",
          "theme": "none",
          "rotate": true,
          "dataProvider": res.data.Fornecedores,
          "startDuration": 1,
          "graphs": [{
            "balloonText": "<b>[[category]]: [[value]]   </b>",
            "fillColorsField": "color",
            "fillAlphas": 0.9,
            "labelText": "[[value]]",
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "qtde",
            "fixedColumnWidth": 50
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
        if (!res.data.Fornecedores) {
          $("#chartdivFornecedor").html(_this3.graficoBarra);
        }

        /* Grafico Qualidade */
        var chart = AmCharts.makeChart("chartdivQualidade", {
          "decimalSeparator": ",",
          "thousandsSeparator": ".",
          "fontSize": 11,
          "type": "serial",
          "theme": "none",
          "rotate": true,
          "dataProvider": res.data.Qualidade,
          "startDuration": 1,
          "graphs": [{
            "balloonText": "<b>[[category]]: [[value]]  </b>",
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
        if (!res.data.Qualidade) {
          $("#chartdivQualidade").html(_this3.graficoBarra);
        }

        /* Grafico Qualidade Prod. */
        var chart = AmCharts.makeChart("chartdivQualidadeProd", {
          "decimalSeparator": ",",
          "thousandsSeparator": ".",
          "fontSize": 11,
          "type": "serial",
          "theme": "none",
          "rotate": true,
          "dataProvider": res.data.QualidadeProd,
          "startDuration": 1,
          "graphs": [{
            "balloonText": "<b>[[category]]: [[value]]  </b>",
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
        if (!res.data.QualidadeProd) {
          $("#chartdivQualidadeProd").html(_this3.graficoBarra);
        }
        _this3.TotMeses = res.data.request.Meses;
        _this3.parametros.valida = true;
        $('#indicadores-parametros #parametro-ano').val(res.data.request.ano).trigger('change');
        $('#indicadores-parametros #parametro-mes').val(res.data.request.mes).trigger('change');
        if (res.data.request.ano) {
          if (res.data.request.mes) {
            _this3.TotDias = _this3.TotMeses[res.data.request.ano][Number(res.data.request.mes)];
          }
        }
      })["catch"](function (err) {
        console.log(err.response.data);
        toastr.error(err.response.data.message, "Erro");
      })["finally"](function () {
        return _this3.loadingCharts = false;
      });
    },
    xls: function xls(tipo) {
      location.href = '/colonial/safra-xls/' + tipo + '?dtf=' + this.parametros.dtf + '&dti=' + this.parametros.dti;
      toastr['success']('XLS gerado com sucesso');
    },
    cards: function cards(tipo) {
      var _this4 = this;
      this.tituloDetalhesModal = "";
      if (tipo == 'rec_tomate') {
        this.tituloDetalhesModal = "Recebimento de Tomate ";
      }
      $("#modalRecTomate").modal();
      this.modalLoadingCharts = true;
      this.parametros.tipo = tipo;
      console.log(this.parametros);
      axios.post('/colonial/safra-detalhes', this.parametros).then(function (res) {
        console.log(res);
        _this4.dadosRecTomate = res.data.lista;
      })["catch"](function (err) {
        console.log(err.response.data);
        toastr.error(err.response.data.message, "Erro");
      })["finally"](function () {
        return _this4.modalLoadingCharts = false;
      });
    }
  };
});
/******/ })()
;