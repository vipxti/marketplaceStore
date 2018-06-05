<?php

namespace App\Http\Controllers;

use App\Category;
use App\Color;
use App\Http\Requests\ProductRequest;
use App\Package;
use App\Product;
use App\Size;
use Illuminate\Support\Facades\DB;
use Image;
use App\Image as Img;

class ProductController extends Controller
{

    public function cadastrarProduto(ProductRequest $request) {

        //dd($request->all());

        $category = Category::findOrFail($request->cd_categoria);

        if ($request->filled('status') == 'on') {

            $status = 1;

        }
        else
        {

            $status = 0;

        }

        $images = $request->images;

        if ($request->hasFile('images')) {

            foreach ($images as $key => $image) {

                $ext = $image->getClientOriginalExtension();
                $imageName = $request->cd_ean . '_' . ($key + 1) . '.' . $ext;

                $realPath = $image->getRealPath();

                $this->saveImageFile($imageName, $realPath);

                $localImagesPath[$key] = public_path('img/products/') . $imageName;

            }

        }

        Product::create([

            'cd_ean' => $request->cd_ean,
            'nm_produto' => $request->nm_produto,
            'ds_produto' => $request->ds_produto,
            'vl_produto' => $request->vl_produto,
            'cd_status_produto' => $status,
            'cd_categoria' => $request->cd_categoria

        ]);

        $produto = Product::orderBy('cd_produto', 'DESC')->first();

        DB::table('produto_sku')->insert([
            'cd_nr_sku' => $request->cd_sku,
            'cd_produto' => $produto->cd_produto
        ]);

        $SKU = DB::table('produto_sku')->select('cd_sku')->orderBy('cd_sku', 'DESC')->first();

        Package::create([
            'ds_largura' => $request->ds_largura,
            'ds_altura' => $request->ds_altura,
            'ds_peso' => $request->ds_peso
        ]);

        $embalagem = Package::orderBy('cd_embalagem', 'DESC')->first();

        DB::table('sku_produto_embalagem')->insert([
            'cd_sku' => $SKU->cd_sku,
            'cd_embalagem' => $embalagem->cd_embalagem
        ]);

        DB::table('produto_cor')->insert([
            'cd_sku' => $SKU->cd_sku,
            'cd_cor' => $request->cd_cor
        ]);

        DB::table('produto_tamanho')->insert([
            'cd_sku' => $SKU->cd_sku,
            'cd_tamanho' => $request->cd_tamanho
        ]);

        foreach ($localImagesPath as $key => $dbImage) {

            Img::create([
                'im_produto' => $dbImage
            ]);

            $imgs[$key] = Img::orderBy('cd_img', 'DESC')->first();

        }

        foreach ($imgs as $img) {

            DB::table('sku_produto_img')->insert([
                'cd_sku' => $SKU->cd_sku,
                'cd_img' => $img->cd_img
            ]);

        }

        return redirect()->route('admin.cadProd');

    }

    public function getComboFields() {

        $categorias = Category::all();
        $cores = Color::all();
        $tamanhos = Size::all();

        return view('pages.admin.cadProduto', compact('categorias', 'cores', 'tamanhos'));

    }

    public function saveImageFile($imagename, $realPath) {

        Image::make($realPath)->save(public_path('img/products/') . $imagename);

    }

//    public function generateSKU($ean, $cat, $color, $price) {
//
//        $sku1 = strtoupper(mb_substr($ean, -4));
//        $sku2 = strtoupper(mb_substr($cat, 0, 3));
//        $sku3 = strtoupper(mb_substr($color, 0, 3));
//        $sku4 = str_replace('.','', $price);
//
//        return $sku1.$sku2.$sku3.$sku4;
//
//    }

}
