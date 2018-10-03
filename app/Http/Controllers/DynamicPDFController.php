<?php

namespace App\Http\Controllers;

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

    function convert_customer_data_to_html($Ids){
        //dd(Id);
        //$customer_data = $this->get_customer_data();
        $customer_data = Order::find($Ids);
        //dd(customer_data);
        $output = '
            <title>Teste PDF</title>
            <style>.page-break {page-break-after:always;}</style>
            <div class="col-md-16">
                <div class="wrapper">
                <section class="invoice">
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header pl-3">nm_fantasia</h2>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            DE
                            <address>
                                <strong>nm_fantasia</strong><br>
                                Cnpj:&nbsp;eCnpj<br>
                                dadosEmpresa ds_endereco,&nbsp;Nº
                                dadosEmpresa cd_numero_endereco
                                &nbsp;-&nbsp;
                                dadosEmpresa ds_complemento<br>
                                dadosEmpresa nm_bairro,&nbsp;dadosEmpresa nm_cidade&nbsp;-&nbsp;dadosEmpresa sg_uf&nbsp;/&nbsp;Cep:&nbsp;eCep<br>
                                Tel:&nbsp;ePhone<br>
                            </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            PARA
                            <address>
                                <strong>dadosCliente nm_destinatario</strong><br>
                                dadosCliente ds_endereco,&nbsp;Nº
                                dadosCliente cd_numero_endereco
                                &nbsp;-&nbsp;
                                dadosCliente ds_complemento<br>
                                dadosCliente nm_bairro,&nbsp;dadosCliente nm_cidade&nbsp;-&nbsp;dadosCliente sg_uf&nbsp;/&nbsp;Cep:&nbsp;eCep<br>
                                Cel:&nbsp;cPhone<br>
                                Email:&nbsp;dadosCliente email
                            </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <b>Cód.&nbsp;PagSeguro:&nbsp;</b>dadosCliente cd_pagseguro<br>
                            <b>Cód.&nbsp;Trasação:&nbsp;</b>dadosCliente cd_referencia<br>            
                            <b>Pedido&nbsp;ID:</b>&nbsp;dadosCliente cd_pedido<br>
                            <b>Data de Pag.:</b>&nbsp;dadosCliente dt_alteracao<br>
                            <b>Usuário:</b>&nbsp;dadosCliente nm_cliente
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Ean</th>
                                        <th>Sku</th>
                                        <th>Qtd</th>
                                        <th>Nome do Produto</th>
                                        <th>Un</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td>prductOder->cd_produto</td>
                                            <td>prductOder->cd_ean</td>
                                            <td>prductOder->cd_nr_sku</td>
                                            <td>prductOder->qt_produto</td>
                                            <td>prductOder->nm_produto</td>
                                            <td>prductOder->vl_produto</td>
                                            <td>prductOder->qt_produto * prductOder->vl_produto</td>
                                        </tr>
                                        <tr>
                                            <td>prductOder->cd_produto_variacao</td>
                                            <td>prductOder->cd_ean_variacao</td>
                                            <td>prductOder->cd_nr_sku</td>
                                            <td>prductOder->qt_produto</td>
                                            <td>prductOder->nm_produto_variacao</td>
                                            <td>prductOder->vl_produto_variacao</td>
                                            <td>prductOder->qt_produto * prductOder->vl_produto_variacao</td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row">
                        <div class="col-md-2 pull-left">
                            <p class="lead">Data do Pagamento&nbsp;dadosCliente dt_alteracao</p>
            
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Sub Total:</th>
                                        <td>R$:&nbsp;dadosCliente vl_total - dadosCliente vl_frete</td>
                                    </tr>
                                    <tr>
                                        <th>Frete:</th>
                                        <td>R$:&nbsp;dadosCliente vl_frete</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>R$:&nbsp;dadosCliente vl_total</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>    
        ';
 /*       output = '
                    <h3 align="center">Customer Data</h3>
                    <table class="table table-hover">
                        <tr>
                            <th>Nº Pedido</th>
                            <th>VALOR TORAL</th>
                            <th>STATUS</th>
                            <th>DATA ALTERACAO</th>
                            <th>CÓD. REFERENCIA</th>
                            <th>CÓD. PAGSEGURO</th>
                            <th>DATA COMPRA</th>
                            <th>VL_FRETE</th>
                            <th>CD_CLIENTE</th>
                            <th>FK_END_ENTREGA_ID</th>
                            <th>FK_TIPO_FRETE_ID</th>
                            <th>QT_PARCELAS</th>
                            <th>VL_PARCELAS</th>
                        </tr>
        ';
        foreach(customer_data as customer){
            output .= '
                <tr>
                    <td style="border: 1px solid; padding:12px;">'.customer->cd_pedido.'</td>
                    <td style="border: 1px solid; padding:12px;">'.customer->vl_total.'</td>
                    <td><span class="label label-success">Approved&nbsp;'.customer->cd_status.'</span></td>
                    <td style="border: 1px solid; padding:12px;">'.customer->dt_alteracao.'</td>
                    <td style="border: 1px solid; padding:12px;">'.customer->cd_referencia.'</td>
                    <td style="border: 1px solid; padding:12px;">'.customer->cd_pagseguro.'</td>
                    <td style="border: 1px solid; padding:12px;">'.customer->dt_compra.'</td>
                    <td style="border: 1px solid; padding:12px;">'.customer->vl_frete.'</td>
                    <td style="border: 1px solid; padding:12px;">'.customer->cd_cliente.'</td>
                    <td style="border: 1px solid; padding:12px;">'.customer->fk_end_entrega_id.'</td>
                    <td style="border: 1px solid; padding:12px;">'.customer->fk_tipo_frete_id.'</td>
                    <td style="border: 1px solid; padding:12px;">'.customer->qt_parcelas.'</td>
                    <td style="border: 1px solid; padding:12px;">'.customer->vl_parcelas.'</td>
                </tr>
            ';
        }
        output .= '</table>';*/
        return $output;
    }
}
