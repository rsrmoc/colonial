<x-layout.colonial.layout>
    <div class="page-title">
        <h3>Editar Consumo Hídrico</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('hidrico-listar') }}">Relação</a></li>
            </ol>
        </div>
    </div>

    <div id="main-wrapper" x-data="app">
        <div class="col-md-12 ">
            <form action="{{ route('hidrico-update', $hidrico) }}" method="POST" class="panel panel-white">
                @csrf
                
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group @if($errors->has('dt_consumo')) has-error @endif ">
                                <label for="fname">Data do Consumo: <span class="red normal">*</span></label>
                                <input type="date" class="form-control" value="{{old('dt_consumo',substr($hidrico->dt_consumo,0,10)) }}" placeholder="Data do Consumo" name="dt_consumo"   />
                                @if($errors->has('dt_consumo'))
                                    <div class="error">{{ $errors->first('dt_consumo') }}</div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="form-group @if($errors->has('consumo_anterior')) has-error @endif ">
                                <label for="fname">Consumo Anterior: <span class="red normal">*</span></label>
                                <input type="text" class="form-control " x-mask:dynamic="$money($input, ',')" value="{{ old('consumo_anterior', str_replace('.', ',', $hidrico->qtde_anterior)) }}" placeholder="Consumo Anterior" name="consumo_anterior"   />
                                @if($errors->has('consumo_anterior'))
                                    <div class="error">{{ $errors->first('consumo_anterior') }}</div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="form-group @if($errors->has('consumo_atual')) has-error @endif ">
                                <label for="fname">Consumo Atual: <span class="red normal"></span></label>
                                <input type="text" class="form-control " x-mask:dynamic="$money($input, ',')" value="{{ old('consumo_atual', str_replace('.', ',', $hidrico->qtde_atual)) }}" placeholder="Consumo Atual" name="consumo_atual"   />
                                @if($errors->has('consumo_atual'))
                                    <div class="error">{{ $errors->first('consumo_atual') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group @if($errors->has('saldo')) has-error @endif ">
                                <label for="fname">Saldo: <span class="red normal">*</span></label>
                                <input type="text" class="form-control " x-mask:dynamic="$money($input, ',')" value="{{old('saldo', str_replace('.', ',', $hidrico->saldo))}}" placeholder="saldo" name="saldo"   />
                                @if($errors->has('saldo'))
                                    <div class="error">{{ $errors->first('saldo') }}</div>
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
