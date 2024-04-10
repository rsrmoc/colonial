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
use App\Models\Sap\Estoque;
use App\Models\Sap\ordemProducao;
use App\Models\Sap\Produto as SapProduto;
use App\Models\TipoParada;
use App\Models\TipoPerda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Perdas extends Controller
{
    public function lista(Request $request) {

        if ($request->has('b')) {
            $perda  = Perda::where('dt_ordem', 'LIKE', "%{$request->b}%") 
                ->orWhere('cd_ordem', 'LIKE', "%{$request->b}%")
                ->orderByRaw('dt_ordem desc')
                ->paginate(25)->appends($request->query());
        } else {
            $perda  = Perda::orderByRaw('dt_ordem desc')    
            ->paginate(25)->appends($request->query());
        }

        //$perda->load('tab_ordem','tab_tipo','tab_produto');
         $perda->load('tab_ordem','tab_tipo');
         
       

        return view('colonial.perdas.lista', compact('perda'));

    }

    public function create() {
        $ordem = ordemProducao::whereRaw("DueDate > (GETDATE()-60)")->orderByRaw("DueDate desc")->whereNotIn("DocEntry",[207])->get(); 
        $tipo = TipoPerda::whereRaw("sn_ativo='S'")->orderBy("nm_tipo")->get(); 
  
        return view('colonial.perdas.criar', compact('ordem','tipo'));
    }
 
    public function store(Request $request) {
 
        
        $validator = Validator::make($request->all(), [
            'ordem' => 'required',
            'tipo' => 'required|exists:perda_tipo,cd_tipo',
            'qtde' => 'required|integer',
            'produto' => 'required',
            'obs' => 'required|max:1024' 
        ],[
            'ordem.required' => 'O campo Ordem de Produção é obrigatorio',
            'tipo.required' => 'O campo Tipo é obrigatorio',
            'qtde.required' => 'O campo Qtde é obrigatorio',
            'tempo.produto' => 'O campo Produto é obrigatorio'
        ]);
        
        if ($validator->fails()) {  
            return back()->withErrors($validator)->withInput();
        }
         
        try {
           $retorno= DB::transaction(function () use($request) {

                $ordem = ordemProducao::find($request->ordem); 
                $produto = SapProduto::find($request->produto);
                return Perda::create([
                    'cd_ordem' => $request->ordem,
                    'cd_tipo_perda' => $request->tipo,
                    'cd_produto' => $request->produto,
                    'nm_produto' => $produto->ItemName,
                    'qtde' => $request->qtde, 
                    'obs_perda' => $request->obs,
                    'dt_cadastro' => date('Y-m-d H:i'),
                    'cd_usuario' => Auth::user()->id,
                    'dt_ordem' => $ordem->DueDate,
                ]);

            }); 

            return redirect()->route('perda-listar')->with('success', 'Perda cadastrada com sucesso!');
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
        $ordem = ordemProducao::whereRaw("DueDate > (GETDATE()-".$dias.")")->orderByRaw("DueDate desc")->get(); 
        $tipo = TipoPerda::whereRaw("sn_ativo='S'")->orderBy("nm_tipo")->get(); 
        return view('colonial.perdas.editar', compact('perda','ordem','tipo','produtos'));
    }

    public function update(Request $request,Perda $perda) {
        
        $validator = Validator::make($request->all(), [
            'ordem' => 'required',
            'tipo' => 'required|exists:perda_tipo,cd_tipo',
            'qtde' => 'required|integer',
            'produto' => 'required',
            'obs' => 'required|max:1024' 
        ],[
            'ordem.required' => 'O campo Ordem de Produção é obrigatorio',
            'tipo.required' => 'O campo Tipo é obrigatorio',
            'qtde.required' => 'O campo Qtde é obrigatorio',
            'tempo.produto' => 'O campo Produto é obrigatorio'
        ]);
        
        if ($validator->fails()) {  
            return back()->withErrors($validator)->withInput();
        }

        try {

           $retorno = DB::transaction(function () use($request,$perda) {
               
            $ordem = ordemProducao::find($request->ordem); 
            $produto = SapProduto::find($request->produto);
            
            return $perda->update([
                'cd_ordem' => $request->ordem,
                'cd_tipo_perda' => $request->tipo,
                'cd_produto' => $request->produto,
                'nm_produto' => $produto->ItemName,
                'qtde' => $request->qtde, 
                'obs_perda' => $request->obs, 
                'cd_usuario' => Auth::user()->id,
                'dt_ordem' => $ordem->DueDate,
            ]);

            }); 
 
            return redirect()->route('perda-listar')->with('success', 'Perda atualizada com sucesso!');

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
        
        return view('colonial.perdas.combo', compact('dados'));
    }
    
}
