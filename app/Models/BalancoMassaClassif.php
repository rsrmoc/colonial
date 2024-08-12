<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalancoMassaClassif extends Model
{
    protected $table = 'balanco_massa_classif';
    protected $primaryKey = 'cd_balanco_classif';

    protected $fillable = [
        'cd_balanco_classif',
        'cd_balanco',
        'cd_classificacao', 
        'cd_usuario', 
        'created_at',
        'updated_at', 
    ];
 
}
