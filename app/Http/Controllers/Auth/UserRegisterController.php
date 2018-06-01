<?php

namespace App\Http\Controllers\Auth;

use App\Contact;
use App\Http\Requests\UserRequest;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class UserRegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showRegisterForm()
    {
        return view('pages.admin.cadUsuario');
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
        Contact::create([
            'cd_celular1' => $request->celular1,
            'cd_celular2' => $request->celular2
        ]);

        $lastIdTel = Contact::orderBy('cd_telefone','DESC')->first();

        User::create([
            'cd_cpf_cnpj' => '',
            'nm_usuario' => '',
            'nm_email' => $request->nm_email,
            'ds_senha' => $request->ds_senha,
            'ic_adm' => 0,
            'ds_img' => $request->ds_img,
            'cd_telefone' => $lastIdTel
        ]);
    }
}
