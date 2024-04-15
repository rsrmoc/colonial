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
 
#chartdiv_comparativo, #chartdiv_agua,#chartdivProdutos, #chartdivPrevProd, #chartdiv_agua, #chartdiv_energia, #chartdiv_lenha, #chartdiv_perda, #chartdiv_parada, 
#chartdiv_polpa, #chartdiv_tp_parada, #chartdiv_tp_perda
{
  width: 100%;
  height: 500px;
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
        font-size: 20px;
        font-weight: 400;
        margin-bottom: 10px;
        color: #484f5e; 
    }
    .panel .panel-body { 
        padding: 10px; 
    }
    .headerUnidade{
        font-size: 15px;
    }
    .table>thead>tr>th {
        vertical-align: bottom;
        border-bottom: 3px solid #4472c4;
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
                <div class="row"  >
 
                    
                            <div class="col-md-5" style="font-size: 24px; font-weight: 300;" > <i class="fa fa-line-chart"></i> Indicadores de Produção </div>
                            <div class="col-md-1" style="padding-right:5px; padding-left: 5px;">
                                <div class="form-group" style="margin-bottom: 0px;"> 
                                    <select class="form-control" name="agrupamento" name="parametro-ano" id="parametro-ano" style="width: 100%;" > 
                                        <option value="">ANO</option> 
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
                                        <template x-for="i in 31"> 
                                            <option x-bind:value="i"><span x-text="i"></span></option> 
                                        </template>
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-2 " style=" padding-right:5px; padding-left: 5px;">
                                <div class="form-group" style="margin-bottom: 0px;"> 
                                    <select class="form-control" name="parametro-visao" id="parametro-visao" style="width: 100%;" > 
                                        <option value="KG">KILOS</option> 
                                        <option value="T">TONELADAS</option> 
                                        <option value="CX">CAIXAS</option>
                                    </select> 
                                </div>
                            </div> 
                            <div class="col-md-1 " style="  padding-left: 5px;">
                                <button type="button" x-on:click="getDataChart1"  class="  btn btn-default"  style="width: 100%; font-weight: 700;" ><i class="fa fa-search"></i> Pesquisar</button>
                            </div>
                            
                </div>
            </div>
        </div>

  
        <div class="row">
         
            <div class="col-lg-4 col-md-8">
                <div class="panel info-box panel-white" style="background: #22BAA0;margin-bottom: 10px;">
                    <div class="panel-body">
                        <div class="info-box-stats">
                            <p class="counter" style="color: #f9fafa; font-weight: 900;" x-html="iconHeaderProdKg"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
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
                            <p><span class="counter" style="color: #f9fafa; font-weight: 900;" x-html="iconHeaderProdTo"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></span></p>
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
                            <p class="counter" style="color: #f9fafa; font-weight: 900;" x-html="iconHeaderProdCx"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
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
                <div class="panel info-box panel-white" style="background: #399BFF;" >
                    <div class="panel-body" style="border-bottom: 3px solid #399BFF;">
                        <div class="info-box-stats">
                            <p class="counter" x-html="iconHeaderAgua" style="color: #f9fafa;"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <span class="info-box-title" style="color: #f9fafa; font-weight: 900;">Agua</span>
                        </div>
                        <div class="info-box-icon ">
                            <i class="fa fa-tint " style="color: #f9fafa;"></i>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <div class="panel info-box panel-white" style="background: #c2a505;">
                    <div class="panel-body" style="border-bottom: 3px solid #c2a505;">
                        <div class="info-box-stats">
                            <p class="counter" x-html="iconHeaderEnergia"  style="color: #f9fafa;"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <span class="info-box-title" style="color: #f9fafa; font-weight: 900;">Energia</span>
                        </div>
                        <div class="info-box-icon">
                            <i class="fa fa-bolt" style="color: #f9fafa;"></i>
                        </div>
                      
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <div class="panel info-box panel-white" style="background: #26A65B;">
                    <div class="panel-body" style="border-bottom: 3px solid #26A65B;">
                        <div class="info-box-stats">
                            <p class="counter" x-html="iconHeaderLenha" style="color: #f9fafa;"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <span class="info-box-title" style="color: #f9fafa; font-weight: 900;">Lenha</span>
                        </div>
                        <div class="info-box-icon">
                            <i class="glyphicon glyphicon-tree-deciduous" style="color: #f9fafa;" aria-hidden="true"></i>
                        </div>
                         
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <div class="panel info-box panel-white" style="background: #EF4836;">
                    <div class="panel-body" style="border-bottom: 3px solid #EF4836;">
                        <div class="info-box-stats">
                            <p class="counter" x-html="iconHeaderPerdas" style="color: #f9fafa;"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <span class="info-box-title" style="color: #f9fafa; font-weight: 900;">Perdas</span>
                        </div>
                        <div class="info-box-icon">
                            <i class="fa fa-exclamation-triangle" style="color: #f9fafa;"></i>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <div class="panel info-box panel-white" style="background: #f1bb07;">
                    <div class="panel-body" style="border-bottom: 3px solid #f1bb07;">
                        <div class="info-box-stats">
                            <p class="counter" x-html="iconHeaderParadas" style="color: #f9fafa;"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <span class="info-box-title" style="color: #f9fafa; font-weight: 900;" >Paradas</span>
                        </div>
                        <div class="info-box-icon">
                            <i class="fa fa-stop" style="color: #f9fafa;"></i>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <div class="panel info-box panel-white" style="background: #e83e8c;">
                    <div class="panel-body" style="border-bottom: 3px solid #e83e8c;">
                        <div class="info-box-stats">
                            <p class="counter" x-html="iconHeaderPolpas" style="color: #f9fafa;"><i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i></p>
                            <span class="info-box-title"  style="color: #f9fafa; font-weight: 900;">Polpas</span>
                        </div>
                        <div class="info-box-icon"> 
                            <i class="fa fa-apple"  style="color: #f9fafa"></i>
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
                        <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;">Planejado x Produzido</h3></div>
                        <div class="col-md-2" style="text-align: right">
                            <img src="{{ asset('assets/images/xlsx.png') }}" height="24"> 
                        </div>  
                    </div>
 

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
            
                            <!-- HTML -->
                            <div id="chartdivPrevProd"></div>

                            <template x-if="loadingCharts">
                                <x-loader class="absolute-loader"/>
                            </template>

                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-8 col-md-offset-2">
                                    <table class="table">
                                        <thead>
                                            <tr class="active">  
                                                <th class="text-right">Planejado [ Kg ]</th>   
                                                <th class="text-right">Produzido [ Kg ]</th>   
                                                <th class="text-right">Planejado [ T ]</th>   
                                                <th class="text-right">Produzido [ T ]</th>   
                                                <th class="text-right">Planejado [ Cx ]</th>
                                                <th class="text-right">Produzido [ Cx ]</th>
                                            </tr>
                                        </thead> 
                                        <tbody> 
                                                <tr>  
                                                    <td class="text-right" x-html="PlanejadoKg" ></td>
                                                    <td class="text-right" x-html="ProduzidoKg" ></td>
                                                    <td class="text-right" x-html="PlanejadoTo" ></td>
                                                    <td class="text-right" x-html="ProduzidoTo" ></td>
                                                    <td class="text-right" x-html="PlanejadoCx" ></td>
                                                    <td class="text-right" x-html="ProduzidoCx" ></td>
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
                            <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;">Tipo de Produtos</h3></div>
                            <div class="col-md-2" style="text-align: right">
                                <img src="{{ asset('assets/images/xlsx.png') }}" height="24"> 
                            </div>  
                        </div>
                        
                            <!-- HTML -->
                            <div id="chartdivProdutos"></div>
                            <template x-if="loadingCharts">
                                <x-loader class="absolute-loader"/>
                            </template>

                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-8 col-md-offset-2">
                                    <table class="table">
                                        <thead>
                                            <tr class="active">  
                                                <th class="text-right">Planejado [ Kg ]</th>   
                                                <th class="text-right">Produzido [ Kg ]</th>   
                                                <th class="text-right">Planejado [ T ]</th>   
                                                <th class="text-right">Produzido [ T ]</th>   
                                                <th class="text-right">Planejado [ Cx ]</th>
                                                <th class="text-right">Produzido [ Cx ]</th>
                                            </tr>
                                        </thead> 
                                        <tbody> 
                                                <tr>  
                                                    <td class="text-right" x-html="PlanejadoKg" ></td>
                                                    <td class="text-right" x-html="ProduzidoKg" ></td>
                                                    <td class="text-right" x-html="PlanejadoTo" ></td>
                                                    <td class="text-right" x-html="ProduzidoTo" ></td>
                                                    <td class="text-right" x-html="PlanejadoCx" ></td>
                                                    <td class="text-right" x-html="ProduzidoCx" ></td>
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
                            <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;">Comparativo</h3></div>
                         
                        </div>
                        <!-- Chart code -->
                        <script>

                            am5.ready(function() {
                            
                                // Create root element
                                // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                var root = am5.Root.new("chartdiv_comparativo");
                                
                                
                                // Set themes
                                // https://www.amcharts.com/docs/v5/concepts/themes/
                                root.setThemes([
                                am5themes_Animated.new(root)
                                ]);
                            
                            
                                // Create chart
                                // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                panX: false,
                                panY: false,
                                paddingLeft: 0,
                                wheelX: "panX",
                                wheelY: "zoomX",
                                layout: root.verticalLayout
                                }));
                            
                            
                                // Add legend
                                // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
                                var legend = chart.children.push(
                                am5.Legend.new(root, {
                                    centerX: am5.p50,
                                    x: am5.p50
                                })
                                );
                            
                                var data = [{
                                "year": "Janeiro",
                                "europe": 2.5,
                                "namerica": 2.5,
                                "asia": 2.1, 
                                }, {
                                "year": "Fevereiro",
                                "europe": 2.6,
                                "namerica": 2.7,
                                "asia": 2.2, 
                                }, {
                                "year": "Março",
                                "europe": 2.8,
                                "namerica": 2.9,
                                "asia": 2.4, 
                                }, {
                                "year": "Abril",
                                "europe": 2.8,
                                "namerica": 2.9,
                                "asia": 2.4, 
                                }, {
                                "year": "Maio",
                                "europe": 2.8,
                                "namerica": 2.9,
                                "asia": 2.4, 
                                }, {
                                "year": "Junho",
                                "europe": 2.8,
                                "namerica": 2.9,
                                "asia": 2.4, 
                                }, {
                                "year": "Julho",
                                "europe": 2.8,
                                "namerica": 2.9,
                                "asia": 2.4, 
                                }, {
                                "year": "Agosto",
                                "europe": 2.8,
                                "namerica": 2.9,
                                "asia": 2.4, 
                                }, {
                                "year": "Setembro",
                                "europe": 2.8,
                                "namerica": 2.9,
                                "asia": 2.4, 
                                }, {
                                "year": "Outubro",
                                "europe": 2.8,
                                "namerica": 2.9,
                                "asia": 2.4, 
                                }, {
                                "year": "Novembro",
                                "europe": 2.8,
                                "namerica": 2.9,
                                "asia": 2.4, 
                                }, {
                                "year": "Dexembro",
                                "europe": 2.8,
                                "namerica": 2.9,
                                "asia": 2.4, 
                                }]
                            
                            
                                // Create axes
                                // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                var xRenderer = am5xy.AxisRendererX.new(root, {
                                cellStartLocation: 0.1,
                                cellEndLocation: 0.9,
                                minorGridEnabled: true
                                })
                                
                                var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                categoryField: "year",
                                renderer: xRenderer,
                                tooltip: am5.Tooltip.new(root, {})
                                }));
                                
                                xRenderer.grid.template.setAll({
                                location: 1
                                })
                                
                                xAxis.data.setAll(data);
                                
                                var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                renderer: am5xy.AxisRendererY.new(root, {
                                    strokeOpacity: 0.1
                                })
                                }));
                            
                            
                                // Add series
                                // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                function makeSeries(name, fieldName, total) {
                                var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                    name: name,
                                    xAxis: xAxis,
                                    yAxis: yAxis,
                                    valueYField: fieldName,
                                    categoryXField: "year"
                                }));
                                
                                series.columns.template.setAll({
                                    tooltipText: "{name}, {categoryX}:{valueY}",
                                    width: am5.percent(90),
                                    tooltipY: 0,
                                    strokeOpacity: 0
                                });
                                
                                series.data.setAll(data);
                                
                            
                                // Make stuff animate on load
                                // https://www.amcharts.com/docs/v5/concepts/animations/
                                series.appear();
                                
                                series.bullets.push(function () {
                                    return am5.Bullet.new(root, {
                                    locationY: 0,
                                    sprite: am5.Label.new(root, {
                                        text: "{valueY}",
                                        fill: root.interfaceColors.get("alternativeText"),
                                        centerY: 0,
                                        centerX: am5.p50,
                                        populateText: true
                                    })
                                    });
                                });
                            
                                /*Onclick*/
                                series.columns.template.events.on("click", function(ev) {
                                    console.log("Clicked on a column", ev.target);
                                });
                            
                                legend.data.push(series);
                                
                                if (total) {
                                    series.bullets.push(function() {
                                    var totalLabel = am5.Label.new(root, {
                                        text: "{valueY}",
                                        fill: root.interfaceColors.get("text"),
                                        centerY: am5.p100,
                                        centerX: am5.p50,
                                        populateText: true,
                                        textAlign: "center"
                                    });
                                
                                    totalLabel.adapters.add("text", function(text, target) {
                                        var dataContext = target.dataItem.dataContext;
                                        var val = dataContext.europe;
                                        return val;
                                    });
                                
                                    return am5.Bullet.new(root, {
                                        locationX: 0.5,
                                        locationY: 1,
                                        sprite: totalLabel
                                    });
                                    });
                                }
                            }
                            
                            makeSeries("2024", "europe",true);
                            makeSeries("2023", "namerica",true);
                            makeSeries("2022", "asia"); 
                            
                            
                            // Make stuff animate on load
                            // https://www.amcharts.com/docs/v5/concepts/animations/
                            chart.appear(1000, 100);
                            
                            }); // end am5.ready()
                        </script>

                        <!-- HTML -->
                        <div id="chartdiv_comparativo"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-8 col-md-offset-2">
                                <table class="table">
                                    <thead>
                                        <tr class="active"> 
                                            <th>Ano</th> 
                                            <th class="text-right">Planejado [ Kg ]</th>   
                                            <th class="text-right">Produzido [ Kg ]</th>   
                                            <th class="text-right">Planejado [ T ]</th>   
                                            <th class="text-right">Produzido [ T ]</th>   
                                            <th class="text-right">Planejado [ Cx ]</th>
                                            <th class="text-right">Produzido [ Cx ]</th>
                                        </tr>
                                    </thead> 
                                    <tbody> 
                                            <tr> 
                                                <td >2024</td>  
                                                <td class="text-right" >17.082,00</td>
                                                <td class="text-right" >16.806,06</td>
                                                <td class="text-right" >2.082,00</td>
                                                <td class="text-right" >1.806,06</td>
                                                <td class="text-right" >1.300,00</td>
                                                <td class="text-right" >1.279,00</td>
                                            </tr>
                                            <tr> 
                                                <td >2023</td>  
                                                <td class="text-right" >17.082,00</td>
                                                <td class="text-right" >16.806,06</td>
                                                <td class="text-right" >2.082,00</td>
                                                <td class="text-right" >1.806,06</td>
                                                <td class="text-right" >1.300,00</td>
                                                <td class="text-right" >1.279,00</td>
                                            </tr>
                                            <tr> 
                                                <td >2022</td> 
                                                <td class="text-right" >1.300,00</td>
                                                <td class="text-right" >16.806,06</td>
                                                <td class="text-right" >2.082,00</td>
                                                <td class="text-right" >1.806,06</td>
                                                <td class="text-right" >1.279,00</td>
                                                <td class="text-right" >17.082,00</td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;">Consumo de Agua</h3></div>
                            <div class="col-md-2" style="text-align: right">
                                <img src="{{ asset('assets/images/xlsx.png') }}" height="24"> 
                            </div>  
                        </div>
                        <script>
                                am5.ready(function() {
                            
                            
                                    // Create root element
                                    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                    var root = am5.Root.new("chartdiv_agua");
                                    
                                    // Set themes
                                    // https://www.amcharts.com/docs/v5/concepts/themes/
                                    root.setThemes([
                                    am5themes_Animated.new(root)
                                    ]);
                                    
                                    // Create chart
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                    var chart = root.container.children.push(
                                    am5xy.XYChart.new(root, {
                                        panX: true,
                                        panY: true,
                                        wheelX: "panX",
                                        wheelY: "zoomX",
                                        paddingLeft: 5,
                                        paddingRight:5
                                    })
                                    );
                            
                                    // Add cursor
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                    var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                    cursor.lineY.set("visible", false);
                                    
                                    // Create axes
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                    var xRenderer = am5xy.AxisRendererX.new(root, { 
                                    minGridDistance: 60,
                                    minorGridEnabled: true
                                    });
                            
                                    var xAxis = chart.xAxes.push(
                                    am5xy.CategoryAxis.new(root, {
                                        maxDeviation: 0.3,
                                        categoryField: "country",
                                        renderer: xRenderer,
                                        tooltip: am5.Tooltip.new(root, {})
                                    })
                                    );
                                    
                                    xRenderer.grid.template.setAll({
                                    location: 1
                                    })
                                    
                                    var yAxis = chart.yAxes.push(
                                    am5xy.ValueAxis.new(root, {
                                        maxDeviation: 0.3,
                                        renderer: am5xy.AxisRendererY.new(root, {
                                        strokeOpacity: 0.1
                                        })
                                    })
                                    );
                            
                                    // Create series
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                    var series = chart.series.push(
                                    am5xy.ColumnSeries.new(root, {
                                        name: "Series 1",
                                        xAxis: xAxis,
                                        yAxis: yAxis,
                                        valueYField: "value",
                                        sequencedInterpolation: true,
                                        categoryXField: "country"
                                    })
                                    );
                            
                                    series.columns.template.setAll({
                                    width: am5.percent(120),
                                    fillOpacity: 0.9,
                                    strokeOpacity: 0
                                    });
                                    series.columns.template.adapters.add("fill", (fill, target) => {
                                    return chart.get("colors").getIndex(series.columns.indexOf(target));
                                    });
                            
                                    series.columns.template.adapters.add("stroke", (stroke, target) => {
                                    return chart.get("colors").getIndex(series.columns.indexOf(target));
                                    });
                                    
                                    series.columns.template.set("draw", function(display, target) {
                                    var w = target.getPrivate("width", 0);
                                    var h = target.getPrivate("height", 0);
                                    display.moveTo(0, h);
                                    display.bezierCurveTo(w / 4, h, w / 4, 0, w / 2, 0);
                                    display.bezierCurveTo(w - w / 4, 0, w - w / 4, h, w, h);
                                    });
                            
                                    // Set data
                                    var data = [{
                                    country: "01",
                                    value: 2025
                                    }, {
                                    country: "02",
                                    value: 1882
                                    }, {
                                    country: "03",
                                    value: 1809
                                    }, {
                                    country: "04",
                                    value: 1322
                                    }, {
                                    country: "05",
                                    value: 1122
                                    }, {
                                    country: "06",
                                    value: 1114
                                    }, {
                                    country: "07",
                                    value: 984
                                    }, {
                                    country: "08",
                                    value: 711
                                    }, {
                                    country: "09",
                                    value: 665
                                    }, {
                                    country: "10",
                                    value: 443
                                    }, {
                                    country: "11",
                                    value: 441
                                    }, {
                                    country: "12",
                                    value: 441
                                    }, {
                                    country: "13",
                                    value: 441
                                    }, {
                                    country: "14",
                                    value: 441
                                    }, {
                                    country: "15",
                                    value: 441
                                    }, {
                                    country: "16",
                                    value: 441
                                    }, {
                                    country: "17",
                                    value: 441
                                    }, {
                                    country: "18",
                                    value: 441
                                    }];
                            
                                    xAxis.data.setAll(data);
                                    series.data.setAll(data);
                                    
                                    // Make stuff animate on load
                                    // https://www.amcharts.com/docs/v5/concepts/animations/
                                    series.appear(1000);
                                    chart.appear(1000, 100);
                            
                                 }); // end am5.ready()
                        </script>

                        <!-- HTML -->
                        <div id="chartdiv_agua"></div>


                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;">Consumo de Energia</h3></div>
                            <div class="col-md-2" style="text-align: right">
                                <img src="{{ asset('assets/images/xlsx.png') }}" height="24"> 
                            </div>  
                        </div>

                        <script>
                            am5.ready(function() {
                         
                                // Create root element
                                // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                var root = am5.Root.new("chartdiv_energia");
                                
                                // Set themes
                                // https://www.amcharts.com/docs/v5/concepts/themes/
                                root.setThemes([
                                am5themes_Animated.new(root)
                                ]);
                                
                                // Create chart
                                // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                var chart = root.container.children.push(
                                am5xy.XYChart.new(root, {
                                    panX: true,
                                    panY: true,
                                    wheelX: "panX",
                                    wheelY: "zoomX",
                                    paddingLeft: 5,
                                    paddingRight:5
                                })
                                );
                        
                                // Add cursor
                                // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                cursor.lineY.set("visible", false);
                                
                                // Create axes
                                // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                var xRenderer = am5xy.AxisRendererX.new(root, { 
                                minGridDistance: 60,
                                minorGridEnabled: true
                                });
                        
                                var xAxis = chart.xAxes.push(
                                am5xy.CategoryAxis.new(root, {
                                    maxDeviation: 0.3,
                                    categoryField: "country",
                                    renderer: xRenderer,
                                    tooltip: am5.Tooltip.new(root, {})
                                })
                                );
                                
                                xRenderer.grid.template.setAll({
                                location: 1
                                })
                                
                                var yAxis = chart.yAxes.push(
                                am5xy.ValueAxis.new(root, {
                                    maxDeviation: 0.3,
                                    renderer: am5xy.AxisRendererY.new(root, {
                                    strokeOpacity: 0.1
                                    })
                                })
                                );
                        
                                // Create series
                                // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                var series = chart.series.push(
                                am5xy.ColumnSeries.new(root, {
                                    name: "Series 1",
                                    xAxis: xAxis,
                                    yAxis: yAxis,
                                    valueYField: "value",
                                    sequencedInterpolation: true,
                                    categoryXField: "country"
                                })
                                );
                        
                                series.columns.template.setAll({
                                width: am5.percent(120),
                                fillOpacity: 0.9,
                                strokeOpacity: 0
                                });
                                series.columns.template.adapters.add("fill", (fill, target) => {
                                return chart.get("colors").getIndex(series.columns.indexOf(target));
                                });
                        
                                series.columns.template.adapters.add("stroke", (stroke, target) => {
                                return chart.get("colors").getIndex(series.columns.indexOf(target));
                                });
                                
                                series.columns.template.set("draw", function(display, target) {
                                var w = target.getPrivate("width", 0);
                                var h = target.getPrivate("height", 0);
                                display.moveTo(0, h);
                                display.bezierCurveTo(w / 4, h, w / 4, 0, w / 2, 0);
                                display.bezierCurveTo(w - w / 4, 0, w - w / 4, h, w, h);
                                });
                        
                                // Set data
                                var data = [{
                                country: "01",
                                value: 2025
                                }, {
                                country: "02",
                                value: 1882
                                }, {
                                country: "03",
                                value: 1809
                                }, {
                                country: "04",
                                value: 1322
                                }, {
                                country: "05",
                                value: 1122
                                }, {
                                country: "06",
                                value: 1114
                                }, {
                                country: "07",
                                value: 984
                                }, {
                                country: "08",
                                value: 711
                                }, {
                                country: "09",
                                value: 665
                                }, {
                                country: "10",
                                value: 443
                                }, {
                                country: "11",
                                value: 441
                                }, {
                                country: "12",
                                value: 441
                                }, {
                                country: "13",
                                value: 441
                                }, {
                                country: "14",
                                value: 441
                                }, {
                                country: "15",
                                value: 441
                                }, {
                                country: "16",
                                value: 441
                                }, {
                                country: "17",
                                value: 441
                                }, {
                                country: "18",
                                value: 441
                                }];
                        
                                xAxis.data.setAll(data);
                                series.data.setAll(data);
                                
                                // Make stuff animate on load
                                // https://www.amcharts.com/docs/v5/concepts/animations/
                                series.appear(1000);
                                chart.appear(1000, 100);
                        
                             }); // end am5.ready()
                        </script>

                    <!-- HTML -->
                    <div id="chartdiv_energia"></div>
                    </div>
                </div>
            </div>
        </div>
 
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;">Consumo de Lenha</h3></div>
                            <div class="col-md-2" style="text-align: right">
                                <img src="{{ asset('assets/images/xlsx.png') }}" height="24"> 
                            </div>  
                        </div>
                        <script>
                                am5.ready(function() {
                            
                            
                                    // Create root element
                                    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                    var root = am5.Root.new("chartdiv_lenha");
                                    
                                    // Set themes
                                    // https://www.amcharts.com/docs/v5/concepts/themes/
                                    root.setThemes([
                                    am5themes_Animated.new(root)
                                    ]);
                                    
                                    // Create chart
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                    var chart = root.container.children.push(
                                    am5xy.XYChart.new(root, {
                                        panX: true,
                                        panY: true,
                                        wheelX: "panX",
                                        wheelY: "zoomX",
                                        paddingLeft: 5,
                                        paddingRight:5
                                    })
                                    );
                            
                                    // Add cursor
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                    var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                    cursor.lineY.set("visible", false);
                                    
                                    // Create axes
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                    var xRenderer = am5xy.AxisRendererX.new(root, { 
                                    minGridDistance: 60,
                                    minorGridEnabled: true
                                    });
                            
                                    var xAxis = chart.xAxes.push(
                                    am5xy.CategoryAxis.new(root, {
                                        maxDeviation: 0.3,
                                        categoryField: "country",
                                        renderer: xRenderer,
                                        tooltip: am5.Tooltip.new(root, {})
                                    })
                                    );
                                    
                                    xRenderer.grid.template.setAll({
                                    location: 1
                                    })
                                    
                                    var yAxis = chart.yAxes.push(
                                    am5xy.ValueAxis.new(root, {
                                        maxDeviation: 0.3,
                                        renderer: am5xy.AxisRendererY.new(root, {
                                        strokeOpacity: 0.1
                                        })
                                    })
                                    );
                            
                                    // Create series
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                    var series = chart.series.push(
                                    am5xy.ColumnSeries.new(root, {
                                        name: "Series 1",
                                        xAxis: xAxis,
                                        yAxis: yAxis,
                                        valueYField: "value",
                                        sequencedInterpolation: true,
                                        categoryXField: "country"
                                    })
                                    );
                            
                                    series.columns.template.setAll({
                                    width: am5.percent(120),
                                    fillOpacity: 0.9,
                                    strokeOpacity: 0
                                    });
                                    series.columns.template.adapters.add("fill", (fill, target) => {
                                    return chart.get("colors").getIndex(series.columns.indexOf(target));
                                    });
                            
                                    series.columns.template.adapters.add("stroke", (stroke, target) => {
                                    return chart.get("colors").getIndex(series.columns.indexOf(target));
                                    });
                                    
                                    series.columns.template.set("draw", function(display, target) {
                                    var w = target.getPrivate("width", 0);
                                    var h = target.getPrivate("height", 0);
                                    display.moveTo(0, h);
                                    display.bezierCurveTo(w / 4, h, w / 4, 0, w / 2, 0);
                                    display.bezierCurveTo(w - w / 4, 0, w - w / 4, h, w, h);
                                    });
                            
                                    // Set data
                                    var data = [{
                                    country: "01",
                                    value: 2025
                                    }, {
                                    country: "02",
                                    value: 1882
                                    }, {
                                    country: "03",
                                    value: 1809
                                    }, {
                                    country: "04",
                                    value: 1322
                                    }, {
                                    country: "05",
                                    value: 1122
                                    }, {
                                    country: "06",
                                    value: 1114
                                    }, {
                                    country: "07",
                                    value: 984
                                    }, {
                                    country: "08",
                                    value: 711
                                    }, {
                                    country: "09",
                                    value: 665
                                    }, {
                                    country: "10",
                                    value: 443
                                    }, {
                                    country: "11",
                                    value: 441
                                    }, {
                                    country: "12",
                                    value: 441
                                    }, {
                                    country: "13",
                                    value: 441
                                    }, {
                                    country: "14",
                                    value: 441
                                    }, {
                                    country: "15",
                                    value: 441
                                    }, {
                                    country: "16",
                                    value: 441
                                    }, {
                                    country: "17",
                                    value: 441
                                    }, {
                                    country: "18",
                                    value: 441
                                    }];
                            
                                    xAxis.data.setAll(data);
                                    series.data.setAll(data);
                                    
                                    // Make stuff animate on load
                                    // https://www.amcharts.com/docs/v5/concepts/animations/
                                    series.appear(1000);
                                    chart.appear(1000, 100);
                            
                                 }); // end am5.ready()
                        </script>

                        <!-- HTML -->
                        <div id="chartdiv_lenha"></div>


                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;">Consumo de Polpa</h3></div>
                            <div class="col-md-2" style="text-align: right">
                                <img src="{{ asset('assets/images/xlsx.png') }}" height="24"> 
                            </div>  
                        </div>

                        <script>
                            am5.ready(function() {
                         
                                // Create root element
                                // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                var root = am5.Root.new("chartdiv_polpa");
                                
                                // Set themes
                                // https://www.amcharts.com/docs/v5/concepts/themes/
                                root.setThemes([
                                am5themes_Animated.new(root)
                                ]);
                                
                                // Create chart
                                // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                var chart = root.container.children.push(
                                am5xy.XYChart.new(root, {
                                    panX: true,
                                    panY: true,
                                    wheelX: "panX",
                                    wheelY: "zoomX",
                                    paddingLeft: 5,
                                    paddingRight:5
                                })
                                );
                        
                                // Add cursor
                                // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                cursor.lineY.set("visible", false);
                                
                                // Create axes
                                // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                var xRenderer = am5xy.AxisRendererX.new(root, { 
                                minGridDistance: 60,
                                minorGridEnabled: true
                                });
                        
                                var xAxis = chart.xAxes.push(
                                am5xy.CategoryAxis.new(root, {
                                    maxDeviation: 0.3,
                                    categoryField: "country",
                                    renderer: xRenderer,
                                    tooltip: am5.Tooltip.new(root, {})
                                })
                                );
                                
                                xRenderer.grid.template.setAll({
                                location: 1
                                })
                                
                                var yAxis = chart.yAxes.push(
                                am5xy.ValueAxis.new(root, {
                                    maxDeviation: 0.3,
                                    renderer: am5xy.AxisRendererY.new(root, {
                                    strokeOpacity: 0.1
                                    })
                                })
                                );
                        
                                // Create series
                                // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                var series = chart.series.push(
                                am5xy.ColumnSeries.new(root, {
                                    name: "Series 1",
                                    xAxis: xAxis,
                                    yAxis: yAxis,
                                    valueYField: "value",
                                    sequencedInterpolation: true,
                                    categoryXField: "country"
                                })
                                );
                        
                                series.columns.template.setAll({
                                width: am5.percent(120),
                                fillOpacity: 0.9,
                                strokeOpacity: 0
                                });
                                series.columns.template.adapters.add("fill", (fill, target) => {
                                return chart.get("colors").getIndex(series.columns.indexOf(target));
                                });
                        
                                series.columns.template.adapters.add("stroke", (stroke, target) => {
                                return chart.get("colors").getIndex(series.columns.indexOf(target));
                                });
                                
                                series.columns.template.set("draw", function(display, target) {
                                var w = target.getPrivate("width", 0);
                                var h = target.getPrivate("height", 0);
                                display.moveTo(0, h);
                                display.bezierCurveTo(w / 4, h, w / 4, 0, w / 2, 0);
                                display.bezierCurveTo(w - w / 4, 0, w - w / 4, h, w, h);
                                });
                        
                                // Set data
                                var data = [{
                                country: "01",
                                value: 2025
                                }, {
                                country: "02",
                                value: 1882
                                }, {
                                country: "03",
                                value: 1809
                                }, {
                                country: "04",
                                value: 1322
                                }, {
                                country: "05",
                                value: 1122
                                }, {
                                country: "06",
                                value: 1114
                                }, {
                                country: "07",
                                value: 984
                                }, {
                                country: "08",
                                value: 711
                                }, {
                                country: "09",
                                value: 665
                                }, {
                                country: "10",
                                value: 443
                                }, {
                                country: "11",
                                value: 441
                                }, {
                                country: "12",
                                value: 441
                                }, {
                                country: "13",
                                value: 441
                                }, {
                                country: "14",
                                value: 441
                                }, {
                                country: "15",
                                value: 441
                                }, {
                                country: "16",
                                value: 441
                                }, {
                                country: "17",
                                value: 441
                                }, {
                                country: "18",
                                value: 441
                                }];
                        
                                xAxis.data.setAll(data);
                                series.data.setAll(data);
                                
                                // Make stuff animate on load
                                // https://www.amcharts.com/docs/v5/concepts/animations/
                                series.appear(1000);
                                chart.appear(1000, 100);
                        
                             }); // end am5.ready()
                        </script>

                    <!-- HTML -->
                    <div id="chartdiv_polpa"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;">Parada de Linha</h3></div>
                            <div class="col-md-2" style="text-align: right">
                                <img src="{{ asset('assets/images/xlsx.png') }}" height="24"> 
                            </div>  
                        </div>
                        <script>
                                am5.ready(function() {
                             
                                    // Create root element
                                    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                    var root = am5.Root.new("chartdiv_parada");
                                    
                                    // Set themes
                                    // https://www.amcharts.com/docs/v5/concepts/themes/
                                    root.setThemes([
                                    am5themes_Animated.new(root)
                                    ]);
                                    
                                    // Create chart
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                    var chart = root.container.children.push(
                                    am5xy.XYChart.new(root, {
                                        panX: true,
                                        panY: true,
                                        wheelX: "panX",
                                        wheelY: "zoomX",
                                        paddingLeft: 5,
                                        paddingRight:5
                                    })
                                    );
                            
                                    // Add cursor
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                    var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                    cursor.lineY.set("visible", false);
                                    
                                    // Create axes
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                    var xRenderer = am5xy.AxisRendererX.new(root, { 
                                    minGridDistance: 60,
                                    minorGridEnabled: true
                                    });
                            
                                    var xAxis = chart.xAxes.push(
                                    am5xy.CategoryAxis.new(root, {
                                        maxDeviation: 0.3,
                                        categoryField: "country",
                                        renderer: xRenderer,
                                        tooltip: am5.Tooltip.new(root, {})
                                    })
                                    );
                                    
                                    xRenderer.grid.template.setAll({
                                    location: 1
                                    })
                                    
                                    var yAxis = chart.yAxes.push(
                                    am5xy.ValueAxis.new(root, {
                                        maxDeviation: 0.3,
                                        renderer: am5xy.AxisRendererY.new(root, {
                                        strokeOpacity: 0.1
                                        })
                                    })
                                    );
                            
                                    // Create series
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                    var series = chart.series.push(
                                    am5xy.ColumnSeries.new(root, {
                                        name: "Series 1",
                                        xAxis: xAxis,
                                        yAxis: yAxis,
                                        valueYField: "value",
                                        sequencedInterpolation: true,
                                        categoryXField: "country"
                                    })
                                    );
                            
                                    series.columns.template.setAll({
                                    width: am5.percent(120),
                                    fillOpacity: 0.9,
                                    strokeOpacity: 0
                                    });
                                    series.columns.template.adapters.add("fill", (fill, target) => {
                                    return chart.get("colors").getIndex(series.columns.indexOf(target));
                                    });
                            
                                    series.columns.template.adapters.add("stroke", (stroke, target) => {
                                    return chart.get("colors").getIndex(series.columns.indexOf(target));
                                    });
                                    
                                    series.columns.template.set("draw", function(display, target) {
                                    var w = target.getPrivate("width", 0);
                                    var h = target.getPrivate("height", 0);
                                    display.moveTo(0, h);
                                    display.bezierCurveTo(w / 4, h, w / 4, 0, w / 2, 0);
                                    display.bezierCurveTo(w - w / 4, 0, w - w / 4, h, w, h);
                                    });
                            
                                    // Set data
                                    var data = [{
                                    country: "01",
                                    value: 2025
                                    }, {
                                    country: "02",
                                    value: 1882
                                    }, {
                                    country: "03",
                                    value: 1809
                                    }, {
                                    country: "04",
                                    value: 1322
                                    }, {
                                    country: "05",
                                    value: 1122
                                    }, {
                                    country: "06",
                                    value: 1114
                                    }, {
                                    country: "07",
                                    value: 984
                                    }, {
                                    country: "08",
                                    value: 711
                                    }, {
                                    country: "09",
                                    value: 665
                                    }, {
                                    country: "10",
                                    value: 443
                                    }, {
                                    country: "11",
                                    value: 441
                                    }, {
                                    country: "12",
                                    value: 441
                                    }, {
                                    country: "13",
                                    value: 441
                                    }, {
                                    country: "14",
                                    value: 441
                                    }, {
                                    country: "15",
                                    value: 441
                                    }, {
                                    country: "16",
                                    value: 441
                                    }, {
                                    country: "17",
                                    value: 441
                                    }, {
                                    country: "18",
                                    value: 441
                                    }];
                            
                                    xAxis.data.setAll(data);
                                    series.data.setAll(data);
                                    
                                    // Make stuff animate on load
                                    // https://www.amcharts.com/docs/v5/concepts/animations/
                                    series.appear(1000);
                                    chart.appear(1000, 100);
                            
                                 }); // end am5.ready()
                        </script>

                        <!-- HTML -->
                        <div id="chartdiv_parada"></div>
 
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;">Tipo de Paradas</h3></div>
                             
                        </div> 

                        <script>
                            var chart = AmCharts.makeChart( "chartdiv_tp_parada", {
                              "type": "pie",
                              "theme": "none",
                              "dataProvider": [ {
                                "country": "Lithuania",
                                "litres": 501.9
                              }, {
                                "country": "Czech Republic",
                                "litres": 301.9
                              }, {
                                "country": "Ireland",
                                "litres": 201.1
                              }, {
                                "country": "Germany",
                                "litres": 165.8
                              }, {
                                "country": "Australia",
                                "litres": 139.9
                              }, {
                                "country": "Austria",
                                "litres": 128.3
                              }, {
                                "country": "UK",
                                "litres": 99
                              }, {
                                "country": "Belgium",
                                "litres": 60
                              }, {
                                "country": "The Netherlands",
                                "litres": 50
                              } ],
                              "valueField": "litres",
                              "titleField": "country",
                               "balloon":{
                               "fixedPosition":true
                              } 
                            } );
                        </script> 
                       
                        <!-- HTML -->
                        <div id="chartdiv_tp_parada"></div>
                    </div>
                </div>
            </div>
        </div>
 
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;">Perdas</h3></div>
                            <div class="col-md-2" style="text-align: right">
                                <img src="{{ asset('assets/images/xlsx.png') }}" height="24"> 
                            </div>  
                        </div>
                        <script>
                                am5.ready(function() {
                             
                                    // Create root element
                                    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                    var root = am5.Root.new("chartdiv_perda");
                                    
                                    // Set themes
                                    // https://www.amcharts.com/docs/v5/concepts/themes/
                                    root.setThemes([
                                    am5themes_Animated.new(root)
                                    ]);
                                    
                                    // Create chart
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                    var chart = root.container.children.push(
                                    am5xy.XYChart.new(root, {
                                        panX: true,
                                        panY: true,
                                        wheelX: "panX",
                                        wheelY: "zoomX",
                                        paddingLeft: 5,
                                        paddingRight:5
                                    })
                                    );
                            
                                    // Add cursor
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                    var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                    cursor.lineY.set("visible", false);
                                    
                                    // Create axes
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                    var xRenderer = am5xy.AxisRendererX.new(root, { 
                                    minGridDistance: 60,
                                    minorGridEnabled: true
                                    });
                            
                                    var xAxis = chart.xAxes.push(
                                    am5xy.CategoryAxis.new(root, {
                                        maxDeviation: 0.3,
                                        categoryField: "country",
                                        renderer: xRenderer,
                                        tooltip: am5.Tooltip.new(root, {})
                                    })
                                    );
                                    
                                    xRenderer.grid.template.setAll({
                                    location: 1
                                    })
                                    
                                    var yAxis = chart.yAxes.push(
                                    am5xy.ValueAxis.new(root, {
                                        maxDeviation: 0.3,
                                        renderer: am5xy.AxisRendererY.new(root, {
                                        strokeOpacity: 0.1
                                        })
                                    })
                                    );
                            
                                    // Create series
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                    var series = chart.series.push(
                                    am5xy.ColumnSeries.new(root, {
                                        name: "Series 1",
                                        xAxis: xAxis,
                                        yAxis: yAxis,
                                        valueYField: "value",
                                        sequencedInterpolation: true,
                                        categoryXField: "country"
                                    })
                                    );
                            
                                    series.columns.template.setAll({
                                    width: am5.percent(120),
                                    fillOpacity: 0.9,
                                    strokeOpacity: 0
                                    });
                                    series.columns.template.adapters.add("fill", (fill, target) => {
                                    return chart.get("colors").getIndex(series.columns.indexOf(target));
                                    });
                            
                                    series.columns.template.adapters.add("stroke", (stroke, target) => {
                                    return chart.get("colors").getIndex(series.columns.indexOf(target));
                                    });
                                    
                                    series.columns.template.set("draw", function(display, target) {
                                    var w = target.getPrivate("width", 0);
                                    var h = target.getPrivate("height", 0);
                                    display.moveTo(0, h);
                                    display.bezierCurveTo(w / 4, h, w / 4, 0, w / 2, 0);
                                    display.bezierCurveTo(w - w / 4, 0, w - w / 4, h, w, h);
                                    });
                            
                                    // Set data
                                    var data = [{
                                    country: "01",
                                    value: 2025
                                    }, {
                                    country: "02",
                                    value: 1882
                                    }, {
                                    country: "03",
                                    value: 1809
                                    }, {
                                    country: "04",
                                    value: 1322
                                    }, {
                                    country: "05",
                                    value: 1122
                                    }, {
                                    country: "06",
                                    value: 1114
                                    }, {
                                    country: "07",
                                    value: 984
                                    }, {
                                    country: "08",
                                    value: 711
                                    }, {
                                    country: "09",
                                    value: 665
                                    }, {
                                    country: "10",
                                    value: 443
                                    }, {
                                    country: "11",
                                    value: 441
                                    }, {
                                    country: "12",
                                    value: 441
                                    }, {
                                    country: "13",
                                    value: 441
                                    }, {
                                    country: "14",
                                    value: 441
                                    }, {
                                    country: "15",
                                    value: 441
                                    }, {
                                    country: "16",
                                    value: 441
                                    }, {
                                    country: "17",
                                    value: 441
                                    }, {
                                    country: "18",
                                    value: 441
                                    }];
                            
                                    xAxis.data.setAll(data);
                                    series.data.setAll(data);
                                    
                                    // Make stuff animate on load
                                    // https://www.amcharts.com/docs/v5/concepts/animations/
                                    series.appear(1000);
                                    chart.appear(1000, 100);
                            
                                 }); // end am5.ready()
                        </script>

                        <!-- HTML -->
                        <div id="chartdiv_perda"></div>
 
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8"><h3 class="panel-title text-center" style="color: #0e0e0e;">Motivos de Perdas</h3></div> 
                        </div> 
                        
                        <script>
                            var chart = AmCharts.makeChart( "chartdiv_tp_perda", {
                              "type": "pie",
                              "theme": "none",
                              "dataProvider": [ {
                                "country": "Lithuania",
                                "litres": 501.9
                              }, {
                                "country": "Czech Republic",
                                "litres": 301.9
                              }, {
                                "country": "Ireland",
                                "litres": 201.1
                              }, {
                                "country": "Germany",
                                "litres": 165.8
                              }, {
                                "country": "Australia",
                                "litres": 139.9
                              }, {
                                "country": "Austria",
                                "litres": 128.3
                              }, {
                                "country": "UK",
                                "litres": 99
                              }, {
                                "country": "Belgium",
                                "litres": 60
                              }, {
                                "country": "The Netherlands",
                                "litres": 50
                              } ],
                              "valueField": "litres",
                              "titleField": "country",
                               "balloon":{
                               "fixedPosition":true
                              } 
                            } );
                        </script> 
                       
                        <!-- HTML -->
                        <div id="chartdiv_tp_perda"></div>
                    </div>
                </div>
            </div>
        </div>

     
    </div>
 
    <x-slot name="scripts"> 
        <script src="{{ asset('js/paginas/previsto_realizado.js') }}"></script>
    </x-slot>
</x-layout.colonial.layout>
