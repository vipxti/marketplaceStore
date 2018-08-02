<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function companyTerms(){
        return view('pages.app.terms.index');
    }
}
