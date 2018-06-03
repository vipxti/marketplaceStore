<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function showCategoryForm() {
        $categorias = Category::all();

        return view('pages.admin.cadCatego', compact('categorias'));
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

}
