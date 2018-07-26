<?php

namespace App\Http\Controllers\Auth;

use App\Category;
use App\Menu;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

        $menuNav =  Menu::all();

        //Carrega as categorias e subcategorias para serem apresentadas no menu nav
        foreach($menuNav as $key=>$menu){

            $categoriaSubCat[$key] = Category::
            leftJoin('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                ->leftJoin('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
                ->leftJoin('menu_categoria', 'menu_categoria.fk_cd_categoria', '=', 'categoria.cd_categoria')
                ->leftJoin('menu', 'menu.cd_menu', '=', 'menu_categoria.fk_cd_menu')
                ->select(
                    'categoria.cd_categoria',
                    'categoria.nm_categoria',
                    'sub_categoria.cd_sub_categoria',
                    'sub_categoria.nm_sub_categoria'
                )
                ->where('menu.cd_menu', '=', $menu->cd_menu)
                ->get();

        }

        return view('pages.app.auth.register', compact('menuNav', 'categoriaSubCat'));
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
            $imageName = uniqid() . $dtNascimento->day . $dtNascimento->month . $dtNascimento->year . '.' . $ext;
            $userWithImage = true;
        } else {
            $userWithImage = false;
            $imageName = 'noavatar.png';
        }

        DB::beginTransaction();

        try {
            $telefone = $this->createPhone($telefone);
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('client.register')->with('nosuccess', 'Erro ao cadastrar o telefone do cliente');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('client.register')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            $cliente = $this->createClient($request->cd_cpf_cnpj, $request->nm_cliente, $request->email, $request->password, $dtNascimento->toDateString(), $imageName, $telefone->cd_telefone);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('client.register')->with('nosuccess', 'Erro ao cadastrar os dados do cliente');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('client.register')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }


        if ($userWithImage) {
            $this->saveImageFile($imagePath, $imageName, $realPath);
        }

        DB::commit();
        Auth::login($cliente);
        return redirect()->route('client.dashboard')->with('success', 'Cadastro realizado com sucesso');

    }

    public function createPhone($numTelefone)
    {
        return Phone::firstOrCreate([
            'cd_celular1' => $numTelefone
        ]);
    }

    public function createClient($cpfCnpj, $nomeCliente, $email, $senha, $dataNascimento, $imagemCliente, $codTelefone)
    {
        return Client::create([
            'cd_cpf_cnpj' => $cpfCnpj,
            'nm_cliente' => $nomeCliente,
            'email' => $email,
            'password' => Hash::make($senha),
            'dt_nascimento' => $dataNascimento,
            'im_cliente' => $imagemCliente,
            'cd_telefone' => $codTelefone,
        ]);
    }

    public function verificaCpfCnpj($cpf_cnpj)
    {
        $cpf_cpnj_achado = DB::table('cliente')
            ->select('cd_cpf_cnpj')
            ->where('cd_cpf_cnpj', '=', $cpf_cnpj)
            ->get();

        return response()->json([ 'cpf_cnpj' => $cpf_cpnj_achado ]);
    }

    public function verificaEmail(Request $request){
        //dd($request->all());

        $email = DB::table('cliente')
                ->select('email')
                ->where('email', '=', $request->email)
                ->get();

        //dd($email);

        if(count($email) == 0){
            return response()->json([
                'message' => false
            ]);
        }

        return response()->json([
            'message' => true
        ]);
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
