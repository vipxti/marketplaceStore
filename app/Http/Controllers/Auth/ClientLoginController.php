<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

    public function login(Request $request)
    {
        //Validar o form
        $this->validate($request, [
            '' => 'required|email',
            '' => 'required|min:6'
        ]);

        //Faz o login do cliente
        if (Auth::attempt(['' => $request->nm_email, '' => $request->ds_senha], $request->remember)) {
            //Redireciona o cliente caso consiga logar
            return redirect()->intended(route('admin.dashboard'));
        }

        //Retorna para a tela de login com o campo email preenchido
        return redirect()->back()->withInput($request->only('nm_email', 'remember'));
    }

    public function clientLogout()
    {
        Auth::guard('web')->logout();

        return redirect()->route('index');
    }
}
