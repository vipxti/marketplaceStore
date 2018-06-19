<?php

namespace App\Http\Controllers;

use App\Category;
use App\Color;
use App\Dimension;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductVariationRequest;
use App\LetterSize;
use App\Product;
use App\NumberSize;
use App\ProductVariation;
use App\Sku;
use function GuzzleHttp\Psr7\str;
use Illuminate\Support\Facades\DB;
use Image;
use App\Image as Img;

class ProductController extends Controller
{

    public function paginaProduto()
    {

        $produtos = Product::where('cd_status_produto', '=', 1)->paginate(6);

        //$pv = ProductVariation::where('cd_status_produto_variacao', '=', 1)->get();

        $imagemPrincipal = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')
            ->join('sku_produto_img', 'sku.cd_sku', '=', 'sku_produto_img.cd_sku')
            ->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
            ->select('img_produto.im_produto')
            ->where('img_produto.ic_img_principal', '=', 1)
            ->orderBy('sku_produto_img.cd_img')
            ->get();

        $imagemVariacao = ProductVariation::join('sku', 'produto_variacao.cd_sku', '=', 'sku.cd_sku')
            ->join('sku_produto_img', 'sku.cd_sku', '=', 'sku_produto_img.cd_sku')
            ->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
            ->select('img_produto.im_produto')
            ->where('img_produto.ic_img_principal', '=', 1)
            ->orderBy('sku_produto_img.cd_img')
            ->get();

        //$produtos = $p->merge($pv);

        return view('pages.app.produto', compact('produtos', 'imagemPrincipal'));

    }

    public function paginaCadastrocliente(){

        return view('pages.app.cadastrocliente');

    }

    public function paginaLogincliente(){

        return view('pages.app.logincliente');

    }

    public function paginaPainelcliente(){

        return view('pages.app.painelcliente');

    }

    public function paginaAlteraremailcliente(){

        return view('pages.app.alteraremailcliente');

    }

