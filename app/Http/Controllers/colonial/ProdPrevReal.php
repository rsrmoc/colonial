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
 
    public function modalJson(Request $request) { 
        try{

            $hidrico = Hidrico::whereRaw("CONVERT(varchar, dt_consumo, 103) like '%".$request['label']."%' ")
            ->selectRaw("sum(saldo) valor")->first();
            
            $energia = Energia::whereRaw("CONVERT(varchar, dt_consumo, 103) like '%".$request['label']."%' ")
            ->selectRaw("sum(qtde) valor")->first();
     
            $lenha = Estoque::whereRaw("CONVERT(varchar, DocDate, 103) like '%".$request['label']."%' ")
            ->whereRaw("WhsCode='MPV'")->selectRaw("sum(Quantity) valor")->first();
    
            $perda = Perda::whereRaw("CONVERT(varchar, dt_ordem, 103)  like '%".$request['label']."%' ")
            ->selectRaw("count(qtde) valor")->first();
     
    
            $parada = Parada::whereRaw("CONVERT(varchar, dt_cadastro, 103) like '%".$request['label']."%' ")
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
                $ParametroParada="where CONVERT(CHAR(10),producao_parada.dt_cadastro, 23) like '%".$request['dti']."%'";
                $ParametroPerda="where CONVERT(CHAR(10),perda.dt_cadastro, 23) like '%".$request['dti']."%' ";
            }else{
                $ParametroProducao="where CONVERT(CHAR(10),owor.duedate, 103) like '%".$request['label']."%'"; 
                $ParametroParada="where CONVERT(CHAR(10),producao_parada.dt_cadastro, 103) like '%".$request['label']."%'";
                $ParametroPerda="where CONVERT(CHAR(10),perda.dt_cadastro, 103) like '%".$request['label']."%' ";
            }

      
            
            $retorno['listaProducao'] = DB::select("select owor.DocEntry codigo,
            CONVERT (varchar, owor.duedate, 103) data,owor.plannedqty valor, CONVERT (varchar, owor.duedate, 112) duedate,
            (select sum(quantity) from SBO_KARAMBI_PRD.dbo.ign1 
                where ign1.BaseRef=owor.DocEntry
            ) valor_prod, owor.ItemCode ,
            case 
            when CONVERT(CHAR(10),owor.duedate, 23) <= '2024-03-18' and owor.ItemCode = '006283' then CONVERT(decimal(10,5), 7.2)
            when CONVERT(CHAR(10),owor.duedate, 23)<= '2024-03-19' and owor.ItemCode = '006277' then CONVERT(decimal(10,5), 7.2)
            when CONVERT(CHAR(10),owor.duedate, 23) <= '2024-03-22' and owor.ItemCode = '006280' then CONVERT(decimal(10,5), 7.2)
            when CONVERT(CHAR(10),owor.duedate, 23) <= '2024-03-25' and owor.ItemCode = '006274' then CONVERT(decimal(10,5), 7.2)
            else  CONVERT(decimal(10,5), SWeight1)  end  kg,
            ProdName nome 
            from (select * from  SBO_KARAMBI_PRD.dbo.owor where Uom='CX' ) owor 
            inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
            ".$ParametroProducao."
            and oitm.ItmsGrpCod not in (103)");
            $totais['pCX']=0; $totais['pKG']=0; $totais['prCX']=0; $totais['prKG']=0;
            foreach($retorno['listaProducao'] as $valores){
                $totais['pCX']=($totais['pCX']+$valores->valor);
                $totais['pKG']=($totais['pKG']+($valores->valor*$valores->kg));
                $totais['prCX']=($totais['prCX']+$valores->valor_prod);
                $totais['prKG']=($totais['prKG']+($valores->valor_prod*$valores->kg));
            }
            $retorno['totais'] = $totais;
            /* tipo parada */  
            $retorno['dadosParada'] = DB::select(" 
            select nm_tipo , producao_parada.dt_cadastro, tempo qtde,obs_parada
            from producao_parada 
            inner join  producao_tipo on producao_tipo.cd_tipo=producao_parada.cd_parada
            ".$ParametroParada."
            order by producao_parada.dt_cadastro "); 
           
            $retorno['dadosPerda'] = DB::select(" 
            select nm_tipo,qtde, perda.dt_ordem,nm_produto,obs_perda
            from perda 
            inner join  perda_tipo on perda_tipo.cd_tipo =perda.cd_tipo_perda
            ".$ParametroPerda."
            order by perda.dt_ordem  "); 

            return $retorno;


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
                CONVERT (varchar, owor.duedate, 23) dia, 
                (select sum(quantity) from SBO_KARAMBI_PRD.dbo.ign1 
                    where ign1.BaseRef=owor.DocEntry
                ) valor_prod, owor.ItemCode ,
                case 
                when CONVERT(CHAR(10),owor.duedate, 23) <= '2024-03-18' and owor.ItemCode = '006283' then CONVERT(decimal(10,5), 7.2)
                when CONVERT(CHAR(10),owor.duedate, 23)<= '2024-03-19' and owor.ItemCode = '006277' then CONVERT(decimal(10,5), 7.2)
                when CONVERT(CHAR(10),owor.duedate, 23) <= '2024-03-22' and owor.ItemCode = '006280' then CONVERT(decimal(10,5), 7.2)
                when CONVERT(CHAR(10),owor.duedate, 23) <= '2024-03-25' and owor.ItemCode = '006274' then CONVERT(decimal(10,5), 7.2)
                else  CONVERT(decimal(10,5), SWeight1)  end  kg,
                ProdName nome 
                from (select * from  SBO_KARAMBI_PRD.dbo.owor where Uom='CX' ) owor 
                inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
                where CONVERT(CHAR(10),owor.duedate, 23) between '".$request['dti']."' and '".$request['dtf']."'
                and oitm.ItmsGrpCod not in (103)
        ) xx group by ".$Agrupamento2.",".$Agrupamento22."  order by ".$Agrupamento22."
        ");
        $ProduzidoCx=0; $PlanejadoCx=0;
        $ProduzidoKg=0; $PlanejadoKg=0;
        $ProduzidoTo=0; $PlanejadoTo=0;     
        $data=null; $ProduzidoCxPerc=0;
        $ProduzidoKgPerc=0;$ProduzidoToPerc=0;
        $prod_per=null;
        foreach($dados as $key => $val){
           if($key % 2 == 0) { $townName2=round($val->planejado_kg); }else{ $townName2=''; }
             
                        if(($val->prozuzido>0) && ($val->planejado>0)){ 
                            $valorPerc=round((($val->prozuzido/$val->planejado)*100),2); 
                        }else{ 
                            $valorPerc=0; 
                        } 
                        
                        $prod_per[]=array( 
                            "label"=>$val->data,
                            "producao"=>$valorPerc,
                            'planejado_kg'=>$val->planejado_kg,
                            'planejado_to'=> ($val->planejado_kg) ? ($val->planejado_kg/1000) : '0',
                            'planejado_cx'=>$val->planejado_cx,
                            'produzido_cx'=>$val->produzido_cx,
                            'produzido_kg'=>$val->produzido_kg,
                            'dti'=>$request['dti'],
                            'dtf'=>$request['dtf'],
                            'agrupamento'=>$request['agrupamento'],
                            'produzido_to'=> ($val->produzido_kg) ? ($val->produzido_kg/1000) : '0',
                            "color_producao"=> "#2A0CD0"
                        ); 

                        $data[] = array(
                           'label'=>$val->data,
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
                        
                        $PlanejadoCx=($PlanejadoCx+round($val->planejado_cx,0));
                        $PlanejadoKg=($PlanejadoKg+round($val->planejado_kg,0));
                        $PlanejadoTo=round(($PlanejadoTo+$plaToneladas),2);
            
        }
        if(($ProduzidoCx>0) && ($PlanejadoCx>0)){ $ProduzidoCxPerc=round((($ProduzidoCx/$PlanejadoCx)*100),2); }
        if(($ProduzidoKg>0) && ($PlanejadoKg>0)){ $ProduzidoKgPerc=round((($ProduzidoKg/$PlanejadoKg)*100),2); }
        if(($ProduzidoTo>0) && ($PlanejadoTo>0)){ $ProduzidoToPerc=round((($ProduzidoTo/$PlanejadoTo)*100),2); }

  
        /* Produto */ 
        $dadosProd = DB::select(" 
        select ItemName nome, sum(quantity) produzido_cx,sum(quantity*SWeight1) produzido_kg,sum((quantity*SWeight1)/1000) produzido_to,".$prozuzidoProd." produzido
        from (
            select ItemName,quantity, 
            case 
            when CONVERT(CHAR(10),owor.duedate, 23) <= '2024-03-18' and owor.ItemCode = '006283' then CONVERT(decimal(10,5), 7.2)
            when CONVERT(CHAR(10),owor.duedate, 23)<= '2024-03-19' and owor.ItemCode = '006277' then CONVERT(decimal(10,5), 7.2)
            when CONVERT(CHAR(10),owor.duedate, 23) <= '2024-03-22' and owor.ItemCode = '006280' then CONVERT(decimal(10,5), 7.2)
            when CONVERT(CHAR(10),owor.duedate, 23) <= '2024-03-25' and owor.ItemCode = '006274' then CONVERT(decimal(10,5), 7.2)
            else  CONVERT(decimal(10,5), SWeight1) end SWeight1
            from SBO_KARAMBI_PRD.dbo.ign1 
            inner join (select * from  SBO_KARAMBI_PRD.dbo.owor where Uom='CX' ) owor on ign1.BaseRef=owor.DocEntry
            inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
            where CONVERT(CHAR(10),owor.duedate, 23)  between '".$request['dti']."' and '".$request['dtf']."'
        ) query
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
        $Polpa=null;
        $Lenha=null;
        $Energia=null;
        $Perda=null;
        $Parada=null;
        $tipoParada=null;
        $Agua=null;
        $Comparativo=null;
        $dadosAgua = DB::select(" select top(1) qtde_atual from hidricos where CONVERT(CHAR(10),dt_consumo, 23) < '".$request['dti']."' order by dt_consumo desc");
        $QtdeAguaAnterior= (isset($dadosAgua[0]->qtde_atual)) ? $dadosAgua[0]->qtde_atual : 0;

        $dadosAgua = DB::select(" select top(1) qtde  from energias where CONVERT(CHAR(10),dt_consumo, 23) < '".$request['dti']."' order by dt_consumo desc");
        $QtdeEnergiaAnterior= (isset($dadosAgua[0]->qtde)) ? $dadosAgua[0]->qtde : 0;

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

            /* agua ANO */ 
            $dadosAgua = DB::select(" 
            select month(dt_consumo) data, 
            sum(saldo) qtde
            from hidricos 
            where CONVERT(CHAR(10),dt_consumo, 23)  between '".$request['dti']."' and '".$request['dtf']."'
            group by month(dt_consumo)
            order by 1 ");  
            foreach($dadosAgua as $key => $val){   
                $ArrayAgua[$val->data]=round($val->qtde,2); 
            } 
            foreach($MESES as $key => $mes){ 
                $Ar['country']=$mes;
                $Ar['visits']= (isset($ArrayAgua[$key])) ? round($ArrayAgua[$key],2) : null; 
                $Ar['color']=$this->gerar_cor($key);
                $Agua[]=$Ar;  
            }

            /* energia ANO */ 
            $dadosEnergia = DB::select(" 
            select month(dt_consumo) data, 
            sum(qtde) qtde
            from energias 
            where CONVERT(CHAR(10),dt_consumo, 23)  between '".$request['dti']."' and '".$request['dtf']."'
            group by month(dt_consumo)
            order by 1 ");  
            foreach($dadosEnergia as $key => $val){   
                $ArrayEnergia[$val->data]=round($val->qtde,2); 
            } 
            foreach($MESES as $key => $mes){ 
                $Ar['country']=$mes;
                $Ar['visits']= (isset($ArrayEnergia[$key])) ? round($ArrayEnergia[$key],2) : null; 
                $Ar['color']=$this->gerar_cor($key);
                $Energia[]=$Ar;  
            }


            /* lenha ANO */
            $dadosLenha = Estoque::whereRaw("CONVERT(varchar, DocDate, 23) between '".$request['dti']."' and '".$request['dtf']."' ")
            ->whereRaw("WhsCode='MPV'")
            ->selectRaw("month(DocDate) data,
            sum(Quantity) qtde")->groupByRaw("month(DocDate)")
            ->orderByRaw("1 ")->get();  
            foreach($dadosLenha as $key => $val){   
                $ArrayLenha[$val->data]=round($val->qtde,2); 
            } 
            foreach($MESES as $key => $mes){ 
                $Ar['country']=$mes;
                $Ar['visits']= (isset($ArrayLenha[$key])) ? round($ArrayLenha[$key],2) : null; 
                $Ar['color']=$this->gerar_cor($key);
                $Lenha[]=$Ar;  
            }


            /* parada ANO */  
            $dadosParada = DB::select(" 
            select month(producao_parada.dt_cadastro) data, 
            sum(tempo) qtde
            from producao_parada 
            inner join  producao_tipo on producao_tipo.cd_tipo=producao_parada.cd_parada
            where CONVERT(CHAR(10),producao_parada.dt_cadastro, 23)  between '".$request['dti']."' and '".$request['dtf']."' 
            group by month(producao_parada.dt_cadastro)
            order by 1");  
            foreach($dadosParada as $key => $val){   
                $ArrayParada[$val->data]=round($val->qtde,2); 
            } 
            foreach($MESES as $key => $mes){ 
                $Ar['country']=$mes;
                $Ar['visits']= (isset($ArrayParada[$key])) ? round($ArrayParada[$key],2) : null; 
                $Ar['color']=$this->gerar_cor($key+1);
                $Parada[]=$Ar;  
            }


            /* perda MES */  
            $dadosPerda = DB::select(" 
            select month(perda.dt_ordem) data, 
            count(qtde) qtde
            from perda 
            inner join  perda_tipo on perda_tipo.cd_tipo =perda.cd_tipo_perda 
            where CONVERT(CHAR(10),perda.dt_ordem, 23)  between '".$request['dti']."' and '".$request['dtf']."' 
            group by month(perda.dt_ordem)
            order by 1 "); 
            foreach($dadosPerda as $key => $val){   
                $ArrayPerda[$val->data]=round($val->qtde); 
            } 
            foreach($MESES as $key => $mes){ 
                $Ar['country']=$mes;
                $Ar['visits']= (isset($ArrayPerda[$key])) ? round($ArrayPerda[$key]) : null; 
                $Ar['color']=$this->gerar_cor($key+5);
                $Perda[]=$Ar;
            }

            /* polpa MES */
            $dadosPolpa = Estoque::whereRaw("CONVERT(varchar, DocDate, 23) between '".$request['dti']."' and '".$request['dtf']."' ")
            ->whereRaw("ItemCode='013906'")
            ->selectRaw(" month(DocDate) data,
            sum(Quantity) qtde")->groupByRaw("month(DocDate)")
            ->orderByRaw("1")->get();  
           
            foreach($dadosPolpa as $key => $val){   
                $ArrayPolpa[$val->data]=round($val->qtde); 
            } 
            foreach($MESES as $key => $mes){ 
                $Ar['country']=$mes;
                $Ar['visits']= (isset($ArrayPolpa[$key])) ? round($ArrayPolpa[$key]) : null; 
                $Ar['color']=$this->gerar_cor($key+2);
                $Polpa[]=$Ar;
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
 
            /* agua DIA */  
            $dadosAgua = DB::select(" 
            select CAST( right(replicate('0',2) + convert(VARCHAR,day(dt_consumo)),2) AS NVARCHAR(2)) data, 
            sum(saldo) qtde
            from hidricos 
            where CONVERT(CHAR(10),dt_consumo, 23)  between '".$request['dti']."' and '".$request['dtf']."'
            group by day(dt_consumo)
            order by 1 "); 
            $qtdeAnterior=$QtdeAguaAnterior;
            foreach($dadosAgua as $val){  
                $Ar['country']=$val->data;
                $Ar['visits']=round(($val->qtde),2);
                if(str_pad($request['dia'] , 2 , '0' , STR_PAD_LEFT)==$val->data){
                    $Ar['color']='#3f24d4';
                }else{
                    $Ar['color']='#2599d3';
                }
                $Agua[]=$Ar; 
                $qtdeAnterior = $val->qtde;
            } 

            /* energia DIA */ 
            $dadosEnergia = DB::select(" 
            select CAST( right(replicate('0',2) + convert(VARCHAR,day(dt_consumo)),2) AS NVARCHAR(2)) data, 
            sum(qtde) qtde
            from energias 
            where CONVERT(CHAR(10),dt_consumo, 23)  between '".$request['dti']."' and '".$request['dtf']."'
            group by day(dt_consumo)
            order by 1 "); 
            $qtdeAnterior=$QtdeEnergiaAnterior; 
            foreach($dadosEnergia as $val){  
                $Ar['country']=$val->data;
                //$Ar['visits']=round($val->qtde-$qtdeAnterior,2);
                $Ar['visits']=round($val->qtde,2);
                if(str_pad($request['dia'] , 2 , '0' , STR_PAD_LEFT)==$val->data){
                    $Ar['color']='#1dd62c';
                }else{
                    $Ar['color']='#b7e121';
                }
                $Energia[]=$Ar; 
                $qtdeAnterior = $val->qtde;
            } 

            /* lenha DIA */
            $dadosLenha = Estoque::whereRaw("CONVERT(varchar, DocDate, 23) between '".$request['dti']."' and '".$request['dtf']."' ")
            ->whereRaw("WhsCode='MPV'")
            ->selectRaw("CAST( right(replicate('0',2) + convert(VARCHAR,day(DocDate)),2) AS NVARCHAR(2)) data,
            sum(Quantity) qtde")->groupByRaw("CAST( right(replicate('0',2) + convert(VARCHAR,day(DocDate)),2) AS NVARCHAR(2))")
            ->orderByRaw("1 ")->get(); 
            foreach($dadosLenha as $val){  
              
                $Ar['country']=$val->data;
                $Ar['visits']=round($val->qtde,2);
                if(str_pad($request['dia'] , 2 , '0' , STR_PAD_LEFT)==$val->data){
                    $Ar['color']='#04D215';
                }else{
                    $Ar['color']='#B0DE09';
                }
                $Lenha[]=$Ar; 
            }

            /* polpa DIA */
            $dadosPolpa = Estoque::whereRaw("CONVERT(varchar, DocDate, 23) between '".$request['dti']."' and '".$request['dtf']."' ")
            ->whereRaw("ItemCode='013906'")
            ->selectRaw("CAST( right(replicate('0',2) + convert(VARCHAR,day(DocDate)),2) AS NVARCHAR(2)) data,
            sum(Quantity) qtde")->groupByRaw("CAST( right(replicate('0',2) + convert(VARCHAR,day(DocDate)),2) AS NVARCHAR(2))")
            ->orderByRaw("1 ")->get();  
            foreach($dadosPolpa as $val){  
                $Ar['country']=$val->data;
                $Ar['visits']=round($val->qtde,2);
                if(str_pad($request['dia'] , 2 , '0' , STR_PAD_LEFT)==$val->data){
                    $Ar['color']='#d22581';
                }else{
                    $Ar['color']='#f58cc4';
                }
                $Polpa[]=$Ar;
            } 

            /* parada DIA */  
            $dadosParada = DB::select(" 
            select CAST( right(replicate('0',2) + convert(VARCHAR,day(producao_parada.dt_cadastro)),2) AS NVARCHAR(2)) data, 
            sum(tempo) qtde
            from producao_parada 
            inner join  producao_tipo on producao_tipo.cd_tipo=producao_parada.cd_parada
            where CONVERT(CHAR(10),producao_parada.dt_cadastro, 23)  between '".$request['dti']."' and '".$request['dtf']."' 
            group by CAST( right(replicate('0',2) + convert(VARCHAR,day(producao_parada.dt_cadastro)),2) AS NVARCHAR(2))
            order by 1"); 
            foreach($dadosParada as $val){  
                $Ar['country']=$val->data;
                $Ar['visits']=round($val->qtde,2);
                if(str_pad($request['dia'] , 2 , '0' , STR_PAD_LEFT)==$val->data){
                    $Ar['color']='#FF0F00';
                }else{
                    $Ar['color']='#f59f9a';
                }
                $Parada[]=$Ar;
            }

            /* perda DIA */   
            $dadosPerda = DB::select(" 
            select CAST( right(replicate('0',2) + convert(VARCHAR,day(perda.dt_ordem)),2) AS NVARCHAR(2)) data, 
            count(qtde) qtde
            from perda 
            inner join  perda_tipo on perda_tipo.cd_tipo =perda.cd_tipo_perda
            where CONVERT(CHAR(10),perda.dt_ordem, 23)  between '".$request['dti']."' and '".$request['dtf']."' 
            group by CAST( right(replicate('0',2) + convert(VARCHAR,day(perda.dt_ordem)),2) AS NVARCHAR(2))
            order by 1 "); 
            foreach($dadosPerda as $key => $val){  
                $Ar['country']=$val->data;
                $Ar['visits']=round($val->qtde);
                if(str_pad($request['dia'] , 2 , '0' , STR_PAD_LEFT)==$val->data){
                    $Ar['color']='#FF0F00';
                }else{
                    $Ar['color']='#f59f9a';
                }
                $Perda[]=$Ar;
                
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
            $request['ds_mes'] =($request['mes']) ? $MESES[$request['mes']] : null; 
 
            $dadosProd = DB::select(" 
            select  CAST(year(owor.duedate) AS NVARCHAR(4))+CAST( right(replicate('0',2) + convert(VARCHAR,MONTH(owor.duedate)),2) AS NVARCHAR(2)) data, 
            year(owor.duedate) ano,CAST( right(replicate('0',2) + convert(VARCHAR,MONTH(owor.duedate)),2) AS NVARCHAR(2)) mes,".$produzidoComparativo." qtde
            from SBO_KARAMBI_PRD.dbo.ign1 
            inner join (select * from  SBO_KARAMBI_PRD.dbo.owor where Uom='CX' ) owor on ign1.BaseRef=owor.DocEntry
            inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
            where CONVERT(CHAR(10),owor.duedate, 23)  between '".$request['dt_comparativa_ano']."' and '".$request['dtf']."'
            group by CAST(year(owor.duedate) AS NVARCHAR(4))+CAST( right(replicate('0',2) + convert(VARCHAR,MONTH(owor.duedate)),2) AS NVARCHAR(2)) ,year(owor.duedate),
                    CAST( right(replicate('0',2) + convert(VARCHAR,MONTH(owor.duedate)),2) AS NVARCHAR(2))
            order by 3,1 "); 
            foreach($dadosProd as $val){  
                $DadosAno[$val->mes][$val->ano] = $val->qtde;
            } 
            foreach($DadosAno as $keyMes => $val){  
                $Array['label']= $MESES[$keyMes];
                $Array['color01']= "#008000";
                $Array['color02']= "#2A0CD0";
                $Array['color03']= "#FF0F00";
                $X=1;
                foreach($val as $KeyVal => $valores){ 
                    $Array['ano0'.($X)]= round($valores,2);
                    $X = ($X+1);
                }
                $ComparativoAno[] = $Array; 
            }

            /* agua MESES */  
            $dadosAgua = DB::select("  
            select CAST( right(replicate('0',2) + convert(VARCHAR,day(dt_consumo)),2) AS NVARCHAR(2)) data, 
            sum(saldo) qtde
            from hidricos 
            where CONVERT(CHAR(10),dt_consumo, 23)  between '".$request['dti']."' and '".$request['dtf']."'
            group by CAST( right(replicate('0',2) + convert(VARCHAR,day(dt_consumo)),2) AS NVARCHAR(2))
            order by 1 ");  
            foreach($dadosAgua as $key => $val){  
                $Agu[$val->data]=round($val->qtde,2);
            }  
            for ($i = 1; $i <= $request['ultimo_dia']; $i++) { 
                $Agua[]=array( 
                    "country"=> str_pad($i , 2 , '0' , STR_PAD_LEFT),
                    "visits"=>(isset($Agu[$i])) ? $Agu[$i] : null,
                    "color"=> $this->gerar_cor($i)
                );
            }
         
            /* energia MESES */  
            $dadosEnergia = DB::select(" 
            select CAST( right(replicate('0',2) + convert(VARCHAR,day(dt_consumo)),2) AS NVARCHAR(2)) data, 
            sum(qtde) qtde
            from energias 
            where CONVERT(CHAR(10),dt_consumo, 23)  between '".$request['dti']."' and '".$request['dtf']."'
            group by day(dt_consumo)
            order by 1 ");  
            foreach($dadosEnergia as $key => $val){  
                $Ene[$val->data]=round($val->qtde,2);
            }   
            for ($i = 1; $i <= $request['ultimo_dia']; $i++) { 
                $Energia[]=array( 
                    "country"=> str_pad($i , 2 , '0' , STR_PAD_LEFT),
                    "visits"=>(isset($Ene[str_pad($i , 2 , '0' , STR_PAD_LEFT)])) ? $Ene[str_pad($i , 2 , '0' , STR_PAD_LEFT)] : null,
                    "color"=> $this->gerar_cor($i)
                );
            }
        

            /* lenha MESES */
            $dadosLenha = Estoque::whereRaw("CONVERT(varchar, DocDate, 23) between '".$request['dti']."' and '".$request['dtf']."' ")
            ->whereRaw("WhsCode='MPV'")
            ->selectRaw("CAST( right(replicate('0',2) + convert(VARCHAR,day(DocDate)),2) AS NVARCHAR(2)) data,
            sum(Quantity) qtde")->groupByRaw("CAST( right(replicate('0',2) + convert(VARCHAR,day(DocDate)),2) AS NVARCHAR(2))")
            ->orderByRaw("1 ")
            ->get();   
            foreach($dadosLenha as $key => $val){  
                $Len[$val->data]=round($val->qtde,2);
            }   
            for ($i = 1; $i <= $request['ultimo_dia']; $i++) { 
                $Lenha[]=array( 
                    "country"=> str_pad($i , 2 , '0' , STR_PAD_LEFT),
                    "visits"=>(isset($Len[str_pad($i , 2 , '0' , STR_PAD_LEFT)])) ? $Len[str_pad($i , 2 , '0' , STR_PAD_LEFT)] : null,
                    "color"=> $this->gerar_cor($i)
                );
            }

            /* polpa MESES */
            $dadosPolpa = Estoque::whereRaw("CONVERT(varchar, DocDate, 23) between '".$request['dti']."' and '".$request['dtf']."' ")
            ->whereRaw("ItemCode='013906'")
            ->selectRaw("CAST( right(replicate('0',2) + convert(VARCHAR,day(DocDate)),2) AS NVARCHAR(2)) data,
            sum(Quantity) qtde")->groupByRaw("CAST( right(replicate('0',2) + convert(VARCHAR,day(DocDate)),2) AS NVARCHAR(2))")
            ->orderByRaw("1 ") 
            ->get();  
            foreach($dadosPolpa as $key => $val){  
                $Pol[$val->data]=round($val->qtde,2);
            }   
            for ($i = 1; $i <= $request['ultimo_dia']; $i++) { 
                $Polpa[]=array( 
                    "country"=> str_pad($i , 2 , '0' , STR_PAD_LEFT),
                    "visits"=>(isset($Pol[str_pad($i , 2 , '0' , STR_PAD_LEFT)])) ? $Pol[str_pad($i , 2 , '0' , STR_PAD_LEFT)] : null,
                    "color"=> $this->gerar_cor($i)
                );
            }

            /* parada MESES */  
            $dadosParada = DB::select(" 
            select CAST( right(replicate('0',2) + convert(VARCHAR,day(producao_parada.dt_cadastro)),2) AS NVARCHAR(2)) data, 
            sum(tempo) qtde
            from producao_parada 
            inner join  producao_tipo on producao_tipo.cd_tipo=producao_parada.cd_parada
            where CONVERT(CHAR(10),producao_parada.dt_cadastro, 23)  between '".$request['dti']."' and '".$request['dtf']."' 
            group by CAST( right(replicate('0',2) + convert(VARCHAR,day(producao_parada.dt_cadastro)),2) AS NVARCHAR(2)) 
            order by 1");  
            foreach($dadosParada as $key => $val){  
                $Par[$val->data]=round($val->qtde,2);
            }   
            for ($i = 1; $i <= $request['ultimo_dia']; $i++) { 
                $Parada[]=array( 
                    "country"=> str_pad($i , 2 , '0' , STR_PAD_LEFT),
                    "visits"=>(isset($Par[str_pad($i , 2 , '0' , STR_PAD_LEFT)])) ? $Par[str_pad($i , 2 , '0' , STR_PAD_LEFT)] : null,
                    "color"=> $this->gerar_cor($i)
                );
            }

            /* perda MESES */  
            $dadosPerda = DB::select(" 
            select CAST( right(replicate('0',2) + convert(VARCHAR,day(perda.dt_ordem)),2) AS NVARCHAR(2)) data, 
            count(qtde) qtde
            from perda 
            inner join  perda_tipo on perda_tipo.cd_tipo =perda.cd_tipo_perda
            where CONVERT(CHAR(10),perda.dt_ordem, 23)  between '".$request['dti']."' and '".$request['dtf']."' 
            group by CAST( right(replicate('0',2) + convert(VARCHAR,day(perda.dt_ordem)),2) AS NVARCHAR(2))
            order by 1 "); 
            foreach($dadosPerda as $key => $val){  
                $Per[$val->data]=round($val->qtde,2);
            }  
            for ($i = 1; $i <= $request['ultimo_dia']; $i++) { 
                $Perda[]=array( 
                    "country"=>$i,
                    "visits"=>(isset($Per[$i])) ? $Per[$i] : null,
                    "color"=> $this->gerar_cor($i)
                );
            }
 
        }
  
        /* tipo parada */ 
        $tipoParada=null; 
        $dadosParada = DB::select(" 
        select nm_tipo data, 
        sum(tempo) qtde
        from producao_parada 
        inner join  producao_tipo on producao_tipo.cd_tipo=producao_parada.cd_parada
        where CONVERT(CHAR(10),producao_parada.dt_cadastro, 23)  between '".$request['dti']."' and '".$request['dtf']."' 
        group by nm_tipo
        order by 2 desc "); 
        foreach($dadosParada as $key => $val){

            /*
            $Ar['country']=$val->data;
            $Ar['litres']=round($val->qtde,2); 
            $tipoParada[]=$Ar;
            */

            $tipoParada[]=array(
                "produto"=>$val->data,
                "qtde"=>round($val->qtde,2),
                "color"=> $this->gerar_cor($key)
            );
 

        }
 
        /* tipo perda */ 
        $tipoPerda=null; 
        $dadosParada = DB::select(" 
        select nm_tipo data, 
        count(qtde) qtde
        from perda 
        inner join  perda_tipo on perda_tipo.cd_tipo =perda.cd_tipo_perda
        where CONVERT(CHAR(10),perda.dt_ordem, 23)  between '".$request['dti']."' and '".$request['dtf']."'
        group by nm_tipo
        order by 1  "); 
        foreach($dadosParada as $val){  
             
            $Ar['country']=$val->data;
            $Ar['litres']=round($val->qtde,2); 
            $tipoPerda[]=$Ar;
            
    
        }

      
        $hidrico = Hidrico::whereRaw("CONVERT(varchar, dt_consumo, 23) between '".$request['dti']."' and '".$request['dtf']."' ")
        ->selectRaw("sum(saldo) valor")->first();
        
        $energia = Energia::whereRaw("CONVERT(varchar, dt_consumo, 23) between '".$request['dti']."' and '".$request['dtf']."' ")
        ->selectRaw("sum(qtde) valor")->first();
 
        $lenha = Estoque::whereRaw("CONVERT(varchar, DocDate, 23) between '".$request['dti']."' and '".$request['dtf']."' ")
        ->whereRaw("WhsCode='MPV'")->selectRaw("sum(Quantity) valor")->first();

        $perda = Perda::whereRaw("CONVERT(varchar, dt_ordem, 23) between '".$request['dti']."' and '".$request['dtf']."' ")
        ->selectRaw("count(qtde) valor")->first();
 

        $parada = Parada::whereRaw("CONVERT(varchar, dt_cadastro, 23) between '".$request['dti']."' and '".$request['dtf']."' ")
        ->selectRaw("sum(tempo) valor")->first();
   
        $polpa = Estoque::whereRaw("CONVERT(varchar, DocDate, 23) between '".$request['dti']."' and '".$request['dtf']."' ")
        ->whereRaw("ItemCode='013906'")->selectRaw("sum(Quantity) valor")->first();

        $perdaGrupo = Perda::whereRaw("CONVERT(varchar, dt_ordem, 23) between '".$request['dti']."' and '".$request['dtf']."' ")
        ->selectRaw("count(qtde) valor, case when grupo = '103' then 'POLPA' when grupo = '105' then 'EMBALAGEM' when grupo = '109' then 'INSUMO' else 'OUTROS' end grupo")
        ->groupByRaw("case when grupo = '103' then 'POLPA' when grupo = '105' then 'EMBALAGEM' when grupo = '109' then 'INSUMO' else 'OUTROS' end")->get();
        
        $request['polpas']=0; 
        $request['embalagens']=0; 
        $request['insumos']=0; 
        $request['outros']=0;

        $grupoPerdas=null;
        
        foreach($perdaGrupo as $Tipos){
            
            if($Tipos->grupo=='POLPA'){ $request['polpas']=$Tipos->valor; }
            if($Tipos->grupo=='EMBALAGEM'){ $request['embalagens']=$Tipos->valor; }
            if($Tipos->grupo=='INSUMO'){ $request['insumos']=$Tipos->valor; }
            if($Tipos->grupo=='OUTROS'){ $request['outros']=$Tipos->valor; }

            $grupoPerdas[]=array( 
                "country"=>$Tipos->grupo,
                "litres"=>$Tipos->valor 
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

        $ProdKg=($ProduzidoKg) ? $ProduzidoKg : 0;
        $hidricos=($hidrico->valor) ? $hidrico->valor : 0;
        if(($hidricos==0) || ($ProdKg==0)){
            $AguaKg= number_format('0',4,",",".");    
        }else{
            $AguaKg= number_format(($hidricos/$ProdKg),4,",",".");
        }
         
        $energias=($energia->valor) ? $energia->valor : 0; 
        if(($energias==0) || ($ProdKg==0)){
            $EnergiaKg= number_format('0',4,",",".");
        }else{
            $EnergiaKg= number_format(($energias/$ProdKg),4,",",".");
        }
         
        $lenhas=($lenha->valor) ? $lenha->valor : 0;
        if(($lenhas==0) || ($ProdKg==0)){ 
            $LenhaKg= number_format('0',4,",",".");
        }else{
            $LenhaKg= number_format(($lenhas/$ProdKg),4,",",".");
        }
         
        $polpas=($polpa->valor) ? $polpa->valor : 0;
        if(($polpas==0) || ($ProdKg==0)){  
            $PolpaKg= number_format('0',4,",",".");
        }else{
            $PolpaKg= number_format(($polpas/$ProdKg),4,",",".");
        } 
  

        $request['Meses'] =$MES;
        $request['ProduzidoCxPerc'] =  ($ProduzidoCxPerc) ?  number_format($ProduzidoCxPerc,2,",",".") : '00';
        $request['ProduzidoKgPerc'] =  ($ProduzidoKgPerc) ?  number_format($ProduzidoKgPerc,2,",",".") : '00';
        $request['ProduzidoToPerc'] =  ($ProduzidoToPerc) ?  number_format($ProduzidoToPerc,2,",",".") : '00';

        $request['PlanejadoCx'] =  ($PlanejadoCx) ?  number_format($PlanejadoCx,0,",",".") : '000';
        $request['PlanejadoKg'] = ($PlanejadoKg) ?  number_format($PlanejadoKg,0,",",".") : '000';
        $request['PlanejadoTo'] = ($PlanejadoTo) ?  number_format($PlanejadoTo,2,",",".") : '0,00'; 
        $request['ProduzidoCx'] =  ($ProduzidoCx) ?  number_format($ProduzidoCx,0,",",".") : '000';
        $request['ProduzidoKg'] = ($ProduzidoKg) ?  number_format($ProduzidoKg,0,",",".") : '000';
        $request['ProduzidoTo'] = ($ProduzidoTo) ?  number_format($ProduzidoTo,2,",",".") : '0,00';
        $request['hidrico'] = ($hidrico->valor) ?  number_format(($hidrico->valor),2,",",".") : '0,00';
        $request['energia'] = ($energia->valor) ?  number_format($energia->valor,2,",",".") : '0,00';
        $request['lenha'] = ($lenha->valor) ?  number_format($lenha->valor,2,",",".") : '0,00';
        $request['perda'] = ($perda->valor) ?  number_format($perda->valor,0,",",".") : '00';
        $request['parada'] = ($parada->valor) ?  number_format($parada->valor,0,",",".") : '00';
        $request['polpa'] = ($polpa->valor) ?  number_format($polpa->valor,0,",",".") : '00';
        $request['datai'] = date('d/m/Y',strtotime($request['dti']));
        $request['dataf'] = date('d/m/Y',strtotime($request['dtf']));
        $request['AguaKg'] = $AguaKg;
        $request['EnergiaKg'] = $EnergiaKg;
        $request['LenhaKg'] = $LenhaKg;
        $request['PolpaKg'] = $PolpaKg;
        $retorno['previsto'] = $data;
        $retorno['prod_per'] = $prod_per; 
        $retorno['dadosProd'] = $dadosProd;
        $retorno['request'] = $request->toArray();
        $retorno['produtos'] = $Produtos;
        $retorno['ComparativoAno']=$ComparativoAno;
        $retorno['graficoAnos01'] = (isset($Anos[0]) ? $Anos[0] : null);
        $retorno['graficoAnos02'] = (isset($Anos[1]) ? $Anos[1] : null);
        $retorno['graficoAnos03'] = (isset($Anos[2]) ? $Anos[2] : null);
        $retorno['comparativo'] = $Comparativo; 
        $retorno['GraficoAgua'] = $Agua; 
        $retorno['GraficoEnergia'] = $Energia; 
        $retorno['GraficoLenha'] = $Lenha; 
        $retorno['GraficoPolpa'] = $Polpa;
        $retorno['GraficoParada'] = $Parada;
        $retorno['GraficoTp_parada']=$tipoParada;
        $retorno['GraficoPerda']=$Perda;
        $retorno['GraficoTpPerda']=$tipoPerda;
        $retorno['GraficoGrupoPerda']=$grupoPerdas;

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
                    (select sum(quantity) from SBO_KARAMBI_PRD.dbo.ign1 
                        where ign1.BaseRef=owor.DocEntry
                    ) valor_prod, owor.ItemCode ,
                    case 
                        when CONVERT(CHAR(10),owor.duedate, 23) <= '2024-03-18' and owor.ItemCode = '006283' then CONVERT(decimal(10,5), 7.2)
                        when CONVERT(CHAR(10),owor.duedate, 23)<= '2024-03-19' and owor.ItemCode = '006277' then CONVERT(decimal(10,5), 7.2)
                        when CONVERT(CHAR(10),owor.duedate, 23) <= '2024-03-22' and owor.ItemCode = '006280' then CONVERT(decimal(10,5), 7.2)
                        when CONVERT(CHAR(10),owor.duedate, 23) <= '2024-03-25' and owor.ItemCode = '006274' then CONVERT(decimal(10,5), 7.2)
                    else  CONVERT(decimal(10,5), SWeight1) end kg,ProdName nome 
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
            where CONVERT(CHAR(10),producao_parada.dt_cadastro, 23)  between '".$request['dti']."' and '".$request['dtf']."'
            order by 1 
            ");
            return view('colonial.producao.indicadores/xls_parada',compact('request','DADOS'));
        }
        if($tipo=='D'){
            $DADOS = DB::select("
            select cd_perda codigo,cd_ordem,cd_produto,nm_produto,qtde,dt_ordem,obs_perda,nm_tipo
            from perda 
            inner join  perda_tipo on perda_tipo.cd_tipo=perda.cd_tipo_perda
            where CONVERT(CHAR(10),perda.dt_cadastro, 23)  between '".$request['dti']."' and '".$request['dtf']."' 
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
