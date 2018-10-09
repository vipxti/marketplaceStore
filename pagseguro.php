<?php 
    $servername = "vipx.c6xefyknubok.sa-east-1.rds.amazonaws.com";
    $username = "root";
    $password = "aM2cM6f96L751CeO";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=FPC_maktubbeauty_dev", $username, $password);
        $conn->exec('SET NAMES utf8');

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conectado com sucesso<br/>"; 

        $token ='4D97A178277542CAAB150D1096002DF1';
        $emailPagseguro = 'vendas@vipx.com.br';
        $dataInicial = date("Y-m-d", strtotime("-29 day"));
        $dataFinal= date("Y-m-d");

        $url = 'https://ws.pagseguro.uol.com.br/v2/transactions?email='. $emailPagseguro .
            '&initialDate=' . $dataInicial . 'T00:00'.
            '&finalDate=' . $dataFinal . 'T00:00'.
            '&page=1'.
            '&maxPageResults=100';

        $xml = executeGetTransaction($url, $token);
        $dados = simplexml_load_string($xml);

        //print_r($dados->transactions->transaction);

        foreach ($dados->transactions->transaction as $dado){
            //print_r($dado->reference);
            atualizaPedidos($dado, $conn);
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
                atualizaPedidos($dado, $conn);
            }
        }

        $stmt = $conn->prepare('insert into marca (nome_marca) VALUES(:nome_marca)');
        $stmt->execute(array(
            ':nome_marca' => 'Marca do PagSeguro'
        ));

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

    //==========================================================================================================
    //QUANDO HÁ UMA MUDANÇA NO STATUS DO PEDIDO, ELE É ATUALIZADO NO BANCO
    function atualizaPedidos($dado, $conn){
        $pedido = $conn->query(
            "select * from pedido where cd_referencia = '" . $dado->reference . "';"
        );

        //print_r($pedido->rowCount());

        if ($pedido->rowCount() > 0) {

            $pedido = $pedido->fetch();

            if ($pedido['cd_status'] != $dado->status) {
                $data = explode('T', $dado->lastEventDate);

                $stmt = $conn->prepare(
                    "update pedido set cd_status = ". $dado->status .", dt_alteracao = '". $data[0] . "' where cd_referencia = '" . $dado->reference . "';"
                );
            
                $stmt->execute();
                echo $stmt->rowCount() . " linhas atualizadas com sucesso.";

                if($dado->status == 3){
                    inserePedidoBling($dado->reference, $conn);
                }
            }
        }
    }

    //==========================================================================================================
    //SELECIONA OS PEDIDOS PARA ENVIAR PARA O BLING
    function inserePedidoBling($referencia, $conn)
    {
        $variacao = false;
        $pedido = $conn->query(
            "select * from pedido
            join cliente c on pedido.cd_cliente = c.cd_cliente
            join telefone t on c.cd_telefone = t.cd_telefone
            join cliente_endereco ce on pedido.fk_end_entrega_id = ce.id_cliente_endereco
            join endereco e on ce.cd_endereco = e.cd_endereco
            join pedido_produto produto on pedido.cd_pedido = produto.cd_pedido
            join bairro b on e.cd_bairro = b.cd_bairro
            join cidade c2 on b.cd_cidade = c2.cd_cidade
            join uf u on c2.cd_uf = u.cd_uf
            join tipo_frete t2 on pedido.fk_tipo_frete_id = t2.id_tipo_frete
            where pedido.cd_referencia = '" . $referencia . "';"
        );
        
        $pedido = $pedido->fetch();

        $produtos = $conn->query(
            "select s.cd_nr_sku, p.nm_produto, produto.qt_produto, p.vl_produto from pedido
            join pedido_produto produto on pedido.cd_pedido = produto.cd_pedido
            join sku s on produto.cd_sku = s.cd_sku
            join produto p on s.cd_sku = p.cd_sku
            where pedido.cd_referencia = '" . $referencia . "';"
        );

        if($produtos->rowCount() == 0){
            $variacao = true;
            $produtos = $conn->query(
                "select s.cd_nr_sku, pv.nm_produto_variacao, produto.qt_produto, pv.vl_produto_variacao from pedido
                join pedido_produto produto on pedido.cd_pedido = produto.cd_pedido
                join sku s on produto.cd_sku = s.cd_sku
                join produto_variacao pv on s.cd_sku = pv.cd_sku
                where pedido.cd_referencia = '" . $referencia . "';" 
            );
        }

        //$produtos = $produtos->fetchAll();

        $dadoUsuario = $conn->query(
            "select * from dados_empresa;"
        );

        $dadoUsuario = $dadoUsuario->fetch();

        $apikey = $dadoUsuario['cd_api_key'];
        $loja = $dadoUsuario['cd_api_bling'];

        $data = date('d-m-Y', strtotime($pedido['dt_compra']));

        $tipoPessoa = '';

        if(strlen($pedido['cd_cpf_cnpj']) == 11){
            $tipoPessoa = 'F';
        }
        else{
            $tipoPessoa = 'J';
        }

        $cep = substr($pedido['cd_cep'], 0, 2) . ".";
        $cep.=substr($pedido['cd_cep'], 2, 3) . "-";
        $cep.=substr($pedido['cd_cep'], 5);

        $url = 'https://bling.com.br/Api/v2/pedido/json/';

        if(!$variacao)
            $xml = geraXml($data, $loja, $pedido, $tipoPessoa, $cep, $produtos);
        else
            $xml = geraXmlVariacao($data, $loja, $pedido, $tipoPessoa, $cep, $produtos);

        //print_r($xml);

        $posts = array (
            "apikey" => $apikey,
            "xml" => rawurlencode($xml)
        );

        executeSendOrder($url, $posts);
    }

    //==========================================================================================================
    //ENVIA OS PEDIDOS COM STATUS PAGO PARA O BLING
    function executeSendOrder($url, $data){
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_POST, count($data));
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $response;
    }

    //==========================================================================================================
    //GERA O XML DO PRODUTO PAI
    function geraXml($data, $loja, $pedido, $tipoPessoa, $cep, $produtos){
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'.
            '<pedido>'.
            '<data>'. $data .'</data>'.
            '<loja>'. $loja .'</loja>'.
            '<cliente>'.
            '<nome>'. $pedido['nm_destinatario']. ' ' . $pedido['sobrenome_destinatario'] .'</nome>'.
            '<tipoPessoa>'. $tipoPessoa .'</tipoPessoa>'.
            '<cpf_cnpj>'. $pedido['cd_cpf_cnpj'] .'</cpf_cnpj>'.
            '<endereco>'. $pedido['ds_endereco'] .'</endereco>'.
            '<numero>'. $pedido['cd_numero_endereco'] .'</numero>'.
            '<complemento>'. $pedido['ds_complemento'] .'</complemento>'.
            '<bairro>'. $pedido['nm_bairro'] .'</bairro>'.
            '<cep>'. $cep .'</cep>'.
            '<cidade>'. $pedido['nm_cidade'] .'</cidade>'.
            '<uf>'. $pedido['sg_uf'] .'</uf>'.
            '<celular>'. $pedido['cd_celular1'] .'</celular>'.
            '</cliente>'.
            '<transporte>'.
            '<transportadora>'. $pedido['tipo_frete'] .'</transportadora>'.
            '<tipo_frete>R</tipo_frete>'.
            '<servico_correios>'. $pedido['tipo_frete'] .'</servico_correios>'.
            '</transporte>'.
            '<itens>';

        foreach ($produtos as $produto){
            $xml.= '<item>'.
                '<codigo>'. $produto['cd_nr_sku'] .'</codigo>'.
                '<descricao>'. $produto['nm_produto'] .'</descricao>'.
                '<qtde>'. $produto['qt_produto'] .'</qtde>'.
                '<vlr_unit>'. $produto['vl_produto'] .'</vlr_unit>'.
                '</item>';
        }

        $xml.= '</itens>'.
            '<parcelas>'.
            '<parcela>'.
            '<dias>14</dias>'.
            '<vlr>'. $pedido['vl_total'] .'</vlr>'.
            '<obs>PagSeguro</obs>'.
            '</parcela>'.
            '</parcelas>'.
            '<vlr_frete>'. $pedido['vl_frete'] .'</vlr_frete>'.
            '</pedido>';

        return $xml;
    }

    //==========================================================================================================
    //GERA O XML DA VARIAÇÃO
    function geraXmlVariacao($data, $loja, $pedido, $tipoPessoa, $cep, $produtos){
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'.
            '<pedido>'.
            '<data>'. $data .'</data>'.
            '<loja>'. $loja .'</loja>'.
            '<cliente>'.
            '<nome>'. $pedido['nm_destinatario']. ' ' . $pedido['sobrenome_destinatario'] .'</nome>'.
            '<tipoPessoa>'. $tipoPessoa .'</tipoPessoa>'.
            '<cpf_cnpj>'. $pedido['cd_cpf_cnpj'] .'</cpf_cnpj>'.
            '<endereco>'. $pedido['ds_endereco'] .'</endereco>'.
            '<numero>'. $pedido['cd_numero_endereco'] .'</numero>'.
            '<complemento>'. $pedido['ds_complemento'] .'</complemento>'.
            '<bairro>'. $pedido['nm_bairro'] .'</bairro>'.
            '<cep>'. $cep .'</cep>'.
            '<cidade>'. $pedido['nm_cidade'] .'</cidade>'.
            '<uf>'. $pedido['sg_uf'] .'</uf>'.
            '<celular>'. $pedido['cd_celular1'] .'</celular>'.
            '</cliente>'.
            '<transporte>'.
            '<transportadora>'. $pedido['tipo_frete'] .'</transportadora>'.
            '<tipo_frete>R</tipo_frete>'.
            '<servico_correios>'. $pedido['tipo_frete'] .'</servico_correios>'.
            '</transporte>'.
            '<itens>';

        foreach ($produtos as $produto){
            $xml.= '<item>'.
                '<codigo>'. $produto['cd_nr_sku'] .'</codigo>'.
                '<descricao>'. $produto['nm_produto_variacao'] .'</descricao>'.
                '<qtde>'. $produto['qt_produto'].'</qtde>'.
                '<vlr_unit>'. $produto['vl_produto_variacao'] .'</vlr_unit>'.
                '</item>';
        }

        $xml.= '</itens>'.
            '<parcelas>'.
            '<parcela>'.
            '<dias>14</dias>'.
            '<vlr>'. $pedido['vl_total'] .'</vlr>'.
            '<obs>PagSeguro</obs>'.
            '</parcela>'.
            '</parcelas>'.
            '<vlr_frete>'. $pedido['vl_frete'] .'</vlr_frete>'.
            '</pedido>';

        return $xml;
    }

?>