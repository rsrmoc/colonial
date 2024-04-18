<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>XLS</title>
</head>

<body>
<?php
  
 header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
 header ("Cache-Control: no-cache, must-revalidate");
 header ("Pragma: no-cache");
 header ("Content-type: application/x-msexcel");
 header ("Content-Disposition: attachment; filename=\"Producao".date('d_m_Y_H_i').".xls\"" );
 header ("Content-Description: RP Sys " );
  
 
?>
 <style type="text/css">
    .blue {
        color: #0072c6 !important;
    }
    table{
        text-transform: uppercase;
    }
    .center{ text-align: center; }
    .right{ text-align: right;}
    .left{ text-align: left;}
	.red {
		color: red;
	}
</style> 
 <?php 
				 echo '
					 <table cellpadding="0" style="font-family: verdana,arial; font-size: 11px; text-align: left;" cellspacing="2" border="1">
					 <thead> 
					 <tr>
						  <th height="30" bgcolor="#E2E2E2">CODIGO</th>
						  <th height="30" bgcolor="#E2E2E2">NOME</th>
						  <th height="30" bgcolor="#E2E2E2">DATA</th> 
						  <th bgcolor="#E2E2E2">KG</th>   
						  <th bgcolor="#E2E2E2">PLANEJADO CX</th>   
						  <th bgcolor="#E2E2E2">PLANEJADO KG</th>    
						  <th bgcolor="#E2E2E2">PLANEJADO TO</th>  
						  <th bgcolor="#E2E2E2">PRODUZIDO CX</th>  
						  <th bgcolor="#E2E2E2">PRODUZIDO KG</th> 
						  <th bgcolor="#E2E2E2">PRODUZIDO TO</th> 
					 </tr> 
					 </thead>
					 <tbody>
				 ';
						 
				 foreach ($DADOS as $val) { 
					 echo ' 
					 <tr>
						<td>'.mb_strtoupper($val->codigo).'</td>
						<td>'.mb_strtoupper($val->nome).'</td>
						<td>'.substr($val->data,0,10).' </td>
						<td>'.mb_strtoupper($val->kg).'</td>
						<td>'.number_format($val->planejado_cx,2,",",".").'</td>
						<td>'.number_format($val->planejado_kg,2,",",".").'</td>  
						<td>'.number_format($val->planejado_to,2,",",".").'</td> 
						<td>'.number_format($val->produzido_cx,2,",",".").'</td> 
						<td>'.number_format($val->produzido_kg,2,",",".").'</td> 
						<td>'.number_format($val->produzido_to,2,",",".").'</td>  
					 </tr>'; 
				 }
				  
	
 ?>
</body>
</html>
