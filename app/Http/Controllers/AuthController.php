<?php

namespace App\Http\Controllers;

use App\Models\PerfilPermission;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function home() {
        return view('login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors(['error' => 'Email ou senha invalidos!'])->withInput();
        }
        
        $Acesso=PerfilPermission::whereRaw("cd_perfil=".Auth::user()->cd_perfil)->get();
        $array=null;
        foreach($Acesso as $val){
            $array[$val->nome]=$val->permissoes;
        }
        session()->put('usuario_id', $array);

        return redirect()->route('home');
    }

    public function logout() {
        Auth::logout();

        return redirect()->route('login');
    }
}
