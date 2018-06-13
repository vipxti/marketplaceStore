<?php

namespace App\Http\Controllers;

use App\Http\Requests\LetterSizeRequest;
use App\Http\Requests\NumberSizeRequest;
use App\LetterSize;
use App\NumberSize;

class SizeController extends Controller
{
    public function showSizeForm() {

        $tLetra = LetterSize::orderBy('cd_tamanho_letra')->get();
        $tNum = NumberSize::orderBy('nm_tamanho_num')->get();

        return view('pages.admin.cadTamanho', compact('tLetra', 'tNum'));
    }

    public function cadastrarNovoTamanhoLetra(LetterSizeRequest $request) {
        $tamanho = LetterSize::create([
            'nm_tamanho_letra' => $request->nm_tamanho_letra
        ]);

        if ($tamanho) {
            return redirect()->route('admin.cadTamanho');
        }
    }

    public function cadastrarNovoTamanhoNumero(NumberSizeRequest $request) {
        $tamanho = NumberSize::create([
            'nm_tamanho_num' => $request->nm_tamanho_num
        ]);

        if ($tamanho) {
            return redirect()->route('admin.cadTamanho');
        }
    }
}
