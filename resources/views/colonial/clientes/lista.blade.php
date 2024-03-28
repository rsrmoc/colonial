<x-layout.brcondos_adv.layout>

    <div class="page-title">
        <h3>CLientes</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('controle-listar') }}">Relação</a></li>
            </ol>
        </div>
    </div>
    <style>
        .btn-xs {
            padding: 0px 10px;
        }

        .label-purple {
            color: white !important;
            border-color: #9585bf;
            background: #9585bf !important;
        }
    </style>
    <div id="app" x-data="app">
        <div class="col-md-12 ">
            <div class="panel panel-white" style="padding-bottom: 0px;">
                <div class="panel-heading" style="height: auto; padding-bottom: 0px;">

                    <form method="GET" class="panel panel-white"
                        style="margin-bottom: 15px;">

                        <div class="row"> 
                            <div class="col-md-2">
                                <div class="form-group @if ($errors->has('dti')) has-error @endif ">
                                    <input type="date" class="form-control" value="{{ old('dti', $request['dti']) }}"
                                        placeholder="Data Inicial" name="dti" required />
                                    @if ($errors->has('dti'))
                                        <div class="error">{{ $errors->first('dti') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group @if ($errors->has('dtf')) has-error @endif ">
                                    <input type="date" class="form-control" value="{{ old('dtf', $request['dtf']) }}"
                                        placeholder="Data Final" name="dtf" required />
                                    @if ($errors->has('dtf'))
                                        <div class="error">{{ $errors->first('dtf') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group @if ($errors->has('nome')) has-error @endif ">
                                    <input type="text" class="form-control"
                                        value="{{ old('nome', $request['nome']) }}" placeholder="Nome do Cliente"
                                        name="nome" />
                                    @if ($errors->has('nome'))
                                        <div class="error">{{ $errors->first('nome') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group @if ($errors->has('cpf')) has-error @endif ">
                                    <input type="text" class="form-control" value="{{ old('cpf', $request['cpf']) }}"
                                        placeholder="Cnpj/Cpf" name="cpf"
                                        x-mask:dynamic="$input.length > 14
                                            ? '99.999.999/9999-99' : '999.999.999-99'" />
                                    @if ($errors->has('cpf'))
                                        <div class="error">{{ $errors->first('cpf') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group @if ($errors->has('titulo')) has-error @endif ">
                                    <input type="text" class="form-control"
                                        value="{{ old('titulo', $request['titulo']) }}" placeholder="Titulo"
                                        name="titulo" />
                                    @if ($errors->has('titulo'))
                                        <div class="error">{{ $errors->first('titulo') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                     

                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group @if ($errors->has('condominio')) has-error @endif ">
                                    <select class="form-control" name="condominio" id="select-condominio">
                                        <option value="">Condomínio</option>
                                        @foreach ($condominios as $tab)
                                            <option value="{{ $tab->cd_condominio }}"
                                                @if (old('condominio', $request['condominio']) == $tab->cd_condominio) selected @endif>
                                                {{ $tab->nm_condominio }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('condominio'))
                                        <div class="error">{{ $errors->first('condominio') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group @if ($errors->has('bloco')) has-error @endif ">
                                    <input type="text" class="form-control"
                                        value="{{ old('bloco', $request['bloco']) }}" placeholder="Bloco / Apto"
                                        name="bloco" />
                                    @if ($errors->has('bloco'))
                                        <div class="error">{{ $errors->first('bloco') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class=" col-md-12 btn btn-success">
                                    <i class="fa fa-search-plus"></i> Pesquisar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="panel-body">
                    <table class="table table-striped" style="margin-bottom: 0">
                        <thead>
                            <tr class="active">
                                <th>Cliente</th>
                                <th>Nome </th>
                                <th>Condomínio</th>
                                <th>Unidade</th>
                                <th class="text-right">Qtde. em Aberto</th>
                                <th class="text-right">Valor em Aberto</th>
                                <th class="text-right">Qtde. em Atraso</th>
                                <th class="text-right">Valor em Atraso</th>   
                                <th class="text-center">Detalhes</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <th>{{ $cliente->cpf_cnpj }}</th>
                                    <td>{{ $cliente->nm_cliente }}</td>
                                    <td>{{ $cliente->condominio->nm_condominio }}</td>
                                    <td>{{ $cliente->bloco_apto }}</td> 
                                    <td class="text-right">{{ $cliente->qtde}}</td>
                                    <td class="text-right">{{ $cliente->valor }}</td>
                                    <td class="text-right"></td>
                                    <td class="text-right"></td>
                                    <td class="text-center" style="padding: 3px!important;">
                                        <img height="22" style="cursor: pointer" data-toggle="modal"
                                            data-target="#cadastro-consulta"
                                            {{-- src="http://brcondos.test/assets/images/detalhes.png" --}}
                                            src="{{ asset('assets/images/detalhes.png') }}"
                                            x-on:click="verDetalhes({{ $cliente }})">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div style="display: flex; justify-content:center; margin-top: 12px">
                        {{ $clientes->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="cadastro-consulta">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header m-b-sm">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <h4 class="modal-title" style="font-size: 20px; font-weight: 300; color: #74767d;">
                            <span x-text="`${boletoSelecionado?.nm_cliente} #${boletoSelecionado?.cpf_cnpj}`"></span>
                        </h4>
                    </div>

                    <div class="modal-body">

                        <div class="panel-body" style="padding: 0px;">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-justified" role="tablist">
                                <li role="presentation" class="active"><a href="#tab-fatura" role="tab"
                                        data-toggle="tab">Dados do Cliente</a></li>
                                <li role="presentation"><a href="#tab-neg" role="tab"
                                        data-toggle="tab">Negociação</a></li>
                                <li role="presentation"><a href="#tab-historico" role="tab"
                                        data-toggle="tab">Historico</a></li>
                                <li role="presentation"><a href="#tab-envio" role="tab"
                                        data-toggle="tab">Envios</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active fade in" id="tab-fatura">

                                    <table class="table table-striped table-hover">
                                        <tbody>
                                            <tr>
                                                <td colspan="3">
                                                    <label style=" font-weight: 700; ">Nome do Cliente: </label>
                                                    <span x-text="boletoSelecionado?.nm_cliente"></span>
                                                </td>
                                                <td colspan="3">
                                                    <label style=" font-weight: 700; ">CPF: </label>
                                                    <span x-text="boletoSelecionado?.cpf_cnpj"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <label style=" font-weight: 700; ">Condomínio: </label>
                                                    <span x-text="boletoSelecionado?.condominio.nm_condominio"></span>
                                                </td>
                                                <td>
                                                    <label style=" font-weight: 700; ">BLoco: </label>
                                                    <span x-text="boletoSelecionado?.bloco_apto"></span>
                                                </td>
                                            </tr> 
                                        </tbody>
                                    </table>

                                    <table class="table table-striped" style="margin-bottom: 0">
                                        <thead>
                                            <tr>
                                                <th colspan="7" class="text-center" style="font-size: 17px;  font-weight: 400; color: #74767d;">Relação de Boletos em Abertos</th>
                                            </tr>
                                            <tr class="active">
                                                <th>Boleto</th>
                                                <th>Tipo </th>
                                                <th>Emissão </th>
                                                <th>Vencimento</th>
                                                <th>Documento</th> 
                                                <th class="text-right">Valor</th>
                                                <th class="text-center">Situação</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <template x-for="boleto in boletosAtrasados">
                                                <tr>
                                                    <th x-text="boleto.id_boleto"></th>
                                                    <th x-text="boleto.tipo_conta"></th>
                                                    <th x-text="formatDate(boleto.dt_emissao)"></th>
                                                    <th x-text="formatDate(boleto.dt_vencimento)"></th>
                                                    <th x-text="boleto.nr_documento"></th> 
                                                    <th class="text-right" x-text="boleto.vl_boleto"></th>
                                                    <th class="text-center"><span  class="label label-danger"
                                                        x-text="boleto.status"></span>
                                                    </th>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>

                                    <template x-if="loadingDetalhesBoletosAtrasados">
                                        <x-loader />
                                    </template>

                                    <template x-if="!loadingDetalhesBoletosAtrasados && boletosAtrasados.length == 0">
                                        <p class="text-center" style="padding-top: 24px">Nenhum boleto atrasado</p>
                                    </template>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="tab-neg">
                                    <table class="table table-striped table-hover">
                                        <tbody>
                                            <tr>
                                                <td colspan="3">
                                                    <label style=" font-weight: 700; ">Nome do Cliente: </label>
                                                    <span x-text="boletoSelecionado?.nm_cliente"></span>
                                                </td>
                                                <td colspan="3">
                                                    <label style=" font-weight: 700; ">CPF: </label>
                                                    <span x-text="boletoSelecionado?.cpf_cnpj"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <label style=" font-weight: 700; ">Condomínio: </label>
                                                    <span x-text="boletoSelecionado?.condominio.nm_condominio"></span>
                                                </td>
                                                <td>
                                                    <label style=" font-weight: 700; ">BLoco: </label>
                                                    <span x-text="boletoSelecionado?.bloco_apto"></span>
                                                </td>
                                            </tr> 
                                        </tbody>
                                    </table>

                                    <form class="col-md-12" x-on:submit.prevent="salvarNegociacao">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group " >
                                                    <label for="fname">Data da Negociação: <span class="red normal">*</span></label>
                                                    <input type="date" class="form-control required" required
                                                        x-model="inputsNegociacao.dt_negociacao" />
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group " >
                                                    <label for="fname">Nr. do Contato: <span class="red normal">*</span></label>
                                                    <input type="text" class="form-control required" required
                                                        x-model="inputsNegociacao.nr_contato" x-mask="(99) 99999-9999" />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group " >
                                                    <label for="fname">Email do Cliente: <span class="red normal">*</span></label>
                                                    <input type="email" class="form-control required" required
                                                        x-model="inputsNegociacao.email_cliente" />
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group " >
                                                    <label for="fname">Valor : <span class="red normal">*</span></label>
                                                    <input type="text" class="form-control required" required
                                                        x-model="inputsNegociacao.valor" x-mask:dynamic="$money($input, ',' ,'.')" />
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group"> 
                                                    <textarea class="form-control" id="exampleInputEmail1" style="height: 120px"
                                                        x-model="inputsNegociacao.obs"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px">
                                            <button type="submit" class="btn btn-primary" x-bind:disabled="loadingNegociacao">Salvar</button>

                                            <template x-if="inputsNegociacao.cd_negociacao">
                                                <button type="reset" class="btn btn-light" x-bind:disabled="loadingNegociacao" x-on:click="clearInputsNegociacao">Cancelar</button>
                                            </template>

                                            <template x-if="loadingNegociacao">
                                                <x-loader style="padding: 0 !important" />
                                            </template>
                                        </div>
                                    </form>
                                    
                                    <table class="table table-striped table-vertical-middle" style="margin-bottom: 0; margin-top: 10px;">
                                        <thead>
                                            <tr  >
                                                <th colspan="10" class="text-center" style="font-size: 17px;  font-weight: 400; color: #74767d;">Relação de Negocições em Abertos</th>
                                            </tr>
                                            <tr class="active">
                                                <th>Negociação</th> 
                                                <th>Titulo</th> 
                                                <th>Data </th>
                                                <th>Emissão</th>
                                                <th>Vencimento</th> 
                                                <th>Documento</th> 
                                                <th>Responsável</th> 
                                                <th class="text-right">Valor</th>   
                                                <th class="text-center">Situação</th>
                                                <th class="text-center">Ações</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            <template x-for="negociacao in clienteNegociacoes">
                                                <tr>
                                                    <th x-text="negociacao.cd_negociacao"></th>
                                                    <th>###</th>
                                                    <td x-text="formatDate(negociacao.dt_negociacao)"></td>
                                                    <td>-- </td>
                                                    <td>--</td>
                                                    <td>--</td>
                                                    <td x-text="negociacao.nm_cliente"></td>
                                                    <td class="text-right" x-text="negociacao.valor"></td>
                                                    <td class="text-center">
                                                        <span  class="label label-default" style="background: #74767d"
                                                            x-text="negociacao.status"></span>
                                                    </td>
                                                    <td>
                                                        <div style="display: flex">
                                                            <button class="btn btn-primary" x-on:click="openModalNegociacao(negociacao)">
                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                            </button>

                                                            <button class="btn btn-sm btn-success" type="button" x-on:click="setFormNegociacaoEdit(negociacao)">
                                                                <i class="fa fa-edit"></i>
                                                            </button>

                                                            <button class="btn btn-sm btn-danger" type="button" x-on:click="deleteNegociacao(negociacao.cd_negociacao)">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>

                                    <template x-if="loadingDetalhesBoletosAtrasados">
                                        <x-loader />
                                    </template>

                                    <template x-if="!loadingDetalhesBoletosAtrasados && clienteNegociacoes.length == 0">
                                        <p class="text-center" style="padding-top: 24px">Nenhuma negociação</p>
                                    </template>
                                 </div>

                                <div role="tabpanel" class="tab-pane fade" id="tab-historico">
                                    <div class="row m-b-md">
                                        <form class="col-md-12" x-on:submit.prevent="cadastrarHistorico">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Informar Historico</label>
                                                <textarea class="form-control" id="exampleInputEmail1" required style="height: 120px"
                                                    x-model="inputFormHistorico"></textarea>
                                            </div>

                                            <div style="display:flex; gap: 10px; align-items:center">
                                                <button type="submit" class="btn btn-primary">Salvar</button>

                                                <template x-if="editCDHistorico">
                                                    <button type="reset" class="btn btn-light" x-on:click="clearEdicaoHistorico()">Cancelar</button>
                                                </template>

                                                <template x-if="loadingFormHistorico">
                                                    <x-loader style="padding: 0 !important" />
                                                </template>
                                            </div>
                                        </form>
                                    </div>

                                    <template x-for="historico in historicosCliente">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="active">
                                                    <td>
                                                        <strong>Data do Histórico</strong><br/>
                                                        <span x-text="formatDate(historico.created_at)+' '+formatDate(historico.created_at, 'LT')"></span>
                                                    </td>
                                                    <td>
                                                        <strong>Usuário do Histórico</strong><br/>
                                                        <span x-text="historico.usuario.name"></span>
                                                    </td>

                                                    <td>
                                                        <div style="display: flex; justify-content: flex-end">
                                                            <button class="btn btn-sm btn-success" type="button" x-on:click="setEdicaoHistorico(historico)">
                                                                <i class="fa fa-edit"></i>
                                                            </button>

                                                            <button class="btn btn-sm btn-danger" type="button" x-on:click="excluirHistorico(historico.cd_historico)">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr > 
                                                    <td colspan="3">
                                                        <span x-text="historico.historico"></span>
                                                    </td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </template>
                                </div>


                                <div role="tabpanel" class="tab-pane fade" id="tab-envio">
                                     ...
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer" style="display: flex; justify-content: flex-end; align-items: center">
                        <template x-if="loadingEnviarHistorico">
                            <x-loader style="padding: 0 !important; margin-right: 20px"/>
                        </template>
                        <button type="button" class="btn btn-success" x-on:click="enviarHistorico" x-bind:disabled="loadingEnviarHistorico">Enviar histórico por email</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="negociaao-modal" style="background: rgba(0,0,0,.3)">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <h4 class="modal-title" style="font-size: 20px; font-weight: 300; color: #74767d;">
                            Negociação
                        </h4>
                    </div>

                    <div class="modal-body">
                        <table class="table table-striped m-b-lg">
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        <label style=" font-weight: 700; ">Data de negociação:</label>
                                        <span x-text="negociacaoSelecionada?.dt_negociacao"></span>
                                    </td>
                                    
                                    <td colspan="3">
                                        <label style=" font-weight: 700; ">Número do contato:</label>
                                        <span x-text="negociacaoSelecionada?.nr_contato"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="3">
                                        <label style=" font-weight: 700; ">Email do cliente:</label>
                                        <span x-text="negociacaoSelecionada?.email_cliente"></span>
                                    </td>

                                    <td colspan="3">
                                        <label style=" font-weight: 700; ">Valor:</label>
                                        <span x-text="negociacaoSelecionada?.valor"></span>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="3">
                                        <label style=" font-weight: 700; ">Obs:</label>
                                        <span x-text="negociacaoSelecionada?.obs"></span>
                                    </td>

                                    <td colspan="3">
                                        <label style=" font-weight: 700; ">Situação:</label>
                                        <span>
                                            <span  class="label label-default" style="background: #74767d"
                                                x-text="negociacaoSelecionada?.status"></span>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <form x-on:submit.prevent="addBoletoNegociacao" class="m-b-lg">
                            <label class="form-label">Adicionar boletos para negociação</label>

                            <div class="row">
                                <div class="col-md-8">
                                    <select data-placeholder="Boletos atrasados" style="width: 100%"
                                        id="boletos-atrasados-negociacao" required>
                                        <option value="">SELECIONE</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <div style="display: flex; align-items:center; gap: 16px">
                                        <button type="submit" class="btn btn-success" x-bind:disabled="loadingBoletoNegociacao">Adicionar</button>
    
                                        <template x-if="loadingBoletoNegociacao">
                                            <x-loader style="padding: 0" />
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <table class="table table-striped table-vertical-middle" style="margin-bottom: 0">
                            <thead>
                                <tr>
                                    <th colspan="7" class="text-center" style="font-size: 17px;  font-weight: 400; color: #74767d;">Relação de Boletos em negociação</th>
                                </tr>
                                <tr class="active">
                                    <th>Boleto</th>
                                    <th>Tipo </th>
                                    <th>Emissão </th>
                                    <th>Vencimento</th>
                                    <th>Documento</th> 
                                    <th class="text-right">Valor</th>
                                    <th class="text-center">Situação</th>
                                    <th class="text-center">Ação</th>
                                </tr>
                            </thead>

                            <tbody>
                                <template x-for="boleto in negociacaoSelecionada?.boletos">
                                    <tr>
                                        <th x-text="boleto.boleto.id_boleto"></th>
                                        <th x-text="boleto.boleto.tipo_conta"></th>
                                        <th x-text="formatDate(boleto.boleto.dt_emissao)"></th>
                                        <th x-text="formatDate(boleto.boleto.dt_vencimento)"></th>
                                        <th x-text="boleto.boleto.nr_documento"></th> 
                                        <th class="text-right" x-text="boleto.boleto.vl_boleto"></th>
                                        <th class="text-center"><span  class="label label-danger"
                                            x-text="boleto.boleto.status"></span>
                                        </th>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-danger" type="button" x-on:click="deleteBoletoNegociacao(boleto.cd_negociacao_boleto)">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>

                        <template x-if="!negociacaoSelecionada?.boletos?.length">
                            <div style="padding: 15px 0;">
                                <p class="text-center">Nenhum boleto adicionado</p>
                            </div>
                        </template>
                    </div>

                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <style>
            .table.table-striped:last-child {
                margin-bottom: 0;
            }
        </style>
        <script src="{{ asset('js/paginas/clientes.js') }}"></script>
    </x-slot>
</x-layout.brcondos_adv.layout>
