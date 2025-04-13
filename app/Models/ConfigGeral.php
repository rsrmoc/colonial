<?php

namespace App\Models;

use App\Models\Sap\Estoque;
use App\Models\TipoPerda;
use App\Models\Sap\ordemProducao;
use App\Models\Sap\produto;
use App\Models\Sap\Romaneio;
use Illuminate\Database\Eloquent\Model;

class ConfigGeral extends Model
{
    protected $table = 'config_geral';
    protected $primaryKey = 'codigo';

    protected $fillable = [
        'codigo',
        'key_kentro', 
        'url_kentro',
        'fila_kentro', 
    ];
  

}
