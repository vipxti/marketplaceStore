<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function cadCompany(){
        return view('pages.admin.Order');
    }
}
