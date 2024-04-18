<x-layout.colonial.layout>
    <div class="page-title">
        <h3>Cadastrar Usuário</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('perfis-listar') }}">Relação</a></li>
            </ol>
        </div>
    </div>

    <div id="main-wrapper" x-data="app">
        <div class="col-md-12 ">
            <form action="{{ route('perfis-store') }}" method="POST" class="panel panel-white">
                @csrf

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group @if($errors->has('nome')) has-error @endif ">
                                <label for="fname">Nome do Perfil: <span class="red normal">*</span></label>
                                <input type="text" class="form-control" value="{{old('nome')}}" placeholder="Descrição" name="nome" required />
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
                                                                        <input type="checkbox" name="permissoes[{{ $tela->cd_permissao }}][]" value="ver" />
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
                                                                        <input type="checkbox" name="permissoes[{{ $tela->cd_permissao }}][]" value="criar" />
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
                                                                        <input type="checkbox" name="permissoes[{{ $tela->cd_permissao }}][]" value="excluir" />
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
                                                                        <input type="checkbox" name="permissoes[{{ $tela->cd_permissao }}][]" value="detalhes" />
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
                                                                        <input type="checkbox" name="permissoes[{{ $tela->cd_permissao }}][]" value="json" />
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
                                                                        <input type="checkbox" name="permissoes[{{ $tela->cd_permissao }}][]" value="xls" />
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
