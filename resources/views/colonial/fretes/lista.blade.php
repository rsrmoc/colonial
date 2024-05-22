<x-layout.colonial.layout>
    <div class="page-title">
        <h3>Controle de Fretes</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('perda-listar') }}">Relação</a></li>
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
 
                 
                <form action="{{ route('frete-listar') }}" class="panel-heading" style="margin-bottom: 10px; height: 85px;" method="GET">
                    <input type="hidden" name="b" value="P">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="fname">Data Inicial: <span class="red normal"></span></label>
                            <input type="date" name="dti" value="{{ $request['dti'] }}" required class="form-control"  />   
                        </div>
                        <div class="col-md-2">
                            <label for="fname">Data Final: <span class="red normal"></span></label>
                            <input type="date" name="dtf" value="{{ $request['dtf'] }}" required class="form-control"  />  
                        </div>
                        <div class="col-md-2">
                            <label for="fname">Romaneio: <span class="red normal"></span></label>
                            <input type="text" name="romaneio" value="{{ $request['romaneio'] }}" placeholder="Romaneio" class="form-control"  />  
                        </div>
                        <div class="col-md-2">
                            <label for="fname">Status: <span class="red normal"></span></label> 
                            <select class="form-control"  name="status"  >
                                <option value="">Todos</option> 
                                <option value="X" @if($request['status']=='X') selected  @endif>Liberado</option> 
                                <option value="XX" @if($request['status']=='XX') selected  @endif>Picking efetuado</option> 
                                <option value="XXX" @if($request['status']=='XXX') selected  @endif>Com picking parcial</option> 
                                <option value="D" @if($request['status']=='D') selected  @endif>Parcialmente entregue</option> 
                                <option value="C" @if($request['status']=='C') selected  @endif>Fechado</option> 
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="fname">Motorista: <span class="red normal"></span></label>
                            <select class="form-control"  name="motorista"  >
                                <option value="">Todos</option> 
                                @foreach ($motorista as $valor )
                                    <option value="{{ $valor->codigo }}" @if(old('motorista',$request['motorista'])== $valor->codigo) selected  @endif >{!!   $valor->nome . '   [ '.$valor->codigo.' ]'  !!}</option> 
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-danger"  style="margin-top: 25px; width: 100%">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>


                    </div>
                </form>

                <div class="panel-body">
                    <table class="table table-striped" style="margin-bottom: 0">
                        <thead>
                            <tr class="active">
                                <th>Romaneio</th>
                                <th class="text-center">Data</th> 
                                <th >Destino Final</th>  
                                <th >Motorista </th>  
                                <th >Placa</th>  
                                <th class="text-right" >Valor do Frete</th>  
                                <th  class="text-right">Valor Pago</th> 
                                <th >&nbsp;&nbsp;Status</th>  
                                <th class="text-center">Ação</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($query as $linha) 
                                    <tr >
                                        <th>{{ $linha->AbsEntry }}</th> 
                                        <td class="text-center">{{  date( 'd/m/Y' , strtotime( $linha->PickDate ) ) }}</td> 
                                        <td>{{ mb_strtoupper($linha['U_destino']) }}</td> 
                                        <td>{!! (empty($linha->tab_motorista['CardName'])) ? '<span class="red" style="font-style: italic" > Não Informado </span>' : $linha->tab_motorista['CardName'] !!}</td> 
                                        <td>{{ mb_strtoupper($linha['tab_motorista']['U_UPD_PLACA']) }}</td> 
                                        <td class="text-right" >{{  'R$ '.number_format($linha['U_valorfrete'], 2, ',', '.') }} </td> 
                                        <td class="text-right" >{{  'R$ '.number_format($linha['U_valorpago'], 2, ',', '.') }}</td> 
                                        <th  > 
                                        @if($linha['Status']=='C') &nbsp;&nbsp;FECHADO @endif    
                                        @if($linha['Status']=='D') &nbsp;&nbsp;PARC.ENTREGUE @endif 
                                        </th> 
                                        <td class="text-center"> 
                                            <a href="#" onclick="carregar('{{ $linha->AbsEntry }}');" 
                                            data-toggle="modal" data-target="#ModalDetalhes" class="btn btn-success btn-xs">
                                                <i class="fa fa-file-text-o"></i>
                                            </a>
                                        </td>
                                    </tr> 
                            @endforeach
                        </tbody>
                    </table>
                    <div style="float: right">
                        {{ $query->links() }}
                    </div>
                    @if (empty($query))
                        <p class="text-center" style="padding: 1.2em">Nenhum Frete Cadastrado</p>
                    @endif
                </div>

                <!-- /.modal-conteudo -->
                <div class="modal fade" id="ModalDetalhes" data-backdrop="static" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div id="DIV_RETORNO"></div>
                        </div>
                    </div>
                </div>
                <!-- /.modal-conteudo -->

            </div>
        </div>
    </div>

    <x-slot name="scripts">

        <script>
            carregar = function (cod) {
               
                $("#DIV_RETORNO").empty().html("<div style='text-align: center;'><br><br><br><img height='60' src='{{ asset('assets/images/aguarde.gif') }}'><br><br><br><br></div>");  
                $.ajax({ 
                    type: "GET",
                    data: {cod: cod},
                    url: "{{ route('frete-criar') }}" , 
                    success: function(pegar_dados) {  
                        complete:$("#DIV_RETORNO").empty().html(pegar_dados);
                    }
                }) 
            }


         
         
        </script>

    </x-slot>
</x-layout.colonial.layout>
