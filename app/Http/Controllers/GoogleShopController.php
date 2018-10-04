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

        return response()->view('pages.admin.products.integration.googleShop.xmlPage', compact('produtos'))
            ->header('Content-Type', 'text/xml');
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
