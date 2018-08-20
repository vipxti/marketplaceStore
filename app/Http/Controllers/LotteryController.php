<?php

namespace App\Http\Controllers;

use App\CupomSorteio;
use App\Http\Requests\LotteryRequest;
use App\Lottery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LotteryController extends Controller
{

    public function showViewParticipant(){
        return view('pages.admin.cadParticipanteSorteio');
    }

    public function showViewPrize(){

        $cupom = Lottery::join('sorteio', 'sorteio.fk_id_cliente', '=', 'dado_cliente_sorteio.id')
                        ->orderBy('sorteio.id_sorteio')
                        ->get();
        //dd($cupom);

        $publico =DB::table('configuracao_sorteio')->get();

        if(count($publico) > 0) {
            if($publico[0]->ic_configuracao_sorteio != 2) {
                $participantes_sorteio = Lottery::join('sorteio', 'sorteio.fk_id_cliente', '=', 'dado_cliente_sorteio.id')
                    ->where('dado_cliente_sorteio.ic_genero', '=', $publico[0]->ic_configuracao_sorteio)
                    ->where('dado_cliente_sorteio.ic_ganhador', '=', '0')
                    ->orderBy('sorteio.id_sorteio')
                    ->get();
            }
            else{
                $participantes_sorteio = Lottery::join('sorteio', 'sorteio.fk_id_cliente', '=', 'dado_cliente_sorteio.id')
                    ->where('dado_cliente_sorteio.ic_ganhador', '=', '0')
                    ->orderBy('sorteio.id_sorteio')
                    ->get();
            }
        }
        else{
            $participantes_sorteio = Lottery::join('sorteio', 'sorteio.fk_id_cliente', '=', 'dado_cliente_sorteio.id')
                ->where('dado_cliente_sorteio.ic_ganhador', '=', '0')
                ->orderBy('sorteio.id_sorteio')
                ->get();
        }

        //dd($publico);
        //dd($participantes_sorteio);

        return view('pages.admin.gerarGanhador', compact('cupom', 'publico', 'participantes_sorteio'));
    }

    public function cpfFormat($numCPF){
        $cpf_formatado = str_replace('.', '', $numCPF);
        $cpf_formatado = str_replace('-', '', $cpf_formatado);

        return $cpf_formatado;
    }

    public function phoneFormat($numPhone){
        $celular_formatado = str_replace('(', '', $numPhone);
        $celular_formatado = str_replace(')', '', $celular_formatado);
        $celular_formatado = str_replace(' ', '', $celular_formatado);
        $celular_formatado = str_replace('-', '', $celular_formatado);

        return $celular_formatado;
    }

    public function oldParticipantLottery(Request $request){
        //dd($request->all());

        $existeCupom = CupomSorteio::where('fk_id_cliente', $request->id)->get();

        //dd(count($existeCupom) > 0);

        if(count($existeCupom) == 0) {
            try {
                $cupom = new CupomSorteio;
                $cupom->fk_id_cliente = $request->id;
                $cupom->save();
            } catch (\Exception $ex) {
                return response()->json(["deuErro" => true]);
            }

            return response()->json(["deuErro" => false, "cupom" => $cupom]);
        }
        else{
            return response()->json(["deuErro" => false, "jaExiste" => true, "cupom"=>$existeCupom]);
        }
    }

    public function registerParticipantLottery($cpf_participante){
        $cpf_achado = Lottery::where('cpf', $cpf_participante)->get();
        //dd($cpf_achado[0]->id);

        $cupom = new CupomSorteio;

        $cupom->fk_id_cliente = $cpf_achado[0]->id;
        $cupom->save();

        return $cupom;
    }

    public function registerParticipant(LotteryRequest $request){
        //dd($request->all());
        //$cupom = '';
        $cpf_formatado = $this->cpfFormat($request->cpf);
        $cpf_achado = Lottery::where('cpf', $cpf_formatado)->get();
        //dd($cpf_achado);
        if(count($cpf_achado) == 0) {
            try {
                $cpf_formatado = $this->cpfFormat($request->cpf);
                $celular_formatado = $this->phoneFormat($request->celular);

                $dados_cliente = new Lottery;

                $dados_cliente->nome = $request->nome;
                $dados_cliente->email = $request->email;
                $dados_cliente->cpf = $cpf_formatado;
                $dados_cliente->celular = $celular_formatado;
                $dados_cliente->ic_genero = $request->genero;

                //dd($dados_cliente);

                //dd($dados_cliente);
                $dados_cliente->save();

                $cupom = $this->registerParticipantLottery($cpf_formatado);
                //dd($cupom);

            } catch (\Exception $ex) {
                //return redirect()->route('lottery.participant.page')->with('error', 'Erro ao Cadastrar Participante.');
                return response()->json(["deuErro" => true]);
            }
        }
        else{
            return response()->json(["deuErro" => true]);
        }

        //return redirect()->route('lottery.participant.page')->with('success', 'Participante Cadastrado com Sucesso.');
        return response()->json(["deuErro" => false, "cupom" => $cupom, "dados_cliente" => $dados_cliente]);
    }

    public function updateParticipantData(LotteryRequest $request){
        //dd($request->all());

        try {
            $cpf_formatado = $this->cpfFormat($request->cpf);
            $celular_formatado = $this->phoneFormat($request->celular);

            $dado_atualizado = Lottery::find($request->id);
            //dd($dado_atualizado);

            /*$dado_atualizado = Lottery::where('cpf', $cpf_formatado)->get();

            //dd($dado_atualizado);*/

            $dado_atualizado->nome = $request->nome;
            $dado_atualizado->email = $request->email;
            $dado_atualizado->celular = $celular_formatado;
            $dado_atualizado->ic_genero = $request->genero;

            $dado_atualizado->save();
        }
        catch(\Exception $ex){
            return response()->json(['deuErro' => true]);
        }

        return response()->json(['deuErro' => false]);
    }

    public function verificaCpfCnpj(Request $request)
    {
        $cpf_achado = Lottery::where('cpf', $request->cpf)->get();

        //dd($cpf_achado);

        return response()->json([ 'cpf_cnpj' => $cpf_achado ]);
    }

    public function savePublic(Request $request){
        //dd($request->all());

        $publico = DB::table('configuracao_sorteio')->get();

        //dd($publico);

        try {
            if (count($publico) == 0) {
                DB::table('configuracao_sorteio')->insert(['ic_configuracao_sorteio' => $request->publico]);
            } else {
                DB::table('configuracao_sorteio')->where('ic_configuracao_sorteio', '=', $publico[0]->ic_configuracao_sorteio)
                    ->update(['ic_configuracao_sorteio' => $request->publico]);
            }
        }
        catch(\Exception $ex){
            return response()->json(['deuErro' => true]);
        }

        return response()->json(['deuErro' => false]);

    }

    public function saveWinner(Request $request){
        //dd($request->all());

        try {
            $dados_ganhador = Lottery::join('sorteio', 'sorteio.fk_id_cliente', '=', 'dado_cliente_sorteio.id')
                ->where('sorteio.id_sorteio', '=', $request->cupom)
                ->get();

            //dd($dados_ganhador);

            $ganhador = Lottery::find($dados_ganhador[0]->id);

            $ganhador->ic_ganhador = 1;

            $ganhador->save();
        }
        catch(\Exception $exception){
            return response()->json(['deuErro' => true]);
        }
        //dd($ganhador);
        return response()->json(['deuErro' => false]);
    }

    public function resetWinners(Request $request){
        try {
            DB::table('dado_cliente_sorteio')->update(['ic_ganhador' => 0]);
        }
        catch (\Exception $exception){
            return response()->json(['deuErro' => true]);
        }
        return response()->json(['deuErro' => false]);
    }

}
