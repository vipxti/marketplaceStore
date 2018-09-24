<?php

namespace App\Http\Controllers;

use App\Category;
use App\Menu;
use App\Color;
use App\Dimension;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductVariationRequest;
use App\LetterSize;
use App\NavigationMenu;
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

class ProductController extends Controller {

    //mostar produto por cat/subcat
    public function showShopProductsCatSubcat(Request $request){
        //dd($request->all());
        $dVerificador = $request->id;
        //$dVerificador = 'c';
        //$catSubCat = 8;
        $catSubCat = $request->catSubCat;
        //dd($catSubCat);
        $produtoCatSubCat = null;

        if (Auth::check()) {
            $n = explode(' ', Auth::user()->nm_cliente);
            $nome = $n[0];
        } else {
            $nome = null;
        }

        $menuNav =  Menu::all();

        $menuNavegacao = NavigationMenu::all();
        //dd($menuNavegacao[0]->menu_ativo);

        if(count($menuNavegacao) > 0) {
            if ($menuNavegacao[0]->menu_ativo == 1) {
                //Carrega as categorias e subcategorias para serem apresentadas no menu nav
                foreach ($menuNav as $key => $menu) {
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
            } else {
                $categoriaSubCat = Category::leftJoin('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                    ->leftJoin('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
                    ->join('ordem_categoria', 'ordem_categoria.fk_cd_categoria', '=', 'categoria.cd_categoria')
                    ->select(
                        'categoria.cd_categoria',
                        'categoria.nm_categoria',
                        'sub_categoria.cd_sub_categoria',
                        'sub_categoria.nm_sub_categoria'
                    )
                    ->orderBy('ordem_categoria.cd_ordem_categoria')
                    ->get();
            }
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
                ->where('produto.cd_status_produto', '=', 1)
                ->where('img_produto.ic_img_principal', '=', 1)
                ->where('categoria.cd_categoria', '=', $catSubCat)
                ->orderBy('produto.cd_produto')
                //->paginate(28);
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
                ->where('sub_categoria.cd_sub_categoria', '=', $catSubCat)
                ->where('produto.cd_status_produto', '=', 1)
                ->where('img_produto.ic_img_principal', '=', 1)
                ->orderBy('produto.cd_produto')
                ->get();
                //->paginate(28);
        } elseif ($dVerificador == "pesquisa") {
            //dd($dVerificador);
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
                ->where('produto.nm_produto', 'like', '%'.$catSubCat.'%')
                ->where('produto.cd_status_produto', '=', 1)
                ->where('img_produto.ic_img_principal', '=', 1)
                ->orderBy('produto.cd_produto')
                ->get();
                //->paginate(28);
        }

        //dd($produtoCatSubCat);

        return view('pages.app.product.filter', compact('produtoCatSubCat', 'nome', 'menuNav', 'categoriaSubCat', 'menuNavegacao'));
        //return response()->json($produtoCatSubCat);
    }

    public function showShopProductsPage()
    {
        if (Auth::check()) {
            $n = explode(' ', Auth::user()->nm_cliente);
            $nome = $n[0];
        } else {
            $nome = null;
        }

        $menuNav =  Menu::all();

        $menuNavegacao = NavigationMenu::all();
        //dd($menuNavegacao[0]->menu_ativo);

        if(count($menuNavegacao) > 0) {
            if ($menuNavegacao[0]->menu_ativo == 1) {
                //Carrega as categorias e subcategorias para serem apresentadas no menu nav
                foreach ($menuNav as $key => $menu) {
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
            } else {
                $categoriaSubCat = Category::leftJoin('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                    ->leftJoin('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
                    ->join('ordem_categoria', 'ordem_categoria.fk_cd_categoria', '=', 'categoria.cd_categoria')
                    ->select(
                        'categoria.cd_categoria',
                        'categoria.nm_categoria',
                        'sub_categoria.cd_sub_categoria',
                        'sub_categoria.nm_sub_categoria'
                    )
                    ->orderBy('ordem_categoria.cd_ordem_categoria')
                    ->get();
            }
        }

        $produtos = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')->join('dimensao', 'dimensao.cd_dimensao', '=', 'sku.cd_dimensao')->join('sku_produto_img', 'sku.cd_sku', 'sku_produto_img.cd_sku')->join('img_produto', 'sku_produto_img.cd_img', 'img_produto.cd_img')->where('produto.cd_status_produto', '=', 1)->where('img_produto.ic_img_principal', '=', 1)->orderBy('produto.cd_produto', 'desc')->paginate(25);

        $variation = ProductVariation::rightJoin('produto', 'produto.cd_produto', 'produto_variacao.cd_produto')->select('produto_variacao.cd_produto', 'produto.nm_slug')->paginate(25);
        return view('pages.app.product.index', compact('produtos', 'variation', 'nome', 'menuNav', 'categoriaSubCat', 'menuNavegacao'));
    }

    public function showProductDetails($slug)
    {
        $totalCores = 0;
        $sizeType = '';

        if (Auth::check()) {
            $n = explode(' ', Auth::user()->nm_cliente);
            $nome = $n[0];
        } else {
            $nome = null;
        }

        $product = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')->join('dimensao', 'dimensao.cd_dimensao', '=', 'sku.cd_dimensao')->where('produto.cd_status_produto', '=', 1)->where('produto.nm_slug', '=', $slug)->get()->toArray();

        $variations = ProductVariation::join('sku', 'produto_variacao.cd_sku', 'sku.cd_sku')->join('dimensao', 'dimensao.cd_dimensao', 'sku.cd_dimensao')->join('produto', 'produto.cd_produto', 'produto_variacao.cd_produto')->select('produto_variacao.cd_produto_variacao', 'produto_variacao.nm_produto_variacao', 'produto_variacao.ds_produto_variacao', 'produto_variacao.vl_produto_variacao', 'produto_variacao.nm_slug_variacao', 'produto_variacao.qt_produto_variacao', 'produto_variacao.cd_status_produto_variacao', 'sku.cd_nr_sku', 'dimensao.ds_altura', 'dimensao.ds_largura', 'dimensao.ds_peso', 'dimensao.ds_comprimento', 'sku.cd_sku')->where('produto.cd_produto', '=', $product[0]['cd_produto'])->orderBy('produto_variacao.cd_produto_variacao')->get()->toArray();

        if (count($variations) > 0) {
            $hasVariation = true;
            $isVariation = true;

            foreach ($variations as $key => $var) {
                $codProds[$key] = $var['cd_produto_variacao'];
            }

            $colors = ProductVariation::join('sku', 'produto_variacao.cd_sku', '=', 'sku.cd_sku')->join('produto_cor', 'sku.cd_sku', '=', 'produto_cor.cd_sku')->join('cor', 'cor.cd_cor', '=', 'produto_cor.cd_cor')->select('cor.cd_cor', 'cor.nm_cor', 'cor.hex')->whereIn('produto_variacao.cd_produto_variacao', $codProds)->groupBy('cor.cd_cor', 'cor.nm_cor', 'cor.hex')->get();

            $images = ProductVariation::join('sku', 'produto_variacao.cd_sku', '=', 'sku.cd_sku')->join('sku_produto_img', 'sku.cd_sku', '=', 'sku_produto_img.cd_sku')->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')->select('img_produto.im_produto')->where('sku.cd_nr_sku', '=', $variations[0]['cd_nr_sku'])->orderBy('sku_produto_img.cd_img')->get()->toArray();

            $numbers = ProductVariation::join('sku', 'produto_variacao.cd_sku', '=', 'sku.cd_sku')->join('produto_cor', 'sku.cd_sku', '=', 'produto_cor.cd_sku')->join('cor', 'cor.cd_cor', '=', 'produto_cor.cd_cor')->join('produto_tamanho_num', 'produto_tamanho_num.cd_sku', 'sku.cd_sku')->join('tamanho_num', 'tamanho_num.cd_tamanho_num', 'produto_tamanho_num.cd_tamanho_num')->select('tamanho_num.nm_tamanho_num', 'sku.cd_nr_sku')->where('cor.cd_cor', '=', $colors[0]['cd_cor'])->whereIn('produto_variacao.cd_produto_variacao', $codProds)->get();

            $letters = ProductVariation::join('sku', 'produto_variacao.cd_sku', '=', 'sku.cd_sku')->join('produto_cor', 'sku.cd_sku', '=', 'produto_cor.cd_sku')->join('cor', 'cor.cd_cor', '=', 'produto_cor.cd_cor')->join('produto_tamanho_letra', 'produto_tamanho_letra.cd_sku', 'sku.cd_sku')->join('tamanho_letra', 'tamanho_letra.cd_tamanho_letra', 'produto_tamanho_letra.cd_tamanho_letra')->select('tamanho_letra.nm_tamanho_letra', 'sku.cd_nr_sku')->where('cor.cd_cor', '=', $colors[0]['cd_cor'])->whereIn('produto_variacao.cd_produto_variacao', $codProds)->get();

            if (count($letters) > 0) {
                $sizeType = 'L';
                $sizes = $letters;
            }

            if (count($numbers) > 0) {
                $sizeType = 'N';
                $sizes = $numbers;
            }

            $totalCores = count($colors);
            $totalImagens = count($images);
        } else {
            $hasVariation = false;
            $isVariation = false;

            $images = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')->join('sku_produto_img', 'sku.cd_sku', '=', 'sku_produto_img.cd_sku')->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')->select('img_produto.im_produto')->where('sku.cd_nr_sku', '=', $product[0]['cd_nr_sku'])->orderBy('sku_produto_img.cd_img')->get()->toArray();

            $totalImagens = count($images);

            $codProds = null;
            $colors = null;
            $sizes = [];
        }

        $menuNav =  Menu::all();

        $menuNavegacao = NavigationMenu::all();
        //dd($menuNavegacao[0]->menu_ativo);
        if(count($menuNavegacao) > 0) {
            if ($menuNavegacao[0]->menu_ativo == 1) {
                //Carrega as categorias e subcategorias para serem apresentadas no menu nav
                foreach ($menuNav as $key => $menu) {
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
            } else {
                $categoriaSubCat = Category::leftJoin('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                    ->leftJoin('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
                    ->join('ordem_categoria', 'ordem_categoria.fk_cd_categoria', '=', 'categoria.cd_categoria')
                    ->select(
                        'categoria.cd_categoria',
                        'categoria.nm_categoria',
                        'sub_categoria.cd_sub_categoria',
                        'sub_categoria.nm_sub_categoria'
                    )
                    ->orderBy('ordem_categoria.cd_ordem_categoria')
                    ->get();
            }
        }

        //dd($sizeType);

        return view('pages.app.product.details', compact('product', 'images', 'sizes', 'sizeType', 'variations', 'totalCores', 'totalImagens', 'colors', 'codProds', 'nome', 'menuNav', 'categoriaSubCat', 'hasVariation', 'isVariation', 'menuNavegacao'));
    }

    public function getSizes(Request $request)
    {
        $numbers = ProductVariation::join('sku', 'produto_variacao.cd_sku', '=', 'sku.cd_sku')->join('produto_cor', 'sku.cd_sku', '=', 'produto_cor.cd_sku')->join('cor', 'cor.cd_cor', '=', 'produto_cor.cd_cor')->join('produto_tamanho_num', 'produto_tamanho_num.cd_sku', 'sku.cd_sku')->join('tamanho_num', 'tamanho_num.cd_tamanho_num', 'produto_tamanho_num.cd_tamanho_num')->select('tamanho_num.nm_tamanho_num', 'sku.cd_nr_sku')->where('cor.cd_cor', '=', $request->cd_cor)->whereIn('produto_variacao.cd_produto_variacao', $request->cds_produto)->get();

        $letters = ProductVariation::join('sku', 'produto_variacao.cd_sku', '=', 'sku.cd_sku')->join('produto_cor', 'sku.cd_sku', '=', 'produto_cor.cd_sku')->join('cor', 'cor.cd_cor', '=', 'produto_cor.cd_cor')->join('produto_tamanho_letra', 'produto_tamanho_letra.cd_sku', 'sku.cd_sku')->join('tamanho_letra', 'tamanho_letra.cd_tamanho_letra', 'produto_tamanho_letra.cd_tamanho_letra')->select('tamanho_letra.nm_tamanho_letra', 'sku.cd_nr_sku')->where('cor.cd_cor', '=', $request->cd_cor)->whereIn('produto_variacao.cd_produto_variacao', $request->cds_produto)->get();

        if (count($letters) > 0) {
            $sizes = $letters;

            foreach ($letters as $key => $l) {
                $images = Sku::join('sku_produto_img', 'sku.cd_sku', 'sku_produto_img.cd_sku')->join('img_produto', 'sku_produto_img.cd_img', 'img_produto.cd_img')->select('img_produto.ic_img_principal', 'img_produto.im_produto')->where('sku.cd_nr_sku', '=', $l->cd_nr_sku)->get();
            }

            $sizeType = 'L';
        }
        
        if (count($numbers) > 0) {
            $sizes = $numbers;

            foreach ($numbers as $key => $n) {
                $images = Sku::join('sku_produto_img', 'sku.cd_sku', 'sku_produto_img.cd_sku')->join('img_produto', 'sku_produto_img.cd_img', 'img_produto.cd_img')->select('img_produto.ic_img_principal', 'img_produto.im_produto')->where('sku.cd_nr_sku', '=', $n->cd_nr_sku)->get();
            }

            $sizeType = 'N';
        }

        $response = [
            'data' => $sizes,
            'images' => $images,
            'sizeType' => $sizeType
        ];

        return response()->json($response);
    }

    public function getVariationData(Request $request)
    {
        //dd($request->all());

        $variation = ProductVariation::join('sku', 'produto_variacao.cd_sku', 'sku.cd_sku')->join('produto', 'produto.cd_produto', 'produto_variacao.cd_produto')->join('dimensao', 'sku.cd_dimensao', 'dimensao.cd_dimensao')->join('sku_produto_img', 'sku.cd_sku', '=', 'sku_produto_img.cd_sku')->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')->select('produto_variacao.cd_produto', 'produto_variacao.nm_produto_variacao', 'produto_variacao.ds_produto_variacao', 'produto_variacao.vl_produto_variacao', 'produto_variacao.qt_produto_variacao', 'sku.cd_nr_sku', 'produto.nm_slug', 'img_produto.im_produto', 'dimensao.ds_peso', 'dimensao.ds_comprimento', 'dimensao.ds_altura', 'dimensao.ds_largura')->where('sku.cd_nr_sku', '=', $request->sku)->where('img_produto.ic_img_principal', '=', 1)->get()->toArray();

        $response = [
            'variation' => $variation
        ];

        return response()->json($response);
    }

    public function listaProduto()
    {
        //$produtos = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')->where('produto.cd_status_produto', '=', 1)->paginate(25);
        $produtos = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')->paginate(25);
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

        $menuNav =  Menu::all();

        $menuNavegacao = NavigationMenu::all();
        //dd($menuNavegacao[0]->menu_ativo);
        if(count($menuNavegacao) > 0) {
            if ($menuNavegacao[0]->menu_ativo == 1) {
                //Carrega as categorias e subcategorias para serem apresentadas no menu nav
                foreach ($menuNav as $key => $menu) {
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
            } else {
                $categoriaSubCat = Category::leftJoin('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                    ->leftJoin('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
                    ->select(
                        'categoria.cd_categoria',
                        'categoria.nm_categoria',
                        'sub_categoria.cd_sub_categoria',
                        'sub_categoria.nm_sub_categoria'
                    )
                    ->get();
            }
        }


        return view('pages.admin.cadProdutoVariacao', compact('categorias', 'cores', 'tamanhosLetras', 'tamanhosNumeros', 'ultimoProduto', 'menuNav', 'categoriaSubCat', 'menuNavegacao'));
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

    public function cadastrarProdutosBling(Request $request)
    {

        //dd($request->images);

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
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            $sku = $this->createSku($request->cd_sku, $dimensao->cd_dimensao);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            $produto = $this->createProduct($request->cd_ean, $request->nm_produto, $request->ds_produto, $val, $request->qt_produto, $status, $sku->cd_sku, $slugname);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            $this->associateProductCategorySubcategory($produto->cd_produto, $this->getCategorySubcategoryId($request->cd_categoria, $request->cd_sub_categoria));
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            //dd($request->images);
            if ($request->images != null) {

                //Cria o caminho físico das imagens
                $images = $request->images;
                $imagePath = $this->pastaProduto($this->getCategoryName($request->cd_categoria), $this->getSubcategoryName($request->cd_sub_categoria));
                $dbPath = $this->getCategoryName($request->cd_categoria) . '/' . $this->getSubcategoryName($request->cd_sub_categoria);

                //dd($images);
                $namesOfImage = [];
                $localImagesPath = [];
                for ($i = 0; $i<count($images); $i++) {
                    $ext = 'jpeg';
                    $imageName = $request->cd_sku . '_' . ($i + 1) . '.' . $ext;
                    array_push($namesOfImage, $imageName);
                    $caminho = $dbPath . '/' . $imageName;
                    array_push($localImagesPath, $caminho);
                }

                for ($i = 0; $i<count($images); $i++) {
                    file_put_contents($imagePath . '/' . $namesOfImage[$i], file_get_contents($images[$i]));
                }


                for ($i = 0; $i < count($images); $i++) {
                    if ($i == 0) {
                        $img = $this->createImage($localImagesPath[$i], 1);
                    } else {
                        $img = $this->createImage($localImagesPath[$i], 0);
                    }

                    $skuImagem = $this->associateSkuImage($sku->cd_sku, $img->cd_img);
                    $imgsPath = $img->im_produto;
                }
            } else {
                $img = $this->createImage('semprodutoview.png', 1);
                $skuImagem = $this->associateSkuImage($sku->cd_sku, $img->cd_img);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            //$this->deleteImageFile($imgsPath);
        }

        DB::commit();
        //return redirect()->route('products.list')->with('success', 'Produtos do Bling cadastrados com sucesso');
        return response()->json([
            'message' => 'produto cadastrado'
        ]);
    }

    //consulta o sku antes de cadastrar os produtos no bling
    public function consultaSku(Request $request)
    {
        //dd($request->all());

        $resultado = DB::table('sku')
                        ->select('cd_nr_sku')
                        ->where('cd_nr_sku', '=', $request->cd_sku)
                        ->get();

        if (count($resultado) == 0) {
            return response()->json([
                'message' => false
                ]);
        }

        return response()->json([
           'message' => true
        ]);
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

    public function apagarImagem(Request $request){
        //dd($request->all());

        $img = DB::table('img_produto')
            ->where('im_produto', '=', $request->img_path)
            ->get();

        $sku_produto = DB::table('sku')
            ->join('sku_produto_img', 'sku_produto_img.cd_sku', '=', 'sku.cd_sku')
            ->join('img_produto', 'img_produto.cd_img', '=', 'sku_produto_img.cd_img')
            ->where('sku.cd_nr_sku', '=', $request->cd_sku)
            ->get();

        try{
            //dd($request->all());

            if($request->img_path == 'semprodutoview.png'){
                //dd($request->img_path);
                if (count($sku_produto) > 1) {
                    if ($sku_produto[0]->im_produto == $request->img_path) {
                        DB::table('img_produto')
                            ->where('im_produto', '=', $sku_produto[1]->im_produto)
                            ->update(['ic_img_principal' => 1]);
                    }
                }

                DB::table('sku_produto_img')
                    ->where('cd_img', '=', $img[0]->cd_img)
                    ->where('cd_sku', '=', $sku_produto[0]->cd_sku)
                    ->delete();
            }
            else {
                $this->deleteImageFile($request->img_path);

                //dd($sku_produto, $sku_produto[0]->im_produto, $request->img_path);

                if (count($sku_produto) > 1) {
                    if ($sku_produto[0]->im_produto == $request->img_path) {
                        DB::table('img_produto')
                            ->where('im_produto', '=', $sku_produto[1]->im_produto)
                            ->update(['ic_img_principal' => 1]);
                    }
                } else {
                    $img_none = $this->createImage('semprodutoview.png', 1);
                    $skuImagem = $this->associateSkuImage($sku_produto[0]->cd_sku, $img_none->cd_img);
                }

                DB::table('sku_produto_img')
                    ->where('cd_img', '=', $img[0]->cd_img)
                    ->where('cd_sku', '=', $sku_produto[0]->cd_sku)
                    ->delete();
                DB::table('img_produto')->where('cd_img', '=', $img[0]->cd_img)->delete();
            }

        }
        catch(\Exception $ex){
            return response()->json([
                'deuErro' => true
            ]);
        }

        return response()->json([
            'deuErro' => false
        ]);
    }

    public function atualizarImagemPrincipal(Request $request){

        try {
            DB::table('img_produto')
                ->join('sku_produto_img', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
                ->join('sku', 'sku.cd_sku', '=', 'sku_produto_img.cd_sku')
                ->where('sku.cd_nr_sku', '=', $request->cd_nr_sku)
                ->where('img_produto.im_produto', '=', $request->img_prod)
                ->update(['img_produto.ic_img_principal' => 1]);

            DB::table('img_produto')
                ->join('sku_produto_img', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
                ->join('sku', 'sku.cd_sku', '=', 'sku_produto_img.cd_sku')
                ->where('sku.cd_nr_sku', '=', $request->cd_nr_sku)
                ->where('img_produto.im_produto', '<>', $request->img_prod)
                ->update(['img_produto.ic_img_principal' => 0]);
        }
        catch (\Exception $ex){
            return response()->json([
                "deuErro" => true
            ]);
        }

        return response()->json([
            "deuErro" => false
        ]);

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
            mkdir($p1 . '/' . $subcategoria, 0755, true);
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

        $categoryName = $this->removeSpecialCharacters($category->nm_categoria);

        return strtolower(str_replace(' ', '', $categoryName));
    }

    //Retorna o nome da Subcategoria fazendo a pesquisa pelo Código
    public function getSubcategoryName($codSubcategory)
    {
        $subcategory = Category::join('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')->join('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')->select('sub_categoria.nm_sub_categoria')->where('categoria_subcat.cd_sub_categoria', '=', $codSubcategory)->first();

        $subcategoryName = $this->removeSpecialCharacters($subcategory->nm_sub_categoria);

        return strtolower(str_replace(' ', '', $subcategoryName));
    }

    public function removeSpecialCharacters($palavra)
    {
        $caracteresEspeciais = [ 'á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'â' => 'a', 'Â' => 'A', 'é' => 'e', 'É' => 'E', 'ê' => 'e', 'Ê' => 'E', 'í' => 'i', 'Í' => 'i', 'ó' => 'o', 'Ó' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ô' => 'o', 'Ô' => 'O', 'ú' => 'u', 'Ú' => 'U', 'ü' => 'u', 'Ü' => 'U', 'ç' => 'c' ];

        return strtr($palavra, $caracteresEspeciais);
    }

    //Seleciona o id correspondente dos forms categoria e subcategoria na tabela categoria_subcat
    public function getCategorySubcategoryId($codCategoria, $codSubcategoria)
    {
        $prod_cat_subcat = DB::table('categoria_subcat')->select('cd_categoria_subcat')->where('cd_categoria', '=', $codCategoria)->where('cd_sub_categoria', '=', $codSubcategoria)->first();

        return $prod_cat_subcat->cd_categoria_subcat;
    }

    //=============================================================================================
    //FUNÇÃO QUE ATUALIZA OS DADOS DOS PRODUTOS
    public function productUpdate($eanProd, $nomeProd, $descProd, $valorProd, $qtProd, $statusProd, $sku, $slugname)
    {
        $codSku = Sku::where('cd_nr_sku', '=', $sku)->get();

        $produto =Product::where('cd_sku', '=', $codSku[0]->cd_sku)->get();

        //dd($produto);
        $produto[0]->cd_ean = $eanProd;
        $produto[0]->nm_produto = $nomeProd;
        $produto[0]->ds_produto = $descProd;
        $produto[0]->nm_slug = $slugname;
        $produto[0]->vl_produto = $valorProd;
        $produto[0]->qt_produto = $qtProd;
        $produto[0]->cd_status_produto = $statusProd;

        $produto[0]->save();

        return $produto[0]->cd_produto;
    }

    //=============================================================================================
    //FUNÇÃO QUE ATUALIZA A ASSOCIAÇÃO DAS CATEGORIAS DO PRODUTO
    public function updateAssociationProductCategorySubcategory($codProduto, $codCategoriaSubCategoria)
    {
        $prodCatSub = DB::table('produto_categoria_subcat')
                        ->where('cd_produto', '=', $codProduto)
                        ->update(['cd_categoria_subcat' => $codCategoriaSubCategoria]);

        //dd($prodCatSub[0]->cd_categoria_subcat, $codCategoriaSubCategoria);
        //$prodCatSub[0]->cd_categoria_subcat = $codCategoriaSubCategoria;
        //dd($prodCatSub[0]->cd_categoria_subcat);
        //$prodCatSub[0]->save();
    }

    //=============================================================================================
    //FUNÇÃO QUE ATUALIZA A DIMENSÃO DOS PRODUTOS
    public function updateDimension($largura, $altura, $comprimento, $peso, $sku)
    {
        $dimensionData =DB::table('sku')
            ->join('dimensao', 'sku.cd_dimensao', '=', 'dimensao.cd_dimensao')
            ->where('sku.cd_nr_sku', '=', $sku)
            ->get();

        //dd($dimensionData[0]->cd_nr_sku);

        $dimension = Dimension::find($dimensionData[0]->cd_dimensao);
        $dimension->ds_altura = $altura;
        $dimension->ds_largura = $largura;
        $dimension->ds_comprimento = $comprimento;
        $dimension->ds_peso = $peso;

        $dimension->save();
    }


    //Chama a função para atualizar a quantidade dos produtos
    public function updateProduct(ProductRequest $request)
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

        //=============================================================================================
        //ATUALIZA A DIMENSÃO DOS PRODUTOS
        try {
            $dimensao = $this->updateDimension($request->ds_largura, $request->ds_altura, $request->ds_comprimento, $request->ds_peso, $request->cd_sku);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('products.list')->with('nosuccess', 'Erro ao atualizar tamanho do produto');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('products.list')->with('nosuccess', 'Erro ao atualizar tamanho do produto');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('products.list')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        //=============================================================================================
        //ATUALIZA OS DADOS DO PRODUTO
        try {
            $produto = $this->productUpdate($request->cd_ean, $request->nm_produto, $request->ds_produto, $val, $request->qt_produto, $status, $request->cd_sku, $slugname);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('products.list')->with('nosuccess', 'Erro ao atualizar o produto');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('products.list')->with('nosuccess', 'Erro ao atualizar o produto');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('products.list')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        //=============================================================================================
        //ATUALIZA A ASSOCIAÇÃO DA CATEORIA E SUBCATEGORIA DO PRODUTO
        try {
            $this->updateAssociationProductCategorySubcategory($produto, $this->getCategorySubcategoryId($request->cd_categoria, $request->cd_sub_categoria));
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('products.list')->with('nosuccess', 'Erro ao atualizar a associação da categoria do produto');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('products.list')->with('nosuccess', 'Erro ao atualizar a associação da categoria do produto');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('products.list')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        //=============================================================================================
        //SALVA NOVAS IMAGENS AO PRODUTO

        $qtd_images = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')
            ->join('sku_produto_img', 'sku.cd_sku', '=', 'sku_produto_img.cd_sku')
            ->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
            ->select(
                'sku.cd_sku',
                'img_produto.cd_img',
                'img_produto.im_produto',
                'img_produto.ic_img_principal')
            ->where('sku.cd_nr_sku', '=', $request->cd_sku)
            ->orderBy('img_produto.cd_img')
            ->get();


        try {
            if ($request->hasFile('images')) {

                //dd(count($request->images));
                //dd($request->cd_sku);
                //Cria o caminho físico das imagens
                $images = $request->images;
                $imagePath = $this->pastaProduto($this->getCategoryName($request->cd_categoria), $this->getSubcategoryName($request->cd_sub_categoria));
                $dbPath = $this->getCategoryName($request->cd_categoria) . '/' . $this->getSubcategoryName($request->cd_sub_categoria);


                if(count($qtd_images) > 0) {
                    $num_img = count($qtd_images);
                    $contador = $num_img;
                    //dd($num_img);

                    //dd($qtd_images);

                    foreach ($images as $key => $image) {
                        $ext = $image->getClientOriginalExtension();
                        $imageName = $request->cd_sku . '_' . ($contador + 1) . '.' . $ext;
                        $caminhoImagem = $dbPath.'/'.$imageName;

                        $erro = false;

                        do {

                            $erro = false;
                            foreach ($qtd_images as $qtd) {
                                //dd($qtd->im_produto, $caminhoImagem);
                                if ($qtd->im_produto == $caminhoImagem) {
                                    $contador++;
                                    $imageName = $request->cd_sku . '_' . ($contador + 1) . '.' . $ext;
                                    $caminhoImagem = $dbPath . '/' . $imageName;
                                    $erro = true;
                                }
                            }

                        }while($erro == true);


                        //dd($imageName);
                        //dd($dbPath);
                        //dd($dbPath.'/'.$imageName);
                        $realPath = $image->getRealPath();
                        //dd($realPath);
                        $this->saveImageFile($imagePath, $imageName, $realPath);

                        $localImagesPath[$key] = $dbPath . '/' . $imageName;
                        //dd($localImagesPath[$key]);
                        $contador++;
                    }

                    //dd($localImagesPath);

                    foreach ($localImagesPath as $key => $dbImage) {
                        if ($num_img == 0) {
                            $img = $this->createImage($dbImage, 1);
                        } else {
                            $img = $this->createImage($dbImage, 0);
                        }

                        //dd($request->cd_sku);
                        //dd($qtd_images[0]->cd_sku);
                        //dd($img->cd_img);

                        $skuImagem = $this->associateSkuImage($qtd_images[0]->cd_sku, $img->cd_img);

                        //dd($skuImagem);

                        $imgsPath[$key] = $img->im_produto;
                    }
                }else {
                    $qtd_images = Product::join('sku', 'sku.cd_sku', '=', 'produto.cd_sku')
                                    ->where('sku.cd_nr_sku', '=', $request->cd_sku)
                                    ->get();

                    //dd($qtd_images);

                    $img = $this->createImage('semprodutoview.png', 1);
                    $skuImagem = $this->associateSkuImage($qtd_images[0]->cd_sku, $img->cd_img);

                }
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

        //return redirect()->route('products.list')->with('success', 'Produto Atualizado com Sucesso');
        return redirect()->back()->with('success', 'Produto Atualizado com Sucesso');
    }

    public function consultaProduto(Request $request){
        //dd($request->all());

        $produto = Product::join('sku', 'sku.cd_sku', '=', 'produto.cd_sku')
                ->select('produto.cd_produto', 'produto.nm_produto', 'produto.vl_produto',
                    'produto.qt_produto', 'sku.cd_nr_sku')
                ->where('produto.nm_produto', 'like', '%'. $request->searchData .'%')
                ->orWhere('sku.cd_nr_sku', '=', $request->searchData)
                ->orderBy('produto.cd_produto')
                ->get();
        //dd($produto);

        if($request->searchData == null)
            $produto = $produto->take(25);

        return $produto;
    }

    public function updateBlingProduct(Request $request){
        
        //dd($request->all());

        $v = strpos($request->vl_produto, ',');

        $slugname = str_slug($request->nm_produto, '-');

        if ($v !== false) {
            $val = str_replace(',', '.', $request->vl_produto);
        } else {
            $val = $request->vl_produto;
        }

        
        $status = 1;

        DB::beginTransaction();

        //=============================================================================================
        //ATUALIZA A DIMENSÃO DOS PRODUTOS
        try {
            $dimensao = $this->updateDimension($request->ds_largura, $request->ds_altura, $request->ds_comprimento, $request->ds_peso, $request->cd_sku);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('products.list')->with('nosuccess', 'Erro ao atualizar tamanho do produto');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('products.list')->with('nosuccess', 'Erro ao atualizar tamanho do produto');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('products.list')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        //=============================================================================================
        //ATUALIZA OS DADOS DO PRODUTO
        try {
            $produto = $this->productUpdate($request->cd_ean, $request->nm_produto, $request->ds_produto, $val, $request->qt_produto, $status, $request->cd_sku, $slugname);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('products.list')->with('nosuccess', 'Erro ao atualizar o produto');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('products.list')->with('nosuccess', 'Erro ao atualizar o produto');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('products.list')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('products.list')->with('success', 'Produto Atualizado com Sucesso');
    }

    public function getProductData(Request $request)
    {
        $resultado = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')
            ->join('dimensao', 'sku.cd_dimensao', '=', 'dimensao.cd_dimensao')
            ->join('produto_categoria_subcat', 'produto.cd_produto', '=', 'produto_categoria_subcat.cd_produto')
            ->join('categoria_subcat', 'produto_categoria_subcat.cd_categoria_subcat', '=', 'categoria_subcat.cd_categoria_subcat')
            ->join('categoria', 'categoria_subcat.cd_categoria', '=', 'categoria.cd_categoria')
            ->join('sub_categoria', 'categoria_subcat.cd_sub_categoria', '=', 'sub_categoria.cd_sub_categoria')
            ->select(
                'produto.nm_produto',
                    'produto.cd_ean',
                    'produto.ds_produto',
                    'produto.vl_produto',
                    'produto.qt_produto',
                    'produto.cd_status_produto',
                    'sku.cd_nr_sku',
                    'dimensao.ds_altura',
                    'dimensao.ds_largura',
                    'dimensao.ds_peso',
                    'dimensao.ds_comprimento',
                    'categoria.cd_categoria',
                    'categoria.nm_categoria',
                    'sub_categoria.cd_sub_categoria',
                    'sub_categoria.nm_sub_categoria'
            )
            ->where('sku.cd_nr_sku', '=', $request->sku)
            ->get();

        $images = Product::join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')
            ->join('sku_produto_img', 'sku.cd_sku', '=', 'sku_produto_img.cd_sku')
            ->join('img_produto', 'sku_produto_img.cd_img', '=', 'img_produto.cd_img')
            ->select('img_produto.im_produto', 'img_produto.ic_img_principal')
            ->where('sku.cd_nr_sku', '=', $resultado[0]['cd_nr_sku'])
            ->orderBy('sku_produto_img.cd_img')
            ->get()
            ->toArray();

        //dd($images);
        //dd($resultado);

        $dados = ["0" => $resultado, "1" => $images];
        //dd($dados);

        return $dados;
    }

    public function getCategory()
    {
        $resultado = Category::all();

        //dd($resultado);
        return response()->json([
            "categoria" => $resultado
        ]);
    }

    public function getSubCategory(){
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
