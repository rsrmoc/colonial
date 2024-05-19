<?php

namespace App\Models\Sap;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder; 

class Romaneio extends Model
{
    protected $table = 'SBO_KARAMBI_PRD.dbo.OPKL';
    protected $primaryKey = 'AbsEntry';

    public function tab_romaneio_itens()
    { 
        return $this->hasMany(RomaneioItens::class, 'AbsEntry');
    } 

    public function tab_motorista()
    { 
        return $this->belongsTo(Fornecedor::class, 'U_motorista','CardCode');
    }
  
    public function scopeSearchRelacao(Builder $dados, $request): Builder
    { 
        $dados = $dados->with(['tab_romaneio_itens','tab_motorista']);

        if($request->romaneio){ 
            $dados =$dados->where('AbsEntry',$request->romaneio); 
        }
 
        if($request->dti){ 
            $dados =$dados->where(DB::raw('CONVERT(CHAR(10),PickDate, 23)'),'>=',$request->dti); 
        }

        if($request->dtf){ 
            $dados =$dados->where(DB::raw('CONVERT(CHAR(10),PickDate, 23)'),'<=',$request->dtf); 
        }

        if($request->status){ 
            $dados =$dados->where('Status',$request->status); 
        }

        if($request->motorista){ 
            $dados =$dados->where('U_motorista',$request->motorista); 
        }

        return $dados;
    }

 

}
