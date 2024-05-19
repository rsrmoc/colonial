<?php

namespace App\Models\Sap;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PedidoVenda extends Model
{
    protected $table = 'SBO_KARAMBI_PRD.dbo.ORDR';
    protected $primaryKey = 'DocEntry';
 
}
