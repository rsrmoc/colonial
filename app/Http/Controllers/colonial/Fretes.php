<?php

namespace App\Http\Controllers\colonial;

use App\Http\Controllers\Controller;
use App\Models\Boleto;
use App\Models\Condominio;
use App\Models\Energia as ModelsEnergia;
use App\Models\Frete;
use App\Models\FretePedido;
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
        

        $dados['tabRomaneio']='active';
        $dados['tabFrete']='';
        $dados['tabCidade']='';
        $dados['tabRPA']='';

        if($request['acao']=='RPA'){
            $dados['tabRomaneio']='';
            $dados['tabRPA']='active';
            $request['cd_romaneio']=$request['cod'];

            $insert['vl_inss'] = ($request['vl_inss']) ? str_replace(",",".",str_replace(".","",$request['vl_inss'])) : 0;
            $insert['vl_senat'] = ($request['vl_senat']) ? str_replace(",",".",str_replace(".","",$request['vl_senat'])) : 0;
            $insert['vl_irrf'] = ($request['vl_irrf']) ? str_replace(",",".",str_replace(".","",$request['vl_irrf'])) : 0;

            if($request['id']){
                Frete::find($request['id'])->update($insert);
            }else{
                Frete::create($insert);
            }
        }

        if($request['acao']=='CIDADE'){
            $dados['tabRomaneio']='';
            $dados['tabCidade']='active';
            $Pedidos= $request['valor'];
            $request['cd_romaneio']=$request['cod'];
            foreach ($Pedidos as $pedido => $valor) {
                $insert['cd_romaneio']=$request['cod'];
                $insert['cd_pedido']=$pedido;
                $insert['vl_pedido_frete']= ($valor) ? str_replace(",",".",str_replace(".","",$valor)) : 0;
                FretePedido::create($insert);
            }
        }

        if($request['acao']=='FRETE'){
            $dados['tabRomaneio']='';
            $dados['tabFrete']='active';
            $request['cd_romaneio']=$request['cod'];
            
            $insert['cd_romaneio']=$request['cod'];
            $insert['distancia'] = ($request['distancia']) ? str_replace(",",".",str_replace(".","",$request['distancia'])) : 0;
            $insert['vl_km'] = ($request['vl_km']) ? str_replace(",",".",str_replace(".","",$request['vl_km'])) : 0;
            $insert['vl_frete'] = ($request['vl_frete']) ? str_replace(",",".",str_replace(".","",$request['vl_frete'])) : 0;
            $insert['vl_frete_add'] = ($request['vl_frete_add']) ? str_replace(",",".",str_replace(".","",$request['vl_frete_add'])) : 0;
            $insert['vl_frete_total'] = ($request['vl_frete_total']) ? str_replace(",",".",str_replace(".","",$request['vl_frete_total'])) : 0;
            $insert['vl_pedagio'] = ($request['vl_pedagio']) ? str_replace(",",".",str_replace(".","",$request['vl_pedagio'])) : 0;
            $insert['nr_caixa'] = ($request['nr_caixa']) ? str_replace(",",".",str_replace(".","",$request['nr_caixa'])) : 0;
            $insert['vl_unidade'] = ($request['vl_unidade']) ? str_replace(",",".",str_replace(".","",$request['vl_unidade'])) : 0;
            $insert['pal_ton'] = ($request['pal_ton']) ? str_replace(",",".",str_replace(".","",$request['pal_ton'])) : 0;
            $insert['vl_descarga'] = ($request['vl_descarga']) ? str_replace(",",".",str_replace(".","",$request['vl_descarga'])) : 0;
            $insert['qtde_entrega'] = ($request['qtde_entrega']) ? str_replace(",",".",str_replace(".","",$request['qtde_entrega'])) : 0;
            $insert['vl_entrega'] = ($request['vl_entrega']) ? str_replace(",",".",str_replace(".","",$request['vl_entrega'])) : 0;
            $insert['vl_entrega_total'] = ($request['vl_entrega_total']) ? str_replace(",",".",str_replace(".","",$request['vl_entrega_total'])) : 0;
            $insert['vl_outros'] = ($request['vl_outros']) ? str_replace(",",".",str_replace(".","",$request['vl_outros'])) : 0;
            $insert['vl_descarga_total'] = ($request['vl_descarga_total']) ? str_replace(",",".",str_replace(".","",$request['vl_descarga_total'])) : 0; 
            $insert['nf']=$request['nf'];
            $insert['vl_carga'] = ($request['vl_carga']) ? str_replace(",",".",str_replace(".","",$request['vl_carga'])) : 0; 
            $insert['peso'] = ($request['peso']) ? str_replace(",",".",str_replace(".","",$request['peso'])) : 0; 
            
            if($request['id']){
                 Frete::find($request['id'])->update($insert);
            }else{
                 Frete::create($insert);
            }
            

        }
        
        $dados['query'] = Romaneio::SearchRelacao($request)->find($request['cod']);
        $dados['query']->load('tab_motorista');
        $pedidos = RomaneioItens::whereRaw(" AbsEntry= ".$request['cod'])->selectRaw("distinct(OrderEntry) codigo")->get(); 
        $dados['pedidos'] = PedidoVenda::whereIn('DocEntry',$pedidos->toArray())->with('tab_cliente')
        ->selectRaw("DocEntry codigo, DocDate data, CardName nome, Address endereco, Comments comentario, VatSum imposto, DocTotal total,CardCode")
        ->get();  
          
        $dados['valor_total']=0;
        foreach($dados['pedidos'] as $valor){ 
            $dados['valor_total']=($valor['total']+$dados['valor_total']);
        }


        $dados['frete']=Frete::where('cd_romaneio',$request['cod'])->first();
        $dados['frete_cidade']=FretePedido::where('cd_romaneio',$request['cod'])->get();
         
        $dados['PedidosValor']=null;
        foreach($dados['frete_cidade'] as $Ped){
            $dados['PedidosValor'][$Ped['cd_pedido']]=$Ped['vl_pedido_frete'];
        }

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


    
}
