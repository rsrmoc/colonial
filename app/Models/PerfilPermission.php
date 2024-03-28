<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfilPermission extends Model
{
    protected $table = 'perfis_permissions';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'cd_perfil',
        'nome', 
        'permissoes', 
        'created_at',
        'updated_at', 
    ];
}
