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
use App\Models\Sap\Fornecedor;
use App\Models\Sap\ordemProducao;
use App\Models\Sap\PedidoVenda;
use App\Models\Sap\PedidoVendaItens;
use App\Models\Sap\Produto as SapProduto;
use App\Models\Sap\Romaneio;
use App\Models\Sap\RomaneioItens;
use App\Models\TipoParada;
use App\Models\TipoPerda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Fretes extends Controller
{
    public function lista(Request $request) {
  
        $query = Romaneio::SearchRelacao($request)  
        ->orderByRaw('PickDate desc')
        ->paginate(50)->appends($request->query());

        //dd($query->toArray());

        $motorista = Fornecedor::whereRaw("GroupCode=2")->selectRaw("distinct(CardCode) codigo,CardName nome")->orderBy("CardName")->get();  
        return view('colonial.fretes.lista', compact('query','motorista','request'));

    }

    public function create(Request $request) {
        
        $dados['query'] = Romaneio::SearchRelacao($request)->find($request['cod']);

        $pedidos = RomaneioItens::whereRaw(" AbsEntry= ".$request['cod'])->selectRaw("distinct(OrderEntry) codigo")->get(); 
        $dados['pedidos'] = PedidoVenda::whereIn('DocEntry',$pedidos->toArray())
        ->selectRaw("DocEntry codigo, DocDate data, CardName nome, Address endereco, Comments comentario, VatSum imposto, DocTotal total")
        ->get();
        //dd($dados['pedidos']->toArray());
        return view('colonial.fretes.modal', compact('dados','request'));

    }
 
    public function store(Request $request) {
 
        
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
           $retorno= DB::transaction(function () use($request) {
                $Tipo = $request->tipo;
                $Qtde = $request->qtde;
                $ordem = ordemProducao::find($request->ordem); 
                foreach($request->produto as $key => $prod){
                    $produto = SapProduto::find($prod);
                    if(($Tipo[$key]) && (!$Qtde[$key])){
                        return back()->withErrors(['error' => 'No produto ( '.$produto->ItemName.' ) não foi informado a QTDE do produto!'])->withInput();
                    }
                    if((!$Tipo[$key]) && ($Qtde[$key])){
                        return back()->withErrors(['error' => 'No produto ( '.$produto->ItemName.' ) não foi informado o TIPO DE PERDA!'])->withInput();
                    }
                    if(($Tipo[$key]) && ($Qtde[$key])){
                           Perda::create([
                            'cd_ordem' => $request->ordem,
                            'cd_tipo_perda' => ($Tipo[$key]) ? $Tipo[$key] : null,
                            'cd_produto' => $prod,
                            'nm_produto' => $produto->ItemName,
                            'qtde' => ($Qtde[$key]) ? $Qtde[$key] : null, 
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
        $tipo = TipoPerda::whereRaw("sn_ativo='S'")->orderBy("nm_tipo")->get();   
        $prodPerda = Perda::whereRaw("cd_ordem=".$perda->cd_ordem)->orderBy("created_at")->get();
        $ordem = ordemProducao::whereRaw("DocEntry=".$perda->cd_ordem)->orderByRaw("DueDate desc")->get(); 
        return view('colonial.perdas.editar', compact('perda','ordem','tipo','produtos','prodPerda'));
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
                return redirect()->route('perda-listar')->with('success', 'Perda atualizada com sucesso!');
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
        return view('colonial.perdas.combo', compact('dados','tipo'));
    }
    
}