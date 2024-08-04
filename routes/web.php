<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\colonial\BalancoMassa;
use App\Http\Controllers\colonial\BoletoHistorico;
use App\Http\Controllers\colonial\Bot;
use App\Http\Controllers\colonial\ClassificacaoTomate;
use App\Http\Controllers\colonial\Clientes;
use App\Http\Controllers\colonial\Condominios;
use App\Http\Controllers\colonial\Controle;
use App\Http\Controllers\colonial\Energia;
use App\Http\Controllers\colonial\Equipamentos;
use App\Http\Controllers\colonial\Fretes;
use App\Http\Controllers\colonial\Hidrico; 
use App\Http\Controllers\colonial\Inicio;
use App\Http\Controllers\colonial\Integracoes;
use App\Http\Controllers\colonial\NegociacaoBoletoController;
use App\Http\Controllers\colonial\NegociacoesController;
use App\Http\Controllers\colonial\Paradas;
use App\Http\Controllers\colonial\Perdas;
use App\Http\Controllers\colonial\Perfis;
use App\Http\Controllers\colonial\ProdPrevReal;
use App\Http\Controllers\colonial\RecebimentoTomates;
use App\Http\Controllers\colonial\Safra;
use App\Http\Controllers\colonial\TipoParada;
use App\Http\Controllers\colonial\TipoPerda;
use App\Http\Controllers\colonial\Usuarios;
use App\Http\Controllers\UsuariosController;
use App\Http\Middleware\UserPermissions;
 
use App\Models\Perfil;
use Illuminate\Support\Facades\Route;

Route::get('/',  [AuthController::class, 'home']);
Route::get('/home',  [Inicio::class, 'home']);
Route::get('/login', [Inicio::class, 'login'])->name('login')->middleware('guest');
route::post('/login', [AuthController::class, 'login'])->name('login-action')->middleware('guest');

