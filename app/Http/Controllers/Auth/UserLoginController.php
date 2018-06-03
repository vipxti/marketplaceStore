<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserLoginController extends Controller
{
    //use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('userLogout');
    }

    public function showAdminLoginForm()
    {
        return view('pages.admin.auth.login');
    }

    public function login(LoginRequest $request)
    {

        //dd(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember')));

        //Faz o login do usuário
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {

            //Redireciona o usuário caso consiga logar
            return redirect()->intended(route('admin.dashboard'));

        }
        
        //Retorna para a tela de login com o campo email preenchido
        return redirect()->back()->withInput($request->only('email'));

    }

    public function userLogout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }
}
