<x-layout.brcondos_adv.layout>

    <div class="page-title">
        <h3>Negociações</h3>
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
                                <th>Negociação</th>
                                <th>Data </th>
                                <th>Fatura </th>
                                <th>CPF/CNPJ</th>
                                <th>Cliente </th>
                                <th>Condomínio</th>
                                <th>Unidade</th>
                                <th>Emissão </th>
                                <th>Vencimento </th>
                                <th>Documento </th>
                                <th class="text-right">Valor</th> 
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr >
                                <th  >231</th>
                                <td  >05/05/2023</td>
                                <td  >63423</td>
                                <td  >081.632.226-03</td>
                                <td >GLEISE YALE DE ARAÚJO</td>
                                <td  >MTC - CONDOMINIO PARQUE MONTE FIORE</td>
                                <td >BLOCO 8, N° 405</td> 
                                <td class="" >06/05/2023</td>
                                <td class=""  >25/05/2023</td>
                                <td class="" >3342423</td>
                                <td class="text-right"  >512,23</td>    
                                <td class="text-center" style="padding: 3px!important; cursor: pointer;">
                                    <span  data-toggle="modal" data-target="#cadastro-consulta" class="label label-danger">ATRASADO</span>
                         
                                </td>
                            </tr>
                              
                        </tbody>
                    </table>
   
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
                            <span >NOME DO CLIENE #CPF</span> </h4>
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
                                                    <label style=" font-weight: 700; ">Nome do Cliente: </label> <span >GLEISE YALE DE ARAÚJO</span>
                                                </td>
                                                <td colspan="">
                                                    <label style=" font-weight: 700; ">CPF: </label>  <span >081.632.226-03</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">
                                                    <label style=" font-weight: 700; ">Negociação: </label> <span >23265</span>
                                                </td>
                                                <td colspan="1">
                                                    <label style=" font-weight: 700; ">Responsável: </label>  <span >RENATO</span>
                                                </td>
                                                <td colspan="2">
                                                    <label style=" font-weight: 700; ">Data da Negociação: </label>  <span >05/05/2023</span>
                                                </td>
                                                 
                                            </tr>
                                            
                                            <tr>
                                                <td colspan="2">
                                                    <label style=" font-weight: 700; ">Contato do Cliente: </label> <span >38 39898-0898</span>
                                                </td>
                                                <td colspan="2">
                                                    <label style=" font-weight: 700; ">Email do Cliente: </label>  <span >dasda@gmail.com</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <label style=" font-weight: 700; ">Observação da Negociação: </label> <span >dsadas das asdasdas</span>
                                                </td> 
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <label style=" font-weight: 700; ">Condomínio: </label> <span >MTC - CONDOMINIO PARQUE MONTE FIORE</span>
                                                </td>
                                                <td>
                                                    <label style=" font-weight: 700; ">BLoco: </label> <span >BLOCO 8, N° 405</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label style=" font-weight: 700; ">Emisão: </label> <span >2020-11-11</span> 

                                                </td>
                                                <td>
                                                    <label style=" font-weight: 700; ">Registro: </label> <span  >2020-11-11</span>
                                                </td>
                                                <td>
                                                    <label style=" font-weight: 700; ">Vencimento: </label> <span >2023-09-15</span>
                                                </td>
                                                <td>
                                                    <label style=" font-weight: 700; ">Pagamento: </label> <span  ></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label style=" font-weight: 700; ">Valor Boleto: </label> <span >173.14</span>
                                                </td>
                                                <td>
                                                    <label style=" font-weight: 700; ">Valor Pago: </label> <span >0.00</span>
                                                </td>
                                                <td>
                                                    <label style=" font-weight: 700; ">Valor Total: </label> <span  >178.52</span>
                                                </td>
                                                <td style="  text-align: center; ">
                                                    <label style=" font-weight: 700; text-align: center; "> </label>
                                                    <span   class="label label-danger">ATRASADO</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <label style=" font-weight: 700; ">Grupo Historico: </label> <span  >ACORDO/NEGOCIAÇÃO</span>
                                                </td>
                                                <td colspan="2">
                                                    <label style=" font-weight: 700; ">Tipo de Conta: </label> <span >EM COBRANÇA JUDICIAL - JURÍDICO EXTERNO</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <label style=" font-weight: 700; ">Conta : </label> <span  >Bradesco 6513.6994-9</span>
                                                </td>
                                                <td colspan="2">
                                                    <label style=" font-weight: 700; ">Boleto Impresso: </label> <span >N</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <label style=" font-weight: 700; ">Detalhes : </label> <span  >RECEBIMENTO ACORDO/NEGOCIAÇÃO - Referente a Out/2019, Nov/2019, Dez/2019, Jan/2020, Fev/2020, Out/2019, Mar/2020, Out/2019, Abr/2020, Out/2019, Mai/2020, Jun/2020, Out/2019, Jun/2020, Out/2019, Jul/2020, Out/2019, Ago/2020, Out/2019, Set/2020, Out/2019, Out/2019, Out/2019, Out/2019, Out/2019, Out/2019, Out/2020. Parcela 25/37</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
 
                                </div>

                                
                                <div role="tabpanel" class="tab-pane fade" id="tab-neg">
                                    
                  
                                    
                                    <table class="table table-striped" style="margin-bottom: 0; margin-top: 10px;">
                                        <thead>
                                            <tr  >
                                                <th colspan="7" class="text-center" style="font-size: 17px;  font-weight: 400; color: #74767d;">Relação de Negocições em Abertos</th>
                                            </tr>
                                            <tr class="active"> 
                                                <th></th> 
                                                <th>Titulo</th>  
                                                <th>Emissão</th>
                                                <th>Vencimento</th> 
                                                <th>Documento</th>  
                                                <th class="text-right">Valor</th>   
                                                <th class="text-center">Situação</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            <tr >
                                                <th>
                                                    <div class="checkbox" style=" margin-top: 0px; margin-bottom: 0px;">
                                                        <label style="padding-left: 0px;">
                                                            <input type="checkbox"> 
                                                        </label>
                                                    </div>    
                                                </th> 
                                                <th>34344</th> 
                                                <td>05/05/2023</td> 
                                                <td>08/05/2023</td>
                                                <td>432432</td>  
                                                <td class="text-right">178,52</td>   
                                                <td class="text-center"><span  class="label label-danger"  >ATRASADO</span>
                                                </td>
                                            </tr>
                                            <tr >
                                                <th>
                                                    <div class="checkbox" style=" margin-top: 0px; margin-bottom: 0px;">
                                                        <label style="padding-left: 0px;">
                                                            <input type="checkbox"> 
                                                        </label>
                                                    </div>    
                                                </th> 
                                                <th>65645</th> 
                                                <td>05/06/2023</td> 
                                                <td>08/08/2023</td>
                                                <td>64645</td>  
                                                <td class="text-right">178,52</td>   
                                                <td class="text-center"><span  class="label label-danger"  >ATRASADO</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                 </div>

                                <div role="tabpanel" class="tab-pane fade" id="tab-historico">
                                    <div class="row m-b-md">
                                        <form class="col-md-12" x-on:submit.prevent="cadastrarHistorico">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Informar Historico</label>
                                                <textarea class="form-control" id="exampleInputEmail1"  required style="height: 120px"></textarea>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        </form>
                                    </div>

                                    <table class="table table-striped" style="margin-bottom: 0">
                                        <thead>
                                            <tr class="active">
                                                <td><strong>Data do Histórico</strong><br/>05/08/2023 14:00</td>
                                                <td><strong>Usuário do Histórico</strong><br/>RENATO</td>
                                            </tr>
                                            <tr > 
                                                <td colspan="2"> O Botafogo venceu o Fluminense no estádio Nilton Santos pela sétima rodada do Campeonato Brasileiro por 1 a 0, 
                                                    gol do zagueiro Victor Cuesta. Essa é a quarta vitória em quatro partidas do time jogando em casa do Brasileirão, 
                                                    onde inaugurou o novo gramado sintético na primeira rodada do torneio.</td>
                                            </tr>
                                        </thead> 
                                    </table>
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

 
</x-layout.brcondos_adv.layout>
