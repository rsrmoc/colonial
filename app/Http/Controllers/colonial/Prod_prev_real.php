<?php

namespace App\Http\Controllers\colonial;

use App\Http\Controllers\Controller;
use App\Models\Boleto;
use App\Models\Hospital;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Producao extends Controller
{
   
    public function previsto_realizado() { 
   
        return view('colonial.producao.indicadores/previsto_realizado');
    }
 
}
