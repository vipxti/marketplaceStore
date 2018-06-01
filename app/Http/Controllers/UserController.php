<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function cadastraUsuario(UserRequest $request) {



        User::create([
            'cd_cpf_cnpj' => $request->cd_cpf_cnpj,
            'nm_usuario' => $request->nm_usuario,
            'nm_email' => $request->nm_email,
            'ds_senha' => $request->ds_senha,
            'ic_adm' => $request->ic_adm,
            'ds_img' => $request->ds_img,
            'cd_telefone' => $request->cd_telefone
        ]);

    }
}
