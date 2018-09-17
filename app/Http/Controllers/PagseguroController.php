<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagseguroController extends Controller
{
    //
    public function index(){
        return view('pages.admin.pagSeguroIndex');
    }

    public function consultaPedido(){

        $token ='4D97A178277542CAAB150D1096002DF1';
        $emailPagseguro = 'vendas@vipx.com.br';

        $cod_transacao = '3A448AD1-3381-4153-B28C-64D305074395';

        $url = 'https://ws.pagseguro.uol.com.br/v3/transactions/' . $cod_transacao . '?email=' . $emailPagseguro;

        $xml = $this->executeGetTransaction($url, $token);
        $dados = simplexml_load_string($xml);

        return response()->json([$dados]);
    }

    public function executeGetTransaction($url,$token){
        $curl_handle = curl_init();
        $headers = array('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1');
        curl_setopt($curl_handle, CURLOPT_URL, $url . '&token=' . $token);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl_handle, CURLOPT_HEADER, false);
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $response;
    }
}
