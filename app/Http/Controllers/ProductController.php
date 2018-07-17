<?php

namespace App\Http\Controllers;

use App\Category;
use App\Menu;
use App\Color;
use App\Dimension;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductVariationRequest;
use App\LetterSize;
use App\Product;
use App\NumberSize;
use App\ProductVariation;
use App\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use App\Image as Img;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //mostar produto por cat/subcat
    public function showShopProductsCatSubcat(Request $request)
    {
        $dVerificador = $request->id;
        //$dVerificador = 'c';
        //$catSubCat = 8;
        $catSubCat = $request->catSubCat;
        $produtoCatSubCat = null;

        if (Auth::check()) {
            $n = explode(' ', Auth::user()->nm_cliente);
            $nome = $n[0];
        } else {
            $nome = null;
        }


        $menuNav =  Menu::all();

        //Carrega as categorias e subcategorias para serem apresentadas no menu nav
        foreach($menuNav as $key=>$menu){

            $categoriaSubCat[$key] = Category::
            leftJoin('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                ->leftJoin('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
                ->leftJoin('menu_categoria', 'menu_categoria.fk_cd_categoria', '=', 'categoria.cd_categoria')
                ->leftJoin('menu', 'menu.cd_menu', '=', 'menu_categoria.fk_cd_menu')
                ->select(
                    'categoria.cd_categoria',
                    'categoria.nm_categoria',
                    'sub_categoria.cd_sub_categoria',
                    'sub_categoria.nm_sub_categoria'
                )
                ->where('menu.cd_menu', '=', $menu->cd_menu)
                ->get();

        }

        //dd($request->all());

        if ($dVerificador=="c") {
            $produtoCatSubCat = Product::
            join('produto_categoria_subcat', 'produto_categoria_subcat.cd_produto', '=', 'produto.cd_produto')
                ->join('categoria_subcat', 'categoria_subcat.cd_categoria_subcat', '=', 'produto_categoria_subcat.cd_categoria_subcat')
                ->join('categoria', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                ->join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')
                ->leftJoin('produto_tamanho_num', 'sku.cd_sku', '=', 'produto_tamanho_num.cd_sku')
                ->leftJoin('tamanho_num', 'produto_tamanho_num.cd_tamanho_num', '=', 'tamanho_num.cd_tamanho_num')
                ->leftJoin('produto_tamanho_letra', 'sku.cd_sku', '=', 'produto_tamanho_letra.cd_sku')
                ->leftJoin('tamanho_letra', 'produto_tamanho_letra.cd_tamanho_letra', '=', 'tamanho_letra.cd_tamanho_letra')
                ->leftJoin('produto_cor', 'sku.cd_sku', '=', 'produto_cor.cd_sku')
                ->leftJoin('cor', 'produto_cor.cd_cor', '=', 'cor.cd_cor')
                ->leftJoin('dimensao', 'sku.cd_dimensao', '=', 'dimensao.cd_dimensao')
                ->leftJoin('sku_produto_img', 'sku_produto_img.cd_sku', '=', 'sku.cd_sku')
                ->leftJoin('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
                ->select(
                    'produto.cd_produto',
                    'sku.cd_nr_sku',
                    'produto.cd_ean',
                    'produto.nm_produto',
                    'produto.ds_produto',
                    'produto.nm_slug',
                    'produto.vl_produto',
                    'produto.qt_produto',
                    'produto.cd_status_produto',
                    'categoria.nm_categoria',
                    'tamanho_num.nm_tamanho_num',
                    'tamanho_letra.nm_tamanho_letra',
                    'cor.nm_cor',
                    'dimensao.ds_altura',
                    'dimensao.ds_comprimento',
                    'dimensao.ds_largura',
                    'dimensao.ds_peso',
                    'img_produto.im_produto'
                )
                ->where('img_produto.ic_img_principal', '=', 1)
                ->where('categoria.cd_categoria', '=', $catSubCat)
                ->get();
        } elseif ($dVerificador=="s") {
            $produtoCatSubCat = Product::
            join('produto_categoria_subcat', 'produto_categoria_subcat.cd_produto', '=', 'produto.cd_produto')
                ->join('categoria_subcat', 'categoria_subcat.cd_categoria_subcat', '=', 'produto_categoria_subcat.cd_categoria_subcat')
                ->join('categoria', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                ->join('sub_categoria', 'categoria_subcat.cd_sub_categoria', '=', 'sub_categoria.cd_sub_categoria')
                ->join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')
                ->leftJoin('produto_tamanho_num', 'sku.cd_sku', '=', 'produto_tamanho_num.cd_sku')
                ->leftJoin('tamanho_num', 'produto_tamanho_num.cd_tamanho_num', '=', 'tamanho_num.cd_tamanho_num')
                ->leftJoin('produto_tamanho_letra', 'sku.cd_sku', '=', 'produto_tamanho_letra.cd_sku')
                ->leftJoin('tamanho_letra', 'produto_tamanho_letra.cd_tamanho_letra', '=', 'tamanho_letra.cd_tamanho_letra')
                ->leftJoin('produto_cor', 'sku.cd_sku', '=', 'produto_cor.cd_sku')
                ->leftJoin('cor', 'produto_cor.cd_cor', '=', 'cor.cd_cor')
                ->leftJoin('dimensao', 'sku.cd_dimensao', '=', 'dimensao.cd_dimensao')
                ->leftJoin('sku_produto_img', 'sku_produto_img.cd_sku', '=', 'sku.cd_sku')
                ->leftJoin('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
                ->select(
                    'produto.cd_produto',
                    'sku.cd_nr_sku',
                    'produto.cd_ean',
                    'produto.nm_produto',
                    'produto.ds_produto',
                    'produto.nm_slug',
                    'produto.vl_produto',
                    'produto.qt_produto',
                    'produto.cd_status_produto',
                    'categoria.nm_categoria',
                    'sub_categoria.nm_sub_categoria',
                    'tamanho_num.nm_tamanho_num',
                    'tamanho_letra.nm_tamanho_letra',
                    'cor.nm_cor',
                    'dimensao.ds_altura',
                    'dimensao.ds_comprimento',
                    'dimensao.ds_largura',
                    'dimensao.ds_peso',
                    'img_produto.im_produto'
                )
                ->where('img_produto.ic_img_principal', '=', 1)
                ->where('sub_categoria.cd_sub_categoria', '=', $catSubCat)
                ->get();
        }

        //dd($produtoCatSubCat);

        return view('pages.app.product.shopFilter', compact('produtoCatSubCat', 'nome', 'menuNav', 'categoriaSubCat'));
        //return response()->json($produtoCatSubCat);
    }

    public function showShopFilterProductsPage()
    {
    }

    public function showShopProductsPage()
    {
        if (Auth::check()) {
            $n = explode(' ', Auth::user()->nm_cliente);
            $nome = $n[0];
        } else {
            $nome = null;
        }

        $produtos = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')->join('dimensao', 'dimensao.cd_dimensao', '=', 'sku.cd_dimensao')->where('cd_status_produto', '=', 1)->orderBy('produto.cd_produto')->paginate(6);

        $prod = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')->join('dimensao', 'dimensao.cd_dimensao', '=', 'sku.cd_dimensao')->where('cd_status_produto', '=', 1)->get();

        //$produtosVariacao = ProductVariation::where('cd_status_produto_variacao', '=', 1)->get();

        //dd($produtos);

        foreach ($prod as $key => $p) {
            $imagemPrincipal[$key] = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')
                ->join('sku_produto_img', 'sku.cd_sku', '=', 'sku_produto_img.cd_sku')
                ->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
                ->select('img_produto.im_produto')
                ->where('img_produto.ic_img_principal', '=', 1)
                ->where('produto.cd_status_produto', '=', 1)
                ->orderBy('produto.cd_produto')
                ->paginate(6);

            $idxImgs[$key] = $key;
        }

        //dd($imagemPrincipal);
        $menuNav =  Menu::all();

        //Carrega as categorias e subcategorias para serem apresentadas no menu nav
        foreach($menuNav as $key=>$menu){

            $categoriaSubCat[$key] = Category::
            leftJoin('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                ->leftJoin('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
                ->leftJoin('menu_categoria', 'menu_categoria.fk_cd_categoria', '=', 'categoria.cd_categoria')
                ->leftJoin('menu', 'menu.cd_menu', '=', 'menu_categoria.fk_cd_menu')
                ->select(
                    'categoria.cd_categoria',
                    'categoria.nm_categoria',
                    'sub_categoria.cd_sub_categoria',
                    'sub_categoria.nm_sub_categoria'
                )
                ->where('menu.cd_menu', '=', $menu->cd_menu)
                ->get();

        }

        $produtos = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')->join('dimensao', 'dimensao.cd_dimensao', '=', 'sku.cd_dimensao')->where('cd_status_produto', '=', 1)->paginate(30);

        $imagemVariacao = ProductVariation::join('sku', 'produto_variacao.cd_sku', '=', 'sku.cd_sku')
            ->join('sku_produto_img', 'sku.cd_sku', '=', 'sku_produto_img.cd_sku')
            ->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
            ->select('img_produto.im_produto')
            ->where('img_produto.ic_img_principal', '=', 1)
            ->orderBy('sku_produto_img.cd_img')
            ->get();

        return view('pages.app.product.index', compact('produtos', 'imagemPrincipal', 'nome', 'menuNav', 'categoriaSubCat'));
    }

    public function paginaAlteraremailcliente()
    {
        return view('pages.app.alteraremailcliente');
    }

    public function showProductDetails($slug)
    {
        if (Auth::check()) {
            $n = explode(' ', Auth::user()->nm_cliente);
            $nome = $n[0];
        } else {
            $nome = null;
        }

        $product = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')->join('dimensao', 'dimensao.cd_dimensao', '=', 'sku.cd_dimensao')->where('cd_status_produto', '=', 1)->where('produto.nm_slug', '=', $slug)->firstOrFail();

        //dd($product);

        $productImages = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')
            ->join('sku_produto_img', 'sku.cd_sku', '=', 'sku_produto_img.cd_sku')
            ->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
            ->select('img_produto.im_produto')
            ->where('sku.cd_nr_sku', '=', $product->cd_nr_sku)
            ->orderBy('sku_produto_img.cd_img')
            ->get()->toArray();

        //dd($productImages);

        $productImagesVariation = ProductVariation::join('sku', 'produto_variacao.cd_sku', 'sku.cd_sku')->join('produto', 'produto.cd_produto', 'produto_variacao.cd_produto')->join('sku_produto_img', 'sku.cd_sku', '=', 'sku_produto_img.cd_sku')->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')->select('img_produto.im_produto')->where('sku.cd_nr_sku', '=', $product->cd_nr_sku)->orderBy('sku_produto_img.cd_img')->get()->toArray();

        //dd($productVariation);
        $menuNav =  Menu::all();

        //Carrega as categorias e subcategorias para serem apresentadas no menu nav
        foreach($menuNav as $key=>$menu){

            $categoriaSubCat[$key] = Category::
            leftJoin('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                ->leftJoin('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
                ->leftJoin('menu_categoria', 'menu_categoria.fk_cd_categoria', '=', 'categoria.cd_categoria')
                ->leftJoin('menu', 'menu.cd_menu', '=', 'menu_categoria.fk_cd_menu')
                ->select(
                    'categoria.cd_categoria',
                    'categoria.nm_categoria',
                    'sub_categoria.cd_sub_categoria',
                    'sub_categoria.nm_sub_categoria'
                )
                ->where('menu.cd_menu', '=', $menu->cd_menu)
                ->get();

        }

        return view('pages.app.product.details',
            compact('product', 'productImages', 'productVariation', 'productImagesvariation', 'nome', 'menuNav', 'categoriaSubCat'));
    }

    public function paginaAlterarsenhacliente()
    {
        return view('pages.app.alterarsenhacliente');
    }

    public function listaProduto()
    {
        $produtos = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')->where('produto.cd_status_produto', '=', 1)->paginate(25);
        $tamanhosLetras = LetterSize::all();
        $tamanhosNumeros = NumberSize::all();
        $cores = Color::all();

        //dd($produtos);

        return view('pages.admin.products.list', compact('produtos', 'tamanhosLetras', 'tamanhosNumeros', 'cores'));
    }

    public function showProductAdminPage()
    {
        $categorias = Category::all();
        $cores = Color::all();
        $tamanhosLetras = LetterSize::all();
        $tamanhosNumeros = NumberSize::all();
        $dimensoes = Dimension::all();

        return view('pages.admin.products.register', compact('categorias', 'cores', 'tamanhosLetras', 'tamanhosNumeros', 'dimensoes'));
    }

    public function showProductPageVariation($cd_produto)
    {
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

    //CRUD
    public function cadastrarProduto(ProductRequest $request)
    {
        //dd($request->all());
        $v = strpos($request->vl_produto, ',');

        $slugname = str_slug($request->nm_produto, '-');

        if ($v !== false) {
            $val = str_replace(',', '.', $request->vl_produto);
        } else {
            $val = $request->vl_produto;
        }

        if ($request->filled('status') == 'on') {
            $status = 1;
        } else {
            $status = 0;
        }

        DB::beginTransaction();

        try {
            $dimensao = $this->createDimension($request->ds_largura, $request->ds_altura, $request->ds_comprimento, $request->ds_peso);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('product.register')->with('nosuccess', 'Erro ao cadastrar tamanho do produto');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('product.register')->with('nosuccess', 'Erro ao cadastrar tamanho do produto');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('product.register')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            $sku = $this->createSku($request->cd_sku, $dimensao->cd_dimensao);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('product.register')->with('nosuccess', 'Erro ao cadastrar o SKU do produto');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('product.register')->with('nosuccess', 'Erro ao cadastrar o SKU do produto');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('product.register')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            $produto = $this->createProduct($request->cd_ean, $request->nm_produto, $request->ds_produto, $val, $request->qt_produto, $status, $sku->cd_sku, $slugname);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('product.register')->with('nosuccess', 'Erro ao cadastrar o produto');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('product.register')->with('nosuccess', 'Erro ao cadastrar o produto');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('product.register')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            $this->associateProductCategorySubcategory($produto->cd_produto, $this->getCategorySubcategoryId($request->cd_categoria, $request->cd_sub_categoria));
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('product.register')->with('nosuccess', 'Erro ao associar a categoria ao produto');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('product.register')->with('nosuccess', 'Erro ao associar a categoria do produto');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('product.register')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            if ($request->hasFile('images')) {

                //Cria o caminho físico das imagens
                $images = $request->images;
                $imagePath = $this->pastaProduto($this->getCategoryName($request->cd_categoria), $this->getSubcategoryName($request->cd_sub_categoria));
                $dbPath = $this->getCategoryName($request->cd_categoria) . '/' . $this->getSubcategoryName($request->cd_sub_categoria);

                foreach ($images as $key => $image) {
                    $ext = $image->getClientOriginalExtension();
                    $imageName = $request->cd_sku . '_' . ($key + 1) . '.' . $ext;

                    $realPath = $image->getRealPath();

                    $this->saveImageFile($imagePath, $imageName, $realPath);

                    $localImagesPath[$key] = $dbPath . '/' . $imageName;
                }

                foreach ($localImagesPath as $key => $dbImage) {
                    if ($key == 0) {
                        $img = $this->createImage($dbImage, 1);
                    } else {
                        $img = $this->createImage($dbImage, 0);
                    }

                    $skuImagem = $this->associateSkuImage($sku->cd_sku, $img->cd_img);

                    $imgsPath[$key] = $img->im_produto;
                }
            } else {
                $img = $this->createImage('semprodutoview.png', 1);
                $skuImagem = $this->associateSkuImage($sku->cd_sku, $img->cd_img);
            }
        } catch (QueryException $e) {
            DB::rollBack();
            foreach ($imgsPath as $key => $imPath) {
                $this->deleteImageFile($imPath);
            }
            return redirect()->route('product.register')->with('nosuccess', 'Erro ao cadastrar tamanho do produto');
        } catch (\Exception $e) {
            DB::rollBack();
            foreach ($imgsPath as $key => $imPath) {
                $this->deleteImageFile($imPath);
            }
            return redirect()->route('product.register')->with('nosuccess', 'Erro ao cadastrar a imagem');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('product.register')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        }

        DB::commit();

        return redirect()->route('products.list')->with('success', 'Produto principal cadastrado com sucesso');
    }

    //Cadastrar variação do produto
    public function cadastrarVariacaoProduto(ProductVariationRequest $request)
    {
        //dd($request->all());

        $v = strpos($request->vl_produto_variacao, ',');

        $slugnameVariation = str_slug($request->nm_produto_variacao, '-');

        if ($v !== false) {
            $val = str_replace(',', '.', $request->vl_produto_variacao);
        }

        if ($request->filled('status_variacao') == 'on') {
            $status = 1;
        } else {
            $status = 0;
        }

        DB::beginTransaction();

        try {
            $dimensao = $this->createDimension($request->ds_largura_variacao, $request->ds_altura_variacao, $request->ds_comprimento_variacao, $request->ds_peso_variacao);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect('admin/product/variation/' . $request->cd_produto_principal)->with('nosuccess', 'Erro ao cadastrar o tamanho da variação');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect('admin/product/variation/' . $request->cd_produto_principal)->with('nosuccess', 'Erro ao cadastrar tamanho do produto');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect('admin/product/variation/' . $request->cd_produto_principal)->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            $sku = $this->createSku($request->cd_sku_variacao, $dimensao->cd_dimensao);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect('admin/product/variation/' . $request->cd_produto_principal)->with('nosuccess', 'Erro ao cadastrar o SKU da variação');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect('admin/product/variation/' . $request->cd_produto_principal)->with('nosuccess', 'Erro ao cadastrar SKU do produto');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect('admin/product/variation/' . $request->cd_produto_principal)->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        //Tenta cadastrar o produto no banco e captura o erro caso ocorra
        try {
            $produtoVariacao = $this->createProductVariation($request->cd_ean_variacao, $request->nm_produto_variacao, $request->ds_produto_variacao, $val, $request->qt_produto_variacao, $status, $sku->cd_sku, $request->cd_produto_principal, $slugnameVariation);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect('admin/product/variation/' . $request->cd_produto_principal)->with('nosuccess', 'Erro ao cadastrar a variação do produto');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect('admin/product/variation/' . $request->cd_produto_principal)->with('nosuccess', 'Erro ao cadastrar variação do produto');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect('admin/product/variation/' . $request->cd_produto_principal)->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            $this->associateProductColor($sku->cd_sku, $request->cd_cor_variacao);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect('admin/product/variation/' . $request->cd_produto_principal)->with('nosuccess', 'Erro ao associar a variação com a cor do produto');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect('admin/product/variation/' . $request->cd_produto_principal)->with('nosuccess', 'Erro ao associar a variação com a cor do produto');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect('admin/product/variation/' . $request->cd_produto_principal)->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        if (!($request->cd_tamanho_letra_variacao == null && $request->cd_tamanho_num_variacao == null)) {
            if ($request->cd_tamanho_letra_variacao == null) {
                $letra = false;
                $numero = true;

                try {
                    $this->associateProductNumberSize($sku->cd_sku, $request->cd_tamanho_num_variacao);
                } catch (ValidationException $e) {
                    DB::rollBack();
                    return redirect('admin/product/variation/' . $request->cd_produto_principal)->with('nosuccess', 'Erro ao associar a variação com seu tamanho por número');
                } catch (QueryException $e) {
                    DB::rollBack();
                    return redirect('admin/product/variation/' . $request->cd_produto_principal)->with('nosuccess', 'Erro ao associar a variação com seu tamanho por número');
                } catch (\PDOException $e) {
                    DB::rollBack();
                    return redirect('admin/product/variation/' . $request->cd_produto_principal)->with('nosuccess', 'Erro ao conectar com o banco de dados');
                } catch (\Exception $e) {
                    DB::rollBack();
                    throw $e;
                }
            } else {
                $letra = true;
                $numero = false;

                try {
                    $this->associateProductLetterSize($sku->cd_sku, $request->cd_tamanho_letra_variacao);
                } catch (ValidationException $e) {
                    DB::rollBack();
                    return redirect('admin/product/variation/' . $request->cd_produto_principal)->with('nosuccess', 'Erro ao associar a variação com seu tamanho por letra');
                } catch (QueryException $e) {
                    DB::rollBack();
                    return redirect('admin/product/variation/' . $request->cd_produto_principal)->with('nosuccess', 'Erro ao associar a variação com seu tamanho por letra');
                } catch (\PDOException $e) {
                    DB::rollBack();
                    return redirect('admin/product/variation/' . $request->cd_produto_principal)->with('nosuccess', 'Erro ao conectar com o banco de dados');
                } catch (\Exception $e) {
                    DB::rollBack();
                    throw $e;
                }
            }
        }


        try {
            if ($request->hasFile('images_variacao')) {
                $im = true;

                //Cria o caminho físico das imagens
                $images = $request->images_variacao;
                $imagePath = $this->pastaProduto($this->getCategoryName($request->cd_categoria_variacao), $this->getSubcategoryName($request->cd_sub_categoria_variacao));
                $dbPath = $this->getCategoryName($request->cd_categoria_variacao) . '/' . $this->getSubcategoryName($request->cd_sub_categoria_variacao);

                foreach ($images as $key => $image) {
                    $ext = $image->getClientOriginalExtension();
                    $imageName = $request->cd_sku_variacao . '_' . ($key + 1) . '.' . $ext;

                    $realPath = $image->getRealPath();

                    $this->saveImageFile($imagePath, $imageName, $realPath);

                    $localImagesPath[$key] = $dbPath . '/' . $imageName;
                }

                foreach ($localImagesPath as $key => $dbImage) {
                    if ($key == 0) {
                        $img = $this->createImage($dbImage, 1);
                    } else {
                        $img = $this->createImage($dbImage, 0);
                    }

                    $skuImagem = $this->associateSkuImage($sku->cd_sku, $img->cd_img);

                    $imgsPath[$key] = $img->im_produto;
                }
            } else {
                $img = $this->createImage('semprodutoview.png', 1);
                $skuImagem = $this->associateSkuImage($sku->cd_sku, $img->cd_img);
            }
        } catch (ValidationException $e) {
            DB::rollBack();
            if ($im) {
                foreach ($imgsPath as $key => $imPath) {
                    $this->deleteImageFile($imPath);
                }
            }
            return redirect()->route('product.register')->with('nosuccess', 'Erro ao cadastrar a imagem');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('product.register')->with('nosuccess', 'Erro ao cadastrar a imagem do produto');
        } catch (\PDOException $e) {
            DB::rollBack();
            if ($im) {
                foreach ($imgsPath as $key => $imPath) {
                    $this->deleteImageFile($imPath);
                }
            }
            return redirect()->route('product.register')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            if ($im) {
                foreach ($imgsPath as $key => $imPath) {
                    $this->deleteImageFile($imPath);
                }
            }
            return redirect()->route('product.register')->with('nosuccess', 'Erro ao cadastrar a imagem');
        }

        DB::commit();

        return redirect()->route('products.list')->with('success', 'Variação do produto cadastrada com sucesso');
    }

    public function saveImageFile($imagePath, $imageName, $realPath)
    {
        Image::make($realPath)->save($imagePath . '/' . $imageName);
    }

    public function deleteImageFile($caminhoImagem)
    {
        $rootProductsPath = public_path('img/products/');

        unlink($rootProductsPath . $caminhoImagem);
    }

    public function pastaProduto($categoria, $subcategoria)
    {
        $rootProductsPath = public_path('img/products/');

        if (!file_exists($rootProductsPath . $categoria)) {
            mkdir($rootProductsPath . $categoria, 0775, true);
            $p1 = $rootProductsPath . $categoria;
        } else {
            $p1 = $rootProductsPath . $categoria;
        }

        if (!file_exists($p1 . '/' . $subcategoria)) {
            mkdir($p1 . '/' . $subcategoria, 0775, true);
            $path = $p1 . '/' . $subcategoria;
        } else {
            $path = $p1 . '/' . $subcategoria;
        }

        return $path;
    }

    public function createDimension($largura, $altura, $comprimento, $peso)
    {
        return Dimension::firstOrCreate([
            'ds_altura' => $altura,
            'ds_largura' => $largura,
            'ds_comprimento' => $comprimento,
            'ds_peso' => $peso
        ]);
    }

    public function createSku($sku, $cd_dimensao)
    {
        return Sku::firstOrCreate([
            'cd_nr_sku' => $sku,
            'cd_dimensao' => $cd_dimensao
        ]);
    }

    public function createProduct($eanProd, $nomeProd, $descProd, $valorProd, $qtProd, $statusProd, $codSkuProd, $slugname)
    {
        return Product::firstOrCreate([
            'cd_ean' => $eanProd,
            'nm_produto' => $nomeProd,
            'ds_produto' => $descProd,
            'vl_produto' => $valorProd,
            'nm_slug' => $slugname,
            'qt_produto' => $qtProd,
            'cd_status_produto' => $statusProd,
            'cd_sku' => $codSkuProd
        ]);
    }

    public function createProductVariation($codEanVariacao, $nomeProdVariacao, $descProdVariacao, $valorProdVariacao, $qtProdVariacao, $statusProdVariacao, $codSkuProdVariacao, $codProdPrincipal, $slugnameVariacao)
    {
        ProductVariation::firstOrCreate([
            'cd_ean_variacao' => $codEanVariacao,
            'nm_produto_variacao' => $nomeProdVariacao,
            'ds_produto_variacao' => $descProdVariacao,
            'vl_produto_variacao' => $valorProdVariacao,
            'nm_slug_variacao' => $slugnameVariacao,
            'qt_produto_variacao' => $qtProdVariacao,
            'cd_status_produto_variacao' => $statusProdVariacao,
            'cd_sku' => $codSkuProdVariacao,
            'cd_produto' => $codProdPrincipal
        ]);
    }

    public function createImage($imagemBanco, $flagPrincipal)
    {
        return Img::firstOrCreate([
            'im_produto' => $imagemBanco,
            'ic_img_principal' => $flagPrincipal
        ]);
    }

    public function associateProductCategorySubcategory($codProduto, $codCategoriaSubCategoria)
    {
        DB::table('produto_categoria_subcat')->insert([
            'cd_produto' => $codProduto,
            'cd_categoria_subcat' => $codCategoriaSubCategoria
        ]);
    }

    public function associateSkuImage($codSku, $codImagem)
    {
        DB::table('sku_produto_img')->insert([
            'cd_sku' => $codSku,
            'cd_img' => $codImagem
        ]);
    }

    public function associateProductColor($codSku, $codCor)
    {
        DB::table('produto_cor')->insert([
            'cd_sku' => $codSku,
            'cd_cor' => $codCor
        ]);
    }

    public function associateProductNumberSize($codSku, $codTamNumero)
    {
        DB::table('produto_tamanho_num')->insert([
            'cd_sku' => $codSku,
            'cd_tamanho_num' => $codTamNumero
        ]);
    }

    public function associateProductLetterSize($codSku, $codTamLetra)
    {
        DB::table('produto_tamanho_letra')->insert([
            'cd_sku' => $codSku,
            'cd_tamanho_letra' => $codTamLetra
        ]);
    }

    //Retorna o nome da Categoria fazendo a pesquisa pelo Código
    public function getCategoryName($codCategoria)
    {
        $category = Category::find($codCategoria);

        return $category->nm_categoria;
    }

    //Retorna o nome da Subcategoria fazendo a pesquisa pelo Código
    public function getSubcategoryName($codSubcategory)
    {
        $subcategory = Category::join('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')->join('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')->select('sub_categoria.nm_sub_categoria')->where('categoria_subcat.cd_sub_categoria', '=', $codSubcategory)->first();

        return $subcategory->nm_sub_categoria;
    }

    //Seleciona o id correspondente dos forms categoria e subcategoria na tabela categoria_subcat
    public function getCategorySubcategoryId($codCategoria, $codSubcategoria)
    {
        $prod_cat_subcat = DB::table('categoria_subcat')->select('cd_categoria_subcat')->where('cd_categoria', '=', $codCategoria)->where('cd_sub_categoria', '=', $codSubcategoria)->first();

        return $prod_cat_subcat->cd_categoria_subcat;
    }

    //Atualiza a quantidade de produtos
    public function productUpdate($codProduct, $qtProduct)
    {
        $product = Product::find($codProduct);
        $product->qt_produto = $qtProduct;

        $product->save();
    }

    //Chama a função para atualizar a quantidade dos produtos
    public function updateProduct(Request $request)
    {
        DB::beginTransaction();

        try {
            $this->productUpdate($request->cd_produto, $request->qt_produto);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('products.list')->with('nosuccess', 'Erro ao atualizar o produto');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('products.list')->with('nosuccess', 'Erro ao atualizar o produto');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('products.list')->with('nosuccess', 'Erro ao atualizar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        $response = [
            'status' => 'success',
            'message' => 'Produto atualizado com sucesso'
        ];

        return response()->json($response);
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
