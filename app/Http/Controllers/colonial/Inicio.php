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
  
    public function login() { 
        return view('login');
    }

    public function home() { 
        return view('colonial.inicial/home');
    }

    public function grafico() { 
        return view('colonial.inicial/inicial');
    }
}
