<?php

namespace App\Http\Controllers;

use App\Client;
use App\MenuItensVitrine;
use App\Product;
use Illuminate\Http\Request;
use function PhpParser\filesInDir;

class PageController extends Controller
{
    public function showHotPostPage()
    {
        return view('pages.admin.indexHotpost');
    }

    public function showBannerPage()
    {
        return view('pages.admin.indexBanner');
    }

    public function showCheckout()
    {
        return view('pages.app.checkout');
    }

    public function showEndereco()
    {
        return view('pages.app.endereco');
    }

    public function showCartao()
    {
        return view('pages.app.cartao');
    }

    public function showBoleto()
    {
        return view('pages.app.boletoPageController');
    }

    public function showVitrinePage(){
        $nItensVitrine = MenuItensVitrine::all();
        return view('pages.admin.vitrineMenu',compact('nItensVitrine') );
    }
    public function updateItensVitrine(Request $request){

        MenuItensVitrine::where('menu_itens_vitrine_ativo', '=', 1)->update(array('menu_itens_vitrine_ativo' => 0));
        MenuItensVitrine::where('id_menu_itens_vitrine', '=',$request->nItens)->update(array('menu_itens_vitrine_ativo' => 1));
        return $this->showVitrinePage();
    }
}