    public function paginaAlterarsenhacliente(){

        return view('pages.app.alterarsenhacliente');

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

        $v = strpos($request->vl_produto, ',');

        if ($v !== false) {

            $val = str_replace(',', '.', $request->vl_produto);

        }

        if ($request->filled('status') == 'on') {

            $status = 1;

        } else {

            $status = 0;

        }

        //Procura no banco a categoria e subcategoria baseado no id
        $category = Category::find($request->cd_categoria);
        $subcategory = Category::join('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')->join('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')->select('sub_categoria.nm_sub_categoria')->where('categoria_subcat.cd_sub_categoria', '=', $request->cd_sub_categoria)->first();

        //Seleciona o id correspondente dos forms categoria e subcategoria na tabela categoria_subcat
        $prod_cat_subcat = DB::table('categoria_subcat')
            ->select('cd_categoria_subcat')
            ->where('cd_categoria', '=', $request->cd_categoria)
            ->where('cd_sub_categoria', '=', $request->cd_sub_categoria)
            ->first();

        try {
            Dimension::create([
                'ds_altura' => $request->ds_altura,
                'ds_largura' => $request->ds_largura,
                'ds_comprimento' => $request->ds_comprimento,
                'ds_peso' => $request->ds_peso
            ]);
        }
        catch (\Exception $e) {

            return redirect()->route('product.register')->with('nosuccess', 'Houve um problema ao cadastrar o produto');

        }
        finally {

            $dimensao = Dimension::orderBy('cd_dimensao', 'DESC')->first();

        }

        //Cadastro do SKU do produto
        try {

            Sku::create([
                'cd_nr_sku' => $request->cd_sku,
                'cd_dimensao' => $dimensao->cd_dimensao
            ]);

        }
        catch (\Exception $e) {

            Dimension::destroy($dimensao->cd_dimensao);
            return redirect()->route('product.register')->with('nosuccess', 'Houve um problema ao cadastrar o produto');

        }
        finally {

            $sku = Sku::select('cd_sku')->orderBy('cd_sku', 'DESC')->first();

        }

        //Tenta cadastrar o produto no banco e captura o erro caso ocorra
        try {

            //Salva o produto no banco
            Product::create([
                'cd_ean' => $request->cd_ean,
                'nm_produto' => $request->nm_produto,
                'ds_produto' => $request->ds_produto,
                'vl_produto' => $val,
                'qt_produto' => $request->qt_produto,
                'cd_status_produto' => $status,
                'cd_sku' => $sku->cd_sku
            ]);

        }
        catch (\Exception $e) {

            Sku::destroy($sku->cd_sku);
            Dimension::destroy($dimensao->cd_dimensao);
            return redirect()->route('product.register')->with('nosuccess', 'Houve um problema ao cadastrar o produto');

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

            Product::destroy($produto->cd_produto);
            Sku::destroy($sku->cd_sku);
            Dimension::destroy($dimensao->cd_dimensao);
            return redirect()->route('product.register')->with('nosuccess', 'Houve um problema ao cadastrar o produto');

        }



        //Salva fisicamente a imagem e seta o caminho para ser salvo no banco
        if ($request->hasFile('images')) {

            //Cria o caminho físico das imagens
            $images = $request->images;
            $imagePath = $this->pastaProduto($category->nm_categoria, $subcategory->nm_sub_categoria);
            $dbPath = $category->nm_categoria . '/' . $subcategory->nm_sub_categoria;

            foreach ($images as $key => $image) {

                $ext = $image->getClientOriginalExtension();
                $imageName = $request->cd_ean . '_' . ($key + 1) . '.' . $ext;

                $realPath = $image->getRealPath();

                $this->saveImageFile($imagePath, $imageName, $realPath);

                $localImagesPath[$key] = $dbPath . '/' . $imageName;

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
                catch (\Exception $e) {

                    if ($cont > 0) {

                        foreach ($imgsId as $i) {

                            Img::destroy($i);

                        }

                    }

                    DB::table('produto_categoria_subcat')->where('cd_produto', '=', $produto->cd_produto)->delete();
                    Product::destroy($produto->cd_produto);
                    Sku::destroy($sku->cd_sku);
                    Dimension::destroy($dimensao->cd_dimensao);

                    return redirect()->route('product.register')->with('nosuccess', 'Houve um problema ao cadastrar o produto');

                }
                finally {

                    $imgs[$key] = Img::orderBy('cd_img', 'DESC')->first();
                    $imgsId[$key] = $imgs[$key]->cd_img;

                }

            }

            $imgsId = [];
            $cont = 0;

            foreach ($imgs as $key => $img) {

                try {

                    DB::table('sku_produto_img')->insert([
                        'cd_sku' => $sku->cd_sku,
                        'cd_img' => $img->cd_img
                    ]);

                } catch (\Exception $e) {

                    if ($cont > 0) {

                        foreach ($imgsId as $i) {

                            Img::destroy($i);
                            DB::table('sku_produto_img')->where('cd_img', '=', $i)->delete();

                        }

                    }

                    DB::table('produto_categoria_subcat')->where('cd_produto', '=', $produto->cd_produto)->delete();
                    Product::destroy($produto->cd_produto);
                    Sku::destroy($sku->cd_sku);
                    Dimension::destroy($dimensao->cd_dimensao);

                    return redirect()->route('product.register')->with('nosuccess', 'Houve um problema ao cadastrar o produto');

                }
                finally {

                    $imgsId[$key] = $imgs[$key]->cd_img;

                }

            }


        }

        return redirect()->route('products.list')->with('success', 'Produto principal cadastrado com sucesso');

    }

