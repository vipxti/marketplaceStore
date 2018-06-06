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

    public function paginaProduto() {

        return view('pages.app.produto');

    }
    public function listaProduto() {

        $produtos = Product::all();

        return view('pages.admin.listProd', compact('produtos'));

    }


    public function cadastrarProduto(ProductRequest $request) {

        //dd($request->all());

        if ($request->filled('status') == 'on') {

            $status = 1;

        }
        else
        {

            $status = 0;

        }

        //Procura no banco a categoria e subcategoria baseado no id
        $category = Category::findOrFail($request->cd_categoria);
        $subcategory = DB::table('categoria')
            ->join('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
            ->join('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
            ->select('sub_categoria.nm_sub_categoria')->where('categoria_subcat.cd_sub_categoria', '=', $request->cd_subcategoria)
            ->first();

        //Seleciona o id correspondente dos forms categoria e subcategoria na tabela categoria_subcat
        $prod_cat_subcat = DB::table('categoria_subcat')
                            ->select('cd_categoria_subcat')
                            ->where('cd_categoria', '=', $request->cd_categoria)
                            ->where('cd_sub_categoria', '=', $request->cd_subcategoria)
                            ->first();

        //Salva o produto no banco
        Product::create([

            'cd_ean' => $request->cd_ean,
            'nm_produto' => $request->nm_produto,
            'ds_produto' => $request->ds_produto,
            'vl_produto' => $request->vl_produto,
            'cd_status_produto' => $status

        ]);

        //Pega o último id do produto cadastrado
        $produto = Product::orderBy('cd_produto', 'DESC')->first();

        //Insere os ids do produto e id da tabela de ligação de categoria/subcategoria
        DB::table('produto_categoria_subcat')->insert([
            'cd_produto' => $produto->cd_produto,
            'cd_categoria_subcat' => $prod_cat_subcat->cd_categoria_subcat
        ]);

        //Cria o caminho físico das imagens
        $images = $request->images;
        $imagePath = $this->pastaProduto($category->nm_categoria, $subcategory->nm_sub_categoria);

        //Salva fisicamente a imagem e seta o caminho para ser salvo no banco
        if ($request->hasFile('images')) {

            foreach ($images as $key => $image) {

                $ext = $image->getClientOriginalExtension();
                $imageName = $request->cd_ean . '_' . ($key + 1) . '.' . $ext;

                $realPath = $image->getRealPath();

                $this->saveImageFile($imagePath, $imageName, $realPath);

                $localImagesPath[$key] = $imagePath . '/' . $imageName;

            }

        }

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

    public function saveImageFile($imagePath, $imageName, $realPath) {

        Image::make($realPath)->save($imagePath . '/' . $imageName);

    }

    public function pastaProduto($categoria, $subcategoria) {

        $rootProductsPath = public_path('img/products/');

        if (!file_exists($rootProductsPath . $categoria)) {

            mkdir($rootProductsPath . $categoria, 0775, true);
            $p1 = $rootProductsPath . $categoria;

        }
        else
        {

            $p1 = $rootProductsPath . $categoria;

        }

        if (!file_exists($p1 . '/' . $subcategoria)) {

            mkdir($p1 . '/' . $subcategoria, 0775, true);
            $path = $p1 . '/' . $subcategoria;

        }
        else {

            $path = $p1 . '/' . $subcategoria;

        }

        return $path;

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
