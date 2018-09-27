<?php

namespace App\Http\Controllers;

use App\Company;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller{
    public function listOrder(){

        $listOrder = DB::table('pedido')
            ->join('cliente_endereco', 'pedido.fk_end_entrega_id', '=', 'cliente_endereco.id_cliente_endereco')
            ->orderBy('pedido.cd_pedido', 'desc')
            ->paginate(15);
        //$listOrder = Order::orderBy('cd_pedido', 'desc')->paginate(15);
        return view('pages.admin.listOrder', compact('listOrder'));
    }

    public function printOrder($id){

        $dadosEmpresa = DB::table('dados_empresa')
            ->join('telefone', 'dados_empresa.fk_cd_telefone', '=', 'telefone.cd_telefone')
            ->join('endereco', 'dados_empresa.fk_cd_endereco', '=', 'endereco.cd_endereco')
            ->join('bairro', 'endereco.cd_bairro', '=', 'bairro.cd_bairro')
            ->join('cidade', 'bairro.cd_cidade', '=', 'cidade.cd_cidade')
            ->join('uf', 'cidade.cd_uf', '=', 'uf.cd_uf')
            ->select(
                'nm_fantasia',
                'cd_cnpj',
                'cd_telefone_fixo',
                'im_logo',
                'cd_numero_endereco',
                'ds_complemento',
                'cd_cep',
                'ds_endereco',
                'nm_bairro',
                'nm_cidade',
                'sg_uf'
            )
            ->get();
        $cnpj = (string) $dadosEmpresa[0]->cd_cnpj;
        $phone = (string) $dadosEmpresa[0]->cd_telefone_fixo;
        $cep = (string) $dadosEmpresa[0]->cd_cep;
        $eCnpj =  $this->mask($cnpj,'##.###.###/####-##');
        $ePhone = $this->mask($phone,'(##) ####-####');
        $eCep = $this->mask($cep,'#####-###');

        $dadosCliente = DB::table('pedido')
            ->where('pedido.cd_pedido', '=', $id)
            ->join('cliente', 'pedido.cd_cliente', '=', 'cliente.cd_cliente')
            ->join('telefone', 'cliente.cd_telefone', '=', 'telefone.cd_telefone')
            ->join('cliente_endereco', 'cliente.cd_cliente', '=', 'cliente_endereco.cd_cliente')
            ->join('endereco', 'cliente_endereco.cd_endereco', '=', 'endereco.cd_endereco')
            ->join('bairro', 'endereco.cd_bairro', '=', 'bairro.cd_bairro')
            ->join('cidade', 'bairro.cd_cidade', '=', 'cidade.cd_cidade')
            ->join('uf', 'cidade.cd_uf', '=', 'uf.cd_uf')
            ->select(
                'cd_pedido',
                'cd_status',
                'dt_alteracao',
                'cd_cpf_cnpj',
                'nm_cliente',
                'email',
                'cd_celular1',
                'cd_celular2',
                'nm_destinatario',
                'cd_numero_endereco',
                'ds_complemento',
                'ds_ponto_referencia',
                'cd_cep',
                'ds_endereco',
                'nm_bairro',
                'nm_cidade',
                'sg_uf',
                'vl_total',
                'dt_compra',
                'vl_frete',
                'pedido.cd_pagseguro',
                'pedido.cd_referencia'
            )
            ->get();
        $phone = (string) $dadosCliente[0]->cd_celular1;
        $cep = (string) $dadosCliente[0]->cd_cep;
        $cPhone = $this->mask($phone,'(##) ####-####');
        $cCep = $this->mask($cep,'#####-###');

        $productsOders = DB::table('produto')
            ->where('pedido.cd_pedido', '=', $id)
            ->join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')
            ->join('pedido_produto', 'sku.cd_sku', '=', 'pedido_produto.cd_sku')
            ->join('pedido', 'pedido_produto.cd_pedido', '=', 'pedido.cd_pedido')
            ->select(
                'produto.cd_produto',
                'produto.cd_ean',
                'sku.cd_nr_sku',
                'produto.nm_produto',
                'produto.ds_produto',
                'produto.vl_produto',
                'pedido_produto.qt_produto'
            )
            ->get();

        $productsOdersVariation = DB::table('produto_variacao')
            ->where('pedido.cd_pedido', '=', $id)
            ->join('sku', 'produto_variacao.cd_sku', '=', 'sku.cd_sku')
            ->join('pedido_produto', 'sku.cd_sku', '=', 'pedido_produto.cd_sku')
            ->join('pedido', 'pedido_produto.cd_pedido', '=', 'pedido.cd_pedido')
            ->select(
                'produto_variacao.cd_produto_variacao',
                'produto_variacao.cd_ean_variacao',
                'sku.cd_nr_sku',
                'produto_variacao.nm_produto_variacao',
                'produto_variacao.ds_produto_variacao',
                'produto_variacao.vl_produto_variacao',
                'pedido_produto.qt_produto'
            )
            ->get();

        return view('partials.admin._printOrder', compact(
            'dadosEmpresa',
            'eCnpj',
            'ePhone',
            'eCep',
            'dadosCliente',
            'cPhone',
            'cCep',
            'productsOders',
            'productsOdersVariation'
        ));
    }

    public function modalPedido(Request $request){
        $modalPedido = $this->pedido($request->idOder);

        return response()->json([
            'dadosPedido' => $modalPedido
        ]);
    }

    public function pedido($id){
        $dadosEmpresa = DB::table('dados_empresa')
            ->join('telefone', 'dados_empresa.fk_cd_telefone', '=', 'telefone.cd_telefone')
            ->join('endereco', 'dados_empresa.fk_cd_endereco', '=', 'endereco.cd_endereco')
            ->join('bairro', 'endereco.cd_bairro', '=', 'bairro.cd_bairro')
            ->join('cidade', 'bairro.cd_cidade', '=', 'cidade.cd_cidade')
            ->join('uf', 'cidade.cd_uf', '=', 'uf.cd_uf')
            ->select(
                'nm_fantasia',
                'cd_cnpj',
                'cd_telefone_fixo',
                'im_logo',
                'cd_numero_endereco',
                'ds_complemento',
                'cd_cep',
                'ds_endereco',
                'nm_bairro',
                'nm_cidade',
                'sg_uf'
            )
            ->get();
        $cnpj = (string) $dadosEmpresa[0]->cd_cnpj;
        $phone = (string) $dadosEmpresa[0]->cd_telefone_fixo;
        $cep = (string) $dadosEmpresa[0]->cd_cep;
        $eCnpj =  $this->mask($cnpj,'##.###.###/####-##');
        $ePhone = $this->mask($phone,'(##) ####-####');
        $eCep = $this->mask($cep,'#####-###');

        $dadosCliente = DB::table('pedido')
            ->where('pedido.cd_pedido', '=', $id)
            ->join('cliente', 'pedido.cd_cliente', '=', 'cliente.cd_cliente')
            ->join('telefone', 'cliente.cd_telefone', '=', 'telefone.cd_telefone')
            ->join('cliente_endereco', 'cliente.cd_cliente', '=', 'cliente_endereco.cd_cliente')
            ->join('endereco', 'cliente_endereco.cd_endereco', '=', 'endereco.cd_endereco')
            ->join('bairro', 'endereco.cd_bairro', '=', 'bairro.cd_bairro')
            ->join('cidade', 'bairro.cd_cidade', '=', 'cidade.cd_cidade')
            ->join('uf', 'cidade.cd_uf', '=', 'uf.cd_uf')
            ->select(
                'cd_pedido',
                'cd_status',
                'dt_alteracao',
                'cd_cpf_cnpj',
                'nm_cliente',
                'email',
                'cd_celular1',
                'cd_celular2',
                'nm_destinatario',
                'cd_numero_endereco',
                'ds_complemento',
                'ds_ponto_referencia',
                'cd_cep',
                'ds_endereco',
                'nm_bairro',
                'nm_cidade',
                'sg_uf',
                'vl_total',
                'dt_compra',
                'vl_frete',
                'pedido.cd_pagseguro',
                'pedido.cd_referencia'
            )
            ->get();
        $phone = (string) $dadosCliente[0]->cd_celular1;
        $cep = (string) $dadosCliente[0]->cd_cep;
        $cPhone = $this->mask($phone,'(##) ####-####');
        $cCep = $this->mask($cep,'#####-###');

        $prductsOders = DB::table('produto')
            ->where('pedido.cd_pedido', '=', $id)
            ->join('sku', 'produto.cd_sku', '=', 'sku.cd_sku')
            ->join('pedido_produto', 'sku.cd_sku', '=', 'pedido_produto.cd_sku')
            ->join('pedido', 'pedido_produto.cd_pedido', '=', 'pedido.cd_pedido')
            ->select(
                'produto.cd_produto',
                'produto.cd_ean',
                'sku.cd_nr_sku',
                'produto.nm_produto',
                'produto.ds_produto',
                'produto.vl_produto',
                'pedido_produto.qt_produto'
            )
            ->get();

        //if(count($prductsOders) == 0){
        $prductsOdersVariacao = DB::table('produto_variacao')
                ->where('pedido.cd_pedido', '=', $id)
                ->join('sku', 'produto_variacao.cd_sku', '=', 'sku.cd_sku')
                ->join('pedido_produto', 'sku.cd_sku', '=', 'pedido_produto.cd_sku')
                ->join('pedido', 'pedido_produto.cd_pedido', '=', 'pedido.cd_pedido')
                ->select(
                    'produto_variacao.cd_produto_variacao',
                    'produto_variacao.cd_ean_variacao',
                    'sku.cd_nr_sku',
                    'produto_variacao.nm_produto_variacao',
                    'produto_variacao.ds_produto_variacao',
                    'produto_variacao.vl_produto_variacao',
                    'pedido_produto.qt_produto'
                )
                ->get();
        //}

        return response()->json([
            'dadosEmpresa' => $dadosEmpresa[0],
            'eCnpj' => $eCnpj,
            'ePhone' => $ePhone,
            'eCep' => $eCep,
            'dadosCliente' => $dadosCliente[0],
            'cPhone' =>$cPhone,
            'cCep' => $cCep,
            'prductsOders' => $prductsOders,
            'prductsOdersVariacao' => $prductsOdersVariacao
        ]);
    }

    public function statusPedido(){
        $stPedidos = Order::all('cd_status');

        return response()->json(['stPedido' => $stPedidos]);
        //return view('partials.admin._aside', compact('stPedidos'));
    }

    function mask($val, $mask){
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++){
            if($mask[$i] == '#'){
                if(isset($val[$k]))
                    $maskared .= $val[$k++];
            }
            else{
                if(isset($mask[$i])){
                    $maskared .= $mask[$i];
                }
            }
        }
        return $maskared;
    }
}
