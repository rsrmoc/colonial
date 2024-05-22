<?php

namespace App\Models;

use App\Models\Sap\Estoque;
use App\Models\TipoPerda;
use App\Models\Sap\ordemProducao;
use App\Models\Sap\produto;
use App\Models\Sap\Romaneio;
use Illuminate\Database\Eloquent\Model;

class Frete extends Model
{
    protected $table = 'frete';
    protected $primaryKey = 'cd_frete_pedido';

    protected $fillable = [
        'cd_frete_pedido',
        'cd_romaneio', 
        'distancia',
        'vl_km',
        'vl_frete', 
        'vl_frete_add',
        'vl_frete_total',
        'vl_pedagio',
        'nr_caixa',
        'vl_unidade',
        'pal_ton',
        'vl_descarga',
        'qtde_entrega',
        'vl_entrega',
        'vl_entrega_total',
        'vl_outros',
        'vl_descarga_total',
        'cd_usuario', 
        'created_at',
        'updated_at', 
    ];
  
    public function tab_romaneio()
    {
        return $this->belongsTo(Romaneio::class, 'AbsEntry','cd_romaneio');
    } 

}
