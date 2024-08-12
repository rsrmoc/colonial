<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalancoMassaPolpa extends Model
{
    protected $table = 'balanco_massa_polpa';
    protected $primaryKey = 'cd_balanco_polpa';

    protected $fillable = [
        'cd_balanco_polpa',
        'cd_balanco',
        'cd_ordem', 
        'cd_usuario', 
        'created_at',
        'updated_at', 
    ];
 
}
