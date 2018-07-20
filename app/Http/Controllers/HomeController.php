<?php

namespace App\Http\Controllers;

use App\Category;
use App\Menu;
use App\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function showIndexPage()
    {
        $menus = Menu::get();

        $menuNav =  Menu::all();

        //Carrega as categorias e subcategorias para serem apresentadas no menu nav
        foreach ($menuNav as $key=>$menu) {
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

        $produtos = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')->join('dimensao', 'dimensao.cd_dimensao', '=', 'sku.cd_dimensao')->join('sku_produto_img', 'sku.cd_sku', 'sku_produto_img.cd_sku')->join('img_produto', 'sku_produto_img.cd_img', 'img_produto.cd_img')->where('produto.cd_status_produto', '=', 1)->where('img_produto.ic_img_principal', '=', 1)->orderBy('produto.cd_produto', 'DESC')->limit(12);

        $produtos = $produtos->get()->random(6);
        
        if (!Session::has('qtCart')) {
            Session::put('qtCart', 0);
        }

        if (Auth::check()) {
            $n = explode(' ', Auth::user()->nm_cliente);
            $nome = $n[0];
        } else {
            $nome = null;
        }

        return view('pages.app.index', compact('produtos', 'imagemPrincipal', 'qtdCarrinho', 'nome', 'categoriaSubCat', 'menuNav'));
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
