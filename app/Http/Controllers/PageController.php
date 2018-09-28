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
        $produtos = DB::table('produto')->leftJoin('vitrine', 'produto.cd_produto', '=', 'vitrine.fk_produto_id')
            ->where('produto.cd_status_produto', '=', 1)
            ->paginate(15);
        $nItensVitrine = MenuItensVitrine::all();
        return view('pages.admin.vitrineMenu',compact('nItensVitrine', 'produtos') );
    }

    public function updateQtdItensVitrine(Request $request){
        $itenVitriniAtivo = DB::table('vitrine')->where('ativo_vitrine', '=', 1)->count();
        $qtItenVitriniAtivo = DB::table('menu_itens_vitrine')->where('id_menu_itens_vitrine', '=', $request->nItens)->get();
        if($itenVitriniAtivo > 0){
            $menuItensVitrine = MenuItensVitrine::all();
            if (($itenVitriniAtivo < $qtItenVitriniAtivo[0]->menu_itens_vitrine)or ($itenVitriniAtivo < $request->nItens)){
                foreach ($menuItensVitrine as $key =>$value){
                    if($itenVitriniAtivo >= $value->menu_itens_vitrine){
                        $aDados = $value->id_menu_itens_vitrine;
                    }
                }
                MenuItensVitrine::where('menu_itens_vitrine_ativo', '=', 1)->update(array('menu_itens_vitrine_ativo' => 0));
                MenuItensVitrine::where('id_menu_itens_vitrine', '=',$aDados)->update(array('menu_itens_vitrine_ativo' => 1));
                return redirect()->route('vitrine.page')->with('nosuccess', 'Quantidade de Produtos Ativos é MENOR que Quantidade de Linhas Informada');
            }
            else{
                MenuItensVitrine::where('menu_itens_vitrine_ativo', '=', 1)->update(array('menu_itens_vitrine_ativo' => 0));
                MenuItensVitrine::where('id_menu_itens_vitrine', '=',$request->nItens)->update(array('menu_itens_vitrine_ativo' => 1));
                return redirect()->route('vitrine.page')->with('warning', 'Quantidade de Produtos Ativos é MENOR que Quantidade de Linhas Informada');
            }
        }
        else{return redirect()->route('vitrine.page')->with('nosuccess', 'Não existe produto ativo');}
    }

    public function insertOrUpdateProdVitrine(Request $request){
        $todosProd = $request->codProd;
        if( !isset($request->bntForm) ){

            for ($i = 0; $i < count($todosProd); $i++){
                DB::table('vitrine')
                    ->where('fk_produto_id', '=', $request->codProd[$i])
                    ->update(['ativo_vitrine' => 0]);
            }
            //return redirect()->route('vitrine.page')->with('success', 'Vitrine Atualizada com Sucesso');
        }
        else{
            for ($i = 0; $i < count($request->bntForm); $i++) {
                list($status, $idProd[])= explode(",", $request->bntForm[$i]);
                $dadosDB = DB::table('vitrine')->where('fk_produto_id','=', $idProd[$i])->count();

                if($dadosDB == 1){//Atualiza Status

                    if(in_array($idProd[$i], $todosProd)){
                        $valor = array_search($idProd[$i], $todosProd);
                        unset($todosProd[$valor]);
                    }

                    DB::table('vitrine')
                        ->where('fk_produto_id', $idProd[$i])
                        ->update(['ativo_vitrine' => $status]);
                    //return redirect()->route('vitrine.page')->with('success', 'Vitrine Atualizada com Sucesso');
                }
                else{//cadastrar
                    DB::table('vitrine')->insert([
                        'fk_produto_id' => $idProd[$i],
                        'ativo_vitrine' => $status
                    ]);

                    if(in_array($idProd[$i], $todosProd)){
                        $valor = array_search($idProd[$i], $todosProd);
                        unset($todosProd[$valor]);
                    }
                }
            }

            foreach ($todosProd as $key => $values){
                try {
                    DB::table('vitrine')
                        ->where('fk_produto_id', $values)
                        ->update(['ativo_vitrine' => 0]);
                }
                catch (\Exception $e){}
            }
        }
        return redirect()->route('vitrine.page')->with('success', 'Vitrine Atualizada com Sucesso');
    }
}
