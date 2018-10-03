@extends('layouts.admin.app')

@section('content')

    <div class="content-wrapper">
        <section class="content">
            <!-- /.row -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Responsive Hover Table</h3>

                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <div class="col-md-5" align="right">
                                        {{--<a href="{{  }}" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i>&nbsp;Convert into PDF</a>--}}
                                    </div>
                                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>cd_pedido</th>
                                    <th>vl_total</th>
                                    <th>cd_status</th>
                                    <th>dt_alteracao</th>
                                    <th>cd_referencia</th>
                                    <th>cd_pagseguro</th>
                                    <th>dt_compra</th>
                                    <th>vl_frete</th>
                                    <th>cd_cliente</th>
                                    <th>fk_end_entrega_id</th>
                                    <th>fk_tipo_frete_id</th>
                                    <th>qt_parcelas</th>
                                    <th>vl_parcelas</th>
                                </tr>
                                <tr>
                                @foreach($customer_data as $key => $customer)
                                    <tr>
                                        <td style="border: 1px solid; padding:12px;">{{$customer->cd_pedido}}</td>
                                        <td style="border: 1px solid; padding:12px;">{{$customer->vl_total}}</td>
                                        <td><span class="label label-success">Approved&nbsp;{{$customer->cd_status}}</span></td>
                                        <td style="border: 1px solid; padding:12px;">{{$customer->dt_alteracao}}</td>
                                        <td style="border: 1px solid; padding:12px;">{{$customer->cd_referencia}}</td>
                                        <td style="border: 1px solid; padding:12px;">{{$customer->cd_pagseguro}}</td>
                                        <td style="border: 1px solid; padding:12px;">{{$customer->dt_compra}}</td>
                                        <td style="border: 1px solid; padding:12px;">{{$customer->vl_frete}}</td>
                                        <td style="border: 1px solid; padding:12px;">{{$customer->cd_cliente}}</td>
                                        <td style="border: 1px solid; padding:12px;">{{$customer->fk_end_entrega_id}}</td>
                                        <td style="border: 1px solid; padding:12px;">{{$customer->fk_tipo_frete_id}}</td>
                                        <td style="border: 1px solid; padding:12px;">{{$customer->qt_parcelas}}</td>
                                        <td style="border: 1px solid; padding:12px;">{{$customer->vl_parcelas}}</td>
                                    </tr>
                                @endforeach
                                </tr>

                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
    </div>

@stop