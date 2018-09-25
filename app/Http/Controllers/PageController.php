<?php

namespace App\Http\Controllers;

use App\Client;
use App\MenuItensVitrine;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $produtos = DB::table('produto')->paginate(15);
        $nItensVitrine = MenuItensVitrine::all();
        return view('pages.admin.vitrineMenu',compact('nItensVitrine', 'produtos') );
    }
    public function updateItensVitrine(Request $request){

        MenuItensVitrine::where('menu_itens_vitrine_ativo', '=', 1)->update(array('menu_itens_vitrine_ativo' => 0));
        MenuItensVitrine::where('id_menu_itens_vitrine', '=',$request->nItens)->update(array('menu_itens_vitrine_ativo' => 1));
        return $this->showVitrinePage();
    }

    public function produtosVitrine(){
        $produtos = Product::paginate(15);;;

        return response()->json([
            'produtos' => $produtos,
        ]);
    }
}
