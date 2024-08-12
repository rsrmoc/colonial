<?php

namespace App\Http\Controllers\colonial;

use App\Http\Controllers\Controller;
use App\Models\BalancoMassa as ModelsBalancoMassa;
use App\Models\BalancoMassaClassif;
use App\Models\BalancoMassaEntrada;
use App\Models\BalancoMassaPolpa;
use App\Models\Boleto;
use App\Models\ClassificacaoTomate as ModelsClassificacaoTomate;
use App\Models\Condominio;
use App\Models\Energia as ModelsEnergia;
use App\Models\Hospital;
use App\Models\Parada;
use App\Models\Perda;
use App\Models\Produto;
use App\Models\RecebimentoTomate;
use App\Models\Sap\Estoque;
use App\Models\Sap\Fornecedor;
use App\Models\Sap\ordemProducao;
use App\Models\Sap\Produto as SapProduto;
use App\Models\TipoParada;
use App\Models\TipoPerda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BalancoMassa extends Controller
{

    public function lista(Request $request) {

        if ($request->has('b')) {
            $balanco  = ModelsBalancoMassa::orWhere('nm_lavoura', 'LIKE', "%{$request->b}%")  
                ->orWhere('nm_fornecedor', 'LIKE', "%{$request->b}%") 
                ->orderByRaw('dt_inicial desc')
                ->paginate(50)->appends($request->query());
        } else {
            $balanco  = ModelsBalancoMassa::orderByRaw('dt_inicial desc')    
            ->paginate(50)->appends($request->query());
        }
  
        return view('colonial.balanco-massa.lista', compact('balanco'));

    }

    public function create() {
        
        $fornecedor = Fornecedor::whereRaw("GroupCode=2")->selectRaw("CardCode codigo,CardName nome")->orderBy("CardName")->get(); 
        return view('colonial.balanco-massa.criar', compact('fornecedor'));
        
    }
 
    public function store(Request $request) {
 
        
        $validator = Validator::make($request->all(), [
            'nm_balanco' => 'required',  
            'dt_inicial' => 'required|date', 
            'dt_final' => 'required|date',
            'cd_fornecedor' => 'required', 
            'brix_ponderado' => 'required',  
            'obs' => 'nullable|max:512' 
        ]);
        
        if ($validator->fails()) {  
            return back()->withErrors($validator)->withInput();
        }

        $dados=$validator->validate(); 

        try {

           $retorno= DB::transaction(function () use($dados) {
            
                $dados['brix_ponderado']=  str_replace(",",".",str_replace(".","",$dados['brix_ponderado']));     
                $forn=Fornecedor::selectRaw("CardCode codigo,CardName nome")->find($dados['cd_fornecedor']); 
                $dados['cd_fornecedor']=$forn->codigo;
                $dados['nm_fornecedor']=$forn->nome; 
                $dados['cd_usuario'] = Auth::user()->id;
                return ModelsBalancoMassa::create($dados); 
 
            }); 

            return redirect()->route('balancomassa-editar',$retorno)->with('success', 'Balanço de Massa cadastrada com sucesso!');
        }
        catch(\Exception $e) {
            return back()->withErrors(['error' => 'Houve um erro ao atualizar a Balanço de Massa! <br>'.$e->getMessage()])->withInput();
        }
    }

    public function edit(Request $request, ModelsBalancoMassa $balanco) {  

        $balanco['brix_ponderado']=  str_replace(".",",",$balanco['brix_ponderado']); 
 
        $balanco->load('balanco_entradas');
        $retorno['tab']='upd';
        if($request['tab']=='ent'){
            
            $retorno['tab']='ent';

            $retorno['entrada'] = DB::select(" 
            select  TOP (20) OPCH.DocNum doc_num,CONVERT(CHAR(10),OPCH.DocDate, 103) doc_date,OPCH.CardCode card_code,OPCH.CardName card_name,
            OPCH.Address address, replace( cast( (PCH1.Quantity) as decimal(18,2)) ,'.',',') qtde,balanco_massa_entrada.cd_entrada
            from SBO_KARAMBI_PRD.dbo.OPCH
            inner join SBO_KARAMBI_PRD.dbo.PCH1 on PCH1.DocEntry=OPCH.DocEntry
            left join balanco_massa_entrada on balanco_massa_entrada.cd_entrada = OPCH.DocNum
             where PCH1.ItemCode='001208'
            and   CONVERT(CHAR(10),OPCH.DocDate, 23) between '".$request['dt_inicial']."' and '".$request['dt_final']."'
            and OPCH.DocStatus = 'O'  
            order by OPCH.DocDate ");
        }
        if($request['tab']=='cla'){
            $retorno['tab']='cla';
            $retorno['classificacao'] = ModelsClassificacaoTomate::whereBetween('dt_recebimento',[$request['dt_inicial'],$request['dt_final']])
            ->where('cd_fornecedor',$balanco['cd_fornecedor'])
            ->orderBy('dt_recebimento')->get();
        }
        if($request['tab']=='ent_polpa'){
            $retorno['tab']='ent_polpa';
            $retorno['entrada_polpa'] = DB::select(" select owor.DocEntry,  DueDate, owor.itemCode,oitm.itemName, 
            CmpltQty quant_producao ,Quantity quant_estoque 
            from  SBO_KARAMBI_PRD.dbo.owor 
            inner join SBO_KARAMBI_PRD.dbo.oitm on oitm.ItemCode=owor.ItemCode 
            left join 
                (select BaseRef,sum(Quantity) Quantity from SBO_KARAMBI_PRD.dbo.ige1 where ItemCode ='002463' group by BaseRef ) ige1_bag 
                on ige1_bag.BaseRef=owor.DocEntry
            where Warehouse='MPP' and owor.ItemCode <> '001208'
            and CONVERT(CHAR(10),DueDate, 23) between '".$request['dt_inicial']."' and '".$request['dt_final']."'
            order by DueDate");
        }




     
        $fornecedor = Fornecedor::whereRaw("GroupCode=2")->selectRaw("CardCode codigo,CardName nome")->orderBy("CardName")->get(); 
        return view('colonial.balanco-massa.editar', compact('balanco','fornecedor','retorno','request'));
        
    }



    public function update(Request $request,ModelsBalancoMassa $balanco) {
        
        $validator = Validator::make($request->all(), [
            'nm_balanco' => 'required',  
            'dt_inicial' => 'required|date', 
            'dt_final' => 'required|date',
            'cd_fornecedor' => 'required', 
            'brix_ponderado' => 'required',  
            'obs' => 'nullable|max:512' 
        ]);
        
        if ($validator->fails()) {  
            return back()->withErrors($validator)->withInput();
        }
 
        try {
           $dados =$validator->validate(); 
           $retorno = DB::transaction(function () use($dados,$balanco) {
  
                $dados['brix_ponderado']=  str_replace(",",".",str_replace(".","",$dados['brix_ponderado']));     
                $forn=Fornecedor::selectRaw("CardCode codigo,CardName nome")->find($dados['cd_fornecedor']); 
                $dados['cd_fornecedor']=$forn->codigo;
                $dados['nm_fornecedor']=$forn->nome;  
                $dados['cd_usuario'] = Auth::user()->id;
                
                return $balanco->update($dados);

            }); 
        
            return redirect()->route('balancomassa-listar')->with('success', 'Balanço de Massa atualizada com sucesso!');
             
        }
        catch(\Exception $e) {
            return back()->withErrors(['error' => 'Houve um erro ao atualizar a Recebimento! '.$e->getMessage()])->withInput();
        }

    }

    public function entrada(Request $request,ModelsBalancoMassa $balanco) {

        $validator = Validator::make($request->all(), [
            'codigo' => 'required|array',   
            'tipo' => 'required',   
        ]);
        
        if ($validator->fails()) {  
            return back()->withErrors($validator)->withInput();
        }

        if($request['tipo']=='tomate'){
            BalancoMassaEntrada::where('cd_balanco',$balanco->cd_balanco)->delete();
            foreach($request['codigo'] as $linha){
                BalancoMassaEntrada::create(['cd_balanco'=>$balanco->cd_balanco,'cd_entrada'=>$linha,'cd_usuario'=> Auth::user()->id]);
            }
            return redirect()->route('balancomassa-editar',$balanco)->with('success', 'Entradas cadastradas com sucesso!');
        }
        if($request['tipo']=='polpa'){
            BalancoMassaPolpa::where('cd_balanco',$balanco->cd_balanco)->delete();
            foreach($request['codigo'] as $linha){
                BalancoMassaPolpa::create(['cd_balanco'=>$balanco->cd_balanco,'cd_ordem'=>$linha,'cd_usuario'=> Auth::user()->id]);
            }
            return redirect()->route('balancomassa-editar',$balanco)->with('success', 'Polpas cadastradas com sucesso!');
        }

        if($request['tipo']=='classificacao'){
            BalancoMassaClassif::where('cd_balanco',$balanco->cd_balanco)->delete();
            foreach($request['codigo'] as $linha){
                BalancoMassaClassif::create(['cd_balanco'=>$balanco->cd_balanco,'cd_classificacao'=>$linha,'cd_usuario'=> Auth::user()->id]);
            }
            return redirect()->route('balancomassa-editar',$balanco)->with('success', 'Classificação cadastradas com sucesso!');
        }
         
        return redirect()->route('balancomassa-editar',$balanco)->with('error', 'Tipo não cadastrado!');
        
    }


    public function destroy(ModelsClassificacaoTomate $tomate) { 
        try { $tomate->delete(); }
        catch(\Exception $e) { abort(500); }
    }
 
    
}
