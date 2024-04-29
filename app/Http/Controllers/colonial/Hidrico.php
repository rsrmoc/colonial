<?php

namespace App\Http\Controllers\colonial;

use App\Http\Controllers\Controller;
use App\Models\Boleto;
use App\Models\Condominio;
use App\Models\Energia as ModelsEnergia; 
use App\Models\Hidrico as ModelsHidrico;
use App\Models\Hospital;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Hidrico extends Controller
{
    public function lista(Request $request) {

        $ip = DB::select("SELECT CONNECTIONPROPERTY('local_net_address') ip");
        $ip = $ip[0]->ip;
        if($ip=='192.168.0.180'){
            $select = "hidricos.*";
        }else{

            $select = "qtde_atual,dt_consumo,id,
            LEAD(qtde_atual,1,0) OVER(  ORDER BY qtde_atual  ASC) LEAD,
            LAG(qtde_atual,1,0) OVER(  ORDER BY qtde_atual  ASC) qtde_anterior,
            case 
            when LAG(qtde_atual,1,0) OVER(  ORDER BY qtde_atual  ASC)=0 then '0' 
            else ( qtde_atual- LAG(qtde_atual,1,0) OVER(  ORDER BY qtde_atual  ASC)) end saldo";
        }
        
        if ($request->has('b')) {
            $hidrico  = ModelsHidrico::where('dt_consumo', 'LIKE', "%{$request->b}%")
                ->orWhere('id', 'LIKE', "%{$request->b}%")
                ->orderByRaw('dt_consumo desc')
                ->selectRaw($select)
                ->paginate(50)->appends($request->query());
        } else {
            $hidrico  = ModelsHidrico::orderByRaw('dt_consumo desc')
            ->selectRaw($select)->paginate(25)->appends($request->query());
        }

        return view('colonial.hidricos.lista', compact('hidrico'));

    }

    public function create() {


        return view('colonial.hidricos.criar');
    }
 
    public function store(Request $request) {
 
        
        $validator = Validator::make($request->all(), [
            'dt_consumo' => 'required|date', 
            'saldo' => 'required' 
        ],[
            'dt_consumo.required' => 'O campo data do consumo é obrigatorio',
            'saldo.required' => 'O campo Saldo é obrigatorio' 
        ]);
        
        if ($validator->fails()) {  
            return back()->withErrors($validator)->withInput();
        }

        try {
           $retorno= DB::transaction(function () use($request) {

                $saldo= str_replace('.', '', $request->saldo);
                $saldo= str_replace(',', '.', $saldo);
 
                $consumo_atual= str_replace('.', '', $request->consumo_atual);
                $consumo_atual= str_replace(',', '.', $consumo_atual);

                $consumo_anterior= str_replace('.', '', $request->consumo_anterior);
                $consumo_anterior= str_replace(',', '.', $consumo_anterior);

                return ModelsHidrico::create([
                    'dt_consumo' => $request->dt_consumo,
                    'saldo' => $saldo,  
                    'qtde_atual' => $consumo_atual,
                    'qtde_anterior' => $consumo_anterior,
                ]);

            }); 

            return redirect()->route('hidrico-listar')->with('success', 'Consumo cadastrado com sucesso!');
        }
        catch(\Exception $e) {
            return back()->withErrors(['error' => 'Houve um erro ao atualizar o Consumo! <br>'.$e->getMessage()])->withInput();
        }
    }
    public function edit(ModelsHidrico $hidrico) {
      
        return view('colonial.hidricos.editar', compact('hidrico'));
    }
    public function update(Request $request,ModelsHidrico $hidrico) {
        
        $validator = Validator::make($request->all(), [
            'dt_consumo' => 'required|date', 
            'saldo' => 'required' 
        ],[
            'dt_consumo.required' => 'O campo data do consumo é obrigatorio',
            'saldo.required' => 'O saldo é obrigatorio', 
        ]);
        
        if ($validator->fails()) {  
            return back()->withErrors($validator)->withInput();
        }

        try {

           $retorno = DB::transaction(function () use($request,$hidrico) {
               
                $saldo= str_replace('.', '', $request->saldo);
                $saldo= str_replace(',', '.', $saldo);

                $consumo_atual= str_replace('.', '', $request->consumo_atual);
                $consumo_atual= str_replace(',', '.', $consumo_atual);

                $consumo_anterior= str_replace('.', '', $request->consumo_anterior);
                $consumo_anterior= str_replace(',', '.', $consumo_anterior);

                return $hidrico->update([
                    'dt_consumo' => $request->dt_consumo,
                    'saldo' => $saldo,  
                    'qtde_atual' => $consumo_atual,
                    'qtde_anterior' => $consumo_anterior,
                ]);

                }); 

            

            return redirect()->route('hidrico-listar')->with('success', 'Consumo atualizado com sucesso!');

        }
        catch(\Exception $e) {
            return back()->withErrors(['error' => 'Houve um erro ao atualizar o Consumo! '.$e->getMessage()])->withInput();
        }

    }
    
    public function destroy(ModelsHidrico $hidrico) { 
        try { $hidrico->delete(); }
        catch(\Exception $e) { abort(500); }
    }
    
}
