<x-layout.colonial.layout>
<style>
.info-box-title {
    display: block;
    font-size: 15px;
    margin-bottom: 5px;
    margin-top: 5px;
    color: #B0B0B0;
}
#chartDetalhe {
  width: 100%;
  height: 500px;
}

.amcharts-export-menu-top-right {
  top: 10px;
  right: 0;
}

#chart-1 {
  width: 100%; 
}
#chart-prev_realizado {
    width: 100%;
    height: 500px;
}




 .topstats {
    background: #fff;
    padding: 0;
    color: #76747A;
    position: relative;
    font-size: 12px;
    border-radius: 3px;
    margin-left: -5px;
    margin-right: -5px;
    text-shadow: none;
    padding: 12px 0;
}
  
#chartdivMoagemEstoque, #chartdivMoagemConsumida,#chartdivMoagemTotal,#chartdivFornecedor
{
  width: 100%;
  height: 500px;
}

#chartdiv_parada, #chartdiv_polpa, #chartdivPercProd, #chartdiv_agua, #chartdiv_energia, #chartdiv_lenha,  #chartdiv_Equip_parada
{
  width: 100%;
  height: 350px;
}

#chartdiv_grupo_perda 
{
  width: 100%;
  height: 250px;
}

#chartdiv_tp_parada
{
  width: 100%;
  height: 450px;
}

#chartdiv_perda
{
  width: 100%;
  height: 300px;
}
  
ul, ol {
    margin-top: 0;
    margin-bottom: 10px;
}
ul {
    display: block;
    list-style-type: disc; 
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    padding-inline-start: 40px;
    unicode-bidi: isolate;
}

.topstats .arrow {
    position: absolute;
    width: 0;
    height: 0;
    top: -18px;
    right: 5px;
    border-style: solid;
    border-width: 0 10px 10px 10px;
    border-color: transparent transparent #fff transparent;
}

.topstats li {
    display: block;
    text-align: center;
    margin: 10px 0;
}
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
user agent stylesheet
li {
    display: list-item;
    text-align: -webkit-match-parent;
    unicode-bidi: isolate;
}
.topstats .title {
    color: #37363E;
    font-weight: 600;
    font-size: 13px;
}

* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.topstats li {
    display: block;
    text-align: center;
    margin: 10px 0;
}
user agent stylesheet
li {
    text-align: -webkit-match-parent;
}
.topstats {
    background: #fff;
    padding: 0;
    color: #76747A;
    position: relative;
    font-size: 12px;
    border-radius: 3px;
    margin-left: -5px;
    margin-right: -5px;
    text-shadow: none;
    padding: 12px 0;
}
user agent stylesheet
ul {
    list-style-type: disc;
}

.topstats h3 {
    font-size: 28px;
    font-weight: bold;
    font-family: 'Montserrat', sans-serif;
    letter-spacing: -1px;
    line-height: normal;
    margin: 1px 0;
}

h3, .h3 {
    font-size: 1.75em;
}
h1, .h1, h2, .h2, h3, .h3 {
    margin-top: 20px;
    margin-bottom: 10px;
    letter-spacing: -0.02em;
}
h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
    font-family: inherit;
    font-weight: 400;
    line-height: 1.6;
    color: #37363E;
}
h3, .h3 {
    font-size: 24px;
}
h1, .h1, h2, .h2, h3, .h3 {
    margin-top: 20px;
    margin-bottom: 10px;
}
h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
    font-family: inherit;
    font-weight: 500;
    line-height: 1.1;
    color: inherit;
}
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
user agent stylesheet
h3 {
    display: block;
    font-size: 1.17em;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
    unicode-bidi: isolate;
}
.topstats li {
    display: block;
    text-align: center;
    margin: 10px 0;
}

user agent stylesheet
li {
    text-align: -webkit-match-parent;
}
.topstats {
    background: #fff;
    padding: 0;
    color: #76747A;
    position: relative;
    font-size: 12px;
    border-radius: 3px;
    margin-left: -5px;
    margin-right: -5px;
    text-shadow: none;
    padding: 12px 0;
}
user agent stylesheet
ul {
    list-style-type: disc;
}
.color-up {
    color: #26A65B;
}
.color-down {
    color: #EF4836;
}

