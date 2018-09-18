<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class PagseguroController extends Controller
{
    //
    public function index(){
        return view('pages.admin.pagSeguroIndex');
    }

    public function consultaPedido(Request $request){
        //dd($request->datas);
        $token ='4D97A178277542CAAB150D1096002DF1';
        $emailPagseguro = 'vendas@vipx.com.br';
        $dataInicial = date('Y-m-d', strtotime($request->datas[0]));
        $dataFinal= date('Y-m-d', strtotime($request->datas[1]));

        //$cod_transacao = '3A448AD1-3381-4153-B28C-64D305074395';

        $url = 'https://ws.pagseguro.uol.com.br/v2/transactions?email='. $emailPagseguro .
                '&initialDate=' . $dataInicial . 'T00:00'.
                '&finalDate=' . $dataFinal . 'T00:00'.
                '&page='. $request->pagina.
                '&maxPageResults=100';

        //dd($url);

        $xml = $this->executeGetTransaction($url, $token);
        $dados = simplexml_load_string($xml);
        //dd($xml);

        return response()->json([$dados]);
    }

    public function consultaPedidoTransacao(Request $request){
        $token ='4D97A178277542CAAB150D1096002DF1';
        $emailPagseguro = 'vendas@vipx.com.br';

        $cod_transacao = $request->transacao;

        $url = 'https://ws.pagseguro.uol.com.br/v3/transactions/' . $cod_transacao . '?email=' . $emailPagseguro;

        $xml = $this->executeGetTransaction($url, $token);
        $dados = simplexml_load_string($xml);
        //dd($xml);

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

    public function atualizaPedidos(Request $request){
        try {
            $pedido = Order::where('cd_referencia', '=', $request->referencia)->get();

            if (count($pedido) > 0) {
                if ($pedido[0]->cd_status != $request->status) {
                    Order::where('cd_referencia', '=', $request->referencia)
                        ->update(['cd_status' => $request->status]);

                    return response()->json(['deuErro' => false, 'statusAtualizado' => true]);
                }
            }
        }
        catch (\Exception $ex){
            return response()->json(['deuErro' => true]);
        }

        return response()->json(['deuErro' => false, 'statusAtualizado' => false]);

    }

    public function urlRetorno(Request $request){
        dd($request->all());

    }
}
