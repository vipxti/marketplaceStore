<?php

namespace App\Http\Controllers;

use App\Client;
use App\MenuItensVitrine;
use App\Product;
use App\Vitrine;
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
    public function updateQtdItensVitrine(Request $request){

        MenuItensVitrine::where('menu_itens_vitrine_ativo', '=', 1)->update(array('menu_itens_vitrine_ativo' => 0));
        MenuItensVitrine::where('id_menu_itens_vitrine', '=',$request->nItens)->update(array('menu_itens_vitrine_ativo' => 1));
        return $this->showVitrinePage();
    }

    public function updateProdutosVitrine(Request $request){

        //dd($request->all());
        //dd($request->codProd);
        //dd($request->bntForm);

        if(($request->bntPrincipal == 1)){
            //dd(true, $request->all());



            for ($i = 0; $i < count($request->bntForm); $i++) {
                list($status, $idProd)= explode(",", $request->bntForm[$i]);
                DB::table('vitrine')->insert([
                    'fk_produto_id' => $idProd,
                    'ativo_vitrine' => $status
                ]);
            }

        }
        else{
            dd(false, $request->all());

        }

        $produtosVitrine = Vitrine::all();


        return redirect('submitted')->with('status', 'Your answers successfully submitted');
    }
}
