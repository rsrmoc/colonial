<x-layout.colonial.layout>
     
    <div class="page-title">
        <h3>Cadastrar Parada de Linha</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('parada-listar') }}">Relação</a></li>
            </ol>
        </div>
    </div>

    <div id="main-wrapper" x-data="app">
        <div class="col-md-12 ">
            <form action="{{ route('parada-store') }}" method="POST" class="panel panel-white">
                @csrf 
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2 col-md-offset-1">
                            <div class="form-group @if($errors->has('data')) has-error @endif ">
                                <label for="fname">Data: <span class="red normal"></span></label>
                                <div class="input-group m-b-sm">
                                    <input type="date" class="form-control" value="{{old('data')}}" id="dataPesq" placeholder="Data" name="data">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" onclick="carregar()" style="background: #f7f7f7"> <i class="fa fa-search red" ></i> </button>
                                    </span>
                                </div> 
                                @if($errors->has('data'))
                                    <div class="error">{{ $errors->first('data') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group @if($errors->has('ordem')) has-error @endif ">
                                <label for="fname">Ordem de Produção: <span class="red normal"> *</span></label>
                                <div id="div_combo"> 
                                    <select class="form-control" name="ordem"  >
                                        <option value="">SELECIONE</option> 
                                        @foreach ($ordem as $valor )
                                            <option value="{{ $valor->DocEntry }}" @if(old('ordem')== $valor->DocEntry) selected  @endif >{!!   $valor->DocEntry . ' - '. date( 'd/m/Y' , strtotime( $valor->DueDate ) ) .  ' [ '.$valor->ProdName.' ] ' !!}</option> 
                                        @endforeach
                                    </select>
                                </div>
                                @if($errors->has('ordem'))
                                    <div class="error">{{ $errors->first('ordem') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group @if($errors->has('tempo')) has-error @endif ">
                                <label for="fname">Tempo (Minutos): <span class="red normal">*</span></label>
                                <input type="number" class="form-control "   value="{{old('tempo')}}" placeholder="Tempo" name="tempo"   />
                                @if($errors->has('tempo'))
                                    <div class="error">{{ $errors->first('tempo') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5 col-md-offset-1">
                            <div class="form-group @if($errors->has('tipo')) has-error @endif ">
                                <label for="fname">Tipo de Parada: <span class="red normal">* </span></label>
                                <select class="form-control" name="tipo"  >
                                    <option value="">SELECIONE</option> 
                                    @foreach ($tipo as $valor )
                                        <option value="{{ $valor->cd_tipo }}" @if(old('tipo')== $valor->cd_tipo) selected  @endif >{!!   mb_strtoupper($valor->nm_tipo)   !!}</option> 
                                    @endforeach
                                </select>
                                @if($errors->has('tipo'))
                                    <div class="error">{{ $errors->first('tipo') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-5 ">
                            <div class="form-group @if($errors->has('equipamento')) has-error @endif ">
                                <label for="fname">Equipamento: <span class="red normal"> </span></label>
                                <select class="form-control" name="equipamento"  >
                                    <option value="">SELECIONE</option> 
                                    @foreach ($equipamento as $valor )
                                        <option value="{{ $valor->cd_equipamento }}" @if(old('equipamento')== $valor->cd_equipamento) selected  @endif >{!! mb_strtoupper($valor->nm_equipamento) !!}</option> 
                                    @endforeach
                                </select>
                                @if($errors->has('equipamento'))
                                    <div class="error">{{ $errors->first('equipamento') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
           
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group @if($errors->has('obs')) has-error @endif ">
                                <label for="fname">Observações Adicionais: <span class="red normal"> </span></label>
                                <textarea  class="form-control " name="obs" >{{old('obs')}}</textarea>
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
        
            carregar = function () { 
                //alert(cod);
                var cod = $("#dataPesq").val(); 
                if(!cod) return false;
                $("#div_combo").empty().html('<div class="form-control" style="text-align: center;"><i class="fa fa-spinner  fa-spin" aria-hidden="true" ></i> Carregando Ordens de Produção </div>');  
                $.ajax({ 
                    type: "GET",
                    data: null,
                    url: '/colonial/parada-combo/'+cod, 
                    success: function(pegar_dados) {  
                        complete:$("#div_combo").empty().html(pegar_dados);
                    }
                })
                 
            }
    
        </script>
     </x-slot>

</x-layout.colonial.layout>