.color-warning {
    color: #f0ad4e;
}
 
.color-agua {
    color: #399BFF;
}

.color-lenha {
    color: #c2a505;
}
.color-polpa {
    color: #e83e8c;
}
 
</style>


<style>
    @media (max-width: 575.98px) {
      .modal-fullscreen {
        padding: 0 !important;
      }
      .modal-fullscreen .modal-dialog {
        width: 100%;
        max-width: none;
        height: 100%;
        margin: 0;
      }
      .modal-fullscreen .modal-content {
        height: 100%;
        border: 0;
        border-radius: 0;
      }
      .modal-fullscreen .modal-body {
        overflow-y: auto;
      }
    }
    @media (max-width: 767.98px) {
      .modal-fullscreen-sm {
        padding: 0 !important;
      }
      .modal-fullscreen-sm .modal-dialog {
        width: 100%;
        max-width: none;
        height: 100%;
        margin: 0;
      }
      .modal-fullscreen-sm .modal-content {
        height: 100%;
        border: 0;
        border-radius: 0;
      }
      .modal-fullscreen-sm .modal-body {
        overflow-y: auto;
      }
    }
    @media (max-width: 991.98px) {
      .modal-fullscreen-md {
        padding: 0 !important;
      }
      .modal-fullscreen-md .modal-dialog {
        width: 100%;
        max-width: none;
        height: 100%;
        margin: 0;
      }
      .modal-fullscreen-md .modal-content {
        height: 100%;
        border: 0;
        border-radius: 0;
      }
      .modal-fullscreen-md .modal-body {
        overflow-y: auto;
      }
    }
    @media (max-width: 1199.98px) {
      .modal-fullscreen-lg {
        padding: 0 !important;
      }
      .modal-fullscreen-lg .modal-dialog {
        width: 100%;
        max-width: none;
        height: 100%;
        margin: 0;
      }
      .modal-fullscreen-lg .modal-content {
        height: 100%;
        border: 0;
        border-radius: 0;
      }
      .modal-fullscreen-lg .modal-body {
        overflow-y: auto;
      }
    }
    .modal-fullscreen-xl {
      padding: 0 !important;
    }
    .modal-fullscreen-xl .modal-dialog {
      width: 100%;
      max-width: none;
      height: 100%;
      margin: 0;
    }
    .modal-fullscreen-xl .modal-content {
      height: 100%;
      border: 0;
      border-radius: 0;
    }
    .modal-fullscreen-xl .modal-body {
      overflow-y: auto;
    }
     
  
    .container_modal {
        display: flex;
        margin: 10px;
        column-gap: 10px;
    }
        
    .scrollbar {
        height: 500px;
        width: 100%;
        overflow: auto;
        padding: 0 10px;
    }
    #scrollbar3::-webkit-scrollbar {
       width: 12px;
    }
        
    #scrollbar3::-webkit-scrollbar-track {
        background-color: #e7e7e7;
        border: 1px solid #cacaca;
    }
        
    #scrollbar3::-webkit-scrollbar-thumb {
        background-color: #0D8ECF;
    }

 

    .bg-info, .bg-info>a {
        color: #fff !important;
    }
    .bg-info {
        background-color: #17a2b8 !important;
    }
    .small-box {
        border-radius: .25rem;
        box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
        display: block;
        margin-bottom: 20px;
        position: relative;
    }

    .small-box>.inner {
        padding: 7px;
    }

    .small-box .icon {
        color: rgba(0, 0, 0, .15);
        z-index: 0;
    }

 

    .small-box .icon>i {
        font-size: 80px;
        position: absolute;
        right: 15px;
        top: 15px;
        transition: -webkit-transform .3s linear;
        transition: transform .3s linear;
        transition: transform .3s linear, -webkit-transform .3s linear;
    }

    .icon{
        display: inline-block;
        font-family: "Ionicons";
        speak: none;
        font-style: normal;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        text-rendering: auto;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
    }
    .small-box>.small-box-footer {
        background-color: rgba(0, 0, 0, .1);
        color: rgba(255, 255, 255, .8);
        display: block;
        padding: 3px 0;
        position: relative;
        text-align: center;
        text-decoration: none;
        z-index: 10;
    }
     .small-box h3 {
        font-size: 3.2rem;
        font-weight: 700;
    }
    .info-box{
        cursor: pointer
    }
    .info-box .info-box-stats p {
        font-size: 17px;
        font-weight: 400;
        margin-bottom: 10px;
        color: #484f5e; 
    }
    .panel .panel-body { 
        padding: 10px; 
    }
    .headerUnidade{
        font-size: 13px;
    }
    .table>thead>tr>th {
        vertical-align: bottom;
        border-bottom: 3px solid #FF0F00;
        
    }
    .table>tbody>tr>td {
        font-size: 20px;
        font-weight: 400;
        font-style: italic;
    }
