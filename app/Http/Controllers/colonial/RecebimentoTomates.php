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
            $perda  = Perda::where('dt_ordem', 'LIKE', "%{$request->b}%") 
                ->orWhere('cd_ordem', 'LIKE', "%{$request->b}%")
                ->orderByRaw('dt_ordem desc')
                ->paginate(50)->appends($request->query());
        } else {
            $perda  = Perda::orderByRaw('dt_ordem desc')    
            ->paginate(50)->appends($request->query());
        }

        //$perda->load('tab_ordem','tab_tipo','tab_produto');
         $perda->load('tab_ordem','tab_tipo');
         
       

        return view('colonial.recebimento-tomate.lista', compact('perda'));

    }

    public function create() {
        $ordem = ordemProducao::whereRaw("DueDate > (GETDATE()-60)")->orderByRaw("DueDate desc")->whereNotIn("DocEntry",[207])->get(); 
        $tipo = TipoPerda::whereRaw("sn_ativo='S'")->orderBy("nm_tipo")->get(); 
  
        return view('colonial.recebimento-tomate.criar', compact('ordem','tipo'));
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
            
            return RecebimentoTomate::create($dados); 
 
            }); 

            return redirect()->route('recebimentotomate-listar')->with('success', 'Cadastro cadastrada com sucesso!');
        }
        catch(\Exception $e) {
            return back()->withErrors(['error' => 'Houve um erro ao atualizar a Perda! <br>'.$e->getMessage()])->withInput();
        }
    }

    public function edit(Perda $perda) {
        $database = date_create($perda->dt_ordem);
        $datadehoje = date_create();
        $resultado = date_diff($database, $datadehoje);
        $dias = date_interval_format($resultado, '%a'); 
        $dias = $dias +2;
        $produtos = Estoque::whereRaw("BaseRef = ".$perda->cd_ordem)->selectRaw("itemcode,dscription")->Get();
        $tipo = TipoPerda::whereRaw("sn_ativo='S'")->orderBy("nm_tipo")->get();   
        $prodPerda = Perda::whereRaw("cd_ordem=".$perda->cd_ordem)->orderBy("created_at")->get();
        $ordem = ordemProducao::whereRaw("DocEntry=".$perda->cd_ordem)->orderByRaw("DueDate desc")->get(); 
        return view('colonial.recebimento-tomate.editar', compact('perda','ordem','tipo','produtos','prodPerda'));
    }

    public function update(Request $request,Perda $perda) {
        
        $validator = Validator::make($request->all(), [
            'ordem' => 'required',
            'tipo' => 'required|array|min:1',
            'qtde' => 'required|array|min:1',
            'produto' => 'required|array|min:1',
            'obs' => 'nullable|max:1024' 
        ],[
            'ordem.required' => 'O campo Ordem de Produção é obrigatorio',
            'tipo.required' => 'O campo Tipo é obrigatorio',
            'qtde.required' => 'O campo Qtde é obrigatorio',
            'produto.required' => 'O campo Produto é obrigatorio'
        ]);
        
        if ($validator->fails()) {  
            return back()->withErrors($validator)->withInput();
        }

        try {

           $retorno = DB::transaction(function () use($request,$perda) {
                
                $Tipo = $request->tipo;
                $Qtde = $request->qtde;  
                $ordem = ordemProducao::find($request->ordem); 
                $erro='N';
                foreach($request->produto as $key => $prod){
                    $produto = SapProduto::find($prod);
                    if(($Tipo[$key]) && (!$Qtde[$key])){
                        return back()->withErrors(['error' => 'No produto ( '.$produto->ItemName.' ) não foi informado a QTDE do produto!'])->withInput();
                        $erro='S';
                    }
                    if((!$Tipo[$key]) && ($Qtde[$key])){
                        return back()->withErrors(['error' => 'No produto ( '.$produto->ItemName.' ) não foi informado o TIPO DE PERDA!'])->withInput();
                        $erro='S';
                    }
                }

                if($erro=='S'){
                    return false;
                }

                Perda::whereRaw("cd_ordem=".$request->ordem)->delete();
                
                foreach($request->produto as $key => $prod){
                    $produto = SapProduto::find($prod);
                     
                    if(($Tipo[$key]) && ($Qtde[$key])){
                           Perda::create([
                            'cd_ordem' => $request->ordem,
                            'cd_tipo_perda' => $Tipo[$key],
                            'cd_produto' => $prod,
                            'nm_produto' => $produto->ItemName,
                            'qtde' => $Qtde[$key], 
                            'grupo' =>$produto->ItmsGrpCod,
                            'obs_perda' => $request->obs,
                            'dt_cadastro' => date('Y-m-d H:i'),
                            'cd_usuario' => Auth::user()->id,
                            'dt_ordem' => $ordem->DueDate,
                        ]);
                    } 
                } 
                return true;
            }); 
            if($retorno==true){
                return redirect()->route('recebimentotomate-listar')->with('success', 'Perda atualizada com sucesso!');
            }
            

        }
        catch(\Exception $e) {
            return back()->withErrors(['error' => 'Houve um erro ao atualizar a Perda! '.$e->getMessage()])->withInput();
        }

    }
    public function destroy(Perda $perda) { 
        try { $perda->delete(); }
        catch(\Exception $e) { abort(500); }
    }

    public function combo(Request $request, $ordem) { 
        
        $dados = Estoque::whereRaw("BaseRef = ".$ordem)->selectRaw("itemcode,dscription")->Get(); 
        $tipo = TipoPerda::whereRaw("sn_ativo='S'")->orderBy("nm_tipo")->get(); 
        return view('colonial.recebimentotomate.combo', compact('dados','tipo'));
    }
    
}
