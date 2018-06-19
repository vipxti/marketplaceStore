<?php

namespace App\Http\Controllers\Auth;

use App\Access;
use App\Contact;
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

        //dd($request->all());

        try {

            $user = User::create([

                'nm_usuario' => $request->nm_usuario,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'cd_cpf_cnpj' => $request->cd_cpf_cnpj,
                'cd_acesso' => 0

            ]);

        }
        catch (\Exception $e) {

            return redirect()->route('admin.register')->with('nosuccess', 'Houve um problema ao cadastrar o usuário');

        }
        finally {

            Auth::guard('admin')->login($user);
            return redirect()->route('user.data')->with('success', 'Bem vindo ' . Auth::guard('admin')->user()->nm_usuario);

        }

    }

    public function verificaCpfCnpj($cpf_cnpj){

        $cpf_cpnj_achado = DB::table('usuario')
                            ->select('cd_cpf_cnpj')
                            ->where('cd_cpf_cnpj', '=', $cpf_cnpj)
                            ->get();

        return response()->json([ 'cpf_cnpj' => $cpf_cpnj_achado ]);


    }
}
