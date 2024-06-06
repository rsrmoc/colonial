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
             
            if($request['indicador']=='perdaE_cards'){

                $validator = Validator::make($request->all(), [
                    'ano' => 'required|integer' 
                ],[
                    'ano.required' => 'O campo Ano é obrigatorio' 
                ]);
                
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()->first()], 400);
                }

                $data=$request['ano'];
                if($request['mes']){
                    $data=$data.'-'.$request['mes'];
                    if($request['dia']){
                        $data=$data.'-'.$request['dia'];
                    }
                }

                $retorno['lista'] = DB::select(" 
                select CONVERT(CHAR(10),perda.dt_ordem, 103) data, nm_produto, nm_tipo,InvntryUom unidade,  Convert(decimal(12, 0), round(sum(qtde), 2, 1))  qtde
                from perda 
                inner join  perda_tipo on perda_tipo.cd_tipo =perda.cd_tipo_perda 
                inner join SBO_KARAMBI_PRD.dbo.OITM on  convert(varchar, OITM.ItemCode,103) =   perda.cd_produto  COLLATE Latin1_General_CI_AS
                where  CONVERT(CHAR(10),perda.dt_ordem, 23) like '%$data%' and grupo = '105'
                group by CONVERT(CHAR(10),perda.dt_ordem, 103),
                CONVERT(CHAR(10),perda.dt_ordem, 23), CONVERT(CHAR(10),perda.dt_ordem, 103),nm_produto, nm_tipo,InvntryUom
                order by 1 ");     
 
                return $retorno;
  
            }

            if($request['indicador']=='perdaP_cards'){

                $validator = Validator::make($request->all(), [
                    'ano' => 'required|integer' 
                ],[
                    'ano.required' => 'O campo Ano é obrigatorio' 
                ]);
                
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()->first()], 400);
                }

                $data=$request['ano'];
                if($request['mes']){
                    $data=$data.'-'.$request['mes'];
                    if($request['dia']){
                        $data=$data.'-'.$request['dia'];
                    }
                }

                $retorno['lista'] = DB::select(" 
                select CONVERT(CHAR(10),perda.dt_ordem, 103) data, nm_produto, nm_tipo,InvntryUom unidade, Convert(decimal(12, 0), round(sum(qtde), 2, 1))  qtde 
                
                from perda 
                inner join  perda_tipo on perda_tipo.cd_tipo =perda.cd_tipo_perda 
                left join SBO_KARAMBI_PRD.dbo.OITM on  convert(varchar, OITM.ItemCode,103) =   perda.cd_produto  COLLATE Latin1_General_CI_AS
                where  CONVERT(CHAR(10),perda.dt_ordem, 23) like '%$data%' and grupo = '103'
                group by CONVERT(CHAR(10),perda.dt_ordem, 103),
                CONVERT(CHAR(10),perda.dt_ordem, 23), CONVERT(CHAR(10),perda.dt_ordem, 103),nm_produto, nm_tipo,InvntryUom
                order by 1 ");     
 
                return $retorno;
  
            }

            if($request['indicador']=='perdaI_cards'){

                $validator = Validator::make($request->all(), [
                    'ano' => 'required|integer' 
                ],[
                    'ano.required' => 'O campo Ano é obrigatorio' 
                ]);
                
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()->first()], 400);
                }

                $data=$request['ano'];
                if($request['mes']){
                    $data=$data.'-'.$request['mes'];
                    if($request['dia']){
                        $data=$data.'-'.$request['dia'];
                    }
                }

                $retorno['lista'] = DB::select(" 
                select CONVERT(CHAR(10),perda.dt_ordem, 103) data, nm_produto, nm_tipo,InvntryUom unidade, Convert(decimal(12, 0), round(sum(qtde), 2, 1))  qtde
                from perda 
                inner join  perda_tipo on perda_tipo.cd_tipo =perda.cd_tipo_perda 
                left join SBO_KARAMBI_PRD.dbo.OITM on  convert(varchar, OITM.ItemCode,103) =   perda.cd_produto  COLLATE Latin1_General_CI_AS
                where  CONVERT(CHAR(10),perda.dt_ordem, 23) like '%$data%' and grupo = '109'
                group by CONVERT(CHAR(10),perda.dt_ordem, 103),
                CONVERT(CHAR(10),perda.dt_ordem, 23), CONVERT(CHAR(10),perda.dt_ordem, 103),nm_produto, nm_tipo,InvntryUom
                order by 1 ");     
 
                return $retorno;
  
            }

            if($request['indicador']=='parada_cards'){

                $validator = Validator::make($request->all(), [
                    'ano' => 'required|integer' 
                ],[
                    'ano.required' => 'O campo Ano é obrigatorio' 
                ]);
                
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()->first()], 400);
                }

                $data=$request['ano'];
                if($request['mes']){
                    $data=$data.'-'.$request['mes'];
                    if($request['dia']){
                        $data=$data.'-'.$request['dia'];
                    }
                }

                $retorno['lista'] = DB::select(" 
                select CONVERT(CHAR(10),producao_parada.dt_ordem, 103) data, nm_tipo,
                Convert(decimal(12, 0), round(sum(tempo), 2, 1)) qtde
                from producao_parada 
                inner join  producao_tipo on producao_tipo.cd_tipo=producao_parada.cd_parada
                where  CONVERT(CHAR(10),producao_parada.dt_ordem, 23) like '%$data%'
                group by CONVERT(CHAR(10),producao_parada.dt_ordem, 103), nm_tipo
                order by 1");     
 
                return $retorno;
  
            }

            if($request['indicador']=='lenha_cards'){

                $validator = Validator::make($request->all(), [
                    'ano' => 'required|integer' 
                ],[
                    'ano.required' => 'O campo Ano é obrigatorio' 
                ]);
                
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()->first()], 400);
                }

                $data=$request['ano'];
                if($request['mes']){
                    $data=$data.'-'.$request['mes'];
                    if($request['dia']){
                        $data=$data.'-'.$request['dia'];
                    }
                }

                $retorno['lista'] = Estoque::whereRaw("CONVERT(CHAR(10),DocDate, 23) like '%$data%' ")
                ->whereRaw("WhsCode='MPV'")
                ->selectRaw("cONVERT(CHAR(10),DocDate, 103) data,  Convert(decimal(12, 0), round(sum(Quantity), 2, 1)) qtde")->groupByRaw("cONVERT(CHAR(10),DocDate, 103)")
                ->orderByRaw("1 ")
                ->get();    
 
                return $retorno;
  
            }

            if($request['indicador']=='energia_cards'){

                $validator = Validator::make($request->all(), [
                    'ano' => 'required|integer' 
                ],[
                    'ano.required' => 'O campo Ano é obrigatorio' 
                ]);
                
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()->first()], 400);
                }

                $data=$request['ano'];
                if($request['mes']){
                    $data=$data.'-'.$request['mes'];
                    if($request['dia']){
                        $data=$data.'-'.$request['dia'];
                    }
                }

                $retorno['lista'] = DB::select(" 
                select  cONVERT(CHAR(10),dt_consumo, 103) data, Convert(decimal(12, 0), round(sum(qtde), 2, 1))  qtde
                from energias 
                where CONVERT(CHAR(10),dt_consumo, 23) like '%$data%'
                group by cONVERT(CHAR(10),dt_consumo, 103)
                order by 1 ");   
 
                return $retorno;
  
            }

            if($request['indicador']=='agua_cards'){

                $validator = Validator::make($request->all(), [
                    'ano' => 'required|integer' 
                ],[
                    'ano.required' => 'O campo Ano é obrigatorio' 
                ]);
                
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()->first()], 400);
                }

                $data=$request['ano'];
                if($request['mes']){
                    $data=$data.'-'.$request['mes'];
                    if($request['dia']){
                        $data=$data.'-'.$request['dia'];
                    }
                }

                $retorno['lista'] = DB::select("  
                select cONVERT(CHAR(10),dt_consumo, 103) data , Convert(decimal(12, 0), round(sum(saldo), 2, 1)) qtde
                from hidricos 
                where CONVERT(CHAR(10),dt_consumo, 23) like '%$data%'  
                group by cONVERT(CHAR(10),dt_consumo, 103)
                order by 1 ");   
 
                return $retorno;
  
            }

            if($request['indicador']=='polpa_cards'){

                $validator = Validator::make($request->all(), [
                    'ano' => 'required|integer' 
                ],[
                    'ano.required' => 'O campo Ano é obrigatorio' 
                ]);
                
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()->first()], 400);
                }

                $data=$request['ano'];
                if($request['mes']){
                    $data=$data.'-'.$request['mes'];
                    if($request['dia']){
                        $data=$data.'-'.$request['dia'];
                    }
                }

                $retorno['lista'] = Estoque::whereRaw("CONVERT(CHAR(10),DocDate, 23) like '%$data%'  ")
                ->whereRaw("ItemCode='013906'")
                ->selectRaw("CONVERT(CHAR(10),DocDate, 103) data,
                convert(decimal(12, 0), round(sum(Quantity), 2, 1)) qtde, 
                convert(decimal(12, 0), round(sum(Quantity)/210, 2, 1)) qtde_tb")
                ->groupByRaw("CONVERT(CHAR(10),DocDate, 103)")
                ->orderByRaw("1 ") 
                ->get();  
 
                return $retorno;
  
            }

            if($request['indicador']=='producao_cards'){

                $validator = Validator::make($request->all(), [
                    'ano' => 'required|integer' 
                ],[
                    'ano.required' => 'O campo Ano é obrigatorio' 
                ]);
                
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()->first()], 400);
                }

                $data=$request['ano'];
                if($request['mes']){
                    $data=$data.'-'.$request['mes'];
                    if($request['dia']){
                        $data=$data.'-'.$request['dia'];
                    }
                }

                $retorno['lista'] = DB::select(" 
                select ItemCode codigo,nome, 
                convert(decimal(12, 0), round(sum(valor_prod), 2, 1)) prod_cx,
                convert(decimal(12, 0), round(sum(valor_prod*kg), 2, 1)) prod_kg,
                convert(decimal(12, 0), round(sum((valor_prod*kg)/1000), 2, 1)) prod_to,
                convert(decimal(12, 0), round(sum(valor), 2, 1)) pla_cx,
                convert(decimal(12, 0), round(sum(valor*kg), 2, 1)) pla_kg,
                convert(decimal(12, 0), round(sum((valor*kg)/1000) , 2, 1)) pla_to 
                from (	
                    select ProdName nome,  owor.plannedqty valor,
                    (select sum(quantity) from SBO_KARAMBI_PRD.dbo.ign1 
                        where ign1.BaseRef=owor.DocEntry
                    ) valor_prod, owor.ItemCode , 
                    case 
                    when CONVERT(CHAR(10),owor.duedate, 23) <= '2024-03-18' and owor.ItemCode = '006283' then CONVERT(decimal(10,5), 7.2)
                    when CONVERT(CHAR(10),owor.duedate, 23)<= '2024-03-19' and owor.ItemCode = '006277' then CONVERT(decimal(10,5), 7.2)
                    when CONVERT(CHAR(10),owor.duedate, 23) <= '2024-03-22' and owor.ItemCode = '006280' then CONVERT(decimal(10,5), 7.2)
                    when CONVERT(CHAR(10),owor.duedate, 23) <= '2024-03-25' and owor.ItemCode = '006274' then CONVERT(decimal(10,5), 7.2)
                    else  CONVERT(decimal(10,5), IWeight1)  end  kg  
                                    
                    from (select * from  SBO_KARAMBI_PRD.dbo.owor where Uom='CX' ) owor 
                    inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
                    where CONVERT(CHAR(10),owor.duedate, 23) like '%$data%' 
                    and oitm.ItmsGrpCod not in (103) 
                ) query_principal
                group by ItemCode,nome
                order by 2  
                ");

                
                return $retorno;

            }

            if($request['indicador']=='producao'){

                $hidrico = Hidrico::whereRaw("CONVERT(varchar, dt_consumo, 103) like '%".$request['label']."%' ")
                ->selectRaw("sum(saldo) valor")->first();
                
                $energia = Energia::whereRaw("CONVERT(varchar, dt_consumo, 103) like '%".$request['label']."%' ")
                ->selectRaw("sum(qtde) valor")->first();
        
                $lenha = Estoque::whereRaw("CONVERT(varchar, DocDate, 103) like '%".$request['label']."%' ")
                ->whereRaw("WhsCode='MPV'")->selectRaw("sum(Quantity) valor")->first();
        
                $perda = Perda::whereRaw("CONVERT(varchar, dt_ordem, 103)  like '%".$request['label']."%' ")
                ->selectRaw("count(qtde) valor")->first();
        
        
                $parada = Parada::whereRaw("CONVERT(varchar, dt_ordem, 103) like '%".$request['label']."%' ")
                ->selectRaw("sum(tempo) valor")->first();
            
                $polpa = Estoque::whereRaw("CONVERT(varchar, DocDate, 103) like '%".$request['label']."%' ")
                ->whereRaw("ItemCode='013906'")->selectRaw("sum(Quantity) valor")->first();

                $retorno['data'] = $request['label'];
                $retorno['hidrico'] = ($hidrico->valor) ?  number_format(($hidrico->valor),2,",",".") : '0,00';
                $retorno['energia'] = ($energia->valor) ?  number_format($energia->valor,2,",",".") : '0,00';
                $retorno['lenha'] = ($lenha->valor) ?  number_format($lenha->valor,2,",",".") : '0,00';
                $retorno['perda'] = ($perda->valor) ?  number_format($perda->valor,0,",",".") : '00';
                $retorno['parada'] = ($parada->valor) ?  number_format($parada->valor,0,",",".") : '00';
                $retorno['polpa'] = ($polpa->valor) ?  number_format($polpa->valor,0,",",".") : '00';
                $retorno['produzido_cx'] = ($request['produzido_cx']) ?  number_format($request['produzido_cx'],0,",",".") : '00';
                $retorno['produzido_kg'] = ($request['produzido_kg']) ?  number_format($request['produzido_kg'],0,",",".") : '00';
                $retorno['produzido_to'] = ($request['produzido_to']) ?  number_format($request['produzido_to'],0,",",".") : '00';
    
                if($request['agrupamento']=='P'){
                    $ParametroProducao="where CONVERT(CHAR(10),owor.duedate, 23) like '%".$request['dti']."%' and upper(ProdName) = upper('".$request['label']."') ";
                    $ParametroParada="where CONVERT(CHAR(10),producao_parada.dt_ordem, 23) like '%".$request['dti']."%'";
                    $ParametroPerda="where CONVERT(CHAR(10),perda.dt_ordem, 23) like '%".$request['dti']."%' ";
                }else{
                    $ParametroProducao="where CONVERT(CHAR(10),owor.duedate, 103) like '%".$request['label']."%'"; 
                    $ParametroParada="where CONVERT(CHAR(10),producao_parada.dt_ordem, 103) like '%".$request['label']."%'";
                    $ParametroPerda="where CONVERT(CHAR(10),perda.dt_ordem, 103) like '%".$request['label']."%' ";
                }

       
                $retorno['listaProducao'] = DB::select("select owor.DocEntry codigo,
                CONVERT (varchar, owor.duedate, 103) data,owor.plannedqty valor, CONVERT (varchar, owor.duedate, 112) duedate,
                /*
                (select sum(quantity) from SBO_KARAMBI_PRD.dbo.ign1 
                    where ign1.BaseRef=owor.DocEntry
                ) valor_prod, owor.ItemCode ,
                */
                isnull(CmpltQty,0) valor_prod,owor.ItemCode,
                case 
                when CONVERT(CHAR(10),owor.duedate, 23) <= '2024-03-18' and owor.ItemCode = '006283' then CONVERT(decimal(10,5), 7.2)
                when CONVERT(CHAR(10),owor.duedate, 23)<= '2024-03-19' and owor.ItemCode = '006277' then CONVERT(decimal(10,5), 7.2)
                when CONVERT(CHAR(10),owor.duedate, 23) <= '2024-03-22' and owor.ItemCode = '006280' then CONVERT(decimal(10,5), 7.2)
                when CONVERT(CHAR(10),owor.duedate, 23) <= '2024-03-25' and owor.ItemCode = '006274' then CONVERT(decimal(10,5), 7.2)
                else  CONVERT(decimal(10,5), IWeight1)  end  kg,
                ProdName nome, isnull(producao_parada.tempo,0) tempo 
                from (select * from  SBO_KARAMBI_PRD.dbo.owor where Uom='CX' ) owor
                left join ( select sum(tempo) tempo, cd_ordem from producao_parada group by cd_ordem ) producao_parada on producao_parada.cd_ordem = owor.DocEntry 
                inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
                ".$ParametroProducao."
                and oitm.ItmsGrpCod not in (103)");
                $totais['pCX']=0; $totais['pKG']=0; $totais['prCX']=0; $totais['prKG']=0; $totais['Tempo']=0;
                foreach($retorno['listaProducao'] as $valores){
                    $totais['pCX']=($totais['pCX']+$valores->valor);
                    $totais['pKG']=($totais['pKG']+($valores->valor*$valores->kg));
                    $totais['prCX']=($totais['prCX']+$valores->valor_prod);
                    $totais['prKG']=($totais['prKG']+($valores->valor_prod*$valores->kg));
                    $totais['Tempo']=($totais['Tempo']+$valores->tempo);
                }
                $retorno['totais'] = $totais;

                /* tipo parada */  
                $retorno['dadosParada'] = DB::select(" 
                select nm_tipo , producao_parada.dt_ordem dt_cadastro, tempo qtde,obs_parada
                from producao_parada 
                inner join  producao_tipo on producao_tipo.cd_tipo=producao_parada.cd_parada
                ".$ParametroParada."
                order by producao_parada.dt_ordem "); 
            
                $retorno['dadosPerda'] = DB::select(" 
                select nm_tipo,qtde, perda.dt_ordem,nm_produto,obs_perda
                from perda 
                inner join  perda_tipo on perda_tipo.cd_tipo =perda.cd_tipo_perda
                ".$ParametroPerda."
                order by perda.dt_ordem  "); 

                return $retorno;

            }

            if($request['indicador']=='perda'){ 

                $Tipo=null;
                if($request['sub_grupo']=='tipo'){
                    $Tipo=" and upper(nm_tipo) = upper('".$request['produto']."') ";
                } 
                if($request['sub_grupo']=='dt'){
                    $request['dti']=$request['data'];
                    $request['dtf']=$request['data'];
                }
                $grupo=null;
                if($request['sub_grupo']=='grupo'){
 

                    if($request['produto']=="EMBALAGEM"){
                        $grupo=" and grupo = '105' ";
                    }
                    if($request['produto']=="POLPA"){
                        $grupo=" and grupo = '103' ";
                    }
                    if($request['produto']=="INSUMO"){
                        $grupo=" and grupo = '109' ";
                    }
                    if($request['produto']=="OUTROS"){
                        $grupo=" and grupo not in('109','105','103')  ";
                    }
                }
  
                $retorno['dadosPerda'] = DB::select(" 
                select nm_tipo, convert(decimal(12, 0), round(qtde, 2, 1)) qtde, CONVERT(CHAR(10),perda.dt_ordem, 103)  dt_ordem,
                nm_produto,obs_perda,cd_perda,cd_produto,oitm.InvntryUom unidade,oitmItem.ItemCode cd_item ,oitmItem.ItemName nm_item
                from perda 
                inner join  perda_tipo on perda_tipo.cd_tipo =perda.cd_tipo_perda
                left join SBO_KARAMBI_PRD.dbo.OITM on  convert(varchar, OITM.ItemCode,103) =   perda.cd_produto  COLLATE Latin1_General_CI_AS
                left join  SBO_KARAMBI_PRD.dbo.owor  on owor.DocEntry = perda.cd_ordem
                left join SBO_KARAMBI_PRD.dbo.oitm oitmItem on oitmItem.ItemCode=owor.ItemCode
                where CONVERT(CHAR(10),perda.dt_ordem, 23)  between '".$request['dti']."' and  '".$request['dtf']."'
                $Tipo $grupo
                order by perda.dt_ordem  ");  
                return $retorno;
            }
            
            if($request['indicador']=='parada'){ 
                $Tipo=null;
                if($request['sub_grupo']=='tipo'){
                    $Tipo=" and upper(nm_tipo) = upper('".$request['produto']."') ";
                }
                $Equip=null;
                if($request['sub_grupo']=='equip'){
                    $Equip=" and upper(nm_equipamento) = upper('".$request['produto']."') ";
                }
                if($request['sub_grupo']=='dt'){
                    $request['dti']=$request['data'];
                    $request['dtf']=$request['data'];
                }
                $retorno['dadosParada'] = DB::select(" 
                select cd_producao_parada,CONVERT(CHAR(10),producao_parada.dt_ordem, 103)  dt_ordem,nm_tipo,
                nm_equipamento,tempo,obs_parada,oitm.ItemCode cd_item ,oitm.ItemName nm_item,producao_parada.cd_ordem
                from producao_parada 
                inner join  producao_tipo on producao_tipo.cd_tipo=producao_parada.cd_parada
                left join equipamento on equipamento.cd_equipamento = producao_parada.cd_equipamento
                left join  SBO_KARAMBI_PRD.dbo.owor  on owor.DocEntry = producao_parada.cd_ordem
                left join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode
                where CONVERT(CHAR(10),producao_parada.dt_ordem, 23)  between '".$request['dti']."' and  '".$request['dtf']."'
                 $Tipo $Equip
                order by producao_parada.dt_ordem "); 
                return $retorno;
            }

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
            $request['unidade']='KG';
            $request['ds_unidade']='Kg';
            $request['ds_unid']=' [ Kilos ]'; 
        }
        
        if($request['unidade']=='KG'){
            $QtdeDadosMoagemTotal='sum( (CONVERT(decimal(10,5), isnull(IWeight1,0)) * isnull(CmpltQty,0) )) qtde';   
            $QtdeDadosMoagemConsumida='sum( (CONVERT(decimal(10,5), isnull(IWeight1,0)) * isnull(Quantity,0) )) qtde';  
            $QtdeDadosMoagemEstoque='sum( (CONVERT(decimal(10,5), isnull(IWeight1,0)) * isnull(Quantity,0) )) qtde_estoque';   
            $request['ds_unidade']='Kg'; 
            $request['ds_unid']=' [ Kilos ]';
        }

        if($request['unidade']=='TB'){
            $QtdeDadosMoagemTotal='sum(isnull(CmpltQty,0)) qtde';  
            $QtdeDadosMoagemConsumida='sum(isnull(Quantity,0)) qtde';  
            $QtdeDadosMoagemEstoque='sum(isnull(Quantity,0)) qtde_estoque';  
            $request['ds_unidade']='Tb'; 
            $request['ds_unid']=' [ Tambo ]';
        }

        if(($request['agrupamento']=='D') || ($request['agrupamento']=='P')){
            $DATAmoagemTotal='CONVERT (varchar, owor.DueDate, 103) data,owor.DueDate dt';
            $AGRMoagemTotal='CONVERT (varchar, owor.DueDate, 103),owor.DueDate';
            $ORDmoagemTotal='owor.DueDate';

            $DATAmoagemTConsumida='CONVERT (varchar, IGE1.DocDate, 103) data,IGE1.DocDate dt';
            $AGRMoagemConsumida='CONVERT (varchar, IGE1.DocDate, 103),IGE1.DocDate';
            $ORDmoagemConsumida='IGE1.DocDate';
   
        }

        if($request['agrupamento']=='M'){ 
            $DATAmoagemTotal='SUBSTRING(CONVERT (varchar, owor.DueDate, 103), 4, 7) data, SUBSTRING(CONVERT (varchar, owor.DueDate, 23), 0, 8) dt';
            $AGRMoagemTotal='SUBSTRING(CONVERT (varchar, owor.DueDate, 103), 4, 7), SUBSTRING(CONVERT (varchar, owor.DueDate, 23), 0, 8)';
            $ORDmoagemTotal='SUBSTRING(CONVERT (varchar, owor.DueDate, 23), 0, 8)';

            $DATAmoagemTConsumida='SUBSTRING(CONVERT (varchar, IGE1.DocDate, 103), 4, 7) data, SUBSTRING(CONVERT (varchar, IGE1.DocDate, 23), 0, 8) dt';
            $AGRMoagemConsumida='SUBSTRING(CONVERT (varchar, IGE1.DocDate, 103), 4, 7), SUBSTRING(CONVERT (varchar, IGE1.DocDate, 23), 0, 8)';
            $ORDmoagemConsumida='SUBSTRING(CONVERT (varchar, IGE1.DocDate, 23), 0, 8)';
   
        }
  

        /* Tomate in Natura */
        $dadosTomateInNatura = DB::select(" 
        select top(1) sum(PCH1.Quantity) qtde from SBO_KARAMBI_PRD.dbo.OPCH
        inner join SBO_KARAMBI_PRD.dbo.PCH1 on PCH1.DocEntry=OPCH.DocEntry
        where PCH1.ItemCode='001208'
        and CONVERT(CHAR(10),OPCH.DocDate, 23)  between '".$request['dti']."' and '".$request['dtf']."' ");
        $TomateInNatura= (isset($dadosTomateInNatura[0]->qtde)) ? $dadosTomateInNatura[0]->qtde : 0;

        /* Moagem Total  [CARD] */
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
        $MoagemTotalTb= (isset($dadosMoagemTotal[0]->tb)) ? $dadosMoagemTotal[0]->tb : 0;
        $MoagemTotalKg= (isset($dadosMoagemTotal[0]->kg)) ? $dadosMoagemTotal[0]->kg : 0;
        $MoagemEstoqueTb= (isset($dadosMoagemTotal[0]->tb_estoque)) ? $dadosMoagemTotal[0]->tb_estoque : 0;
        $MoagemEstoqueKg= (isset($dadosMoagemTotal[0]->kg_estoque)) ? $dadosMoagemTotal[0]->kg_estoque : 0;
        $MoagemConsumidaTb=($MoagemTotalTb-$MoagemEstoqueTb);
        $MoagemConsumidaKg=($MoagemTotalKg-$MoagemEstoqueKg);

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
                'dti'=>$request['dti'],
                'dtf'=>$request['dtf'],
                'agrupamento'=>$request['agrupamento'], 
                "color_producao"=> "#ef4836"
            ); 

            $MoagemConsumida[]=array( 
                "label"=>$val->data,
                "producao"=>$QTdeConsumida,  
                'kg'=>$kgConsumida,
                'tb'=>$TbConsumida,
                'dt'=>$val->dt,
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
        select  sum(isnull(liquido,0)) liquido, 
        sum(( ( (100-isnull(fruto,0)) * isnull(liquido,0) ) /100 )) total,
        sum(( ( (100-isnull(fruto,0)) * isnull(liquido,0) ) /100 )) / sum(isnull(liquido,0)) * 100 total_perc
        from recebimento_tomate 
        where CONVERT(CHAR(10),dt_recebimento, 23)  between '".$request['dti']."' and '".$request['dtf']."' ");
        $PerdasTotal= (isset($dadosPerdas[0]->total)) ? $dadosPerdas[0]->total : 0;
        $PerdasTotalPerc= (isset($dadosPerdas[0]->total_perc)) ? $dadosPerdas[0]->total_perc : 0;
       
        /* Fornecedor */
        $retorno['fornecedor'] = DB::select(" 
        select OPCH.CardCode,OPCH.CardName nome,sum(Quantity) total
        from SBO_KARAMBI_PRD.dbo.OPCH
        inner join SBO_KARAMBI_PRD.dbo.PCH1 on PCH1.DocEntry=OPCH.DocEntry
        where PCH1.ItemCode='001208'
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

        $request['TomateInNatura'] =  ($TomateInNatura) ?  number_format($TomateInNatura,0,",",".") : '000';
        $request['MoagemTotalTb'] = ($MoagemTotalTb) ?  number_format($MoagemTotalTb,0,",",".") : '000';
        $request['MoagemTotalKg'] = ($MoagemTotalKg) ?  number_format($MoagemTotalKg,0,",",".") : '000'; 
        $request['MoagemConsumidaTb'] = ($MoagemConsumidaTb) ?  number_format($MoagemConsumidaTb,0,",",".") : '000';
        $request['MoagemConsumidaKg'] = ($MoagemConsumidaKg) ?  number_format($MoagemConsumidaKg,0,",",".") : '000'; 
        $request['MoagemEstoqueTb'] = number_format( $MoagemEstoqueTb ,0,",",".");
        $request['MoagemEstoqueKg'] = number_format( $MoagemEstoqueKg ,0,",",".");
        $request['Brix'] =  ($Brix) ?  number_format($Brix,2,",",".") : '0,00';
        $request['PerdasTotal'] = ($PerdasTotal) ?  number_format($PerdasTotal,0,",",".") : '000';
        $request['PerdasTotalPerc'] = ($PerdasTotalPerc) ?  number_format($PerdasTotalPerc,2,",",".") : '0,00'; 
        $retorno['MoagemTotal'] = $MoagemTotal;
        $retorno['MoagemConsumida'] = $MoagemConsumida;
        $retorno['MoagemEstoque'] = $MoagemEstoque;
        $retorno['Fornecedores'] = $Fornecedores;
         
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
        if($tipo=='M'){
            $DADOS = DB::select("
            select codigo,nome, data, kg,
            valor planejado_cx, 
            valor*kg planejado_kg,
            ((valor*kg)/1000) planejado_to, 
            valor_prod produzido_cx, 
            valor_prod*kg produzido_kg,
            ((valor_prod*kg)/1000) produzido_to 
            from (
                select owor.DocEntry codigo,
                    CONVERT (varchar, owor.duedate, 103) data,owor.plannedqty valor, CONVERT (varchar, owor.duedate, 112) duedate,
                    /*
                    (select sum(quantity) from SBO_KARAMBI_PRD.dbo.ign1 
                        where ign1.BaseRef=owor.DocEntry
                    ) valor_prod, owor.ItemCode ,
                    */
                    isnull(CmpltQty,0) valor_prod,owor.ItemCode,
                    case 
                        when CONVERT(CHAR(10),owor.duedate, 23) <= '2024-03-18' and owor.ItemCode = '006283' then CONVERT(decimal(10,5), 7.2)
                        when CONVERT(CHAR(10),owor.duedate, 23)<= '2024-03-19' and owor.ItemCode = '006277' then CONVERT(decimal(10,5), 7.2)
                        when CONVERT(CHAR(10),owor.duedate, 23) <= '2024-03-22' and owor.ItemCode = '006280' then CONVERT(decimal(10,5), 7.2)
                        when CONVERT(CHAR(10),owor.duedate, 23) <= '2024-03-25' and owor.ItemCode = '006274' then CONVERT(decimal(10,5), 7.2)
                    else  CONVERT(decimal(10,5), IWeight1) end kg,ProdName nome 
                    from (select * from  SBO_KARAMBI_PRD.dbo.owor where Uom='CX' ) owor 
                    inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
                    where CONVERT(CHAR(10),owor.duedate, 23) between '".$request['dti']."' and '".$request['dtf']."'
                    and oitm.ItmsGrpCod not in (103)
            ) xx
            order by 1
            ");
            return view('colonial.producao.indicadores/xls_movimento',compact('request','DADOS'));
        }
        if($tipo=='A'){
            $DADOS = DB::select("
            select *
            from hidricos 
            where CONVERT(CHAR(10),dt_consumo, 23)  between '".$request['dti']."' and '".$request['dtf']."'
            order by dt_consumo
            ");
            return view('colonial.producao.indicadores/xls_agua',compact('request','DADOS'));
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
