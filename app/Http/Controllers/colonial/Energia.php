<?php

namespace App\Http\Controllers\colonial;

use App\Http\Controllers\Controller;
use App\Models\Boleto;
use App\Models\Condominio;
use App\Models\Energia as ModelsEnergia;
use App\Models\Hospital;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Energia extends Controller
{
    public function lista(Request $request) {

        if ($request->has('b')) {
            $energia  = ModelsEnergia::where('dt_consumo', 'LIKE', "%{$request->b}%")
                ->orWhere('id', 'LIKE', "%{$request->b}%")
                ->orderByRaw('dt_consumo desc')
                ->paginate(25)->appends($request->query());
        } else {
            $energia  = ModelsEnergia::orderByRaw('dt_consumo desc')->paginate(25)->appends($request->query());
        }

        return view('colonial.energias.lista', compact('energia'));

    }

    public function create() {
        return view('colonial.energias.criar');
    }
 
    public function store(Request $request) {
 
        
        $validator = Validator::make($request->all(), [
            'dt_consumo' => 'required|date',
            'consumo' => 'required' 
        ],[
            'dt_consumo.required' => 'O campo data do consumo é obrigatorio'
        ]);
        
        if ($validator->fails()) {  
            return back()->withErrors($validator)->withInput();
        }

        try {
           $retorno= DB::transaction(function () use($request) {

                $qtde= str_replace('.', '', $request->consumo);
                $qtde= str_replace(',', '.', $qtde);
                return ModelsEnergia::create([
                    'dt_consumo' => $request->dt_consumo,
                    'qtde' => $qtde, 
                ]);

            }); 

            return redirect()->route('energia-listar')->with('success', 'Consumo cadastrado com sucesso!');
        }
        catch(\Exception $e) {
            return back()->withErrors(['error' => 'Houve um erro ao atualizar o Consumo! <br>'.$e->getMessage()])->withInput();
        }
    }
    public function edit(ModelsEnergia $energia) {
     
        return view('colonial.energias.editar', compact('energia'));
    }
    public function update(Request $request,ModelsEnergia $energia) {
        
        $validator = Validator::make($request->all(), [
            'dt_consumo' => 'required|date',
            'consumo' => 'required' 
        ],[
            'dt_consumo.required' => 'O campo data do consumo é obrigatorio'
        ]);
        
        if ($validator->fails()) {  
            return back()->withErrors($validator)->withInput();
        }

        try {

           $retorno = DB::transaction(function () use($request,$energia) {
              

                $qtde= str_replace('.', '', $request->consumo);
                $qtde= str_replace(',', '.', $qtde); 
                return $energia->update([
                    'dt_consumo' => $request->dt_consumo,
                    'qtde' => $qtde, 
                ]);

            }); 

            

            return redirect()->route('energia-listar')->with('success', 'Consumo atualizado com sucesso!');

        }
        catch(\Exception $e) {
            return back()->withErrors(['error' => 'Houve um erro ao atualizar o Consumo! '.$e->getMessage()])->withInput();
        }

    }
    public function destroy(ModelsEnergia $energia) { 
        try { $energia->delete(); }
        catch(\Exception $e) { abort(500); }
    }
    
}
