<?php

namespace App\Http\Controllers;

use App\Http\Requests\SizeRequest;
use App\Size;

class SizeController extends Controller
{
    public function showSizeForm() {
        return view('pages.admin.cadTamanho');
    }

    public function cadastrarNovoTamanho(SizeRequest $request) {
        $tamanho = Size::create([
            'nm_tamanho' => $request->nm_tamanho
        ]);

        if ($tamanho) {
            return redirect()->route('admin.cadTamanho');
        }
    }
}
