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


        //dd($categorias[0]->cd_categoria);
//        dd($subcategorias);

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

    public function cadastrarAtualizarCategoria(CategoryRequest $request) {
        //dd($request->all());

        if($request->cd_categoria == NULL ){

            try {
                Category::create([
                    'nm_categoria' => $request->nm_categoria
                ]);
            }
            catch (\Exception $e) {
                return redirect()->route('category.register')->with('nosuccess', 'Erro ao Cadadastrar a categoria');
            }
            finally {return redirect()->route('category.register')->with('success', 'Categoria cadastrada com sucesso');
            }
        }
        else{
            try{
                $categoria = Category::find($request->cd_categoria);
                $categoria-> nm_categoria = $request->nm_categoria;
                $categoria->save();

            }
            catch (\Exception $e) {
                dd($e->getMessage());
                return redirect()->route('category.register')->with('nosuccess', 'Erro ao Alterar a categoria');
            }
            finally {
                return redirect()->route('category.register')->with('success', 'Categoria Alterada com sucesso');
            }
        }
    }

    public function cadastrarAtualizarSubCategoria(SubCategoryRequest $request) {
        if($request->cd_sub_categoria == NULL ){
            try {
                SubCategory::create([
                    'nm_sub_categoria' => $request->nm_sub_categoria
                ]);
            }
            catch (\Exception $e) {
                return redirect()->route('category.register')->with('nosuccess', 'Erro ao Cadastrada a Sub-Categoria');
            }
            finally {
                return redirect()->route('category.register')->with('success', 'Sub-Categoria Cadastrada com Sucesso');
            }
        }
        else{
            try{
                $subCategoria = Category::where('cd_sub_categoria', '=', $request->cd_sub_categoria);
                $subCategoria-> nm_sub_categoria=$request->nm_sub_categoria;
                $subCategoria->save();
            }
            catch (\Exception $e) {
                return redirect()->route('category.register')->with('nosuccess', 'Erro ao Alterar  a Sub-Categoria');
            }
            finally {
                return redirect()->route('category.register')->with('success', 'Sub-Categoria Alterada com Sucesso');
            }
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
