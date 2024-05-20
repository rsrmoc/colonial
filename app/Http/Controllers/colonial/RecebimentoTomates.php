<?php

namespace App\Http\Controllers\colonial;

use App\Http\Controllers\Controller;
use App\Models\Boleto;
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

class RecebimentoTomates extends Controller
{
    public function lista(Request $request) {

        if ($request->has('b')) {
            $perda  = RecebimentoTomate::orWhere('dt_recebimento', 'LIKE', "%{$request->b}%") 
                ->orWhere('cd_recebimento', 'LIKE', "%{$request->b}%")
                ->orWhere('nr_controle', 'LIKE', "%{$request->b}%")
                ->orWhere('nm_fornecedor', 'LIKE', "%{$request->b}%")
                ->orderByRaw('dt_recebimento desc')
                ->paginate(50)->appends($request->query());
        } else {
            $perda  = RecebimentoTomate::orderByRaw('dt_recebimento desc')    
            ->paginate(50)->appends($request->query());
        }

        //$perda->load('tab_ordem','tab_tipo','tab_produto');
         //$perda->load('tab_ordem','tab_tipo');
         
       

        return view('colonial.recebimento-tomate.lista', compact('perda'));

    }

    public function create() {
        
        $fornecedor = Fornecedor::whereRaw("GroupCode=2")->selectRaw("CardCode codigo,CardName nome")->orderBy("CardName")->get();   
        return view('colonial.recebimento-tomate.criar', compact('fornecedor'));
    }
 
    public function store(Request $request) {
 
        
        $validator = Validator::make($request->all(), [
            'dt_recebimento' => 'required|date',
            'hr_inicial' => 'required|date_format:H:i',
            'hr_final' => 'required|date_format:H:i',
            'nr_controle' => 'required',
            'placa' => 'required',
            'fornecedor' => 'required',
            'verde' => 'required',
            'praga' => 'required',
            'fungo' => 'required',
            'desintegrado' => 'required',
            'defeito' => 'required',
            'impureza' => 'required',
            'terra' => 'required',
            'fruto' => 'required',
            'total' => 'required',
            'brix' => 'required',
            'ph' => 'required',
            'acidez' => 'required',
            'liquido' => 'required',
            'desconto' => 'required',
            'obs' => 'nullable|max:1024' 
        ]);
        
        if ($validator->fails()) {  
            return back()->withErrors($validator)->withInput();
        }
        $dados=$validator->validate();
       



        try {
           $retorno= DB::transaction(function () use($dados) {
            
            $dados['verde']=  str_replace(",",".",str_replace(".","",$dados['verde']));
            $dados['praga']=  str_replace(",",".",str_replace(".","",$dados['praga']));
            $dados['fungo']=  str_replace(",",".",str_replace(".","",$dados['fungo']));
            $dados['desintegrado']=  str_replace(",",".",str_replace(".","",$dados['desintegrado']));
            $dados['defeito']=  str_replace(",",".",str_replace(".","",$dados['defeito']));
            $dados['impureza']=  str_replace(",",".",str_replace(".","",$dados['impureza']));
            $dados['terra']=  str_replace(",",".",str_replace(".","",$dados['terra']));
            $dados['fruto']=  str_replace(",",".",str_replace(".","",$dados['fruto']));
            $dados['total']=  str_replace(",",".",str_replace("","",$dados['total']));
            $dados['brix']=  str_replace(",",".",str_replace(".","",$dados['brix']));
            $dados['ph']=  str_replace(",",".",str_replace(".","",$dados['ph']));
            $dados['acidez']=  str_replace(",",".",str_replace(".","",$dados['acidez']));
            $dados['liquido']=  str_replace(",",".",str_replace(".","",$dados['liquido']));
            $dados['desconto']=  str_replace(",",".",str_replace(".","",$dados['desconto']));  
            
            $forn=Fornecedor::selectRaw("CardCode codigo,CardName nome")->find($dados['fornecedor']); 
            $dados['cd_fornecedor']=$forn->codigo;
            $dados['nm_fornecedor']=$forn->nome; 
            return RecebimentoTomate::create($dados); 
 
            }); 

            return redirect()->route('recebimentotomate-listar')->with('success', 'Cadastro cadastrada com sucesso!');
        }
        catch(\Exception $e) {
            return back()->withErrors(['error' => 'Houve um erro ao atualizar a Perda! <br>'.$e->getMessage()])->withInput();
        }
    }

    public function edit(RecebimentoTomate $tomate) {  

        $fornecedor = Fornecedor::whereRaw("GroupCode=2")->selectRaw("CardCode codigo,CardName nome")->orderBy("CardName")->get(); 
        return view('colonial.recebimento-tomate.editar', compact('tomate','fornecedor'));
        
    }

    public function update(Request $request,RecebimentoTomate $tomate) {
        
        $validator = Validator::make($request->all(), [
            'dt_recebimento' => 'required|date',
            'hr_inicial' => 'required|date_format:H:i',
            'hr_final' => 'required|date_format:H:i',
            'nr_controle' => 'required',
            'placa' => 'required',
            'fornecedor' => 'required',
            'verde' => 'required',
            'praga' => 'required',
            'fungo' => 'required',
            'desintegrado' => 'required',
            'defeito' => 'required',
            'impureza' => 'required',
            'terra' => 'required',
            'fruto' => 'required',
            'total' => 'required',
            'brix' => 'required',
            'ph' => 'required',
            'acidez' => 'required',
            'liquido' => 'required',
            'desconto' => 'required',
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
 

                $dados['verde']=  str_replace(",",".",str_replace(".","",$dados['verde']));
                $dados['praga']=  str_replace(",",".",str_replace(".","",$dados['praga']));
                $dados['fungo']=  str_replace(",",".",str_replace(".","",$dados['fungo']));
                $dados['desintegrado']=  str_replace(",",".",str_replace(".","",$dados['desintegrado']));
                $dados['defeito']=  str_replace(",",".",str_replace(".","",$dados['defeito']));
                $dados['impureza']=  str_replace(",",".",str_replace(".","",$dados['impureza']));
                $dados['terra']=  str_replace(",",".",str_replace(".","",$dados['terra']));
                $dados['fruto']=  str_replace(",",".",str_replace(".","",$dados['fruto'])); 
                $dados['total']=  str_replace(",",".",str_replace("","",$dados['total']));
                $dados['brix']=  str_replace(",",".",str_replace(".","",$dados['brix']));
                $dados['ph']=  str_replace(",",".",str_replace(".","",$dados['ph']));
                $dados['acidez']=  str_replace(",",".",str_replace(".","",$dados['acidez']));
                $dados['liquido']=  str_replace(",",".",str_replace(".","",$dados['liquido']));
                $dados['desconto']=  str_replace(",",".",str_replace(".","",$dados['desconto'])); 
              
                $forn=Fornecedor::selectRaw("CardCode codigo,CardName nome")->find($dados['fornecedor']); 
                $dados['cd_fornecedor']=$forn->codigo;
                $dados['nm_fornecedor']=$forn->nome; 
                
                return $tomate->update($dados);

            }); 
        
            return redirect()->route('recebimentotomate-listar')->with('success', 'Recebimento de Tomate atualizada com sucesso!');
             
        }
        catch(\Exception $e) {
            return back()->withErrors(['error' => 'Houve um erro ao atualizar a Recebimento! '.$e->getMessage()])->withInput();
        }

    }

    public function destroy(RecebimentoTomate $tomate) { 
        try { $tomate->delete(); }
        catch(\Exception $e) { abort(500); }
    }
 
    
}
