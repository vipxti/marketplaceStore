<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showIndexPage()
    {
        $produtos = Product::where('cd_status_produto', '=', 0)->paginate(6);

        return view('pages.app.index', compact('produtos'));
    }

    public function showIndexAdminPage()
    {
        $produtos = Product::all();

        return view('pages.admin.index', compact('produtos'));
    }
}
