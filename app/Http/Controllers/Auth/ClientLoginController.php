<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ClientLoginRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

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
        if (Session::has('cartRoute')) {
            $route = Session::get('cartRoute');
        } else {
            $route = 'client.dashboard';
        }

        //dd($route);

        //Faz o login do cliente
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {
            //Redireciona o cliente caso consiga logar
            Session::forget('cartRoute');
            return redirect()->route($route)->with('success', 'Bem vindo');
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
