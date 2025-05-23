<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoParada extends Model
{
    protected $table = 'producao_tipo';
    protected $primaryKey = 'cd_tipo';

    protected $fillable = [
        'cd_tipo',
        'nm_tipo', 
        'sn_ativo', 
        'dt_cadastro',
        'cd_usuario',
        'created_at',
        'updated_at', 
    ];

    
}
