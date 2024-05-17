<?php

namespace App\Models\Sap;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Fornecedor extends Model
{
    protected $table = 'SBO_KARAMBI_PRD.dbo.ocrd';
    protected $primaryKey = 'CardCode';

    protected $fillable = [
        'CardCode',
        'CardName', 
        'CardType',    
    ];

 
}
