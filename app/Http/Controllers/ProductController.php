<?php

namespace App\Http\Controllers;

use App\Category;
use App\Color;
use App\Http\Requests\ProductModalRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductVariationRequest;
use App\LetterSize;
use App\Package;
use App\Product;
use App\NumberSize;
use App\ProductVariation;
use Illuminate\Support\Facades\DB;
use Image;
use App\Image as Img;
use Mockery\Exception;

class ProductController extends Controller
{

    public function paginaProduto()
    {

        $produtos = Product::where('cd_status_produto', '=', 1)->paginate(6);

        $imagemPrincipal = Product::join('produto_sku', 'produto.cd_produto', '=', 'produto_sku.cd_produto')
            ->join('sku_produto_img', 'produto_sku.cd_sku', '=', 'sku_produto_img.cd_sku')
            ->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
            ->select('img_produto.im_produto')
            ->where('img_produto.ic_img_principal', '=', 1)
            ->orderBy('sku_produto_img.cd_img')
            ->get();

        return view('pages.app.produto', compact('produtos', 'imagemPrincipal'));

    }

    public function listaProduto() {

        $produtos = Product::where('cd_status_produto', '=', 1)->paginate(6);
        $tamanhosLetras = LetterSize::all();
        $tamanhosNumeros = NumberSize::all();
        $cores = Color::all();

        //dd($produtos);

        return view('pages.admin.listProd', compact('produtos', 'tamanhosLetras', 'tamanhosNumeros', 'cores'));

    }

