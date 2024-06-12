<x-layout.colonial.layout>
     
    <div class="page-title">
        <h3>Classificação de Tomate </h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('classificacaotomate-listar') }}">Relação</a></li>
            </ol>
        </div>
    </div>

    <div id="main-wrapper" x-data="app">
        <div class="col-md-12 ">
            <form action="{{ route('classificacaotomate-store') }}" method="POST" class="panel panel-white">
                @csrf 
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2  col-md-offset-1">
                            <div class="form-group @if($errors->has('dt_recebimento')) has-error @endif ">
                                <label for="fname">Data: <span class="red normal"></span></label>
                                <input type="date" class="form-control" value="{{old('dt_recebimento')}}"  placeholder="Data" name="dt_recebimento"> 
                                @if($errors->has('dt_recebimento'))
                                    <div class="error">{{ $errors->first('dt_recebimento') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="form-group @if($errors->has('total')) has-error @endif ">
                                <label for="fname">Total(KG): <span class="red normal">*</span></label>
                                <input type="text" class="form-control" value="{{old('total')}}" placeholder="Peso Total" x-mask:dynamic="$money($input, ',')"  name="total"> 
                                @if($errors->has('total'))
                                    <div class="error">{{ $errors->first('total') }}</div>
                                @endif
                            </div>
                        </div>
                            
                    </div>

                    <h4>Resultado da Classificação em percentais Análises Físicas </h4>

                    <div class="row">
                        <div class="col-md-2  col-md-offset-1 ">
                            <div class="form-group @if($errors->has('residuo')) has-error @endif ">
                                <label for="fname">Resíduos: <span class="red normal"> * </span></label>
                                <input type="text" class="form-control" value="{{old('residuo')}}" x-mask:dynamic="$money($input, ',')" placeholder="Residuo" name="residuo"> 
                                @if($errors->has('residuo'))
                                    <div class="error">{{ $errors->first('residuo') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-2 ">
                            <div class="form-group @if($errors->has('terra')) has-error @endif ">
                                <label for="fname">Terra: <span class="red normal"> * </span></label>
                                <input type="text" class="form-control" value="{{old('terra')}}"  x-mask:dynamic="$money($input, ',')" placeholder="Terra" name="terra"> 
                                @if($errors->has('terra'))
                                    <div class="error">{{ $errors->first('terra') }}</div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-md-2 ">
                            <div class="form-group @if($errors->has('sujeira')) has-error @endif ">
                                <label for="fname">Sujeira: <span class="red normal"> * </span></label>
                                <input type="text" class="form-control" value="{{old('sujeira')}}" x-mask:dynamic="$money($input, ',')" placeholder="Sujeira" name="sujeira"> 
                                @if($errors->has('sujeira'))
                                    <div class="error">{{ $errors->first('sujeira') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group @if($errors->has('verde')) has-error @endif ">
                                <label for="fname">Verdes(%):  <span class="red normal"> * </span></label>
                                <input type="text" class="form-control" value="{{old('verde')}}" x-mask:dynamic="$money($input, ',')"  placeholder="Verdes" name="verde"> 
                                @if($errors->has('verde'))
                                    <div class="error">{{ $errors->first('verde') }}</div>
                                @endif
                            </div>
                        </div>
 
                    </div>
   
                    <div class="row" >
                        <div class="col-md-8 col-sm-8 col-xs-8  col-md-offset-1" >
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
