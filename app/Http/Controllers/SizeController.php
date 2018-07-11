<?php

namespace App\Http\Controllers;

use App\Http\Requests\LetterSizeRequest;
use App\Http\Requests\NumberSizeRequest;
use App\LetterSize;
use App\NumberSize;
use Illuminate\Support\Facades\DB;
use Monolog\Handler\FingersCrossed\ActivationStrategyInterface;

class SizeController extends Controller
{
    public function showSizeForm() {

        $tLetra = LetterSize::orderBy('cd_tamanho_letra')->get();
        $tNum = NumberSize::orderBy('nm_tamanho_num')->get();

        return view('pages.admin.cadTamanho', compact('tLetra', 'tNum'));
    }

    public function cadastrarNovoTamanhoLetra(LetterSizeRequest $request) {

        $letra = strtoupper($request->nm_tamanho_letra);
        try {

            LetterSize::create([
                'nm_tamanho_letra' => $letra
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

    //===========================================================================================================
    //UPDATE E DELETE DO TAMANHO LETRA
    public function updateSizeLetter(LetterSizeRequest $request)
    {

        DB::beginTransaction();

        try {
            $this->sizeLetterUpdate($request->cd_tamanho_letra, $request->nm_tamanho_letra);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('size.register')->with('nosuccess', 'Erro ao atualizar o tamanho letra');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('size.register')->with('nosuccess', 'Erro ao atualizar o tamanho letra');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('size.register')->with('nosuccess', 'Erro ao atualizar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        $response = [
            'status' => 'success',
            'message' => 'Tamanho de Letra atualizada com sucesso'
        ];

        return response()->json($response);

        //return redirect()->route('color.page')->with('success', 'Cor atualizada com sucesso');
    }

    public function sizeLetterUpdate($codLetra, $nomeLetra)
    {
        $letra = LetterSize::find($codLetra);
        $letra->nm_tamanho_letra = $nomeLetra;

        $letra->save();
    }

    public function deleteSizeLetter(LetterSizeRequest $request)
    {


        DB::beginTransaction();

        try {
            $this->sizeLetterDelete($request->cd_tamanho_letra);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('size.register')->with('nosuccess', 'Erro ao excluir o tamanho letra');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('size.register')->with('nosuccess', 'Erro ao excluir o tamanho letra');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('size.register')->with('nosuccess', 'Erro ao atualizar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        $response = [
            'status' => 'success',
            'message' => 'Tamanho Letra excluir com sucesso'
        ];

        return response()->json($response);

        //return redirect()->route('color.page')->with('success', 'Cor excluída com sucesso');
    }

    public function sizeLetterDelete($codLetra)
    {
        DB::table('tamanho_letra')->where('cd_tamanho_letra', '=', $codLetra)->delete();
        LetterSize::destroy($codLetra);
    }

    //===========================================================================================================
    //UPDATE E DELETE DO TAMANHO NUMERO
    public function updateSizeNumber(NumberSizeRequest $request)
    {

        DB::beginTransaction();

        try {
            $this->sizeNumberUpdate($request->cd_tamanho_num, $request->nm_tamanho_num);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('size.register')->with('nosuccess', 'Erro ao atualizar o tamanho numero');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('size.register')->with('nosuccess', 'Erro ao atualizar o tamanho numero');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('size.register')->with('nosuccess', 'Erro ao atualizar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        $response = [
            'status' => 'success',
            'message' => 'Tamanho do Numero atualizada com sucesso'
        ];

        return response()->json($response);

        //return redirect()->route('color.page')->with('success', 'Cor atualizada com sucesso');
    }

    public function sizeNumberUpdate($codNum, $nomeNum)
    {
        $num = NumberSize::find($codNum);
        $num->nm_tamanho_num = $nomeNum;

        $num->save();
    }

    public function deleteSizeNumber(NumberSizeRequest $request)
    {


        DB::beginTransaction();

        try {
            $this->sizeNumberDelete($request->cd_tamanho_num);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('size.register')->with('nosuccess', 'Erro ao excluir o tamanho numero');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('size.register')->with('nosuccess', 'Erro ao excluir o tamanho numero');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('size.register')->with('nosuccess', 'Erro ao atualizar com o banco de dados');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        $response = [
            'status' => 'success',
            'message' => 'Tamanho Numero excluir com sucesso'
        ];

        return response()->json($response);

        //return redirect()->route('color.page')->with('success', 'Cor excluída com sucesso');
    }

    public function sizeNumberDelete($codNum)
    {
        DB::table('tamanho_num')->where('cd_tamanho_num', '=', $codNum)->delete();
        NumberSize::destroy($codNum);
    }
}
