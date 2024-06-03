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
    titleMoagemDiaria: 'Moagem Diária ',
    titleMoagemDiariaEstoque: 'Entrada de Polpas Diária para o Estoque ',
    titleMoagemDiariaConsumida: 'Entrada de Polpas Diária Consumida ',
    titleComparacaoFornec: 'Comparação entre Fornecedores ',
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
      this.getDataChartPrincipal();
    },
    getDataChartPrincipal: function getDataChartPrincipal() {
      var _this2 = this;
      this.loadingCharts = true;
      this.parametros.dia = $('#parametro-dia').val();
      this.parametros.mes = $('#parametro-mes').val();
      this.parametros.ano = $('#parametro-ano').val();
      this.parametros.unidade = $('#parametro-visao').val();
      console.log(this.parametros);
      axios.post('/colonial/safra-json', this.parametros).then(function (res) {
        console.log(res);
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