Route::group([
    'prefix' => 'colonial',
    'middleware' => ['auth', UserPermissions::class]
], function() {

    Route::get('/', [Inicio::class, 'home'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/teste', [Inicio::class, 'grafico'])->name('grafico');

    /* Perfil */
    Route::get('/perfis', [Perfis::class, 'index'])->name('perfis-listar');
    Route::get('/perfis-criar', [Perfis::class, 'create'])->name('perfis-criar');
    Route::post('/perfis-store', [Perfis::class, 'store'])->name('perfis-store');
    Route::get('/perfis-editar/{perfil}', [Perfis::class, 'edit'])->name('perfis-editar');
    Route::post('/perfis-update/{perfil}', [Perfis::class, 'update'])->name('perfis-update');
    Route::get('/perfis-delete/{perfil}', [Perfis::class, 'destroy'])->name('perfis-destroy');
 
    /* Usuario */
    Route::get('/usuarios-re', [Usuarios::class, 'index'])->name('usuarios-relacao');
    Route::get('/usuarios', [Usuarios::class, 'index'])->name('usuarios-listar');
    Route::get('/usuarios-criar', [Usuarios::class, 'create'])->name('usuarios-criar');
    Route::post('/usuarios-store', [Usuarios::class, 'store'])->name('usuarios-store');
    Route::get('/usuarios-editar/{usuario}', [Usuarios::class, 'edit'])->name('usuarios-editar');
    Route::post('/usuarios-update/{usuario}', [Usuarios::class, 'update'])->name('usuarios-update');
    Route::get('/usuarios-delete/{usuario}', [Usuarios::class, 'destroy'])->name('usuarios-destroy');

     /* Energia */
     Route::get('/energia', [Energia::class, 'lista'])->name('energia-listar');
     Route::get('/energia-criar', [Energia::class, 'create'])->name('energia-criar');
     Route::post('/energia-store', [Energia::class, 'store'])->name('energia-store');
     Route::get('/energia-editar/{energia}', [Energia::class, 'edit'])->name('energia-editar');
     Route::post('/energia-update/{energia}', [Energia::class, 'update'])->name('energia-update');
     Route::get('/energia-delete/{energia}', [Energia::class, 'destroy'])->name('energia-destroy');

     /* Hidrico */
     Route::get('/hidrico', [Hidrico::class, 'lista'])->name('hidrico-listar');
     Route::get('/hidrico-criar', [Hidrico::class, 'create'])->name('hidrico-criar');
     Route::post('/hidrico-store', [Hidrico::class, 'store'])->name('hidrico-store');
     Route::get('/hidrico-editar/{hidrico}', [Hidrico::class, 'edit'])->name('hidrico-editar');
     Route::post('/hidrico-update/{hidrico}', [Hidrico::class, 'update'])->name('hidrico-update');
     Route::get('/hidrico-delete/{hidrico}', [Hidrico::class, 'destroy'])->name('hidrico-destroy');

     /* Tipo Paradas */
     Route::get('/tipoparada', [TipoParada::class, 'lista'])->name('tipoparada-listar');
     Route::get('/tipoparada-criar', [TipoParada::class, 'create'])->name('tipoparada-criar');
     Route::post('/tipoparada-store', [TipoParada::class, 'store'])->name('tipoparada-store');
     Route::get('/tipoparada-editar/{tipo}', [TipoParada::class, 'edit'])->name('tipoparada-editar');
     Route::post('/tipoparada-update/{tipo}', [TipoParada::class, 'update'])->name('tipoparada-update');
     Route::get('/tipoparada-delete/{tipo}', [TipoParada::class, 'destroy'])->name('tipoparada-destroy');

     /* Paradas */
     Route::get('/parada', [Paradas::class, 'lista'])->name('parada-listar');
     Route::get('/parada-criar', [Paradas::class, 'create'])->name('parada-criar');
     Route::post('/parada-store', [Paradas::class, 'store'])->name('parada-store');
     Route::get('/parada-editar/{parada}', [Paradas::class, 'edit'])->name('parada-editar');
     Route::post('/parada-update/{parada}', [Paradas::class, 'update'])->name('parada-update');
     Route::get('/parada-delete/{parada}', [Paradas::class, 'destroy'])->name('parada-destroy');
     Route::get('/parada-combo/{data}', [Paradas::class, 'combo'])->name('parada-combo');

     /* Tipo Perdas */
     Route::get('/equipamento', [Equipamentos::class, 'lista'])->name('equipamento-listar');
     Route::get('/equipamento-criar', [Equipamentos::class, 'create'])->name('equipamento-criar');
     Route::post('/equipamento-store', [Equipamentos::class, 'store'])->name('equipamento-store');
     Route::get('/equipamento-editar/{equipamento}', [Equipamentos::class, 'edit'])->name('equipamento-editar');
     Route::post('/equipamento-update/{equipamento}', [Equipamentos::class, 'update'])->name('equipamento-update');
     Route::get('/equipamento-delete/{equipamento}', [Equipamentos::class, 'destroy'])->name('equipamento-destroy');

     /* Tipo Perdas */
     Route::get('/tipoperda', [TipoPerda::class, 'lista'])->name('tipoperda-listar');
     Route::get('/tipoperda-criar', [TipoPerda::class, 'create'])->name('tipoperda-criar');
     Route::post('/tipoperda-store', [TipoPerda::class, 'store'])->name('tipoperda-store');
     Route::get('/tipoperda-editar/{tipo}', [TipoPerda::class, 'edit'])->name('tipoperda-editar');
     Route::post('/tipoperda-update/{tipo}', [TipoPerda::class, 'update'])->name('tipoperda-update');
     Route::get('/tipoperda-delete/{tipo}', [TipoPerda::class, 'destroy'])->name('tipoperda-destroy');
  
     /* Perdas */
     Route::get('/perda', [Perdas::class, 'lista'])->name('perda-listar');
     Route::get('/perda-criar', [Perdas::class, 'create'])->name('perda-criar');
     Route::post('/perda-store', [Perdas::class, 'store'])->name('perda-store');
     Route::get('/perda-editar/{perda}', [Perdas::class, 'edit'])->name('perda-editar');
     Route::post('/perda-update/{perda}', [Perdas::class, 'update'])->name('perda-update');
     Route::get('/perda-delete/{perda}', [Perdas::class, 'destroy'])->name('perda-destroy');
     Route::get('/perda-combo/{ordem}', [Perdas::class, 'combo'])->name('perda-combo');

     /* Recebimento de Tomate */
     Route::get('/recebimentotomate', [RecebimentoTomates::class, 'lista'])->name('recebimentotomate-listar');
     Route::get('/recebimentotomate-criar', [RecebimentoTomates::class, 'create'])->name('recebimentotomate-criar');
     Route::post('/recebimentotomate-store', [RecebimentoTomates::class, 'store'])->name('recebimentotomate-store');
     Route::get('/recebimentotomate-editar/{tomate}', [RecebimentoTomates::class, 'edit'])->name('recebimentotomate-editar');
     Route::post('/recebimentotomate-update/{tomate}', [RecebimentoTomates::class, 'update'])->name('recebimentotomate-update');
     Route::get('/recebimentotomate-delete/{tomate}', [RecebimentoTomates::class, 'destroy'])->name('recebimentotomate-destroy'); 
     
     /* Classificação de Tomate */
     Route::get('/classificacaotomate', [ClassificacaoTomate::class, 'lista'])->name('classificacaotomate-listar');
     Route::get('/classificacaotomate-criar', [ClassificacaoTomate::class, 'create'])->name('classificacaotomate-criar');
     Route::post('/classificacaotomate-store', [ClassificacaoTomate::class, 'store'])->name('classificacaotomate-store');
     Route::get('/classificacaotomate-editar/{tomate}', [ClassificacaoTomate::class, 'edit'])->name('classificacaotomate-editar');
     Route::post('/classificacaotomate-update/{tomate}', [ClassificacaoTomate::class, 'update'])->name('classificacaotomate-update');
     Route::get('/classificacaotomate-delete/{tomate}', [ClassificacaoTomate::class, 'destroy'])->name('classificacaotomate-destroy'); 

     /* Balanço de Massa */
     Route::get('/balancomassa', [BalancoMassa::class, 'lista'])->name('balancomassa-listar');
     Route::get('/balancomassa-criar', [BalancoMassa::class, 'create'])->name('balancomassa-criar');
     Route::post('/balancomassa-store', [BalancoMassa::class, 'store'])->name('balancomassa-store');
     Route::get('/balancomassa-editar/{balanco}', [BalancoMassa::class, 'edit'])->name('balancomassa-editar');
     Route::post('/balancomassa-update/{balanco}', [BalancoMassa::class, 'update'])->name('balancomassa-update');
     Route::get('/balancomassa-delete/{balanco}', [BalancoMassa::class, 'destroy'])->name('balancomassa-destroy'); 

     /* Fretes */
     Route::get('/frete', [Fretes::class, 'lista'])->name('frete-listar');
     Route::any('/frete-criar', [Fretes::class, 'create'])->name('frete-criar');
     Route::post('/frete-store', [Fretes::class, 'store'])->name('frete-store');
     Route::get('/frete-editar/{frete}', [Fretes::class, 'edit'])->name('frete-editar');
     Route::post('/frete-update/{frete}', [Fretes::class, 'update'])->name('frete-update');
     Route::get('/frete-delete/{frete}', [Fretes::class, 'destroy'])->name('frete-destroy'); 
     Route::get('/imprimir-autorizacao-frete/{romaneio}', [Fretes::class, 'imprimir_autorizacao'])->name('imprimir-autorizacao-frete');
     Route::get('/imprimir-rpa/{romaneio}', [Fretes::class, 'imprimir_rpa'])->name('imprimir-rpa');

     /* ################################### indicadores ####################################################### */

     
    /* Previsto x Realizado */
     Route::get('/prod_prev_real', [ProdPrevReal::class, 'listar'])->name('prod_prev_real-listar');  
     Route::post('/prod_prev_real-json', [ProdPrevReal::class, 'listarJson'])->name('prod_prev_real-json');
     Route::post('/prod_prev_real-detalhes', [ProdPrevReal::class, 'modalJson'])->name('prod_prev_real-detalhes');
     Route::get('/prod_prev_real-xls/{tipo}', [ProdPrevReal::class, 'xls'])->name('prod_prev_real-xls');  
 
     
    /* Safra de Polpa */
    Route::get('/safra', [Safra::class, 'listar'])->name('safra-listar');  
    Route::post('/safra-json', [Safra::class, 'listarJson'])->name('safra-json');
    Route::post('/safra-detalhes', [Safra::class, 'modalJson'])->name('safra-detalhes');
    Route::get('/safra-xls/{tipo}', [Safra::class, 'xls'])->name('safra-xls');  
    
});
