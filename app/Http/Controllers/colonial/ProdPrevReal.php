<?php

namespace App\Http\Controllers\colonial;

use App\Http\Controllers\Controller;
use App\Models\Boleto;
use App\Models\Energia;
use App\Models\Hidrico;
use App\Models\Hospital;
use App\Models\Parada;
use App\Models\Perda;
use App\Models\Produto;
use App\Models\Sap\Estoque;
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
        $ProduzidoCx=0; $PlanejadoCx=0;
        $ProduzidoKg=0; $PlanejadoKg=0;
        $ProduzidoTo=0; $PlanejadoTo=0;     
        foreach($dados as $key => $val){
           if($key % 2 == 0) { $townName2=round($val->planejado_kg); }else{ $townName2=''; }
             
           $data[] = array('year'=>$val->data,
                           'europe'=>round($val->prozuzido,0), 
                           'townName2'=> $townName2,
                           'namerica'=>round($val->planejado,0),
                           'unidade'=>$request['unidade'],
                           'agrupamento'=>$request['agrupamento'],
                           'planejado_kg'=>$val->planejado_kg,
                           'planejado_cx'=>$val->planejado_cx,
                           'produzido_cx'=>$val->produzido_cx,
                           'produzido_kg'=>$val->produzido_kg,
                           'tp_detalhe'=>'grafico'
                        );
                        $Toneladas = ($val->produzido_kg/1000);
                        $plaToneladas = ($val->planejado_kg/1000);

                        $ProduzidoCx=($ProduzidoCx+round($val->produzido_cx,0));
                        $ProduzidoKg=($ProduzidoKg+round($val->produzido_kg,0));
                        $ProduzidoTo=round(($ProduzidoTo+$Toneladas),2);
                        
                        $PlanejadoCx=($PlanejadoCx+round($val->planejado_kg,0));
                        $PlanejadoKg=($PlanejadoKg+round($val->planejado_kg,0));
                        $PlanejadoTo=round(($PlanejadoTo+$plaToneladas),2);
            
        }
 
        $dadosProd = DB::select("
        select ItemName nome, sum(valor) planejado_cx, sum(valor*kg)  planejado_kg,
        sum(valor_prod) produzido_cx,  sum(valor_prod*kg)  produzido_kg,".$planejado.",".$prozuzido."
        from (
            select owor.DocEntry codigo,
                CONVERT (varchar, owor.duedate, 103) data,owor.plannedqty valor, owor.duedate,
                (select sum(quantity) from SBO_KARAMBI_PRD.dbo.ign1 
                    where ign1.BaseRef=owor.DocEntry
                ) valor_prod, owor.ItemCode ,SWeight1 kg ,oitm.ItemName
                from (select * from  SBO_KARAMBI_PRD.dbo.owor where Uom='CX' ) owor 
                inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
                where  CONVERT (varchar, owor.duedate, 120) between '".$request['dti']."' and '".$request['dtf']."'
                and oitm.ItmsGrpCod not in (103)
        ) xx group by ItemName  order by ItemName, produzido_kg desc
        ");

        foreach($dadosProd as $key => $val){
            $Nome = explode('COLONIAL',$val->nome);
            $Nome = $Nome[0]."COLONIAL \n ".$Nome[1];
            $Produtos[$Nome] = round($val->prozuzido,2);

        }
 
        $hidrico = Hidrico::whereRaw("CONVERT(varchar, dt_consumo, 120) between '".$request['dti']."' and '".$request['dtf']."' ")
        ->selectRaw("sum(qtde_atual) valor")->first();
        
        $energia = Energia::whereRaw("CONVERT(varchar, dt_consumo, 120) between '".$request['dti']."' and '".$request['dtf']."' ")
        ->selectRaw("sum(qtde) valor")->first();
 
        $lenha = Estoque::whereRaw("CONVERT(varchar, DocDate, 120) between '".$request['dti']."' and '".$request['dtf']."' ")
        ->whereRaw("WhsCode='MPV'")->selectRaw("sum(Quantity) valor")->first();

        $perda = Perda::whereRaw("CONVERT(varchar, dt_ordem, 120) between '".$request['dti']."' and '".$request['dtf']."' ")
        ->selectRaw("sum(qtde) valor")->first();
         
        $parada = Parada::whereRaw("CONVERT(varchar, dt_cadastro, 120) between '".$request['dti']."' and '".$request['dtf']."' ")
        ->selectRaw("sum(tempo) valor")->first();
   
        $polpa = Estoque::whereRaw("CONVERT(varchar, DocDate, 120) between '".$request['dti']."' and '".$request['dtf']."' ")
        ->whereRaw("ItemCode='013906'")->selectRaw("sum(Quantity) valor")->first();

        $request['PlanejadoCx'] =  ($PlanejadoCx) ?  number_format($PlanejadoCx,0,",",".") : '000';
        $request['PlanejadoKg'] = ($PlanejadoKg) ?  number_format($PlanejadoKg,0,",",".") : '000';
        $request['PlanejadoTo'] = ($PlanejadoTo) ?  number_format($PlanejadoTo,2,",",".") : '0,00'; 
        $request['ProduzidoCx'] =  ($ProduzidoCx) ?  number_format($ProduzidoCx,0,",",".") : '000';
        $request['ProduzidoKg'] = ($ProduzidoKg) ?  number_format($ProduzidoKg,0,",",".") : '000';
        $request['ProduzidoTo'] = ($ProduzidoTo) ?  number_format($ProduzidoTo,2,",",".") : '0,00';
        $request['hidrico'] = ($hidrico->valor) ?  number_format($hidrico->valor,2,",",".") : '0,00';
        $request['energia'] = ($energia->valor) ?  number_format($energia->valor,2,",",".") : '0,00';
        $request['lenha'] = ($lenha->valor) ?  number_format($lenha->valor,2,",",".") : '0,00';
        $request['perda'] = ($perda->valor) ?  number_format($perda->valor,0,",",".") : '00';
        $request['parada'] = ($parada->valor) ?  number_format($parada->valor,0,",",".") : '00';
        $request['polpa'] = ($polpa->valor) ?  number_format($polpa->valor,0,",",".") : '00';
        $request['datai'] = date('d/m/Y',strtotime($request['dti']));
        $request['dataf'] = date('d/m/Y',strtotime($request['dtf']));
        $retorno['previsto'] = $data;
        $retorno['dadosProd'] = $dadosProd;
        $retorno['request'] = $request->toArray();
        $retorno['produtos'] = $Produtos;
        return $retorno;
    }

    public function detalhesJson(Request $request) { 
        $request['dias'] = null;
        $request['relacao'] = null;
        $request['tab']=null;
        $request['grafico_titulo']=null;
        $request['data_titulo']=null;
        if($request['tp_detalhe']=='grafico'){
            
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

            if($request['agrupamento']=='D'){
                $request['titulo']='DIA: '.$request['date'];
                $request['tab']='D';
                $request['grafico_titulo']='Tipo de Produtos';
                $request['data_titulo']=$request['date'];

                $dados = DB::select("
                select ItemName nome, sum(valor) planejado_cx, sum(valor*kg)  planejado_kg,
                sum(valor_prod) produzido_cx,  sum(valor_prod*kg)  produzido_kg,".$planejado.",".$prozuzido."
                from (
                    select owor.DocEntry codigo,
                        CONVERT (varchar, owor.duedate, 103) data,owor.plannedqty valor, owor.duedate,
                        (select sum(quantity) from SBO_KARAMBI_PRD.dbo.ign1 
                            where ign1.BaseRef=owor.DocEntry
                        ) valor_prod, owor.ItemCode ,SWeight1 kg ,oitm.ItemName
                        from (select * from  SBO_KARAMBI_PRD.dbo.owor where Uom='CX' ) owor 
                        inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
                        where  CONVERT (varchar, owor.duedate, 103) like '%".$request['date']."%'
                        and oitm.ItmsGrpCod not in (103)
                ) xx group by ItemName  order by ItemName
                ");

                foreach($dados as $key => $val){
                    $dias[] = array( 
                        "country"=> $val->nome,
                        "visits"=> $val->prozuzido,
                        "color"=> "#CD0D74",
                        'latitude'=>$val->planejado,
                        'duration'=>$val->planejado,
                    );
                }
                $request['dias'] = $dias; 

            }

            if($request['agrupamento']=='M'){
                $request['tab']='M';
                $request['titulo']='MÊS: '.$request['date'];
                $request['grafico_titulo']='Produção Diária';
                $request['data_titulo']=$request['date'];

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
                        "color"=> "#B0DE09",
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
