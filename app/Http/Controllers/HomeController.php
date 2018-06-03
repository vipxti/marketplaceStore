<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showIndexPage()
    {
        return view('pages.app.index');
    }

    public function showIndexAdminPage()
    {
        $produtos = Product::all();

        return view('pages.admin.index', compact('produtos'));
    }
}
