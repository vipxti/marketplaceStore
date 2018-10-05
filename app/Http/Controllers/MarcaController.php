<?php

namespace App\Http\Controllers;

use App\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index(){
        $marca = Marca::all();

        return view('pages.admin.marcaIndex', compact('marca'));
    }

    public function saveMarca(Request $request){
        try {
            $marca = new Marca;
            $marca->nome_marca = $request->nome_marca;
            $marca->save();
        }
        catch (\Exception $e){
            return redirect()->route('marca.page')->with('nonsuccess', 'Erro ao cadastrar marca.');
        }

        return redirect()->route('marca.page')->with('success', 'Marca cadastrada com sucesso.');
    }

    public function updateMarca(Request $request){
        try {
            $marca = Marca::find($request->id_marca);
            $marca->nome_marca = $request->nome_marca;
            $marca->save();
        }
        catch (\Exception $e){
            return redirect()->route('marca.page')->with('nonsuccess', 'Erro ao atualizar marca.');
        }

        return redirect()->route('marca.page')->with('success', 'Marca atualizada com sucesso.');
    }

    public function deleteMarca(Request $request){
        try{
            $marca = Marca::find($request->id_marca);
            $marca->delete();
        }
        catch (\Exception $e){
            return response()->json(['deuErro' => true]);
        }

        return response()->json(['deuErro' => false]);
    }
}
