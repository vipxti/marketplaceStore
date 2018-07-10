<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyDataRequest;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function showCompanyForm(){
        return view('pages.admin.cadDadosEmpresa');
    }

    public function registerComnpany(CompanyDataRequest $request){
        dd($request);
    }
}
