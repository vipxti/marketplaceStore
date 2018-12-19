<?php

    $servername = "br866.hostgator.com.br";
    $username = "vipxcomb_ecm";
    $password = ".ilP!DCBnU}Cgprz";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=vipxcomb_caholliver_producao", $username, $password);
        $conn->exec('SET NAMES utf8');

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Conectado com sucesso<br/>"; 

        $token ='4D97A178277542CAAB150D1096002DF1';
        $emailPagseguro = 'vendas@vipx.com.br';
        $dataInicial = date("Y-m-d", strtotime("-15 day"));
        $dataFinal= date("Y-m-d");
        $comissao = 0;

        $url = 'https://ws.pagseguro.uol.com.br/v2/transactions?email='. $emailPagseguro .
            '&initialDate=' . $dataInicial . 'T00:00'.
            '&finalDate=' . $dataFinal . 'T00:00'.
            '&page=1'.
            '&maxPageResults=100';

        $xml = executeGetTransaction($url, $token);
        $dados = simplexml_load_string($xml);

        foreach ($dados->transactions->transaction as $dado){
            $pedido = $conn->query(
                "select * from pedido where cd_referencia = '" . $dado->reference . "';"
            );
    
            if ($pedido->rowCount() > 0) {
    
                $pedido = $pedido->fetch();

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

            $xml = executeGetTransaction($url, $token);
            $dados = simplexml_load_string($xml);

            foreach ($dados->transactions->transaction as $dado){
                $pedido = $conn->query(
                    "select * from pedido where cd_referencia = '" . $dado->reference . "';"
                );
        
                if ($pedido->rowCount() > 0) {
        
                    $pedido = $pedido->fetch();
                    
                    $valor = $pedido[0]->vl_total - $pedido[0]->vl_frete;
                    $comissao+=$valor;
                }
            }
        }

        if($comissao > 0)
            $comissao = $comissao * 0.08;

        $arquivo = fopen('public_html/caholiiver.maktubbeauty.com.br/public/comissao_caholliver.txt', 'w+');
        fwrite($arquivo, $comissao);
        fclose($arquivo);

        // emails para quem será enviado o formulário
        $emailenviar = "vipxti@gmail.com";
        $destino = "comercial@vipx.com.br";
        $assunto = "Comissão CahOliiver";

        // É necessário indicar que o formato do e-mail é html
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From:'. $emailenviar;

        $mensagem = "De acordo com os valores de vendas da CahOliiver, ela terá que receber R$ ". $comissao . " de comissão";

        $enviaremail = mail($destino, $assunto, $mensagem, $headers);

        if($enviaremail){
            $arquivo2 = fopen('public_html/caholliver.maktubbeauty.com.br/public/resultado_email.txt', 'w+');
            fwrite($arquivo2, "E-MAIL ENVIADO COM SUCESSO!");
            fclose($arquivo2);
        } else {
            $arquivo2 = fopen('public_html/caholliver.maktubbeauty.com.br/public/resultado_email.txt', 'w+');
            fwrite($arquivo2, "ERRO AO ENVIAR E-MAIL!");
            fclose($arquivo2);
        }

    }
    catch(PDOException $e){
        echo "Erro na conexão: " . $e->getMessage();
    }

    //==========================================================================================================
    //BUSCA OS DADOS NO PAGSEGURO
    function executeGetTransaction($url,$token){
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

?>