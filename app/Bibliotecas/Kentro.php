<?php

namespace App\Bibliotecas;

use App\Model\rpclinica\Empresa;
use App\Models\ConfigGeral;
use Exception;
use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;


class Kentro {
   
	
	public function __construct(){
		set_time_limit(0);
		date_default_timezone_set('America/Sao_Paulo');
		header('Access-Control-Allow-Origin: *');
	}
	 
	public function enqueueMessageToSend($numero,$texto,$xData=null){ 
	  
		$empresa=ConfigGeral::find(1); 
		 
		if(($empresa->key_kentro) and ($empresa->url_kentro) and ($empresa->fila_kentro)){
		
		   $body['queueId']=$empresa->fila_kentro;
		   $body['apiKey']=$empresa->key_kentro;  
		   $body['number']=$numero; 
		   $body['text']=$texto;  
		   $body['extData']=$xData;
	 
		   $ch = curl_init(); 
		   curl_setopt($ch, CURLOPT_URL, $empresa->url_kentro . 'int/enqueueMessageToSend' );
		   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		   curl_setopt($ch, CURLOPT_POST, 1);
		   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
		   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json') );
	 
		   $protocol = (isset($_SERVER['HTTP_CF_VISITOR'])) ? 'https' : 'http';
		   if($protocol=='http'){
			  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		   }
		      
		   $result = curl_exec($ch);
		   curl_close($ch);
	   
		   return ['retorno'=>true,'dados'=>$result];
  
		}else{
  
		   return ['retorno'=>false,'dados'=>' Sistema não configurado!'];
  
		}
  
	}
	
	public function getQueueQrCode(){ 
	  
		$empresa=ConfigGeral::find(1); 
		if(($empresa->api_whast=='kentro') and ($empresa->key_kentro) and ($empresa->url_kentro) and ($empresa->fila_kentro)){
		
		   $body['queueId']=$empresa->fila_kentro;
		   $body['apiKey']=$empresa->key_kentro;   
	 
		   $ch = curl_init(); 
		   curl_setopt($ch, CURLOPT_URL, $empresa->url_kentro . 'int/getQueueQrCode' );
		   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		   curl_setopt($ch, CURLOPT_POST, 1);
		   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
		   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json') );
	 
		   $protocol = (isset($_SERVER['HTTP_CF_VISITOR'])) ? 'https' : 'http';
		   if($protocol=='http'){
			  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		   }
		      
		   $result = curl_exec($ch);
		   curl_close($ch);
	   
		   return ['retorno'=>true,'dados'=>$result];
  
		}else{
  
		   return ['retorno'=>false,'dados'=>' Sistema não configurado!'];
  
		}
  
	}
 
	public function enableQueue(){ 
	  
		$empresa=ConfigGeral::find(1); 
		if(($empresa->api_whast=='kentro') and ($empresa->key_kentro) and ($empresa->url_kentro) and ($empresa->fila_kentro)){
		
		   $body['queueId']=$empresa->fila_kentro;
		   $body['apiKey']=$empresa->key_kentro;  
	 
		   $ch = curl_init(); 
		   curl_setopt($ch, CURLOPT_URL, $empresa->url_kentro . 'int/enableQueue' );
		   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		   curl_setopt($ch, CURLOPT_POST, 1);
		   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
		   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json') );
	 
		   $protocol = (isset($_SERVER['HTTP_CF_VISITOR'])) ? 'https' : 'http';
		   if($protocol=='http'){
			  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		   }
		      
		   $result = curl_exec($ch);
		   curl_close($ch);
	   
		   return ['retorno'=>true,'dados'=>$result];
  
		}else{
  
		   return ['retorno'=>false,'dados'=>' Sistema não configurado!'];
  
		}
  
	}

	public function connectQueue(){ 
	  
		$empresa=ConfigGeral::find(1); 
		if(($empresa->api_whast=='kentro') and ($empresa->key_kentro) and ($empresa->url_kentro) and ($empresa->fila_kentro)){
		
		   $body['queueId']=$empresa->fila_kentro;
		   $body['apiKey']=$empresa->key_kentro;  
	 
		   $ch = curl_init(); 
		   curl_setopt($ch, CURLOPT_URL, $empresa->url_kentro . 'int/connectQueue' );
		   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		   curl_setopt($ch, CURLOPT_POST, 1);
		   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
		   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json') );
	 
		   $protocol = (isset($_SERVER['HTTP_CF_VISITOR'])) ? 'https' : 'http';
		   if($protocol=='http'){
			  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		   }
		      
		   $result = curl_exec($ch);
		   curl_close($ch);
	   
		   return ['retorno'=>true,'dados'=>$result];
  
		}else{
  
		   return ['retorno'=>false,'dados'=>' Sistema não configurado!'];
  
		}
  
	}
	
