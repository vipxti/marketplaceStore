<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showIndexPage()
    {
        return view('pages.app.index');
    }

    public function showIndexAdminPage()
    {
        return view('pages.admin.index');
    }
}