    public function cadastrarProduto(ProductRequest $request)
    {

        //dd($request->all());

        if ($request->filled('status') == 'on') {

            $status = 1;

        } else {

            $status = 0;

        }

        //Procura no banco a categoria e subcategoria baseado no id
        $category = Category::findOrFail($request->cd_categoria);
        $subcategory = DB::table('categoria')
            ->join('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
            ->join('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
            ->select('sub_categoria.nm_sub_categoria')->where('categoria_subcat.cd_sub_categoria', '=', $request->cd_sub_categoria)
            ->first();

        //Seleciona o id correspondente dos forms categoria e subcategoria na tabela categoria_subcat
        $prod_cat_subcat = DB::table('categoria_subcat')
            ->select('cd_categoria_subcat')
            ->where('cd_categoria', '=', $request->cd_categoria)
            ->where('cd_sub_categoria', '=', $request->cd_sub_categoria)
            ->first();


        //Tenta cadastrar o produto no banco e captura o erro caso ocorra
        try {

            //Salva o produto no banco
            Product::create([
                'cd_ean' => $request->cd_ean,
                'nm_produto' => $request->nm_produto,
                'ds_produto' => $request->ds_produto,
                'vl_produto' => $request->vl_produto,
                'qt_produto' => $request->qt_produto,
                'cd_status_produto' => $status
            ]);

        }
        catch (\Exception $e) {

            //dd($e->getMessage());
            return redirect()->route('admin.cadProd')->with('nosuccess', 'Houve um problema ao cadastrar o produto');

        }
        finally {

            //Pega o último id do produto cadastrado
            $produto = Product::orderBy('cd_produto', 'DESC')->first();

        }

        try {

            //Insere os ids do produto e id da tabela de ligação de categoria/subcategoria
            DB::table('produto_categoria_subcat')->insert([
                'cd_produto' => $produto->cd_produto,
                'cd_categoria_subcat' => $prod_cat_subcat->cd_categoria_subcat
            ]);

        }
        catch (\Exception $e){

            //dd($e->getMessage());
            Product::destroy($produto->cd_produto);
            return redirect()->route('admin.cadProd')->with('nosuccess', 'Houve um problema ao cadastrar o produto');

        }

        try {

            //Salva na tabela de ligação Produto/SKU
            DB::table('produto_sku')->insert([
                'cd_nr_sku' => $request->cd_sku,
                'cd_produto' => $produto->cd_produto
            ]);

        }
        catch (\Exception $e) {

            DB::table('produto_categoria_subcat')->where('cd_produto', '=', $produto->cd_produto)->delete();
            Product::destroy($produto->cd_produto);

            return redirect()->route('admin.cadProd')->with('nosuccess', 'Houve um problema ao cadastrar o produto');

        }
        finally {

            $SKU = DB::table('produto_sku')->select('cd_sku')->orderBy('cd_sku', 'DESC')->first();

        }

        try {

            DB::table('sku_produto_embalagem')->insert([
                'cd_sku' => $SKU->cd_sku,
                'cd_embalagem' => $request->cd_embalagem
            ]);

        }
        catch (\Exception $e) {

            DB::table('produto_sku')->where('cd_sku', '=', $SKU->cd_sku)->delete();
            DB::table('produto_categoria_subcat')->where('cd_produto', '=', $produto->cd_produto)->delete();
            Product::destroy($produto->cd_produto);

            return redirect()->route('admin.cadProd')->with('nosuccess', 'Houve um problema ao cadastrar o produto');

        }

        //Cria o caminho físico das imagens
        $images = $request->images;
        $imagePath = $this->pastaProduto($category->nm_categoria, $subcategory->nm_sub_categoria);
        $dbPath = $category->nm_categoria . '/' . $subcategory->nm_sub_categoria;

        //Salva fisicamente a imagem e seta o caminho para ser salvo no banco
        if ($request->hasFile('images')) {

            foreach ($images as $key => $image) {

                $ext = $image->getClientOriginalExtension();
                $imageName = $request->cd_ean . '_' . ($key + 1) . '.' . $ext;

                $realPath = $image->getRealPath();

                $this->saveImageFile($imagePath, $imageName, $realPath);

                $localImagesPath[$key] = $dbPath . '/' . $imageName;

            }

        }

        $imgsId = [];
        $cont = 0;

        foreach ($localImagesPath as $key => $dbImage) {

            try {

                if ($key == 0) {

                    Img::create([
                        'im_produto' => $dbImage,
                        'ic_img_principal' => 1
                    ]);

                }
                else
                {

                    Img::create([
                        'im_produto' => $dbImage,
                        'ic_img_principal' => 0
                    ]);

                }

            }
            catch (Exception $e) {

                if ($cont > 0) {

                    foreach ($cont as $c) {

                        Img::destroy($imgsId[$c]);

                    }

                }

                DB::table('sku_produto_embalagem')->where('cd_sku', '=', $SKU->cd_sku)->delete();
                DB::table('produto_sku')->where('cd_nr_sku', '=', $request->cd_sku)->delete();
                DB::table('produto_categoria_subcat')->where('cd_produto', '=', $produto->cd_produto)->delete();
                Product::destroy($produto->cd_produto);

                return redirect()->route('admin.cadProd')->with('nosuccess', 'Houve um problema ao cadastrar o produto');

            }
            finally {

                $imgs[$key] = Img::orderBy('cd_img', 'DESC')->first();
                $imgsId[$key] = $imgs[$key]->cd_img;
                $cont += 1;

            }

        }

        $imgsId = [];
        $cont = 0;

        foreach ($imgs as $key => $img) {

            try {

                DB::table('sku_produto_img')->insert([
                    'cd_sku' => $SKU->cd_sku,
                    'cd_img' => $img->cd_img
                ]);

            } catch (Exception $e) {

                if ($cont > 0) {

                    foreach ($cont as $c) {

                        Img::destroy($imgsId[$c]);
                        DB::table('sku_produto_img')->where('cd_img', '=', $imgsId[$c])->delete();

                    }

                }

                DB::table('sku_produto_embalagem')->where('cd_sku', '=', $SKU->cd_sku)->delete();
                DB::table('produto_sku')->where('cd_nr_sku', '=', $request->cd_sku)->delete();
                DB::table('produto_categoria_subcat')->where('cd_produto', '=', $produto->cd_produto)->delete();
                Product::destroy($produto->cd_produto);

                return redirect()->route('admin.cadProd')->with('nosuccess', 'Houve um problema ao cadastrar o produto');

            }
            finally {

                $imgsId[$key] = $imgs[$key]->cd_img;
                $cont += 1;

            }

        }

        return redirect()->route('admin.listProd')->with('success', 'Produto principal cadastrado com sucesso');

    }

    //Cadastrar variação do produto
    public function cadastrarVariacaoProduto(ProductVariationRequest $request)
    {

        //dd($request->all());

        if ($request->filled('status_variacao') == 'on') {

            $status = 1;

        } else {

            $status = 0;

        }

        //Procura no banco a categoria e subcategoria baseado no id
        $category = Category::findOrFail($request->cd_categoria_variacao);
        $subcategory = DB::table('categoria')
            ->join('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
            ->join('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
            ->select('sub_categoria.nm_sub_categoria')->where('categoria_subcat.cd_sub_categoria', '=', $request->cd_sub_categoria_variacao)
            ->first();

//        //Seleciona o id correspondente dos forms categoria e subcategoria na tabela categoria_subcat
//        $prod_cat_subcat = DB::table('categoria_subcat')
//            ->select('cd_categoria_subcat')
//            ->where('cd_categoria', '=', $request->cd_categoria_variacao)
//            ->where('cd_sub_categoria', '=', $request->cd_subcategoria_variacao)
//            ->first();

        //Tenta cadastrar o produto no banco e captura o erro caso ocorra
        try {

            //Salva o produto no banco
            ProductVariation::create([

                'cd_ean_variacao' => $request->cd_ean_variacao,
                'nm_produto_variacao' => $request->nm_produto_variacao,
                'ds_produto_variacao' => $request->ds_produto_variacao,
                'vl_produto_variacao' => $request->vl_produto_variacao,
                'cd_status_produto_variacao' => $status,
                'qt_produto_variacao' => $request->qt_produto_variacao,
                'cd_produto_principal' => $request->cd_produto_principal

            ]);

        }
        catch (\Exception $e) {

            //dd($e->getMessage());
            return redirect()->route('admin.cadProd')->with('nosuccess', 'Houve um problema ao cadastrar o produto');

        }
        finally {

            //Pega o último id do produto cadastrado
            $produtoVariacao = ProductVariation::orderBy('cd_produto', 'DESC')->first();

        }

//        //Insere os ids do produto e id da tabela de ligação de categoria/subcategoria
//        DB::table('produto_categoria_subcat')->insert([
//            'cd_produto' => $produto->cd_produto,
//            'cd_categoria_subcat' => $prod_cat_subcat->cd_categoria_subcat
//        ]);

        try {

            //Salva na tabela de ligação Produto/SKU
            DB::table('produto_sku')->insert([
                'cd_nr_sku' => $request->cd_sku_variacao,
                'cd_produto' => $produtoVariacao->cd_produto
            ]);

        }
        catch (\Exception $e) {

            DB::table('produto_categoria_subcat')->where('cd_produto', '=', $produtoVariacao->cd_produto)->delete();
            ProductVariation::destroy($produtoVariacao->cd_produto);

            return redirect()->route('admin.cadProd')->with('nosuccess', 'Houve um problema ao cadastrar o produto');

        }
        finally {

            $SKU = DB::table('produto_sku')->select('cd_sku')->orderBy('cd_sku', 'DESC')->first();

        }

        try {

            DB::table('produto_sku_variacao')->insert([
                'cd_produto_sku_variacao' => $request->cd_sku_variacao,
                'cd_produto' => $request->cd_produto_principal,
                'cd_sku' => $SKU->cd_sku
            ]);

        }
        catch (\Exception $e) {

            DB::table('produto_sku')->where('cd_produto', '=', $produtoVariacao->cd_produto)->delete();
            DB::table('produto_categoria_subcat')->where('cd_produto', '=', $produtoVariacao->cd_produto)->delete();
            ProductVariation::destroy($produtoVariacao->cd_produto);

            return redirect()->route('admin.cadProd')->with('nosuccess', 'Houve um problema ao cadastrar o produto');

        }

        try {

            DB::table('sku_produto_embalagem')->insert([
                'cd_sku' => $SKU->cd_sku,
                'cd_embalagem' => $request->cd_embalagem
            ]);

        }
        catch (\Exception $e) {

            DB::table('produto_sku')->where('cd_sku', '=', $SKU->cd_sku)->delete();
            DB::table('produto_categoria_subcat')->where('cd_produto', '=', $produtoVariacao->cd_produto)->delete();
            Product::destroy($produtoVariacao->cd_produto);

            return redirect()->route('admin.cadProd')->with('nosuccess', 'Houve um problema ao cadastrar o produto');

        }

        try {

            DB::table('produto_cor')->insert([
                'cd_sku' => $SKU->cd_sku,
                'cd_cor' => $request->cd_cor_variacao
            ]);

        }
        catch (\Exception $e) {

            DB::table('sku_produto_embalagem')->where('cd_sku', '=', $SKU->cd_sku)->delete();
            DB::table('produto_sku')->where('cd_sku', '=', $SKU->cd_sku)->delete();
            DB::table('produto_categoria_subcat')->where('cd_produto', '=', $produtoVariacao->cd_produto)->delete();
            Product::destroy($produtoVariacao->cd_produto);

            return redirect()->route('admin.cadProd')->with('nosuccess', 'Houve um problema ao cadastrar o produto');

        }

        if ($request->cd_tamanho_letra_variacao == null) {

            try {

                DB::table('produto_tamanho_num')->insert([
                    'cd_sku' => $SKU->cd_sku,
                    'cd_tamanho_num' => $request->cd_tamanho_num_variacao
                ]);

            }
            catch (\Exception $e) {

                DB::table('produto_cor')->where('cd_sku', '=', $SKU->cd_sku)->delete();
                DB::table('sku_produto_embalagem')->where('cd_sku', '=', $SKU->cd_sku)->delete();
                DB::table('produto_sku')->where('cd_sku', '=', $SKU->cd_sku)->delete();
                DB::table('produto_categoria_subcat')->where('cd_produto', '=', $produtoVariacao->cd_produto)->delete();
                Product::destroy($produtoVariacao->cd_produto);

                return redirect()->route('admin.cadProd')->with('nosuccess', 'Houve um problema ao cadastrar o produto');

            }

        }
        else {

            try {

                DB::table('produto_tamanho_letra')->insert([
                    'cd_sku' => $SKU->cd_sku,
                    'cd_tamanho_letra' => $request->cd_tamanho_letra_variacao
                ]);

            }
            catch (\Exception $e) {

                DB::table('produto_cor')->where('cd_sku', '=', $SKU->cd_sku)->delete();
                DB::table('sku_produto_embalagem')->where('cd_sku', '=', $SKU->cd_sku)->delete();
                DB::table('produto_sku')->where('cd_sku', '=', $SKU->cd_sku)->delete();
                DB::table('produto_categoria_subcat')->where('cd_produto', '=', $produtoVariacao->cd_produto)->delete();
                Product::destroy($produtoVariacao->cd_produto);

                return redirect()->route('admin.cadProd')->with('nosuccess', 'Houve um problema ao cadastrar o produto');

            }

        }

        //Cria o caminho físico das imagens
        $images = $request->images_variacao;
        $imagePath = $this->pastaProduto($category->nm_categoria, $subcategory->nm_sub_categoria);
        $dbPath = $category->nm_categoria . '/' . $subcategory->nm_sub_categoria;

        //Salva fisicamente a imagem e seta o caminho para ser salvo no banco
        if ($request->hasFile('images_variacao')) {

            foreach ($images as $key => $image) {

                $ext = $image->getClientOriginalExtension();
                $imageName = $request->cd_ean_variacao . '_' . ($key + 1) . '.' . $ext;

                $realPath = $image->getRealPath();

                $this->saveImageFile($imagePath, $imageName, $realPath);

                $localImagesPath[$key] = $dbPath . '/' . $imageName;

            }

        }

        $imgsId = [];
        $cont = 0;

        foreach ($localImagesPath as $key => $dbImage) {

            try {

                if ($key == 0) {

                    Img::create([
                        'im_produto' => $dbImage,
                        'ic_img_principal' => 1
                    ]);

                }
                else
                {

                    Img::create([
                        'im_produto' => $dbImage,
                        'ic_img_principal' => 0
                    ]);

                }

            }
            catch (Exception $e) {

                if ($cont > 0) {

                    foreach ($cont as $c) {

                        Img::destroy($imgsId[$c]);

                    }

                }

                DB::table('sku_produto_embalagem')->where('cd_sku', '=', $SKU->cd_sku)->delete();
                DB::table('produto_sku')->where('cd_nr_sku', '=', $request->cd_sku)->delete();
                DB::table('produto_categoria_subcat')->where('cd_produto', '=', $produtoVariacao->cd_produto)->delete();
                Product::destroy($produtoVariacao->cd_produto);

                return redirect()->route('admin.cadProd')->with('nosuccess', 'Houve um problema ao cadastrar o produto');

            }
            finally {

                $imgs[$key] = Img::orderBy('cd_img', 'DESC')->first();
                $imgsId[$key] = $imgs[$key]->cd_img;
                $cont += 1;

            }

        }

        $imgsId = [];
        $cont = 0;

        foreach ($imgs as $key => $img) {

            try {

                DB::table('sku_produto_img')->insert([
                    'cd_sku' => $SKU->cd_sku,
                    'cd_img' => $img->cd_img
                ]);

            } catch (Exception $e) {

                if ($cont > 0) {

                    foreach ($cont as $c) {

                        Img::destroy($imgsId[$c]);
                        DB::table('sku_produto_img')->where('cd_img', '=', $imgsId[$c])->delete();

                    }

                }

                DB::table('sku_produto_embalagem')->where('cd_sku', '=', $SKU->cd_sku)->delete();
                DB::table('produto_sku')->where('cd_nr_sku', '=', $request->cd_sku)->delete();
                DB::table('produto_categoria_subcat')->where('cd_produto', '=', $produtoVariacao->cd_produto)->delete();
                Product::destroy($produtoVariacao->cd_produto);

                return redirect()->route('admin.cadProd')->with('nosuccess', 'Houve um problema ao cadastrar o produto');

            }
            finally {

                $imgsId[$key] = $imgs[$key]->cd_img;
                $cont += 1;

            }

        }

        return redirect()->route('admin.cadProd')->with('success', 'Variação do produto cadastrado com sucesso');

    }

    public function showProductPage() {

        $categorias = Category::all();
        $cores = Color::all();
        $tamanhosLetras = LetterSize::all();
        $tamanhosNumeros = NumberSize::all();
        $embalagens = Package::all();

        return view('pages.admin.cadProduto', compact('categorias', 'cores', 'tamanhosLetras', 'tamanhosNumeros', 'embalagens'));

    }

    public function showProductPageVariation() {

        $categorias = Category::all();
        $cores = Color::all();
        $tamanhosLetras = LetterSize::all();
        $tamanhosNumeros = NumberSize::all();

        $produto = Product::orderBy('cd_produto', 'DESC')->first();

        //dd($produto);

        $ultimoProduto = Product::join('produto_sku', 'produto.cd_produto', '=', 'produto_sku.cd_produto')
            ->join('sku_produto_img', 'produto_sku.cd_sku', '=', 'sku_produto_img.cd_sku')
            ->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
            ->join('sku_produto_embalagem', 'sku_produto_embalagem.cd_sku', '=', 'produto_sku.cd_sku')
            ->join('embalagem', 'embalagem.cd_embalagem', '=', 'sku_produto_embalagem.cd_embalagem')
            ->join('produto_categoria_subcat', 'produto_categoria_subcat.cd_produto', '=', 'produto.cd_produto')
            ->join('categoria_subcat', 'categoria_subcat.cd_categoria_subcat', '=', 'produto_categoria_subcat.cd_categoria_subcat')
            ->where('produto_sku.cd_produto', '=', $produto->cd_produto)
            ->get();

        //dd($ultimoProduto);

        return view('pages.admin.cadProdutoVariacao', compact('categorias', 'cores', 'tamanhosLetras', 'tamanhosNumeros', 'ultimoProduto'));

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
