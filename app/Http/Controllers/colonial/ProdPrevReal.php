<?php

namespace App\Http\Controllers\colonial;

use App\Http\Controllers\Controller;
use App\Models\Boleto;
use App\Models\Hospital;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdPrevReal extends Controller
{
   
    public function listar() { 
        $request['dti']=date('Y-m-d', strtotime("-20 days",strtotime(date('Y-m-d'))));
        $request['dtf']=date('Y-m-d');
        return view('colonial.producao.indicadores/previsto_realizado',compact('request'));
    }
 
    public function listarJson(Request $request) { 

        if(empty($request['dti'])){
            $request['dti']=date('Y-m-d', strtotime("-20 days",strtotime(date('Y-m-d'))));
        }
        if(empty($request['dtf'])){
            $request['dtf']=date('Y-m-d');
        }
        if(empty($request['agrupamento'])){
            $request['agrupamento']='D';
        }
        if(empty($request['unidade'])){
            $request['unidade']='KG';
            $request['ds_unidade']='Kg';

        }
        if($request['agrupamento']=='D'){
            $Agrupamento1='data';
            $Agrupamento2='data';
            $Agrupamento22='duedate';
            $Agrupamento12='duedate';
        }
        if($request['agrupamento']=='M'){
            $Agrupamento1='SUBSTRING(data, 4, 7) data';
            $Agrupamento2='SUBSTRING(data, 4, 7)';
            $Agrupamento12='SUBSTRING(duedate, 0, 7)  duedate';
            $Agrupamento22='SUBSTRING(duedate, 0, 7) ';
             
        }
        if($request['unidade']=='KG'){
            $planejado='sum(valor*kg) planejado'; 
            $prozuzido='sum(valor_prod*kg) prozuzido'; 
            $request['ds_unidade']='Kg';
        }
        if($request['unidade']=='CX'){
            $planejado='sum(valor) planejado'; 
            $prozuzido='sum(valor_prod) prozuzido'; 
            $request['ds_unidade']='Cx';
        }
 
 
        $dados = DB::select("
        select ".$Agrupamento1.", ".$Agrupamento12.", sum(valor) planejado_cx, sum(valor*kg)  planejado_kg,
        sum(valor_prod) produzido_cx,  sum(valor_prod*kg)  produzido_kg,".$planejado.",".$prozuzido."
        from (
            select owor.DocEntry codigo,
                CONVERT (varchar, owor.duedate, 103) data,owor.plannedqty valor, CONVERT (varchar, owor.duedate, 112) duedate,
                (select sum(quantity) from SBO_KARAMBI_PRD.dbo.ign1 
                    where ign1.BaseRef=owor.DocEntry
                ) valor_prod, owor.ItemCode ,SWeight1 kg 
                from (select * from  SBO_KARAMBI_PRD.dbo.owor where Uom='CX' ) owor 
                inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
                where  convert(varchar(10),owor.duedate,120) between '".$request['dti']."' and '".$request['dtf']."'
                and oitm.ItmsGrpCod not in (103)
        ) xx group by ".$Agrupamento2.",".$Agrupamento22."  order by ".$Agrupamento22."
        ");

        foreach($dados as $key => $val){
           if($key % 2 == 0) { $townName2=round($val->planejado_kg); }else{ $townName2=''; }
           
           $data[] = array('date'=>$val->data,
                           'realizado'=>$val->prozuzido,
                           'townName2'=> $townName2,
                           'latitude'=>$val->planejado,
                           'color'=>'#4472c4',
                           'unidade'=>$request['unidade'],
                           'agrupamento'=>$request['agrupamento'],
                           'planejado_kg'=>$val->planejado_kg,
                           'planejado_cx'=>$val->planejado_cx,
                           'produzido_cx'=>$val->produzido_cx,
                           'produzido_kg'=>$val->produzido_kg,
                           'tp_detalhe'=>'grafico'
                        );
        }

     
        $request['datai'] = date('d/m/Y',strtotime($request['dti']));
        $request['dataf'] = date('d/m/Y',strtotime($request['dtf']));
        $retorno['previsto'] = $data;
        $retorno['request'] = $request->toArray();
   
        return $retorno;
    }

    public function detalhesJson(Request $request) { 
        $request['dias'] = null;
        $request['relacao'] = null;
        if($request['tp_detalhe']=='grafico'){
            
            if($request['agrupamento']=='D'){

            }
            if($request['agrupamento']=='M'){

                if($request['unidade']=='KG'){
                    $planejado='sum(valor*kg) planejado'; 
                    $prozuzido='sum(valor_prod*kg) prozuzido'; 
                    $request['ds_unidade']='Kg';
                }
                if($request['unidade']=='CX'){
                    $planejado='sum(valor) planejado'; 
                    $prozuzido='sum(valor_prod) prozuzido'; 
                    $request['ds_unidade']='Cx';
                }

                $dados = DB::select("
                select data,duedate, sum(valor) planejado_cx, sum(valor*kg)  planejado_kg,
                sum(valor_prod) produzido_cx,  sum(valor_prod*kg)  produzido_kg,".$planejado.",".$prozuzido."
                from (
                    select owor.DocEntry codigo,
                        CONVERT (varchar, owor.duedate, 103) data,owor.plannedqty valor, owor.duedate,
                        (select sum(quantity) from SBO_KARAMBI_PRD.dbo.ign1 
                            where ign1.BaseRef=owor.DocEntry
                        ) valor_prod, owor.ItemCode ,SWeight1 kg 
                        from (select * from  SBO_KARAMBI_PRD.dbo.owor where Uom='CX' ) owor 
                        inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
                        where  CONVERT (varchar, owor.duedate, 103) like '%".$request['date']."%'
                        and oitm.ItmsGrpCod not in (103)
                ) xx group by data,duedate  order by duedate
                ");

                foreach($dados as $key => $val){
                    $dias[] = array( 
                        "country"=> $val->data,
                        "visits"=> $val->prozuzido,
                        "color"=> "#0D52D1",
                        'latitude'=>$val->planejado,
                    );
                }
                $request['dias'] = $dias; 
            }
            $relacao = DB::select("
            select owor.DocEntry codigo,
            CONVERT (varchar, owor.duedate, 103) data,owor.plannedqty valor,  
            (select sum(quantity) from SBO_KARAMBI_PRD.dbo.ign1 
                where ign1.BaseRef=owor.DocEntry
            ) valor_prod, owor.ItemCode ,SWeight1 kg, oitm.ItemName
            from (select * from  SBO_KARAMBI_PRD.dbo.owor where Uom='CX' ) owor 
            inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
            where CONVERT (varchar, owor.duedate, 103) like '%".$request['date']."%'
            and oitm.ItmsGrpCod not in (103)
            order by owor.duedate
            ");
            $request['relacao'] = $relacao;
        }
        return $request;
    }
    

    
}
