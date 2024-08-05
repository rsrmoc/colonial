<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalancoMassaEntrada extends Model
{
    protected $table = 'balanco_massa_entrada';
    protected $primaryKey = 'cd_balanco_entrada';

    protected $fillable = [
        'cd_balanco_entrada',
        'cd_balanco',
        'cd_entrada',
        'cd_usuario', 
        'created_at',
        'updated_at', 
    ];
 
}
