<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showHotPostPage() {

        return view('pages.admin.indexHotpost');

    }

    public function showBannerPage() {

        return view('pages.admin.indexBanner');

    }

    public function showConfigProductPage() {

        return view('pages.admin.indexConfigproduto');

    }

    public function showCart($cd_produto) {

        $produto = Product::join('sku', 'produto.cd_sku', 'sku.cd_sku')->join('dimensao', 'dimensao.cd_dimensao', 'sku.cd_dimensao')->where('produto.cd_produto', '=', $cd_produto)->get();

//        $produto = Product::join('sku', 'produto.cd_sku', 'sku.cd_sku')->where('produto.cd_produto', '=', $cd_produto)->get();

        $imagem = Product::join('sku', 'produto.cd_sku', 'sku.cd_sku')->join('sku_produto_img', 'sku_produto_img.cd_sku', 'sku.cd_sku')->join('img_produto', 'sku_produto_img.cd_img', 'img_produto.cd_img')->where('produto.cd_produto', '=', $cd_produto)->get();

        //dd($produto);

        return view('pages.app.carrinho', compact('produto','imagem'));

    }

    public function showCheckout() {

        return view('pages.app.checkout');

    }

    public function showEndereco() {

        return view('pages.app.endereco');

    }

    public function showCartao() {

        return view('pages.app.cartao');

    }

    public function showBoleto() {

        return view('pages.app.boletoPageController');

    }
}
