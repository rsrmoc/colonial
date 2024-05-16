<x-layout.colonial.layout>
     
    <div class="page-title">
        <h3>Cadastrar Recebimento de Tomate </h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('parada-listar') }}">Relação</a></li>
            </ol>
        </div>
    </div>

    <div id="main-wrapper" x-data="app">
        <div class="col-md-12 ">
            <form action="{{ route('recebimentotomate-store') }}" method="POST" class="panel panel-white">
                @csrf 
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2 ">
                            <div class="form-group @if($errors->has('dt_recebimento')) has-error @endif ">
                                <label for="fname">Data: <span class="red normal"></span></label>
                                <input type="date" class="form-control" value="{{old('dt_recebimento')}}"  placeholder="Data" name="dt_recebimento"> 
                                @if($errors->has('dt_recebimento'))
                                    <div class="error">{{ $errors->first('dt_recebimento') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-1 ">
                            <div class="form-group @if($errors->has('hr_inicial')) has-error @endif ">
                                <label for="fname">Hora Inicial: <span class="red normal"></span></label>
                                <input type="time" class="form-control" value="{{old('hr_inicial')}}"  name="hr_inicial"> 
                                @if($errors->has('hr_inicial'))
                                    <div class="error">{{ $errors->first('hr_inicial') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-1 ">
                            <div class="form-group @if($errors->has('hr_final')) has-error @endif ">
                                <label for="fname">Hora Final: <span class="red normal"></span></label>
                                <input type="time" class="form-control" value="{{old('hr_final')}}"  name="hr_final"> 
                                @if($errors->has('hr_final'))
                                    <div class="error">{{ $errors->first('hr_final') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="form-group @if($errors->has('nr_controle')) has-error @endif ">
                                <label for="fname">Nr.Controle: <span class="red normal"></span></label>
                                <input type="text" class="form-control" value="{{old('nr_controle')}}"  placeholder="Nr.Controle" name="nr_controle"> 
                                @if($errors->has('nr_controle'))
                                    <div class="error">{{ $errors->first('nr_controle') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="form-group @if($errors->has('placa')) has-error @endif ">
                                <label for="fname">Placa: <span class="red normal"></span></label>
                                <input type="text" class="form-control" value="{{old('placa')}}" id="dataPesq" placeholder="Placa" name="placa"> 
                                @if($errors->has('placa'))
                                    <div class="error">{{ $errors->first('placa') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group @if($errors->has('fornecedor')) has-error @endif ">
                                <label for="fname" >Fornecedor: <span class="red normal"> </span></label>
                                <div id="div_combo_ordem"> 
                                    <select class="form-control"  name="fornecedor"  >
                                        <option value="">SELECIONE</option> 
                                        <option value="1">SELECIONE XX</option> 
                                        <option value="2">SELECIONE ZZ</option> 
                                      
                                    </select>
                                </div>
                                @if($errors->has('fornecedor'))
                                    <div class="error">{{ $errors->first('fornecedor') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <h4>Resultado da Classificação em percentais Análises Físicas </h4>

                    <div class="row">
                        <div class="col-md-2 col-md-offset-1 ">
                            <div class="form-group @if($errors->has('verde')) has-error @endif ">
                                <label for="fname">Verdes(%):  <span class="red normal"> * [ Padrão 5 ]</span></label>
                                <input type="text" class="form-control" value="{{old('verde')}}" placeholder="Verdes" name="verde"> 
                                @if($errors->has('verde'))
                                    <div class="error">{{ $errors->first('verde') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="form-group @if($errors->has('praga')) has-error @endif ">
                                <label for="fname">Pragas Lesões(%): <span class="red normal">* [ Padrão 2 ]</span></label>
                                <input type="text" class="form-control" value="{{old('praga')}}" placeholder="Pragas" name="praga"> 
                                @if($errors->has('praga'))
                                    <div class="error">{{ $errors->first('praga') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="form-group @if($errors->has('fungo')) has-error @endif ">
                                <label for="fname">Fungos, Poderes(%): <span class="red normal">* [ Padrão 5 ]</span></label>
                                <input type="text" class="form-control" value="{{old('fungo')}}" placeholder="Fungos" name="fungo"> 
                                @if($errors->has('fungo'))
                                    <div class="error">{{ $errors->first('fungo') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="form-group @if($errors->has('desintegrado')) has-error @endif ">
                                <label for="fname">Desintegrados(%): <span class="red normal">* [ Padrão 8 ]</span></label>
                                <input type="text" class="form-control" value="{{old('desinte')}}" placeholder="Desintegrados" name="desintegrado"> 
                                @if($errors->has('desintegrado'))
                                    <div class="error">{{ $errors->first('desintegrado') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 col-md-offset-1 ">
                            <div class="form-group @if($errors->has('defeito')) has-error @endif ">
                                <label for="fname">Def. Gerais(%): <span class="red normal">*  [ Padrão 10 ]</span></label>
                                <input type="text" class="form-control" value="{{old('defeito')}}" placeholder="Def. Gerais" name="defeito"> 
                                @if($errors->has('defeito'))
                                    <div class="error">{{ $errors->first('defeito') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="form-group @if($errors->has('impureza')) has-error @endif ">
                                <label for="fname">Impurezas(%): <span class="red normal">*  [ Padrão Ausência ]</span></label>
                                <input type="text" class="form-control" value="{{old('impureza')}}" placeholder="Impurezas" name="impureza"> 
                                @if($errors->has('impureza'))
                                    <div class="error">{{ $errors->first('impureza') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="form-group @if($errors->has('terra')) has-error @endif ">
                                <label for="fname">Terra(%): <span class="red normal">* [ Padrão Ausência ]</span></label>
                                <input type="text" class="form-control" value="{{old('terra')}}" placeholder="Terra" name="terra"> 
                                @if($errors->has('terra'))
                                    <div class="error">{{ $errors->first('terra') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="form-group @if($errors->has('fruto')) has-error @endif ">
                                <label for="fname">Frutos Bons(%): <span class="red normal">* [ Min. 40 ]</span></label>
                                <input type="text" class="form-control" value="{{old('fruto')}}" placeholder="Frutos" name="fruto"> 
                                @if($errors->has('fruto'))
                                    <div class="error">{{ $errors->first('fruto') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="form-group @if($errors->has('total')) has-error @endif ">
                                <label for="fname">Total(%): <span class="red normal">*</span></label>
                                <input type="text" class="form-control" value="{{old('total')}}"   placeholder="Total" name="total"> 
                                @if($errors->has('total'))
                                    <div class="error">{{ $errors->first('total') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <h4>Análisas Químicas</h4>

                    <div class="row">
                        <div class="col-md-2 col-md-offset-1 ">
                            <div class="form-group @if($errors->has('brix')) has-error @endif ">
                                <label for="fname">Brix: <span class="red normal">*</span></label>
                                <input type="text" class="form-control" value="{{old('brix')}}" placeholder="Brix" name="brix"> 
                                @if($errors->has('brix'))
                                    <div class="error">{{ $errors->first('brix') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="form-group @if($errors->has('ph')) has-error @endif ">
                                <label for="fname">PH: <span class="red normal">*</span></label>
                                <input type="text" class="form-control" value="{{old('ph')}}" placeholder="PH" name="ph"> 
                                @if($errors->has('ph'))
                                    <div class="error">{{ $errors->first('ph') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="form-group @if($errors->has('acidez')) has-error @endif ">
                                <label for="fname">Acidez: <span class="red normal">*</span></label>
                                <input type="text" class="form-control" value="{{old('acidez')}}" placeholder="Acidez" name="acidez"> 
                                @if($errors->has('acidez'))
                                    <div class="error">{{ $errors->first('acidez') }}</div>
                                @endif
                            </div>
                        </div> 
                    </div>
                    
                    <h4>Pesos(KG)</h4>

                    <div class="row">
                        <div class="col-md-2 col-md-offset-1 ">
                            <div class="form-group @if($errors->has('liquido')) has-error @endif ">
                                <label for="fname">Líquido Balança(KG): <span class="red normal">*</span></label>
                                <input type="text" class="form-control" value="{{old('brix')}}" placeholder="Líquido Balança" name="liquido"> 
                                @if($errors->has('liquido'))
                                    <div class="error">{{ $errors->first('liquido') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="form-group @if($errors->has('desconto')) has-error @endif ">
                                <label for="fname">Desconto(KG): <span class="red normal">*</span></label>
                                <input type="text" class="form-control" value="{{old('desconto')}}" placeholder="Desconto" name="desconto"> 
                                @if($errors->has('desconto'))
                                    <div class="error">{{ $errors->first('desconto') }}</div>
                                @endif
                            </div>
                        </div> 
                    </div>


                    <div class="row" >
                        <div class="col-md-10 col-sm-10 col-xs-10  col-md-offset-1" >
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
