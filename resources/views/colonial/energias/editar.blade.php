<x-layout.colonial.layout>
    <div class="page-title">
        <h3>Editar Consumo de Energia</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('energia-listar') }}">Relação</a></li>
            </ol>
        </div>
    </div>

    <div id="main-wrapper" x-data="app">
        <div class="col-md-12 ">
            <form action="{{ route('energia-update', $energia) }}" method="POST" class="panel panel-white">
                @csrf
                
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group @if($errors->has('dt_consumo')) has-error @endif ">
                                <label for="fname">Data do Consumo: <span class="red normal">*</span></label>
                                <input type="date" class="form-control" value="{{ old('dt_consumo',substr($energia->dt_consumo,0,10)) }}" placeholder="Data do Consumo" name="dt_consumo"   />
                                @if($errors->has('dt_consumo'))
                                    <div class="error">{{ $errors->first('dt_consumo') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group @if($errors->has('consumo')) has-error @endif ">
                                <label for="fname">Consumo (Kw): <span class="red normal">*</span></label>
                                <input type="text" class="form-control " x-mask:dynamic="$money($input, ',')" value="{{old('consumo', str_replace('.', ',', $energia->qtde))}}" placeholder="Consumo" name="consumo"   />
                                @if($errors->has('consumo'))
                                    <div class="error">{{ $errors->first('consumo') }}</div>
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
