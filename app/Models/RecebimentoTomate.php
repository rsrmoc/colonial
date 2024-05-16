<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecebimentoTomate extends Model
{
    protected $table = 'recebimento_tomate';
    protected $primaryKey = 'cd_recebimento';

    protected $fillable = [
        'cd_recebimento',
        'cd_recebimento',
        'dt_recebimento',
        'hr_inicial',
        'hr_final',
        'nr_controle',
        'placa',
        'cd_fornecedor',
        'nm_fornecedor',
        'verde',
        'praga',
        'fungo',
        'desintegrado',
        'defeito',
        'impureza',
        'terra',
        'fruto',
        'total',
        'brix',
        'ph',
        'acidez',
        'liquido',
        'desconto',
        'obs',
        'created_at',
        'updated_at',
        
    ];
 
}
