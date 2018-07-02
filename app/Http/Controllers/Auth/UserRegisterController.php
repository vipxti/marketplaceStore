<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\UserRequest;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showRegisterForm()
    {
        return view('pages.admin.auth.register');
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(UserRequest $request)
    {
        try {
            $this->createUser($request->nm_usuario, $request->email, $request->password, $request->cd_cpf_cnpj, 0);
        } catch (ValidationException $e) {
            return redirect()->route('admin.register')->with('nosuccess', 'Erro ao cadastrar o usuário');
        } catch (QueryException $e) {
            return redirect()->route('admin.register')->with('nosuccess', 'Erro ao cadastrar o usuário');
        } catch (\PDOException $e) {
            return redirect()->route('admin.register')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            throw $e;
        }

        return redirect()->route('admin.login')->with('success', 'Usuário cadastrado com sucesso');
    }

    public function createUser($nome, $email, $senha, $cpfCnpj, $acesso)
    {
        return User::create([
            'nm_usuario' => $nome,
            'email' => $email,
            'password' => Hash::make($senha),
            'cd_cpf_cnpj' => $cpfCnpj,
            'cd_acesso' => $acesso
        ]);
    }

    public function verificaCpfCnpj($cpf_cnpj)
    {
        $cpf_cpnj_achado = DB::table('usuario')->select('cd_cpf_cnpj')->where('cd_cpf_cnpj', '=', $cpf_cnpj)->get();

        return response()->json([ 'cpf_cnpj' => $cpf_cpnj_achado ]);
    }
}
