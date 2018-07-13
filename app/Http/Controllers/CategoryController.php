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
    public function showCategoryForm()
    {
        $categorias = Category::all();
        $subcategorias = SubCategory::all();
        return view('pages.admin.category.register', compact('categorias', 'subcategorias'));
    }

    public function selectSubCategory($cd_categoria)
    {
        $subCategorias = DB::table('categoria')
                        ->join('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                        ->join('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
                        ->select('sub_categoria.cd_sub_categoria', 'sub_categoria.nm_sub_categoria')
                        ->where('categoria.cd_categoria', '=', $cd_categoria)
                        ->get();
        return response()->json([ 'subcat' => $subCategorias ]);
    }

    public function crudCategoria(CategoryRequest $request)
    {
        //dd($request->all());
        if ($request->cd_categoria == null) {
            try {
                $this->novaCat($request->nm_categoria);
            } catch (\Exception $e) {
                return redirect()->route('category.register')->with('nosuccess', 'Erro ao Cadadastrar a Categoria');
            } finally {
                return redirect()->route('category.register')->with('success', 'Categoria cadastrada com Sucesso');
            }
        } elseif ($request->delCat == 1) {

            $resultado = $this->delCat($request->cd_categoria);

            if(count($resultado) == 0){
                return response()->json([
                    'message' => false
                ]);
            }

            return response()->json([
                'message' => true
            ]);
           /* try {

            } catch (\Exception $e) {

                //return redirect()->route('category.register')->with('nosuccess', 'Erro ao Deletar a Categoria');
            }*/ /*finally {

                //return redirect()->route('category.register')->with('success', 'Categoria Deletada com Sucesso');
            }*/

        } else {
            try {
                $this->atualizarCat($request->cd_categoria, $request->nm_categoria);
            } catch (\Exception $e) {
                return redirect()->route('category.register')->with('nosuccess', 'Erro ao Alterar a Categoria');
            } finally {
                return redirect()->route('category.register')->with('success', 'Categoria Alterada com Sucesso');
            }
        }
    }
    public function novaCat($nomeCategoria)
    {
        Category::create([
            'nm_categoria' => $nomeCategoria
        ]);
    }
    public function atualizarCat($codigoCategoria, $nomeCategoria)
    {
        $categoria = Category::find($codigoCategoria);
        $categoria-> nm_categoria = $nomeCategoria;
        $categoria->save();
    }
    public function delCat($cdCategoria)
    {
        $resultado = DB::table('categoria')->select('cd_categoria')-> where('cd_categoria', '=', $cdCategoria)->get();

        if(count($resultado) != 0){
            DB::table('categoria_subcat')-> where('cd_categoria', '=', $cdCategoria)->delete();
            Category::destroy($cdCategoria);
        }

        return $resultado;

    }

    public function crudSubCategoria(SubCategoryRequest $request)
    {
        //dd($request->all());
        if ($request->cd_sub_categoria == null) {
            try {
                $this->novaSubCat($request->nm_sub_categoria);
            } catch (\Exception $e) {
                return redirect()->route('category.register')->with('nosuccess', 'Erro ao Cadastrada a Sub-Categoria');
            } finally {
                return redirect()->route('category.register')->with('success', 'Sub-Categoria Cadastrada com Sucesso');
            }
        } elseif ($request->delSubCat == 1) {

            $resultado = $this->delSubCat($request->cd_sub_categoria);
            //dd($resultado);
            if (count($resultado) == 0){
                return response()->json([
                    'message' => false
                ]);
            }

            return response()->json([
                'message' => true
            ]);

           /* try {
                $this->delSubCat($request->cd_sub_categoria);
            } catch (\Exception $e) {

                //return redirect()->route('category.register')->with('nosuccess', 'Erro ao Deletar a Sub-Categoria');
            }*/ /*finally {

                //return redirect()->route('category.register')->with('success', 'Sub-Categoria Deletada com Sucesso');
            }*/


        } else {
            try {
                $this->atualizaSubCat($request->cd_sub_categoria, $request->nm_sub_categoria);
            } catch (\Exception $e) {
                return redirect()->route('category.register')->with('nosuccess', 'Erro ao Alterar  a Sub-Categoria');
            } finally {
                return redirect()->route('category.register')->with('success', 'Sub-Categoria Alterada com Sucesso');
            }
        }
    }
    public function novaSubCat($nomeSubCategoria)
    {
        SubCategory::create([
            'nm_sub_categoria' => $nomeSubCategoria
        ]);
    }
    public function atualizaSubCat($codigoSubCategoria, $nomeSubCategoria)
    {
        $subCategoria = SubCategory::find($codigoSubCategoria);
        $subCategoria-> nm_sub_categoria=$nomeSubCategoria;
        $subCategoria->save();
    }
    public function delSubCat($cdSubCategoria)
    {
        //dd($cdSubCategoria);
        $resultado = DB::table('sub_categoria')->select('cd_sub_categoria')-> where('cd_sub_categoria', '=', $cdSubCategoria)->get();

        if(count($resultado) != 0){
            DB::table('categoria_subcat')-> where('cd_sub_categoria', '=', $cdSubCategoria)->delete();
            SubCategory::destroy($cdSubCategoria);
        }

        return $resultado;
    }

    public function associarCategoriaSubCategoria(CategorySubcategoryRequest $request)
    {
        foreach ($request->cd_sub_categorias as $cd_subcategoria) {
            try {
                DB::table('categoria_subcat')->insert([
                    'cd_categoria' => $request->cd_categoria,
                    'cd_sub_categoria' => $cd_subcategoria
                ]);
            } catch (\Exception $e) {
                return redirect()->route('category.register')->with('nosuccess', 'Erro ao realizar a associação');
            }
        }
        return redirect()->route('category.register')->with('success', 'Associações realizadas com sucesso');
    }
}
