<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class RelatoriosController extends Controller
{
    public function indexPromocao(){

        return view('pages.admin.products.integration.bling.relatorios.relatorioPromocao');
    }

    public function indexClientesPromocao(){

        return view('pages.admin.products.integration.bling.relatorios.relatorioClientesPromocao');
    }

    public function indexSugestaoVendas(){

        return view('pages.admin.products.integration.bling.relatorios.relatorioSugestaoVendas');
    }

    public function indexTabela(){

        return view('pages.admin.products.integration.bling.relatorios.tabela');
    }

    public function indexInventario(){

        return view('pages.admin.products.integration.bling.relatorios.inventario', compact('depositos'));
    }

    public function getDepositos(){
        $dadoUsuario = DB::table('dados_empresa')->get();
        $apikey = $dadoUsuario[0]->cd_api_key;
        $url = 'https://bling.com.br/Api/v2/depositos/json';
        $depositos = $this->executeGetDeposits($url, $apikey);

        return response()->json([$depositos]);
    }

    public function executeGetDeposits($url, $apikey){
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url . '&apikey=' . $apikey);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $response;
    }

    public function udpateEstoque(Request $request){
        //dd($request->all());

        $dadoUsuario = DB::table('dados_empresa')->get();
        $apikey = $dadoUsuario[0]->cd_api_key;

        $url = 'https://bling.com.br/Api/v2/produto/' . $request->sku . '/';
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' .
                '<produto>' .
                    '<codigo>'. $request->sku .'</codigo>' .
                    '<descricao>'. $request->produto .'</descricao>' .
                    '<deposito>' .
                        '<id>'. $request->id_deposito .'</id>' .
                        '<estoque>'. $request->estoque .'</estoque>' .
                    '</deposito>' .
                '</produto>';

        //dd($xml);

        $posts = array (
            "apikey" => $apikey,
            "xml" => rawurlencode($xml)
        );

        $retorno = $this->executeUpdateProduct($url, $posts);

        //dd($retorno);

        return response()->json([$retorno]);
    }

    function executeUpdateProduct($url, $data){
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_POST, count($data));
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $response;
    }

}
