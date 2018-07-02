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

    public function showUserForm()
    {
        $acessos = Access::all();

        //dd(Auth::user()->cd_acesso);

        return view('pages.admin.users.register', compact('acessos'));
    }

    public function atualizaDadosUsuario(UserDataRequest $request)
    {

        //dd($request->all());

        $user = Auth::user();

        if ($request->password != null) {
            $pass = Hash::make($request->password);
        } else {
            $pass = Auth::user()->getAuthPassword();
        }

        if ($request->cd_acesso != null) {
            $acesso = $request->cd_acesso;
        } else {
            $acesso = Auth::user()->cd_acesso;
        }

        try {
            $this->atualizaDados($request->nm_usuario, $request->email, $pass, $acesso);
        } catch (ValidationException $e) {
            return redirect()->route('admin.register')->with('nosuccess', 'Erro ao atualizar seus dados');
        } catch (QueryException $e) {
            return redirect()->route('admin.register')->with('nosuccess', 'Erro ao atualizar seus dados');
        } catch (\PDOException $e) {
            return redirect()->route('admin.register')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            throw $e;
        }

        $user->save();

        return redirect()->route('admin.data')->with('success', 'Dados atualizados com sucesso');
    }

    public function atualizaEndereco()
    {
    }

    public function atualizaDados($nome, $email, $senha, $acesso)
    {
        $user->nm_usuario = $nome;
        $user->email = $email;
        $user->password = $senha;
        $user->cd_acesso = $acesso;
    }
}
