<?php

namespace App\Models;

use App\Models\Sap\Estoque;
use App\Models\TipoPerda;
use App\Models\Sap\ordemProducao;
use App\Models\Sap\produto;
use App\Models\Sap\Romaneio;
use Illuminate\Database\Eloquent\Model;

class FretePedido extends Model
{
    protected $table = 'frete_pedido';
    protected $primaryKey = 'cd_frete_pedido';

    protected $fillable = [
        'cd_frete_pedido',
        'cd_romaneio', 
        'cd_pedido',
        'vl_pedido_frete', 
        'created_at',
        'updated_at', 
    ];
  
    public function tab_romaneio()
    {
        return $this->belongsTo(Romaneio::class, 'AbsEntry','cd_romaneio');
    } 

}
