<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function showIndexPage()
    {
        $produtos = Product::where('cd_status_produto', '=', 1)->limit(6)->get();

        //dd($produtos);

        $imagemPrincipal = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')
                            ->join('sku_produto_img', 'sku.cd_sku', '=', 'sku_produto_img.cd_sku')
                            ->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
                            ->select('img_produto.im_produto')
                            ->where('img_produto.ic_img_principal', '=', 1)
                            ->orderBy('sku_produto_img.cd_img')
                            ->get();

        return view('pages.app.index', compact('produtos', 'imagemPrincipal'));
    }

    public function showIndexAdminPage()
    {
        $produtos = Product::all();

        return view('pages.admin.index', compact('produtos'));
    }
}
