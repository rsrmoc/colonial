<script>
 
    $('#FormHist').submit(function(e) {
       e.preventDefault();
       $.ajax({
         url: "",
         method: "POST",
         data: $('#FormHist').serialize(),
         beforeSend: function() {
           $('#DIV_RETORNO').html("<div style='text-align: center;'><br><br><br><img height='100' src='{{ asset('assets/images/carregando.gif') }}'><br><br><br><br></div>");
         },
         success: function(data) {
           $('form').trigger("reset");
           $('#DIV_RETORNO').fadeIn().html(data);
         }
       });
     });
    
     $('#FormServ').submit(function(e) {
    
       e.preventDefault();
       $.ajax({
         url: "",
         method: "POST",
         data: $('#FormServ').serialize(),
         beforeSend: function() {
           $('#DIV_RETORNO').html("<div style='text-align: center;'><br><br><br><img height='100' src='{{ asset('assets/images/carregando.gif') }}'><br><br><br><br></div>");
         },
         success: function(data) {
           $('form').trigger("reset");
           $('#DIV_RETORNO').fadeIn().html(data);
         }
       });
     });
   
     $('#FormFinal').submit(function(e) {
    
       e.preventDefault();
       $.ajax({
         url: "",
         method: "POST",
         data: $('#FormFinal').serialize(),
         beforeSend: function() {
           $('#DIV_RETORNO').html("<div style='text-align: center;'><br><br><br><img height='100' src='{{ asset('assets/images/carregando.gif') }}'><br><br><br><br></div>");
         },
         success: function(data) {
           $('form').trigger("reset");
           $('#DIV_RETORNO').fadeIn().html(data);
         }
       });
   
     });
   
     
     
     
   </script>
   
   <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">FECHAR</span></button>
     <h4 class="modal-title"><i class="fa fa-fw fa-asterisk"></i> ROMANEIO: {{ $request['cod'] }}  </h4>
   </div>
   
   <div class="modal-body">
     <div class="row">
   
       <div class="nav-tabs-custom">
         <ul class="nav nav-tabs">
            
           <li class="active"><a href="#tab_romaneio" data-toggle="tab">Dados do Romaneio</a></li>
           <li class="  "><a href="#tab_pedido" data-toggle="tab">Pedidos</a></li> 
           <li class="  "><a href="#tab_frete" data-toggle="tab">Dados do Frete</a></li> 
           <li class="  "><a href="#tab_cidade" data-toggle="tab">Cidades</a></li> 
           <li class="  "><a href="#tab_rpa" data-toggle="tab">RPA</a></li> 
           <li role="presentation" class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                  <b>Impressão </b> <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                  <li><a href="#tab32" role="tab" data-toggle="tab">Autorização de Frete</a></li>
                  <li><a href="#tab33" role="tab" data-toggle="tab">Adiantamento de Autônomo - RPA</a></li>
              </ul>
           </li>
         
         </ul>
   
         <div class="tab-content">
   
           <div class="tab-pane active" id="tab_romaneio">
             <div class=" table-responsive no-padding ">
                
                <table class="table table-striped" style="margin-bottom: 0">
                    <thead>
                        <tr class="active"> 
                            <th colspan="2" class="text-center">Dados do Romaneio</th>   
                        </tr>
                    </thead>
                    
                    <tbody>
                        <tr >
                            <th>
                                <label for="fname">Data: &nbsp;&nbsp;</label> {{  date( 'd/m/Y' , strtotime( $dados['query']['PickDate'] ) ) }}
                            </th> 
                            <th>
                                <label for="fname">Destino Final: &nbsp;&nbsp;</label> {{ $dados['query']['U_destino'] }}
                             </th>  
                        </tr> 
                        <tr >
                            <th>
                                <label for="fname">Operador: </label> &nbsp;&nbsp;{{ $dados['query']['Name'] }}
                            </th> 
                            <th>
                                <label for="fname">Status: </label> 
                                @if($dados['query']['Status']=='C') &nbsp;&nbsp;Fechado @endif    
                                @if($dados['query']['Status']=='D') &nbsp;&nbsp;Parc.Entregue @endif 
                             </th>  
                        </tr> 
                        <tr >
                            <th>
                                <label for="fname">Valor do Frete: </label> &nbsp;&nbsp;
                                {{  'R$ '.number_format($dados['query']['U_valorfrete'], 2, ',', '.') }}
                            </th> 
                            <th>
                                <label for="fname">Valor Pago: </label> &nbsp;&nbsp;
                                {{  'R$ '.number_format($dados['query']['U_valorpago'], 2, ',', '.') }}
                             </th>  
                        </tr> 
                    </tbody>
                </table>
                
                <table class="table table-striped" style="margin-top: 20px">
                    <thead>
                        <tr class="active"> 
                            <th colspan="2" class="text-center">Dados do Motorista</th>   
                        </tr>
                    </thead>
                    <tbody>
                        <tr >
                            <th>
                                <label for="fname">Código: </label> &nbsp;&nbsp;{{ $dados['query']['tab_motorista']['CardCode'] }}
                            </th> 
                            <th>
                                <label for="fname">Nome: </label> &nbsp;&nbsp;{{ $dados['query']['tab_motorista']['CardName'] }}
                             </th>  
                        </tr> 
                        <tr >
                            <th>
                                <label for="fname">CPF: </label> &nbsp;&nbsp;{{ $dados['query']['tab_motorista']['U_UPD_CPF'] }}
                            </th> 
                            <th>
                                <label for="fname">Placa: </label> &nbsp;&nbsp;{{ $dados['query']['tab_motorista']['U_UPD_PLACA'] }}
                             </th>  
                        </tr>
                        <tr >
                            <th>
                                <label for="fname">Email: </label> &nbsp;&nbsp;{{ $dados['query']['tab_motorista']['E_Mail'] }}
                            </th> 
                            <th>
                                <label for="fname">Contato: </label> &nbsp;&nbsp; {{ $dados['query']['tab_motorista']['Cellular'] }}
                             </th>  
                        </tr> 
                        <tr >
                            <th colspan="2">
                                <label for="fname">Endereço: </label> &nbsp;&nbsp; {{ $dados['query']['tab_motorista']['Address'] .', ' . $dados['query']['tab_motorista']['County'].' - ' . $dados['query']['tab_motorista']['City'] }}
                            </th>  
                        </tr> 
                        

                    </tbody>

                </table>

             </div>
           </div>
           
           <div class="tab-pane " id="tab_pedido">

            <table class="table table-striped" style="margin-top: 20px">
                <thead>
                    <tr class="active"> 
                        <th   >Pedido</th>  
                        <th  class="text-center">Data</th>  
                        <th  >Cliente</th>  
                        <th  class="text-right">Imposto</th>  
                        <th  class="text-right">Total</th>  
                    </tr>
                </thead>
                <tbody>
                    @php $Total=0; $VlTotal=0; $VlImposto=0; @endphp
                    @foreach ($dados['pedidos'] as $pedido)
                    @php $Total=($Total+1); 
                         $VlTotal=($VlTotal+$pedido['total']); 
                         $VlImposto=($VlImposto+$pedido['imposto']); 
                         
                    @endphp
                        
                    <tr >
                        <td>{{ $pedido['codigo'] }}</td> 
                        <td class="text-center">{{ date( 'd/m/Y' , strtotime( $pedido['data'] ) ) }}</td> 
                        <td>{{ $pedido['nome'] }}</td> 
                        <td class="text-right">{{ number_format($pedido['imposto'], 2, ',', '.') }}</td> 
                        <td class="text-right">{{ number_format($pedido['total'], 2, ',', '.') }}</td>  
                    </tr> 

                    @endforeach
                    <tr >
                        <th> </th> 
                        <th class="text-center"> </th> 
                        <th> </th> 
                        <th class="text-right">{{ 'R$ '.number_format($VlImposto, 2, ',', '.') }}</th> 
                        <th class="text-right">{{ 'R$ '.number_format($VlTotal, 2, ',', '.') }}</th>  
                    </tr> 
                </tbody>

            </table>

           </div>
   
           <div class="tab-pane " id="tab_frete"> 

            <form  method="POST" class="panel panel-white">
              @csrf

              <div class="row">
                <div class="col-md-3" style="padding-left: 2px; padding-right: 2px;">
                  <div class="form-group  " style="padding-left: 2px; padding-right: 2px;">
                      <label for="fname">Distância: <span class="red normal">*</span></label>
                      <input type="text" class="form-control" name="distancia"   onblur="calcFrete();" id="distancia" required /> 
                  </div>
                </div>
                <div class="col-md-2" style="padding-left: 2px; padding-right: 2px;">
                  <div class="form-group  " style="padding-left: 2px; padding-right: 2px;">
                      <label for="fname">Valor KM: <span class="red normal">*</span></label>
                      <input type="text" class="form-control" name="vl_km" onblur="calcFrete();" id="vl_km" required /> 
                  </div>
                </div>
                <div class="col-md-2" style="padding-left: 2px; padding-right: 2px;">
                  <div class="form-group  " style="padding-left: 2px; padding-right: 2px;">
                      <label for="fname">Valor Frete: <span class="red normal">*</span></label>
                      <input type="text" class="form-control" name="vl_frete" id="vl_frete" required /> 
                  </div>
                </div>
                <div class="col-md-2" style="padding-left: 2px; padding-right: 2px;">
                  <div class="form-group  " style="padding-left: 2px; padding-right: 2px;">
                      <label for="fname">Valores Adicionais: <span class="red normal">*</span></label>
                      <input type="text" class="form-control" name="vl_frete_add" id="vl_frete_add" required /> 
                  </div>
                </div>

                <div class="col-md-3" style="padding-left: 2px; padding-right: 2px;">
                  <div class="form-group  " style="padding-left: 2px; padding-right: 2px;">
                      <label for="fname">Valor Total: <span class="red normal">*</span></label>
                      <input type="text" class="form-control" name="vl_frete_total" id="vl_frete_total" required /> 
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-2" style="padding-left: 2px; padding-right: 2px;">
                  <div class="form-group  " style="padding-left: 2px; padding-right: 2px;">
                      <label for="fname">Pedagio: <span class="red normal">*</span></label>
                      <input type="text" class="form-control"  name="vl_pedagio" required /> 
                  </div>
                </div>
                <div class="col-md-2" style="padding-left: 2px; padding-right: 2px;">
                  <div class="form-group  " style="padding-left: 2px; padding-right: 2px;">
                      <label for="fname">Nr.Caixas: <span class="red normal">*</span></label>
                      <input type="text" class="form-control"  name="nr_caixa" required /> 
                  </div>
                </div>
                <div class="col-md-2" style="padding-left: 2px; padding-right: 2px;">
                  <div class="form-group  " style="padding-left: 2px; padding-right: 2px;">
                      <label for="fname">Vl.Caixa: <span class="red normal">*</span></label>
                      <input type="text" class="form-control"  name="vl_unidade" required /> 
                  </div>
                </div>
                <div class="col-md-2" style="padding-left: 2px; padding-right: 2px;">
                  <div class="form-group  " style="padding-left: 2px; padding-right: 2px;">
                      <label for="fname">Vl.Descarga: <span class="red normal">*</span></label>
                      <input type="text" class="form-control"  name="vl_descarga" required /> 
                  </div>
                </div>
                <div class="col-md-2" style="padding-left: 2px; padding-right: 2px;">
                  <div class="form-group  " style="padding-left: 2px; padding-right: 2px;">
                      <label for="fname">Total Descargas: <span class="red normal">*</span></label>
                      <input type="text" class="form-control"  name="vl_descarga_total" required /> 
                  </div>
                </div>
                <div class="col-md-2" style="padding-left: 2px; padding-right: 2px;">
                  <div class="form-group  " style="padding-left: 2px; padding-right: 2px;">
                      <label for="fname">Vl.Outros: <span class="red normal">*</span></label>
                      <input type="text" class="form-control"  name="nome" required /> 
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-2" style="  padding-right: 2px;">
                  <div class="form-group  " style="  padding-right: 2px;">
                      <label for="fname">Qtde.Entrega: <span class="red normal">*</span></label>
                      <input type="text" class="form-control"  name="qtde_entrega" required /> 
                  </div>
                </div>
                <div class="col-md-2" style="padding-left: 2px; padding-right: 2px;">
                  <div class="form-group  " style="padding-left: 2px; padding-right: 2px;">
                      <label for="fname">Vl.Entrega: <span class="red normal">*</span></label>
                      <input type="text" class="form-control"  name="vl_entrega" required /> 
                  </div>
                </div>
                <div class="col-md-2" style="padding-left: 2px; padding-right: 2px;">
                  <div class="form-group  " style="padding-left: 2px; padding-right: 2px;">
                      <label for="fname">Total Entrega: <span class="red normal">*</span></label>
                      <input type="text" class="form-control"  name="vl_entrega_total" required /> 
                  </div>
                </div>
                <div class="col-md-2" style="padding-left: 2px; padding-right: 2px;">
                  <div class="form-group  " style="padding-left: 2px; padding-right: 2px; margin-bottom: 5px;">
                      <label for="fname">Peso Bruto: <span class="red normal">*</span></label>
                      <input type="text" class="form-control"  name="peso" required /> 
                  </div>
                </div> 
                <div class="col-md-2" style="padding-left: 2px; padding-right: 2px;">
                  <div class="form-group  " style="padding-left: 2px; padding-right: 2px; margin-bottom: 5px;">
                      <label for="fname">Notas Fiscais: <span class="red normal">*</span></label>
                      <input type="text" class="form-control"  name="nf" required /> 
                  </div>
                </div> 
                <div class="col-md-2" style="padding-left: 2px; ">
                  <div class="form-group" style="padding-left: 2px; padding-right: 2px; margin-bottom: 5px;">
                      <label for="fname">Valor da Carga: <span class="red normal">*</span></label>
                      <input type="text" class="form-control"  name="vlcarga" required /> 
                  </div>
                </div>

           
              </div>

              <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12 "   >
                    <div class="form-group" >
                        <label for="fname" style=" " >Observações: </label>
                        <textarea  class="form-control " name="obs" style="  height: 80px; " > </textarea> 
                    </div>
                  </div> 

              </div>


              <div class="panel-footer"  >
                    <button class="btn btn-danger">Cadastrar</button>
              </div>
            </form>

           </div>
   
           <div class="tab-pane " id="tab_cidade">

            @foreach ($dados['pedidos'] as $ID => $pedido) 
                <div class="row" style="margin-bottom: 15px;" >
                  <div class="col-md-2 col-sm-2" style="padding-left: 2px; padding-right: 2px;" >
                    @if($ID==0) <label for="fname">Pedido:  <span class="red normal"> </span></label> @endif
                    
                    <span class="form-control" style="font-weight: 900; text-align: center; background: #f0efef">{{ $pedido['codigo'] }}</span>
                  </div>
                  <div class="col-md-4 col-sm-4" style="padding-left: 2px; padding-right: 2px;" > 
                    @if($ID==0) <label for="fname">Cliente:  <span class="red normal"> </span></label> @endif
                    <span class="form-control"  >{{ substr($pedido['tab_cliente']['CardName'],0,30) }} </span>
                  </div>
                  <div class="col-md-4 col-sm-4" style="padding-left: 2px; padding-right: 2px;" > 
                    @if($ID==0) <label for="fname">Cidade:  <span class="red normal"> </span></label> @endif
                    <span class="form-control" >{{ substr($pedido['tab_cliente']['City'],0,30) }}</span>
                  </div>
                  <div class="col-md-2 col-sm-2" style="padding-left: 2px; padding-right: 2px;" > 
                    @if($ID==0) <label for="fname">Valor:  <span class="red normal"> </span></label> @endif
                    <input type="text" class="form-control" style="text-align: right;" required  x-mask:dynamic="$money($input, ',')"  name="valor[{{ $pedido['codigo'] }}]"> 
                  </div>
              </div>
            @endforeach
            
           </div>
         <!-- /.tab-content -->
       </div>
   
     </div>
   </div>
   <div class="modal-footer">
     <button type="button" class="btn btn-default " data-dismiss="modal">Fechar</button>
   </div>
   
   <script>
 

     $(function () { 
         //Initialize Select2 Elements
         $('.select2').select2()
       });
       $(document).ready(function(){
         $('[data-toggle="tooltip"]').tooltip();   
       });
   
       //Flat red color scheme for iCheck
       $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
         checkboxClass: 'icheckbox_flat-green',
         radioClass   : 'iradio_flat-green'
       })
   
       $('.form-excluir-registro').on('click', '.btn-excluir-registro', function(e) {
           e.preventDefault();
   
           swal({   
               title: "Confirmar exclusão?",   
               text: "Ao confirmar você estará excluindo o registro permanente!",   
               type: "warning",   
               showCancelButton: true,   
               confirmButtonColor: "#DD6B55",   
               confirmButtonText: "Sim, confirmar!",   
               cancelButtonText: "Não, cancelar!",
           }).then(function (result) { 
               if (result) {     
                   $(e.currentTarget).parents('form').submit();
               } 
           });
       });
   
   </script>