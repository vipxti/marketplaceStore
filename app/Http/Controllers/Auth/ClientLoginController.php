<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ClientLoginRequest;

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

    public function login(ClientLoginRequest $request)
    {
        //dd($request->all());

        //Faz o login do cliente
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {

            //Redireciona o cliente caso consiga logar
            return redirect()->route('client.dashboard')->with('success', 'Bem vindo ' . Auth::user()->nm_cliente);
        }

        //Retorna para a tela de login com o campo email preenchido
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('nosuccess', 'Usuário ou senha incorretos');
    }

    public function clientLogout()
    {
        Auth::guard('web')->logout();

        return redirect()->route('client.login');
    }
}
