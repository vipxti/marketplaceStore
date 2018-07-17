<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\MenuRequest;
use App\Menu;
use App\SubMenu;

class MenuController extends Controller
{
    public function showEditMenuPage() {

        $menus = Menu::all();
        $submenus = SubMenu::all();

        return view('pages.admin.indexMenu', compact('menus', 'submenus'));

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
