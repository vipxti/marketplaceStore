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
        $produtos = DB::table('produto')->leftJoin('vitrine', 'produto.cd_produto', '=', 'vitrine.fk_produto_id')->paginate(15);
        $nItensVitrine = MenuItensVitrine::all();
        return view('pages.admin.vitrineMenu',compact('nItensVitrine', 'produtos') );
    }

    public function updateQtdItensVitrine(Request $request){
        MenuItensVitrine::where('menu_itens_vitrine_ativo', '=', 1)->update(array('menu_itens_vitrine_ativo' => 0));
        MenuItensVitrine::where('id_menu_itens_vitrine', '=',$request->nItens)->update(array('menu_itens_vitrine_ativo' => 1));
        return $this->showVitrinePage();
    }

    public function insertOrUpdateProdVitrine(Request $request){
        //dd($request->all());
        //dd($request->codProd);
        //dd($request->bntForm);



        //dd($request->bntForm);

        if( !isset($request->bntForm) ){
            for ($i = 0; $i < count($request->codProd); $i++){
                echo $request->codProd[$i];
                DB::table('vitrine')
                    ->where('fk_produto_id', '=', $request->codProd[$i])
                    ->update(['ativo_vitrine' => 0]);
            }
            return redirect()->route('vitrine.page')->with('success', 'Vitrine Atualizada com Sucesso');
        }
        else{
            for ($i = 0; $i < count($request->bntForm); $i++) {
                list($status, $idProd)= explode(",", $request->bntForm[$i]);
                $dadosDB = DB::table('vitrine')->where('fk_produto_id','=', $idProd)->count();

                if($dadosDB == 1){//faz nada
                    DB::table('vitrine')
                        ->where('fk_produto_id', $idProd)
                        ->update(['ativo_vitrine' => $status]);
                    return redirect()->route('vitrine.page')->with('success', 'Vitrine Atualizada com Sucesso');
                }
                else{//cadastrar
                    DB::table('vitrine')->insert([
                        'fk_produto_id' => $idProd,
                        'ativo_vitrine' => $status
                    ]);
                    return redirect()->route('vitrine.page')->with('success', 'Produtos inseridos na vitrine com Sucesso');
                }
            }
        }

    }
}
