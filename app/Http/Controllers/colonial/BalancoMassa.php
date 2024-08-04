<?php

namespace App\Http\Controllers\colonial;

use App\Http\Controllers\Controller;
use App\Models\BalancoMassa as ModelsBalancoMassa;
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
                return ModelsBalancoMassa::create($dados); 
 
            }); 

            return redirect()->route('balancomassa-editar',$retorno)->with('success', 'Balanço de Massa cadastrada com sucesso!');
        }
        catch(\Exception $e) {
            return back()->withErrors(['error' => 'Houve um erro ao atualizar a Balanço de Massa! <br>'.$e->getMessage()])->withInput();
        }
    }

    public function edit(ModelsBalancoMassa $balanco) {  
 
        $fornecedor = Fornecedor::whereRaw("GroupCode=2")->selectRaw("CardCode codigo,CardName nome")->orderBy("CardName")->get(); 
        return view('colonial.balanco-massa.editar', compact('balanco','fornecedor'));
        
    }

    public function update(Request $request,ModelsClassificacaoTomate $tomate) {
        
        $validator = Validator::make($request->all(), [
            'dt_recebimento' => 'required|date',  
            'verde' => 'required', 
            'residuo' => 'required',
            'sujeira' => 'required', 
            'terra' => 'required', 
            'total' => 'required',    
            'obs' => 'nullable|max:1024' 
        ],[
            'dt_recebimento.required' => 'O campo Data de recebimento é obrigatorio' 
        ]);
        
        if ($validator->fails()) {  
            return back()->withErrors($validator)->withInput();
        }
 
        try {
           $dados =$validator->validate(); 
           $retorno = DB::transaction(function () use($dados,$tomate) {
  
                $dados['total']=  str_replace(",",".",str_replace(".","",$dados['total']));
                $dados['verde']=  str_replace(",",".",str_replace(".","",$dados['verde']));
                $dados['residuo']=  str_replace(",",".",str_replace(".","",$dados['residuo']));
                $dados['sujeira']=  str_replace(",",".",str_replace(".","",$dados['sujeira']));   
                $dados['terra']=  str_replace(",",".",str_replace(".","",$dados['terra'])); 
                $dados['total']=  str_replace(",",".",str_replace("","",$dados['total']));  
                
                return $tomate->update($dados);

            }); 
        
            return redirect()->route('classificacaotomate-listar')->with('success', 'Classificação de Tomate atualizada com sucesso!');
             
        }
        catch(\Exception $e) {
            return back()->withErrors(['error' => 'Houve um erro ao atualizar a Recebimento! '.$e->getMessage()])->withInput();
        }

    }

    public function destroy(ModelsClassificacaoTomate $tomate) { 
        try { $tomate->delete(); }
        catch(\Exception $e) { abort(500); }
    }
 
    
}
