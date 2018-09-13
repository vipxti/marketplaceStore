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

        $data['token'] ='4D97A178277542CAAB150D1096002DF1';
        $emailPagseguro = 'vendas@vipx.com.br';
        //dd($emailPagseguro);

        $cod_transacao = '3A448AD1-3381-4153-B28C-64D305074395';

        $data = http_build_query($data);
        //dd($data);
        $url = 'https://ws.pagseguro.uol.com.br/v3/transactions/' . $cod_transacao;

        $curl = curl_init();

        $headers = array('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1');

        curl_setopt($curl, CURLOPT_URL, $url . '?email=' . $emailPagseguro);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        //curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_HEADER, false);
        //curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        $xml = curl_exec($curl);

        curl_close($curl);

        dd($xml);

        $xml = simplexml_load_string($xml);
        //$idSessao = $xml->id;
        //dd($xml);

        //$response = [ 'idSessao' => $idSessao];

        return response()->json($xml);
    }
}
