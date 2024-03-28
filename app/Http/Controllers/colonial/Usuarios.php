<?php

namespace App\Http\Controllers\colonial;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\Permission;
use App\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Usuarios extends Controller
{

    public function index(Request $request) {
        
        if ($request->has('b')) {
            $usuarios = User::where('name', 'LIKE', "%{$request->b}%")
                ->orWhere('email', 'LIKE', "%{$request->b}%")
                ->get();
            $usuarios->load('tab_perfil');
        } else {
            $usuarios = User::all(); 
            $usuarios->load('tab_perfil');
        }
        
        return view('colonial.usuarios.lista', compact('usuarios'));
    }

    public function create() {
        
        $permissoes=Permission::all(); 
        $perfil=Perfil::orderBy("nm_perfil")->get();
        return view('colonial.usuarios.criar',compact('permissoes','perfil'));
    }

    public function store(Request $request) {
        $request->validate([
            'nome' => 'required|string|max:50',
            'celular' => 'nullable|string|max:50',
            'sexo' => 'nullable|string|max:1', 
            'perfil' => 'required|exists:perfis,cd_perfil',
            'email' => 'required|email|unique:users,email' 
        ]);

        try {
            DB::transaction(function () use($request) { 
                $usuario = User::create([
                    'name' => $request->nome,
                    'email' => $request->email,
                    'cd_perfil' => $request->perfil,
                    'fone' => $request->celular,
                    'sexo' => $request->sexo,
                    'password' => Hash::make('colonial')
                ]);
 
            });

            return redirect()->route('usuarios-listar')->with('success', 'Novo Usuário cadastrado com sucesso!  ');
        }
        catch(\Exception $e) {
            return back()->withErrors(['error' => 'Houve um erro ao salvar o usuário! '.$e->getMessage()])->withInput();
        }
    }

    public function edit(User $usuario) {
        $permissoes=Permission::all();
        $perfil=Perfil::orderBy("nm_perfil")->get();
        return view('colonial.usuarios.editar', compact('usuario','permissoes','perfil'));
    }

    public function update(Request $request, User $usuario) {
        $request->validate([
            'nome' => 'required|string|max:50',
            'email' => 'required|email',
            'celular' => 'nullable|string|max:50',
            'sexo' => 'nullable|string|max:1',
            'perfil' => 'required|exists:perfis,cd_perfil'
        ]);

        if (User::where('email', $request->email)->where('id', '<>', $usuario->id)->first()) {
            return back()->withErrors(['error' => 'Email já está sendo usuado por outro usuário.']);
        }
   
        try {
            DB::transaction(function () use($request, $usuario) {
                $usuario->update([
                    'name' => $request->nome,
                    'email' => $request->email,
                    'cd_perfil' => $request->perfil,
                    'fone' => $request->celular,  
                    'sexo' => $request->sexo, 
                ]);
  
 
            });

            return redirect()->route('usuarios-listar')->with('success', 'Usuário atualizado com sucesso!');
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
