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

    public function crudCor(ColorRequest $request) {
        dd($request->all());
        if($request->cd_cor == NULL ){
            try {
                $this->novaCor($request->nm_cor);
            }
            catch (\Exception $e) {
                return redirect()->route('color.page')->with('nosuccess', 'Erro ao Cadastrar a Cor');
            }
            finally {
                return redirect()->route('color.page')->with('success', 'Cor Cadastrada com Sucesso');
            }
        }
        elseif($request->delCor == 1){
            try {
                $this->delCor($request->cd_cor);
            }
            catch (\Exception $e) {
                return redirect()->route('color.page')->with('nosuccess', 'Erro ao Deletar a Cor');
            }
            finally {
                return redirect()->route('color.page')->with('success', 'Cor Deletada com Sucesso');
            }
        }
        else{
            try{
                $this->atualizarCor ($request->cd_cor, $request->nm_cor);
            }
            catch (\Exception $e) {
                return redirect()->route('color.page')->with('nosuccess', 'Erro ao Alterar a Cor');
            }
            finally {
                return redirect()->route('color.page')->with('success', 'Cor Alterada com Sucesso');
            }
        }
    }
    public function novaCor ($nomeCor){
        Color::create(['nm_cor' => $nomeCor]);
    }
    public function atualizarCor ($cdCor,$nomeCor){
        $cor = Color::find($cdCor);
        $cor-> nm_cor = $nomeCor;
        $cor->save();
    }
    public function delCor ($cdCor){
        DB::table('produto_cor')-> where('cd_cor', '=', $cdCor)->delete();
        Color::destroy($cdCor);
    }
}
