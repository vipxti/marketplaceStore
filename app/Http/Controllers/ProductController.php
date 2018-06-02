<?php

namespace App\Http\Controllers;

use App\Category;
use App\Color;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Size;

class ProductController extends Controller
{

    public function cadastrarProduto(ProductRequest $request) {

        //dd($request->all());

        if ($request->filled('status') == 'on') {

            $status = 1;

        }
        else
        {

            $status = 0;

        }

        $prod = Product::create([

            'cd_ean' => $request->cd_ean,
            'nm_produto' => $request->nm_produto,
            'ds_produto' => $request->ds_produto,
            'vl_produto' => $request->vl_produto,
            'cd_categoria' => $request->cd_categoria,
            //'cd_cor' => $request->cd_cor,
            //'cd_tamanho' => $request->cd_ean,
            'ds_altura' => $request->ds_altura,
            'ds_largura' => $request->ds_largura,
            'ds_peso' => $request->ds_peso,
            'cd_status_produto' => $status

        ]);

        return redirect()->route('admin.cadProd');


    }

    public function getComboFields() {

        $categorias = Category::all();
        $cores = Color::all();
        $tamanhos = Size::all();

        return view('pages.admin.cadProduto', compact('categorias', 'cores', 'tamanhos'));

    }

}
