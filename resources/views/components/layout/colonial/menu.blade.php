<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div style="text-align: center; padding-bottom: 15px; padding-top: 10px;">
 
        </div>
        
        <ul class="menu accordion-menu">
                        
            <li class=""><a href="{{ route('home') }}" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span> <p>Inicial</p></a></li>
  
            <li class="droplink "><a href="#" class="waves-effect waves-button"><span class="menu-icon   fa fa-cogs"></span><p>Produção</p><span class="arrow"></span></a>
                <ul class="sub-menu"> 
                        <li class=""><a href="{{route('prod_prev_real-listar')}}"  ><p>Ordem de Produção</p> </a>  </li> 
                        <li class=""><a href="{{route('safra-listar')}}"  ><p>Produção Safra</p> </a>  </li> 
                        <li class="droplink"><a href="#"><p>Controles</p><span class="arrow"></span></a>
                            <ul class="sub-menu"> 
                                <li><a href="{{route('hidrico-listar')}}">Consumo Hidrico</a></li>
                                <li><a href="{{route('energia-listar')}}">Consumo De Energia</a></li>
                                <li><a href="{{route('parada-listar')}}">Paradas de Linha</a></li> 
                                <li><a href="{{route('perda-listar')}}">Perdas Por Produção</a></li> 
                            </ul>
                        </li>
                        <li class="droplink"><a href="#"><p>Tabelas</p><span class="arrow"></span></a>
                            <ul class="sub-menu"> 
                                <li><a href="{{route('tipoparada-listar')}}">Tipo de Paradas</a></li> 
                                <li><a href="{{route('tipoperda-listar')}}">Tipo de Perdas</a></li> 
                                <li><a href="{{route('equipamento-listar')}}">Equipamentos</a></li> 
                                <li><a href="{{route('classificacaotomate-listar')}}">Classificação de Tomate</a></li> 
                            </ul>
                        </li>
                </ul> 
            </li>
 
 

            <li class="droplink "><a href="#" class="waves-effect waves-button"><span class="menu-icon   fa fa-money"></span><p>Vendas</p><span class="arrow"></span></a>
                <ul class="sub-menu"> 
                        <li class=""><a href="#" ><p>Pedidos de vendas</p> </a>  </li> 
                        <li class="droplink"><a href="#"><p>Controles</p><span class="arrow"></span></a>
                            <ul class="sub-menu"> 
                                <li><a href="{{route('frete-listar')}}">Controle de Frete</a></li> 
                            </ul>
                        </li>
                        
                </ul> 
            </li>

            <li class="droplink "><a href="#" class="waves-effect waves-button"><span class="menu-icon   fa fa-certificate"></span><p>Qualidade</p><span class="arrow"></span></a>
                <ul class="sub-menu"> 
                      
                        <li class="droplink"><a href="#"><p>Controles</p><span class="arrow"></span></a>
                            <ul class="sub-menu"> 
                                <li><a href="{{route('recebimentotomate-listar')}}">Recebimento de Tomate</a></li> 
                            </ul>
                        </li>
                        
                </ul> 
            </li>
             
            <li class="#"><a  class="waves-effect waves-button"><span class="menu-icon   glyphicon glyphicon-shopping-cart  "></span><p>Compras</p></a></li>

            <li class="#"><a   class="waves-effect waves-button"><span class="menu-icon   fa fa-truck"></span><p>Estoque</p></a></li>
         
            <li class="#"><a  class="waves-effect waves-button"><span class="menu-icon   glyphicon glyphicon-usd "></span><p>Financeiro</p></a></li>
  
            <li class="#"><a  class="waves-effect waves-button"><span class="menu-icon   glyphicon glyphicon-wrench "></span><p>Manutenção</p></a></li>

            
            
 
               
        </ul>
        
    </div><!-- Page Sidebar Inner -->
</div><!-- Page Sidebar -->