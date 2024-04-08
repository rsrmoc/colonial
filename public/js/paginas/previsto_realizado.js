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
    chartPrevReal: null,
    loadingCharts: false,
    modalLoadingCharts: true,
    parametros: {
      dti: null,
      dtf: null,
      agrupamento: '',
      unidade: ''
    },
    init: function init() {
      this.getDataChart1();
    },
    getDataChart1: function getDataChart1() {
      var _this = this;
      this.loadingCharts = true;
      this.parametros.agrupamento = $('#agrupamento').val();
      this.parametros.unidade = $('#unidade').val();
      this.chartPrevReal = null;
      axios.post('/colonial/prod_prev_real-json', this.parametros).then(function (res) {
        _this.parametros.dti = res.data.request.dti;
        _this.parametros.dtf = res.data.request.dtf;
        console.log(res.data);
        _this.chartPrevReal = AmCharts.makeChart(chartPrevReal, {
          "type": "serial",
          "theme": "none",
          "allLabels": [{
            "x": "50%",
            "align": "middle",
            "text": res.data.request.datai + " - " + res.data.request.dataf
          }],
          "dataProvider": res.data.previsto,
          "valueAxes": [{
            "id": "distanceAxis",
            "position": "left",
            "title": "Previsto x Realizado"
          }],
          "graphs": [{
            "alphaField": "alpha",
            "balloonText": "Produzido: [[value]]",
            "dashLengthField": "dashLength",
            "fillAlphas": 1,
            "lineAlpha": 0.0,
            "legendPeriodValueText": "total: [[value.sum]] mi",
            "legendValueText": "[[value]] mi",
            "title": "Realizado",
            "labelText": "[[value]]",
            "colorField": "color",
            "fillColorsField": "color",
            "type": "column",
            "valueField": "realizado",
            "valueAxis": "distanceAxis",
            "labelFunction": function labelFunction(graphDataItem, graph) {
              var value = graphDataItem.values.value;
              value = formatTextLabel(value);
              return value + ' ' + res.data.request.ds_unidade;
            }
          }, {
            "balloonText": "Planejado: [[value]]",
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
            "legendValueText": "[[value]]/[[description]]",
            "title": "latitude/city",
            "fillAlphas": 0,
            "valueField": "latitude",
            "valueAxis": "latitudeAxis"
          }],
          "chartCursor": {
            "categoryBalloonDateFormat": "DD/MM/YYYY",
            "cursorAlpha": 0.1,
            "cursorColor": "#000000",
            "fullWidth": true,
            "valueBalloonsEnabled": false,
            "zoomable": true
          },
          "dataDateFormat": "YYYY-MM-DD",
          "categoryField": "date",
          "categoryAxis": {
            "dateFormats": [{
              "period": "DD",
              "format": "DD"
            }, {
              "period": "WW",
              "format": "MMM DD"
            }, {
              "period": "MM",
              "format": "MMM"
            }, {
              "period": "YYYY",
              "format": "YYYY"
            }],
            "parseDates": false,
            "autoGridCount": false,
            "axisColor": "#555555",
            "gridAlpha": 0.1,
            "gridColor": "#FFFFFF",
            "gridCount": 50
          },
          "listeners": [{
            "event": "clickGraphItem",
            "method": function method(event) {
              _this.getDataChartDetalhes(event.item.dataContext);

              //console.log(event);
              //console.log(event.item.dataContext);
              //alert(event.item.category); 
            }
          }]
        });

        function formatTextLabel(value) {
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
      })["catch"](function (err) {
        toastr.error("error", err);
      })["finally"](function () {
        return _this.loadingCharts = false;
      });
    },
    getDataChartDetalhes: function getDataChartDetalhes(dados) {
      var _this2 = this;
      $("#modalDetalhes").modal();
      this.modalLoadingCharts = true;
      axios.post('/colonial/prod_prev_real-detalhes', dados).then(function (res) {
        console.log(res);
        var chart = AmCharts.makeChart("chartDetalhe", {
          "type": "serial",
          "theme": "none",
          "marginRight": 0,
          "marginLeft": 0,
          "dataProvider": res.data.dias,
          "startDuration": 1,
          "graphs": [{
            "balloonText": "<b>[[category]]: [[value]]</b>",
            "fillColorsField": "color",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "labelText": "[[value]]",
            "type": "column",
            "valueField": "visits"
          }, {
            "balloonText": "latitude:[[value]]",
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
          }],
          "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
          },
          "categoryField": "country",
          "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 45
          }
        });
      })["catch"](function (err) {
        toastr.error("error", err);
      })["finally"](function () {
        return _this2.modalLoadingCharts = false;
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