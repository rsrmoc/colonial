<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassificacaoTomate extends Model
{
    protected $table = 'classificacao_tomate';
    protected $primaryKey = 'cd_classificacao';

    protected $fillable = [
        'cd_classificacao',
        'dt_recebimento',
        'dt_recebimento',
        'residuo',
        'terra',
        'sujeira',
        'verde',
        'total', 
        'obs',
        'created_at',
        'updated_at', 
    ];
 
}
