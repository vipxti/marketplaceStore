<?php

namespace App\Console\Commands;

use App\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PedidosBling extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pedidos:bling';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Busca pedidos do pagseguro e manda para o bling';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $token ='4D97A178277542CAAB150D1096002DF1';
        $emailPagseguro = 'vendas@vipx.com.br';
        $dataInicial = date("Y-m-d", strtotime("-29 day"));
        $dataFinal= date("Y-m-d");

        $url = 'https://ws.pagseguro.uol.com.br/v2/transactions?email='. $emailPagseguro .
            '&initialDate=' . $dataInicial . 'T00:00'.
            '&finalDate=' . $dataFinal . 'T00:00'.
            '&page=1'.
            '&maxPageResults=100';

        $xml = $this->executeGetTransaction($url, $token);
        $dados = simplexml_load_string($xml);

        foreach ($dados->transactions->transaction as $dado){
            $this->atualizaPedidos($dado);
        }

        for ($i = 2; $i <= $dados->totalPages; $i++){
            $url = 'https://ws.pagseguro.uol.com.br/v2/transactions?email='. $emailPagseguro .
                '&initialDate=' . $dataInicial . 'T00:00'.
                '&finalDate=' . $dataFinal . 'T00:00'.
                '&page='. $i .
                '&maxPageResults=100';

            $xml = $this->executeGetTransaction($url, $token);
            $dados = simplexml_load_string($xml);

            foreach ($dados->transactions->transaction as $dado){
                $this->atualizaPedidos($dado);
            }
        }
    }

    public function executeGetTransaction($url,$token){
        $curl_handle = curl_init();
        $headers = array('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1');
        curl_setopt($curl_handle, CURLOPT_URL, $url . '&token=' . $token);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl_handle, CURLOPT_HEADER, false);
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $response;
    }

    public function atualizaPedidos($dado){
        $pedido = Order::where('cd_referencia', '=', $dado->reference)->get();

        if (count($pedido) > 0) {

            if ($pedido[0]->cd_status != $dado->status) {
                $data = explode('T', $dado->lastEventDate);
                Order::where('cd_referencia', '=', $dado->reference)
                    ->update(['cd_status' => $dado->status,
                        'dt_alteracao' => $data[0]]);

                if($dado->status == 3){
                    $this->inserePedidoBling($dado->reference);
                }
            }
        }
    }

    public function inserePedidoBling($referencia)
    {
        $variacao = false;
        $pedido = Order::join('cliente', 'pedido.cd_cliente', '=', 'cliente.cd_cliente')
            ->join('telefone', 'cliente.cd_telefone', '=', 'telefone.cd_telefone')
            ->join('cliente_endereco', 'pedido.fk_end_entrega_id', '=', 'cliente_endereco.id_cliente_endereco')
            ->join('endereco', 'cliente_endereco.cd_endereco', '=', 'endereco.cd_endereco')
            ->join('pedido_produto', 'pedido.cd_pedido', '=', 'pedido_produto.cd_pedido')
            ->join('bairro', 'endereco.cd_bairro', '=', 'bairro.cd_bairro')
            ->join('cidade', 'bairro.cd_cidade', '=', 'cidade.cd_cidade')
            ->join('uf', 'cidade.cd_uf', '=', 'uf.cd_uf')
            ->join('tipo_frete', 'pedido.fk_tipo_frete_id', '=', 'tipo_frete.id_tipo_frete')
            ->where('pedido.cd_referencia', '=', $referencia)
            ->get();

        $produtos = Order::join('pedido_produto', 'pedido.cd_pedido', '=', 'pedido_produto.cd_pedido')
            ->join('sku', 'pedido_produto.cd_sku', '=', 'sku.cd_sku')
            ->join('produto', 'sku.cd_sku', '=', 'produto.cd_sku')
            ->select('sku.cd_nr_sku', 'produto.nm_produto', 'pedido_produto.qt_produto', 'produto.vl_produto')
            ->where('pedido.cd_referencia', '=', $referencia)
            ->get();

        if(count($produtos) == 0){
            $variacao = true;
            $produtos = Order::join('pedido_produto', 'pedido.cd_pedido', '=', 'pedido_produto.cd_pedido')
                ->join('sku', 'pedido_produto.cd_sku', '=', 'sku.cd_sku')
                ->join('produto_variacao', 'sku.cd_sku', '=', 'produto_variacao.cd_sku')
                ->select('sku.cd_nr_sku', 'produto_variacao.nm_produto_variacao', 'pedido_produto.qt_produto', 'produto_variacao.vl_produto_variacao')
                ->where('pedido.cd_referencia', '=', $referencia)
                ->get();
        }

        $dadoUsuario = DB::table('dados_empresa')->get();
        $apikey = $dadoUsuario[0]->cd_api_key;
        $loja = $dadoUsuario[0]->cd_api_bling;

        $data = date('d-m-Y', strtotime($pedido[0]->dt_compra));

        $tipoPessoa = '';

        if(strlen($pedido[0]->cd_cpf_cnpj) == 11){
            $tipoPessoa = 'F';
        }
        else{
            $tipoPessoa = 'J';
        }

        $cep = substr($pedido[0]->cd_cep, 0, 2) . ".";
        $cep.=substr($pedido[0]->cd_cep, 2, 3) . "-";
        $cep.=substr($pedido[0]->cd_cep, 5);

        $url = 'https://bling.com.br/Api/v2/pedido/json/';

        if(!$variacao)
            $xml = $this->geraXml($data, $loja, $pedido, $tipoPessoa, $cep, $produtos);
        else
            $xml = $this->geraXmlVariacao($data, $loja, $pedido, $tipoPessoa, $cep, $produtos);

        $posts = array (
            "apikey" => $apikey,
            "xml" => rawurlencode($xml)
        );

        $this->executeSendOrder($url, $posts);
    }

    public function executeSendOrder($url, $data){
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_POST, count($data));
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $response;
    }

    public function geraXml($data, $loja, $pedido, $tipoPessoa, $cep, $produtos){
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'.
            '<pedido>'.
            '<data>'. $data .'</data>'.
            '<loja>'. $loja .'</loja>'.
            '<cliente>'.
            '<nome>'. $pedido[0]->nm_destinatario. ' ' . $pedido[0]->sobrenome_destinatario .'</nome>'.
            '<tipoPessoa>'. $tipoPessoa .'</tipoPessoa>'.
            '<cpf_cnpj>'. $pedido[0]->cd_cpf_cnpj .'</cpf_cnpj>'.
            '<endereco>'. $pedido[0]->ds_endereco .'</endereco>'.
            '<numero>'. $pedido[0]->cd_numero_endereco .'</numero>'.
            '<complemento>'. $pedido[0]->ds_complemento .'</complemento>'.
            '<bairro>'. $pedido[0]->nm_bairro .'</bairro>'.
            '<cep>'. $cep .'</cep>'.
            '<cidade>'. $pedido[0]->nm_cidade .'</cidade>'.
            '<uf>'. $pedido[0]->sg_uf .'</uf>'.
            '<celular>'. $pedido[0]->cd_celular1 .'</celular>'.
            '</cliente>'.
            '<transporte>'.
            '<transportadora>'. $pedido[0]->tipo_frete .'</transportadora>'.
            '<tipo_frete>R</tipo_frete>'.
            '<servico_correios>'. $pedido[0]->tipo_frete .'</servico_correios>'.
            '</transporte>'.
            '<itens>';

        foreach ($produtos as $produto){
            $xml.= '<item>'.
                '<codigo>'. $produto->cd_nr_sku .'</codigo>'.
                '<descricao>'. $produto->nm_produto .'</descricao>'.
                '<qtde>'. $produto->qt_produto .'</qtde>'.
                '<vlr_unit>'. $produto->vl_produto .'</vlr_unit>'.
                '</item>';
        }

        $xml.= '</itens>'.
            '<parcelas>'.
            '<parcela>'.
            '<dias>14</dias>'.
            '<vlr>'. $pedido[0]->vl_total .'</vlr>'.
            '<obs>PagSeguro</obs>'.
            '</parcela>'.
            '</parcelas>'.
            '<vlr_frete>'. $pedido[0]->vl_frete .'</vlr_frete>'.
            '</pedido>';

        return $xml;
    }

    public function geraXmlVariacao($data, $loja, $pedido, $tipoPessoa, $cep, $produtos){
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'.
            '<pedido>'.
            '<data>'. $data .'</data>'.
            '<loja>'. $loja .'</loja>'.
            '<cliente>'.
            '<nome>'. $pedido[0]->nm_destinatario. ' ' . $pedido[0]->sobrenome_destinatario .'</nome>'.
            '<tipoPessoa>'. $tipoPessoa .'</tipoPessoa>'.
            '<cpf_cnpj>'. $pedido[0]->cd_cpf_cnpj .'</cpf_cnpj>'.
            '<endereco>'. $pedido[0]->ds_endereco .'</endereco>'.
            '<numero>'. $pedido[0]->cd_numero_endereco .'</numero>'.
            '<complemento>'. $pedido[0]->ds_complemento .'</complemento>'.
            '<bairro>'. $pedido[0]->nm_bairro .'</bairro>'.
            '<cep>'. $cep .'</cep>'.
            '<cidade>'. $pedido[0]->nm_cidade .'</cidade>'.
            '<uf>'. $pedido[0]->sg_uf .'</uf>'.
            '<celular>'. $pedido[0]->cd_celular1 .'</celular>'.
            '</cliente>'.
            '<transporte>'.
            '<transportadora>'. $pedido[0]->tipo_frete .'</transportadora>'.
            '<tipo_frete>R</tipo_frete>'.
            '<servico_correios>'. $pedido[0]->tipo_frete .'</servico_correios>'.
            '</transporte>'.
            '<itens>';

        foreach ($produtos as $produto){
            $xml.= '<item>'.
                '<codigo>'. $produto->cd_nr_sku .'</codigo>'.
                '<descricao>'. $produto->nm_produto_variacao .'</descricao>'.
                '<qtde>'. $produto->qt_produto.'</qtde>'.
                '<vlr_unit>'. $produto->vl_produto_variacao .'</vlr_unit>'.
                '</item>';
        }

        $xml.= '</itens>'.
            '<parcelas>'.
            '<parcela>'.
            '<dias>14</dias>'.
            '<vlr>'. $pedido[0]->vl_total .'</vlr>'.
            '<obs>PagSeguro</obs>'.
            '</parcela>'.
            '</parcelas>'.
            '<vlr_frete>'. $pedido[0]->vl_frete .'</vlr_frete>'.
            '</pedido>';

        return $xml;
    }
}
