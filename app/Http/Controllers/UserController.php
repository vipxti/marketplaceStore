<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Phone;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showUserForm() {
        return view('pages.admin.cadUsuario');
    }
    public function atualizaDadosUsuario(UpdateUserRequest $request){

        Phone::create([
            'cd_celular1'=>$request->cd_celular1,
            'cd_celular2'=>$request->cd_celular2
        ]);

        $tel = Phone::ordeBy('cd_telefone', 'DESC')->first();

        $user = User::findOrFail(Auth::user()->cd_usuario);
        $user->cd_telefone= $tel->cd_telefone;
    }
}
