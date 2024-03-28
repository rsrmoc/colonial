<?php

namespace App\Http\Controllers\colonial;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\PerfilPermission;
use App\Models\Permission;
use App\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Perfis extends Controller
{
    public function index(Request $request) {
        
        if ($request->has('b')) {
            $perfil = Perfil::where('nm_perfil', 'LIKE', "%{$request->b}%")
                ->orWhere('cd_perfil', 'LIKE', "%{$request->b}%")
                ->get();
        } else {
            $perfil = Perfil::all(); 
        }
        $perfil->load('itens_perfil'); 
        return view('colonial.perfil.lista', compact('perfil'));
    }

    public function create() {
        
        $permissoes=Permission::all();
        return view('colonial.perfil.criar',compact('permissoes'));

    }

    public function store(Request $request) {
        $request->validate([
            'nome' => 'required|string|max:50', 
            'permissoes' => 'sometimes|array'
        ]);

        try {
            DB::transaction(function () use($request) {
                //$Senha =explode('@',$request->email);
                //$Senha = mb_strtolower($Senha[0]);
                $perfil = Perfil::create([
                    'nm_perfil' => $request->nome, 
                    'sn_ativo' => 'S', 
                ]);
     
                if ($request->has('permissoes')) {
                    foreach ($request->permissoes as $nome => $permissao) {
                        if (!in_array('ver', $permissao)) {
                            array_push($permissao, 'ver');
                        }

                        PerfilPermission::create([
                            'cd_perfil' => $perfil->cd_perfil,
                            'nome' => $nome,
                            'permissoes' => implode(',', $permissao)
                        ]);
                    }
                }
            });

            return redirect()->route('perfis-listar')->with('success', 'Novo Perfil cadastrado com sucesso!  ');
        }
        catch(\Exception $e) {
            return back()->withErrors(['error' => 'Houve um erro ao salvar a perfil! '.$e->getMessage()])->withInput();
        }
    }

    public function edit(Request $request, Perfil $perfil) {
  
        $permissoes=Permission::with([ 'user_permissao' =>function($q) use($request,$perfil){ 
            $q->whereRaw(" cd_perfil = '".$perfil->cd_perfil."'"); 
         }])  
         ->get();
          
        //dd($permissoes->toArray());

        return view('colonial.perfil.editar', compact('perfil','permissoes'));
    }

    public function update(Request $request, Perfil $perfil) {
        $request->validate([
            'nome' => 'required', 
            'permissoes' => 'sometimes|array'
        ]);

  
        try {
            DB::transaction(function () use($request, $perfil) {
                $perfil->update([
                    'nm_perfil' => $request->nome, 
                    'sn_ativo' => 'S', 
                ]);
                PerfilPermission::where('cd_perfil',$perfil->cd_perfil)->delete();
                foreach (($request->permissoes ?? []) as $nome => $permissao) {
                    if (!in_array('ver', $permissao)) {
                        array_push($permissao, 'ver');
                    }

                    PerfilPermission::create([
                        'cd_perfil' => $perfil->cd_perfil,
                        'nome' => $nome,
                        'permissoes' => implode(',', $permissao)
                    ]);
                }
  
            });

            return redirect()->route('perfis-listar')->with('success', 'Novo Perfil atualizado com sucesso!  ');
 
        }
        catch(\Exception $e) {
            return back()->withErrors(['error' => 'Houve um erro ao atualizar o usuário! '.$e->getMessage()])->withInput();
        }
    }

    public function destroy(User $usuario) {
        try { $usuario->delete(); }
        catch(\Exception $e) { abort(500); }
    }
}
