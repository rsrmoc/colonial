<x-layout.colonial.layout>
    <div class="page-title">
        <h3>Editar Usuário</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('perfis-listar') }}">Relação</a></li>
            </ol>
        </div>
    </div>

    <div id="main-wrapper" x-data="app">
        <div class="col-md-12 ">
            <form action="{{ route('perfis-update', $perfil) }}" method="POST" class="panel panel-white">
                @csrf

                <div class="panel-body">
                    <div class="row">

                        <div class="col-md-5">
                            <div class="form-group @if($errors->has('nome')) has-error @endif ">
                                <input type="text" class="form-control" placeholder="Descrição" name="nome" required value="{{ old('nome',$perfil->nm_perfil)  }}" />
                                @if($errors->has('nome'))
                                    <div class="error">{{ $errors->first('nome') }}</div>
                                @endif
                            </div>
                        </div> 
                    </div>
 
                    <div class="row">
                        <div class="col-md-10">
                            <table class="table table-striped" style="margin-bottom: 0">
                                <thead>
                                    <tr class="active">
                                        <th>Página</th>

                                        <th>Permissões</th>
                                    </tr>
                                </thead>

                                <tbody>
                                   
                                    @foreach ($permissoes as $tela)
                                        
                                        <tr>
                                            <td>{{ $tela->cd_permissao }}</td>

                                            <td>
                                                <div style="display: flex">
                                                    @if(strpos($tela->opcao, 'ver') !== false)
                                                        <div class="checkbox" style="margin: 0">
                                                            <label>
                                                                <div class="checker">
                                                                    <span>
                                                                        <input type="checkbox" name="permissoes[{{ $tela->cd_permissao }}][]" value="ver"
                                                                        @if(strpos($tela->user_permissao['permissoes'], 'ver') !== false) checked @endif />
                                                                    </span>
                                                                </div> Ver
                                                            </label>
                                                        </div>
                                                    @endif
 

                                                    @if(strpos($tela->opcao, 'criar') !== false)
                                                        <div class="checkbox" style="margin: 0">
                                                            <label>
                                                                <div class="checker">
                                                                    <span>
                                                                        <input type="checkbox" name="permissoes[{{ $tela->cd_permissao }}][]" value="criar"
                                                                        @if(strpos($tela->user_permissao['permissoes'], 'criar') !== false) checked @endif />
                                                                    </span>
                                                                </div> Criar/Editar
                                                            </label>
                                                        </div>
                                                    @endif

                                                 
                                                    @if(strpos($tela->opcao, 'excluir') !== false)
                                                        <div class="checkbox" style="margin: 0">
                                                            <label>
                                                                <div class="checker">
                                                                    <span>
                                                                        <input type="checkbox" name="permissoes[{{ $tela->cd_permissao }}][]" value="excluir"
                                                                        @if(strpos($tela->user_permissao['permissoes'], 'excluir') !== false) checked @endif />
                                                                    </span>
                                                                </div> Excluir
                                                            </label>
                                                        </div>
                                                    @endif
                                                    
                                                    @if(strpos($tela->opcao, 'detalhes') !== false)
                                                        <div class="checkbox" style="margin: 0">
                                                            <label>
                                                                <div class="checker">
                                                                    <span>
                                                                        <input type="checkbox" name="permissoes[{{ $tela->cd_permissao }}][]" value="detalhes"
                                                                        @if(strpos($tela->user_permissao['permissoes'], 'detalhes')  !== false) checked @endif />
                                                                    </span>
                                                                </div> Detalhes
                                                            </label>
                                                        </div>
                                                    @endif

                                                    @if(strpos($tela->opcao, 'json') !== false)
                                                        <div class="checkbox" style="margin: 0">
                                                            <label>
                                                                <div class="checker">
                                                                    <span>
                                                                        <input type="checkbox" name="permissoes[{{ $tela->cd_permissao }}][]" value="json"
                                                                        @if(strpos($tela->user_permissao['permissoes'], 'json')  !== false) checked @endif />
                                                                    </span>
                                                                </div> Json
                                                            </label>
                                                        </div>
                                                    @endif

                                                    @if(strpos($tela->opcao, 'xls') !== false)
                                                        <div class="checkbox" style="margin: 0">
                                                            <label>
                                                                <div class="checker">
                                                                    <span>
                                                                        <input type="checkbox" name="permissoes[{{ $tela->cd_permissao }}][]" value="xls"
                                                                        @if(strpos($tela->user_permissao['permissoes'], 'xls')  !== false) checked @endif />
                                                                    </span>
                                                                </div> Xls
                                                            </label>
                                                        </div>
                                                    @endif

                                                </div>
                                            </td>
                                        </tr> 
                                    @endforeach
 
                                </tbody>
                            </table>
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
