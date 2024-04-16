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
use Illuminate\Support\Facades\Validator;

class ProdPrevReal extends Controller
{
   
    public function listar() { 
  
      
        $MESES = array(1 => "JANEIRO", 2 => "FEVEREIRO", 3 => "MARÇO", 4 => "ABRIL", 5 => "MAIO", 6 => "JUNHO", 7 => "JULHO", 8 => "AGOSTO", 9 => "SETEMBRO", 10 => "OUTUBRO", 11 => "NOVEMBRO", 12 => "DEZEMBRO");
        for ($x = 0; $x <= 10; $x++) {
            $ANO[] = (date('Y')-$x);
        } 
        foreach($ANO as $ano){
            foreach($MESES as $cod_mes => $mes){ 
                $MES[$ano][$cod_mes] =  cal_days_in_month(CAL_GREGORIAN,$cod_mes,$ano);
            } 
        }
      
        $request['dti']=date('Y-m-d', strtotime("-20 days",strtotime(date('Y-m-d'))));
        $request['dtf']=date('Y-m-d');
        return view('colonial.producao.indicadores/previsto_realizado',compact('request','MESES','ANO','MES'));
    }
 
    public function listarJson(Request $request) { 

        if($request['valida']==true){
            $validator = Validator::make($request->all(), [
                'ano' => 'required|integer',
                'unidade' => 'required' 
            ],[
                'ano.required' => 'O campo Ano é obrigatorio',
                'unidade.required' => 'O campo Visão é obrigatorio',
            ]);
            
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->first()], 400);
            }
        }else{
            $request['ano']=date('Y');
            $request['mes']=date('m'); 
            $request['dia']=null;
        }

        
        $dataParametro=$request['ano']; 
        if($request['mes']){
            $dataParametro=$dataParametro.'-'.$request['mes'];
            if($request['dia']){
                $dataParametro=$dataParametro.'-'.str_pad($request['dia'] , 2 , '0' , STR_PAD_LEFT);
                if(!checkdate($request['mes'], $request['dia'], $request['ano'])){
                    return response()->json(['errors' => 'Data Inválida!'], 400);
                }
                $request['dti']=$dataParametro;
                $request['dtf']=$dataParametro;
            }else{
                if(!checkdate($request['mes'], '01', $request['ano'])){
                    return response()->json(['errors' => 'Data Inválida!'], 400);
                }
                $request['dti']=$dataParametro.'-01';
                $request['dtf']=$dataParametro.'-'.cal_days_in_month(CAL_GREGORIAN,$request['mes'],$request['ano']);
            }
        }else{
            if(!checkdate('01', '01', $request['ano'])){
                return response()->json(['errors' => 'Data Inválida!'], 400);
            }

            
            $request['dti']=$dataParametro.'-01-01';
            $request['dtf']=$dataParametro.'-12-31';
        }

        $request['dt_comparativa_ano']=($request['ano']-9).'-01-01';
        $request['dt_comparativa_dia']=date("Y-m-d", strtotime("-30 days",strtotime($request['dtf'])));
        $request['dt_comparativa_mes']=($request['ano']-2).'-01-01';
       
        $request['agrupamento']='M';
        if($request['mes']){$request['agrupamento']='D';}
        if($request['dia']){$request['agrupamento']='P';}
 
 
        if(empty($request['unidade'])){
            $request['unidade']='KG';
            $request['ds_unidade']='Kg';
            $request['ds_unid']=' [ Kilos ]';

        }
        if($request['agrupamento']=='D'){
            $Agrupamento1='data';
            $Agrupamento2='data';
            $Agrupamento22='duedate';
            $Agrupamento12='duedate'; 
           
        }

        if($request['agrupamento']=='P'){
            $Agrupamento1='nome data';
            $Agrupamento2='nome';
            $Agrupamento22='nome';
            $Agrupamento12='nome'; 
        }

        if($request['agrupamento']=='M'){
            $Agrupamento1='SUBSTRING(data, 4, 7) data';
            $Agrupamento2='SUBSTRING(data, 4, 7)';
            $Agrupamento12='SUBSTRING(duedate, 0, 7)  duedate';
            $Agrupamento22='SUBSTRING(duedate, 0, 7) ';  
        }

        if($request['agrupamento']=='A'){
            $Agrupamento1='SUBSTRING(data, 7, 7) data';
            $Agrupamento2='SUBSTRING(data, 7, 7)';
            $Agrupamento12='SUBSTRING(duedate, 0, 5)  duedate';
            $Agrupamento22='SUBSTRING(duedate, 0, 5)'; 
        }

        if($request['unidade']=='KG'){
            $planejado='sum(valor*kg) planejado'; 
            $prozuzido='sum(valor_prod*kg) prozuzido'; 
            $request['ds_unidade']='Kg';
            $prozuzidoProd='sum(quantity*SWeight1)';
            $produzidoComparativo='sum(quantity*SWeight1)';
            $request['ds_unid']=' [ Kilos ]';
        }
        if($request['unidade']=='CX'){
            $planejado='sum(valor) planejado'; 
            $prozuzido='sum(valor_prod) prozuzido'; 
            $request['ds_unidade']='Cx';
            $prozuzidoProd='sum(quantity)';
            $produzidoComparativo='sum(quantity)';
            $request['ds_unid']=' [ Caixas ]';
        }
  
        if($request['unidade']=='TO'){
            $planejado='sum((valor*kg)/1000) planejado'; 
            $prozuzido='sum((valor_prod*kg)/1000) prozuzido'; 
            $request['ds_unidade']='To';
            $prozuzidoProd='sum((quantity*SWeight1)/1000)';
            $produzidoComparativo='sum((quantity*SWeight1)/1000)';
            $request['ds_unid']=' [ Toneladas ]';
        }
  
        /* Previsto */
        $dados = DB::select("
        select ".$Agrupamento1.", ".$Agrupamento12.", sum(valor) planejado_cx, sum(valor*kg)  planejado_kg,
        sum(valor_prod) produzido_cx,  sum(valor_prod*kg)  produzido_kg,".$planejado.",".$prozuzido."
        from (
            select owor.DocEntry codigo,
                CONVERT (varchar, owor.duedate, 103) data,owor.plannedqty valor, CONVERT (varchar, owor.duedate, 112) duedate,
                (select sum(quantity) from SBO_KARAMBI_PRD.dbo.ign1 
                    where ign1.BaseRef=owor.DocEntry
                ) valor_prod, owor.ItemCode ,SWeight1 kg,ProdName nome 
                from (select * from  SBO_KARAMBI_PRD.dbo.owor where Uom='CX' ) owor 
                inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
                where CONVERT(CHAR(10),owor.duedate, 23) between '".$request['dti']."' and '".$request['dtf']."'
                and oitm.ItmsGrpCod not in (103)
        ) xx group by ".$Agrupamento2.",".$Agrupamento22."  order by ".$Agrupamento22."
        ");
        $ProduzidoCx=0; $PlanejadoCx=0;
        $ProduzidoKg=0; $PlanejadoKg=0;
        $ProduzidoTo=0; $PlanejadoTo=0;     
        $data=null;
        foreach($dados as $key => $val){
           if($key % 2 == 0) { $townName2=round($val->planejado_kg); }else{ $townName2=''; }
             
           $data[] = array('label'=>$val->data,
                           'produzido'=>round($val->prozuzido,0), 
                           'townName2'=> $townName2,
                           'planejado'=>round($val->planejado,0),
                           'unidade'=>$request['unidade'],
                           'agrupamento'=>$request['agrupamento'],
                           'planejado_kg'=>$val->planejado_kg,
                           'planejado_cx'=>$val->planejado_cx,
                           'produzido_cx'=>$val->produzido_cx,
                           'produzido_kg'=>$val->produzido_kg,
                           'tp_detalhe'=>'grafico',
                           "color_planejado"=> "#008000",
                           "color_produzido"=>"#FF0F00" 

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

  
        /* Produto */ 
        $dadosProd = DB::select(" 
        select ItemName nome, sum(quantity) produzido_cx,sum(quantity*SWeight1) produzido_kg,sum((quantity*SWeight1)/1000) produzido_to,".$prozuzidoProd." produzido
        from SBO_KARAMBI_PRD.dbo.ign1 
        inner join (select * from  SBO_KARAMBI_PRD.dbo.owor where Uom='CX' ) owor on ign1.BaseRef=owor.DocEntry
        inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
        where CONVERT(CHAR(10),owor.duedate, 23)  between '".$request['dti']."' and '".$request['dtf']."'
        group by ItemName 
        order by ".$prozuzidoProd." desc");
        $Produtos=null;
        foreach($dadosProd as $key => $val){ 
           
            $Produtos[]=array(
                "produto"=>$val->nome,
                "qtde"=>round($val->produzido,2),
                "color"=> $this->gerar_cor($key)
            );

        }

        $Comparativo=null;
        if($request['agrupamento']=='M'){
            /* Comparativo ANO */ 
   
            $dadosProd = DB::select(" 
            select year(owor.duedate) ano,".$produzidoComparativo." qtde
            from SBO_KARAMBI_PRD.dbo.ign1 
            inner join (select * from  SBO_KARAMBI_PRD.dbo.owor where Uom='CX' ) owor on ign1.BaseRef=owor.DocEntry
            inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
            where CONVERT(CHAR(10),owor.duedate, 23)  between '".$request['dt_comparativa_ano']."' and '".$request['dtf']."'
            group by year(owor.duedate) 
            order by 1");
            $ComparativoAno=null;
            foreach($dadosProd as $key => $val){ 
            
                $Comparativo[]=array( 
                    "country"=>$val->ano,
                    "visits"=>round($val->qtde,2),
                    "color"=> $this->gerar_cor($key)
                );

            }
        }
 
        if($request['agrupamento']=='P'){
            /* Comparativo DIA */ 
  
 
            $dadosComp = DB::select(" 
            select CONVERT (varchar, owor.duedate, 103) data,".$produzidoComparativo." qtde
            from SBO_KARAMBI_PRD.dbo.ign1 
            inner join (select * from  SBO_KARAMBI_PRD.dbo.owor where Uom='CX' ) owor on ign1.BaseRef=owor.DocEntry
            inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
            where CONVERT(CHAR(10),owor.duedate, 23)  between '".$request['dt_comparativa_dia']."' and '".$request['dtf']."'
            group by CONVERT(varchar, owor.duedate, 103)
            order by 1"); 
            foreach($dadosComp as $key => $val){ 
            
                $Comparativo[]=array( 
                    "country"=>$val->data,
                    "visits"=>round($val->qtde,2),
                    "color"=> $this->gerar_cor($key)
                );

            }
        }

        $Anos=null;
        $ComparativoAno=null;
        if($request['agrupamento']=='D'){ 
            /* Comparativo MESES */  
            $X=1;
            for ($x = ($request['ano']-2); $x <= $request['ano']; $x++) { 
                $ANOS['ano0'.$X]=$x;
                $LABEL_ANOS['ano0'.$X]=$x;
                $X = ($X+1);
                $Anos[] = $x;

            }
            $MESES = array('01' => "JANEIRO", '02' => "FEVEREIRO", '03' => "MARÇO", '04' => "ABRIL", '05' => "MAIO", '06' => "JUNHO", '07' => "JULHO", '08' => "AGOSTO", 
            '09' => "SETEMBRO", '10' => "OUTUBRO", '11' => "NOVEMBRO", '12' => "DEZEMBRO");
            foreach($MESES as $key => $labelMes){
                foreach($ANOS as $ano ){ 
                    $DadosAno[$key][$ano]=0;
                }
            } 

            $dadosProd = DB::select(" 
            select  CAST(year(owor.duedate) AS NVARCHAR(4))+CAST( right(replicate('0',2) + convert(VARCHAR,MONTH(owor.duedate)),2) AS NVARCHAR(2)) data, 
            year(owor.duedate) ano,CAST( right(replicate('0',2) + convert(VARCHAR,MONTH(owor.duedate)),2) AS NVARCHAR(2)) mes,".$produzidoComparativo." qtde
            from SBO_KARAMBI_PRD.dbo.ign1 
            inner join (select * from  SBO_KARAMBI_PRD.dbo.owor where Uom='CX' ) owor on ign1.BaseRef=owor.DocEntry
            inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
            where CONVERT(CHAR(10),owor.duedate, 23)  between '".$request['dt_comparativa_mes']."' and '".$request['dtf']."'
            group by CAST(year(owor.duedate) AS NVARCHAR(4))+CAST( right(replicate('0',2) + convert(VARCHAR,MONTH(owor.duedate)),2) AS NVARCHAR(2)) ,year(owor.duedate),
                    CAST( right(replicate('0',2) + convert(VARCHAR,MONTH(owor.duedate)),2) AS NVARCHAR(2))
            order by 3,1 "); 
            foreach($dadosProd as $val){  
                $DadosAno[$val->mes][$val->ano] = $val->qtde;
            } 
            foreach($DadosAno as $keyMes => $val){  
                $Array['label']= $MESES[$keyMes];
                $Array['color01']= "#FF9E01";
                $Array['color02']= "#FF6600";
                $Array['color03']= "#FF0F00";
                $X=1;
                foreach($val as $KeyVal => $valores){ 
                    $Array['ano0'.($X)]= round($valores,2);
                    $X = ($X+1);
                }
                $ComparativoAno[] = $Array; 
            }
  
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


        $MESES = array(1 => "JANEIRO", 2 => "FEVEREIRO", 3 => "MARÇO", 4 => "ABRIL", 5 => "MAIO", 6 => "JUNHO", 7 => "JULHO", 8 => "AGOSTO", 9 => "SETEMBRO", 10 => "OUTUBRO", 11 => "NOVEMBRO", 12 => "DEZEMBRO");
        for ($x = 0; $x <= 10; $x++) {
            $ANO[] = (date('Y')-$x);
        } 
        foreach($ANO as $ano){
            foreach($MESES as $cod_mes => $mes){ 
                $MES[$ano][intval($cod_mes)] =  cal_days_in_month(CAL_GREGORIAN,intval($cod_mes),$ano);
            } 
        } 

        $request['Meses'] =$MES;
        $request['ComparativoAno']=$ComparativoAno;
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
        $retorno['ComparativoAno']=$ComparativoAno;
        $retorno['graficoAnos01'] = (isset($Anos[0]) ? $Anos[0] : null);
        $retorno['graficoAnos02'] = (isset($Anos[1]) ? $Anos[1] : null);
        $retorno['graficoAnos03'] = (isset($Anos[2]) ? $Anos[2] : null);
        $retorno['comparativo'] = $Comparativo; 

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
    
    public function gerar_cor($cod) {
        $Cores = array('#FF0F00','#FF6600','#FF9E01','#FCD202','#F8FF01','#B0DE09','#04D215','#0D8ECF','#0D52D1','#2A0CD0','#8A0CCF','#CD0D74');
        if($cod<=11){
            $color=$Cores[$cod];
        } else{
            $letters = '0123456789ABCDEF';
            $color = '#';
            for ($i = 0; $i < 6; $i++) {
                $color .= $letters[rand(0, 15)];
            }
        } 
        return $color;
    }
    
}
