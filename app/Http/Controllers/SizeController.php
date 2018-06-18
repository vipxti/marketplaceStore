<?php

namespace App\Http\Controllers;

use App\Http\Requests\LetterSizeRequest;
use App\Http\Requests\NumberSizeRequest;
use App\LetterSize;
use App\NumberSize;
use Monolog\Handler\FingersCrossed\ActivationStrategyInterface;

class SizeController extends Controller
{
    public function showSizeForm() {

        $tLetra = LetterSize::orderBy('cd_tamanho_letra')->get();
        $tNum = NumberSize::orderBy('nm_tamanho_num')->get();

        return view('pages.admin.cadTamanho', compact('tLetra', 'tNum'));
    }

    public function cadastrarNovoTamanhoLetra(LetterSizeRequest $request) {

        try {

            LetterSize::create([
                'nm_tamanho_letra' => $request->nm_tamanho_letra
            ]);

        }
        catch (\Exception $e) {

            return redirect()->route('size.register')->with('nosuccess', 'Erro ao cadastrar  o tamanho');

        }
        finally {

            return redirect()->route('size.register')->with('success', 'Tamanho cadastro com sucesso');

        }

    }

    public function cadastrarNovoTamanhoNumero(NumberSizeRequest $request) {

        try {

            NumberSize::create([
                'nm_tamanho_num' => $request->nm_tamanho_num
            ]);

        }
        catch (\Exception $e) {

            return redirect()->route('size.register')->with('nosuccess', 'Erro ao cadastrar o tamanho');

        }
        finally {

            return redirect()->route('size.register')->with('success', 'Tamanho cadastro com sucesso');

        }

    }
}
