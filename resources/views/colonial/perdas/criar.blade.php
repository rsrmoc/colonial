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
                        <div class="col-md-2 col-md-offset-1">
                            <div class="form-group @if($errors->has('data')) has-error @endif ">
                                <label for="fname">Data: <span class="red normal"></span></label>
                                <div class="input-group m-b-sm">
                                    <input type="date" class="form-control" value="{{old('data')}}" id="dataPesq" placeholder="Data" name="data">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" onclick="carregar_ordem()" style="background: #f7f7f7"> <i class="fa fa-search red" ></i> </button>
                                    </span>
                                </div> 
                                @if($errors->has('data'))
                                    <div class="error">{{ $errors->first('data') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group @if($errors->has('ordem')) has-error @endif ">
                                <label for="fname" style="font-weight: 700">Ordem de Produção: <span class="red normal"> </span></label>
                                <div id="div_combo_ordem"> 
                                    <select class="form-control" onchange="carregar(this.value)" name="ordem"  >
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
                    </div>

                    <div id="div_combo">


                    </div>

           
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 " >
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
