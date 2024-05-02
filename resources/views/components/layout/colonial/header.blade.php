<div class="navbar">
     
    <script type="text/javascript"> 
        
        @if($mensagem = session('mensagem'))
            @if ($mensagem['icon'] == 'success')
                toastr.success("{{ $mensagem['text'] ?? '' }}","{{ $mensagem['title'] ?? '' }}");
            @endif
                
            @if ($mensagem['icon'] == 'error')
                toastr.error("{{ $mensagem['text'] ?? '' }}","{{ $mensagem['title'] ?? $mensagem }}");
            @endif
        
            @if ($mensagem['icon'] == 'warning')
                toastr.warning("{{ $mensagem['text'] ?? '' }}","{{ $mensagem['title'] ?? $mensagem }}");
            @endif
            
            @if ($mensagem['icon'] == 'info')
                toastr.info("{{ $mensagem['text'] ?? '' }}","{{ $mensagem['title'] ?? $mensagem }}");
            @endif
        @endif
                             
    </script>
    <div class="navbar-inner">
        <div class="sidebar-pusher">
            <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <div class="logo-box">
            <a href="#" class="logo-text"><img src="{{ asset('assets\images\logo_karambi.jpg') }}" style="width: 155px;  "></a> 
        </div><!-- Logo Box -->
        
        <div class="topmenu-outer">
            <div class="top-menu">
                <ul class="nav navbar-nav navbar-left">
                    <li>		
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic sidebar-toggle"><i class="fa fa-bars"></i></a>
                    </li>
            
                    <li>		
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic toggle-fullscreen"><i class="fa fa-expand"></i></a>
                    </li>
       
                </ul>
                <ul class="nav navbar-nav navbar-right">
         
 
                    

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                            <span class="user-name">{{ ucfirst(strtolower(request()->user()->nm_usuario)) }} <i class="fa fa-angle-down"></i></span>
                            <img class="img-circle avatar" src="{{ asset('assets/images/user.png') }}" width="40" height="40" alt="">
                        </a>
                        <ul class="dropdown-menu dropdown-list" role="menu">
                            <li role="presentation"><a href="{{route('usuarios-listar')}}"><i class="fa fa-user"></i>Criação de Usuários</a></li> 
                            <li role="presentation"><a href="{{route('perfis-listar')}}"><i class="fa fa-th-list"></i>Perfil de Acesso</a></li> 
                            <li role="presentation" class="divider"></li> 
                            <li role="presentation"><a href=" "><i class="fa fa-unlock-alt"></i>Alteração de Senha</a></li> 
                            <li role="presentation"><a href=" "><i class="fa fa-sign-out m-r-xs"></i>Sair</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" class="log-out waves-effect waves-button waves-classic">
                            <span><i class="fa fa-sign-out m-r-xs"></i>Sair</span>
                        </a>
                    </li>
              
                </ul><!-- Nav -->
            </div><!-- Top Menu -->
        </div>
    </div>
</div><!-- Navbar -->
<style>
    .center{ text-align: center; }
    .right{ text-align: right; }
    .left{ text-align: left; }
    .red{ color: red; }
    .error{ color: red; } 
    .dt-acao{ min-width: 80px; }
    .btn-group{ min-width: 80px; }
    
</style>