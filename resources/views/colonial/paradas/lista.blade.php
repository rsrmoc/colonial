<x-layout.colonial.layout>
    <div class="page-title">
        <h3>Parada de Linha</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('parada-listar') }}">Relação</a></li>
            </ol>
        </div>
    </div>
    <style>
        .btn-xs{
            padding: 0px 10px;
        }
    </style>
    <div id="main-wrapper" x-data="app">
        <div class="col-md-12 ">
            <div class="panel panel-white">
                <div class="panel-heading" style="height: auto">
                    <div style="display: flex; gap: 1em; justify-content: flex-end">
                        <form action="{{ route('parada-listar') }}" method="GET">
                            <div style="display: flex">
                                <input type="search" name="b" placeholder="Pesquisa" required class="form-control"
                                    value="{{ request()->query('b') }}" />

                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>

                        <div>
                            @if (auth()->user()->isPermissao('parada', 'criar'))
                                <a href="{{ route('parada-criar') }}" class="btn btn-danger">
                                    <i class="fa fa-plus"></i> Novo
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-striped" style="margin-bottom: 0">
                        <thead>
                            <tr class="active">
                                <th>Codigo</th>
                                <th class="text-center">Data</th> 
                                <th  >Ordem de Produção</th>  
                                <th  >Produto</th>  
                                <th  >Tipo de Parada</th>  
                                <th class="text-center">Tempo (Min)</th>  
                                <th class="text-center">Ação</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($parada as $linha) 
                                    <tr id="tr-parada-{{  $linha->cd_producao_parada }}">
                                        <th>{{ $linha->cd_producao_parada }}</th> 
                                        <td class="text-center">{{  date( 'd/m/Y' , strtotime( $linha->dt_ordem ) ) }}</td> 
                                        <td>{{ $linha->cd_ordem }}</td> 
                                        <td>{{ $linha['tab_ordem']['ItemCode'].' - '.$linha['tab_ordem']['ProdName'] }}</td> 
                                        <td  >{{ $linha['tab_tipo']['nm_tipo'] }}</td> 
                                        <td class="text-center">{{ $linha->tempo }}</td> 
                                        <td class="text-center"> 
                                                <div class="btn-group">
                                                    @if (auth()->user()->isPermissao('parada', 'criar'))
                                                        <a href="{{ route('parada-editar', $linha) }}"
                                                            class="btn btn-success btn-xs">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endif

                                                    @if (auth()->user()->isPermissao('parada', 'excluir'))
                                                        <button class="btn btn-danger btn-xs" onclick="excluirCad('#tr-parada-{{ $linha->cd_producao_parada }}', {{ $linha->cd_producao_parada }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    @endif
                                                </div> 
                                        </td>
                                    </tr> 
                            @endforeach
                        </tbody>
                    </table>
                    <div style="float: right">
                        {{ $parada->links() }}
                    </div>
                    @if (empty($parada))
                        <p class="text-center" style="padding: 1.2em">Nenhuma Parada Cadastrada</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            function excluirCad(el, id) {
                Swal.fire({
                    title: 'Confirmação',
                    text: "Tem certeza que deseja excluir esse Cadastro?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#22BAA0',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Não',
                    confirmButtonText: 'Sim'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.get(`/colonial/parada-delete/${id}`)
                            .then((res) => {
                                document.querySelector(el).remove();
                                toastr["success"]('Parada excluida com sucesso!');
                            })
                            .catch((err) => toastr["error"]('Não foi possivel excluir o Usuário!'));
                    }
                });
            }
        </script>
    </x-slot>
</x-layout.colonial.layout>
