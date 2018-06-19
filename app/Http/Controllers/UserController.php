<?php

namespace App\Http\Controllers;

use App\Access;
use App\Bairro;
use App\Cidade;
use App\Endereco;
use App\Http\Requests\UserDataRequest;
use App\Http\Requests\UserRequest;
use App\Phone;
use App\Uf;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showUserForm() {

        $acessos = Access::all();

        //dd(Auth::user()->cd_acesso);

        return view('pages.admin.cadUsuario', compact('acessos'));
    }

    public function atualizaDadosUsuario(UserDataRequest $request){

        //dd($request->all());

        $user = Auth::user();

        if ($request->password != null) {

            $pass = Hash::make($request->password);

        }
        else {

            $pass = Auth::user()->getAuthPassword();

        }

        if ($request->cd_acesso != null) {

            $acesso = $request->cd_acesso;

        }
        else {

            $acesso = Auth::user()->cd_acesso;

        }

        try {

            $user->nm_usuario = $request->nm_usuario;
            $user->email = $request->email;
            $user->password = $pass;
            $user->cd_acesso = $acesso;

            $user->save();

        }
        catch (\Exception $e) {

            return redirect()->back()->with('nosuccess', 'Houve um problema ao atualizar seus dados');

        }
        finally {

            return redirect()->route('user.data')->with('success', 'Dados atualizados com sucesso');

        }




    }

    public function atualizaEnderecoUsuario() {



    }
}
