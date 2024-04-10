<?php

namespace App\Models\Sap;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produto extends Model
{
    protected $table = 'SBO_KARAMBI_PRD.dbo.oitm';
    protected $primaryKey = 'ItemCode';

    protected $fillable = [
        'ItemCode',
        'ItemName', 
        'CardCode', 
        'CstGrpCode',
        'OnOrder', 
        'DfltWH',    
    ];

 
}
