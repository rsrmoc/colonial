<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="{{ asset('assets/relatorio/960.css') }}">
<link rel="stylesheet" href="{{ asset('assets/relatorio/reset.css') }}">
<link rel="stylesheet" href="{{ asset('assets/relatorio/style.css') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/colonial_conservas-42x42.png') }}">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Impresso por: -- </title>
</head>
<style type="text/css">
    body {
        text-transform: uppercase;

    }
</style>

<body style="font-family:Verdana, Geneva, Tahoma, sans-serif; ">

    <div align="center" class="container_16 corpo">
        <div style="text-align: center;">

        </div>
      
 
        <br>
        <br>

        @for($i = 1; $i <= 2; $i++)
            
        <table   style="font-size:13px; width:100%;   border: 2px solid rgb(77, 74, 74);" cellspacing="5" cellpadding="5"> 
            <tr>
                <td   valign="middle" height="35"  style="font-size:20px; text-align: center; border-bottom: 2px solid rgb(77, 74, 74); padding-top: 2px; 
                font-weight: bold; width: 30%  "> <img src="{{ asset('assets/images/logo2.jpg') }}" height="40" alt=""> </td>
                <td   valign="middle" height="35"  style="font-size:20px; text-align: left; border-bottom: 2px solid rgb(77, 74, 74); padding-top: 7px; 
                    font-weight: bold; width: 70%  ">  
                        KARAMBI ALIMENTOS LTDA</td>
            </tr>
            <tr>
                <td  colspan="2" valign="middle" height="25"  style="font-size:15px; text-align: center; border-bottom: 2px solid rgb(77, 74, 74); padding-top: 7px; 
                font-weight: bold;  ">
                    PLANILHA DE ADIANTAMENTO DE AUTÔNOMO - RPA</td>
            </tr>
        </table>
        <table   style="font-size:13px; width:100%;   border: 2px solid rgb(77, 74, 74);" cellspacing="5" cellpadding="5"> 

            <tr style="border-bottom: 1px solid rgb(77, 74, 74);">
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px;" width="200" ><b> NOME DO AUTÕNOMO:</b></td>
                <td  style="padding-top: 5px; padding-left: 5px;">{{ $romaneio->tab_frete->distancia }} KM</td> 
            </tr> 
        </table>
        <table   style="font-size:13px; width:100%;   border: 2px solid rgb(77, 74, 74);" cellspacing="5" cellpadding="5">  
            <tr style="border-bottom: 1px solid rgb(77, 74, 74);">
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 30%; "  ><b> RUA:</b> --</td>
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 15%; " ><b> N°:</b> {{ $romaneio->tab_motorista->GroupNum }} </td>
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 20%; " ><b> CEP:</b> {{ $romaneio->tab_motorista->MailZipCod }}</td>
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 35%; " ><b> EMPRESA:</b> --</td>
            </tr> 
        </table>
        <table   style="font-size:13px; width:100%;   border: 2px solid rgb(77, 74, 74);" cellspacing="5" cellpadding="5">  
            <tr style="border-bottom: 1px solid rgb(77, 74, 74);">
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 30%; "  ><b> BAIRRO:</b> --</td>
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 30%; " ><b> CIDADE:</b> {{ $romaneio->tab_motorista->Address }}</td>
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 15%; " ><b> UF:</b>  MG</td>
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 25%; " ><b> DATA:</b>{{Carbon\Carbon::parse($romaneio->PickDate)->format('d/m/Y')}}</td>
            </tr> 
        </table>
        <table   style="font-size:13px; width:100%;   border: 2px solid rgb(77, 74, 74);" cellspacing="5" cellpadding="5">  
            <tr style="border-bottom: 1px solid rgb(77, 74, 74);">
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 34%; "  ><b> NIT / PIS:</b> {{ $romaneio->tab_motorista->U_nfe_RNTC }} </td>
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 33%; " ><b>  CPF:</b> {{ $romaneio->tab_motorista->U_UPD_CPF }} </td>
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 33%; " ><b> PERÍODO:</b> </td> 
            </tr> 
        </table>
        <table   style="font-size:13px; width:100%;   border: 2px solid rgb(77, 74, 74);" cellspacing="5" cellpadding="5">  
            <tr style="border-bottom: 1px solid rgb(77, 74, 74);">
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 30%; "  ><b> IDENTIDADE:</b> </td>
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 30%; " ><b>  CNH:</b> </td>
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 40%; " ><b> CONTRATO:</b> </td> 
            </tr> 
        </table>
        <table   style="font-size:13px; width:100%;   border: 2px solid rgb(77, 74, 74);" cellspacing="5" cellpadding="5">  
            <tr style="border-bottom: 1px solid rgb(77, 74, 74);">
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 5%; "  ><b> Item </b> </td>
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 47%; " ><b>  Discriminação do Serviço </b> </td>
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 12%; text-align: center " ><b> Unidade de Medida</b> </td> 
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 12%; text-align: center " ><b> Preço<br>Total</b> </td> 
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 12%; text-align: center " ><b> Percentual Adiantado</b> </td> 
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 12%; text-align: center " ><b> Valor<br>Pagar</b> </td> 
            </tr> 
        
            <tr style="border-bottom: 1px solid rgb(77, 74, 74);">
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 5%; "  ><b>  1 </b> </td>
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 47%; text-transform: none; font-size: 14px; " >   Transporte de Produtos Acabados  </td>
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 12%;   " > Adiantamento  </td> 
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 12%;text-align: right  " > 100,00%</td> 
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 12%; text-align: right " > R$ -- &nbsp;&nbsp;</td> 
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 12%; text-align: right " > R$ --&nbsp;&nbsp;  </td> 
            </tr> 
            <tr style="border-bottom: 1px solid rgb(77, 74, 74);">
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 5%; "  ><b>  2 </b> </td>
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 47%; text-transform: none; font-size: 14px; " > Desconto de INSS </td>
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 12%;   " >    </td> 
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 12%;text-align: right  " > 11,00% </td> 
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 12%; text-align: right " >  &nbsp;&nbsp;</td> 
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 12%; text-align: right " > {{  number_format($romaneio->tab_frete['vl_inss'],2,",",".") }}&nbsp;&nbsp;  </td> 
            </tr> 
            <tr style="border-bottom: 1px solid rgb(77, 74, 74);">
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 5%; "  ><b>  3 </b> </td>
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 47%; text-transform: none; font-size: 14px; " > Desconto de SEST/SENAT  </td>
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 12%;   " >    </td> 
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 12%;text-align: right  " > 2,50% </td> 
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 12%; text-align: right " >  &nbsp;&nbsp;</td> 
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 12%; text-align: right " > {{  number_format($romaneio->tab_frete['vl_senat'],2,",",".") }}&nbsp;&nbsp;  </td> 
            </tr> 
            <tr style="border-bottom: 1px solid rgb(77, 74, 74);">
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 5%; "  ><b> 4  </b> </td>
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 47%; text-transform: none; font-size: 14px; " > Desconto de IRRF Acumulado Mês  </td>
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 12%;   " >    </td> 
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 12%;text-align: right  " >  </td> 
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 12%; text-align: right " >  &nbsp;&nbsp;</td> 
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 12%; text-align: right " > {{  number_format($romaneio->tab_frete['vl_irrf'],2,",",".") }}&nbsp;&nbsp;  </td> 
            </tr>
            <tr style="border-bottom: 1px solid rgb(77, 74, 74);">
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 5%; "  ><b> 5  </b> </td>
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 47%;   font-size: 14px; font-weight: bold; " > T O T A L ADIANTAMENTO =====>
                </td>
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 12%;   " >    </td> 
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 12%;text-align: right  " >  </td> 
                <td   style="padding-top: 2px; padding-left: 5px; padding-bottom: 2px; width: 12%; text-align: right " >  &nbsp;&nbsp;</td> 
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 12%; text-align: right; font-weight: bold; font-size: 14px; " > R$ 3.386,04&nbsp;&nbsp;  </td> 
            </tr>  
        </table>
        <table   style="font-size:13px; width:100%;   border: 2px solid rgb(77, 74, 74);" cellspacing="5" cellpadding="5">  
            <tr style="border-bottom: 1px solid rgb(77, 74, 74);">
                <td   style="padding-top: 5px; padding-left: 5px; padding-bottom: 5px; width: 100%; text-transform: none; "  >OBS. Os descontos de INSS e SEST/SENAT serão descontados ao ser efetuado o pagamento dos 30% restantes do valor do frete. O IRRF será apurado no acumulado do período, 
                    conforme alíquotas vigentes.
                     </td> 
            </tr> 
        </table>
        <table   style="font-size:13px; width:100%;   border: 2px solid rgb(77, 74, 74);" cellspacing="5" cellpadding="5">  
            <tr style="border-bottom: 1px solid rgb(77, 74, 74);">
                <td   style="padding-top: 15px; padding-left: 5px; padding-bottom: 5px; width: 33%; text-align: center;font-weight: bold;  "  > Autônomo </td> 
                <td   style="padding-top: 15px; padding-left: 5px; padding-bottom: 5px; width: 33%; text-align: center;font-weight: bold; "  > Requisitante </td> 
                <td   style="padding-top: 15px; padding-left: 5px; padding-bottom: 5px; width: 33%; text-align: center;font-weight: bold; "  > Autorização (Gerente Adm) </td> 
            </tr> 
        </table>
        <table   style="font-size:13px; width:100%;   border: 2px solid rgb(77, 74, 74);" cellspacing="5" cellpadding="5">  
            <tr style="border-bottom: 1px solid rgb(77, 74, 74);">
                <td   style="  padding-left: 5px; padding-bottom: 5px; width: 33%; text-align: left; border-right: 1px solid black;  "  > Nome: <br><br><br>Ass.____________________________<br>Nome do Autonomo </td> 
                <td   style="  padding-left: 5px; padding-bottom: 5px; width: 33%; text-align: left; border-right: 1px solid black;  "   > Nome <br><br><br>Ass.____________________________<br>RAIMUNDO NONATO </td> 
                <td   style="  padding-left: 5px; padding-bottom: 5px; width: 33%; text-align: left;    "   > Nome <br><br><br>Ass.____________________________<br>&nbsp;</td> 
            </tr> 
        </table>
      
 
        <br> 
        <br> 
        <br> 
        <br>
        
        @endfor
        <br> 
        <br>
        <br>
    

    </div>

    </div>

</body>

</html>