<?php

namespace App\Http\Controllers\Api;
use App\Bibliotecas\Kentro;
use App\Bibliotecas\ApiWaMe;
use App\Http\Controllers\Controller;
use App\Models\ConfigGeral;
use App\Models\Produto;
use App\Models\Sap\ordemProducao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class Rotinas extends Controller
{
    public function rotina_whast(Request $request)
    {
  
        try {
            
		    date_default_timezone_set('America/Sao_Paulo');
            $DATA=date('Y-m-d');
            $NumeroDia=date('w', strtotime($DATA));
            if(($NumeroDia>0) and ($NumeroDia<6)){


                if($NumeroDia==1){   
                    $DATAS[]= date('Y-m-d', strtotime('-3 day', strtotime($DATA)));  
                    $DATAS[]= date('Y-m-d', strtotime('-2 day', strtotime($DATA)));   
                }
                $DATAS[]= date('Y-m-d', strtotime('-1 day', strtotime($DATA))); 
                $ArraDia=array('0'=>'Domingo','1'=>'Segunda','2'=>'Terça','3'=>'Quarta','4'=>'Quinta','5'=>'Sexta','6'=>'Sábado');
                
                foreach ($DATAS as $key => $DT) {
                    $NumeroDia=date('w', strtotime($DT));
                    $NnDia=$ArraDia[$NumeroDia];
                    
                        $query=ordemProducao::whereRaw("FORMAT(DueDate, 'yyyy-MM-dd') = '".$DT."'")
                        ->join('SBO_KARAMBI_PRD.dbo.oitm','oitm.ItemCode','owor.ItemCode')
                        ->selectRaw("owor.DocEntry,owor.ItemCode,oitm.ItemName,FORMAT(owor.PlannedQty, 'N0') PlannedQty,FORMAT(owor.CmpltQty, 'N0') CmpltQty,FORMAT(DATEADD(day, -2, GETDATE()), 'dd/MM/yyyy hh:mm') data,FORMAT((( isnull(owor.CmpltQty,0) / isnull(owor.PlannedQty,0) )*100), 'N2') perc")
                        ->whereRaw("Uom='CX'")->orderBy("oitm.ItemName")->get();
                        $Prod=0;$Plan=0;
                        $texto="📍 *Produção: ". date('d/m/Y', strtotime($DT)) . " -  ( " . $NnDia . " )* \n `*** Data/Hora: ". date('d/mY H:i') ." ***`\n\n";
                        if(isset($query[0])){
                            foreach ($query as $key => $value) {
                                $Prod=($Prod+round($value->CmpltQty));
                                $Plan=($Plan+round($value->PlannedQty));
                                $texto=$texto."> 🍅 ".$value->ItemName."\n* _*Planejado:*_ ".  number_format(str_replace(',', '',$value->PlannedQty), 0, ',', '.') ."cx \n* _*Produzido:*_ ". number_format(str_replace(',', '',$value->CmpltQty), 0, ',', '.') ."cx \n* *". number_format(str_replace(',', '',$value->perc), 2, ',', '.') ."%* \n\n";
                            } 
                            if(($Plan + $Prod) > 0){
                                $texto=$texto."\n 🎯 *PERCENTUAL GERAL:* ".number_format(round(($Plan / $Prod)*100,2), 2, ',', '.') ."%";
                            }
                        }else{
                            $texto=$texto."\n> 🚫 Não Houve Produção ou até o dia `".date('d/m/Y H:i')."` Ainda não foi digitado no sistema.";
                        }
        
                        
                        $Empresa=ConfigGeral::find(1); 
                        $api = new ApiWaMe();
                        $dados = $api->sendTextMessage('120363400017473883@g.us',$texto,$Empresa);
                
                }

            }
 
            return response()->json(['Retorno'=>true]);

        }
        catch (Throwable $th) {
            return response()->json([
                'message' => 'Houve um erro ao cadastrar o produto.',
                'error' => $th->getMessage()
            ], 500);
        }
         
    }

    public function search(Request $request) {
        return Produto::where("nm_produto", "LIKE", "%{$request->q}%")->get();
    }
}
