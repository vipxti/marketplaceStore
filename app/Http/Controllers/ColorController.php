<?php

namespace App\Http\Controllers;

use App\Color;
use App\Http\Requests\ColorRequest;

class ColorController extends Controller
{

    public function showColorForm() {

        $cores = Color::all();

        return view('pages.admin.cadCor', compact('cores'));
    }

    public function cadastrarNovaCor(ColorRequest $request) {
        $cor = Color::create([
            'nm_cor' => $request->nm_cor
        ]);

        if ($cor) {
            session()->flash('Mensagem', 'Cor cadastrada com sucesso');
            return redirect()->route('admin.cadCor');

        }
        else
        {

            return redirect()->back()->withErrors('Houve um problema ao cadastrar a cor');

        }
    }
}
