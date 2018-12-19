<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Category;
use App\Menu;
use App\MenuItensVitrine;
use App\NavigationMenu;
use App\Product;
use App\ProductVariation;
use App\Wishlist;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller{
    public function showIndexPage(){
        $menus = Menu::get();

        $menuNav =  Menu::all();
        $menuNavegacao = NavigationMenu::all();
        $banner = Banner::all();


        if(count($menuNavegacao) > 0) {
            if ($menuNavegacao[0]->menu_ativo == 1) {
                //Carrega as categorias e subcategorias para serem apresentadas no menu nav
                foreach ($menuNav as $key => $menu) {
                    $categoriaSubCat[$key] = Category::
                    leftJoin('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                        ->leftJoin('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
                        ->leftJoin('menu_categoria', 'menu_categoria.fk_cd_categoria', '=', 'categoria.cd_categoria')
                        ->leftJoin('menu', 'menu.cd_menu', '=', 'menu_categoria.fk_cd_menu')
                        ->select(
                            'categoria.cd_categoria',
                            'categoria.nm_categoria',
                            'sub_categoria.cd_sub_categoria',
                            'sub_categoria.nm_sub_categoria'
                        )
                        ->where('menu.cd_menu', '=', $menu->cd_menu)
                        ->get();
                }
            } else {
                $categoriaSubCat = Category::leftJoin('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                    ->leftJoin('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
                    ->join('ordem_categoria', 'ordem_categoria.fk_cd_categoria', '=', 'categoria.cd_categoria')
                    ->select(
                        'categoria.cd_categoria',
                        'categoria.nm_categoria',
                        'sub_categoria.cd_sub_categoria',
                        'sub_categoria.nm_sub_categoria'
                    )
                    ->orderBy('ordem_categoria.cd_ordem_categoria')
                    ->get();
            }
        }

        $nItensVitrine = MenuItensVitrine::where('menu_itens_vitrine_ativo', '=', 1)->get();
        $todos = Product::join('vitrine', 'vitrine.fk_produto_id', '=', 'produto.cd_produto')
            ->where('vitrine.ativo_vitrine', '=', 1)
            ->count();


        if($nItensVitrine[0]->menu_itens_vitrine == 'Todos'){
            $nItens = $todos;
        }
        else{
            if($todos > $nItensVitrine[0]->menu_itens_vitrine){
                $nItens = $nItensVitrine[0]->menu_itens_vitrine;
            }
            else{
                $nItens = $todos;
            }
        }


        $produtos = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')
            ->join('dimensao', 'dimensao.cd_dimensao', '=', 'sku.cd_dimensao')
            ->join('sku_produto_img', 'sku.cd_sku', 'sku_produto_img.cd_sku')
            ->join('img_produto', 'sku_produto_img.cd_img', 'img_produto.cd_img')
            ->join('vitrine', 'vitrine.fk_produto_id', '=', 'produto.cd_produto')
            ->where('vitrine.ativo_vitrine', '=', 1)
            ->where('img_produto.ic_img_principal', '=', 1)
            ->orderBy('produto.cd_produto', 'DESC'); //Por que 20? Pq o Felipe quiz


        if (count($produtos->get()->toArray()) > 1) {
            $produtos = $produtos->get()->random($nItens);
        } else {
            $produtos = $produtos->get();
        }

        $arrayVariation = [];
        $arrayWish = [];
        foreach ($produtos as $key => $produto){
            $variation = ProductVariation::join('sku', 'sku.cd_sku', '=', 'produto_variacao.cd_sku')
                        ->join('produto', 'produto.cd_produto', '=', 'produto_variacao.cd_produto')
                        ->where('produto.cd_produto', '=', $produto->cd_produto)
                        ->get();

            $wish = Wishlist::join('sku', 'wishlist.fk_id_sku', '=', 'sku.cd_sku')
                ->join('produto', 'sku.cd_sku', '=', 'produto.cd_sku')
                ->where('produto.cd_produto', '=', $produto->cd_produto)
                ->get();

            if(count($variation) > 0){
                $arrayVariation[$key] = $variation[0];
            }

            if(count($wish) > 0) {
                $arrayWish[$key] = $wish[0];
            }
        }

        //dd($arrayVariation[15]);
        
        if (!Session::has('qtCart')) {
            Session::put('qtCart', 0);
        }

        if (Auth::check()) {
            $n = explode(' ', Auth::user()->nm_cliente);
            $nome = $n[0];
        } else {
            $nome = null;
        }
        //dd($produtos);
        return view('pages.app.index', compact('produtos', 'imagemPrincipal', 'qtdCarrinho', 'nome',
            'categoriaSubCat', 'menuNav', 'menuNavegacao', 'arrayVariation', 'banner', 'arrayWish'));
    }

    public function showIndexAdminPage()
    {
        $produtos = Product::where('cd_status_produto', '=', 1)->limit(3)->get();
        $countProduct = Product::where('cd_status_produto', '=', 1)->count();

        $imagemPrincipal = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')
            ->join('sku_produto_img', 'sku.cd_sku', '=', 'sku_produto_img.cd_sku')
            ->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
            ->select('img_produto.im_produto')
            ->where('img_produto.ic_img_principal', '=', 1)
            ->orderBy('sku_produto_img.cd_img')
            ->get();

        return view('pages.admin.index', compact('countProduct', 'produtos', 'imagemPrincipal'));
    }
}