</style>

    <div id="main-wrapper" x-data="app">
        
        <script src="{{ asset('assets/grafico/amcharts/amcharts.js') }}"></script>
        <script src="{{ asset('assets/grafico/amcharts/serial.js') }}"></script>
        <script src="{{ asset('assets/grafico/amcharts/pie.js') }}"></script> 
        <script src="{{ asset('assets/grafico/amcharts/export.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('assets/grafico/amcharts/export.css') }} type="text/css" media="all" />
 
        <script src="{{ asset('assets/grafico/amcharts5/index.js') }}"></script>
        <script src="{{ asset('assets/grafico/amcharts5/xy.js') }}"></script>  
        <script src="{{ asset('assets/grafico/amcharts5/Animated.js') }}"></script> 
        
        <script src="{{ asset('assets/grafico/amcharts4/core.js') }}"></script>
        <script src="{{ asset('assets/grafico/amcharts4/charts.js') }}"></script>  
        <script src="{{ asset('assets/grafico/amcharts4/themes/animated.js') }}"></script> 
        <!-- Resources -->

  
        <div class="panel">
            <div class="panel-body">
                <div class="row" id="indicadores-parametros"  >
 
                    
                            <div class="col-md-4" style="font-size: 24px; font-weight: 300;" > <i class="fa fa-line-chart"></i> Indicadores de Safra </div>
                            <div class="col-md-1" style="padding-right:5px; padding-left: 5px;">
                                <div class="form-group" style="margin-bottom: 0px;"> 
                                    <select class="form-control" name="agrupamento" name="parametro-ano" id="parametro-ano" style="width: 100%; " > 
                                        <option value="" >ANO</option> 
                                        <option value="2024">2024</option> 
                                        <option value="2023">2023</option> 
                                        <option value="2022">2022</option> 
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-2 " style="padding-right:5px; padding-left: 5px;">
                                <div class="form-group" style="margin-bottom: 0px;"> 
                                    <select class="form-control" name="parametro-mes" id="parametro-mes" style="width: 100%;" > 
                                        <option value="">MÊS</option> 
                                        <option value="01">JANEIRO</option>
                                        <option value="02">FEVEREIRO</option>
                                        <option value="03">MARÇO</option>
                                        <option value="04">ABRIL</option>
                                        <option value="05">MAIO</option>
                                        <option value="06">JUNHO</option>
                                        <option value="07">JULHO</option>
                                        <option value="08">AGOSTO</option>
                                        <option value="09">SETEMBRO</option>
                                        <option value="10">OUTUBRO</option>
                                        <option value="11">NOVEMBRO</option>
                                        <option value="12">DEZEMBRO</option>
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-1 " style="padding-right:5px; padding-left: 5px;">
                                <div class="form-group" style="margin-bottom: 0px;"> 
                                    <select class="form-control" name="parametro-dia" id="parametro-dia" style="width: 100%;" > 
                                        <option value="">DIA</option> 
                                        <template x-for="i in TotDias"> 
                                            <option x-bind:value="i"><span x-text="i.toString().padStart(2, '0')"></span></option> 
                                        </template>
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-2 " style=" padding-right:5px; padding-left: 5px;">
                                <div class="form-group" style="margin-bottom: 0px;"> 
                                    <select class="form-control" name="parametro-visao" id="parametro-visao" style="width: 100%;" > 
                                        <option value="KG">KILOS</option> 
                                        <option value="TB">TAMBO</option>  
                                    </select> 
                                </div>
                            </div> 
                            <div class="col-md-2 " style="  padding-left: 5px;">
                                <button type="button" x-on:click="getDataChartPrincipal"  class="btn btn-default"  style="width: 100%; font-weight: 700;" ><i class="fa fa-search"></i> Pesquisar</button>
                            </div>
                            
                </div>
            </div>
        </div>
 
        <div class="row">
  
            <div class="col-lg-2 col-md-4" style="padding-right: 5px; ">
                <div class="panel info-box panel-white" style="background: #7a6fbe; margin-bottom: 10px;" x-on:click="getDetalhecards('producao_cards')">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p class="counter" style="color: #f9fafa; font-weight: 900;margin-bottom: 3px;" x-html="iconHeaderMoagemTotal"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <p class="counter" style="color: #f9fafa;font-weight: 900; margin-bottom: 0px;" x-html="iconHeaderMoagemTotalTb"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                        </div>
                        <div class="info-box-icon"> 
                            <i class="fa  fa-check-circle-o" style="color: #f9fafa;"></i>
                        </div>
                        <div class="info-box-progress">
                            <span class="info-box-title" style="color: #f9fafa; font-weight: 900; margin-top: 5px;">Moagem Total </span>
                            <div class="progress progress-xs progress-squared bs-n">
                                <div class="progress-bar progress-bar-primary" style="color: #f9fafa;" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="col-lg-2 col-md-4" style="padding-right: 5px; padding-left: 5px;">
                <div class="panel info-box panel-white" style="background: #c2a505; margin-bottom: 10px;" x-on:click="getDetalhecards('producao_cards')">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p class="counter" style="color: #f9fafa; font-weight: 900;margin-bottom: 3px;" x-html="iconHeaderMoagemEstoque"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <p class="counter" style="color: #f9fafa;font-weight: 900; margin-bottom: 0px;" x-html="iconHeaderMoagemEstoqueTb"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                        </div>
                        <div class="info-box-icon"> 
                            <i class="fa fa-truck" style="color: #f9fafa;"></i>
                        </div>
                        <div class="info-box-progress">
                            <span class="info-box-title" style="color: #f9fafa; font-weight: 900;">Moagem Estoque</span>
                            <div class="progress progress-xs progress-squared bs-n">
                                <div class="progress-bar progress-bar-primary" style="color: #f9fafa;" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-4" style="  padding-right: 5px; padding-left: 5px;" >
                <div class="panel info-box panel-white" style="background: #26A65B; margin-bottom: 10px;" x-on:click="getDetalhecards('polpa_cards')">
                    <div class="panel-body">
                        <div class="info-box-stats">

                            <p class="counter" style="color: #f9fafa; font-weight: 900;margin-bottom: 3px;" x-html="iconHeaderMoagemConsumida"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <p class="counter" style="color: #f9fafa;font-weight: 900; margin-bottom: 0px;" x-html="iconHeaderMoagemConsumidaTb"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                        </div>
                        <div class="info-box-icon"> 
                            <i class="fa fa-download" style="color: #f9fafa;"></i>
                        </div>
                        <div class="info-box-progress">
                            <span class="info-box-title" style="color: #f9fafa; font-weight: 700;">Moagem Consumida</span>
                            <div class="progress progress-xs progress-squared bs-n">
                                <div class="progress-bar progress-bar-info" style="color: #f9fafa;"  role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                   
            <div class="col-lg-2 col-md-4" style="  padding-right: 5px; padding-left: 5px;" >
                <div class="panel info-box panel-white" style="background: #e83e8c; margin-bottom: 10px;" x-on:click="getDetalhecards('polpa_cards')">
                    <div class="panel-body">
                        <div class="info-box-stats">

                            <p class="counter" style="color: #f9fafa; font-weight: 900;margin-bottom: 3px;" x-html="iconHeaderTomateInNatura"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <p class="counter" style="color: #f9fafa;font-weight: 900; margin-bottom: 0px;" >&nbsp;</p>
                        </div>
                        <div class="info-box-icon">
                            <img class="fa" src="{{ asset('assets\images\tomate.svg') }}" height="35"> 
                        </div>
                        <div class="info-box-progress">
                            <span class="info-box-title" style="color: #f9fafa; font-weight: 700;">Tomate in Natura</span>
                            <div class="progress progress-xs progress-squared bs-n">
                                <div class="progress-bar progress-bar-info" style="color: #f9fafa;"  role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-4" style=" padding-right: 5px; padding-left: 5px;" >
                <div class="panel info-box panel-white" style="background: #399BFF; margin-bottom: 10px;" x-on:click="getDetalhecards('polpa_cards')">
                    <div class="panel-body">
                        <div class="info-box-stats">

                            <p class="counter" style="color: #f9fafa; font-weight: 900;margin-bottom: 3px;" x-html="iconHeaderBrix"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <p class="counter" style="color: #f9fafa;font-weight: 900; margin-bottom: 0px;"  >&nbsp;</p>
                            
                        </div>
                        <div class="info-box-icon"> 
                            <i class="fa fa-eye-slash" style="color: #f9fafa;"></i> 
                        </div>
                        <div class="info-box-progress">
                            <span class="info-box-title" style="color: #f9fafa; font-weight: 700;">Brix do Tomate</span>
                            <div class="progress progress-xs progress-squared bs-n">
                                <div class="progress-bar progress-bar-info" style="color: #f9fafa;"  role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-4" style="  padding-left: 5px;" >
                <div class="panel info-box panel-white" style="background: #EF4836; margin-bottom: 10px;" x-on:click="getDetalhecards('polpa_cards')">
                    <div class="panel-body">
                        <div class="info-box-stats">

                            <p class="counter" style="color: #f9fafa; font-weight: 900;margin-bottom: 3px;" x-html="iconHeaderPerdas"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <p class="counter" style="color: #f9fafa;font-weight: 900; margin-bottom: 0px;"  x-html="iconHeaderPerdasPerc"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            
                        </div>
                        <div class="info-box-icon"> 
                            <i class="fa fa-close " style="color: #f9fafa;"></i> 
                        </div>
                        <div class="info-box-progress">
                            <span class="info-box-title" style="color: #f9fafa; font-weight: 700;">Total de Perdas</span>
                            <div class="progress progress-xs progress-squared bs-n">
                                <div class="progress-bar progress-bar-info" style="color: #f9fafa;"  role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- Row -->
 
        <div class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;" x-html="titleMoagemDiaria"></h3></div>
                    <div class="col-md-2" style="text-align: right">
                        <img src="{{ asset('assets/images/xlsx.png') }}" x-on:click="xls('M')" style="cursor: pointer;" height="24"> 
                    </div>  
                </div> 
                <!-- HTML -->
                <div id="chartdivMoagemTotal"></div>
                <template x-if="loadingCharts">
                    <x-loader class="absolute-loader"/>
                </template>
                
                <br><br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;" x-html="titleMoagemDiariaConsumida"></h3></div>
                 
                </div> 
                <!-- HTML -->
                <div id="chartdivMoagemConsumida"></div>
                <template x-if="loadingCharts">
                    <x-loader class="absolute-loader"/>
                </template>

                <br><br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;" x-html="titleMoagemDiariaEstoque"></h3></div>
                 
                </div> 
                <!-- HTML -->
                <div id="chartdivMoagemEstoque"></div>
                <template x-if="loadingCharts">
                    <x-loader class="absolute-loader"/>
                </template>

            </div>
        </div>

          
        <div class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;" x-html="titleComparacaoFornec"></h3></div>
                    <div class="col-md-2" style="text-align: right">
                        <img src="{{ asset('assets/images/xlsx.png') }}" x-on:click="xls('M')" style="cursor: pointer;" height="24"> 
                    </div>  
                </div>
                <br><br>
                <!-- HTML -->
                <div id="chartdivFornecedor"></div>
                <template x-if="loadingCharts">
                    <x-loader class="absolute-loader"/>
                </template>
            </div>
        </div>
        

               
        <style>
            .FixedHeightContainerOverflow
            {
                float:right;
                height: 550px;
                width:100%; 
                padding:3px; 
            }
            .ContentOverflow
            {
                height:548px;
                overflow:auto;  
            }

        </style>

 
   

    </div>

 

  
    <x-slot name="scripts"> 
      
        <script src="{{ asset('js/paginas/safra.js') }}"></script>

    </x-slot>
    
</x-layout.colonial.layout>