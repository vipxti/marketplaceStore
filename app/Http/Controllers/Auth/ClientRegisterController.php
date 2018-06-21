<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\ClientRequest;
use App\Client;

class ClientRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegisterForm()
    {
        return view('pages.app.cadastrocliente');
    }

    protected function create(ClientRequest $request)
    {
        try {
            Client::create([

                //TO DO

            ]);
        } catch (\Exception $e) {
        } finally {
        }
    }

    public function verificaCpfCnpj($cpf_cnpj)
    {
        $cpf_cpnj_achado = DB::table('cliente')
            ->select('cd_cpf_cnpj')
            ->where('cd_cpf_cnpj', '=', $cpf_cnpj)
            ->get();

        return response()->json([ 'cpf_cnpj' => $cpf_cpnj_achado ]);
    }
}
