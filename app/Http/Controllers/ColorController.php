<?php

namespace App\Http\Controllers;

use App\Color;
use App\Http\Requests\ColorRequest;
use Illuminate\Http\Request;

class ColorController extends Controller
{

    public function showColorForm() {
        return view('pages.admin.cadCor');
    }

    public function cadastrarNovaCor(ColorRequest $request) {
        $cor = Color::create([
            'nm_cor' => $request->nm_cor
        ]);

        if ($cor) {
            return redirect()->route('admin.cadCor');
        }
    }
}
