<x-layout.colonial.layout>
    <div class="page-title">
        <h3>Classificação de Tomate</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('classificacaotomate-listar') }}">Relação</a></li>
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
                        <form action="{{ route('classificacaotomate-listar') }}" method="GET">
                            <div style="display: flex">
                                <input type="search" name="b" placeholder="Pesquisa" required class="form-control"
                                    value="{{ request()->query('b') }}" />

                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>

                        <div>
                            @if (auth()->user()->isPermissao('classificacaotomate', 'criar'))
                                <a href="{{ route('classificacaotomate-criar') }}" class="btn btn-danger">
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
                                <th class="text-right">Resíduo</th>  
                                <th class="text-right">Terra</th> 
                                <th class="text-right">Sujeira</th> 
                                <th class="text-right">Verdes</th> 
                                <th class="text-right">Total</th> 
                                <th class="text-center">Ação</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($perda as $linha) 
                                    <tr id="tr-classificacaotomate-{{  $linha->cd_classificacao }}">
                                        <th>{{ $linha->cd_classificacao }}</th> 
                                        <td class="text-center">{{  date( 'd/m/Y' , strtotime( $linha->dt_recebimento ) ) }}</td>  
                                        <td class="text-right">{{ $linha->residuo }}</td> 
                                        <td class="text-right">{{ $linha->terra }}</td> 
                                        <td class="text-right" >{{ $linha->sujeira  }}</td> 
                                        <td class="text-right">{{ $linha->verde }}</td>   
                                        <td class="text-right">{{ $linha->total }}</td> 
                                        <td class="text-center"> 
                                                <div class="btn-group">
                                                    @if (auth()->user()->isPermissao('classificacaotomate', 'criar'))
                                                        <a href="{{ route('classificacaotomate-editar', $linha) }}"
                                                            class="btn btn-success btn-xs">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endif

                                                    @if (auth()->user()->isPermissao('classificacaotomate', 'excluir'))
                                                        <button class="btn btn-danger btn-xs" onclick="excluirCad('#tr-classificacaotomate-{{ $linha->cd_classificacao }}', {{ $linha->cd_classificacao }})">
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
                        axios.get(`/colonial/classificacaotomate-delete/${id}`)
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
