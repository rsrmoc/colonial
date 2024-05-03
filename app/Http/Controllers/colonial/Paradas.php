<?php

namespace App\Http\Controllers\colonial;

use App\Http\Controllers\Controller;
use App\Models\Boleto;
use App\Models\Condominio;
use App\Models\Energia as ModelsEnergia;
use App\Models\Equipamento;
use App\Models\Hospital;
use App\Models\Parada;
use App\Models\Produto;
use App\Models\Sap\ordemProducao;
use App\Models\TipoParada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Paradas extends Controller
{
    public function lista(Request $request) {

        if ($request->has('b')) {
            $parada  = Parada::where('dt_ordem', 'LIKE', "%{$request->b}%")
                ->whereRaw(" dt_ordem is not null") 
                ->orWhere('cd_ordem', 'LIKE', "%{$request->b}%")
                ->orderByRaw('dt_ordem desc')
                ->paginate(25)->appends($request->query());
        } else {
            $parada  = Parada::whereRaw(" dt_ordem is not null")->orderByRaw('dt_ordem desc')->paginate(25)->appends($request->query());
        }

        $parada->load('tab_ordem','tab_tipo','tab_equipamento');
        
        //dd($parada->toArray());

        return view('colonial.paradas.lista', compact('parada'));

    }

    public function create() {
        $ordem = ordemProducao::whereRaw("DueDate > (GETDATE()-30)")->orderByRaw("DueDate desc")->whereNotIn("DocEntry",[207])->get(); 
        $tipo = TipoParada::whereRaw("sn_ativo='S'")->orderBy("nm_tipo")->get(); 
        $equipamento = Equipamento::whereRaw("sn_ativo='S'")->orderBy("nm_equipamento")->get(); 
  
        return view('colonial.paradas.criar', compact('ordem','tipo','equipamento'));
    }
 
    public function store(Request $request) {
 
        
        $validator = Validator::make($request->all(), [
            'ordem' => 'required',
            'equipamento' => 'nullable|exists:equipamento,cd_equipamento',
            'tipo' => 'required|exists:producao_tipo,cd_tipo',
            'tempo' => 'required|integer',
            'obs' => 'required|max:1024' 
        ],[
            'ordem.required' => 'O campo Ordem de Produção é obrigatorio',
            'tipo.required' => 'O campo Tipo é obrigatorio',
            'tempo.required' => 'O campo Tempo é obrigatorio'
        ]);
        
        if ($validator->fails()) {  
            return back()->withErrors($validator)->withInput();
        }
         
        try {
           $retorno= DB::transaction(function () use($request) {

                $ordem = ordemProducao::find($request->ordem); 

                return Parada::create([
                    'cd_ordem' => $request->ordem,
                    'cd_parada' => $request->tipo,
                    'cd_equipamento' => $request->equipamento,
                    'tempo' => $request->tempo, 
                    'obs_parada' => $request->obs,
                    'dt_cadastro' => date('Y-m-d H:i'),
                    'cd_usuario' => Auth::user()->id,
                    'dt_ordem' => $ordem->DueDate,
                ]);

            }); 

            return redirect()->route('parada-listar')->with('success', 'Parada cadastrada com sucesso!');
        }
        catch(\Exception $e) {
            return back()->withErrors(['error' => 'Houve um erro ao atualizar a Parada! <br>'.$e->getMessage()])->withInput();
        }
    }
    public function edit(Parada $parada) {

        $Dt =$parada->dt_ordem;
        $ordem = ordemProducao::whereRaw("DueDate > (GETDATE()-30)")->orderByRaw("DueDate desc")->get(); 
        $tipo = TipoParada::whereRaw("sn_ativo='S'")->orderBy("nm_tipo")->get(); 
        $equipamento = Equipamento::whereRaw("sn_ativo='S'")->orderBy("nm_equipamento")->get(); 
        return view('colonial.paradas.editar', compact('parada','ordem','tipo','equipamento'));
    }
    public function update(Request $request,Parada $parada) {
        
        $validator = Validator::make($request->all(), [
            'ordem' => 'required',
            'tipo' => 'required|exists:producao_tipo,cd_tipo',
            'equipamento' => 'nullable|exists:equipamento,cd_equipamento',
            'tempo' => 'required|integer',
            'obs' => 'required|max:1024' 
        ],[
            'ordem.required' => 'O campo Ordem de Produção é obrigatorio',
            'tipo.required' => 'O campo Tipo é obrigatorio',
            'tempo.required' => 'O campo Tempo é obrigatorio'
        ]);
        
        if ($validator->fails()) {  
            return back()->withErrors($validator)->withInput();
        }

        try {

           $retorno = DB::transaction(function () use($request,$parada) {
               
            $ordem = ordemProducao::find($request->ordem); 

            return $parada->update([
                'cd_ordem' => $request->ordem,
                'cd_parada' => $request->tipo,
                'cd_equipamento' => $request->equipamento,
                'tempo' => $request->tempo, 
                'obs_parada' => $request->obs,
                'dt_cadastro' => date('Y-m-d H:i'),
                'cd_usuario' => Auth::user()->id,
                'dt_ordem' => $ordem->DueDate,
            ]);

            }); 

            

            return redirect()->route('parada-listar')->with('success', 'Parada atualizada com sucesso!');

        }
        catch(\Exception $e) {
            return back()->withErrors(['error' => 'Houve um erro ao atualizar a parada! '.$e->getMessage()])->withInput();
        }

    }
    public function destroy(Parada $parada) { 
        try { $parada->delete(); }
        catch(\Exception $e) { abort(500); }
    }
    
    public function combo(Request $request, $data) { 

        
        $dados = ordemProducao::whereRaw(" CONVERT(CHAR(10),duedate, 23) = '".$request['data']."'")->orderByRaw("DueDate desc")->whereNotIn("DocEntry",[207])->get(); 
        return view('colonial.paradas.combo', compact('dados','request'));

    }
}
