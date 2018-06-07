<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategorySubcategoryRequest;
use App\Http\Requests\SubCategoryRequest;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function showCategoryForm() {
        $categorias = Category::all();
        $subcategorias = SubCategory::all();

        return view('pages.admin.cadCatego', compact('categorias', 'subcategorias'));
    }

    public function selectSubCategory($cd_categoria) {

        $subCategorias = DB::table('categoria')
                        ->join('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                        ->join('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
                        ->select('sub_categoria.cd_sub_categoria', 'sub_categoria.nm_sub_categoria')
                        ->where('categoria.cd_categoria', '=', $cd_categoria)
                        ->get();

        return response()->json([ 'subcat' => $subCategorias ]);

    }

    public function cadastrarCategoria(CategoryRequest $request) {

        //dd($request->all());

        $cat = Category::create([
            'nm_categoria' => $request->nm_categoria
        ]);

        if ($cat) {
            return redirect()->route('admin.cadCatego');
        }

    }

    public function cadastrarSubCategoria(SubCategoryRequest $request) {

        //dd($request->all());

        $subcat = SubCategory::create([
            'nm_sub_categoria' => $request->nm_sub_category
        ]);

        if ($subcat) {
            return redirect()->route('admin.cadCatego');
        }

    }

    public function associarCategoriaSubCategoria(CategorySubcategoryRequest $request) {

        //dd($request->all());

        $assocCatSubcat = DB::table('categoria_subcat')->insert([

                'cd_categoria' => $request->cd_categoria,
                'cd_sub_categoria' => $request->cd_subcategoria

        ]);

        if ($assocCatSubcat) {
            return redirect()->route('admin.cadCatego');
        }

    }

}
