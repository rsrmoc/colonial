<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div style="text-align: center; padding-bottom: 15px; padding-top: 10px;">
 
        </div>
        
        <ul class="menu accordion-menu">
                        
            <li class=""><a href="{{ route('home') }}" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span> <p>Inicial</p></a></li>
 
            @can('habilidade_apoio_menu', ',6,')
            <li class="droplink "><a href="#" class="waves-effect waves-button"><span class="menu-icon   fa fa-cogs"></span><p>Produção</p><span class="arrow"></span></a>
                <ul class="sub-menu"> 
                        <li class=""><a  ><p>Condomínios</p> </a>  </li> 
                        <li class="droplink"><a href="#"><p>Level 1.1</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li class="droplink"><a href="#"><p>Level 2.1</p><span class="arrow"></span></a>
                                    <ul class="sub-menu">
                                        <li><a href="#">Level 3.1</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Level 2.2</a></li>
                            </ul>
                        </li>
                </ul> 
            </li>
            @endcan 
            <li class="droplink "><a href="#" class="waves-effect waves-button"><span class="menu-icon   fa fa-cogs"></span><p>Produção</p><span class="arrow"></span></a>
                <ul class="sub-menu"> 
                        <li class=""><a  ><p>Condomínios</p> </a>  </li> 
                        <li class="droplink"><a href="#"><p>Controles</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                             
                                <li><a href="{{route('hidrico-listar')}}">Consumo Hidrico</a></li>
                                <li><a href="{{route('energia-listar')}}">Consumo De Energia</a></li>
                                <li><a href="#">Perdas por Produto Acabado</a></li>
                                <li><a href="#">Conversor Cx. em Kg.</a></li>
                            </ul>
                        </li>
                </ul> 
            </li>
            <li class="#"><a   class="waves-effect waves-button"><span class="menu-icon   fa fa-truck"></span><p>Estoque</p></a></li>
         
            <li class="#"><a class="waves-effect waves-button"><span class="menu-icon   fa fa-certificate"></span><p>Qualidade</p></a></li>
 
            <li class="#"><a  class="waves-effect waves-button"><span class="menu-icon   glyphicon glyphicon-wrench "></span><p>Manutenção</p></a></li>

            <li class="#"><a  class="waves-effect waves-button"><span class="menu-icon   glyphicon glyphicon-shopping-cart  "></span><p>Compras</p></a></li>
            
            <li class="#"><a  class="waves-effect waves-button"><span class="menu-icon   glyphicon glyphicon-usd "></span><p>Financeiro</p></a></li>
            
 
               
        </ul>
        
    </div><!-- Page Sidebar Inner -->
</div><!-- Page Sidebar -->