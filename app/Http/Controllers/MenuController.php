<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\NavigationMenuRequest;
use App\Menu;
use App\Http\Requests\MenuRequest;
use App\Http\Requests\MenuCategoryRequest;
use App\NavigationMenu;
use App\SubMenu;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function showEditMenuPage() {

        $menus = Menu::all();
        $categorias = Category::all();
        $menuNavegacao = NavigationMenu::all();
        $menuNavegacao = $menuNavegacao->toArray()[0]['menu_ativo'];

        return view('pages.admin.indexMenu', compact('menus', 'categorias', 'menuNavegacao'));

    }

    public function controleMenuNav(NavigationMenuRequest $request){

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

            try {
                DB::table('menu_categoria')->insert([
                    'fk_cd_menu' => $request->fk_cd_menu,
                    'fk_cd_categoria' => $cd_categoria
                ]);
            } catch (\Exception $e) {
                return redirect()->route('menu.edit')->with('nosuccess', 'Erro ao realizar a associação');
            }
        }
        return redirect()->route('menu.edit')->with('success', 'Associações realizadas com sucesso');
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
