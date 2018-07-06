<?php

namespace App\Http\Controllers;

class ProductBlingController extends Controller{

    public function importFromBling(){
        return view('pages.admin.products.integration.bling.listProducts');
    }
}


