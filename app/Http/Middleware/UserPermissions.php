<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class UserPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $usuario = Auth::user(); 

        if ($usuario->admin) return $next($request);
        
         
        $NaoverificarRotas = ['home',null,'imprimir']; 
        $verificarRotas = ['home', 'perfis','energia','hidrico','prod_prev_real','usuarios','parada','tipoparada','tipoperda','perda','equipamento','recebimentotomate','frete','safra','classificacaotomate','balancomassa'];
        $verificarAcao = ['ver','listar','criar','store','editar','update','excluir','destroy','json','detalhes',null,'combo','xls','entrada'];

        $rotaAtual = Route::currentRouteName();  
        $permissaoRota = substr(Route::currentRouteName(), 0, strpos(Route::currentRouteName(), "-") === false ? null : strpos(Route::currentRouteName(), "-"));
       
        if(in_array($permissaoRota, $NaoverificarRotas)) return $next($request);
      

        if(!in_array($permissaoRota, $verificarRotas)) return redirect()->route('home')->withErrors(['error' => 'Rotina não cadastrada!']);

    

        if(!in_array(str_replace($permissaoRota.'-', '', $rotaAtual), $verificarAcao)) return redirect()->route('home')->withErrors(['error' => 'Ação não cadastrada no sistema!']);
         
        
        if (in_array($permissaoRota, $verificarRotas) || $usuario->existPermissaoPerfis($permissaoRota)) {
              
            if (str_ends_with($rotaAtual, "listar") && !$usuario->isPermissaoPerfis($permissaoRota, 'ver')) {
                return redirect()->route('home')->withErrors(['error' => 'Você não tem permissão de acesso!']);
            }

            if ((str_ends_with($rotaAtual, "criar") || str_ends_with($rotaAtual, "store") ||
                str_ends_with($rotaAtual, "editar") || str_ends_with($rotaAtual, "update")) &&
                !$usuario->isPermissaoPerfis($permissaoRota, 'criar'))
            {
                return redirect()->route('home')->withErrors(['error' => 'Você não tem permissão de acesso!']);
            }

            if ((str_contains($rotaAtual, "excluir") || str_contains($rotaAtual, "destroy")) && !$usuario->isPermissaoPerfis($permissaoRota, 'excluir')) {
                return redirect()->route('home')->withErrors(['error' => 'Você não tem permissão de acesso!']);
            }
        } 
        
        return $next($request);
    }
}
