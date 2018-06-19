<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class ClientLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('clientLogout', 'userLogout');
    }

    public function showClientLoginForm()
    {
        return view('pages.app.auth.login');
    }

    public function login(LoginRequest $request)
    {

        dd($request);

        //Faz o login do cliente
        if (Auth::attempt(['' => $request->email, '' => $request->password], $request->filled('remember'))) {

            //Redireciona o cliente caso consiga logar
            return redirect()->route('admin.dashboard')->with('success', 'Bem vindo ' . Auth::user()->nm_cliente);

        }

        //Retorna para a tela de login com o campo email preenchido
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('nosuccess', 'Usuário ou senha incorretos');
    }

    public function clientLogout()
    {
        Auth::guard('web')->logout();

        return redirect()->route('index');
    }
}
