<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserLoginRequest;

class UserLoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('userLogout');
    }

    public function showAdminLoginForm()
    {
        return view('pages.admin.auth.login');
    }

    public function login(UserLoginRequest $request)
    {

        //Faz o login do usuário
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {

            //Redireciona o usuário caso consiga logar
            return redirect()->route('admin.dashboard')->with('success', 'Bem vindo ' . Auth::guard('admin')->user()->nm_usuario);
        }
        
        //Retorna para a tela de login com o campo email preenchido
        return redirect()->back()->withInput($request->only('email'))->with('nosuccess', 'Usuário ou senha incorretos');
    }

    public function userLogout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }
}
