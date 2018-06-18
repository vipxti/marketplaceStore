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

        try {

            Category::create([
                'nm_categoria' => $request->nm_categoria
            ]);

        }
        catch (\Exception $e) {

            return redirect()->route('category.register')->with('nosuccess', 'Erro ao cadadastrar a categoria');

        }
        finally {

            return redirect()->route('category.register')->with('success', 'Categoria cadastrada com sucesso');

        }

    }

    public function cadastrarSubCategoria(SubCategoryRequest $request) {


        try {

            SubCategory::create([
                'nm_sub_categoria' => $request->nm_sub_categoria
            ]);

        }
        catch (\Exception $e) {

            return redirect()->route('category.register')->with('nosuccess', 'Erro ao cadadastrar a subcategoria');

        }
        finally {

            return redirect()->route('category.register')->with('success', 'Subcategoria cadastrada com sucesso');

        }

    }

    public function associarCategoriaSubCategoria(CategorySubcategoryRequest $request) {

        foreach ($request->cd_sub_categorias as $cd_subcategoria) {

            try {

                DB::table('categoria_subcat')->insert([

                    'cd_categoria' => $request->cd_categoria,
                    'cd_sub_categoria' => $cd_subcategoria

                ]);

            }
            catch (\Exception $e) {

                return redirect()->route('category.register')->with('nosuccess', 'Erro ao realizar a associação');

            }

        }

        return redirect()->route('category.register')->with('success', 'Associações realizadas com sucesso');

    }

}
