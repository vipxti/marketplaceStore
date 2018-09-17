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

        //$cod_transacao = '3A448AD1-3381-4153-B28C-64D305074395';
        $cod_transacao = '4125075B-DD02-410B-B809-2A3D38C65E14';

        //$url = 'https://ws.pagseguro.uol.com.br/v3/transactions/' . $cod_transacao . '?email=' . $emailPagseguro;
        $url = 'https://ws.pagseguro.uol.com.br/v2/transactions?'. $emailPagseguro .
                '&initialDate=2018-10-01T00:00
                &finalDate=2018-09-17T00:00
                &page=1
                &maxPageResults=100';

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

    public function urlRetorno(Request $request){
        dd($request->all());

    }
}
