<?php

namespace App\Http\Controllers;

use App\Company;
use DB;
use PDF;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;



class DynamicPDFController extends Controller{

    function pdf($request){
        $Ids = explode(',', $request);
        //dd($array);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_customer_data_to_html($Ids));
        return $pdf->stream();
    }


    function convert_customer_data_to_html($ids){
        $dataCompany = DB::table('dados_empresa')
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

        $cnpj = (string) $dataCompany[0]->cd_cnpj;
        $phone = (string) $dataCompany[0]->cd_telefone_fixo;
        $cep = (string) $dataCompany[0]->cd_cep;
        $eCnpj =  $this->mask($cnpj,'##.###.###/####-##');
        $ePhone = $this->mask($phone,'(##) ####-####');
        $eCep = $this->mask($cep,'#####-###');

        $arrayPedidos = [];
        $dataCustomer ='';
        $output = '';
        foreach ($ids as $id) {
            //echo $id;
            $dataCustomer = DB::table('pedido')
                ->where('pedido.cd_pedido', '=', $id)
                ->join('cliente', 'cliente.cd_cliente', '=', 'pedido.cd_cliente')
                ->join('telefone', 'telefone.cd_telefone', '=', 'cliente.cd_telefone')
                ->join('cliente_endereco', 'pedido.fk_end_entrega_id', '=', 'cliente_endereco.id_cliente_endereco')
                ->join('endereco', 'endereco.cd_endereco', '=', 'cliente_endereco.cd_endereco')
                ->join('bairro', 'bairro.cd_bairro', '=', 'endereco.cd_bairro')
                ->join('cidade', 'cidade.cd_cidade', '=', 'bairro.cd_cidade')
                ->join('uf', 'uf.cd_uf', '=', 'cidade.cd_uf')
                ->leftJoin('pedido_produto', 'pedido_produto.cd_pedido', '=', 'pedido.cd_pedido')
                ->leftJoin('sku', 'sku.cd_sku', '=', 'pedido_produto.cd_sku')
                ->leftJoin('produto', 'produto.cd_sku', '=', 'sku.cd_sku')
                ->leftJoin('produto_variacao', 'produto_variacao.cd_sku', '=', 'sku.cd_sku')
                ->select(
                    'pedido.cd_pedido',
                    'pedido.cd_status',
                    'pedido.dt_alteracao',
                    'pedido.vl_frete',
                    'pedido.vl_total',
                    'pedido.dt_compra',
                    'pedido.cd_pagseguro',
                    'pedido.cd_referencia',
                    'produto.cd_produto',
                    'produto.cd_ean',
                    'sku.cd_nr_sku',
                    'produto.nm_produto',
                    'produto.ds_produto',
                    'pedido_produto.qt_produto',
                    'produto.vl_produto',
                    'produto_variacao.cd_produto as cdProdutoVariacao',
                    'produto_variacao.cd_ean_variacao',
                    'produto_variacao.nm_produto_variacao',
                    'produto_variacao.ds_produto_variacao',
                    'produto_variacao.vl_produto_variacao',
                    'cliente.cd_cpf_cnpj',
                    'cliente.nm_cliente',
                    'cliente.email',
                    'telefone.cd_celular1',
                    'telefone.cd_celular1',
                    'cliente_endereco.nm_destinatario',
                    'cliente_endereco.sobrenome_destinatario',
                    'cliente_endereco.cd_numero_endereco',
                    'cliente_endereco.ds_complemento',
                    'cliente_endereco.ds_ponto_referencia',
                    'endereco.cd_cep',
                    'endereco.ds_endereco',
                    'bairro.nm_bairro',
                    'cidade.nm_cidade',
                    'uf.sg_uf'
                )
                ->get();
            $phone = (string) $dataCustomer[0]->cd_celular1;
            $cep = (string) $dataCustomer[0]->cd_cep;
            $cPhone = $this->mask($phone,'(##) ####-####');
            $cCep = $this->mask($cep,'#####-###');

            array_push($arrayPedidos, $dataCustomer );
        }
        //dd($arrayPedidos);

        foreach ($arrayPedidos as $dataClient){
            //dd($dataClient[0]->cd_pedido);
            //$output .= '<h5>Nº Pedido:'.$dataClient[0]->cd_pedido.'</h5><br>'.$dataClient[0]->cd_produto.'<br>'.$dataClient[1]->cdProdutoVariacao;
            $output = '
                <html>
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <title>'.$dataCompany[0]->nm_fantasia.'&nbsp;|&nbsp;Pedido:&nbsp;'.$dataClient[0]->cd_pedido.'</title>
                       <!-- Tell the browser to be responsive to screen width -->
                    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
                    <!-- Bootstrap 3.3.7 -->
                    <link rel="stylesheet" href="../../../public/css/app/bootstrap.min.css">
                    <!-- Font Awesome -->
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                    <!-- Ionicons -->
                    <link rel="stylesheet" href="../../../public/css/app/ionicons.min.css">
                    <!-- Theme style -->
                    <link rel="stylesheet" href="../../../public/css/app/AdminLTE.min.css">
                
                    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
                    <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
                    <!--[if lt IE 9]>
                        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
                        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                    <![endif]-->
                
                    <!-- Google Font -->
                    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
                </head>
                    <style>.page-break {page-break-after:always;}</style>
                </head>
                <body>
                    <div class="wrapper">
                        <section class="invoice">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h2 class="page-header pl-3">'.$dataCompany[0]->nm_fantasia.'</h2>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    DE
                                    <address>
                                        <strong>'.$dataCompany[0]->nm_fantasia.'</strong><br>
                                        Cnpj:&nbsp;'.$eCnpj.'<br>
                                        '.$dataCompany[0]->ds_endereco.',&nbsp;Nº
                                        '.$dataCompany[0]->cd_numero_endereco.'
                                        &nbsp;-&nbsp;
                                        '.$dataCompany[0]->ds_complemento.'<br>
                                        '.$dataCompany[0]->nm_bairro.',&nbsp;'.$dataCompany[0]->nm_cidade.'&nbsp;-&nbsp;'.$dataCompany[0]->sg_uf.'&nbsp;/&nbsp;Cep:&nbsp;'.$eCep.'<br>
                                        Tel:&nbsp;'.$ePhone.'<br>
                                    </address>
                                </div>
                                <p></p>
                                <div class="col-xs-4">
                                    PARA
                                    <address>
                                        <strong>'.$dataClient[0]->nm_destinatario.'</strong><br>
                                        '.$dataClient[0]->ds_endereco.',&nbsp;Nº
                                        '.$dataClient[0]->cd_numero_endereco.'
                                        &nbsp;-&nbsp;
                                        '.$dataClient[0]->ds_complemento.'<br>
                                        '.$dataClient[0]->nm_bairro.',&nbsp;'.$dataClient[0]->nm_cidade.'&nbsp;-&nbsp;'.$dataClient[0]->sg_uf.'&nbsp;/&nbsp;Cep:&nbsp;'.$cCep.'<br>
                                        Cel:&nbsp;'.$cPhone.'<br>
                                        Email:&nbsp;'.$dataClient[0]->email.'
                                    </address>
                                </div>
                                <p></p>
                                <div class="col-xs-4">
                                    <b>Cód.&nbsp;PagSeguro:&nbsp;</b>'.$dataClient[0]->cd_pagseguro.'<br>
                                    <b>Cód.&nbsp;Trasação:&nbsp;</b>'.$dataClient[0]->cd_referencia.'<br>
                                    <b>Pedido&nbsp;ID:</b>&nbsp;'.$dataClient[0]->cd_pedido.'<br>
                                    <b>Data de Pag.:</b>&nbsp;'. date( 'd/m/Y' , strtotime($dataClient[0]->dt_alteracao)).'<br>
                                    <b>Usuário:</b>&nbsp;'.$dataClient[0]->nm_cliente.'
                                </div>
                            </div>
                            <p></p>
                            <div class="row">
                                <div class="col-xs-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Cód</th>
                                                <th>Ean</th>
                                                <th>Sku</th>
                                                <th>Nome do Prod</th>
                                                <th>Qtd</th>
                                                <th>Un</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                ';
                                                if(){}
                                    $output .='
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Sub Total:</th>
                                                <td>'.($dataClient[0]->vl_total - $dataClient[0]->vl_frete).'</td>
                                            </tr>
                                            <tr>
                                                <th>Frete:</th>
                                                <td>'.$dataClient[0]->vl_frete.'</td>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <td>'.$dataClient[0]->vl_total.'</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="page-break"></div>
                            <h1>Page 2</h1>
                        </div>
                    </div>
                </body>
            </html>
            ';
        }

        return $output;
    }


    //Mascaras de TEL/CNPJ/CPF
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
