<x-layout.colonial.layout>
    <div class="page-title">
        <h3>Editar Equipamento</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('equipamento-listar') }}">Relação</a></li>
            </ol>
        </div>
    </div>

    <div id="main-wrapper" x-data="app">
        <div class="col-md-12 ">
            <form action="{{ route('equipamento-update', $equipamento) }}" method="POST" class="panel panel-white">
                @csrf
                
                <div class="panel-body">
                    <div class="row">
                   
                        <div class="col-md-4">
                            <div class="form-group @if($errors->has('nm_equipamento')) has-error @endif ">
                                <label for="fname">Nome: <span class="red normal">*</span></label>
                                <input type="text" class="form-control " value="{{old('nm_equipamento', $equipamento->nm_equipamento)}}" placeholder="Descrição" name="nm_equipamento"   />
                                @if($errors->has('nm_equipamento'))
                                    <div class="error">{{ $errors->first('nm_equipamento') }}</div>
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
