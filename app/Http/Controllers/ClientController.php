<?php

namespace App\Http\Controllers;

use App\Category;
use App\Menu;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Whoops\Exception\ErrorException;
use App\Http\Requests\ClientAddressRequest;
use App\Uf;
use App\Cidade;
use App\Bairro;
use App\Pais;
use App\Endereco;
use App\Order;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showClientPage()
    {
        $telCliente = null;

        try {
            $telCliente = Client::join('telefone', 'cliente.cd_telefone', '=', 'telefone.cd_telefone')->where('cliente.cd_cliente', '=', Auth::user()->cd_cliente)->select('telefone.cd_celular1', 'telefone.cd_celular2')->get();
        } catch (QueryException $e) {
            return redirect()->route('client.dashboard')->with('nosuccess', 'Problema ao acessar o banco');
        } catch (ErrorException $e) {
            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro');
        } catch (\Exception $e) {
            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro');
        }

        //Consulta PagSeguro por código de referência e código da compra
        $pagSeguroData['token'] ='4D97A178277542CAAB150D1096002DF1';
        $pagSeguroData['email'] = 'vendas@vipx.com.br';

        $orders = Order::where('cd_cliente', '=', Auth::user()->cd_cliente)->select('cd_referencia', 'cd_pagseguro')->get()->toArray();

        $url = 'https://ws.pagseguro.uol.com.br/v2/transactions/';

        foreach ($orders as $key => $order) {
            $url .= $order['cd_pagseguro'];
            $pagSeguroData['reference'] = $order['cd_referencia'];

            $data = http_build_query($pagSeguroData);

            $curl = curl_init($url);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_URL, $url . '?' . $data);
            curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

            $xml = curl_exec($curl);

            curl_close($curl);

            $xml = [ simplexml_load_string($xml) ];
        }

        //dd($xml);


        $menuNav =  Menu::all();

        //Carrega as categorias e subcategorias para serem apresentadas no menu nav
        foreach ($menuNav as $key=>$menu) {
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

        $endereco = Client::join('cliente_endereco', 'cliente.cd_cliente', '=', 'cliente_endereco.cd_cliente')
            ->join('endereco', 'cliente_endereco.cd_endereco', '=', 'endereco.cd_endereco')
            ->join('bairro', 'endereco.cd_bairro', '=', 'bairro.cd_bairro')
            ->join('cidade', 'bairro.cd_cidade', '=', 'cidade.cd_cidade')
            ->join('uf', 'cidade.cd_uf', '=', 'uf.cd_uf')
            ->select(
                'ds_endereco',
                'cd_cep',
                'cd_numero_endereco',
                'ds_complemento',
                'ds_ponto_referencia',
                'nm_destinatario',
                'nm_bairro',
                'nm_cidade',
                'sg_uf'
            )
            ->where('cliente.cd_cliente', '=', Auth::user()->cd_cliente)
            ->get();

        //dd($endereco);
        return view('pages.app.client.dashboard', compact('telCliente', 'endereco', 'menuNav', 'categoriaSubCat'));
    }

    public function saveClientAddress(ClientAddressRequest $request)
    {
        //dd($request->all());

        $replaceCep = str_replace('-', '', $request->cd_cep);

        DB::beginTransaction();

        //PAIS
        try {
            $pais = $this->createCountry($request->nm_pais);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o país');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o país');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao conectar com o banco de dados pais');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        //UF
        try {
            $estado = $this->createState($request->sg_uf, $pais->toArray()[0]['cd_pais']);
        } catch (ValidationException $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o estado');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o estado');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao conectar com o banco de dados Uf');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        //CIDADE
        try {
            $cidade = $this->createCity($request->nm_cidade, $request->cd_ibge, $estado->toArray()[0]['cd_uf']);
        } catch (ValidationException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar a cidade');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar a cidade');
        } catch (\PDOException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao conectar com o banco de dados Cidade');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        //BAIRRO
        try {
            $bairro = $this->createNeighbour($request->nm_bairro, $cidade->toArray()[0]['cd_cidade']);
        } catch (ValidationException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o bairro');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o bairro');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao conectar com o banco de dados Bairro');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        //ENDEREÇO
        try {
            $endereco = $this->createAddress($replaceCep, $request->ds_endereco, $bairro->toArray()[0]['cd_bairro']);
        } catch (ValidationException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o endereço');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o endereço');
        } catch (\PDOException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao conectar com o banco de dados Endereço');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        //ASSOCIA CLIENTE COM ENDERECO
        try {
            $existeEnderecoNoCliente = DB::table('cliente_endereco')->where('cd_cliente', '=', Auth::user()->cd_cliente)->count();

            ($existeEnderecoNoCliente > 0) ? $endPrincipal = 0 : $endPrincipal = 1;

            $this->associateClientAddress(
                $endPrincipal,
                $request->nm_destinatario,
                $request->cd_numero_endereco,
                $request->ds_complemento,
                $request->ds_ponto_referencia,
                $endereco->toArray()[0]['cd_endereco'],
                Auth::user()->cd_cliente
            );
        } catch (ValidationException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro ao associar o endereço ao cliente');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro ao associar o endereço ao cliente');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('client.dashboard')->with('success', 'Endereço cadastrado com sucesso');
    }

    //INSERT ENDERECO
    public function createCountry($nomePais)
    {
        $idPais = Pais::where('nm_pais', 'like', '%'.$nomePais.'%')->select('cd_pais')->get();
        if (count($idPais) == 0) {
            Pais::create([
                'nm_pais' => $nomePais
            ]);
            $idPais = Pais::where('nm_pais', 'like', '%'.$nomePais.'%')->select('cd_pais')->get();
            return $idPais;
        } else {
            return $idPais;
        }
    }

    public function createState($siglaEstado, $codPais)
    {
        $idUf = Uf::where('sg_uf', 'like', '%'.$siglaEstado.'%')->select('cd_uf')->get();
        if (count($idUf) == 0) {
            Uf::create([
                'sg_uf' => $siglaEstado,
                'cd_pais' => $codPais
            ]);
            $idUf = Uf::where('sg_uf', 'like', '%'.$siglaEstado.'%')->select('cd_uf')->get();
            return $idUf;
        } else {
            return $idUf;
        }
    }

    public function createCity($nomeCidade, $codIbge, $codEstado)
    {
        $idCidade = Cidade::where('nm_cidade', 'like', '%'.$nomeCidade.'%')->select('cd_cidade')->get();
        //var_dump($idCidade);
        if (count($idCidade) == 0) {
            Cidade::create([
                'nm_cidade' => $nomeCidade,
                'cd_ibge' => $codIbge,
                'cd_uf' => $codEstado
            ]);
            $idCidade = Cidade::where('nm_cidade', 'like', '%'.$nomeCidade.'%')->select('cd_cidade')->get();
            return $idCidade;
        } else {
            return $idCidade;
        }
    }

    public function createNeighbour($nomeBairro, $codCidade)
    {
        $idBairro = Bairro::where('nm_bairro', 'like', '%'.$nomeBairro.'%')->select('cd_bairro')->get();
        if (count($idBairro) == 0) {
            Bairro::create([
                'nm_bairro' => $nomeBairro,
                'cd_cidade' => $codCidade
            ]);
            $idBairro = Bairro::where('nm_bairro', 'like', '%'.$nomeBairro.'%')->select('cd_bairro')->get();
            return $idBairro;
        } else {
            return $idBairro;
        }
    }

    public function createAddress($cep, $endereco, $codBairro)
    {
        $idEnd = Endereco::where('cd_cep', '=', $cep)->select('cd_endereco')->get();
        //dd($idEnd);
        if (count($idEnd) == 0) {
            Endereco::create([
                'cd_cep' => $cep,
                'ds_endereco' => $endereco,
                'cd_bairro' => $codBairro
            ]);
            $idEnd = Endereco::where('cd_cep', '=', $cep)->select('cd_endereco')->get();
            return $idEnd;
        } else {
            return $idEnd;
        }
    }

    public function associateClientAddress(
        $principal,
        $nomeDestinatario,
        $numero,
        $complemento,
        $pontoReferencia,
        $codEndereco,
        $codCliente
    ) {
        DB::table('cliente_endereco')->insert([
            'ic_principal' => $principal,
            'nm_destinatario' => $nomeDestinatario,
            'cd_numero_endereco' => $numero,
            'ds_complemento' => $complemento,
            'ds_ponto_referencia' => $pontoReferencia,
            'cd_endereco' => $codEndereco,
            'cd_cliente' => $codCliente,
        ]);
    }
}
