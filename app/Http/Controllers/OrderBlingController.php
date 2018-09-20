<?php

namespace App\Http\Controllers;

use App\BlingChannels;
use App\BlingStore;
use App\Http\Requests\BlingChannelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderBlingController extends Controller
{
    //==================================================================================================================
    //RETORNA A VIEW DOS PEDIDOS
    public function index(){
        $canais = BlingChannels::all();

        return view('pages.admin.products.integration.bling.order', compact('canais'));
    }

    public function indexRelatorioPrecos(){
        $lojas = BlingStore::all();
        return view('pages.admin.products.integration.bling.relatorioPrecos', compact('lojas'));
    }

    public function indexManoel(){
        $canais = BlingChannels::all();

        return view('pages.admin.products.integration.bling.orderManoel', compact('canais'));
    }

    //==================================================================================================================
    //BUSCA TODOS OS PEDIDOS DO BLING
    public function searchOrders($pagina, $datas){
        //dd($pagina, $datas);
        $dadoUsuario = DB::table('dados_empresa')->get();
        $apikey = $dadoUsuario[0]->cd_api_key;

        $datas = explode(",", $datas);
        $page = $pagina;
        $dataInicial = str_replace('-', '/', $datas[0]);
        $dataFinal= str_replace('-', '/', $datas[1]);
        $outputType = "json";
        $url = 'https://bling.com.br/Api/v2/pedidos/'. $page . '/' . $outputType . '&filters=dataEmissao[' . $dataInicial . 'TO'.$dataFinal.']';
        //$url = 'https://bling.com.br/Api/v2/pedidos/'. $page . '/' . $outputType . '&filters=dataEmissao[29/08/2018TO29/08/2018]';
        $retorno = $this->executeGetOrder($url, $apikey);

        return response()->json([$retorno]);
        //curl_setopt($curl_handle, CURLOPT_URL, $url . '&filters=dataEmissao[25/08/2018TO29/08/2018]');
    }

    public function executeGetOrder($url, $apikey){
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url . '&apikey=' . $apikey);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $response;
    }

    //==================================================================================================================
    //BUSCA PEDIDOS DO BLING POR NÚMERO
    public function searchOrderByNumber($orderNumber){
        //dd($orderNumber);
        $dadoUsuario = DB::table('dados_empresa')->get();

        $apikey = $dadoUsuario[0]->cd_api_key;

        $outputType = "json";
        $url = 'https://bling.com.br/Api/v2/pedido/' . $orderNumber . '/' . $outputType;
        $retorno = $this->executeGetOrderByNumber($url, $apikey);

        return response()->json([$retorno]);
    }

    public function executeGetOrderByNumber($url, $apikey){
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url . '&apikey=' . $apikey);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $response;
    }

    //==================================================================================================================
    //RETORNA VIEW CADASTRO DE CANAIS
    public function indexCanais(){

        $canais = BlingChannels::all();

        return view('pages.admin.products.integration.bling.cadChannel', compact('canais'));
    }

    //==================================================================================================================
    //SALVA OS CANAIS
    public function saveChannels(BlingChannelsRequest $request){
        //dd($request->all());
        //$celular_formatado = str_replace(')', '', $celular_formatado);
        try {
            $comissao = str_replace(',', '.', $request->comissao);
            $taxa = str_replace(',', '.', $request->taxa);
            $imposto = str_replace(',', '.', $request->imposto);
            $pac = str_replace(',', '.', $request->pac);
            $despesa_fixa = str_replace(',', '.', $request->despesa_fixa);
            $taxa_cartao = str_replace(',', '.', $request->taxa_cartao);
            $marketing = str_replace(',', '.', $request->marketing);

            $canal = new BlingChannels;
            $canal->nome_canal = $request->nome_canal;
            $canal->comissao = $comissao;
            $canal->taxa = $taxa;
            $canal->imposto = $imposto;
            $canal->pac = $pac;
            $canal->despesa_fixa = $despesa_fixa;
            $canal->taxa_cartao = $taxa_cartao;
            $canal->marketing = $marketing;

            $canal->save();
        }
        catch (\Exception $ex){
            return redirect()->route('channel.bling')->with('nosuccess', 'Erro ao criar o canal');

        }

        return redirect()->route('channel.bling')->with('success', 'Canal criado com sucesso!');
    }

    //==================================================================================================================
    //RETORNA VIEW EDIÇÃO DE CANAIS
    public function indexEdit($id){
        $canal = BlingChannels::find($id);

        return view('pages.admin.products.integration.bling.editChannel', compact('canal'));
    }

    //==================================================================================================================
    //ALTERA OS CANAIS
    public function saveAlteration(BlingChannelsRequest $request){
        //dd($request->all());
        try {
            $comissao = str_replace(',', '.', $request->comissao);
            $taxa = str_replace(',', '.', $request->taxa);
            $imposto = str_replace(',', '.', $request->imposto);
            $pac = str_replace(',', '.', $request->pac);
            $despesa_fixa = str_replace(',', '.', $request->despesa_fixa);
            $taxa_cartao = str_replace(',', '.', $request->taxa_cartao);
            $marketing = str_replace(',', '.', $request->marketing);

            $canal = BlingChannels::find($request->id_canais);
            //dd($canal);
            $canal->nome_canal = $request->nome_canal;
            $canal->comissao = $comissao;
            $canal->taxa = $taxa;
            $canal->imposto = $imposto;
            $canal->pac = $pac;
            $canal->despesa_fixa = $despesa_fixa;
            $canal->taxa_cartao = $taxa_cartao;
            $canal->marketing = $marketing;

            $canal->save();
        }
        catch (\Exception $ex){
            return redirect()->route('channel.bling')->with('nosuccess', 'Erro ao alterar o canal');

        }

        return redirect()->route('channel.bling')->with('success', 'Canal alterado com sucesso!');
    }

    public function searchChannels($id){
        //dd($id);

        $canal = BlingChannels::find($id);

        return response()->json($canal);
    }
}
