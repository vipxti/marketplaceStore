<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function showIndexPage()
    {
        $produtos = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')->join('dimensao', 'dimensao.cd_dimensao', '=', 'sku.cd_dimensao')->where('cd_status_produto', '=', 1)->limit(6)->get();

        //dd($produtos);

        $imagemPrincipal = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')
            ->join('sku_produto_img', 'sku.cd_sku', '=', 'sku_produto_img.cd_sku')
            ->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
            ->select('img_produto.im_produto')
            ->where('img_produto.ic_img_principal', '=', 1)
            ->orderBy('sku_produto_img.cd_img')
            ->get();



        if (!Session::has('qtdCarrinho')) {
            Session::put('qtdCarrinho', 0);
            $qtdCarrinho = 0;
        } else {
            $qtdCarrinho = session('qtdCarrinho');
        }
        
        if (Cookie::get('qtdCarrinho') === null) {
            Cookie::queue('qtdCarrinho', '0', 10);
        }

        return view('pages.app.index', compact('produtos', 'imagemPrincipal', 'qtdCarrinho'));
    }

    public function showIndexAdminPage()
    {
        $produtos = Product::where('cd_status_produto', '=', 1)->limit(3)->get();
        $coutProduct = Product::where('cd_status_produto', '=', 1)->count();

        $imagemPrincipal = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')
            ->join('sku_produto_img', 'sku.cd_sku', '=', 'sku_produto_img.cd_sku')
            ->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
            ->select('img_produto.im_produto')
            ->where('img_produto.ic_img_principal', '=', 1)
            ->orderBy('sku_produto_img.cd_img')
            ->get();

        return view('pages.admin.index', compact('coutProduct', 'produtos', 'imagemPrincipal'));
    }
}
