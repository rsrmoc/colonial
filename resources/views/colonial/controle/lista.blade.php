<x-layout.brcondos_adv.layout>

    <div class="page-title">
        <h3>Titulos</h3>
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

                    <form x-on:submit.prevent="getBoletosPorFiltros(true)" class="panel panel-white"
                        style="margin-bottom: 15px;">

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group @if ($errors->has('tipo')) has-error @endif ">
                                    <select class="form-control" name="tipo" required id="select-tipo">
                                        <option value="">Tipo de Data</option>
                                        <option value="V" @if (old('tipo', $request['tipo']) == 'V') selected @endif>
                                            VENCIMENTO</option>
                                        <option value="P" @if (old('tipo', $request['tipo']) == 'P') selected @endif>
                                            PAGAMENTO</option>
                                        <option value="E" @if (old('tipo', $request['tipo']) == 'E') selected @endif>EMISSÃO
                                        </option>
                                        <option value="X" @if (old('tipo', $request['tipo']) == 'XE') selected @endif>
                                            EXCLUSÃO</option>
                                    </select>
                                    @if ($errors->has('tipo'))
                                        <div class="error">{{ $errors->first('tipo') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group @if ($errors->has('dti')) has-error @endif ">
                                    <input type="date" class="form-control" value="{{ old('dti', $request['dti']) }}"
                                        placeholder="Data Inicial" name="dti" required
                                        x-model="inputsFiltros.dti" />
                                    @if ($errors->has('dti'))
                                        <div class="error">{{ $errors->first('dti') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group @if ($errors->has('dtf')) has-error @endif ">
                                    <input type="date" class="form-control" value="{{ old('dtf', $request['dtf']) }}"
                                        placeholder="Data Final" name="dtf" required x-model="inputsFiltros.dtf" />
                                    @if ($errors->has('dtf'))
                                        <div class="error">{{ $errors->first('dtf') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group @if ($errors->has('nome')) has-error @endif ">
                                    <input type="text" class="form-control"
                                        value="{{ old('nome', $request['nome']) }}" placeholder="Nome do Cliente"
                                        name="nome" x-model="inputsFiltros.nome" />
                                    @if ($errors->has('nome'))
                                        <div class="error">{{ $errors->first('nome') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group @if ($errors->has('cpf')) has-error @endif ">
                                    <input type="text" class="form-control" value="{{ old('cpf', $request['cpf']) }}"
                                        placeholder="Cnpj/Cpf" name="cpf" x-model="inputsFiltros.cpf" />
                                    @if ($errors->has('cpf'))
                                        <div class="error">{{ $errors->first('cpf') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group @if ($errors->has('agrupamento')) has-error @endif ">
                                    <select class="form-control" name="agrupamento" id="select-agrupamento">
                                        <option value="">Agrupamento</option>
                                        @foreach ($tabelas as $tab)
                                            @if ($tab->tp_tabela == 'GRUPO_HISTORICO')
                                                <option value="{{ $tab->campo }}"
                                                    @if (old('agrupamento', $request['agrupamento']) == $tab->campo) selected @endif>
                                                    {{ $tab->campo }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('agrupamento'))
                                        <div class="error">{{ $errors->first('agrupamento') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group @if ($errors->has('tipo_conta')) has-error @endif ">
                                    <select class="form-control" name="tipo_conta" id="select-tipo_conta">
                                        <option value="">Tipo de Conta</option>
                                        @foreach ($tabelas as $tab)
                                            @if ($tab->tp_tabela == 'TIPO_CONTA')
                                                <option value="{{ $tab->campo }}"
                                                    @if (old('tipo_conta', $request['tipo_conta']) == $tab->campo) selected @endif>
                                                    {{ $tab->campo }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('tipo_conta'))
                                        <div class="error">{{ $errors->first('tipo_conta') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group @if ($errors->has('status')) has-error @endif ">
                                    <select class="form-control" name="status" id="select-status">
                                        <option value="">Status</option>
                                        @foreach ($tabelas as $tab)
                                            @if ($tab->tp_tabela == 'STATUS')
                                                <option value="{{ $tab->campo }}"
                                                    @if (old('status', $request['status']) == $tab->campo) selected @endif>
                                                    {{ $tab->campo }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="error">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group @if ($errors->has('titulo')) has-error @endif ">
                                    <input type="text" class="form-control"
                                        value="{{ old('titulo', $request['titulo']) }}" placeholder="Titulo"
                                        name="titulo" x-model="inputsFiltros.titulo" />
                                    @if ($errors->has('titulo'))
                                        <div class="error">{{ $errors->first('titulo') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group @if ($errors->has('nr_doc')) has-error @endif ">
                                    <input type="text" class="form-control" value="{{ old('nr_doc') }}"
                                        placeholder="Nr.Documento" name="nr_doc" x-model="inputsFiltros.nr_doc" />
                                    @if ($errors->has('nr_doc'))
                                        <div class="error">{{ $errors->first('nr_doc') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group @if ($errors->has('ns_num')) has-error @endif ">
                                    <input type="text" class="form-control"
                                        value="{{ old('ns_num', $request['ns_num']) }}" placeholder="Nosso Documento"
                                        name="ns_num" x-model="inputsFiltros.ns_num" />
                                    @if ($errors->has('ns_num'))
                                        <div class="error">{{ $errors->first('ns_num') }}</div>
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
                                        name="bloco" x-model="inputsFiltros.bloco" />
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
                                <th>Fatura</th>
                                <th>Condomínio</th>
                                <th>Unidade</th>
                                <th>Nome</th>
                                <th>Cpf/Cnpj</th>
                                <th class="text-center">Data Emissão</th>
                                <th class="text-center">Data Vencimento</th>
                                <th>Documento</th>
                                <!-- <th>Grupo de Histórico</th> -->
                                <th>Carteira</th>
                                <th class="text-right">Valor</th>
                                <th>Status</th>
                                <th class="text-center">Ação</th>
                            </tr>
                        </thead>

                        <tbody>
                            <template x-if="!loading">
                                <template x-for="boleto in boletos">
                                    <tr x-bind:id="`tr-condominio-${boleto.id_boleto}`">
                                        <td x-text="boleto.id_boleto"></td>
                                        <td x-text="boleto.condominio.nm_condominio"></td>
                                        <td x-text="boleto.bloco_apto"></td>
                                        <td x-text="boleto.nm_cliente"></td>
                                        <td x-text="boleto.cpf_cnpj"></td>
                                        <td class="text-center" x-text="boleto.data_emissao"></td>
                                        <td class="text-center" x-text="boleto.data_vencimento"></td>
                                        <td x-text="boleto.nr_documento"></td>
                                        <!--<td>$boleto->grupo_historico</td> -->
                                        <td x-text="boleto.tipo_conta"></td>
                                        <td class="text-right" x-text="boleto.valor_total"></td>
                                        <td> <span x-bind:class="`label label-${boleto.tp_status}`"
                                                x-text="boleto.status"></span></td>
                                        <td class="text-center" style="padding: 3px!important;">
                                            <img height="22" style="cursor: pointer" x-on:click="detalhes(boleto)"
                                                src="{{ asset('assets/images/detalhes.png') }}">
                                        </td>
                                    </tr>
                                </template>
                            </template>
                        </tbody>
                    </table>
 
                    <template x-if="loading">
                        <x-loader />
                    </template>
                    
                    <div style="float: right"> 
                        <span x-html="Pagination"></span> 
                    </div>
                    <!--
                    <br><br>
                    <br><br>
                    <template x-if="!loading && boletos.length > 0">
                        <div style="float: right">
                            <div class="btn-group" role="group" aria-label="First group">
                                <template x-for="page, indice in Array(pages).fill(1)">
                                    <button type="button" class="btn btn-default" x-bind:class="{'btn-success': inputsFiltros.page == indice+1}" x-text="indice + 1"
                                        x-on:click="setPageBoletos(indice+1)"></button>
                                </template>
                            </div>
                        </div>
                    </template>
                    -->
                    <template x-if="boletos.length == 0 && !loading">
                        <p class="text-center" style="padding: 1.2em">Nenhum Boleto</p>
                    </template>
                </div>
            </div>
        </div>

        <div class="modal fade" id="cadastro-consulta">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="absolute-loading" style="display: none">
                        <div class="line">
                            <div class="loading"></div>
                            <span>Pesquisando...</span>
                        </div>
                    </div>

                    <div class="modal-header m-b-sm">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" style="font-size: 20px; font-weight: 300; color: #74767d;">
                            <span x-text="boleto_selecionado?.id_boleto +' '  +  boleto_selecionado?.nm_cliente + ' ( ' + boleto_selecionado?.cpf_cnpj + ' ) ' "></span> </h4>
                    </div>

                    <div class="modal-body">

                        <div class="panel-body" style="padding: 0px;">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-justified" role="tablist">
                                <li role="presentation" class="active"><a href="#tab-fatura" role="tab"
                                        data-toggle="tab">Dados da Fatura</a></li>
                                <li role="presentation"><a href="#tab-historico" role="tab"
                                        data-toggle="tab">Historico</a></li>
                                <li role="presentation"><a href="#tab-neg" role="tab"
                                        data-toggle="tab">Negociação</a></li>
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
                                                    <label style=" font-weight: 700; ">Nome do Cliente: </label> <span
                                                        x-text="boleto_selecionado?.nm_cliente "></span>
                                                </td>
                                                <td colspan="3">
                                                    <label style=" font-weight: 700; ">CPF: </label> </label> <span
                                                        x-text="boleto_selecionado?.cpf_cnpj "></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <label style=" font-weight: 700; ">Condomínio: </label> <span
                                                        x-text="boleto_selecionado?.condominio?.nm_condominio "></span>
                                                </td>
                                                <td>
                                                    <label style=" font-weight: 700; ">BLoco: </label> <span
                                                        x-text="boleto_selecionado?.bloco_apto "></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label style=" font-weight: 700; ">Emisão: </label> <span
                                                        x-text=" boleto_selecionado?.dt_emissao "></span>



                                                </td>
                                                <td>
                                                    <label style=" font-weight: 700; ">Registro: </label> <span
                                                        x-text=" boleto_selecionado?.dt_registro "></span>
                                                </td>
                                                <td>
                                                    <label style=" font-weight: 700; ">Vencimento: </label> <span
                                                        x-text=" boleto_selecionado?.dt_vencimento "></span>
                                                </td>
                                                <td>
                                                    <label style=" font-weight: 700; ">Pagamento: </label> <span
                                                        x-text=" boleto_selecionado?.dt_pago "></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label style=" font-weight: 700; ">Valor Boleto: </label> <span
                                                        x-text=" boleto_selecionado?.vl_boleto "></span>
                                                </td>
                                                <td>
                                                    <label style=" font-weight: 700; ">Valor Pago: </label> <span
                                                        x-text=" boleto_selecionado?.vl_pago "></span>
                                                </td>
                                                <td>
                                                    <label style=" font-weight: 700; ">Valor Total: </label> <span
                                                        x-text=" boleto_selecionado?.vl_total "></span>
                                                </td>
                                                <td style="  text-align: center; ">
                                                    <label style=" font-weight: 700; text-align: center; "> </label>
                                                    <span x-text=" boleto_selecionado?.status "
                                                        class="label label-danger"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <label style=" font-weight: 700; ">Grupo Historico: </label> <span
                                                        x-text=" boleto_selecionado?.grupo_historico "></span>
                                                </td>
                                                <td colspan="2">
                                                    <label style=" font-weight: 700; ">Tipo de Conta: </label> <span
                                                        x-text=" boleto_selecionado?.tipo_conta "></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <label style=" font-weight: 700; ">Conta : </label> <span
                                                        x-text=" boleto_selecionado?.ds_conta "></span>
                                                </td>
                                                <td colspan="2">
                                                    <label style=" font-weight: 700; ">Boleto Impresso: </label> <span
                                                        x-text=" boleto_selecionado?.impresso_boleto "></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <label style=" font-weight: 700; ">Detalhes : </label> <span
                                                        x-text=" boleto_selecionado?.detalhes "></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="tab-historico">
                                    <div class="row m-b-md">
                                        <form class="col-md-10" x-on:submit.prevent="cadastrarHistorico">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Historico</label>
                                                <textarea class="form-control" id="exampleInputEmail1" x-model="descricaoHistorico" required></textarea>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        </form>
                                    </div>

                                    <table class="table table-striped" style="margin-bottom: 0">
                                        <thead>
                                            <tr class="active">
                                                <td>Código</td>
                                                <td>Nome</td>
                                                <td class="text-center">Ação</td>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <template x-for="boleto_historico, indice in boleto_selecionado_historico">
                                                <tr>
                                                    <td x-text="boleto_historico.cd_boleto_hist"></td>
                                                    <td x-text="boleto_historico.nome"></td>
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-danger"
                                                            x-on:click="excluirHistorico(boleto_historico.cd_boleto_hist, indice)">Excluir</button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="tab-neg">
                                   ...
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="tab-envio">
                                     ...
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <x-slot name="scripts">
        <script>
            function excluirRegistro(el, condominio) {
                Swal.fire({
                    title: 'Confirmação',
                    text: "Tem certeza que deseja excluir esse usuáro?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#22BAA0',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Não',
                    confirmButtonText: 'Sim'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.get(`/brcondos_adv/condominios-delete/${condominio}`)
                            .then((res) => {
                                document.querySelector(el).remove();
                                toastr["success"]('Usuário excluido com sucesso!');
                            })
                            .catch((err) => toastr["error"]('Não foi possivel excluir o usuário!'));
                    }
                });
            }
        </script>
        <script src="{{ asset('js/paginas/controle.js') }}"></script>
    </x-slot>
</x-layout.brcondos_adv.layout>
