<x-layout.colonial.layout>
<style>
.info-box .info-box-stats span.info-box-title {
    display: block;
    font-size: 16px;
    margin-bottom: 10px;
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
  
#chartdiv_comparativo, #chartdiv_agua,#chartdivProdutos, #chartdivPrevProd, 
#chartdiv_tp_perda, #chartdiv_porc_perda
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
 
                    
                            <div class="col-md-4" style="font-size: 24px; font-weight: 300;" > <i class="fa fa-line-chart"></i> Indicadores de Produção </div>
                            <div class="col-md-1" style="padding-right:5px; padding-left: 5px;">
                                <div class="form-group" style="margin-bottom: 0px;"> 
                                    <select class="form-control" name="agrupamento" name="parametro-ano" id="parametro-ano" style="width: 100%; " > 
                                        <option value="" >ANO</option> 
                                        <option value="2025">2025</option> 
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
                                        <option value="TO">TONELADAS</option> 
                                        <option value="CX">CAIXAS</option>
                                    </select> 
                                </div>
                            </div> 
                            <div class="col-md-2 " style="  padding-left: 5px;">
                                <button type="button" x-on:click="getDataChart1"  class="  btn btn-default"  style="width: 100%; font-weight: 700;" ><i class="fa fa-search"></i> Pesquisar</button>
                            </div>
                            
                </div>
            </div>
        </div>
 
        <div class="row">
         
            <div class="col-lg-4 col-md-8" style="padding-right: 5px;  ">
                <div class="panel info-box panel-white" style="background: #22BAA0;margin-bottom: 10px;"  x-on:click="getDetalhecards('producao_cards')"  >
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p class="counter" style="color: #f9fafa; font-weight: 900;margin-bottom: 3px;" x-html="iconHeaderProdKg"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <p class="counter" style="color: #f9fafa;font-weight: 900; margin-bottom: 0px;" x-html="iconHeaderProdTo"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <span class="info-box-title red" style="color: #f9fafa; font-weight: 700; ">Produção Geral</span>
                        </div>
                        <div class="info-box-icon ">
                            <i class="fa fa-cube" style="color: #f9fafa;"></i>
                        </div>
                        <div class="info-box-progress">
                            <div class="progress progress-xs progress-squared bs-n">
                                <div class="progress-bar progress-bar-success" style="color: #f9fafa;" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-8" style="padding-right: 5px; padding-left: 5px;">
                <div class="panel info-box panel-white" style="background: #7a6fbe; margin-bottom: 10px;" x-on:click="getDetalhecards('producao_cards')">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p class="counter" style="color: #f9fafa; font-weight: 900;margin-bottom: 3px;" x-html="iconHeaderProdCx"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <p class="counter" style="color: #f9fafa;font-weight: 900; margin-bottom: 0px;" >&nbsp;</p>
                            <span class="info-box-title" style="color: #f9fafa; font-weight: 900;">Produção em Caixas</span>
                        </div>
                        <div class="info-box-icon"> 
                            <i class="fa fa-cubes" style="color: #f9fafa;"></i>
                        </div>
                        <div class="info-box-progress">
                            <div class="progress progress-xs progress-squared bs-n">
                                <div class="progress-bar progress-bar-primary" style="color: #f9fafa;" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-8" style="  padding-left: 5px;" >
                <div class="panel info-box panel-white" style="background: #e83e8c; margin-bottom: 10px;" x-on:click="getDetalhecards('polpa_cards')">
                    <div class="panel-body">
                        <div class="info-box-stats">

                            <p class="counter" style="color: #f9fafa; font-weight: 900;margin-bottom: 3px;" x-html="iconHeaderPolpas"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <p class="counter" style="color: #f9fafa;font-weight: 900; margin-bottom: 0px;" x-html="iconHeaderPolpasTb"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <span class="info-box-title" style="color: #f9fafa; font-weight: 700;">Consumo de Polpa KG</span>
                        </div>
                        <div class="info-box-icon">
                            <img class="fa" src="{{ asset('assets\images\tomate.svg') }}" height="35"> 
                        </div>
                        <div class="info-box-progress">
                            <div class="progress progress-xs progress-squared bs-n">
                                <div class="progress-bar progress-bar-info" style="color: #f9fafa;"  role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div><!-- Row -->
              
        <div class="row">
            <div class="col-lg-3 col-md-6" style="padding-right: 5px;  ">
                <div class="panel info-box panel-white" style="background: #399BFF; margin-bottom: 10px;" x-on:click="getDetalhecards('agua_cards')" >
                    <div class="panel-body" style="border-bottom: 3px solid #399BFF;">
                        <div class="info-box-stats">
                            <p class="counter" x-html="iconHeaderAgua" style="color: #f9fafa;margin-bottom: 0px; "><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa; "></i></p>
                            <p class="counter" x-html="iconHeaderAguaKg" style="color: #f9fafa; margin-bottom: 5px; font-weight: 700; font-size: 15px;"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <span class="info-box-title" style="color: #f9fafa; font-weight: 900; margin-bottom: 0px;">Consumo de Água M3</span>
                        </div>
                        <div class="info-box-icon ">
                            <i class="fa fa-tint " style="color: #f9fafa;"></i>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" style="padding-right: 5px; padding-left: 5px;"> 
                <div class="panel info-box panel-white" style="background: #c2a505; margin-bottom: 10px;" x-on:click="getDetalhecards('energia_cards')">
                    <div class="panel-body" style="border-bottom: 3px solid #c2a505;">
                        <div class="info-box-stats">
                            <p class="counter" x-html="iconHeaderEnergia"  style="color: #f9fafa;margin-bottom: 0px; "><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <p class="counter" x-html="iconHeaderEnergiaKg" style="color: #f9fafa; margin-bottom: 5px; font-weight: 700; font-size: 15px;"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <span class="info-box-title" style="color: #f9fafa; font-weight: 900; margin-bottom: 0px;">Consumo de Energia KW</span>
                        </div>
                        <div class="info-box-icon">
                            <i class="fa fa-bolt" style="color: #f9fafa;"></i>
                        </div>
                      
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" style="padding-right: 5px; padding-left: 5px;">
                <div class="panel info-box panel-white" style="background: #26A65B; margin-bottom: 10px;" x-on:click="getDetalhecards('lenha_cards')">
                    <div class="panel-body" style="border-bottom: 3px solid #26A65B;">
                        <div class="info-box-stats">
                            <p class="counter" x-html="iconHeaderLenha" style="color: #f9fafa;margin-bottom: 0px;"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <p class="counter" x-html="iconHeaderLenhaKg" style="color: #f9fafa; margin-bottom: 5px; font-weight: 700; font-size: 15px;"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <span class="info-box-title" style="color: #f9fafa; font-weight: 900; margin-bottom: 0px;">Consumo de Lenha M3</span>
                        </div>
                        <div class="info-box-icon">
                            <i class="glyphicon glyphicon-tree-deciduous" style="color: #f9fafa;" aria-hidden="true"></i>
                        </div>
                         
                    </div>
                </div>
            </div>
             
            <div class="col-lg-3 col-md-6" style="  padding-left: 5px;">
                <div class="panel info-box panel-white" style="background: #f1bb07; margin-bottom: 10px;" x-on:click="getDetalhecards('parada_cards')" >
                    <div class="panel-body" style="border-bottom: 3px solid #f1bb07;">
                        <div class="info-box-stats">
                            <p class="counter" x-html="iconHeaderParadas" style="color: #f9fafa;margin-bottom: 0px;"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <p class="counter"  style="color: #f9fafa; margin-bottom: 5px; font-weight: 700; font-size: 15px;"> -- </p>
                            <span class="info-box-title" style="color: #f9fafa; font-weight: 900;margin-bottom: 0px;" >Parada de Linha (Minutos)</span>
                        </div>
                        <div class="info-box-icon">
                            <i class="fa fa-stop" style="color: #f9fafa;"></i>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
   
        <div class="row">
         
            <div class="col-lg-4 col-md-8" style="padding-right: 5px; ">
                <div class="panel info-box panel-white" style="background: #EF4836;margin-bottom: 10px;" x-on:click="getDetalhecards('perdaE_cards')" >
                    <div class="panel-body" style="    padding: 5px;">
                        <div class="info-box-stats">
                            <p class="counter" style="color: #f9fafa; font-weight: 900;     margin-bottom: 2px;" x-html="iconHeaderPerdasEmb"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <span class="info-box-title red" style="color: #f9fafa; font-weight: 400; font-style: italic; margin-bottom: 0px;">Perda de Embalagens <span class="headerUnidade"> ( qtde. de Produtos ) </span></span>
                        </div>
                      
                        <div class="info-box-progress">
                            <div class="progress progress-xs progress-squared bs-n">
                                <div class="progress-bar progress-bar-success" style="color: #f9fafa;" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8" style="padding-right: 5px; padding-left: 5px;">
                <div class="panel info-box panel-white" style="background: #EF4836;margin-bottom: 10px;" x-on:click="getDetalhecards('perdaI_cards')">
                    <div class="panel-body" style="    padding: 5px;">
                        <div class="info-box-stats">
                            <p class="counter" style="color: #f9fafa; font-weight: 900;     margin-bottom: 2px;" x-html="iconHeaderPerdasIns"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <span class="info-box-title red" style="color: #f9fafa; font-weight: 400; font-style: italic; margin-bottom: 0px;">Perda de Insumos <span class="headerUnidade"> ( qtde. de Produtos ) </span></span>
                        </div>
                      
                        <div class="info-box-progress">
                            <div class="progress progress-xs progress-squared bs-n">
                                <div class="progress-bar progress-bar-success" style="color: #f9fafa;" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8" style="  padding-left: 5px;">
                <div class="panel info-box panel-white" style="background: #EF4836;margin-bottom: 10px;" x-on:click="getDetalhecards('perdaP_cards')">
                    <div class="panel-body" style="    padding: 5px;">
                        <div class="info-box-stats">
                            <p class="counter" style="color: #f9fafa; font-weight: 900;     margin-bottom: 2px;" x-html="iconHeaderPerdasPol"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <span class="info-box-title red" style="color: #f9fafa; font-weight: 400; font-style: italic; margin-bottom: 0px;">Perda de Polpas <span class="headerUnidade"> ( qtde. de Produtos ) </span></span>
                        </div>
                      
                        <div class="info-box-progress">
                            <div class="progress progress-xs progress-squared bs-n">
                                <div class="progress-bar progress-bar-success" style="color: #f9fafa;" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    

        </div>

        <div class="panel">
            <div class="panel-body">
                <div  >
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;" x-html="titlePlanejado" >Planejado x Produzido</h3></div>
                        <div  class="col-md-2" style="text-align: right">
                            <img src="{{ asset('assets/images/xlsx.png') }}" x-on:click="xls('M')" style="cursor: pointer;" height="24"> 
                        </div>  
                    </div>
 

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
            
                            <!-- HTML -->
                            <div id="chartdivPrevProd"></div>
                            <div id="chartdivPercProd"></div>

                            <template x-if="loadingCharts">
                                <x-loader class="absolute-loader"/>
                            </template>

                            <div class="row">
                                <div class="col-xs-12 col-sm-10 col-md-10 col-md-offset-1">
                                    <table class="table">
                                        <thead>
                                            <tr class="active">  
                                                <th class="text-right">Planejado [ Kg ]</th>   
                                                <th class="text-right">Produzido [ Kg ]</th>   
                                                <th class="text-right"> [ % ]</th> 
                                                <th class="text-right">Planejado [ T ]</th>   
                                                <th class="text-right">Produzido [ T ]</th>   
                                                <th class="text-right"> [ % ]</th>
                                                <th class="text-right">Planejado [ Cx ]</th>
                                                <th class="text-right">Produzido [ Cx ]</th>
                                                <th class="text-right"> [ % ]</th>
                                            </tr>
                                        </thead> 
                                        <tbody> 
                                                <tr>  
                                                    <td class="text-right" x-html="PlanejadoKg" ></td>
                                                    <td class="text-right" x-html="ProduzidoKg" ></td>
                                                    <td class="text-right" x-html="ProduzidoKgPerc" ></td>
                                                    <td class="text-right" x-html="PlanejadoTo" ></td>
                                                    <td class="text-right" x-html="ProduzidoTo" ></td>
                                                    <td class="text-right" x-html="ProduzidoToPerc" ></td>
                                                    <td class="text-right" x-html="PlanejadoCx" ></td>
                                                    <td class="text-right" x-html="ProduzidoCx" ></td>
                                                    <td class="text-right" x-html="ProduzidoCxPerc" ></td>
                                                </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
    
                        </div>
                    </div>
 
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;" x-html="titleTipoProd"></h3></div>
                            <div class="col-md-2" style="text-align: right">
                                <img src="{{ asset('assets/images/xlsx.png') }}" x-on:click="xls('M')" style="cursor: pointer;" height="24"> 
                            </div>  
                        </div>
                        
                            <!-- HTML -->
                            <div id="chartdivProdutos"></div>
                            <template x-if="loadingCharts">
                                <x-loader class="absolute-loader"/>
                            </template>

                            <div class="row">
                                <div class="col-xs-12 col-sm-10 col-md-10 col-md-offset-1">
                                    <table class="table">
                                        <thead>
                                            <tr class="active">  
                                                <th class="text-right">Planejado [ Kg ]</th>   
                                                <th class="text-right">Produzido [ Kg ]</th>   
                                                <th class="text-right"> [ % ]</th> 
                                                <th class="text-right">Planejado [ T ]</th>   
                                                <th class="text-right">Produzido [ T ]</th>   
                                                <th class="text-right">  [ % ]</th>
                                                <th class="text-right">Planejado [ Cx ]</th>
                                                <th class="text-right">Produzido [ Cx ]</th>
                                                <th class="text-right"> [ % ]</th>
                                            </tr>
                                        </thead> 
                                        <tbody> 
                                                <tr>  
                                                    <td class="text-right" x-html="PlanejadoKg" ></td>
                                                    <td class="text-right" x-html="ProduzidoKg" ></td>
                                                    <td class="text-right" x-html="ProduzidoKgPerc" ></td>
                                                    <td class="text-right" x-html="PlanejadoTo" ></td>
                                                    <td class="text-right" x-html="ProduzidoTo" ></td>
                                                    <td class="text-right" x-html="ProduzidoToPerc" ></td>
                                                    <td class="text-right" x-html="PlanejadoCx" ></td>
                                                    <td class="text-right" x-html="ProduzidoCx" ></td>
                                                    <td class="text-right" x-html="ProduzidoCxPerc" ></td>
                                                </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="panel">
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;" x-html="titleComparativo"></h3></div>
                         
                        </div> 
                        <!-- HTML -->
                        <div id="chartdiv_comparativo"></div>
                        <template x-if="loadingCharts">
                            <x-loader class="absolute-loader"/>
                        </template>
                     
                    </div>
                </div>
            </div>
        </div>
 
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;">Consumo de Agua [ M3 ]</h3></div>
                            <div class="col-md-2" style="text-align: right">
                                <img src="{{ asset('assets/images/xlsx.png') }}" x-on:click="xls('A')" style="cursor: pointer;" height="24"> 
                            </div>  
                        </div>
                         
                        <!-- HTML -->
                        <div id="chartdiv_agua"></div>
                        <template x-if="loadingCharts">
                            <x-loader class="absolute-loader"/>
                        </template>

                    </div>
                </div>
            </div> 
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;">Consumo de Energia [ KW ]</h3></div>
                            <div class="col-md-2" style="text-align: right">
                                <img src="{{ asset('assets/images/xlsx.png') }}" x-on:click="xls('E')" style="cursor: pointer;" height="24"> 
                            </div>  
                        </div>
 
                        <!-- HTML -->
                        <div id="chartdiv_energia"></div>
                        <template x-if="loadingCharts">
                            <x-loader class="absolute-loader"/>
                        </template>

                    </div>
                </div>
            </div>
        </div>
 
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;">Consumo de Lenha [ M3 ]</h3></div>
                            <div class="col-md-2" style="text-align: right">
                                <img src="{{ asset('assets/images/xlsx.png') }}" x-on:click="xls('L')" style="cursor: pointer;" height="24"> 
                            </div>  
                        </div>
                        
                        <!-- HTML -->
                        <div id="chartdiv_lenha"></div>
                        <template x-if="loadingCharts">
                            <x-loader class="absolute-loader"/>
                        </template>

                    </div>
                </div>
            </div>
        </div>
            
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;">Consumo de Polpa [ KG ]</h3></div>
                            <div class="col-md-2" style="text-align: right">
                                <img src="{{ asset('assets/images/xlsx.png') }}" x-on:click="xls('O')" style="cursor: pointer;" height="24"> 
                            </div>  
                        </div>
 

                    <!-- HTML -->
                    <div id="chartdiv_polpa"></div>
                    <template x-if="loadingCharts">
                        <x-loader class="absolute-loader"/>
                    </template>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;">Parada de Linha [ Minutos ]</h3></div>
                            <div class="col-md-2" style="text-align: right">
                                <img src="{{ asset('assets/images/xlsx.png') }}"  x-on:click="xls('P')" style="cursor: pointer;" height="24"> 
                            </div>  
                        </div>
                       
                        <!-- HTML -->
                        <div id="chartdiv_parada"></div>
                        <template x-if="loadingCharts">
                            <x-loader class="absolute-loader"/>
                        </template>

                        <div class="col-md-12"><h3 class="panel-title text-center" style="color: #0e0e0e; margin-top: 60px;">Tipos de Parada [ Minutos ]</h3></div>
                        <!-- HTML -->
                        <div id="chartdiv_tp_parada"></div>
                        <template x-if="loadingCharts">
                            <x-loader class="absolute-loader"/>
                        </template>

                        <div class="col-md-12"><h3 class="panel-title text-center" style="color: #0e0e0e; margin-top: 60px;">Paradas Por Equipamentos [ Minutos ]</h3></div>
                        <!-- HTML -->
                        <div id="chartdiv_Equip_parada"></div>
                        <template x-if="loadingCharts">
                            <x-loader class="absolute-loader"/>
                        </template>

                    </div>
                </div>
            </div> 
        </div>
         
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;">Perdas</h3></div>
                            <div class="col-md-2" style="text-align: right">
                                <img src="{{ asset('assets/images/xlsx.png') }}" x-on:click="xls('D')" style="cursor: pointer;" height="24"> 
                            </div>  
                        </div>
 

                        <!-- HTML -->
                        <div id="chartdiv_perda"></div>
                        <template x-if="loadingCharts">
                            <x-loader class="absolute-loader"/>
                        </template>

                        <div class="row" style="margin-top: 50px;">
                            <div class="col-md-2"></div>
                            <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;">Perdas Por Grupo de Produtos</h3></div> 
                        </div>  
                        <!-- HTML -->
                        <div id="chartdiv_grupo_perda"></div>
                        <template x-if="loadingCharts">
                            <x-loader class="absolute-loader"/>
                        </template>

                        <div class="row" style="margin-top: 50px;">
                            <div class="col-md-2"></div>
                            <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;">Motivos de Perdas</h3></div> 
                        </div> 
                       
                        <!-- HTML -->
                        <div id="chartdiv_tp_perda"></div>
                        <template x-if="loadingCharts">
                            <x-loader class="absolute-loader"/>
                        </template>

                        <div class="row" style="margin-top: 50px;">
                            <div class="col-md-2"></div>
                            <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;">Índice de perdas Por Produto</h3></div> 
                        </div> 
                       
                        <!-- HTML -->
                        <div id="chartdiv_porc_perda"></div>
                        <template x-if="loadingCharts">
                            <x-loader class="absolute-loader"/>
                        </template>

                        <div class="row" style="margin-top: 50px;">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <table class="table table-striped" style="margin-bottom: 0">
                                    <thead>
                                        <tr class="active">
                                            <th >Codigo</th> 
                                            <th >Produto</th>
                                            <th class="text-right">Qtde. Dispensado</th>
                                            <th class="text-right">Qtde. Perdas</th>
                                            <th class="text-right">% de Perdas</th> 
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        <template x-for="query in tabPorPerdas">
                                            <tr style="font-size: 16px;">
                                                <td style="font-size: 16px;" x-text="query.cd_produto"></td>
                                                <td style="font-size: 16px;" x-text="query.produto"></td> 
                                                <td style="font-size: 16px;" class="text-right" x-text="(query.total) ? query.total : '0,00'"></td>  
                                                <td style="font-size: 16px;" class="text-right" x-text="query.perdas"></td>  
                                                <td style="font-size: 16px;" class="text-right" x-text="(query.qtde) ? query.qtde : '0,00'"></td>  
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div> 
                        </div> 


                    </div>
                </div>
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

        <div class="modal fade bs-example-modal-lg modal-fullscreen-xl" id="modalDetalhesProducao" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" style="line-height: 1.02857143; font-size: 1.5em;font-weight: 300;" x-html="tituloDetalhesModal">dsdsd</h4>
                    </div>
                    <div class="modal-body">
    
                        <div class="row"> 
                            <div class="col-lg-4 col-md-8">
                                <div class="panel info-box panel-white" style="background: #22BAA0;margin-bottom: 10px;">
                                    <div class="panel-body">
                                        <div class="info-box-stats">
                                            <p class="counter" style="color: #f9fafa; font-weight: 900;" x-html="produzido_kgDetalhes"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                                            <span class="info-box-title red" style="color: #f9fafa; font-weight: 700;">Produção em Kilos</span>
                                        </div>
                                        <div class="info-box-icon ">
                                            <i class="fa fa-cube" style="color: #f9fafa;"></i>
                                        </div>
                                        <div class="info-box-progress">
                                            <div class="progress progress-xs progress-squared bs-n">
                                                <div class="progress-bar progress-bar-success" style="color: #f9fafa;" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-8">
                                <div class="panel info-box panel-white" style="background: #12AFCB; margin-bottom: 10px;">
                                    <div class="panel-body">
                                        <div class="info-box-stats">
                                            <p><span class="counter" style="color: #f9fafa; font-weight: 900;" x-html="produzido_toDetalhes"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></span></p>
                                            <span class="info-box-title" style="color: #f9fafa; font-weight: 700;">Produção em Toneladas</span>
                                        </div>
                                        <div class="info-box-icon">
                                            <i class="fa fa-cube" style="color: #f9fafa;"></i>
                                        </div>
                                        <div class="info-box-progress">
                                            <div class="progress progress-xs progress-squared bs-n">
                                                <div class="progress-bar progress-bar-info" style="color: #f9fafa;"  role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-8">
                                <div class="panel info-box panel-white" style="background: #7a6fbe; margin-bottom: 10px;">
                                    <div class="panel-body">
                                        <div class="info-box-stats">
                                            <p class="counter" style="color: #f9fafa; font-weight: 900;" x-html="produzido_cxDetalhes"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                                            <span class="info-box-title" style="color: #f9fafa; font-weight: 900;">Produção em Caixas</span>
                                        </div>
                                        <div class="info-box-icon"> 
                                            <i class="fa fa-cubes" style="color: #f9fafa;"></i>
                                        </div>
                                        <div class="info-box-progress">
                                            <div class="progress progress-xs progress-squared bs-n">
                                                <div class="progress-bar progress-bar-primary" style="color: #f9fafa;" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Row -->
                              
                        <div class="row">
                            <div class="col-lg-2 col-md-4">
                                <div class="panel info-box panel-white" style="background: #399BFF; margin-bottom: 10px;" >
                                    <div class="panel-body" style="border-bottom: 3px solid #399BFF;">
                                        <div class="info-box-stats">
                                            <p class="counter" x-html="hidricoDetalhes" style="color: #f9fafa;margin-bottom: 0px; "><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa; "></i></p>
                                            <span class="info-box-title" style="color: #f9fafa; font-weight: 900; margin-bottom: 0px;">Agua</span>
                                        </div>
                                        <div class="info-box-icon ">
                                            <i class="fa fa-tint " style="color: #f9fafa;"></i>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4"> 
                                <div class="panel info-box panel-white" style="background: #c2a505; margin-bottom: 10px;">
                                    <div class="panel-body" style="border-bottom: 3px solid #c2a505;">
                                        <div class="info-box-stats">
                                            <p class="counter" x-html="energiaDetalhes"  style="color: #f9fafa;margin-bottom: 0px; "><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                                            <span class="info-box-title" style="color: #f9fafa; font-weight: 900; margin-bottom: 0px;">Energia</span>
                                        </div>
                                        <div class="info-box-icon">
                                            <i class="fa fa-bolt" style="color: #f9fafa;"></i>
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <div class="panel info-box panel-white" style="background: #26A65B; margin-bottom: 10px;">
                                    <div class="panel-body" style="border-bottom: 3px solid #26A65B;">
                                        <div class="info-box-stats">
                                            <p class="counter" x-html="lenhaDetalhes" style="color: #f9fafa;margin-bottom: 0px;"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                                            <span class="info-box-title" style="color: #f9fafa; font-weight: 900; margin-bottom: 0px;">Lenha</span>
                                        </div>
                                        <div class="info-box-icon">
                                            <i class="glyphicon glyphicon-tree-deciduous" style="color: #f9fafa;" aria-hidden="true"></i>
                                        </div>
                                         
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <div class="panel info-box panel-white" style="background: #e83e8c; margin-bottom: 10px;">
                                    <div class="panel-body" style="border-bottom: 3px solid #e83e8c;">
                                        <div class="info-box-stats">
                                            <p class="counter" x-html="polpaDetalhes" style="color: #f9fafa;margin-bottom: 0px;"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                                            <span class="info-box-title"  style="color: #f9fafa; font-weight: 900;margin-bottom: 0px;">Polpas</span>
                                        </div>
                                        <div class="info-box-icon"> 
                                            <img class="fa" src="{{ asset('assets\images\tomate.svg') }}" height="25"> 
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <div class="panel info-box panel-white" style="background: #EF4836; margin-bottom: 10px;">
                                    <div class="panel-body" style="border-bottom: 3px solid #EF4836;">
                                        <div class="info-box-stats">
                                            <p class="counter" x-html="perdaDetalhes" style="color: #f9fafa;margin-bottom: 0px;">
                                                <i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>
                                            </p>
                                            <span class="info-box-title" style="color: #f9fafa; font-weight: 900;margin-bottom: 0px;">Perdas</span>
                                        </div>
                                        <div class="info-box-icon">
                                            <i class="fa fa-exclamation-triangle" style="color: #f9fafa;"></i>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <div class="panel info-box panel-white" style="background: #f1bb07; margin-bottom: 10px;">
                                    <div class="panel-body" style="border-bottom: 3px solid #f1bb07;">
                                        <div class="info-box-stats">
                                            <p class="counter" x-html="paradaDetalhes" style="color: #f9fafa;margin-bottom: 0px;"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                                            <span class="info-box-title" style="color: #f9fafa; font-weight: 900;margin-bottom: 0px;" >Paradas</span>
                                        </div>
                                        <div class="info-box-icon">
                                            <i class="fa fa-stop" style="color: #f9fafa;"></i>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                
                        </div>
                    
                        <br>
     
                        <div role="tabpanel"> 
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-justified" role="tablist"> 
                                    <li role="presentation" class="active"><a href="#tabProducaoModal" role="tab" data-toggle="tab" aria-expanded="true">Produção</a></li>
                                    <li role="presentation"><a href="#tabPerdasModal" role="tab" data-toggle="tab">Perdas</a></li>
                                    <li role="presentation"><a href="#tabParadasModal" role="tab" data-toggle="tab">Paradas</a></li>
                                </ul> 
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    
                                    <div role="tabpanel" class="tab-pane  active fade in"  id="tabProducaoModal">
                                              
                                        <template x-if="modalLoadingCharts">
                                            <div style="padding: 200px"> 
                                                <x-loader class="absolute-loader"/>                           
                                            </div>
                                        </template>

                                        <div class="FixedHeightContainerOverflow"> 
                                            <div class="ContentOverflow">

                                                <table class="table table-striped" style="margin-bottom: 0">
                                                    <thead>
                                                        <tr class="active">
                                                            <th>Ordem de Produção</th>
                                                            <th class="text-center">Data</th>
                                                            <th >Produto</th>
                                                            <th class="text-right">Kg/Cx</th>
                                                            <th class="text-right">Planejado [CX]</th>
                                                            <th class="text-right">Produzido [CX]</th>
                                                            <th class="text-right">Planejado [KG]</th>   
                                                            <th class="text-right">Produzido [KG]</th>   
                                                            <th class="text-right">Paradas [Min]</th>  
                                                        </tr>
                                                    </thead> 
                                                    <tbody>
                                                        <template x-for="query in tabProdDetalhes">
                                                            <tr style="font-size: 16px;">
                                                                <td  style="font-size: 16px;" x-text="query.codigo"></td>
                                                                <td class="text-center" style="font-size: 16px;" x-text="query.data"></td>
                                                                <td style="font-size: 16px;" x-text="query.ItemCode+' - '+query.nome"></td>
                                                                <td style="font-size: 16px;" class="text-right" x-text="(query.kg*1).toLocaleString('pt-br', {minimumFractionDigits: 2})"></td>
                                                                <td style="font-size: 16px;" class="text-right" x-text="(query.valor*1).toLocaleString('pt-br', {minimumFractionDigits: 2})"></td>
                                                                <td style="font-size: 16px;" class="text-right" x-text="(query.valor_prod*1).toLocaleString('pt-br', {minimumFractionDigits: 2})"></td>
                                                                <td style="font-size: 16px;" class="text-right" x-text="(query.valor*query.kg).toLocaleString('pt-br', {minimumFractionDigits: 2})"></td>
                                                                <td style="font-size: 16px;" class="text-right" x-text="(query.valor_prod*query.kg).toLocaleString('pt-br', {minimumFractionDigits: 2})"></td>
                                                                <td style="font-size: 16px;" class="text-right" x-text="query.tempo" ></td>
                                                            </tr>
                                                        </template>
                                                        <template x-if="tabProdDetalhes">
                                                            <tr style="font-size: 16px;">
                                                                <th  style="font-size: 16px;" colspan="4">TOTAIS </th>  
                                                                <th style="font-size: 16px;" class="text-right" x-text="(totais_toDetalhes.pCX*1).toLocaleString('pt-br', {minimumFractionDigits: 2})"></th>
                                                                <th style="font-size: 16px;" class="text-right" x-text="(totais_toDetalhes.prCX*1).toLocaleString('pt-br', {minimumFractionDigits: 2})"></th>
                                                                <th style="font-size: 16px;" class="text-right" x-text="(totais_toDetalhes.pKG*1).toLocaleString('pt-br', {minimumFractionDigits: 2})"></th>
                                                                <th style="font-size: 16px;" class="text-right" x-text="(totais_toDetalhes.prKG*1).toLocaleString('pt-br', {minimumFractionDigits: 2})"></th>
                                                                <th style="font-size: 16px;" class="text-right" x-text="(totais_toDetalhes.Tempo).toLocaleString('pt-br', {minimumFractionDigits: 2})"  ></th>
                                                            </tr>
                                                        </template>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                    </div> 
    
                                    <div role="tabpanel" class="tab-pane fade"   id="tabPerdasModal">
                                         
                                        
                                        <template x-if="modalLoadingCharts">
                                            <div style="padding: 200px"> 
                                                <x-loader class="absolute-loader"/>                           
                                            </div>
                                        </template>

                                        <div class="FixedHeightContainerOverflow"> 
                                            <div class="ContentOverflow">

                                                <table class="table table-striped" style="margin-bottom: 0">
                                                    <thead>
                                                        <tr class="active">
                                                            <th>Produto</th>
                                                            <th >Tipo de Perda</th>
                                                            <th >Observações</th>
                                                            <th class="text-right">Qtde.</th> 
                                                        </tr>
                                                    </thead> 
                                                    <tbody>
                                                        <template x-for="query in tabPerdaDetalhes">
                                                            <tr style="font-size: 16px;">
                                                                <td style="font-size: 16px;" x-text="query.nm_produto"></td>
                                                                <td style="font-size: 16px;" x-text="query.nm_tipo"></td> 
                                                                <td style="font-size: 16px;" x-text="query.obs_perda"></td> 
                                                                <td style="font-size: 16px;" class="text-right" x-text="(query.qtde).toLocaleString('pt-br', {minimumFractionDigits: 2})"></td>
                                                                
                                                            </tr>
                                                        </template>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                    </div> 
    
                                    <div role="tabpanel" class="tab-pane fade"   id="tabParadasModal"> 
                                        <template x-if="modalLoadingCharts">
                                            <div style="padding: 200px"> 
                                                <x-loader class="absolute-loader"/>                           
                                            </div>
                                        </template>

                                        <div class="FixedHeightContainerOverflow"> 
                                            <div class="ContentOverflow">

                                                <table class="table table-striped" style="margin-bottom: 0">
                                                    <thead>
                                                        <tr class="active">
                                                            <th >Tipo de Parada</th>
                                                            <th >Observações</th>
                                                            <th class="text-right">Tempo(min)</th> 
                                                        </tr>
                                                    </thead> 
                                                    <tbody>
                                                        <template x-for="query in tabParadaDetalhes">
                                                            <tr style="font-size: 16px;">
                                                                <td style="font-size: 16px;" x-text="query.nm_tipo"></td> 
                                                                <td style="font-size: 16px;" x-text="query.obs_parada"></td> 
                                                                <td style="font-size: 16px;" class="text-right" x-text="(query.qtde).toLocaleString('pt-br', {minimumFractionDigits: 2})"></td>
                                                                
                                                            </tr>
                                                        </template>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                        
                                    </div> 
                                </div>
                                
                        </div>
    
       
                    </div>
                    <div class="modal-footer"> 
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bs-example-modal-lg modal-fullscreen-xl" id="modalDetalhesParada" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" style="line-height: 1.02857143; font-size: 1.5em;font-weight: 300;" x-html="tituloDetalhesModal">dsdsd</h4>
                    </div>
                    <div class="modal-body">
     
                        <div class="FixedHeightContainerOverflow"> 
                            <div class="ContentOverflow">
     
                                <div role="tabpanel"> 
                                        <!-- Nav tabs -->
                                        
                                            
                                        <template x-if="modalLoadingCharts">
                                            <div style="padding: 100px"> 
                                                <x-loader class="absolute-loader"/>                           
                                            </div>
                                        </template>
                                        <table class="table table-striped" style="margin-bottom: 0">
                                            <thead>
                                                <tr class="active">
                                                    <th >Codigo</th>
                                                    <th >Data</th>
                                                    <th >Item de Produção</th>
                                                    <th >Equipamento</th>
                                                    <th >Tipo de Parada</th>
                                                    <th >Observações</th>
                                                    <th class="text-right">Tempo(min)</th> 
                                                </tr>
                                            </thead> 
                                            <tbody>
                                                <template x-for="query in dadosParada">
                                                    <tr style="font-size: 16px;">
                                                        <td style="font-size: 16px;" x-text="query.cd_producao_parada"></td>
                                                        <td style="font-size: 16px;" x-text="query.dt_ordem"></td>
                                                        <td style="font-size: 16px;" x-text="query.cd_item+' - '+query.nm_item"></td> 
                                                        <td style="font-size: 16px;" x-text="query.nm_equipamento"></td>
                                                        <td style="font-size: 16px;" x-text="query.nm_tipo"></td> 
                                                        <td style="font-size: 16px;" x-text="query.obs_parada"></td> 
                                                        <td style="font-size: 16px;" class="text-right" x-text="(query.tempo).toLocaleString('pt-br', {minimumFractionDigits: 2})"></td>
                                                        
                                                    </tr>
                                                </template>
                                            </tbody>
                                        </table>
            
                                </div>

                            </div>
                        </div>
       
                    </div>
                    <div class="modal-footer"> 
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bs-example-modal-lg modal-fullscreen-xl" id="modalDetalhesPerda" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" style="line-height: 1.02857143; font-size: 1.5em;font-weight: 300;" x-html="tituloDetalhesModal">dsdsd</h4>
                    </div>
                    <div class="modal-body">
    
                        
                        <br>
     
                        <div role="tabpanel"> 
                                <!-- Nav tabs -->
                                 
                            <div class="FixedHeightContainerOverflow"> 
                                <div class="ContentOverflow">
                                    
                                    <template x-if="modalLoadingCharts">
                                        <div style="padding: 100px"> 
                                            <x-loader class="absolute-loader"/>                           
                                        </div>
                                    </template>
                                    <table class="table table-striped" style="margin-bottom: 0">
                                        <thead>
                                            <tr class="active">
                                                <th >Codigo</th>
                                                <th >Data</th> 
                                                <th >Item de Produção</th>
                                                <th >Produto</th>
                                                <th >Tipo de Perda</th>
                                                <th >Observações</th>
                                                <th class="text-right">Qtde.</th> 
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            <template x-for="query in dadosPerda">
                                                <tr style="font-size: 16px;">
                                                    <td style="font-size: 16px;" x-text="query.cd_perda"></td>
                                                    <td style="font-size: 16px;" x-text="query.dt_ordem"></td> 
                                                    <td style="font-size: 16px;" x-text="query.cd_item+' - '+query.nm_item"></td> 
                                                    <td style="font-size: 16px;" x-text="query.cd_produto+' - '+query.nm_produto"></td> 
                                                    <td style="font-size: 16px;" x-text="query.nm_tipo"></td> 
                                                    <td style="font-size: 16px;" x-text="query.obs_perda"></td> 
                                                    <td style="font-size: 16px;" class="text-right" x-text="(query.qtde).toLocaleString('pt-br', {minimumFractionDigits: 0})+' '+query.unidade"></td>
                                                    
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
     
                        </div>
    
       
                    </div>
                    <div class="modal-footer"> 
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bs-example-modal-lg modal-fullscreen-xl" id="modalDetalhesCards" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" style="line-height: 1.02857143; font-size: 1.5em;font-weight: 300;" x-html="tituloDetalhesModal">dsdsd</h4>
                    </div>
                    <div class="modal-body">
    

     
                        <div role="tabpanel"> 
                                <!-- Nav tabs -->

                                <div class="FixedHeightContainerOverflow"> 
                                    <div class="ContentOverflow">
 
                                        <template x-if="modalLoadingCharts">
                                            <div style="padding: 100px"> 
                                                <x-loader class="absolute-loader"/>                           
                                            </div>
                                        </template>

                                        <template x-if="dadosCards.indicador=='producao_cards'">
                                            <table class="table table-striped" style="margin-bottom: 0">
                                                <thead>
                                                    <tr class="active">
                                                        <th >Codigo</th> 
                                                        <th >Produto</th>
                                                        <th class="text-right">Planejado[Cx]</th>
                                                        <th class="text-right">Produzido[Cx]</th>
                                                        <th class="text-right">Planejado[Kg]</th>
                                                        <th class="text-right">Produzido[Kg]</th>
                                                        <th class="text-right">Planejado[To]</th>
                                                        <th class="text-right">Produzido[To]</th>
                                                    </tr>
                                                </thead> 
                                                <tbody>
                                                    <template x-for="query in listaCards">
                                                        <tr style="font-size: 16px;">
                                                            <td style="font-size: 16px;" x-text="query.codigo"></td>
                                                            <td style="font-size: 16px;" x-text="query.nome"></td> 
                                                            <td style="font-size: 16px;" class="text-right" x-text="(query.pla_cx).toLocaleString('pt-br', {minimumFractionDigits: 0})"></td>
                                                            <td style="font-size: 16px;" class="text-right" x-text="(query.prod_cx).toLocaleString('pt-br', {minimumFractionDigits: 0})"></td>
                                                            <td style="font-size: 16px;" class="text-right" x-text="(query.pla_kg).toLocaleString('pt-br', {minimumFractionDigits: 0})"></td>
                                                            <td style="font-size: 16px;" class="text-right" x-text="(query.prod_kg).toLocaleString('pt-br', {minimumFractionDigits: 0})"></td>
                                                            <td style="font-size: 16px;" class="text-right" x-text="(query.pla_to).toLocaleString('pt-br', {minimumFractionDigits: 0})"></td>
                                                            <td style="font-size: 16px;" class="text-right" x-text="(query.prod_to).toLocaleString('pt-br', {minimumFractionDigits: 0})"></td>
                                                        </tr>
                                                    </template>
                                                </tbody>
                                            </table>
                                        </template>

                                        <template x-if="dadosCards.indicador=='polpa_cards'">
                                            <table class="table table-striped" style="margin-bottom: 0">
                                                <thead>
                                                    <tr class="active">
                                                        <th >Data</th>   
                                                        <th class="text-right">Qtde Consumida [Kg]</th>
                                                        <th class="text-right">Qtde Consumida [Tb]</th>
                                                    </tr>
                                                </thead> 
                                                <tbody>
                                                    <template x-for="query in listaCards">
                                                        <tr style="font-size: 16px;">
                                                            <td style="font-size: 16px;" x-text="query.data"></td> 
                                                            <td style="font-size: 16px;" class="text-right" x-text="(query.qtde).toLocaleString('pt-br', {minimumFractionDigits: 0})"></td>
                                                            <td style="font-size: 16px;" class="text-right" x-text="(query.qtde_tb).toLocaleString('pt-br', {minimumFractionDigits: 0})"></td>
                                                        </tr>
                                                    </template>
                                                </tbody>
                                            </table>
                                        </template>
            
                                        <template x-if="dadosCards.indicador=='agua_cards'">
                                            <table class="table table-striped" style="margin-bottom: 0">
                                                <thead>
                                                    <tr class="active">
                                                        <th >Data</th>   
                                                        <th class="text-right">Qtde Consumida [M3]</th> 
                                                    </tr>
                                                </thead> 
                                                <tbody>
                                                    <template x-for="query in listaCards">
                                                        <tr style="font-size: 16px;">
                                                            <td style="font-size: 16px;" x-text="query.data"></td> 
                                                            <td style="font-size: 16px;" class="text-right" x-text="(query.qtde).toLocaleString('pt-br', {minimumFractionDigits: 0})"></td> 
                                                        </tr>
                                                    </template>
                                                </tbody>
                                            </table>
                                        </template>
        
                                        <template x-if="dadosCards.indicador=='energia_cards'">
                                            <table class="table table-striped" style="margin-bottom: 0">
                                                <thead>
                                                    <tr class="active">
                                                        <th >Data</th>   
                                                        <th class="text-right">Qtde Consumida [KW]</th> 
                                                    </tr>
                                                </thead> 
                                                <tbody>
                                                    <template x-for="query in listaCards">
                                                        <tr style="font-size: 16px;">
                                                            <td style="font-size: 16px;" x-text="query.data"></td> 
                                                            <td style="font-size: 16px;" class="text-right" x-text="(query.qtde).toLocaleString('pt-br', {minimumFractionDigits: 0})"></td> 
                                                        </tr>
                                                    </template>
                                                </tbody>
                                            </table>
                                        </template>

                                        <template x-if="dadosCards.indicador=='lenha_cards'">
                                            <table class="table table-striped" style="margin-bottom: 0">
                                                <thead>
                                                    <tr class="active">
                                                        <th >Data</th>   
                                                        <th class="text-right">Qtde Consumida [M3]</th> 
                                                    </tr>
                                                </thead> 
                                                <tbody>
                                                    <template x-for="query in listaCards">
                                                        <tr style="font-size: 16px;">
                                                            <td style="font-size: 16px;" x-text="query.data"></td> 
                                                            <td style="font-size: 16px;" class="text-right" x-text="(query.qtde).toLocaleString('pt-br', {minimumFractionDigits: 0})"></td> 
                                                        </tr>
                                                    </template>
                                                </tbody>
                                            </table>
                                        </template>

                                        <template x-if="dadosCards.indicador=='parada_cards'">
                                            <table class="table table-striped" style="margin-bottom: 0">
                                                <thead>
                                                    <tr class="active">
                                                        <th >Data</th>   
                                                        <th >Tipo de Parada</th>  
                                                        <th class="text-right">Tempo [Minutos]</th> 
                                                    </tr>
                                                </thead> 
                                                <tbody>
                                                    <template x-for="query in listaCards">
                                                        <tr style="font-size: 16px;">
                                                            <td style="font-size: 16px;" x-text="query.data"></td> 
                                                            <td style="font-size: 16px;" x-text="query.nm_tipo"></td> 
                                                            <td style="font-size: 16px;" class="text-right" x-text="(query.qtde).toLocaleString('pt-br', {minimumFractionDigits: 0})"></td> 
                                                        </tr>
                                                    </template>
                                                </tbody>
                                            </table>
                                        </template>

                                        <template x-if="dadosCards.indicador=='perdaE_cards'">
                                            <table class="table table-striped" style="margin-bottom: 0">
                                                <thead>
                                                    <tr class="active">
                                                        <th >Data</th>   
                                                        <th >Produto</th>  
                                                        <th >Tipo de Perda</th>  
                                                        <th class="text-right">Total</th> 
                                                    </tr>
                                                </thead> 
                                                <tbody>
                                                    <template x-for="query in listaCards">
                                                        <tr style="font-size: 16px;">
                                                            <td style="font-size: 16px;" x-text="query.data"></td> 
                                                            <td style="font-size: 16px;" x-text="query.nm_produto"></td>  
                                                            <td style="font-size: 16px;" x-text="query.nm_tipo"></td> 
                                                            <td style="font-size: 16px;" class="text-right" x-text="(query.qtde).toLocaleString('pt-br', {minimumFractionDigits: 0})+' '+query.unidade"></td> 
                                                        </tr>
                                                    </template>
                                                </tbody>
                                            </table>
                                        </template>

                                        <template x-if="dadosCards.indicador=='perdaI_cards'">
                                            <table class="table table-striped" style="margin-bottom: 0">
                                                <thead>
                                                    <tr class="active">
                                                        <th >Data</th>   
                                                        <th >Produto</th> 
                                                        <th >Tipo de Perda</th>  
                                                        <th class="text-right">Qtde</th> 
                                                    </tr>
                                                </thead> 
                                                <tbody>
                                                    <template x-for="query in listaCards">
                                                        <tr style="font-size: 16px;">
                                                            <td style="font-size: 16px;" x-text="query.data"></td> 
                                                            <td style="font-size: 16px;" x-text="query.nm_produto"></td> 
                                                            <td style="font-size: 16px;" x-text="query.nm_tipo"></td> 
                                                            <td style="font-size: 16px;" class="text-right" x-text="(query.qtde).toLocaleString('pt-br', {minimumFractionDigits: 0})+' '+query.unidade"></td> 
                                                        </tr>
                                                    </template>
                                                </tbody>
                                            </table>
                                        </template>

                                        <template x-if="dadosCards.indicador=='perdaP_cards'">
                                            <table class="table table-striped" style="margin-bottom: 0">
                                                <thead>
                                                    <tr class="active">
                                                        <th >Data</th>   
                                                        <th >Produto</th> 
                                                        <th >Tipo de Perda</th>  
                                                        <th class="text-right">Qtde</th> 
                                                    </tr>
                                                </thead> 
                                                <tbody>
                                                    <template x-for="query in listaCards">
                                                        <tr style="font-size: 16px;">
                                                            <td style="font-size: 16px;" x-text="query.data"></td> 
                                                            <td style="font-size: 16px;" x-text="query.nm_produto"></td> 
                                                            <td style="font-size: 16px;" x-text="query.nm_tipo"></td> 
                                                            <td style="font-size: 16px;" class="text-right" x-text="(query.qtde).toLocaleString('pt-br', {minimumFractionDigits: 0})+' '+query.unidade"></td> 
                                                        </tr>
                                                    </template>
                                                </tbody>
                                            </table>
                                        </template>

                                    </div> 
                                </div>
                                
                        </div>
    
       
                    </div>
                    <div class="modal-footer"> 
                    </div>
                </div>
            </div>
        </div>

    </div>

 

  
    <x-slot name="scripts"> 
     
        <script src="{{ asset('js/paginas/previsto_realizado.js') }}"></script>

    </x-slot>
    
</x-layout.colonial.layout>
