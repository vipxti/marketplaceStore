<?php

namespace App\Http\Controllers;

use App\Bairro;
use App\Cidade;
use App\Endereco;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Phone;
use App\Uf;
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
        //Cadastro  telefone
        Phone::create([
            'cd_celular1'=>$request->cd_celular1,
            'cd_celular2'=>$request->cd_celular2
        ]);
        $tel = Phone::ordeBy('cd_telefone', 'DESC')->first();

        //Cad do End
        Uf::create([
            'nm_uf'=>$request->nm_uf,
            'cd_pais'=>1
            ]);
        $uf = Uf::ordeBy('cd_uf', 'DESC')->first();

        Cidade::create([
            'nm_cidade'=>$request->nm_cidade,
            'cd_uf'=>$uf->cd_uf
        ]);
        $cidade = Cidade::ordeBy('cd_cidade', 'DESC')->first();

        Bairro::create([
            'nm_bairro'=>$request->nm_bairro,
            'cd_cidade'=>$cidade->cd_cidade
        ]);
        $bairro = Bairro::ordeBy('cd_bairro', 'DESC')->first();

        Endereco::create([
            'cd_cep'=>$request->cd_cep,
            'ds_endereco'=>$request->ds_endereco,
            'cd_numero_endereco'=>$request->cd_numero_endereco,
            'ds_complemento'=>$request->ds_complemento,
            'ds_ponto_referencia'=>$request->ds_ponto_referencia,
            'cd_bairro'=>$bairro->cd_bairro
        ]);
        $endereco = Endereco::ordeBy('cd_endereco', 'DESC')->first();

        //Select user
        $user = User::findOrFail(Auth::user()->cd_usuario);
        $user->cd_telefone= $tel->cd_telefone;
        $user->cd_endereco= $endereco->cd_endereco;

        $user->save();


    }
}
