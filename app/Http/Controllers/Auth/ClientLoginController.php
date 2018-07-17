<?php

namespace App\Http\Controllers\Auth;

use App\Category;
use App\Http\Controllers\Controller;
use App\Menu;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ClientLoginRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ClientLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('clientLogout', 'userLogout');
    }

    public function showClientLoginForm()
    {
        $menuNav =  Menu::all();

        //Carrega as categorias e subcategorias para serem apresentadas no menu nav
        foreach($menuNav as $key=>$menu){

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

        return view('pages.app.auth.login', compact('menuNav', 'categoriaSubCat'));
    }

    public function login(ClientLoginRequest $request)
    {
        if (Session::has('cartRoute')) {
            $route = Session::get('cartRoute');
        } else {
            $route = 'client.dashboard';
        }

        //dd($route);

        //Faz o login do cliente
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {
            //Redireciona o cliente caso consiga logar
            Session::forget('cartRoute');
            return redirect()->route($route)->with('success', 'Bem vindo');
        }

        //Retorna para a tela de login com o campo email preenchido
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('nosuccess', 'Usuário ou senha incorretos');
    }

    public function clientLogout()
    {
        Auth::guard('web')->logout();

        return redirect()->route('client.login');
    }
}
