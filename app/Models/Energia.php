<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Energia extends Model
{
    protected $table = 'energias';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'qtde', 
        'dt_consumo', 
        'created_at',
        'updated_at', 
    ];
 
}
