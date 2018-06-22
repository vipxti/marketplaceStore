<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategorySubcategoryRequest;
use App\Http\Requests\SubCategoryRequest;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller {
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

    public function crudCategoria(CategoryRequest $request) {
        //dd($request->all());
        if($request->cd_categoria == NULL ){
            $this->novaCat($request->nm_categoria);
        }
        elseif($request->delCat == 1){
            $this->delCat($request->cd_categoria);
        }
        else{
            $this->atualizarCat ($request->cd_categoria, $request->nm_categoria);
        }
    }
    public function crudSubCategoria(SubCategoryRequest $request) {
        dd($request->all());
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

    public function novaCat ($nomeCategoria){
        try {
            Category::create([
                'nm_categoria' => $nomeCategoria
            ]);
        }
        catch (\Exception $e) {
            return redirect()->route('category.register')->with('nosuccess', 'Erro ao Cadadastrar a Categoria');
        }
        finally {return redirect()->route('category.register')->with('success', 'Categoria cadastrada com Sucesso');
        }
    }
    public function atualizarCat ($codigoCategoria,$nomeCategoria ){
        try{
            $categoria = Category::find($codigoCategoria);
            $categoria-> nm_categoria = $nomeCategoria;
            $categoria->save();

        }
        catch (\Exception $e) {
            return redirect()->route('category.register')->with('nosuccess', 'Erro ao Alterar a Categoria');
        }
        finally {
            return redirect()->route('category.register')->with('success', 'Categoria Alterada com Sucesso');
        }
    }
    public function delCat ($cdCategoria){
        try {

            DB::table('categoria_subcat')-> where('cd_categoria', '=', $cdCategoria)->delete();
            Category::destroy($cdCategoria);
        }
        catch (\Exception $e) {
            return redirect()->route('category.register')->with('nosuccess', 'Erro ao Deletar a Categoria');
        }
        finally {
            return redirect()->route('category.register')->with('success', 'Categoria Deletada com Sucesso');
        }
    }
}
