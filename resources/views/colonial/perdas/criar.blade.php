<x-layout.colonial.layout>
     
    <div class="page-title">
        <h3>Cadastrar Perda Por Produção </h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('parada-listar') }}">Relação</a></li>
            </ol>
        </div>
    </div>

    <div id="main-wrapper" x-data="app">
        <div class="col-md-12 ">
            <form action="{{ route('perda-store') }}" method="POST" class="panel panel-white">
                @csrf 
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group @if($errors->has('ordem')) has-error @endif ">
                                <label for="fname" style="font-weight: 700">Ordem de Produção: <span class="red normal"> </span></label>
                                <select class="form-control" onchange="carregar(this.value)" name="ordem"  >
                                    <option value="">SELECIONE</option> 
                                    @foreach ($ordem as $valor )
                                        <option value="{{ $valor->DocEntry }}" @if(old('ordem')== $valor->DocEntry) selected  @endif >{!!   $valor->DocEntry . ' - '. date( 'd/m/Y' , strtotime( $valor->DueDate ) ) .  ' [ '.$valor->ProdName.' ] ' !!}</option> 
                                    @endforeach
                                </select>
                                @if($errors->has('ordem'))
                                    <div class="error">{{ $errors->first('ordem') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-5">
                            <div class="form-group @if($errors->has('produto')) has-error @endif ">
                                <label for="fname">Produto: <span class="red normal"> </span></label>
                                <div id="div_combo">
                                    <select class="form-control" name="produto"  >
                                        <option value="">SELECIONE</option> 
                                     
                                    </select>
                                </div>
                                @if($errors->has('produto'))
                                    <div class="error">{{ $errors->first('produto') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group @if($errors->has('tipo')) has-error @endif ">
                                <label for="fname">Tipo de Perda: <span class="red normal"> </span></label>
                                <select class="form-control" name="tipo"  >
                                    <option value="">SELECIONE</option> 
                                    @foreach ($tipo as $valor )
                                        <option value="{{ $valor->cd_tipo }}" @if(old('tipo')== $valor->cd_tipo) selected  @endif >{!!   $valor->nm_tipo   !!}</option> 
                                    @endforeach
                                </select>
                                @if($errors->has('tipo'))
                                    <div class="error">{{ $errors->first('tipo') }}</div>
                                @endif
                            </div>
                        </div>
                         
                        <div class="col-md-2">
                            <div class="form-group @if($errors->has('qtde')) has-error @endif ">
                                <label for="fname">Qtde.: <span class="red normal">*</span></label>
                                <input type="number" class="form-control "   value="{{old('tempo')}}" placeholder="Qtde" name="qtde"   />
                                @if($errors->has('qtde'))
                                    <div class="error">{{ $errors->first('qtde') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
           
                    <div class="row">
                        <div class="col-md-11">
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
    
        carregar = function (cod) { 
            $.ajax({ 
                type: "GET",
                data: null,
                url: '/colonial/perda-combo/'+cod, 
                success: function(pegar_dados) {  
                    complete:$("#div_combo").empty().html(pegar_dados);
                }
            }) 
        }

    </script>
 </x-slot>
</x-layout.colonial.layout>
