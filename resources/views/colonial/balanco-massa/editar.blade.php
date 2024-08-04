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
                    <li role="presentation" class="active"><a href="#tabBalanco" role="tab" data-toggle="tab">Balanço de Massa</a></li>
                    <li role="presentation"><a href="#tabAcumulado" role="tab" data-toggle="tab">Acumulado Entrada de Tomate</a></li>
                    <li role="presentation"><a href="#tabClassificacao" role="tab" data-toggle="tab">Classificação de Tomate</a></li> 
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                   
                    <form action="{{ route('balancomassa-update', $balanco) }}" method="POST" role="tabpanel" class="tab-pane active fade in" id="tabBalanco"    >
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
                                            <select class="form-control"  name="cd_fornecedor"  >
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
         
         
        
        
         
                        </div>
        
                        <div class="panel-footer">
                            <button class="btn btn-danger">Cadastrar</button>
                        </div>
                    </form>

                    <form action="{{ route('balancomassa-update', $balanco) }}" method="POST" role="tabpanel" class="tab-pane fade" id="tabAcumulado" >
                        @csrf 
        
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

                        <table class="table table-striped" style="margin-bottom: 0">
                            <thead>
                                <tr class="active">
                                    <th>Codigo</th>
                                    <th class="text-left">Descrição</th>     
                                    <th class="text-center">Data Inicial</th>  
                                    <th class="text-center">Data Final</th> 
                                    <th class="text-left">Fornecedor</th> 
                                    <th class="text-right">Brix Ponderado</th>  
                                    <th class="text-center">Ação</th>
                                </tr>
                            </thead>
    
                            <tbody>

                            </tbody>
                        </table>
        
                     
                    </form>
                     
                    
                    <div role="tabpanel" class="tab-pane fade" id="tabClassificacao">
                        <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>
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
