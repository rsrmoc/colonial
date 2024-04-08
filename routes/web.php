<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\colonial\BoletoHistorico;
use App\Http\Controllers\colonial\Bot;
use App\Http\Controllers\colonial\Clientes;
use App\Http\Controllers\colonial\Condominios;
use App\Http\Controllers\colonial\Controle;
use App\Http\Controllers\colonial\Energia; 
use App\Http\Controllers\colonial\Hidrico; 
use App\Http\Controllers\colonial\Inicio;
use App\Http\Controllers\colonial\Integracoes;
use App\Http\Controllers\colonial\NegociacaoBoletoController;
use App\Http\Controllers\colonial\NegociacoesController;
use App\Http\Controllers\colonial\Paradas;
use App\Http\Controllers\colonial\Perfis;
use App\Http\Controllers\colonial\ProdPrevReal;
use App\Http\Controllers\colonial\TipoParada;
use App\Http\Controllers\colonial\Usuarios;
use App\Http\Controllers\UsuariosController;
use App\Http\Middleware\UserPermissions;
 
use App\Models\Perfil;
use Illuminate\Support\Facades\Route;

Route::get('/', [Inicio::class,  'home']);
Route::get('/login', [Inicio::class, 'login'])->name('login')->middleware('guest');
route::post('/login', [AuthController::class, 'login'])->name('login-action')->middleware('guest');

Route::group([
    'prefix' => 'colonial',
    'middleware' => ['auth', UserPermissions::class]
], function() {

    Route::get('/', [Inicio::class, 'home'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

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
     
    /* Previsto x Realizado */
     Route::get('/prod_prev_real', [ProdPrevReal::class, 'listar'])->name('prod_prev_real-listar');  
     Route::post('/prod_prev_real-json', [ProdPrevReal::class, 'listarJson'])->name('prod_prev_real-json');
     Route::post('/prod_prev_real-detalhes', [ProdPrevReal::class, 'detalhesJson'])->name('prod_prev_real-detalhes');
 
 
    
});
