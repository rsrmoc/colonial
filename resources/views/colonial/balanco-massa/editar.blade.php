<x-layout.colonial.layout>
    <div class="page-title">
        <h3>Editar Balanço de Massas </h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('balancomassa-listar') }}">Relação</a></li>
            </ol>
        </div>
    </div>

    <div id="main-wrapper" x-data="app">
        <div class="col-md-12 ">
 
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li role="presentation" class="{{ ($retorno['tab']=='upd') ? 'active' : null }}"><a href="#tabBalanco" role="tab" data-toggle="tab">Balanço de Massa</a></li>
                    <li role="presentation" class="{{ ($retorno['tab']=='ent') ? 'active' : null }}"><a href="#tabAcumulado" role="tab" data-toggle="tab">Entrada de Tomate</a></li>
                    <li role="presentation" class="{{ ($retorno['tab']=='ent_polpa') ? 'active' : null }}"><a href="#tabPolpa" role="tab" data-toggle="tab">Entrada de Polpas</a></li>
                    <li role="presentation" class="{{ ($retorno['tab']=='cla') ? 'active' : null }}"><a href="#tabClassificacao" role="tab" data-toggle="tab">Classificação</a></li>
                      
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                   
                    <form action="{{ route('balancomassa-update', $balanco) }}" method="POST" role="tabpanel" 
                        class="tab-pane fade {{ ($retorno['tab']=='upd') ?  'active  in'  : null }}" id="tabBalanco"    >
                        @csrf 
        
                        <div class="panel-body">
        
                            <div class="row">
                                <div class="col-md-6  col-md-offset-1">
                                    <div class="form-group @if($errors->has('nm_balanco')) has-error @endif ">
                                        <label for="fname">Lavoura: <span class="red normal"></span></label>
                                        <input type="text" class="form-control" value="{{old('nm_balanco',$balanco->nm_balanco)}}"  placeholder="Lavoura" name="nm_balanco"> 
                                        @if($errors->has('nm_balanco'))
                                            <div class="error">{{ $errors->first('nm_balanco') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2 ">
                                    <div class="form-group @if($errors->has('dt_inicial')) has-error @endif ">
                                        <label for="fname">Data Inicial: <span class="red normal">*</span></label>
                                        <input type="date" class="form-control" value="{{old('dt_inicial',$balanco->dt_inicial)}}"     name="dt_inicial"> 
                                        @if($errors->has('dt_inicial'))
                                            <div class="error">{{ $errors->first('dt_inicial') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2 ">
                                    <div class="form-group @if($errors->has('dt_final')) has-error @endif ">
                                        <label for="fname">Data Final: <span class="red normal">*</span></label>
                                        <input type="date" class="form-control" value="{{old('dt_final',$balanco->dt_final)}}"  name="dt_final"> 
                                        @if($errors->has('dt_final'))
                                            <div class="error">{{ $errors->first('dt_final') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div> 
         
                            <div class="row">
                                <div class="col-md-4  col-md-offset-1 ">
                                    <div class="form-group @if($errors->has('cd_fornecedor')) has-error @endif ">
                                        <label for="fname" >Fornecedor: <span class="red normal">*</span></label>
                                        <div id="div_combo_ordem"> 
                                            <select class="form-control" style="width: 100%;"  name="cd_fornecedor"  >
                                                <option value="">...</option> 
                                                @foreach ($fornecedor as $forn)
                                                    <option value="{{ $forn->codigo }}" @if(old('cd_fornecedor',$balanco->cd_fornecedor)==$forn->codigo) selected @endif >{{ $forn->nome }}</option> 
                                                @endforeach  
                                            </select>
                                        </div>
                                        @if($errors->has('cd_fornecedor'))
                                            <div class="error">{{ $errors->first('cd_fornecedor') }}</div>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="col-md-2 ">
                                    <div class="form-group @if($errors->has('brix_ponderado')) has-error @endif ">
                                        <label for="fname">Brix Ponderado: <span class="red normal"> * </span></label>
                                        <input type="text" class="form-control" value="{{old('brix_ponderado',$balanco->brix_ponderado)}}" x-mask:dynamic="$money($input, ',')" name="brix_ponderado"> 
                                        @if($errors->has('brix_ponderado'))
                                            <div class="error">{{ $errors->first('brix_ponderado') }}</div>
                                        @endif
                                    </div>
                                </div> 
                            </div>
           
                            <div class="row" >
                                <div class="col-md-10 col-sm-10 col-xs-10  col-md-offset-1" >
                                    <div class="form-group @if($errors->has('obs')) has-error @endif ">
                                        <label for="fname">Observações Adicionais: <span class="red normal"> </span></label>
                                        <textarea  class="form-control " name="obs" >{{old('obs',$balanco->obs)}}</textarea>
                                        @if($errors->has('obs'))
                                            <div class="error">{{ $errors->first('obs') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div role="tabpanel">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-justified" role="tablist">
                                    <li role="presentation" class="active"><a href="#tabResultado" role="tab" data-toggle="tab">Resultado</a></li>
                                    <li role="presentation" class=""><a href="#tabCadEntradas" role="tab" data-toggle="tab">Entrada de Tomate</a></li>
                                    <li role="presentation" class=""><a href="#tabCadEntradasPolpas" role="tab" data-toggle="tab">Entrada de Polpas</a></li>
                                    <li role="presentation" class=""><a href="#tabCadClassificacao" role="tab" data-toggle="tab">Classificação</a></li>
                                     
                                      
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                   
                                    <div role="tabpanel"  class="tab-pane fade active  in" id="tabResultado"    >
                                        <div class="row" >
                                            <div class="col-md-8 col-sm-8 col-xs-8  col-md-offset-2" >
                                                <table class="table table-striped" style="margin-bottom: 0">
                                                    <thead>
                                                        <tr class="text-left">
                                                            <th>Acumulado Entrada de Tomate</th>   
                                                            <th class="text-right"> -- </th>      
                                                            <th class="text-right"> -- </th>  
                                                        </tr>
                                                        <tr class="text-left"> 
                                                            <th>Média Brix Ponderado</th>   
                                                            <th class="text-right"> -- </th>      
                                                            <th class="text-right"> -- </th>  
                                                        </tr>
                                                        <tr class="active"> 
                                                            <th>Total Acumulado Entrar de Polpa 21 Brix</th>   
                                                            <th class="text-right"> -- </th>      
                                                            <th class="text-right"> -- </th>  
                                                        </tr>
                                                   
                                                        <tr class="text-left">
                                                            <th>Entrada de Polpa 17/19 Brix Tambor Estoque </th>   
                                                            <th class="text-right"> -- </th>    
                                                            <th class="text-right"> -- </th>    
                                                        </tr>
                                                        <tr class="text-left"> 
                                                            <th>Entrada de Polpa 20/22 Brix  Tambor Estoque</th>   
                                                            <th class="text-right"> -- </th>    
                                                            <th class="text-right"> -- </th>    
                                                        </tr>
                                                        <tr class="text-left"> 
                                                            <th>Consumo Polpa BRIX 17/19   ( produção P.A )</th>   
                                                            <th class="text-right"> -- </th>    
                                                            <th class="text-right"> -- </th>    
                                                        </tr>
                                                        <tr class="text-left"> 
                                                            <th>Consumo Polpa BRIX 20/22   ( produção P.A )</th>   
                                                            <th class="text-right"> -- </th>    
                                                            <th class="text-right"> -- </th>    
                                                        </tr>
                                                        <tr class="active"> 
                                                            <th>Total de Entrada de Polpa 18 Brix</th>   
                                                            <th class="text-right"> -- </th>  
                                                            <th class="text-right"> -- </th>    
                                                        </tr>
                                                        <tr class="active"> 
                                                            <th>Rendimento lavoura</th>   
                                                            <th class="text-right"> -- </th>  
                                                            <th class="text-right"> -- </th>    
                                                        </tr>
                                                        <tr  > 
                                                            <th> </th>   
                                                            <th class="text-right">   </th>  
                                                            <th class="text-right"> -- </th>    
                                                        </tr>
                                                    </thead>  
                                                </table>  
                                                <br>
                                                <table class="table table-striped" style="margin-bottom: 0">
                                                    <thead>
                                                        <tr class="active"> 
                                                            <th class="text-center" colspan="3">Balanceamento de Massa</th>  
                                                        </tr>
                                                        <tr class="text-left">
                                                            <th>Acumulado Entrada de Tomate</th>   
                                                            <th class="text-right"> -- </th>      
                                                            <th class="text-right"> -- </th>  
                                                        </tr>
                                                        <tr class="text-left"> 
                                                            <th>Residuo</th>   
                                                            <th class="text-right"> -- </th>      
                                                            <th class="text-right"> -- </th>  
                                                        </tr>
                                                        <tr > 
                                                            <th>Sujeiras</th>   
                                                            <th class="text-right"> -- </th>      
                                                            <th class="text-right"> -- </th>  
                                                        </tr>
                                                        <tr > 
                                                            <th>Terra</th>   
                                                            <th class="text-right"> -- </th>      
                                                            <th class="text-right"> -- </th>  
                                                        </tr>
                                                        <tr > 
                                                            <th>Verde</th>   
                                                            <th class="text-right"> -- </th>      
                                                            <th class="text-right"> -- </th>  
                                                        </tr>
                                                        <tr class="active"> 
                                                            <th>Sub Total</th>   
                                                            <th class="text-right"> -- </th>  
                                                            <th class="text-right"> -- </th>    
                                                        </tr>
                                                        <tr class="active"> 
                                                            <th>Total</th>   
                                                            <th class="text-right"> -- </th>  
                                                            <th class="text-right"> -- </th>    
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
          
                                    <div role="tabpanel"  class="tab-pane fade " id="tabCadEntradas"    >
                                        <table class="table table-striped" style="margin-bottom: 0">
                                            <thead>
                                                <tr class="active"> 
                                                    <th>Codigo</th>   
                                                    <th class="text-center">Data </th>  
                                                    <th class="text-center">Fornecedor</th> 
                                                    <th class="text-left">Nome do Fornecedor</th> 
                                                    <th class="text-right">Quantidade</th>   
                                                </tr>
                                            </thead> 
                                            <tbody>
                                                @if(isset($retorno['balanco_entrada']))
                                                    @foreach ( $retorno['balanco_entrada'] as $linha )
                                                        <tr  > 
                                                            <td class="text-left">{{ $linha->doc_num  }}</td>  
                                                            <td class="text-left">{{ $linha->doc_date  }}</td>    
                                                            <td class="text-left">{{ $linha->card_code  }}</td>  
                                                            <td class="text-left">{{ $linha->card_name  }}</td>  
                                                            <td class="text-right">{{ $linha->qtde  }}</td>     
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <div role="tabpanel"  class="tab-pane fade " id="tabCadEntradasPolpas"    >
                                        <table class="table table-striped" style="margin-bottom: 0">
                                            <thead>
                                                <tr class="active"> 
                                                    <th>Codigo</th>    
                                                    <th class="text-center">Data</th> 
                                                    <th class="text-right">Qtde Consumida</th> 
                                                    <th class="text-right">Qtde Estoque</th> 
                                                    <th class="text-right">Qtde Produzida</th> 
                                                </tr>
                                            </thead> 
                                            <tbody>
                                                @if(isset($retorno['balanco_polpa']))
                                                    @foreach ( $retorno['balanco_polpa'] as $linha )
                                                    <input type="hidden" name="tipo_entrada" value="polpa">
                                                        <tr  > 
                                                            <td class="text-left">{{ $linha->DocEntry  }}</td>  
                                                            <td class="text-center">{{   date( 'd/m/Y' , strtotime( $linha->DueDate )) }}</td>    
                                                            <td class="text-right">{{ number_format(($linha->quant_producao - ( ($linha->quant_estoque) ? $linha->quant_estoque : 0 ) ), 0, '.', '') }}</td>  
                                                            <td class="text-right">{{ ($linha->quant_estoque) ? number_format($linha->quant_estoque, 0, '.', '')  : 0   }}</td>  
                                                            <td class="text-right">{{  number_format($linha->quant_producao, 0, '.', '')  }}</td>     
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <div role="tabpanel"  class="tab-pane fade " id="tabCadClassificacao"    >
                                        <table class="table table-striped" style="margin-bottom: 0">
                                            <thead>
                                                <tr class="active">  
                                                    <th>Codigo</th>   
                                                    <th class="text-center">Data </th>  
                                                    <th class="text-right">Resíduo</th> 
                                                    <th class="text-right">Terra</th> 
                                                    <th class="text-right">Sujeira</th>   
                                                    <th class="text-right">Verdes</th>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                            </thead> 
                                            <tbody>
                                                @php
                                                    $residuo= 0;  $terra= 0;  $sujeira= 0;  $verde= 0;  $total= 0;
                                                @endphp
                                                @if(isset($retorno['balanco_classif']))
                                                @foreach ($retorno['balanco_classif'] as $linha )
                                                    @php
                                                        $terra=$terra+$linha->terra;
                                                        $residuo=$residuo+$linha->residuo;
                                                        $sujeira=$sujeira+$linha->sujeira;
                                                        $verde=$verde+$linha->verde;
                                                        $total=$total+$linha->total;
                                                    @endphp
                                                    <tr  > 
                                                        <td  >{{ $linha->cd_classificacao }}</td>  
                                                        <td class="text-center">{{  date( 'd/m/Y' , strtotime( $linha->dt_recebimento ) ) }}</td>  
                                                        <td class="text-right">{{ $linha->residuo }}</td> 
                                                        <td class="text-right">{{ $linha->terra }}</td> 
                                                        <td class="text-right" >{{ $linha->sujeira  }}</td> 
                                                        <td class="text-right">{{ $linha->verde }}</td>   
                                                        <td class="text-right">{{ $linha->total }}</td> 
                                                    </tr>
                                                @endforeach
                                                @endif
                                                <tr class="active"> 
                                                    <th>--</th>   
                                                    <th>--</th>   
                                                    <th class="text-center">-- </th>  
                                                    <th class="text-right">{{ $residuo }}</th> 
                                                    <th class="text-right">{{ $terra }}</th> 
                                                    <th class="text-right">{{ $sujeira }}</th>   
                                                    <th class="text-right">{{ $verde }}</th>
                                                    <th class="text-right">{{ $total }}</th>
                                                </tr>
                                             
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
        
                        <div class="panel-footer">
                            <button class="btn btn-danger">Cadastrar</button>
                        </div>
                    </form>


                    <div role="tabpanel" class="tab-pane fade {{ ($retorno['tab']=='ent') ?  'active  in'  : null }}" id="tabAcumulado"> 

                        <form action="{{ route('balancomassa-editar', $balanco) }}" method="get"  >
                            @csrf 
                            <input type="hidden" name="tab" value="ent">
                            <div class="panel-body">
            
                                <div class="row">
                    
                                    <div class="col-md-2 ">
                                        <div class="form-group @if($errors->has('dt_inicial')) has-error @endif ">
                                            <label for="fname">Data Inicial: <span class="red normal">*</span></label>
                                            <input type="date" class="form-control" value="{{old('dt_inicial',$request['dt_inicial'])}}"     name="dt_inicial"> 
                                            @if($errors->has('dt_inicial'))
                                                <div class="error">{{ $errors->first('dt_inicial') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-2 ">
                                        <div class="form-group @if($errors->has('dt_final')) has-error @endif ">
                                            <label for="fname">Data Inicial: <span class="red normal">*</span></label>
                                            <input type="date" class="form-control" value="{{old('dt_final',$request['dt_final'])}}"  name="dt_final"> 
                                            @if($errors->has('dt_final'))
                                                <div class="error">{{ $errors->first('dt_final') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2 ">
                                        <div style="margin-top: 22px;" class="form-group @if($errors->has('dt_final')) has-error @endif ">
                                            <button class="btn btn-danger">Pesquisar</button>
                                        </div>
                                    </div>
                                </div>  
            
                            </div>
                        </form>
                        <form action="{{ route('balancomassa-entrada', $balanco) }}" method="post"   >
                            @csrf 
                            <input type="hidden" name="tipo_entrada" value="tomate">
                            <table class="table table-striped" style="margin-bottom: 0">
                                <thead>
                                    <tr class="active">
                                        <th class="text-center">##</th>
                                        <th>Codigo</th>   
                                        <th class="text-center">Data </th>  
                                        <th class="text-center">Fornecedor</th> 
                                        <th class="text-left">Nome do Fornecedor</th> 
                                        <th class="text-right">Quantidade</th>   
                                    </tr>
                                </thead> 
                                <tbody>
                                    @if(isset($retorno['entrada']))
                                        @foreach ( $retorno['entrada'] as $linha )
                                            <tr  >
                                                <td>
                                                    <div class="checkbox" style="margin-top: 0px;   margin-bottom: 0px;">
                                                        <label>
                                                            <input type="checkbox" name="codigo[]" @if($linha->cd_entrada) checked @endif value="{{ $linha->doc_num }}">  
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-left">{{ $linha->doc_num  }}</td>  
                                                <td class="text-left">{{ $linha->doc_date  }}</td>    
                                                <td class="text-left">{{ $linha->card_code  }}</td>  
                                                <td class="text-left">{{ $linha->card_name  }}</td>  
                                                <td class="text-right">{{ $linha->qtde  }}</td>     
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="panel-footer">
                                <button class="btn btn-danger">Cadastrar</button>
                            </div>
                        </form>
                      
                    </div>
                     
                    <div role="tabpanel" class="tab-pane fade {{ ($retorno['tab']=='ent_polpa') ?  'active  in'  : null }}" id="tabPolpa"> 

                        <form action="{{ route('balancomassa-editar', $balanco) }}" method="get"  >
                            @csrf 
                            <input type="hidden" name="tab" value="ent_polpa">
                            <div class="panel-body">
            
                                <div class="row">
                    
                                    <div class="col-md-2 ">
                                        <div class="form-group @if($errors->has('dt_inicial')) has-error @endif ">
                                            <label for="fname">Data Inicial: <span class="red normal">*</span></label>
                                            <input type="date" class="form-control" value="{{old('dt_inicial',$balanco->dt_inicial)}}"     name="dt_inicial"> 
                                            @if($errors->has('dt_inicial'))
                                                <div class="error">{{ $errors->first('dt_inicial') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-2 ">
                                        <div class="form-group @if($errors->has('dt_final')) has-error @endif ">
                                            <label for="fname">Data Inicial: <span class="red normal">*</span></label>
                                            <input type="date" class="form-control" value="{{old('dt_final',$balanco->dt_final)}}"  name="dt_final"> 
                                            @if($errors->has('dt_final'))
                                                <div class="error">{{ $errors->first('dt_final') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2 ">
                                        <div style="margin-top: 22px;" class="form-group @if($errors->has('dt_final')) has-error @endif ">
                                            <button class="btn btn-danger">Pesquisar</button>
                                        </div>
                                    </div>
                                </div>  
            
                            </div>
                        </form>

                        <form action="{{ route('balancomassa-entrada', $balanco) }}" method="post"   >
                            @csrf 
                            <input type="hidden" name="tipo_entrada" value="polpa">
                            <table class="table table-striped" style="margin-bottom: 0">
                                <thead>
                                    <tr class="active">
                                        <th class="text-center">##</th>
                                        <th>Codigo</th>    
                                        <th class="text-center">Data</th> 
                                        <th class="text-right">Qtde Consumida</th> 
                                        <th class="text-right">Qtde Estoque</th> 
                                        <th class="text-right">Qtde Produzida</th> 
                                    </tr>
                                </thead> 
                                <tbody>
                                    @if(isset($retorno['entrada_polpa']))
                                        @foreach ( $retorno['entrada_polpa'] as $linha )
                                        <input type="hidden" name="tipo_entrada" value="polpa">
                                            <tr  >
                                                <td>
                                                    <div class="checkbox" style="margin-top: 0px;   margin-bottom: 0px;">
                                                        <label>
                                                            <input type="checkbox" name="codigo[]"  @if($linha->cd_ordem) checked @endif value="{{ $linha->DocEntry }}">  
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-left">{{ $linha->DocEntry  }}</td>  
                                                <td class="text-center">{{   date( 'd/m/Y' , strtotime( $linha->DueDate )) }}</td>    
                                                <td class="text-right">{{ number_format(($linha->quant_producao - ( ($linha->quant_estoque) ? $linha->quant_estoque : 0 ) ), 0, '.', '') }}</td>  
                                                <td class="text-right">{{ ($linha->quant_estoque) ? number_format($linha->quant_estoque, 0, '.', '')  : 0   }}</td>  
                                                <td class="text-right">{{  number_format($linha->quant_producao, 0, '.', '')  }}</td>     
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="panel-footer">
                                <button class="btn btn-danger">Cadastrar</button>
                            </div>
                        </form>
                      
                    </div>
                     
                    <div role="tabpanel"  class="tab-pane fade {{ ($retorno['tab']=='cla') ?  'active  in'  : null }}" id="tabClassificacao"    >


                        <form action="{{ route('balancomassa-editar', $balanco) }}" method="get"  >
                            @csrf 
                            <input type="hidden" name="tab" value="cla">
                            <div class="panel-body">
            
                                <div class="row">
                    
                                    <div class="col-md-2 ">
                                        <div class="form-group @if($errors->has('dt_inicial')) has-error @endif ">
                                            <label for="fname">Data Inicial: <span class="red normal">*</span></label>
                                            <input type="date" class="form-control" value="{{old('dt_inicial',$balanco->dt_inicial)}}"     name="dt_inicial"> 
                                            @if($errors->has('dt_inicial'))
                                                <div class="error">{{ $errors->first('dt_inicial') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-2 ">
                                        <div class="form-group @if($errors->has('dt_final')) has-error @endif ">
                                            <label for="fname">Data Inicial: <span class="red normal">*</span></label>
                                            <input type="date" class="form-control" value="{{old('dt_final',$balanco->dt_final)}}"  name="dt_final"> 
                                            @if($errors->has('dt_final'))
                                                <div class="error">{{ $errors->first('dt_final') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2 ">
                                        <div style="margin-top: 22px;" class="form-group @if($errors->has('dt_final')) has-error @endif ">
                                            <button class="btn btn-danger">Pesquisar</button>
                                        </div>
                                    </div>
                                </div>  
            
                            </div>
                        </form>

                        <form action="{{ route('balancomassa-entrada', $balanco) }}" method="post"   >
                            @csrf 
                            <input type="hidden" name="tipo_entrada" value="classificacao">
                            <table class="table table-striped" style="margin-bottom: 0">
                                <thead>
                                    <tr class="active"> 
                                        <th>###</th>   
                                        <th>Codigo</th>   
                                        <th class="text-center">Data </th>  
                                        <th class="text-right">Resíduo</th> 
                                        <th class="text-right">Terra</th> 
                                        <th class="text-right">Sujeira</th>   
                                        <th class="text-right">Verdes</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    @php
                                        $residuo= 0;  $terra= 0;  $sujeira= 0;  $verde= 0;  $total= 0;
                                    @endphp
                                    @if(isset($retorno['classificacao']))
                                    @foreach ( $retorno['classificacao'] as $linha )
                                        @php
                                            $terra=$terra+$linha->terra;
                                            $residuo=$residuo+$linha->residuo;
                                            $sujeira=$sujeira+$linha->sujeira;
                                            $verde=$verde+$linha->verde;
                                            $total=$total+$linha->total;
                                        @endphp
                                        <tr  >
                                            <td>
                                                <div class="checkbox" style="margin-top: 0px;   margin-bottom: 0px;">
                                                    <label>
                                                        <input type="checkbox" name="codigo[]" @if($linha->cd_classif) checked @endif  value="{{ $linha->cd_classificacao }}">  
                                                    </label>
                                                </div>
                                            </td>
                                            <td  >{{ $linha->cd_classificacao }}</td>  
                                            <td class="text-center">{{  date( 'd/m/Y' , strtotime( $linha->dt_recebimento ) ) }}</td>  
                                            <td class="text-right">{{ $linha->residuo }}</td> 
                                            <td class="text-right">{{ $linha->terra }}</td> 
                                            <td class="text-right" >{{ $linha->sujeira  }}</td> 
                                            <td class="text-right">{{ $linha->verde }}</td>   
                                            <td class="text-right">{{ $linha->total }}</td> 
                                        </tr>
                                    @endforeach
                                    @endif
                                    <tr class="active"> 
                                        <th>--</th>   
                                        <th>--</th>   
                                        <th class="text-center">-- </th>  
                                        <th class="text-right">{{ $residuo }}</th> 
                                        <th class="text-right">{{ $terra }}</th> 
                                        <th class="text-right">{{ $sujeira }}</th>   
                                        <th class="text-right">{{ $verde }}</th>
                                        <th class="text-right">{{ $total }}</th>
                                    </tr>
                                 
                                </tbody>
                            </table>
                            <div class="panel-footer">
                                <button class="btn btn-danger">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                   
                </div>
            </div>


        </div>
    </div>

    <x-slot name="scripts"> 
  
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('app', () => ({  
                    
                    TotalInvalido:false, 
                    verde :null,
                    praga : null,
                    fungo : null,
                    desintegrado : null,
                    defeito : null,
                    impureza : null,
                    terra : null,
                    fruto : null,
                    total : null,
                    
                    init() {
                        
                    },
                 
                    caluculosAnalises(){ 
                        this.verde = ($("input[name=verde]").val()),
                        this.praga = $("input[name=praga]").val(),
                        this.fungo = $("input[name=fungo]").val(),
                        this.desintegrado = $("input[name=desintegrado]").val(),
                        this.defeito = $("input[name=defeito]").val(),
                        this.impureza = $("input[name=impureza]").val(),
                        this.terra = $("input[name=terra]").val(),
                        this.fruto = $("input[name=fruto]").val(), 
                        this.total= (  
                                       parseFloat( (this.verde)? this.verde.replace(',', '.') :0 ) +  
                                       parseFloat( (this.praga)? this.praga.replace(',', '.') :0 ) +  
                                       parseFloat( (this.fungo)? this.fungo.replace(',', '.') :0 ) +  
                                       parseFloat( (this.desintegrado)? this.desintegrado.replace(',', '.') :0 ) +  
                                       parseFloat( (this.defeito)? this.defeito.replace(',', '.') :0 ) +  
                                       parseFloat( (this.impureza)? this.impureza.replace(',', '.') :0 ) +  
                                       parseFloat( (this.terra)? this.terra.replace(',', '.') :0 ) +  
                                       parseFloat( (this.fruto)? this.fruto.replace(',', '.') :0 )  
                                    );
 
                        $("input[name=total]").val(this.total);
                    }

                     
          
                }))
            })
        
          
         
        </script>


     </x-slot>
</x-layout.colonial.layout>
