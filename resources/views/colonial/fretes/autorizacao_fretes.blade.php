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
    <title>Impresso por: -- {{ $request['user'] }} </title>
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
        <table width="100%" border="0" style="font-size:14px; background:#ffffff; " cellspacing="0" cellpadding="0">
            <tr style="padding: 5px;">
                <td width="50%" style="text-align: left;">
                    <img src="{{ asset('assets/images/logo.jpg') }}" height="90" alt="">
                </td>
                <td width="50%" style=" text-align: right;">
                    <span style="font-size:17px; font-weight: bold;   "><br>AUTORIZAÇÃO DE PAGAMENTO DE FRETE</span>
                    <br>
                    <span style="font-size:14px;  font-weight: bold;  ">ROMANEIO Nº: {{ $romaneio->AbsEntry }}</span> <br>
                    <span style="font-size:14px;   ">KARAMBI ALIMENTOS LTDA</span> <br>
                    <span style="font-size:14px;   ">TIPO DE FRETE: PRODUTOS ACABADOS</span>
                </td>
            </tr>
        </table>

        <br>

        <table width="100%" border="0" style="font-size:13px; background:#ffffff; " cellspacing="0" cellpadding="0">
            <tr style="padding: 5px;">
                <td width="100%"
                    style="font-size:17px; padding: 8px; color: rgb(77, 74, 74); font-weight:bold; border-bottom: 2px solid rgb(77, 74, 74);">
                    DADOS DO FRETE
                </td>
            </tr>
        </table>
        <br>

        <table width="100%" border="0" style="font-size:13px;" cellspacing="0" cellpadding="0">
            <tr>
                <td width="50%" height="18" style="font-size:13px; "><b>ROMANEIO :</b> {{ $romaneio->AbsEntry }}</td>
                <td width="50%" height="18" style="font-size:13px;"><b>DATA:</b>  {{Carbon\Carbon::parse($romaneio->PickDate)->format('d/m/Y')}} </td>
            </tr>
            <tr>
                <td width="100%" colspan="2" height="18" style="font-size:13px;"><b>MOTORISTA:</b> {{ $romaneio->tab_motorista['CardFName'] }}</td>
            </tr>
            <tr>
                <td width="100%" colspan="2" height="18" style="font-size:13px;"><b>PROPRIETÁRIO:</b> -- </td>
            </tr>
            <tr>
                <td width="100%" colspan="2" height="18" style="font-size:13px;"><b>PLACA:</b> {{ $romaneio->tab_motorista['BillToDef'] }} </td>
            </tr>
            <tr>
                <td width="100%" colspan="2" height="18" style="font-size:13px;"><b>ROTA:</b> ITACARAMBI {{ $request['rota'] }} </td>
            </tr>
            <tr>
                <td width="50%" height="18" style="font-size:13px;"><b>qtde. Caixas:</b> {{  number_format($romaneio->tab_frete['qtde_entrega'],0,",",".") }} </td>
                <td width="50%" height="18" style="font-size:13px;"><b>peso Bruto:</b> {{  number_format($romaneio->tab_frete['peso'],2,",",".") }} </td>
            </tr>
            <tr>
                <td width="50%" height="18" style="font-size:13px;"><b>REFERENTE NOTA FISCAL:</b> {{ $romaneio->tab_frete['nf'] }} </td>
                <td width="50%" height="18" style="font-size:13px;"><b>VALOR DA CARGA:</b> {{  number_format($romaneio->tab_frete['vl_carga'],2,",",".") }} </td>
            </tr>
        </table>
        <br>
        <br>

        <table   style="font-size:13px;   border: 2px solid rgb(77, 74, 74);" cellspacing="5" cellpadding="5">

            <tr>
                <td colspan="6" valign="middle" height="25"
                    style="font-size:14px; text-align: center; border-bottom: 2px solid rgb(77, 74, 74); padding-top: 5px; font-weight: bold; font-style: italic">
                    COMPOSIÇÃO DO FRETE</td>
            </tr>
            <tr style="border-bottom: 1px solid rgb(77, 74, 74);">
                <td height="25" style="padding-top: 5px; padding-left: 5px;" colspan="2"><b> &#8594; DISTANCIA
                        PERCORRIDA</b></td>
                <td width="97" align="right" style="padding-top: 5px; padding-left: 5px;">{{  number_format($romaneio->tab_frete['distancia'],0,",",".") }} KM</td>
                <td width="100"></td>
                <td width="150">&nbsp;</td>
                <td width="150">&nbsp;</td>
            </tr>
            <tr style="">
                <td height="28" width="98" rowspan="2 " style="padding-top: 15px; padding-left: 5px; border-bottom: 1px solid rgb(77, 74, 74); "><b> &#8594; FRETE </b></td>
                <td width="108" style="padding-top: 5px; padding-left: 5px; text-align: right;"><b>VALOR/KM</b></td>
                <td style="padding-top: 5px; padding-left: 5px; text-align: right;"><b>FRETE</b></td>
                <td>&nbsp;</td>
                <td style="text-align: right; padding-top: 5px; padding-left: 5px;"> <b>Valores Adicionais</b></td>
                <td rowspan="2" style="padding-top: 11px; padding-left: 5px; text-align: right; font-weight: bold;">R$ {{  number_format($romaneio->tab_frete['vl_frete_total'],2,",",".") }}&nbsp;&nbsp; </td>
            </tr>
            <tr style="border-bottom: 1px solid rgb(77, 74, 74);">
                <td height="22" style="  padding-left: 5px; text-align: right;"> R$ {{  number_format($romaneio->tab_frete['vl_km'],2,",",".") }} </td>
                <td height="22" style="  padding-left: 5px; text-align: right;"> R$ {{  number_format($romaneio->tab_frete['vl_frete'],2,",",".") }} </td>
                <td>&nbsp;</td>
                <td style="text-align: right;"> R$ {{  number_format($romaneio->tab_frete['vl_frete_add'],2,",",".") }}&nbsp;&nbsp; </td>
            </tr>

            <tr style="border-bottom: 1px solid rgb(77, 74, 74);">
                <td height="25" style="padding-top: 5px; padding-left: 5px;"><b> &#8594; PEDAGIO</b></td>
                <td   style="padding-top: 5px; padding-left: 5px; text-align: right;">R$ {{  number_format($romaneio->tab_frete['vl_pedagio'],2,",",".") }}</td>
                <td colspan="3" style="padding-top: 7px; padding-left: 5px; text-align: right;">R$ {{  number_format($romaneio->tab_frete['vl_pedagio'],2,",",".") }}</td>
                <td  style="padding-top: 5px; padding-left: 5px; text-align: right; font-weight: bold;">R$ {{  number_format($romaneio->tab_frete['vl_pedagio'],2,",",".") }}&nbsp;&nbsp;</td>
            </tr>

            <tr  >
                <td height="22" rowspan="2" style="border-bottom: 1px solid rgb(77, 74, 74); padding-top: 12px; padding-left: 5px;"><b> &#8594; DESCARGAS</td>
                <td style="padding-top: 5px; padding-left: 5px; text-align: right; font-weight: bold;">CAIXAS</td>
                <td style="padding-top: 5px; padding-left: 5px; text-align: right; font-weight: bold;">VALOR </td>
                <td style="padding-top: 5px; padding-left: 5px; text-align: right; font-weight: bold;">PAL. / TON.</td>
                <td style="padding-top: 5px; padding-left: 5px; text-align: right; font-weight: bold;">VALOR</td>
                <td rowspan="2" style="padding-top: 11px; padding-left: 5px; text-align: right; font-weight: bold;">R$ {{  number_format($romaneio->tab_frete['vl_descarga_total'],2,",",".") }}&nbsp;&nbsp;</td>
            </tr>
            <tr style="border-bottom: 1px solid rgb(77, 74, 74);">
                <td height="22" style="  padding-left: 5px; text-align: right" >{{  number_format($romaneio->tab_frete['nr_caixa'],0,",",".") }}</td>
                <td style="  padding-left: 5px; text-align: right" >R$ {{  number_format($romaneio->tab_frete['vl_unidade'],2,",",".") }}</td>
                <td style="  padding-left: 5px; text-align: right" >{{  number_format($romaneio->tab_frete['pal_ton'],0,",",".") }}</td>
                <td style="  padding-left: 5px; text-align: right" >R$ {{  number_format($romaneio->tab_frete['vl_descarga'],2,",",".") }}</td>
            </tr>
            <tr style="border-bottom: 1px solid rgb(77, 74, 74);">
                <td height="28" style="padding-top: 7px; padding-left: 5px;"><b> &#8594; ENTREGAS</td>
                <td style=" padding-top: 7px; padding-left: 5px; text-align: right"><b>Qtde.</b>&nbsp;&nbsp;{{  number_format($romaneio->tab_frete['qtde_entrega'],0,",",".") }}</td>
                <td style=" padding-top: 7px; padding-left: 5px; text-align: right" colspan="3"><b> Valor</b> &nbsp;&nbsp; R$ {{  number_format($romaneio->tab_frete['vl_entrega'],2,",",".") }}</td>
                <td  style="padding-top: 7px; padding-left: 5px; text-align: right; font-weight: bold;">R$ {{  number_format($romaneio->tab_frete['vl_entrega_total'],2,",",".") }} &nbsp;&nbsp;</td>
            </tr>
            <tr style="border-bottom: 1px solid rgb(77, 74, 74);">
                <td height="25" style="padding-top: 5px; padding-left: 5px;"><b> &#8594;  OUTROS</td>
                <td colspan="3">&nbsp;</td>
                <td style=" padding-top: 5px; padding-left: 5px; text-align: right;"><b> Valor</b> &nbsp;&nbsp; R$ {{  number_format($romaneio->tab_frete['vl_outros'],2,",",".") }}</td>
                <td style=" padding-top: 5px; padding-left: 5px; text-align: right; font-weight: bold;"> R$  {{  number_format($romaneio->tab_frete['vl_outros'],2,",",".") }}&nbsp;&nbsp;</td>
            </tr>
       
            <tr>
                <td height="25" colspan="5">&nbsp;</td>
                <td style="text-align: right; padding-top: 3px; font-size: 14px; font-weight: 900;"  >R$ {{  number_format(($romaneio->tab_frete['vl_outros']+$romaneio->tab_frete['vl_entrega_total']+$romaneio->tab_frete['vl_descarga_total'] + $romaneio->tab_frete['vl_pedagio'] +$romaneio->tab_frete['vl_frete_total'] ),2,",",".") }}&nbsp;&nbsp;</td>
            </tr>
        </table>
 
      
        <br>
        <br>
        <br>
        <table width="100%" border="0" style="font-size:14px; background:#ffffff; " cellspacing="0" cellpadding="0">
            <tr style="padding: 5px;">
                <td width="100%"
                    style="font-size:17px; padding: 8px; color: rgb(77, 74, 74); font-weight:bold; border-bottom: 2px solid rgb(77, 74, 74); text-align: center;">
                    TERMO DE COMPROMISSO
                </td>
            </tr>
        </table>
        <br>

        <table width="90%" border="0" style="font-size:13px; margin-left: 5% " cellspacing="0" cellpadding="0">

            <tr>
                <th width="90%" style="font-size:12px; text-align: justify; margin-left: 5%   ">Declaro para os devido
                    fins, que assumo junto a Karambi Alimentos Ltda a responsabilidade total pela carga e
                    inclusive sobre multas que venham a incidir sobre o valor das notas fiscais em função do vencimento
                    e prazo de validade das mesmas, durante o percuso,
                    por culpa do motorista ou do proprietario do veiculo, em não cumprir a legislação.
                </th>
            </tr>
        </table>
        <br>
        <br>

        <table width="90%" border="0" style="  margin-left: 5%;  " cellspacing="0" cellpadding="0">
            <tr>
                <th width="40%" style="font-size:19px; text-align: justify; font-style: italic">&nbsp;&nbsp;Itacarambi,
                    &nbsp;&nbsp;&nbsp; {{ date('d/m/Y') }}
                </th>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <br>
        <table width="100%" border="0" style="font-size:13px;  " cellspacing="0" cellpadding="0">

            <tr>
                <th width="50%" style="font-size:12px; text-align: center;   ">
                    ___________________________________<br>SETOR DE FATURAMENTO/ TRANSPORTES
                </th>

                <th width="50%" style="font-size:12px; text-align: center;   ">
                    ___________________________________<br>GILBERTO RIBEIRO RESENDE<br>MOTORISTA
            </tr>

        </table>
        <br> <br> <br>

    </div>

    </div>

</body>

</html>