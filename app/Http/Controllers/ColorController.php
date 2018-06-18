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

        try {

            Color::create([
                'nm_cor' => $request->nm_cor
            ]);

        }
        catch (\Exception $e) {

            return redirect()->route('color.page')->with('nosuccess', 'Erro ao cadastrar a cor');

        }
        finally {

            return redirect()->route('color.page')->with('success', 'Cor cadastrada com sucesso');

        }

    }
}
