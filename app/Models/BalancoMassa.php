<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalancoMassa extends Model
{
    protected $table = 'balanco_massa';
    protected $primaryKey = 'cd_balanco';

    protected $fillable = [
        'cd_balanco',
        'nm_balanco',
        'dt_inicial',
        'dt_final',
        'cd_fornecedor',
        'nm_fornecedor',
        'brix_ponderado',   
        'obs',
        'created_at',
        'updated_at', 
    ];
 
}
