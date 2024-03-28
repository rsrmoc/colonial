<x-layout.colonial.layout>
    <div class="page-title">
        <h3>Editar Usuário</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('usuarios-listar') }}">Relação</a></li>
            </ol>
        </div>
    </div>

    <div id="main-wrapper" x-data="app">
        <div class="col-md-12 ">
            <form action="{{ route('usuarios-update', ['usuario' => $usuario->id]) }}" method="POST" class="panel panel-white">
                @csrf

                <div class="panel-body">
                    <div class="row">

                        <div class="col-md-5">
                            <div class="form-group @if($errors->has('email')) has-error @endif ">
                                <input type="email" class="form-control" placeholder="Email" name="email" required value="{{ old('email',$usuario->email)  }}" />
                                @if($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group @if($errors->has('nome')) has-error @endif ">
                                <input type="text" class="form-control" placeholder="Nome" name="nome" required value="{{ old('nome',$usuario->name)  }}" />
                                @if($errors->has('nome'))
                                    <div class="error">{{ $errors->first('nome') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group @if($errors->has('sexo')) has-error @endif ">
                                <label for="fname">Sexo: <span class="red normal"> </span></label>
                                <select class="form-control" name="sexo"  >
                                    <option value="">SELECIONE</option>
                                    <option value="F" @if(old('sexo',$usuario->sexo)=='F') selected @endif >FEMININO</option>
                                    <option value="M" @if(old('sexo',$usuario->sexo)=='M') selected @endif>MASCULINO</option> 
                                </select>
                                @if($errors->has('sexo'))
                                    <div class="error">{{ $errors->first('sexo') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group @if($errors->has('celular')) has-error @endif ">
                                <label for="fname">Celular: <span class="red normal">*</span></label>
                                <input type="text" class="form-control" placeholder="Celular" name="celular" value="{{old('celular',$usuario->fone)}}" required />    
                                @if($errors->has('celular'))
                                    <div class="error">{{ $errors->first('celular') }}</div>
                                @endif
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group @if($errors->has('perfil')) has-error @endif ">
                                <label for="fname">Perfil: <span class="red normal"> </span></label>
                                <select class="form-control" name="perfil"  >
                                    @foreach ($perfil as $valor )
                                        <option value="{{ $valor->cd_perfil }}" @if(old('perfil',$usuario->cd_perfil)== $valor->cd_perfil) selected  @endif >{{ $valor->nm_perfil }}</option> 
                                    @endforeach
                                </select>
                                @if($errors->has('perfil'))
                                    <div class="error">{{ $errors->first('perfil') }}</div>
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
