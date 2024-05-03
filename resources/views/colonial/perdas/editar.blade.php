<x-layout.colonial.layout>
    <div class="page-title">
        <h3>Editar Perda Por Produção </h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('perda-listar') }}">Relação</a></li>
            </ol>
        </div>
    </div>

    <div id="main-wrapper" x-data="app">
        <div class="col-md-12 ">
            <form action="{{ route('perda-update', $perda) }}" method="POST" class="panel panel-white">
                @csrf
                
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1"> 
                            <div class="form-group @if($errors->has('ordem')) has-error @endif ">
                                <label for="fname" style="font-weight: 700">Ordem de Produção: <span class="red normal"> </span></label>
                                @foreach ($ordem as $valor )
                                <input type="hidden" name="ordem" value="{{ $valor->DocEntry }}">
                                <div class="form-control" style="text-align: left;">{!!   $valor->DocEntry . ' - '. date( 'd/m/Y' , strtotime( $valor->DueDate ) ) .  ' [ '.$valor->ProdName.' ] ' !!}</div>
                                @endforeach
                                
                                @if($errors->has('ordem'))
                                    <div class="error">{{ $errors->first('ordem') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="row"> 
                        <div class="col-md-6 ">
                            <div class="  " >
                                <label for="fname"><strong> Produto: </strong> <span class="red normal">*</span></label> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="  ">
                                <label for="fname"><strong>Tipo de Perda:</strong> <span class="red normal">*</span></label> 
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="  ">
                                <label for="fname"><strong>Qtde.:</strong> <span class="red normal">*</span></label> 
                            </div>
                        </div>
                    </div>
                    
                    <div id="div_combo">
                        @foreach ($prodPerda as $valProd )
                            <input type="hidden" name="produto[]" value="{{ $valProd->cd_produto }}">
                            <div class="row"> 
                                <div class="col-md-6  ">
                                    <div class="form-group @if($errors->has('produto')) has-error @endif ">  
                                        <div class="form-control" style="text-align: left;">{{ $valProd->nm_produto }}</div>
                                        </div>
                                        @if($errors->has('produto'))
                                            <div class="error">{{ $errors->first('produto') }}</div>
                                        @endif
                                    </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group @if($errors->has('tipo')) has-error @endif "> 
                                        <select class="form-control" name="tipo[]"  >
                                            <option value="">SELECIONE</option> 
                                            @foreach ($tipo as $valor )
                                                <option value="{{ $valor->cd_tipo }}" @if(old('tipo',$valProd->cd_tipo_perda)==  $valor->cd_tipo) selected  @endif >{!!   $valor->nm_tipo   !!}</option> 
                                            @endforeach
                                        </select>
                                        @if($errors->has('tipo'))
                                            <div class="error">{{ $errors->first('tipo') }}</div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-md-2">
                                    <div class="form-group @if($errors->has('qtde')) has-error @endif "> 
                                        <input type="number" class="form-control "   value="{{ old('qtde',round($valProd->qtde,0)) }}" placeholder="Qtde" name="qtde[]"   />
                                        @if($errors->has('qtde'))
                                            <div class="error">{{ $errors->first('qtde') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div> 
                        @endforeach
                    </div>
           
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group @if($errors->has('obs')) has-error @endif ">
                                <label for="fname">Observações Adicionais: <span class="red normal"> </span></label>
                                <textarea  class="form-control " name="obs" >{{old('obs',$perda->obs_perda)}}</textarea>
                                @if($errors->has('obs'))
                                    <div class="error">{{ $errors->first('obs') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>


 
                </div>

                <div class="panel-footer">
                    <button class="btn btn-danger">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>

    <x-slot name="scripts"> 
        <script>
        
            carregar = function (cod) { 
                $("#div_combo").empty().html('<div class="form-control" style="text-align: center;"><i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i> Carregando Produtos </div>');  
                $.ajax({ 
                    type: "GET",
                    data: null,
                    url: '/colonial/perda-combo/'+cod, 
                    success: function(pegar_dados) {  
                        complete:$("#div_combo").empty().html(pegar_dados);
                    }
                }) 
            }
    
            carregar_ordem = function () { 
                    var cod = $("#dataPesq").val();  
                    if(!cod) return false;
                    $("#div_combo_ordem").empty().html('<div class="form-control" style="text-align: center;"><i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i> Carregando Ordens de Produção </div>');  
                    $.ajax({ 
                        type: "GET",
                        data: null,
                        url: '/colonial/parada-combo/'+cod+"?perda=true", 
                        success: function(pegar_dados) {  
                            complete:$("#div_combo_ordem").empty().html(pegar_dados);
                        }
                    })
                     
                }
    
        </script>
     </x-slot>
</x-layout.colonial.layout>
