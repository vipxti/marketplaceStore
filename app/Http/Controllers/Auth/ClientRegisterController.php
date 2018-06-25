<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\ClientRequest;
use App\Client;
use App\Phone;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        return view('pages.app.auth.register');
    }

    protected function create(ClientRequest $request)
    {
        //dd($request->all());

        $telefone = $this->formataTelefone($request->cd_celular1);
        $dtNascimento = $this->formataData($request->dt_nascimento);

        if ($request->hasFile('image')) {
            $image = $request->image;
            $imagePath = $this->pastaImagemCliente();
            $realPath = $image->getRealPath();
            $ext = $image->getClientOriginalExtension();
            $imageName = $request->cd_cpf_cnpj . $dtNascimento->day . $dtNascimento->month . $dtNascimento->year . '.' . $ext;
            $userWithImage = true;
        } else {
            $userWithImage = false;
            $imageName = 'noavatar.png';
        }

        try {
            Phone::create([
            'cd_celular1' => $telefone
        ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('client.register')->with('nosuccess', 'Problema ao cadastrar o cliente');
        } finally {
            $tel = Phone::orderBy('cd_telefone', 'DESC')->first();
        }

        try {
            $client = Client::create([
                'cd_cpf_cnpj' => $request->cd_cpf_cnpj,
                'nm_cliente' => $request->nm_cliente,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'dt_nascimento' => $dtNascimento->toDateString(),
                'im_cliente' => $imageName,
                'cd_telefone' => $tel->cd_telefone,
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            Phone::destroy($tel->cd_telefone);
            return redirect()->route('client.register')->with('nosuccess', 'Problema ao realizar o cadastro');
        } finally {
            if ($userWithImage) {
                $this->saveImageFile($imagePath, $imageName, $realPath);
            }

            Auth::login($client);
            
            return redirect()->route('client.dashboard')->with('success', 'Cadastro realizado com sucesso');
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

    public function formataTelefone($numeroTelefone)
    {
        $telFormatado = str_replace('(', '', $numeroTelefone);
        $telFormatado = str_replace(')', '', $telFormatado);
        $telFormatado = str_replace('-', '', $telFormatado);
        $telFormatado = str_replace(' ', '', $telFormatado);

        return $telFormatado;
    }

    public function formataData($date)
    {
        return Carbon::createFromFormat('d/m/Y', $date);
    }

    public function saveImageFile($imagePath, $imageName, $realPath)
    {
        Image::make($realPath)->save($imagePath . '/' . $imageName);
    }

    public function pastaImagemCliente()
    {
        return public_path('img/app/clients');
    }
}
