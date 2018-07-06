<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function cadCompany(){
        return view('pages.admin.cadDadosEmpresa');
    }
}
