<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function listOrder(){
        return view('pages.admin.listOrder');
    }
}
