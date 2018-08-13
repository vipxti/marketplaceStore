<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\NavigationMenuRequest;
use App\Menu;
use App\Http\Requests\MenuRequest;
use App\Http\Requests\MenuCategoryRequest;
use App\NavigationMenu;
use App\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function showEditMenuPage() {

        $menus = Menu::all();
        $categorias = Category::all();
        $menuNavegacao = NavigationMenu::all();

        if(count($menuNavegacao) != 0){
            $menuNavegacao = $menuNavegacao->toArray()[0]['menu_ativo'];
        }

        return view('pages.admin.indexMenu', compact('menus', 'categorias', 'menuNavegacao'));

    }

    public function salvarOrdemCategoria(Request $request){
        //dd($request->all());

        if($request->codVerificador == 1){
            DB::table('ordem_categoria')->delete();
        }

        $ordem = DB::table('ordem_categoria')
                    ->where('fk_cd_categoria', '=', $request->fk_cd_categoria)
                    ->get();

        if(count($ordem) > 0){
            return response()->json([
                'deuErro' => true
            ]);
        }
        else{
            if($request->fk_cd_categoria != '') {
                DB::table('ordem_categoria')->insert([
                    'cd_ordem_categoria' => $request->ordem_categoria,
                    'fk_cd_categoria' => $request->fk_cd_categoria
                ]);
            }
        }

        return response()->json([
            'deuErro' => false
        ]);
    }

    public function consultarOrdemCategorias(){
        $resultado = DB::table('ordem_categoria')->get();

        //dd($resultado);

        return response()->json([
            "ordem" => $resultado
        ]);
    }

    public function controleMenuNav(NavigationMenuRequest $request){

        $menuNavegacao = NavigationMenu::all();

        if(count($menuNavegacao) == 0){
            try{
                NavigationMenu::firstOrCreate([
                    'menu_ativo' => $request->menu_ativo
                ]);
                $mensagem = "sucesso";
            }
            catch(\Exception $ex){
                $mensagem = "erro";
            }
        }
        else{
            try{
                DB::table('menu_ou_categoria')
                    ->where('menu_ativo', '=', $menuNavegacao->toArray()[0]['menu_ativo'])
                    ->update(['menu_ativo' => $request->menu_ativo]);

                $mensagem = "sucesso";
            }
            catch(\Exception $ex){
                $mensagem = "erro";
            }

        }

        return response()->json([
            "message" => $mensagem
        ]);

    }

    public function crudMenu(MenuRequest $request)
    {

        if ($request->cd_menu == null) {
            try {
                $salvouMenu = $this->novoMenu($request->nm_menu);

                if(!$salvouMenu){
                    return redirect()->route('menu.edit')->with('nosuccess', 'Permitido No Máximo 5 Menus');
                }

            } catch (\Exception $e) {
                return redirect()->route('menu.edit')->with('nosuccess', 'Erro ao Cadadastrar o Menu');
            }

            return redirect()->route('menu.edit')->with('success', 'Menu cadastrado com Sucesso');

        } elseif ($request->delCat == 1) {

            $resultado = $this->delMenu($request->cd_menu);

            if(count($resultado) == 0){
                return redirect()->route('menu.edit')->with('nosuccess', 'Erro ao Deletar o Menu');
            }

            return redirect()->route('menu.edit')->with('success', 'Menu Deletado com Sucesso');

        } else {
            try {
                $this->atualizarMenu($request->cd_menu, $request->nm_menu);
            } catch (\Exception $e) {
                return redirect()->route('menu.edit')->with('nosuccess', 'Erro ao Alterar o Menu');
            } finally {
                return redirect()->route('menu.edit')->with('success', 'Menu Alterado com Sucesso');
            }
        }
    }

    public function novoMenu($nomeMenu)
    {
        $qtd_menus = $this->consultaMenu();

        //dd(count($qtd_menus));
        $salvouMenu = false;

        if(count($qtd_menus) < 5){
            Menu::create([
                'nm_menu' => $nomeMenu
            ]);

            $salvouMenu = true;
        }

        return $salvouMenu;
    }

    public function consultaMenu(){

        $qtd_menus = Menu::all();

        return $qtd_menus;
    }

    public function atualizarMenu($codigoMenu, $nomeMenu)
    {
        $menu = Menu::find($codigoMenu);
        //dd($menu);
        $menu->nm_menu= $nomeMenu;
        $menu->save();
    }

    public function delMenu($cdMenu)
    {
        $resultado = DB::table('menu')->select('cd_menu')-> where('cd_menu', '=', $cdMenu)->get();

        if(count($resultado) != 0){
            DB::table('menu_categoria')-> where('fk_cd_menu', '=', $cdMenu)->delete();
            Menu::destroy($cdMenu);
        }

        return $resultado;

    }

    public function associarMenuCategoria(MenuCategoryRequest $request)
    {

        foreach ($request->fk_cd_categorias as $cd_categoria) {

            $temAssociacao =  $this->consultaAssociacaoMenus($request->fk_cd_menu, $cd_categoria);

            if(!$temAssociacao) {
                try {
                    DB::table('menu_categoria')->insert([
                        'fk_cd_menu' => $request->fk_cd_menu,
                        'fk_cd_categoria' => $cd_categoria
                    ]);
                } catch (\Exception $e) {
                    return redirect()->route('menu.edit')->with('nosuccess', 'Erro ao realizar a associação');
                }
            }
            else{
                return redirect()->route('menu.edit')->with('nosuccess', 'Associação '.$request->fk_cd_menu.' -> '.$cd_categoria.' já é existente.');
            }
        }
        return redirect()->route('menu.edit')->with('success', 'Associações realizadas com sucesso');
    }

    public function consultaAssociacaoMenus($cd_menu, $cd_categoria){

        $menu = DB::table('menu_categoria')
            ->where('fk_cd_menu', '=', $cd_menu)
            ->where('fk_cd_categoria', '=', $cd_categoria)
            ->get();

        if(count($menu) > 0)
            $temAssociacao = true;
        else
            $temAssociacao = false;

        return $temAssociacao;

    }

    public function saveMenus(MenuRequest $request) {


        if ($request->nm_menu1 != null) {

            Menu::create([

                'nm_menu' => $request->nm_menu1

            ]);

            if ($request->has('nm_sub_menu1')) {

                foreach ($request->nm_sub_menu1 as $submenu) {

                    SubMenu::create([

                        'nm_sub_menu' => $submenu

                    ]);

                }

            }

        }

        if ($request->nm_menu2 != null) {

            Menu::create([

                'nm_menu' => $request->nm_menu2

            ]);

            if ($request->has('nm_sub_menu2')) {

                foreach ($request->nm_sub_menu2 as $submenu) {

                    SubMenu::create([

                        'nm_sub_menu' => $submenu

                    ]);

                }

            }

        }

        if ($request->nm_menu3 != null) {

            Menu::create([

                'nm_menu' => $request->nm_menu3

            ]);

            if ($request->has('nm_sub_menu3')) {

                foreach ($request->nm_sub_menu3 as $submenu) {

                    SubMenu::create([

                        'nm_sub_menu' => $submenu

                    ]);

                }

            }

        }

        if ($request->nm_menu4 != null) {

            Menu::create([

                'nm_menu' => $request->nm_menu4

            ]);

            if ($request->has('nm_sub_menu4')) {

                foreach ($request->nm_sub_menu4 as $submenu) {

                    SubMenu::create([

                        'nm_sub_menu' => $submenu

                    ]);

                }

            }

        }

        if ($request->nm_menu5 != null) {

            Menu::create([

                'nm_menu' => $request->nm_menu5

            ]);

            if ($request->has('nm_sub_menu5')) {

                foreach ($request->nm_sub_menu5 as $submenu) {

                    SubMenu::create([

                        'nm_sub_menu' => $submenu

                    ]);

                }

            }

        }

        return redirect()->back()->with('success', 'Menus atualizados');

    }

}
