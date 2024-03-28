/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************!*\
  !*** ./resources/js/paginas/clientes.js ***!
  \******************************************/
Alpine.data('app', function () {
  return {
    loadingEnviarHistorico: false,
    loadingDetalhesBoletosAtrasados: false,
    boletoSelecionado: null,
    boletosAtrasados: [],
    inputsNegociacao: {
      dt_negociacao: null,
      nr_contato: null,
      email_cliente: null,
      valor: null,
      obs: null
    },
    loadingNegociacao: false,
    clienteNegociacoes: [],
    negociacaoSelecionada: null,
    loadingBoletoNegociacao: false,
    inputFormHistorico: null,
    loadingFormHistorico: false,
    editCDHistorico: null,
    historicosCliente: [],
    verDetalhes: function verDetalhes(boleto) {
      var _this = this;
      this.boletosAtrasados = [];
      this.clienteNegociacoes = [];
      this.boletoSelecionado = boleto;
      this.loadingDetalhesBoletosAtrasados = true;
      axios.get("".concat(API_URL, "/clientes-boletos-abertos"), {
        params: {
          cpf_cnpj: boleto.cpf_cnpj
        }
      }).then(function (res) {
        _this.boletosAtrasados = res.data.boletos;
        _this.clienteNegociacoes = res.data.negociacoes;
        _this.historicosCliente = res.data.historico;
      })["catch"](function (error) {
        return toastr['error'](error.response.data.message);
      })["finally"](function () {
        return _this.loadingDetalhesBoletosAtrasados = false;
      });
    },
    clearInputsNegociacao: function clearInputsNegociacao() {
      this.inputsNegociacao = {
        dt_negociacao: null,
        nr_contato: null,
        email_cliente: null,
        valor: null,
        obs: null
      };
    },
    salvarNegociacao: function salvarNegociacao() {
      var _this2 = this,
        _this$boletoSeleciona,
        _this$boletoSeleciona2,
        _this$boletoSeleciona3;
      this.loadingNegociacao = true;
      if (this.inputsNegociacao.cd_negociacao) {
        axios.put("".concat(API_URL, "/negociacao"), this.inputsNegociacao).then(function (res) {
          var indexNegociacao = _this2.clienteNegociacoes.findIndex(function (negociacao) {
            return negociacao.cd_negociacao == _this2.inputsNegociacao.cd_negociacao;
          });
          _this2.clienteNegociacoes[indexNegociacao] = res.data.negociacao;
          toastr['success'](res.data.message);
          _this2.clearInputsNegociacao();
        })["catch"](function (err) {
          return parseErrorsAPI(err.response.data.errors, err.response.data.message);
        })["finally"](function () {
          return _this2.loadingNegociacao = false;
        });
        return;
      }
      var data = Object.assign({}, this.inputsNegociacao);
      data.cd_condominio = (_this$boletoSeleciona = this.boletoSelecionado) === null || _this$boletoSeleciona === void 0 ? void 0 : _this$boletoSeleciona.condominio.cd_condominio;
      data.cpf_cnpj_cliente = (_this$boletoSeleciona2 = this.boletoSelecionado) === null || _this$boletoSeleciona2 === void 0 ? void 0 : _this$boletoSeleciona2.cpf_cnpj;
      data.nm_cliente = (_this$boletoSeleciona3 = this.boletoSelecionado) === null || _this$boletoSeleciona3 === void 0 ? void 0 : _this$boletoSeleciona3.nm_cliente;
      axios.post("".concat(API_URL, "/negociacao"), data).then(function (res) {
        toastr['success'](res.data.message);
        _this2.clearInputsNegociacao();
        _this2.clienteNegociacoes.push(res.data.negociacao);
      })["catch"](function (err) {
        return parseErrorsAPI(err.response.data.errors, err.response.data.message);
      })["finally"](function () {
        return _this2.loadingNegociacao = false;
      });
    },
    deleteNegociacao: function deleteNegociacao(cdNegociacao) {
      var _this3 = this;
      Swal.fire({
        title: 'Confirmação',
        text: "Tem certeza que deseja excluir essa negociação?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Não',
        confirmButtonText: 'Sim'
      }).then(function (result) {
        if (result.isConfirmed) {
          axios["delete"]("".concat(API_URL, "/negociacao/").concat(cdNegociacao)).then(function (res) {
            var indexNegociacao = _this3.clienteNegociacoes.findIndex(function (negociacao) {
              return negociacao.cd_negociacao == cdNegociacao;
            });
            _this3.clienteNegociacoes.splice(indexNegociacao, 1);
            toastr['success'](res.data.message);
          })["catch"](function (err) {
            return parseErrorsAPI(err.response.data.errors);
          })["finally"](function () {
            return _this3.loadingBoletoNegociacao = false;
          });
        }
      });
    },
    setFormNegociacaoEdit: function setFormNegociacaoEdit(negociacao) {
      Object.assign(this.inputsNegociacao, negociacao);
    },
    openModalNegociacao: function openModalNegociacao(negociacao) {
      this.negociacaoSelecionada = Object.assign({}, negociacao);
      $('#boletos-atrasados-negociacao').select2({
        data: this.boletosAtrasados.map(function (boleto) {
          return {
            id: boleto.cd_boleto,
            text: "".concat(boleto.id_boleto, " | ").concat(boleto.tipo_conta, " | ").concat(boleto.vl_boleto)
          };
        })
      });
      $('#negociaao-modal').modal('show');
    },
    addBoletoNegociacao: function addBoletoNegociacao() {
      var _this4 = this;
      if (this.negociacaoSelecionada.boletos.find(function (boleto) {
        return boleto.cd_boleto == $('#boletos-atrasados-negociacao').val();
      })) {
        toastr['error']('Boleto já foi adicionado!');
        return;
      }
      this.loadingBoletoNegociacao = true;
      axios.post("".concat(API_URL, "/negociacao-boleto"), {
        cd_negociacao: this.negociacaoSelecionada.cd_negociacao,
        cd_boleto: $('#boletos-atrasados-negociacao').val()
      }).then(function (res) {
        _this4.negociacaoSelecionada.boletos.push(res.data.negociacao_boleto);
        toastr['success'](res.data.message);
        $('#boletos-atrasados-negociacao').val(null).trigger('change');
      })["catch"](function (err) {
        return parseErrorsAPI(err.response.data.errors);
      })["finally"](function () {
        return _this4.loadingBoletoNegociacao = false;
      });
    },
    deleteBoletoNegociacao: function deleteBoletoNegociacao(cdNegociacaoBoleto) {
      var _this5 = this;
      Swal.fire({
        title: 'Confirmação',
        text: "Tem certeza que deseja remover esse boleto?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Não',
        confirmButtonText: 'Sim'
      }).then(function (result) {
        if (result.isConfirmed) {
          axios["delete"]("".concat(API_URL, "/negociacao-boleto/").concat(cdNegociacaoBoleto)).then(function (res) {
            var indexBoletoNegociacao = _this5.negociacaoSelecionada.boletos.findIndex(function (boleto) {
              return boleto.cd_negociacao_boleto == cdNegociacaoBoleto;
            });
            _this5.negociacaoSelecionada.boletos.splice(indexBoletoNegociacao, 1);
            toastr['success'](res.data.message);
          })["catch"](function (err) {
            return parseErrorsAPI(err.response.data.errors);
          })["finally"](function () {
            return _this5.loadingBoletoNegociacao = false;
          });
        }
      });
    },
    enviarHistorico: function enviarHistorico() {},
    cadastrarHistorico: function cadastrarHistorico() {
      var _this6 = this;
      this.loadingFormHistorico = true;
      if (this.editCDHistorico) {
        var _data = {
          cd_historico: this.editCDHistorico,
          historico: this.inputFormHistorico
        };
        axios.put("".concat(API_URL, "/historico-cliente"), _data).then(function (res) {
          var indexHistorico = _this6.historicosCliente.findIndex(function (historico) {
            return historico.cd_historico == _this6.editCDHistorico;
          });
          _this6.historicosCliente[indexHistorico] = res.data.historico;
          _this6.clearEdicaoHistorico();
          toastr['success'](res.data.message);
        })["catch"](function (err) {
          return parseErrorsAPI(err.response.data.errors);
        })["finally"](function () {
          return _this6.loadingFormHistorico = false;
        });
        return;
      }
      var data = {
        cpf_cnpj_cliente: this.boletoSelecionado.cpf_cnpj,
        historico: this.inputFormHistorico
      };
      axios.post("".concat(API_URL, "/historico-cliente"), data).then(function (res) {
        _this6.historicosCliente.push(res.data.historico);
        _this6.inputFormHistorico = null;
        toastr['success'](res.data.message);
      })["catch"](function (err) {
        return parseErrorsAPI(err.response.data.errors);
      })["finally"](function () {
        return _this6.loadingFormHistorico = false;
      });
    },
    setEdicaoHistorico: function setEdicaoHistorico(historico) {
      this.editCDHistorico = historico.cd_historico;
      this.inputFormHistorico = historico.historico;
    },
    clearEdicaoHistorico: function clearEdicaoHistorico() {
      this.editCDHistorico = null;
      this.inputFormHistorico = null;
    },
    excluirHistorico: function excluirHistorico(cdHistorico) {
      var _this7 = this;
      Swal.fire({
        title: 'Confirmação',
        text: "Tem certeza que deseja remover esse historico?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Não',
        confirmButtonText: 'Sim'
      }).then(function (result) {
        if (result.isConfirmed) {
          axios["delete"]("".concat(API_URL, "/historico-cliente/").concat(cdHistorico)).then(function (res) {
            var indexHistorico = _this7.historicosCliente.findIndex(function (historico) {
              return historico.cd_historico == cdHistorico;
            });
            _this7.historicosCliente.splice(indexHistorico, 1);
            toastr['success'](res.data.message);
          })["catch"](function (err) {
            return parseErrorsAPI(err.response.data.errors);
          })["finally"](function () {
            return _this7.loadingBoletoNegociacao = false;
          });
        }
      });
    }
  };
});
$(document).ready(function () {
  $('#cadastro-consulta, #negociaao-modal').modal({
    backdrop: 'static',
    show: false
  });
});
/******/ })()
;