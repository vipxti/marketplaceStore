<?php

namespace App\Http\Controllers;

use App\Category;
use App\Color;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Size;
use Illuminate\Support\Facades\DB;
use Image;
use App\Image as Img;

class ProductController extends Controller
{

    public function cadastrarProduto(ProductRequest $request) {

        //dd($request->all());

//        if ($request->filled('status') == 'on') {
//
//            $status = 1;
//
//        }
//        else
//        {
//
//            $status = 0;
//
//        }
//
//        $images = $request->images;
//
//        if ($request->hasFile('images')) {
//
//            foreach ($images as $key => $image) {
//
//                $ext = $image->getClientOriginalExtension();
//                $imageName = $request->cd_ean . '_' . ($key + 1) . '.' . $ext;
//
//                $realPath = $image->getRealPath();
//
//                $this->saveImageFile($imageName, $realPath);
//
//                $localImagesPath[$key] = public_path('img/products/') . $imageName;
//
//            }
//
//        }
//
//        $prod = Product::create([
//
//            'cd_ean' => $request->cd_ean,
//            'nm_produto' => $request->nm_produto,
//            'ds_produto' => $request->ds_produto,
//            'vl_produto' => $request->vl_produto,
//            'cd_categoria' => $request->cd_categoria,
//            //'cd_cor' => $request->cd_cor,
//            //'cd_tamanho' => $request->cd_ean,
//            'ds_altura' => $request->ds_altura,
//            'ds_largura' => $request->ds_largura,
//            'ds_peso' => $request->ds_peso,
//            'cd_status_produto' => $status
//
//        ]);
//
//        $cdProd = Product::all()->orderBy('cd_produto', 'DESC')->first();

        $category = Category::findOrFail($request->cd_categoria);
        $color = Color::findOrFail($request->cd_cor);

        $sku = $this->generateSKU($request->cd_ean, $category->nm_categoria, $color->nm_cor, $request->vl_produto);

        dd($sku);

//        foreach ($localImagesPath as $key => $dbImage) {
//
//            Img::create([
//                'im_produto' => $dbImage
//            ]);
//
//            $cdImgs[$key] = Img::all()->orderBy('cd_img', DESC)->first();
//
//        }



//        foreach ($cdImgs as cdImg) {
//
//            DB::insert('');
//
//        }

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

    public function generateSKU($ean, $cat, $color, $price) {

        $sku1 = strtoupper(mb_substr($ean, -4));
        $sku2 = strtoupper(mb_substr($cat, 0, 3));
        $sku3 = strtoupper(mb_substr($color, 0, 3));
        $sku4 = str_replace('.','', $price);

        return $sku1.$sku2.$sku3.$sku4;

    }

}
