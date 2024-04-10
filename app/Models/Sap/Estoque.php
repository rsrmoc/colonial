<?php

namespace App\Models\Sap;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Estoque extends Model
{
    protected $table = 'SBO_KARAMBI_PRD.dbo.IGE1';
    protected $primaryKey = 'DocEntry';

    protected $fillable = [
        'DocEntry',
        'itemcode', 
        'dscription', 
        'LineNum',
        'BaseRef',    
    ];

 
}
