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
        $colorCount = $cores->count();

        return view('pages.admin.cadCor', compact('cores', 'colorCount'));
    }

    public function addNewColor(ColorRequest $request)
    {
        dd($request);

        DB::beginTransaction();

        try {
            $this->colorCreate($request->nm_cor);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('color.page')->with('nosuccess', 'Erro ao cadastrar a cor');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('color.page')->with('nosuccess', 'Erro ao cadastrar a cor');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('color.page')->with('nosuccess', 'Erro ao conectar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('color.page')->with('success', 'Cor cadastrada com sucesso');
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

    public function deleteColor(ColorRequest $request)
    {
        DB::beginTransaction();

        try {
            $this->colorDelete($request->cd_cor);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('color.page')->with('nosuccess', 'Erro ao excluir a cor');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('color.page')->with('nosuccess', 'Erro ao excluir a cor');
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
            'message' => 'Cor excluir com sucesso'
        ];

        return response()->json($response);

        //return redirect()->route('color.page')->with('success', 'Cor excluída com sucesso');
    }

    public function colorCreate($nomeCor)
    {
        return Color::firstOrCreate([
            'nm_cor' => $nomeCor
            ]);
    }

    public function colorUpdate($codCor, $nomeCor)
    {
        $cor = Color::find($codCor);
        $cor->nm_cor = $nomeCor;

        $cor->save();
    }

    public function colorDelete($codCor)
    {
        DB::table('produto_cor')->where('cd_cor', '=', $codCor)->delete();
        Color::destroy($codCor);
    }
}
