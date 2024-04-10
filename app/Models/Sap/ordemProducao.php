<?php

namespace App\Models\Sap;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrdemProducao extends Model
{
    protected $table = 'SBO_KARAMBI_PRD.dbo.owor';
    protected $primaryKey = 'DocEntry';

    protected $fillable = [
        'DocEntry',
        'ItemCode', 
        'DocNum', 
        'PlannedQty',
        'CmpltQty', 
        'duedate', 
        'Status', 
        'CmpltQty', 
    ];

 
}
