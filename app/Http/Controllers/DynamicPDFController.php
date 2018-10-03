<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class DynamicPDFController extends Controller{

    function index(){
        $customer_data = $this->get_customer_data();
        return view('pages.admin.dynamic_pdf')->with('customer_data', $customer_data);
    }

    function get_customer_data($ids){
        $customer_data = Order::find($ids);
        //dd($customer_data);
    }

    function pdf(Request $request){
        $this->get_customer_data($request->idOders);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_customer_data_to_html());
        return $pdf->stream();
    }

    function convert_customer_data_to_html(){
        $customer_data = $this->get_customer_data();
        $output = '
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
        foreach ($customer_data as $key => $customer) {
            $output .= '
                <tr>
                    <td style="border: 1px solid; padding:12px;">'.$customer->cd_pedido.'</td>
                    <td style="border: 1px solid; padding:12px;">'.$customer->vl_total.'</td>
                    <td><span class="label label-success">Approved&nbsp;'.$customer->cd_status.'</span></td>
                    <td style="border: 1px solid; padding:12px;">'.$customer->dt_alteracao.'</td>
                    <td style="border: 1px solid; padding:12px;">'.$customer->cd_referencia.'</td>
                    <td style="border: 1px solid; padding:12px;">'.$customer->cd_pagseguro.'</td>
                    <td style="border: 1px solid; padding:12px;">'.$customer->dt_compra.'</td>
                    <td style="border: 1px solid; padding:12px;">'.$customer->vl_frete.'</td>
                    <td style="border: 1px solid; padding:12px;">'.$customer->cd_cliente.'</td>
                    <td style="border: 1px solid; padding:12px;">'.$customer->fk_end_entrega_id.'</td>
                    <td style="border: 1px solid; padding:12px;">'.$customer->fk_tipo_frete_id.'</td>
                    <td style="border: 1px solid; padding:12px;">'.$customer->qt_parcelas.'</td>
                    <td style="border: 1px solid; padding:12px;">'.$customer->vl_parcelas.'</td>
                </tr>
            ';
        }
        $output .= '</table>';
        return $output;
    }
}
