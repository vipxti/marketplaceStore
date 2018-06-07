<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function showIndexPage()
    {
        $produtos = Product::where('cd_status_produto', '=', 1);
        $prodPaginate = $produtos->paginate(6);

        $imagemProduto = Product::join('produto_sku', 'produto.cd_produto', '=', 'produto_sku.cd_produto')
                            ->join('sku_produto_img', 'produto_sku.cd_sku', '=', 'sku_produto_img.cd_sku')
                            ->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
                            ->select('sku_produto_img.cd_sku','img_produto.im_produto')
                            ->where('produto.cd_status_produto', '=', 1)
                            ->where('sku_produto_img.cd_sku', '=', 2)
                            ->first();

        //dd($imagemProduto->all());

        //$primeiraImagem = $imagemProduto->where($imagemProduto->cd_sku, '=', 2)->first();

        //dd($primeiraImagem);

        return view('pages.app.index', compact('prodPaginate', 'imagemProduto'));
    }

    public function showIndexAdminPage()
    {
        $produtos = Product::all();

        return view('pages.admin.index', compact('produtos'));
    }
}
