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

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showClientPage()
    {
        $telCliente = null;

        if (Auth::check()) {
            $n = explode(' ', Auth::user()->nm_cliente);
            $nome = $n[0];
        } else {
            $nome = null;
        }

        try {
            $telCliente = Client::join('telefone', 'cliente.cd_telefone', '=', 'telefone.cd_telefone')->where('cliente.cd_cliente', '=', Auth::user()->cd_cliente)->select('telefone.cd_celular1', 'telefone.cd_celular2')->get();
        } catch (QueryException $e) {
            return redirect()->route('client.dashboard')->with('nosuccess', 'Problema ao acessar o banco');
        } catch (ErrorException $e) {
            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro');
        } catch (\Exception $e) {
            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro');
        }


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

        $endereco = Client::join('cliente_endereco', 'cliente.cd_cliente', '=', 'cliente_endereco.cd_cliente')->join('endereco', 'cliente_endereco.cd_endereco', '=', 'endereco.cd_endereco')->select('ds_endereco', 'cd_numero_endereco', 'ds_complemento', 'ds_ponto_referencia')->where('cliente.cd_cliente', '=', Auth::user()->cd_cliente)->get();

        return view('pages.app.painelcliente', compact('telCliente', 'endereco', 'nome', 'menuNav', 'categoriaSubCat'));
    }

    public function saveClientAddress(ClientAddressRequest $request)
    {
        //dd($request->all());

        DB::beginTransaction();

        try {
            $pais = $this->createCountry($request->nm_pais);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro ao cadastrar o país');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro ao cadastrar o país');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            $estado = $this->createState($request->sg_uf, $pais->cd_pais);
        } catch (ValidationException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro ao cadastrar o estado');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro ao cadastrar o estado');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            $cidade = $this->createCity($request->nm_cidade, $request->cd_ibge, $estado->cd_uf);
        } catch (ValidationException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro ao cadastrar a cidade');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro ao cadastrar a cidade');
        } catch (\PDOException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            $bairro = $this->createNeighbour($request->nm_bairro, $cidade->cd_cidade);
        } catch (ValidationException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro ao cadastrar o bairro');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro ao cadastrar o bairro');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            $endereco = $this->createAddress($request->cd_cep, $request->ds_endereco, $request->cd_numero_endereco, $bairro->cd_bairro);
        } catch (ValidationException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro ao cadastrar o endereço');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro ao cadastrar o endereço');
        } catch (\PDOException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('client.dashboard')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            $existeEnderecoNoCliente = DB::table('cliente_endereco')->where('cd_cliente', '=', Auth::user()->cd_cliente)->count();

            if ($existeEnderecoNoCliente > 0) {
                $endPrincipal = 0;
            } else {
                $endPrincipal = 1;
            }

            $this->associateClientAddress($endereco->cd_endereco, Auth::user()->cd_cliente, $endPrincipal, $request->nm_destinatario, $request->ds_complemento, $request->ds_ponto_referencia);
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

    public function createCountry($nomePais)
    {
        return Pais::firstOrCreate([
            'nm_pais' => $nomePais
        ]);
    }

    public function createState($siglaEstado, $codPais)
    {
        return Uf::firstOrCreate([
            'sg_uf' => $siglaEstado,
            'cd_pais' => $codPais
        ]);
    }

    public function createCity($nomeCidade, $codIbge, $codEstado)
    {
        return Cidade::firstOrcreate([
            'nm_cidade' => $nomeCidade,
            'cd_ibge' => $codIbge,
            'cd_uf' => $codEstado
        ]);
    }

    public function createNeighbour($nomeBairro, $codCidade)
    {
        return Bairro::firstOrCreate([
            'nm_bairro' => $nomeBairro,
            'cd_cidade' => $codCidade
        ]);
    }

    public function createAddress($cep, $endereco, $numero, $codBairro)
    {
        return Endereco::create([
            'cd_cep' => $cep,
            'ds_endereco' => $endereco,
            'cd_numero_endereco' => $numero,
            'cd_bairro' => $codBairro
        ]);
    }

    public function associateClientAddress($codEndereco, $codCliente, $principal, $nomeDestinatario, $complemento, $pontoReferencia)
    {
        DB::table('cliente_endereco')->insert([
            'cd_endereco' => $codEndereco,
            'cd_cliente' => $codCliente,
            'ic_principal' => $principal,
            'nm_destinatario' => $nomeDestinatario,
            'ds_complemento' => $complemento,
            'ds_ponto_referencia' => $pontoReferencia,
        ]);
    }
}
