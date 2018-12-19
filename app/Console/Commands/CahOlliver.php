<?php

namespace App\Console\Commands;

use App\Order;
use Illuminate\Console\Command;

class CahOlliver extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cah:olliver';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calcula a comissão da CahOlliver';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $token ='4D97A178277542CAAB150D1096002DF1';
        $emailPagseguro = 'vendas@vipx.com.br';
        $dataInicial = date("Y-m-d", strtotime("-15 day"));
        $dataFinal= date("Y-m-d");

        $url = 'https://ws.pagseguro.uol.com.br/v2/transactions?email='. $emailPagseguro .
            '&initialDate=' . $dataInicial . 'T00:00'.
            '&finalDate=' . $dataFinal . 'T00:00'.
            '&page=1'.
            '&maxPageResults=100';

        $xml = $this->executeGetTransaction($url, $token);
        $dados = simplexml_load_string($xml);
        $comissao = 0;

        foreach ($dados->transactions->transaction as $dado){
            $pedido = Order::where("cd_referencia", "=", $dado->reference)->get();

            if(count($pedido) > 0){
                $valor = $pedido[0]->vl_total - $pedido[0]->vl_frete;
                $comissao+=$valor;
            }
        }

        for ($i = 2; $i <= $dados->totalPages; $i++){
            $url = 'https://ws.pagseguro.uol.com.br/v2/transactions?email='. $emailPagseguro .
                '&initialDate=' . $dataInicial . 'T00:00'.
                '&finalDate=' . $dataFinal . 'T00:00'.
                '&page='. $i .
                '&maxPageResults=100';

            $xml = $this->executeGetTransaction($url, $token);
            $dados = simplexml_load_string($xml);

            foreach ($dados->transactions->transaction as $dado){
                $pedido = Order::where("cd_referencia", "=", $dado->reference)->get();

                if(count($pedido) > 0){
                    $valor = $pedido[0]->vl_total - $pedido[0]->vl_frete;
                    $comissao+=$valor;
                }
            }

        }
        $comissao = $comissao * 0.08;

        $arquivo = fopen('comissao_caholliver3.txt', 'w+');
        fwrite($arquivo, $comissao);
        fclose($arquivo);

        // emails para quem será enviado o formulário
        $emailenviar = "vipxti@gmail.com";
        $destino = "comercial@vipx.com.br";
        $assunto = "Comissão CahOlliver";

        // É necessário indicar que o formato do e-mail é html
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From:'. $emailenviar;

        $enviaremail = mail($destino, $assunto, $comissao, $headers);

        if($enviaremail){
            $arquivo2 = fopen('resultado_email.txt', 'w+');
            fwrite($arquivo2, "E-MAIL ENVIADO COM SUCESSO!");
            fclose($arquivo2);
        } else {
            $arquivo2 = fopen('resultado_email.txt', 'w+');
            fwrite($arquivo2, "ERRO AO ENVIAR E-MAIL!");
            fclose($arquivo2);
        }



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
