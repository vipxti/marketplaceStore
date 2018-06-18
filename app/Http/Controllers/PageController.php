<?php

namespace App\Http\Controllers;

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

    public function showCart() {

        return view('pages.app.carrinho');

    }

    public function showCheckout() {

        return view('pages.app.checkout');

    }
}
