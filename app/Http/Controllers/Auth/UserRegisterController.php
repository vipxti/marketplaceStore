<?php

namespace App\Http\Controllers\Auth;

use App\Contact;
use App\Http\Requests\UserRequest;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;

class UserRegisterController extends Controller
{
    //use RegistersUsers;

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

        Contact::create([
            'cd_celular2' => null
        ]);

        $lastIdTel = Contact::orderBy('cd_telefone','DESC')->first();

        //dd($lastIdTel->cd_telefone);

        $user = User::create([
                'cd_cpf_cnpj' => $request->cd_cpf_cnpj,
                'nm_usuario' => $request->nm_usuario,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'ic_adm' => 0,
                'ds_img' => 0,
                'cd_telefone' => $lastIdTel->cd_telefone
            ]);

        if ($user) {

            auth()->login($user);
            $userName = Auth::user()->nm_usuario;
            //$request->session()->flash('msg.level', 'success');
            //$request->session()->flash('msg.content', 'Bem vindo '. $userName);
            return redirect()->route('usuario.dados');

        }
        else
        {

            return redirect()->back()->withErrors('Houve um problema ao cadastrar o usuário');

        }


    }
}
