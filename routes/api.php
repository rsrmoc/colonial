<?php

use App\Http\Controllers\Api\CadastroController;
use App\Http\Controllers\Api\ProdutoController;
use App\Http\Controllers\Api\Rotinas;
use Illuminate\Support\Facades\Route;

Route::get('produto-pesquisa', [ProdutoController::class, 'search']);
Route::post('cadastro', [CadastroController::class, 'store']);
Route::get('rotina-whast', [Rotinas::class, 'rotina_whast']);
