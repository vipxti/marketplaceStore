<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:usuario')->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('pages.admin.auth.login');
    }

    public function login(Request $request)
    {
        //Validar o form
        $this->validate($request, [
            '' => 'required|email',
            '' => 'required|min:6'
        ]);

        //Faz o login do usuário
        if (Auth::guard('usuario')->attempt(['' => $request->nm_email, '' => $request->ds_senha], $request->remember)) {
            //Redireciona o usuário caso consiga logar
            return redirect()->intended(route('admin.dashboard'));
        }
        
        //Retorna para a tela de login com o campo email preenchido
        return redirect()->back()->withInput($request->only('nm_email', 'remember'));
    }
}
