<?php

namespace App\Models;

use App\Models\Sap\ordemProducao;
use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    protected $table = 'equipamento';
    protected $primaryKey = 'cd_equipamento';

    protected $fillable = [
        'cd_equipamento',
        'nm_equipamento',
        'sn_ativo',    
        'cd_usuario', 
        'created_at',
        'updated_at', 
    ];
 
    

}
