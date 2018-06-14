<?php

namespace App\Http\Controllers;

use App\Http\Requests\PackageRequest;
use App\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function mostrarPaginaEmbalagem(){
        return view('pages.admin.cadEmbalagem');
    }

    public function cadastrarEmbalagem(PackageRequest $request) {

        Package::create([
            'ds_altura' => $request->ds_altura,
            'ds_largura' => $request->ds_largura,
            'ds_peso' => $request->ds_peso
        ]);

    }
}
