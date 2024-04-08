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
                        <div class="col-md-5">
                            <div class="form-group @if($errors->has('ordem')) has-error @endif ">
                                <label for="fname">Ordem de Produção: <span class="red normal"> </span></label>
                                <select class="form-control" name="ordem"  >
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
                        <div class="col-md-4">
                            <div class="form-group @if($errors->has('tipo')) has-error @endif ">
                                <label for="fname">Tipo de Parada: <span class="red normal"> </span></label>
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
 


</x-layout.colonial.layout>
