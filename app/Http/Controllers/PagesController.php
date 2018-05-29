<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('pages.app.index');
    }

    public function admin()
    {
        return view('pages.admin.index');
    }
}
