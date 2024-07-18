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
use Throwable;

class Safra extends Controller
{
   
    public function listar() { 
   
      
        $request['dti']=date('Y-m-d', strtotime("-20 days",strtotime(date('Y-m-d'))));
        $request['dtf']=date('Y-m-d');
        return view('colonial.producao.indicadores/safra',compact('request'));
    }
 
    public function modalJson(Request $request) { 
        try{
           
            if($request['tipo']=="MoagemTotal"){
                $validator = Validator::make($request->all(), [
                    'dti' => 'required|date',
                    'dtf' => 'required|date' 
                ],[
                    'dti.required' => 'O campo Data Inicial é obrigatorio',
                    'dtf.required' => 'O campo Data Final é obrigatorio',
                ]);
                
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()->first()], 400);
                }

                $retorno['lista'] = DB::select(" 
                select OPCH.DocEntry movimento, CardCode codigo,CardName nome,CONVERT(varchar,OPCH.DocDate, 103) data,
                replace( replace( replace(   convert(varchar, convert(money, DocTotal), 1)  ,',',' ')  ,'.',',') ,' ','.') valor,
                JrnlMemo ds_nf,
                replace( replace( replace(   convert(varchar, convert(money, PCH1.Quantity), 1)  ,',',' ')  ,'.',',') ,' ','.') qtde
                from SBO_KARAMBI_PRD.dbo.OPCH
                inner join SBO_KARAMBI_PRD.dbo.PCH1 on PCH1.DocEntry=OPCH.DocEntry
                where PCH1.ItemCode='001208'
                and CONVERT(CHAR(10),OPCH.DocDate, 23)  between '". $request['dti'] ."' and '". $request['dtf'] ."' 
                order by CONVERT(CHAR(10),OPCH.DocDate, 23)  ");     
 
                return $retorno;
            }
            
