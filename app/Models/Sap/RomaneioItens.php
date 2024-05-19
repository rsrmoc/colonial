<?php

namespace App\Models\Sap;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RomaneioItens extends Model
{
    protected $table = 'SBO_KARAMBI_PRD.dbo.PKL1';
    protected $primaryKey = 'AbsEntry';

    public function tab_pedido_itens()
    {  
        return $this->hasMany(PedidoVendaItens::class, 'DocEntry','OrderEntry');
    } 

}
