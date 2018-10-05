<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class GoogleShopController extends Controller
{
    public function index(){
        return view('pages.admin.products.integration.googleShop.googleShopIndex');
    }

    public function indexXml(){
        $produtos = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')
                    ->join('produto_categoria_subcat', 'produto.cd_produto', '=', 'produto_categoria_subcat.cd_produto')
                    ->join('categoria_subcat', 'produto_categoria_subcat.cd_categoria_subcat', '=', 'categoria_subcat.cd_categoria_subcat')
                    ->join('categoria', 'categoria_subcat.cd_categoria', '=', 'categoria.cd_categoria')
                    ->join('sub_categoria', 'categoria_subcat.cd_sub_categoria', '=', 'sub_categoria.cd_sub_categoria')
                    ->join('sku_produto_img', 'sku.cd_sku', '=', 'sku_produto_img.cd_sku')
                    ->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
                    ->where('produto.cd_status_produto', '=', 1)
                    ->where('img_produto.ic_img_principal', '=', 1)
                    ->where('produto.nm_marca', '<>', null)
                    ->get();

        $xml = '<?xml version="1.0" encoding="utf-8"?>';
        $xml .= '<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">';
        $xml .= '<channel>';
        $xml .= '<title>Maktub Beauty</title>';
        $xml .= '<link>https://www.maktubbeauty.com.br</link>';
        $xml .= '<description>Teste</description>';

        foreach($produtos as $p){
            $xml .= '<item>
                <g:id>'. $p->cd_nr_sku .'</g:id>
                <g:title>'. $p->nm_produto .'</g:title>
                <g:description>'. $p->ds_produto .'</g:description>
                <g:link>https://www.maktubbeauty.com.br/page/product/'. $p->nm_slug.'</g:link>
                <g:image_link>http://maktubbeauty.com.br/img/products/'. $p->im_produto .'</g:image_link>
                <g:condition>new</g:condition>
                <g:price>R$'. $p->vl_produto .'</g:price>';

                if($p->qt_produto > 5)
                    $xml .= '<g:availability>in stock</g:availability>';
                else
                    $xml .= '<g:availability>preorder</g:availability>';

                $xml .= '<g:shipping>
                            <g:country>BR</g:country>
                            <g:service>Standard</g:service>
                        </g:shipping>
                        <g:gtin>'. $p->cd_ean .'</g:gtin>
                        <g:brand>'.$p->nm_marca .'</g:brand>
                        <g:google_product_category>'. $p->nm_categoria . ' > ' . $p->nm_sub_categoria . '</g:google_product_category>
                    </item>';
        }

        $xml .= '</channel>
                </rss>';

        $arquivo = fopen('produtos.xml', 'w+');
        fwrite($arquivo, $xml);
        fclose($arquivo);

//        return response()->view('pages.admin.products.integration.googleShop.xmlPage', compact('produtos'))
//            ->header('Content-Type', 'text/xml');
        return response(file_get_contents('produtos.xml'), 200, [
            'Content-Type' => 'application/xml'
        ]);
    }

    public function gerarXML(){
        #versao do encoding xml
        $dom = new \DOMDocument("1.0", "ISO-8859-1");

        #retirar os espacos em branco
        $dom->preserveWhiteSpace = false;

        #gerar o codigo
        $dom->formatOutput = true;

        #criando o nó principal (root)
        $root = $dom->createElement("agenda");

        #nó filho (contato)
        $contato = $dom->createElement("contato");

        #setanto nomes e atributos dos elementos xml (nós)
        $nome = $dom->createElement("nome", "Rafael Clares");
        $telefone = $dom->createElement("telefone", "(11) 5500-0055");
        $endereco = $dom->createElement("endereco", "Av. longa n 1");

        #adiciona os nós (informacaoes do contato) em contato
        $contato->appendChild($nome);
        $contato->appendChild($telefone);
        $contato->appendChild($endereco);

        #adiciona o nó contato em (root) agenda
        $root->appendChild($contato);
        $dom->appendChild($root);

        # Para salvar o arquivo, descomente a linha
        //$dom->save("contatos.xml");

        #cabeçalho da página
        //header("Content-Type: text/xml");
        # imprime o xml na tela
        //print $dom->saveXML();
        //dd($dom->saveXML());
        //return Response::make($dom, '200')->header('Content-Type', 'text/xml');
    }
}
