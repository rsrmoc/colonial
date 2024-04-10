<x-layout.colonial.layout>
    <div class="page-title">
        <h3>Editar Tipo de Perda</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('tipoperda-listar') }}">Relação</a></li>
            </ol>
        </div>
    </div>

    <div id="main-wrapper" x-data="app">
        <div class="col-md-12 ">
            <form action="{{ route('tipoperda-update', $tipo) }}" method="POST" class="panel panel-white">
                @csrf
                
                <div class="panel-body">
                    <div class="row">
                   
                        <div class="col-md-4">
                            <div class="form-group @if($errors->has('nm_tipo')) has-error @endif ">
                                <label for="fname">Consumo (Kw): <span class="red normal">*</span></label>
                                <input type="text" class="form-control " value="{{old('nm_tipo', $tipo->nm_tipo)}}" placeholder="Descrição" name="nm_tipo"   />
                                @if($errors->has('nm_tipo'))
                                    <div class="error">{{ $errors->first('nm_tipo') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
           
 
                </div>

                <div class="row">

                 

                    <div class="checkbox col-md-4" >
                        <div class="form-group @if($errors->has('nm_tipo')) has-error @endif ">
                            <label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="checker">
                                    <span>
                                        <input type="checkbox" name="sn_ativo" value="N"
                                        @if($tipo->sn_ativo=='N') checked @endif />
                                    </span>
                                </div>  
                                &nbsp; Inativar Cadastro 
                            </label>
                            @if($errors->has('sn_ativo'))
                                <div class="error">{{ $errors->first('sn_ativo') }}</div>
                            @endif
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
