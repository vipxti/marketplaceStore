<?php
    $servername = "vipx.c6xefyknubok.sa-east-1.rds.amazonaws.com";
    $username = "root";
    $password = "aM2cM6f96L751CeO";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=FPC_maktubbeauty_dev", $username, $password);
        $conn->exec('SET NAMES utf8');

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conectado com sucesso<br/>"; 

        $produtos = $conn->query(
            "select * from produto
            join produto_categoria_subcat pcs on produto.cd_produto = pcs.cd_produto
            join categoria_subcat cs on pcs.cd_categoria_subcat = cs.cd_categoria_subcat
            join categoria c on cs.cd_categoria = c.cd_categoria
            join sub_categoria sc on cs.cd_sub_categoria = sc.cd_sub_categoria
            join sku s on produto.cd_sku = s.cd_sku
            join sku_produto_img spi on s.cd_sku = spi.cd_sku
            join marca m on produto.marca_id_fk = m.id_marca
            join img_produto produto2 on spi.cd_img = produto2.cd_img
            where produto.cd_status_produto = 1 and produto2.ic_img_principal = 1;"
        );

        /* while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            echo "Nome Produto: {$linha['nm_produto']} - SKU: {$linha['cd_sku']} - Descrição: {$linha['ds_produto']}<br />";
        } */

        $xml = '<?xml version="1.0" encoding="utf-8"?>';
        $xml .= '<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">';
        $xml .= '<channel>';
        $xml .= '<title>Maktub Beauty</title>';
        $xml .= '<link>https://www.maktubbeauty.com.br</link>';
        $xml .= '<description>Teste</description>';

        foreach($produtos as $p){
            $xml .= '<item>
                <g:id>'. $p['cd_nr_sku'] .'</g:id>
                <g:title>'. $p['nm_produto'] .'</g:title>
                <g:description>'. $p['ds_produto'] .'</g:description>
                <g:link>https://www.maktubbeauty.com.br/page/product/'. $p['nm_slug'].'</g:link>
                <g:image_link>https://maktubbeauty.com.br/img/products/'. $p['im_produto'] .'</g:image_link>
                <g:condition>new</g:condition>
                <g:price>R$'. $p['vl_produto'] .'</g:price>';

            if($p['qt_produto'] > 5)
                $xml .= '<g:availability>in stock</g:availability>';
            else
                $xml .= '<g:availability>preorder</g:availability>';

            $xml .= '<g:shipping>
                            <g:country>BR</g:country>
                            <g:service>Standard</g:service>
                        </g:shipping>
                        <g:gtin>'. $p['cd_ean'] .'</g:gtin>
                        <g:brand>'.$p['nome_marca'] .'</g:brand>
                        <g:google_product_category>'. $p['nm_categoria'] . ' > ' . $p['nm_sub_categoria'] . '</g:google_product_category>
                    </item>';
        }

        $xml .= '</channel>
                </rss>';

        $arquivo = fopen('public/pdo1.xml', 'w+');
        fwrite($arquivo, $xml);
        fclose($arquivo);

        $stmt = $conn->prepare('insert into marca (nome_marca) VALUES(:nome_marca)');
        $stmt->execute(array(
            ':nome_marca' => 'Marca Aleatoria'
        ));
    }
    catch(PDOException $e) {
        echo "Erro na conexão: " . $e->getMessage();
    }
?>