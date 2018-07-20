<?php

namespace App\Http\Controllers;

use App\Color;
use App\Http\Requests\ColorRequest;
use Illuminate\Support\Facades\DB;

class ColorController extends Controller
{
    public function showColorForm()
    {
        $cores = Color::all();


        return view('pages.admin.cadCor', compact('cores'));
    }



    public function updateColor(ColorRequest $request)
    {

        DB::beginTransaction();

        try {
            $this->colorUpdate($request->cd_cor, $request->ic_ativo);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('color.page')->with('nosuccess', 'Erro ao atualizar a cor');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('color.page')->with('nosuccess', 'Erro ao atualizar a cor');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('color.page')->with('nosuccess', 'Erro ao atualizar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        $response = [
            'status' => 'success',
            'message' => 'Cor atualizada com sucesso'
        ];

        return response()->json($response);

        //return redirect()->route('color.page')->with('success', 'Cor atualizada com sucesso');
    }

    public function colorUpdate($codCor, $icAtivo)
    {
        $cor = Color::find($codCor);
        $cor->ic_ativo = $icAtivo;

        $cor->save();
    }

}
