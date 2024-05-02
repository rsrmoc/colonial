<?php

namespace App\Http\Controllers\colonial;

use App\Http\Controllers\Controller;
use App\Models\Boleto;
use App\Models\Condominio;
use App\Models\Energia as ModelsEnergia;
use App\Models\Equipamento;
use App\Models\Hospital;
use App\Models\Produto;
use App\Models\TipoParada as ModelsTipoParada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Equipamentos extends Controller
{
    public function lista(Request $request) {

        if ($request->has('b')) {
            $equip = Equipamento::where('nm_equipamento', 'LIKE', "%{$request->b}%")
                ->orWhere('cd_equipamento', 'LIKE', "%{$request->b}%")
                ->orderBy('created_at')
                ->paginate(25)->appends($request->query());
        } else {
            $equip = Equipamento::orderBy('created_at')->paginate(25)->appends($request->query());
        }
    
        return view('colonial.equipamentos.lista', compact('equip'));

    }

    public function create() {
        return view('colonial.equipamentos.criar');
    }
 
    public function store(Request $request) {
 
        
        $validator = Validator::make($request->all(), [
            'nm_equipamento' => 'required', 
        ],[
            'nm_equipamento.required' => 'O campo Nome é obrigatorio'
        ]);
        
        if ($validator->fails()) {  
            return back()->withErrors($validator)->withInput();
        }

        try {
           $retorno= DB::transaction(function () use($request) {

  
                return Equipamento::create([
                    'nm_equipamento' => $request->nm_equipamento, 
                    'cd_usuario' => Auth::user()->id,
                    'sn_ativo' => 'S', 
                ]);

            }); 

            return redirect()->route('equipamento-listar')->with('success', 'Equipamento cadastrado com sucesso!');
        }
        catch(\Exception $e) {
            return back()->withErrors(['error' => 'Houve um erro ao atualizar o Equipamento! <br>'.$e->getMessage()])->withInput();
        }
    }
    public function edit(Equipamento $equipamento) {
     
        return view('colonial.equipamentos.editar', compact('equipamento'));
    }

    public function update(Request $request,Equipamento $equipamento) {
        
        $validator = Validator::make($request->all(), [
            'nm_equipamento' => 'required', 
        ],[
            'nm_equipamento.required' => 'O campo Nome é obrigatorio'
        ]);
        
        if ($validator->fails()) {  
            return back()->withErrors($validator)->withInput();
        }

        try {

           $retorno = DB::transaction(function () use($request,$equipamento) {
               
                return $equipamento->update([
                    'nm_equipamento' => $request->nm_equipamento, 
                    'cd_usuario' => Auth::user()->id,
                    'sn_ativo' => ($request->sn_ativo) ? $request->sn_ativo : 'S', 
                ]);

            }); 
 
            return redirect()->route('equipamento-listar')->with('success', 'Equipamento atualizado com sucesso!');

        }
        catch(\Exception $e) {
            return back()->withErrors(['error' => 'Houve um erro ao atualizar o equipamento! '.$e->getMessage()])->withInput();
        }

    }
    public function destroy(Equipamento $equipamento) { 
        try { $equipamento->delete(); }
        catch(\Exception $e) { abort(500); }
    }
    
}
