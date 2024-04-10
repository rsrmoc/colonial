<?php

namespace App\Http\Controllers\colonial;

use App\Http\Controllers\Controller;
use App\Models\Boleto;
use App\Models\Condominio;
use App\Models\Energia as ModelsEnergia;
use App\Models\Hospital;
use App\Models\Produto;
use App\Models\TipoParada as ModelsTipoParada;
use App\Models\TipoPerda as ModelsTipoPerda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TipoPerda extends Controller
{
    public function lista(Request $request) {

        if ($request->has('b')) {
            $tipoPerdas  = ModelsTipoPerda::where('nm_tipo', 'LIKE', "%{$request->b}%")
                ->orWhere('cd_tipo', 'LIKE', "%{$request->b}%")
                ->orderBy('created_at')
                ->paginate(25)->appends($request->query());
        } else {
            $tipoPerdas  = ModelsTipoPerda::orderBy('created_at')->paginate(25)->appends($request->query());
        }
    
        return view('colonial.tipo_perdas.lista', compact('tipoPerdas'));

    }

    public function create() {
        return view('colonial.tipo_perdas.criar');
    }
 
    public function store(Request $request) {
 
        
        $validator = Validator::make($request->all(), [
            'nm_tipo' => 'required', 
        ],[
            'nm_tipo.required' => 'O campo descrição é obrigatorio'
        ]);
        
        if ($validator->fails()) {  
            return back()->withErrors($validator)->withInput();
        }

        try {
           $retorno= DB::transaction(function () use($request) {

  
                return ModelsTipoPerda::create([
                    'nm_tipo' => $request->nm_tipo,
                    'dt_cadastro' => date('Y-m-d H:i'),
                    'cd_usuario' => Auth::user()->id,
                    'sn_ativo' => 'S', 
                ]);

            }); 

            return redirect()->route('tipoperda-listar')->with('success', 'Tipo cadastrado com sucesso!');
        }
        catch(\Exception $e) {
            return back()->withErrors(['error' => 'Houve um erro ao atualizar o tipo de Parada! <br>'.$e->getMessage()])->withInput();
        }
    }
    public function edit(ModelsTipoPerda $tipo) {
     
        return view('colonial.tipo_perdas.editar', compact('tipo'));
    }

    public function update(Request $request,ModelsTipoPerda $tipo) {
        
        $validator = Validator::make($request->all(), [
            'nm_tipo' => 'required', 
        ],[
            'nm_tipo.required' => 'O campo descrição é obrigatorio'
        ]);
        
        if ($validator->fails()) {  
            return back()->withErrors($validator)->withInput();
        }

        try {

           $retorno = DB::transaction(function () use($request,$tipo) {
              
 
                return $tipo->update([
                    'nm_tipo' => $request->nm_tipo,
                    'dt_cadastro' => date('Y-m-d H:i'),
                    'cd_usuario' => Auth::user()->id,
                    'sn_ativo' => ($request->sn_ativo) ? $request->nm_tipo : 'S', 
                ]);

            }); 

            

            return redirect()->route('tipoperda-listar')->with('success', 'Tipo atualizado com sucesso!');

        }
        catch(\Exception $e) {
            return back()->withErrors(['error' => 'Houve um erro ao atualizar o tipo de parada! '.$e->getMessage()])->withInput();
        }

    }
    public function destroy(ModelsTipoPerda $tipo) { 
        try { $tipo->delete(); }
        catch(\Exception $e) { abort(500); }
    }
    
}
