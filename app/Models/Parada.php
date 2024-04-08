<?php

namespace App\Models;

use App\Models\Sap\ordemProducao;
use Illuminate\Database\Eloquent\Model;

class Parada extends Model
{
    protected $table = 'producao_parada';
    protected $primaryKey = 'cd_producao_parada';

    protected $fillable = [
        'cd_producao_parada',
        'cd_ordem', 
        'cd_parada',
        'tempo', 
        'obs_parada',
        'dt_ordem',
        'cd_usuario',
        'dt_cadastro',
        'created_at',
        'updated_at', 
    ];
 
    public function tab_ordem()
    {
        return $this->belongsTo(ordemProducao::class, 'cd_ordem','DocEntry');
    } 

    public function tab_tipo()
    {
        return $this->belongsTo(TipoParada::class, 'cd_parada','cd_tipo');
    } 

}
