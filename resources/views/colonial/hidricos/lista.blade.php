<x-layout.colonial.layout>
    <div class="page-title">
        <h3>Consumo Hídrico</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('hidrico-listar') }}">Relação</a></li>
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
                        <form action="{{ route('hidrico-listar') }}" method="GET">
                            <div style="display: flex">
                                <input type="search" name="b" placeholder="Pesquisa" required class="form-control"
                                    value="{{ request()->query('b') }}" />

                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>

                        <div>
                            @if (auth()->user()->isPermissao('hidrico', 'criar'))
                                <a href="{{ route('hidrico-criar') }}" class="btn btn-danger">
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
                                <th class="text-right">Consumo Anterior</th>  
                                <th class="text-right">Consumo Atual</th>  
                                <th class="text-right">Saldo</th>  
                                <th class="text-center">Ação</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($hidrico as $linha) 
                                    <tr id="tr-hidrico-{{ $linha->id }}">
                                        <th>{{ $linha->id }}</th> 
                                        <td class="text-center">{{  date( 'd/m/Y' , strtotime( $linha->dt_consumo ) ) }}</td> 
                                        <td class="text-right">{{ number_format($linha->qtde_anterior,2,",",".") }}</td> 
                                        <td class="text-right">{{ number_format($linha->qtde_atual,2,",",".") }}</td> 
                                        <td class="text-right">{{ number_format($linha->saldo,2,",",".") }}</td> 
                                        <td class="text-center"> 
                                                <div class="btn-group">
                                                    @if (auth()->user()->isPermissao('hidrico', 'criar'))
                                                        <a href="{{ route('hidrico-editar', $linha) }}"
                                                            class="btn btn-success btn-xs">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endif

                                                    @if (auth()->user()->isPermissao('hidrico', 'excluir'))
                                                        <button class="btn btn-danger btn-xs" onclick="excluirCad('#tr-hidrico-{{ $linha->id }}', {{ $linha->id }})">
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
                        {{ $hidrico->links() }}
                    </div> 
                    @if (empty($hidrico))
                        <p class="text-center" style="padding: 1.2em">Nenhum Consumo Cadastrado</p>
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
                        axios.get(`/colonial/hidrico-delete/${id}`)
                            .then((res) => {
                                document.querySelector(el).remove();
                                toastr["success"]('Consumo excluido com sucesso!');
                            })
                            .catch((err) => toastr["error"]('Não foi possivel excluir o Usuário!'));
                    }
                });
            }
        </script>
    </x-slot>
</x-layout.colonial.layout>
