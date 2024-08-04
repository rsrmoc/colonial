<x-layout.colonial.layout>
    <div class="page-title">
        <h3>Balanço de Massas</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('balancomassa-listar') }}">Relação</a></li>
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
                        <form action="{{ route('balancomassa-listar') }}" method="GET">
                            <div style="display: flex">
                                <input type="search" name="b" placeholder="Pesquisa" required class="form-control"
                                    value="{{ request()->query('b') }}" />

                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>

                        <div>
                            @if (auth()->user()->isPermissao('balancomassa', 'criar'))
                                <a href="{{ route('balancomassa-criar') }}" class="btn btn-danger">
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
                                <th class="text-left">Descrição</th>     
                                <th class="text-center">Data Inicial</th>  
                                <th class="text-center">Data Final</th> 
                                <th class="text-left">Fornecedor</th> 
                                <th class="text-right">Brix Ponderado</th>  
                                <th class="text-center">Ação</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($balanco as $linha) 
                                    <tr id="tr-balancomassa-{{  $linha->cd_balanco }}">
                                        <th>{{ $linha->cd_balanco }}</th> 
                                        <th>{{ $linha->nm_balanco }}</th> 
                                        <td class="text-center">{{  date( 'd/m/Y' , strtotime( $linha->dt_inicial ) ) }}</td>  
                                        <td class="text-center">{{  date( 'd/m/Y' , strtotime( $linha->dt_final ) ) }}</td>  
                                        <td class="text-left">{{ $linha->nm_fornecedor }}</td> 
                                        <td class="text-right">{{ $linha->brix_ponderado }}</td>   
                                        <td class="text-center"> 
                                                <div class="btn-group">
                                                    @if (auth()->user()->isPermissao('balancomassa', 'criar'))
                                                        <a href="{{ route('balancomassa-editar', $linha) }}"
                                                            class="btn btn-success btn-xs">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endif

                                                    @if (auth()->user()->isPermissao('balancomassa', 'excluir'))
                                                        <button class="btn btn-danger btn-xs" onclick="excluirCad('#tr-balancomassa-{{ $linha->cd_classificacao }}', {{ $linha->cd_classificacao }})">
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
                        {{ $balanco->links() }}
                    </div>
                    @if (empty($balanco))
                        <p class="text-center" style="padding: 1.2em">Nenhuma Balanço Cadastrada</p>
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
                        axios.get(`/colonial/balancomassa-delete/${id}`)
                            .then((res) => {
                                document.querySelector(el).remove();
                                toastr["success"]('Classificação de tomate excluida com sucesso!');
                            })
                            .catch((err) => toastr["error"]('Não foi possivel excluir a Classificação de Tomate!'));
                    }
                });
            }
        </script>
    </x-slot>
</x-layout.colonial.layout>