	public function getQueueStatus(){ 
	  
		$empresa=ConfigGeral::find(1); 
		if(($empresa->api_whast=='kentro') and ($empresa->key_kentro) and ($empresa->url_kentro) and ($empresa->fila_kentro)){
		
		   $body['queueId']=$empresa->fila_kentro;
		   $body['apiKey']=$empresa->key_kentro;  
	 
		   $ch = curl_init(); 
		   curl_setopt($ch, CURLOPT_URL, $empresa->url_kentro . 'int/getQueueStatus' );
		   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		   curl_setopt($ch, CURLOPT_POST, 1);
		   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
		   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','charset=utf-8') );
	 
		   $protocol = (isset($_SERVER['HTTP_CF_VISITOR'])) ? 'https' : 'http';
		   if($protocol=='http'){
			  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		   }
		      
		   $result = curl_exec($ch);
		   curl_close($ch);
	   
		   return ['retorno'=>true,'dados'=>$result];
  
		}else{
  
		   return ['retorno'=>false,'dados'=>' Sistema não configurado!'];
  
		}

		 
	}
	 
	public function logoutQueue(){ 
	  
		$empresa=ConfigGeral::find(1); 
		if(($empresa->api_whast=='kentro') and ($empresa->key_kentro) and ($empresa->url_kentro) and ($empresa->fila_kentro)){
		
		   $body['queueId']=$empresa->fila_kentro;
		   $body['apiKey']=$empresa->key_kentro;  
	 
		   $ch = curl_init(); 
		   curl_setopt($ch, CURLOPT_URL, $empresa->url_kentro . 'int/logoutQueue' );
		   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		   curl_setopt($ch, CURLOPT_POST, 1);
		   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
		   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json') );
	 
		   $protocol = (isset($_SERVER['HTTP_CF_VISITOR'])) ? 'https' : 'http';
		   if($protocol=='http'){
			  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		   }
		      
		   $result = curl_exec($ch);
		   curl_close($ch);
	   
		   return ['retorno'=>true,'dados'=>$result];
  
		}else{
  
		   return ['retorno'=>false,'dados'=>' Sistema não configurado!'];
  
		}
  
	}

   public function checkIfUserExists($numero){ 
	  
	$empresa=ConfigGeral::find(1); 
	if(($empresa->api_whast=='kentro') and ($empresa->key_kentro) and ($empresa->url_kentro) and ($empresa->fila_kentro)){
	
	     $body['queueId']=$empresa->fila_kentro;
	     $body['apiKey']=$empresa->key_kentro;   
         $body['number']=$numero; 
         $body['country']='BR'; 
   
         $ch = curl_init(); 
         curl_setopt($ch, CURLOPT_URL, $empresa->url_kentro . 'int/checkIfUserExists' );
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
         curl_setopt($ch, CURLOPT_POST, 1);
         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','charset=utf-8') );
   
         $protocol = (isset($_SERVER['HTTP_CF_VISITOR'])) ? 'https' : 'http';
         if($protocol=='http'){
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
         }
   
         $result = curl_exec($ch);
         curl_close($ch);
     
         return ['retorno'=>true,'dados'=>$result];

      }else{

         return ['retorno'=>false,'dados'=>' Sistema não configurado!'];

      }
       

	}

	public function getEtiquetas(){ 
	  
		$empresa=ConfigGeral::find(1); 
		if(($empresa->api_whast=='kentro') and ($empresa->key_kentro) and ($empresa->url_kentro) and ($empresa->fila_kentro)){
		
			$body['queueId']=$empresa->fila_kentro;
			$body['apiKey']=$empresa->key_kentro;   

			$ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL, $this->url . 'int/getTags' );
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','charset=utf-8') );

			$protocol = (isset($_SERVER['HTTP_CF_VISITOR'])) ? 'https' : 'http';
			if($protocol=='http'){
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			}

			$result = curl_exec($ch);
			curl_close($ch);
			return ['retorno'=>true,'dados'=>$result];

		}
		 
	}

	public function createUsuario($body){
	  
		$empresa=ConfigGeral::find(1); 
		if(($empresa->api_whast=='kentro') and ($empresa->key_kentro) and ($empresa->url_kentro) and ($empresa->fila_kentro)){
		
			$body['queueId']=$empresa->fila_kentro;
			$body['apiKey']=$empresa->key_kentro;  
  
			$ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL, $this->url . 'int/addContact' );
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','charset=utf-8') );

			$protocol = (isset($_SERVER['HTTP_CF_VISITOR'])) ? 'https' : 'http';
			if($protocol=='http'){
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			}

			$result = curl_exec($ch);
			curl_close($ch);
	
			return $result;

		}
	}

}

