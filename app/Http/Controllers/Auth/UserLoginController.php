<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserLoginRequest;

class UserLoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('userLogout');
    }

    public function showAdminLoginForm()
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

        return view('pages.admin.auth.login', compact('menuNav', 'categoriaSubCat'));
    }

    public function login(UserLoginRequest $request)
    {

        //Faz o login do usuário
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {

            //Redireciona o usuário caso consiga logar
            return redirect()->intended()->with('success', 'Bem vindo ' . Auth::guard('admin')->user()->nm_usuario);
        }
        
        //Retorna para a tela de login com o campo email preenchido
        return redirect()->back()->withInput($request->only('email'))->with('nosuccess', 'Usuário ou senha incorretos');
    }

    public function userLogout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }
}