    //Cadastrar variação do produto
    public function cadastrarVariacaoProduto(ProductVariationRequest $request)
    {

        $v = strpos($request->vl_produto_variacao, ',');

        if ($v !== false) {

            $val = str_replace(',', '.', $request->vl_produto_variacao);

        }

        if ($request->filled('status_variacao') == 'on') {

            $status = 1;

        } else {

            $status = 0;

        }

        //Procura no banco a categoria e subcategoria baseado no id
        $category = Category::findOrFail($request->cd_categoria_variacao);
        $subcategory = Category::join('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')->join('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')->select('sub_categoria.nm_sub_categoria')->where('categoria_subcat.cd_sub_categoria', '=', $request->cd_sub_categoria_variacao)->first();

        try {
            Dimension::create([
                'ds_altura' => $request->ds_altura_variacao,
                'ds_largura' => $request->ds_largura_variacao,
                'ds_comprimento' => $request->ds_comprimento_variacao,
                'ds_peso' => $request->ds_peso_variacao
            ]);
        }
        catch (\Exception $e) {

            return redirect('admin/productvariationpage/'.$request->cd_produto_principal)->with('nosuccess', 'Houve um problema ao cadastrar o produto');

        }
        finally {

            $dimensao = Dimension::orderBy('cd_dimensao', 'DESC')->first();

        }

        try {

            Sku::create([
                'cd_nr_sku' => $request->cd_sku_variacao,
                'cd_dimensao' => $dimensao->cd_dimensao
            ]);

        }
        catch (\Exception $e) {

            Dimension::destroy($dimensao->cd_dimensao);
            return redirect('admin/productvariationpage/'.$request->cd_produto_principal)->with('nosuccess', 'Houve um problema ao cadastrar o produto');

        }
        finally {

            $sku = Sku::select('cd_sku')->orderBy('cd_sku', 'DESC')->first();

        }

        //Tenta cadastrar o produto no banco e captura o erro caso ocorra
        try {

            //Salva o produto no banco
            ProductVariation::create([

                'cd_ean_variacao' => $request->cd_ean_variacao,
                'nm_produto_variacao' => $request->nm_produto_variacao,
                'ds_produto_variacao' => $request->ds_produto_variacao,
                'vl_produto_variacao' => $val,
                'qt_produto_variacao' => $request->qt_produto_variacao,
                'cd_status_produto_variacao' => $status,
                'cd_sku' => $sku->cd_sku,
                'cd_produto' => $request->cd_produto_principal

            ]);

        }
        catch (\Exception $e) {

            Sku::destroy($sku->cd_sku);
            Dimension::destroy($dimensao->cd_dimensao);
            return redirect('admin/productvariationpage/'.$request->cd_produto_principal)->with('nosuccess', 'Houve um problema ao cadastrar o produto');

        }
        finally {

            //Pega o último id do produto cadastrado
            $produtoVariacao = ProductVariation::orderBy('cd_produto_variacao', 'DESC')->first();

        }

        try {

            DB::table('produto_cor')->insert([
                'cd_sku' => $sku->cd_sku,
                'cd_cor' => $request->cd_cor_variacao
            ]);

        }
        catch (\Exception $e) {

            Product::destroy($produtoVariacao->cd_produto);
            Sku::destroy($sku->cd_sku);
            Dimension::destroy($dimensao->cd_dimensao);

            return redirect('admin/productvariationpage/'.$request->cd_produto_principal)->with('nosuccess', 'Houve um problema ao cadastrar o produto');

        }

        if ($request->cd_tamanho_letra_variacao == null) {

            $letra = false;
            $numero = true;

            try {

                DB::table('produto_tamanho_num')->insert([
                    'cd_sku' => $sku->cd_sku,
                    'cd_tamanho_num' => $request->cd_tamanho_num_variacao
                ]);

            }
            catch (\Exception $e) {

                DB::table('produto_cor')->where('cd_sku', '=', $sku->cd_sku)->delete();
                Product::destroy($produtoVariacao->cd_produto);
                Sku::destroy($sku->cd_sku);
                Dimension::destroy($dimensao->cd_dimensao);

                return redirect('admin/productvariationpage/'.$request->cd_produto_principal)->with('nosuccess', 'Houve um problema ao cadastrar o produto');

            }

        }
        else {

            $letra = true;
            $numero = false;

            try {

                DB::table('produto_tamanho_letra')->insert([
                    'cd_sku' => $sku->cd_sku,
                    'cd_tamanho_letra' => $request->cd_tamanho_letra_variacao
                ]);

            }
            catch (\Exception $e) {

                DB::table('produto_cor')->where('cd_sku', '=', $sku->cd_sku)->delete();
                Product::destroy($produtoVariacao->cd_produto);
                Sku::destroy($sku->cd_sku);
                Dimension::destroy($dimensao->cd_dimensao);

                return redirect('admin/productvariationpage/'.$request->cd_produto_principal)->with('nosuccess', 'Houve um problema ao cadastrar o produto');

            }

        }

        //Salva fisicamente a imagem e seta o caminho para ser salvo no banco
        if ($request->hasFile('images_variacao')) {

            //Cria o caminho físico das imagens
            $images = $request->images_variacao;
            $imagePath = $this->pastaProduto($category->nm_categoria, $subcategory->nm_sub_categoria);
            $dbPath = $category->nm_categoria . '/' . $subcategory->nm_sub_categoria;


            foreach ($images as $key => $image) {

                $ext = $image->getClientOriginalExtension();
                $imageName = $request->cd_ean_variacao . '_' . ($key + 1) . '.' . $ext;

                $realPath = $image->getRealPath();

                $this->saveImageFile($imagePath, $imageName, $realPath);

                $localImagesPath[$key] = $dbPath . '/' . $imageName;

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
                catch (\Exception $e) {

                    if ($cont > 0) {

                        foreach ($imgsId as $i) {

                            Img::destroy($i);

                        }

                    }

                    if ($letra) {

                        DB::table('produto_tamanho_letra')->where('cd_sku', '=', $sku->cd_sku)->delete();

                    }

                    if ($numero) {

                        DB::table('produto_tamanho_num')->where('cd_sku', '=', $sku->cd_sku)->delete();

                    }

                    DB::table('produto_cor')->where('cd_sku', '=', $sku->cd_sku)->delete();
                    Product::destroy($produtoVariacao->cd_produto);
                    DB::table('sku')->where('cd_sku', '=', $sku->cd_sku)->delete();
                    Dimension::destroy($dimensao->cd_dimensao);

                    return redirect('admin/productvariationpage/'.$request->cd_produto_principal)->with('nosuccess', 'Houve um problema ao cadastrar o produto');

                }
                finally {

                    $imgs[$key] = Img::orderBy('cd_img', 'DESC')->first();
                    $imgsId[$key] = $imgs[$key]->cd_img;

                }

            }

            $imgsId = [];
            $cont = 0;

            foreach ($imgs as $key => $img) {

                try {

                    DB::table('sku_produto_img')->insert([
                        'cd_sku' => $sku->cd_sku,
                        'cd_img' => $img->cd_img
                    ]);

                } catch (Exception $e) {

                    if ($cont > 0) {

                        foreach ($imgsId as $i) {

                            Img::destroy($i);
                            DB::table('sku_produto_img')->where('cd_img', '=', $i)->delete();

                        }

                    }

                    if ($letra) {

                        DB::table('produto_tamanho_letra')->where('cd_sku', '=', $sku->cd_sku)->delete();

                    }

                    if ($numero) {

                        DB::table('produto_tamanho_num')->where('cd_sku', '=', $sku->cd_sku)->delete();

                    }

                    DB::table('produto_cor')->where('cd_sku', '=', $sku->cd_sku)->delete();
                    Product::destroy($produtoVariacao->cd_produto);
                    Sku::destroy($sku->cd_sku);
                    Dimension::destroy($dimensao->cd_dimensao);

                    return redirect('admin/productvariationpage/'.$request->cd_produto_principal)->with('nosuccess', 'Houve um problema ao cadastrar o produto');

                }
                finally {

                    $imgsId[$key] = $imgs[$key]->cd_img;

                }

            }


        }

        return redirect()->route('products.list')->with('success', 'Variação do produto cadastrado com sucesso');

    }

    public function showProductPage() {

        $categorias = Category::all();
        $cores = Color::all();
        $tamanhosLetras = LetterSize::all();
        $tamanhosNumeros = NumberSize::all();
        $dimensoes = Dimension::all();

        return view('pages.admin.cadProduto', compact('categorias', 'cores', 'tamanhosLetras', 'tamanhosNumeros', 'dimensoes'));

    }

    public function showProductPageVariation($cd_produto) {

        $categorias = Category::all();
        $cores = Color::all();
        $tamanhosLetras = LetterSize::all();
        $tamanhosNumeros = NumberSize::all();

        $ultimoProduto = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')
            ->join('sku_produto_img', 'sku.cd_sku', '=', 'sku_produto_img.cd_sku')
            ->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
            ->join('dimensao', 'sku.cd_dimensao', 'dimensao.cd_dimensao')
            ->join('produto_categoria_subcat', 'produto_categoria_subcat.cd_produto', '=', 'produto.cd_produto')
            ->join('categoria_subcat', 'categoria_subcat.cd_categoria_subcat', '=', 'produto_categoria_subcat.cd_categoria_subcat')
            ->where('produto.cd_produto', '=', $cd_produto)
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
