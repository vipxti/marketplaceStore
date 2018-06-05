<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function showIndexPage()
    {
        $produtos = DB::table('produto')
            ->join('produto_sku', 'produto.cd_produto', '=', 'produto_sku.cd_produto')
            ->join('sku_produto_img', 'produto_sku.cd_nr_sku', '=', 'sku_produto_img.cd_sku')
            ->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
            ->select('img_produto.im_produto')
            ->where('cd_status_produto', '=', 0)
            ->first();


        $produtos = Product::where()->paginate(6);

        dd($produtos);

        return view('pages.app.index', compact('produtos'));
    }

    public function showIndexAdminPage()
    {
        $produtos = Product::all();

        return view('pages.admin.index', compact('produtos'));
    }
}
