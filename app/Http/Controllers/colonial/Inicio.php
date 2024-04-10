<?php

namespace App\Http\Controllers\colonial;

use App\Http\Controllers\Controller;
use App\Models\Boleto;
use App\Models\Hospital;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Inicio extends Controller
{
    public function cadastro() {
        $hospitais = Hospital::all();
        $produtos = Produto::all();

        return view('index', [
            'hospitais' => $hospitais,
            'produtos' => $produtos,
        ]);
    }

    public function login() {
        
   
        return view('login');
    }

    public function home() {
        
   
        return view('colonial.inicial/home');
    }

 
}
