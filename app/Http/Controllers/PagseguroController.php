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
                        ->update(['cd_status' => $request->status,
                                'dt_alteracao' => $request->data]);

                    //if($request->status == 3){
                        //$this->inserePedidoBling($request->referencia);
                    //}

                    return response()->json(['deuErro' => false, 'statusAtualizado' => true]);
                }
            }
        }
        catch (\Exception $ex){
            return response()->json(['deuErro' => true]);
        }

        return response()->json(['deuErro' => false, 'statusAtualizado' => false]);

    }

    public function inserePedidoBling($referencia)
    {
        $pedido = Order::join('cliente', 'pedido.cd_cliente', '=', 'cliente.cd_cliente')
                        ->join('telefone', 'cliente.cd_telefone', '=', 'telefone.cd_telefone')
                        ->join('cliente_endereco', 'pedido.fk_end_entrega_id', '=', 'cliente_endereco.id_cliente_endereco')
                        ->join('endereco', 'cliente_endereco.cd_endereco', '=', 'endereco.cd_endereco')
                        ->join('pedido_produto', 'pedido.cd_pedido', '=', 'pedido_produto.cd_pedido')
                        ->where('pedido.cd_referencia', '=', $referencia)
                        ->get();

        dd($pedido);

        $data = date('Y-m-d', strtotime($pedido[0]->dt_compra));
        //dd($pedido);

        $url = 'https://bling.com.br/Api/v2/pedido/json/';
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'.
                    '<pedido>'.
                            '<data>'. $data .'</data>'.
                            '<cliente>'.
                                    '<nome></nome>'.
                            '</cliente>'.
                    '</pedido>';
        $posts = array (
            "apikey" => "{apikey}",
            "xml" => rawurlencode($xml)
        );
        $retorno = $this->executeSendOrder($url, $posts);
        //echo $retorno;
    }

    public function executeSendOrder($url, $data){
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_POST, count($data));
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $response;
    }

    public function urlRetorno(){

        Order::create([
            'vl_total' => 11.45,
            'cd_status' => 3,
            'cd_referencia' => 'maktub5b70edb216cb68.56229481',
            'cd_pagseguro' => '3D3AE9A8-D3F9-429E-A27E-D9AC5EF4B141',
            'dt_compra' => '2018-09-19',
            'vl_frete' => 0,
            'cd_cliente' => 2,
            'fk_end_entrega_id' => 2
        ]);

    }
}
