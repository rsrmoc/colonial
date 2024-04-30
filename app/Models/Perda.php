<?php

namespace App\Models;

use App\Models\Sap\Estoque;
use App\Models\TipoPerda;
use App\Models\Sap\ordemProducao;
use App\Models\Sap\produto;
use Illuminate\Database\Eloquent\Model;

class Perda extends Model
{
    protected $table = 'perda';
    protected $primaryKey = 'cd_perda';

    protected $fillable = [
        'cd_perda',
        'cd_ordem', 
        'cd_produto',
        'nm_produto',
        'qtde', 
        'obs_perda',
        'cd_tipo_perda',
        'dt_ordem',
        'grupo',
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
        return $this->belongsTo(TipoPerda::class, 'cd_tipo_perda','cd_tipo');
    } 

    public function tab_produto()
    {
        return $this->belongsTo(Estoque::class, 'cd_produto','ItemCode');
    } 

}
