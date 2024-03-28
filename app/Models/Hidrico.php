<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hidrico extends Model
{
    protected $table = 'hidricos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'qtde_anterior', 
        'qtde_atual', 
        'saldo',
        'dt_consumo', 
        'created_at',
        'updated_at', 
    ];
 
}