            if($request['tipo']=="MoagemDiaria"){

                $validator = Validator::make($request->all(), [
                    'dti' => 'required|date',
                    'dtf' => 'required|date' 
                ],[
                    'dti.required' => 'O campo Data Inicial é obrigatorio',
                    'dtf.required' => 'O campo Data Final é obrigatorio',
                ]);
                
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()->first()], 400);
                }

                $retorno['lista'] = DB::select("  
                select owor.docentry movimento,DueDate, CONVERT(varchar,DueDate, 103) data, jrnlMemo descricao, 
                replace( replace( replace(   convert(varchar, convert(money,ige1_bag.Quantity), 1)  ,',',' ')  ,'.',',') ,' ','.')   qtde
                from  SBO_KARAMBI_PRD.dbo.owor 
                inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
                inner join (select BaseRef,sum(Quantity) Quantity from SBO_KARAMBI_PRD.dbo.ige1 where ItemCode ='001208' group by BaseRef ) ige1_bag on ige1_bag.BaseRef=owor.DocEntry
                where Warehouse='MPP' 
                and CONVERT(CHAR(10),DueDate, 23)  between '". $request['dti'] ."' and '". $request['dtf'] ."' 
                order by DueDate ");     
 
                return $retorno;
  
            }

            if($request['tipo']=="rec_tomate"){

                $retorno['lista'] = DB::select("  
                select cd_recebimento,cd_fornecedor,nm_fornecedor, liquido , CONVERT(CHAR(10),dt_recebimento, 103) data,
				replace( cast(   liquido   as decimal(18,2)) ,'.',',') liquido,
				replace( cast(   desconto   as decimal(18,2)) ,'.',',') desconto, 
                replace( cast(   verde   as decimal(18,2)) ,'.',',') verde, 
                replace( cast(   praga   as decimal(18,2)) ,'.',',') praga, 
                replace( cast(   fungo  as decimal(18,2)) ,'.',',') fungo,
                replace( cast(   desintegrado as decimal(18,2)) ,'.',',') desintegrado, 
                replace( cast(   defeito   as decimal(18,2)) ,'.',',') defeito, 
                replace( cast(   impureza   as decimal(18,2)) ,'.',',') impureza,
                replace( cast(   terra   as decimal(18,2)) ,'.',',') terra, 
                replace( cast(   fruto   as decimal(18,2)) ,'.',',') fruto, 
                replace( cast(   brix   as decimal(18,2)) ,'.',',') brix, 
                replace( cast(   ph   as decimal(18,2)) ,'.',',') ph, 
                replace( cast(   acidez   as decimal(18,2)) ,'.',',') acidez,
                replace( cast(   ( liquido - (liquido*(fruto/100)))   as decimal(18,2)) ,'.',',') perda
                from recebimento_tomate
                where CONVERT(CHAR(10),dt_recebimento, 23) between '". $request['dti'] ."' and '". $request['dtf'] ."' 
                order by nm_fornecedor");     
 
                return $retorno;

            }

 
            return response()->json(['errors' => 'Inidicador Não Configurado'], 400);

      }catch (Throwablee $error) {
        return response()->json(['errors' => [$error->getMessage()]], 500);
      }
      
    }

    public function listarJson(Request $request) { 

      try{

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
        if(empty($request['mes'])){
            $request['dia']=null;
        }
        $MESES = array(1 => "JANEIRO", 2 => "FEVEREIRO", 3 => "MARÇO", 4 => "ABRIL", 5 => "MAIO", 6 => "JUNHO", 7 => "JULHO", 8 => "AGOSTO", 9 => "SETEMBRO", 10 => "OUTUBRO", 11 => "NOVEMBRO", 12 => "DEZEMBRO");
        $mes = $request['mes'];       
        $ano = $request['ano'];  
        $ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano));
        $request['ultimo_dia']=$ultimo_dia;

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
            $request['unidade']='T';
            $request['ds_unidade']='T';
            $request['ds_unid']=' [ T ]'; 
        }
        
        if($request['unidade']=='T'){ 
            $QtdeDadosMoagemDiaria='sum( (CONVERT(decimal(10,5), isnull(IWeight1,0)) * isnull(CmpltQty,0) )) qtde,';  
            $QtdeDadosMoagemTotal='sum( (CONVERT(decimal(10,5), isnull(IWeight1,0)) * isnull(CmpltQty,0) )) qtde';   
            $QtdeDadosMoagemConsumida='sum( (CONVERT(decimal(10,5), isnull(IWeight1,0)) * isnull(Quantity,0) )) qtde';  
            $QtdeDadosMoagemEstoque='sum( (CONVERT(decimal(10,5), isnull(IWeight1,0)) * isnull(Quantity,0) )) qtde_estoque';   
            $request['ds_unidade']='T'; 
            $request['ds_unid']=' [ T ]';
        }

        if($request['unidade']=='TB'){
            $QtdeDadosMoagemDiaria='sum(isnull(CmpltQty,0)) qtde,';  
            $QtdeDadosMoagemTotal='sum(isnull(CmpltQty,0)) qtde';  
            $QtdeDadosMoagemConsumida='sum(isnull(Quantity,0)) qtde';  
            $QtdeDadosMoagemEstoque='sum(isnull(Quantity,0)) qtde_estoque';  
            $request['ds_unidade']='Tb'; 
            $request['ds_unid']=' [ Tambor ]';
        }

        if(($request['agrupamento']=='D') || ($request['agrupamento']=='P')){
            $DATAmoagemTotal='CONVERT (varchar, owor.DueDate, 103) data,owor.DueDate dt';
            $AGRMoagemTotal='CONVERT (varchar, owor.DueDate, 103),owor.DueDate';
            $ORDmoagemTotal='owor.DueDate';

            $DATAmoagemDiaria='CONVERT (varchar, owor.DueDate, 103) data, owor.DueDate dt,';
            $AGRMoagemDiaria='CONVERT (varchar, owor.DueDate, 103),DueDate';
            $ORDmoagemDiaria='owor.DueDate';
   
        }

        if($request['agrupamento']=='M'){ 
            $DATAmoagemTotal='SUBSTRING(CONVERT (varchar, owor.DueDate, 103), 4, 7) data, SUBSTRING(CONVERT (varchar, owor.DueDate, 23), 0, 8) dt';
            $AGRMoagemTotal='SUBSTRING(CONVERT (varchar, owor.DueDate, 103), 4, 7), SUBSTRING(CONVERT (varchar, owor.DueDate, 23), 0, 8)';
            $ORDmoagemTotal='SUBSTRING(CONVERT (varchar, owor.DueDate, 23), 0, 8)';
  
            $DATAmoagemDiaria='SUBSTRING(CONVERT (varchar, owor.DueDate, 103), 4, 7) data, SUBSTRING(CONVERT (varchar, owor.DueDate, 23), 0, 8) dt,';
            $AGRMoagemDiaria='SUBSTRING(CONVERT (varchar, owor.DueDate, 103), 4, 7), SUBSTRING(CONVERT (varchar, owor.DueDate, 23), 0, 8)';
            $ORDmoagemDiaria='SUBSTRING(CONVERT (varchar, owor.DueDate, 23), 0, 8)'; 
        }
  
        /* Moagem Diaria CARD */ 
        $dadosMoagemDiariaCARD  = DB::select("  
        select  top(1) CONVERT(CHAR(10),DueDate, 103) data,DueDate,
        ige1_bag.Quantity qtde   
        from  SBO_KARAMBI_PRD.dbo.owor 
        inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
        inner join (select BaseRef,sum(Quantity) Quantity from SBO_KARAMBI_PRD.dbo.ige1 where ItemCode ='001208' group by BaseRef ) ige1_bag on ige1_bag.BaseRef=owor.DocEntry
        where Warehouse='MPP' 
        and CONVERT(CHAR(10),DueDate, 23)  between '".$request['dti']."' and '".$request['dtf']."' 
        order by DueDate desc
        ");
        $MoagemDiariaTo= (isset($dadosMoagemDiariaCARD[0]->qtde)) ? $dadosMoagemDiariaCARD[0]->qtde : 0; 
        $MoagemDiariaData= (isset($dadosMoagemDiariaCARD[0]->data)) ? $dadosMoagemDiariaCARD[0]->data : '--';
 
        
        /* Moagem Diaria GRAFICO */ 
        $dadosMoagemGrafico = DB::select("  
        select 
        ".$DATAmoagemDiaria."
        sum(ige1_bag.Quantity) qtde   
        from  SBO_KARAMBI_PRD.dbo.owor 
        inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
        inner join (select BaseRef,sum(Quantity) Quantity from SBO_KARAMBI_PRD.dbo.ige1 where ItemCode ='001208' group by BaseRef ) ige1_bag on ige1_bag.BaseRef=owor.DocEntry
        where Warehouse='MPP' 
        and CONVERT(CHAR(10),DueDate, 23)  between '".$request['dti']."' and '".$request['dtf']."'
        group by ".$AGRMoagemDiaria."
        order by ".$ORDmoagemDiaria."
        ");
        $MoagemDiaria=null;   $MoagemTotalTo=0;
        foreach($dadosMoagemGrafico as  $val){ 
            $MoagemTotalTo=($MoagemTotalTo+$val->qtde);
            $MoagemDiaria[]=array( 
                "label"=>$val->data,
                "producao"=>$val->qtde,    
                'dt'=>$val->dt,
                'tipo'=>'MoagemDiaria',
                'dti'=>$request['dti'],
                'dtf'=>$request['dtf'],
                'agrupamento'=>$request['agrupamento'], 
                "color_producao"=> "#ef4836"
            ); 

        }
        
        /* Estoque de Polpa Total [CARD] */
        $dadosMoagemTotal = DB::select(" 
        select top(1) 
        sum(CmpltQty) quant_producao,
        sum( (CONVERT(decimal(10,5), isnull(IWeight1,0)) * isnull(CmpltQty,0) )) kg,
        sum(isnull(CmpltQty,0)) tb,
        sum(Quantity) quant_estoque,
        sum( (CONVERT(decimal(10,5), isnull(IWeight1,0)) * isnull(Quantity,0) )) kg_estoque, 
        sum(isnull(Quantity,0)) tb_estoque
        from  SBO_KARAMBI_PRD.dbo.owor 
        inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
        left join (select BaseRef,sum(Quantity) Quantity from SBO_KARAMBI_PRD.dbo.ige1 where ItemCode ='002463' group by BaseRef ) ige1_bag on ige1_bag.BaseRef=owor.DocEntry
        where Warehouse='MPP' and owor.ItemCode <> '001208'
        and CONVERT(CHAR(10),DueDate, 23) between '".$request['dti']."' and '".$request['dtf']."' "); 
        $PolpaEstoqueTb= (isset($dadosMoagemTotal[0]->tb_estoque)) ? $dadosMoagemTotal[0]->tb_estoque : 0;
        $PolpaEstoqueKg= (isset($dadosMoagemTotal[0]->kg_estoque)) ? ($dadosMoagemTotal[0]->kg_estoque/1000) : 0;
  
        /* Polpa Diaria  [CARD] */
        $dadosMoagemDiaria = DB::select("  
        select top(1)  CONVERT(CHAR(10),DueDate, 23)  , CONVERT (varchar, DueDate, 103) data,
	    sum(CmpltQty) quant_producao,
        sum( (CONVERT(decimal(10,5), isnull(IWeight1,0)) * isnull(CmpltQty,0) )) kg,
        sum(isnull(CmpltQty,0)) tb,
        sum(Quantity) quant_estoque,
        sum( (CONVERT(decimal(10,5), isnull(IWeight1,0)) * isnull(Quantity,0) )) kg_estoque, 
        sum(isnull(Quantity,0)) tb_estoque
        from  SBO_KARAMBI_PRD.dbo.owor 
        inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
        left join (select BaseRef,sum(Quantity) Quantity from SBO_KARAMBI_PRD.dbo.ige1 where ItemCode ='002463' group by BaseRef ) ige1_bag on ige1_bag.BaseRef=owor.DocEntry
        where Warehouse='MPP' and owor.ItemCode <> '001208'
        and CONVERT(CHAR(10),DueDate, 23) between '".$request['dti']."' and '".$request['dtf']."'
		group by CONVERT(CHAR(10),DueDate, 23),CONVERT (varchar, DueDate, 103)
		order by 1 desc "); 
        $MoagemEstDiariaTb= (isset($dadosMoagemDiaria[0]->tb_estoque)) ? $dadosMoagemDiaria[0]->tb_estoque : 0;
        $MoagemEstDiariaKg= (isset($dadosMoagemDiaria[0]->kg_estoque)) ? ($dadosMoagemDiaria[0]->kg_estoque/1000) : 0;
        $Datadiaria = (isset($dadosMoagemDiaria[0]->data)) ? $dadosMoagemDiaria[0]->data : ' -- ';
 
        /* Moagem Total [GRAFICO] */
        $retorno['moagem_total'] = DB::select(" 
        select 
        sum(CmpltQty) quant_producao,
        sum( (CONVERT(decimal(10,5), isnull(IWeight1,0)) * isnull(CmpltQty,0) )) kg,
        sum(isnull(CmpltQty,0)) tb, 
        sum(Quantity) quant_estoque,
        sum( (CONVERT(decimal(10,5), isnull(IWeight1,0)) * isnull(Quantity,0) )) kg_estoque, 
        sum(isnull(Quantity,0)) tb_estoque,
        ". $QtdeDadosMoagemTotal .",
        ". $QtdeDadosMoagemEstoque .",
        ". $DATAmoagemTotal ."
        from  SBO_KARAMBI_PRD.dbo.owor 
        inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
        left join (select BaseRef,sum(Quantity) Quantity from SBO_KARAMBI_PRD.dbo.ige1 where ItemCode ='002463' group by BaseRef ) ige1_bag on ige1_bag.BaseRef=owor.DocEntry
        where Warehouse='MPP' 
        and owor.ItemCode <> '001208'
        and CONVERT(CHAR(10),DueDate, 23)  between '".$request['dti']."' and '".$request['dtf']."'
        group by ". $AGRMoagemTotal . "
        order by ". $ORDmoagemTotal ." ");
        $MoagemTotal=null; $Key=0;
        $MoagemConsumida=null;
        $MoagemTotal=null;
        $MoagemEstoque=null;
        foreach($retorno['moagem_total'] as $KeyId => $val){
    
            $QtdeTotal=($val->qtde) ? $val->qtde : 0;
            $QtdeEstoque=($val->qtde) ? $val->qtde_estoque : 0;
            $QTdeConsumida=($QtdeTotal-$QtdeEstoque);

            $kg_estoque= ($val->kg_estoque) ? $val->kg_estoque : 0;
            $kg = ($val->kg) ? $val->kg : 0;
            $tb_estoque = ($val->tb_estoque) ? $val->tb_estoque : 0;
            $tb = ($val->tb) ? $val->tb : 0;
            $kgConsumida = ($kg-$kg_estoque);
            $TbConsumida = ($tb-$tb_estoque);

            $MoagemTotal[]=array( 
                "label"=>$val->data,
                "producao"=>$val->qtde,  
                'kg'=>$val->kg,
                'tb'=>$val->tb,
                'dt'=>$val->dt,
                'tipo'=>'MoagemTotal',
                'dti'=>$request['dti'],
                'dtf'=>$request['dtf'],
                'agrupamento'=>$request['agrupamento'], 
                "color_producao"=> "#2563d5"
            ); 

            $MoagemConsumida[]=array( 
                "label"=>$val->data,
                "producao"=>$QTdeConsumida,  
                'kg'=>$kgConsumida,
                'tb'=>$TbConsumida,
                'dt'=>$val->dt,
                'tipo'=>'MoagemConsumida',
                'dti'=>$request['dti'],
                'dtf'=>$request['dtf'],
                'agrupamento'=>$request['agrupamento'], 
                "color_producao"=> "#ff7519"
            );

            $MoagemEstoque[]=array( 
                "label"=>$val->data,
                "producao"=>$QtdeEstoque,   
                'kg'=>$val->kg_estoque,
                'tb'=>$val->tb_estoque,
                'dt'=>$val->dt,
                'tipo'=>'MoagemEstoque',
                'dti'=>$request['dti'],
                'dtf'=>$request['dtf'],
                'agrupamento'=>$request['agrupamento'], 
                "color_producao"=> "#339933"
            ); 

            $Key = $KeyId;
        }

     
 
        /* Brix */
        $dadosBrix = DB::select(" 
        select top(1) sum(brix) total, count(*), (sum(brix)/count(*)) qtde
        from recebimento_tomate
        where CONVERT(CHAR(10),dt_recebimento, 23)  between '".$request['dti']."' and '".$request['dtf']."' ");
        $Brix= (isset($dadosBrix[0]->qtde)) ? $dadosBrix[0]->qtde : 0;


        /* Perdas */
        $dadosPerdas = DB::select(" 
        select  sum(total) liquido, sum((residuo+terra+sujeira+verde)) total_perda,
		(sum(total) - sum((residuo+terra+sujeira+verde)) ) total,
		( ( sum((residuo+terra+sujeira+verde)) / sum(total) ) * 100 ) total_perc
        from classificacao_tomate 
        where CONVERT(CHAR(10),dt_recebimento, 23)  between '".$request['dti']."' and '".$request['dtf']."' ");
        $PerdasTotal= (isset($dadosPerdas[0]->total_perda)) ? $dadosPerdas[0]->total_perda : 0;
        $PerdasTotalPerc= (isset($dadosPerdas[0]->total_perc)) ? $dadosPerdas[0]->total_perc : 0;
       
        /* Fornecedor */ 
        $retorno['fornecedor'] = DB::select(" 
        select OPCH.CardCode,OPCH.CardName nome,sum(Quantity) total
        from SBO_KARAMBI_PRD.dbo.OPCH
        inner join SBO_KARAMBI_PRD.dbo.PCH1 on PCH1.DocEntry=OPCH.DocEntry
        where PCH1.ItemCode='001208'
        and OPCH.DocStatus = 'O'
        and CONVERT(CHAR(10),OPCH.DocDate, 23) between '".$request['dti']."' and '".$request['dtf']."'
        group by OPCH.CardCode,OPCH.CardName
        order by sum(Quantity) desc ");
        $Fornecedores=null;
        foreach($retorno['fornecedor'] as $key => $val){
            $Fornecedores[]=array(
                "produto"=>$val->nome,
                "qtde"=>$val->total,
                "color"=> ($val->total>0) ? $this->gerar_cor($key) : "#FAFAFA"
            );
        }
       
       
        /* table Fornecedor */
        $retorno['table_fornecedor'] = DB::select("
        select cd_fornecedor,nm_fornecedor,count(*) qtde,  sum(liquido) liquido,
        convert(varchar, convert(money, sum(liquido) ) , 1  ) as total,  
        convert(varchar, convert(money,  sum(desconto) ) , 1  ) desconto,
        replace( cast( (sum(verde)/count(*)) as decimal(18,2)) ,'.',',') verde, 
        replace( cast( (sum(praga)/count(*)) as decimal(18,2)) ,'.',',') praga, 
        replace( cast( (sum(fungo)/count(*)) as decimal(18,2)) ,'.',',') fungo,
        replace( cast( (sum(desintegrado)/count(*)) as decimal(18,2)) ,'.',',') desintegrado, 
        replace( cast( (sum(defeito)/count(*)) as decimal(18,2)) ,'.',',') defeito, 
        replace( cast( (sum(impureza)/count(*)) as decimal(18,2)) ,'.',',') impureza,
        replace( cast( (sum(terra)/count(*)) as decimal(18,2)) ,'.',',') terra, 
        replace( cast( (sum(fruto)/count(*)) as decimal(18,2)) ,'.',',') fruto, 
        replace( cast( (sum(brix)/count(*)) as decimal(18,2)) ,'.',',') brix, 
        replace( cast( (sum(ph)/count(*)) as decimal(18,2)) ,'.',',') ph, 
        replace( cast( (sum(acidez)/count(*)) as decimal(18,2)) ,'.',',') acidez
        from recebimento_tomate
        where CONVERT(CHAR(10),dt_recebimento, 23) between '".$request['dti']."' and '".$request['dtf']."'
        group by cd_fornecedor,nm_fornecedor
        order by nm_fornecedor
        ");
    
        
        /* controle de qualidade */
        $retorno['qualidade'] = DB::select("
        select (sum(liquido)/count(*)) as total,  
        (sum(desconto)/count(*)) desconto,
        (sum(verde)/count(*)) verde,   
        (sum(praga)/count(*)) praga, 
        (sum(fungo)/count(*)) fungo,
        (sum(desintegrado)/count(*)) desintegrado, 
        (sum(defeito)/count(*)) defeito, 
        (sum(impureza)/count(*)) impureza,
        (sum(terra)/count(*)) terra, 
        (sum(fruto)/count(*)) fruto, 
        (sum(brix)/count(*)) brix, 
        (sum(ph)/count(*)) ph, 
        (sum(acidez)/count(*)) acidez
        from recebimento_tomate
        where CONVERT(CHAR(10),dt_recebimento, 23) between '".$request['dti']."' and '".$request['dtf']."' ");
        $Qualidade=null;
        foreach($retorno['qualidade'] as $key => $val){
            $Qualidade[]=array( "produto"=>'Verdes', "qtde"=>round($val->verde,2), "color"=> "#2c8b57");
            $Qualidade[]=array( "produto"=>'Pragas Lesões', "qtde"=>round($val->praga,2), "color"=> "#808080");
            $Qualidade[]=array( "produto"=>'Fungos, Podres', "qtde"=>round($val->fungo,2), "color"=> "#41e0cf");
            $Qualidade[]=array( "produto"=>'Desintegrados', "qtde"=>round($val->desintegrado,2), "color"=> "#d3691d");
            $Qualidade[]=array( "produto"=>'Impurezas', "qtde"=>round($val->impureza,2), "color"=>"#7f8000");
            $Qualidade[]=array( "produto"=>'Terra', "qtde"=>round($val->terra,2), "color"=>"#a52a2b"); 
            $Qualidade[]=array( "produto"=>'Defeitos Gerais', "qtde"=>round($val->defeito,2), "color"=> "#f08180"); 
            $Qualidade[]=array( "produto"=>'Brix', "qtde"=>round($val->brix,2), "color"=> "#ff4400");
            $Qualidade[]=array( "produto"=>'PH', "qtde"=>round($val->ph,2), "color"=>"#00018b");
            $Qualidade[]=array( "produto"=>'Acidez', "qtde"=>round($val->acidez,2), "color"=>"#48d1cc");
        }

        /* controle de qualidade Produção */
        $retorno['qualidade'] = DB::select("
        select (sum(residuo)/count(*)) as residuo,  
        (sum(terra)/count(*)) terra,
        (sum(sujeira)/count(*)) sujeira, 
        (sum(verde)/count(*)) verde 
        from classificacao_tomate
        where CONVERT(CHAR(10),dt_recebimento, 23) between '".$request['dti']."' and '".$request['dtf']."' ");
        $QualidadeProd=null;
        foreach($retorno['qualidade'] as $key => $val){
            $QualidadeProd[]=array( "produto"=>'Resíduos', "qtde"=>round($val->residuo,2), "color"=>"#ff7e4f");
            $QualidadeProd[]=array( "produto"=>'Terra', "qtde"=>round($val->terra,2), "color"=> "#a52a2b");
            $QualidadeProd[]=array( "produto"=>'Sujeira', "qtde"=>round($val->sujeira,2), "color"=> "#7f8000");
            $QualidadeProd[]=array( "produto"=>'Verdes', "qtde"=>round($val->verde,2), "color"=> "#018001"); 
        }


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



        $request['MoagemDiariaTo'] =  ($MoagemDiariaTo) ?  number_format($MoagemDiariaTo,2,",",".") : '000';
        $request['MoagemDiariaData'] =  '[ '. $MoagemDiariaData .' ] '; 
        $request['MoagemEstDiariaTb'] =  ($MoagemEstDiariaTb) ?  number_format($MoagemEstDiariaTb,0,",",".") : '000';
        $request['MoagemEstDiariaKg'] = ($MoagemEstDiariaKg) ?  number_format($MoagemEstDiariaKg,0,",",".") : '000';
        $request['Datadiaria'] = ' [ '. $Datadiaria .' ] '; 
        $request['MoagemTotalTo'] = ($MoagemTotalTo) ?  number_format($MoagemTotalTo,2,",",".") : '000';  
        $request['PolpaEstoqueTb'] = number_format( $PolpaEstoqueTb ,0,",",".");
        $request['PolpaEstoqueKg'] = number_format( $PolpaEstoqueKg ,0,",",".");
        $request['Brix'] =  ($Brix) ?  number_format($Brix,2,",",".") : '0,00';
        $request['PerdasTotal'] = ($PerdasTotal) ?  number_format($PerdasTotal,0,",",".") : '000';
        $request['PerdasTotalPerc'] = ($PerdasTotalPerc) ?  number_format($PerdasTotalPerc,2,",",".") : '0,00'; 
        $retorno['MoagemDiaria'] = $MoagemDiaria;
        $retorno['MoagemTotal'] = $MoagemTotal;
        $retorno['MoagemConsumida'] = $MoagemConsumida;
        $retorno['MoagemEstoque'] = $MoagemEstoque;
        $retorno['Fornecedores'] = $Fornecedores;
        $retorno['Qualidade'] = $Qualidade;
        $retorno['QualidadeProd'] = $QualidadeProd;

        $retorno['request'] = $request->toArray();
        return $retorno;

      }catch (Throwablee $error) {
        return response()->json(['errors' => [$error->getMessage()]], 500);
      }
      
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
                select ItemName nome, sum(valor) planejado_cx, sum(valor*kg)  planejado_kg,sum(tempo), tempo,
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
                ) xx 
                left join producao_parada on producao_parada.cd_ordem = xx.codigo
                group by ItemName  order by ItemName
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
                select data,duedate, sum(valor) planejado_cx, sum(valor*kg)  planejado_kg,sum(tempo), tempo,
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
                ) xx 
                left join producao_parada on producao_parada.cd_ordem = xx.codigo
                group by data,duedate  order by duedate
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
            ) valor_prod, owor.ItemCode ,SWeight1 kg, oitm.ItemName, tempo
            from (select * from  SBO_KARAMBI_PRD.dbo.owor where Uom='CX' ) owor 
            inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
            left join ( select sum(tempo) tempo, cd_ordem from producao_parada group by cd_ordem ) producao_parada on producao_parada.cd_ordem = owor.DocEntry
            where CONVERT (varchar, owor.duedate, 103) like '%".$request['date']."%'
            and oitm.ItmsGrpCod not in (103)
            order by owor.duedate
            ");
            $request['relacao'] = $relacao;
 
        }
         
        return $request;
    }
    
    public function xls(Request $request,$tipo) {

        if($tipo=='D'){
            $DADOS = DB::select(" 
                select owor.docentry movimento,DueDate, CONVERT(varchar,DueDate, 103) data, jrnlMemo descricao, 
                replace( replace( replace(   convert(varchar, convert(money,ige1_bag.Quantity), 1)  ,',',' ')  ,'.',',') ,' ','.')   qtde
                from  SBO_KARAMBI_PRD.dbo.owor 
                inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
                inner join (select BaseRef,sum(Quantity) Quantity from SBO_KARAMBI_PRD.dbo.ige1 where ItemCode ='001208' group by BaseRef ) ige1_bag on ige1_bag.BaseRef=owor.DocEntry
                where Warehouse='MPP' 
                and CONVERT(CHAR(10),DueDate, 23)  between '". $request['dti'] ."' and '". $request['dtf'] ."' 
                order by DueDate  
            ");
           // dd($DADOS);
            return view('colonial.producao.indicadores/xls_safra_diario',compact('request','DADOS'));
        }

        if($tipo=='T'){
            $DADOS = DB::select("
            select 
            owor.docentry movimento,
            CONVERT(CHAR(10),DueDate, 103) data,
            jrnlMemo descricao, 
            CmpltQty quant_producao,
            (CONVERT(decimal(10,5), isnull(IWeight1,0)) * isnull(CmpltQty,0) )  kg,
            isnull(CmpltQty,0) tb, 
            Quantity quant_estoque,
            (CONVERT(decimal(10,5), isnull(IWeight1,0)) * isnull(Quantity,0) ) kg_estoque, 
            isnull(Quantity,0) tb_estoque 
            from  SBO_KARAMBI_PRD.dbo.owor 
            inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
            left join (select BaseRef,sum(Quantity) Quantity from SBO_KARAMBI_PRD.dbo.ige1 where ItemCode ='002463' group by BaseRef ) ige1_bag on ige1_bag.BaseRef=owor.DocEntry
            where Warehouse='MPP' 
            and owor.ItemCode <> '001208'
            and CONVERT(CHAR(10),DueDate, 23)  between '".$request['dti']."' and '".$request['dtf']."' 
            order by DueDate
            ");
            return view('colonial.producao.indicadores/xls_safra_total',compact('request','DADOS'));
        }

        if($tipo=='E'){
            $DADOS = DB::select("
            select *
            from energias 
            where CONVERT(CHAR(10),dt_consumo, 23)  between '".$request['dti']."' and '".$request['dtf']."'
            order by dt_consumo
            ");
            return view('colonial.producao.indicadores/xls_energia',compact('request','DADOS'));
        }

        if($tipo=='L'){
            $DADOS = DB::select("
            select DocEntry codigo,ItemCode cod,Dscription descricao,Quantity qtde,DocDate data
            from SBO_KARAMBI_PRD.dbo.IGE1 where WhsCode='MPV' 
            and CONVERT(varchar, DocDate, 23) between '".$request['dti']."' and '".$request['dtf']."'
            order by DocDate
            ");
            return view('colonial.producao.indicadores/xls_lenha_polpa',compact('request','DADOS'));
        }

        if($tipo=='O'){
            $DADOS = DB::select("
            select DocEntry codigo,ItemCode cod,Dscription descricao,Quantity qtde,DocDate data
            from SBO_KARAMBI_PRD.dbo.IGE1 where ItemCode='013906'
            and CONVERT(varchar, DocDate, 23) between '".$request['dti']."' and '".$request['dtf']."'
            order by DocDate
            ");
            return view('colonial.producao.indicadores/xls_lenha_polpa',compact('request','DADOS'));
        }
        if($tipo=='P'){
            $DADOS = DB::select("
            select cd_producao_parada codigo,cd_ordem,nm_tipo,tempo,obs_parada,dt_ordem
            from producao_parada 
            inner join  producao_tipo on producao_tipo.cd_tipo=producao_parada.cd_parada
            where CONVERT(CHAR(10),producao_parada.dt_ordem, 23)  between '".$request['dti']."' and '".$request['dtf']."'
            order by 1 
            ");
            return view('colonial.producao.indicadores/xls_parada',compact('request','DADOS'));
        }
        if($tipo=='D'){
            $DADOS = DB::select("
            select cd_perda codigo,cd_ordem,cd_produto,nm_produto,qtde,dt_ordem,obs_perda,nm_tipo
            from perda 
            inner join  perda_tipo on perda_tipo.cd_tipo=perda.cd_tipo_perda
            where CONVERT(CHAR(10),perda.dt_ordem, 23)  between '".$request['dti']."' and '".$request['dtf']."' 
            order by 1 
            ");
            return view('colonial.producao.indicadores/xls_perda',compact('request','DADOS'));
        }
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
