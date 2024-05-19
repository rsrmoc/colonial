<?php

namespace App\Models\Sap;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PedidoVendaItens extends Model
{
    protected $table = 'SBO_KARAMBI_PRD.dbo.RDR1';
    protected $primaryKey = 'DocEntry';
  
}
