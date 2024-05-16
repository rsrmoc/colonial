<x-layout.colonial.layout>
    <div class="page-title">
        <h3>Recebimento de Tomate</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('recebimentotomate-listar') }}">Relação</a></li>
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
                        <form action="{{ route('recebimentotomate-listar') }}" method="GET">
                            <div style="display: flex">
                                <input type="search" name="b" placeholder="Pesquisa" required class="form-control"
                                    value="{{ request()->query('b') }}" />

                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>

                        <div>
                            @if (auth()->user()->isPermissao('perda', 'criar'))
                                <a href="{{ route('recebimentotomate-criar') }}" class="btn btn-danger">
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
                                <th class="text-center">Hr.Inicial</th>
                                <th class="text-center">Hr.Final</th>
                                <th >Nr.Controle</th>  
                                <th >Fornecedor </th>  
                                <th >Placa</th>  
                                <th class="text-right">BRIX</th>  
                                <th class="text-right">Acidez</th> 
                                <th class="text-center">Cadastro</th> 
                                <th class="text-center">Ação</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($perda as $linha) 
                                    <tr id="tr-recebimentotomate-{{  $linha->cd_recebimento }}">
                                        <th>{{ $linha->cd_recebimento }}</th> 
                                        <td class="text-center">{{  date( 'd/m/Y' , strtotime( $linha->dt_recebimento ) ) }}</td> 
                                        <td class="text-center">{{  date( 'H:i' , strtotime( $linha->hr_inicial ) ) }}</td> 
                                        <td class="text-center">{{  date( 'H:i' , strtotime( $linha->hr_final ) ) }}</td> 
                                        <td>{{ $linha->nr_controle }}</td> 
                                        <td>{{ $linha['nm_fornecedor'] }}</td> 
                                        <td  >{{ $linha['placa']  }}</td> 
                                        <td class="text-right">{{ $linha['brix'] }}</td> 
                                        <td class="text-right">{{ $linha['acidez'] }}</td> 
                                        <td class="text-center">{{  date( 'd/m/Y H:i' , strtotime( $linha->created_at ) ) }}</td> 
                                        <td class="text-center"> 
                                                <div class="btn-group">
                                                    @if (auth()->user()->isPermissao('recebimentotomate', 'criar'))
                                                        <a href="{{ route('recebimentotomate-editar', $linha) }}"
                                                            class="btn btn-success btn-xs">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endif

                                                    @if (auth()->user()->isPermissao('recebimentotomate', 'excluir'))
                                                        <button class="btn btn-danger btn-xs" onclick="excluirCad('#tr-recebimentotomate-{{ $linha->cd_perda }}', {{ $linha->cd_perda }})">
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
                        {{ $perda->links() }}
                    </div>
                    @if (empty($perda))
                        <p class="text-center" style="padding: 1.2em">Nenhuma Perda Cadastrada</p>
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
                        axios.get(`/colonial/recebimentotomate-delete/${id}`)
                            .then((res) => {
                                document.querySelector(el).remove();
                                toastr["success"]('Recebimento de tomate excluida com sucesso!');
                            })
                            .catch((err) => toastr["error"]('Não foi possivel excluir o Recebimento de Tomate!'));
                    }
                });
            }
        </script>
    </x-slot>
</x-layout.colonial.layout>
