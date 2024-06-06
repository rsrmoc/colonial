const chart1Ctx = document.querySelector('#chart-1');
const chart2Ctx = document.querySelector('#chart-2');
const chart3Ctx = document.querySelector('#chart-3');
const chart4Ctx = document.querySelector('#chart-4');
 
const chartPrevReal = document.querySelector('#chart-prev_realizado');
 

Alpine.data('app', () => ({

    graficoBarra: "<div style='text-align: center;margin-top: 110px;'> <img src='/assets/images/grafico-barra.png'> </div>",
    graficoBarraTipo: "<div style='text-align: center;margin-top: 40px;'> <img src='/assets/images/grafico-barra.png'> </div>",
    graficoBarra2: "<div style='text-align: center;margin-top: 25px;'> <img src='/assets/images/grafico-barra.png'> </div>",
    graficoPizza: "<div style='text-align: center;margin-top: 110px;'> <img src='/assets/images/grafico-pizza.png'> </div>",

    iconCarregando: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderMoagemTotal: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderMoagemTotalTb: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderMoagemEstoque: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>', 
    iconHeaderMoagemEstoqueTb: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>', 
    iconHeaderMoagemConsumida: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderMoagemConsumidaTb: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>', 
    iconHeaderTomateInNatura : '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderBrix: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderBrixMedio: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>', 
    iconHeaderPerdas: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
    iconHeaderPerdasPerc: '<i class="fa fa-spinner  fa-spin" aria-hidden="true" style="color: #f9fafa;"></i>',
 
    titleMoagemDiaria: 'Produção de Polpas Diária ',
    titleMoagemDiariaEstoque: 'Entrada de Polpas Diária para o Estoque ',
    titleMoagemDiariaConsumida: 'Entrada de Polpas Diária Consumida ',
    titleComparacaoFornec: 'Comparação entre Fornecedores ',
    titleMoagem: 'Moagem Diária ',
 
    
    parametros: {
      valida: false,
      dti: null,
      dtf:  null,
      agrupamento: '',
      unidade: '',
      ano: '',
      mes: '',
      dia: '', 
    },
    TotDias: 0,
    TotMeses: null,
    loadingCharts: false,

  
    init() {
  

      $('#indicadores-parametros #parametro-ano').on('select2:select', () => {
        var Ano =$('#indicadores-parametros #parametro-ano').val();
        var Mes =$('#indicadores-parametros #parametro-mes').val();
        console.log(Ano+' - M'+Mes);
        if(Ano){
          if(Mes){
            this.TotDias = this.TotMeses[Ano][Number(Mes)];
          }
        } 
      });
          
      $('#indicadores-parametros #parametro-mes').on('select2:select', () => { 
        var Ano =$('#indicadores-parametros #parametro-ano').val();
        var Mes =$('#indicadores-parametros #parametro-mes').val(); 
        console.log(Ano+' - M'+Mes);
        if(Ano){
          if(Mes){
            this.TotDias = this.TotMeses[Ano][Number(Mes)]; 
          }
        }  
      });
      
      this.getDataChartPrincipal();
 
    },

    getDataChartPrincipal(){
 
      this.loadingCharts = true;
      this.parametros.dia = $('#parametro-dia').val();
      this.parametros.mes = $('#parametro-mes').val();
      this.parametros.ano = $('#parametro-ano').val();
      this.parametros.unidade = $('#parametro-visao').val();

      this.iconHeaderMoagemTotal = this.iconCarregando;
      this.iconHeaderMoagemTotalTb = this.iconCarregando;
      this.iconHeaderMoagemEstoque = this.iconCarregando;
      this.iconHeaderMoagemEstoqueTb = this.iconCarregando;
      this.iconHeaderMoagemConsumida = this.iconCarregando;
      this.iconHeaderMoagemConsumidaTb = this.iconCarregando;
      this.iconHeaderTomateInNatura = this.iconCarregando;
      this.iconHeaderBrix = this.iconCarregando;
      this.iconHeaderPerdas = this.iconCarregando;
      this.iconHeaderPerdasPerc  = this.iconCarregando;

      axios.post('/colonial/safra-json',this.parametros)
      .then((res) => {
        console.log(res); 

        this.iconHeaderMoagemTotal = res.data.request.MoagemTotalKg+'<span class="headerUnidade"> (Kg) </span>';
        this.iconHeaderMoagemTotalTb = res.data.request.MoagemTotalTb+'<span class="headerUnidade"> (Tb) </span>';
        this.iconHeaderMoagemEstoque = res.data.request.MoagemEstoqueKg+'<span class="headerUnidade"> (Kg) </span>';
        this.iconHeaderMoagemEstoqueTb = res.data.request.MoagemEstoqueTb+'<span class="headerUnidade"> (Tb) </span>';
        this.iconHeaderMoagemConsumida = res.data.request.MoagemConsumidaKg+'<span class="headerUnidade"> (Kg) </span>';
        this.iconHeaderMoagemConsumidaTb = res.data.request.MoagemConsumidaTb+'<span class="headerUnidade"> (Tb) </span>';
        this.iconHeaderTomateInNatura = res.data.request.TomateInNatura+'<span class="headerUnidade"> (Kg) </span>';
        this.iconHeaderBrix = res.data.request.Brix+'<span class="headerUnidade">   </span>';
        this.iconHeaderPerdas = res.data.request.PerdasTotal+'<span class="headerUnidade"> (Kg) </span>';
        this.iconHeaderPerdasPerc = res.data.request.PerdasTotalPerc+'<span class="headerUnidade"> (%) </span>';

              /* Grafico Moagem Diaria */ 
        this.titleMoagem = 'Moagem Diária em Kilos '  ;
        var chart = AmCharts.makeChart("chartdivMoagemDiaria", {
          "decimalSeparator": ",",
          "thousandsSeparator": ".",
          "type": "serial",
          "fontSize": 12,
          "theme": "none",
          "categoryField": "label",
          "rotate": false,
          "startDuration": 1,
          "categoryAxis": {
            "gridPosition": "start",
            "position": "left",
            "labelRotation": 20
          },
      
          "graphs": [
            {
              "balloonText": "Produzido : <b>[[value]] (%)  </b>",
              "fillAlphas": 1,
              "id": "AmGraph-1",
              "lineAlpha": 0.2,
              "title": "% de Produção",
              "labelText": "[[value]]",
              "type": "column",
              "valueField": "producao",
              "fillColorsField": "color_producao", 
              "lineColor": "#ff3f33",   

            }
          ],
          "valueAxes": [{
            "axisAlpha": 0.2,
            "id": "v1",
            "minimum": 0 
          }],
          "listeners": [{
            "event": "clickGraphItem",
            "method":(event) => {
                   
              //this.getDetalhesProducao(event.item.dataContext); 
                      
            }
          }], 
          "dataProvider": res.data.MoagemDiaria 
        });

        /* Grafico Moagem Diaria */ 
        this.titleMoagemDiaria = 'Produção de Polpa Diária ' +res.data.request.ds_unid  ;
        var chart = AmCharts.makeChart("chartdivMoagemTotal", {
          "decimalSeparator": ",",
          "thousandsSeparator": ".",
          "type": "serial",
          "fontSize": 12,
          "theme": "none",
          "categoryField": "label",
          "rotate": false,
          "startDuration": 1,
          "categoryAxis": {
            "gridPosition": "start",
            "position": "left",
            "labelRotation": 20
          },
      
          "graphs": [
            {
              "balloonText": "Produzido : <b>[[value]] (%)  </b>",
              "fillAlphas": 1,
              "id": "AmGraph-1",
              "lineAlpha": 0.2,
              "title": "% de Produção",
              "labelText": "[[value]]",
              "type": "column",
              "valueField": "producao",
              "fillColorsField": "color_producao", 
              "lineColor": "#ff3f33",   

            }
          ],
          "valueAxes": [{
            "axisAlpha": 0.2,
            "id": "v1",
            "minimum": 0 
          }],
          "listeners": [{
            "event": "clickGraphItem",
            "method":(event) => {
                   
              //this.getDetalhesProducao(event.item.dataContext); 
                      
            }
          }], 
          "dataProvider": res.data.MoagemTotal 
        });

        /* Grafico Moagem Consumida */ 
        this.titleMoagemDiariaConsumida = 'Polpas Consumida Diária ' +res.data.request.ds_unid  ;
        var chart = AmCharts.makeChart("chartdivMoagemConsumida", {
          "decimalSeparator": ",",
          "thousandsSeparator": ".",
          "type": "serial",
          "fontSize": 12,
          "theme": "none",
          "categoryField": "label",
          "rotate": false,
          "startDuration": 1,
          "categoryAxis": {
            "gridPosition": "start",
            "position": "left",
            "labelRotation": 20
          },
      
          "graphs": [
            {
              "balloonText": "Produzido : <b>[[value]] (%)  </b>",
              "fillAlphas": 1,
              "id": "AmGraph-1",
              "lineAlpha": 0.2,
              "title": "% de Produção",
              "labelText": "[[value]]",
              "type": "column",
              "valueField": "producao",
              "fillColorsField": "color_producao", 
              "lineColor": "#ff7519",   

            }
          ],
          "valueAxes": [{
            "axisAlpha": 0.2,
            "id": "v1",
            "minimum": 0 
          }],
          "listeners": [{
            "event": "clickGraphItem",
            "method":(event) => {
                   
              //this.getDetalhesProducao(event.item.dataContext); 
                      
            }
          }], 
          "dataProvider": res.data.MoagemConsumida 
        });

        /* Grafico Moagem Estoque */ 
        this.titleMoagemDiariaEstoque = 'Entrada de Polpas para oEstoque Diária ' +res.data.request.ds_unid  ;
        var chart = AmCharts.makeChart("chartdivMoagemEstoque", {
          "decimalSeparator": ",",
          "thousandsSeparator": ".",
          "type": "serial",
          "fontSize": 12,
          "theme": "none",
          "categoryField": "label",
          "rotate": false,
          "startDuration": 1,
          "categoryAxis": {
            "gridPosition": "start",
            "position": "left",
            "labelRotation": 20
          },
      
          "graphs": [
            {
              "balloonText": "Produzido : <b>[[value]] (%)  </b>",
              "fillAlphas": 1,
              "id": "AmGraph-1",
              "lineAlpha": 0.2,
              "title": "% de Produção",
              "labelText": "[[value]]",
              "type": "column",
              "valueField": "producao",
              "fillColorsField": "color_producao", 
              "lineColor": "#ff7519",   

            }
          ],
          "valueAxes": [{
            "axisAlpha": 0.2,
            "id": "v1",
            "minimum": 0 
          }],
          "listeners": [{
            "event": "clickGraphItem",
            "method":(event) => {
                   
              //this.getDetalhesProducao(event.item.dataContext); 
                      
            }
          }], 
          "dataProvider": res.data.MoagemEstoque 
        });
 
        /* Grafico Fornecedores */ 
        var chart = AmCharts.makeChart("chartdivFornecedor", {
          "decimalSeparator": ",",
          "thousandsSeparator": ".",
          "fontSize": 11,
          "type": "serial",
          "theme": "none",
          "rotate": true, 
          "dataProvider": res.data.Fornecedores,
                 
          "startDuration": 1,
          "graphs": [{
            "balloonText": "<b>[[category]]: [[value]] ( Kg ) </b>",
            "fillColorsField": "color",
            "fillAlphas": 0.9,
            "labelText": "[[value]]",
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "qtde",
            "fixedColumnWidth": 50,
          }],
          "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
          },
          "categoryField": "produto",
          "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 45
          } 
                
        });

        if(!res.data.Fornecedores){
           $("#chartdivProdutos").html(this.graficoBarra);
        } 
 
        this.TotMeses = res.data.request.Meses;
        this.parametros.valida = true;
        $('#indicadores-parametros #parametro-ano').val(res.data.request.ano).trigger('change');
        $('#indicadores-parametros #parametro-mes').val(res.data.request.mes).trigger('change');
        if(res.data.request.ano){
          if(res.data.request.mes){
            this.TotDias = this.TotMeses[res.data.request.ano][Number(res.data.request.mes)];
          }
        } 
      })
      .catch((err) => { 
        console.log(err.response.data); 
        toastr.error(err.response.data.message,"Erro") 
      })
      .finally(() => this.loadingCharts = false);

    } 

  

}));
