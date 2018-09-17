@extends('layouts.admin.app')

@section('content')
    <style>
        .example-modal .modal {
            position: relative;
            top: auto;
            bottom: auto;
            right: auto;
            left: auto;
            display: block;
            z-index: 1;
        }
        .example-modal .modal {
            background: transparent !important;

        }
    </style>

    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-list-alt"></i>&nbsp;&nbsp;Lista de Pedidos</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Produtos</a></li>
                <li class="active">Lista de Pedidos</li>
            </ol>
        </section>

        <section class="content">
            @include('partials.admin._alerts')

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="dataTables_length" style="padding-left: 90%" id="example1_length">
                        <select name="example1_length" aria-controls="example1" class="form-control form-control-sm">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>

                    <!-- Tabelas dos Pedidos -->
                    <table class="table" id="table">
                        <thead style="border-bottom: none !important;">
                        <tr >
                            <th style="text-align: left; border-bottom: none !important;">Nº Pedido</th>
                            <th style="text-align: left; border-bottom: none !important;">Data</th>
                            <th style="text-align: left; border-bottom: none !important;">Código de Referência</th>
                            <th style="text-align: left; border-bottom: none !important;">Status</th>
                            <th style="text-align: left; border-bottom: none !important;"></th>
                            <th style="text-align: left; border-bottom: none !important;"></th>
                        </tr>
                        </thead>
                        <tbody >
                        @foreach($listOrder as $order)
                            <tr>
                                <td>{{$order->cd_pedido}}</td>
                                <td>{{ date( 'd/m/Y' , strtotime($order->dt_compra))}}</td>
                                <td>{{strtoupper($order->cd_referencia)}}</td>
                                <td class="ext-center" style="width: 1% !important;">
                                    @switch($order->cd_status)
                                        @case(1)
                                        &nbsp;<i class="fa fa-circle-o text-yellow" title="Aguardando pagamento"></i>
                                        @break
                                        @case(2)
                                        &nbsp;<i class="fa fa-circle-o text-blue" title="Em análise"></i>
                                        @break
                                        @case(3)
                                        &nbsp;<i class="fa fa-circle-o text-green" title="Paga"></i>
                                        @break
                                        @case(4)
                                        &nbsp;<i class="fa fa-circle-o text-green" title="Disponível"></i>
                                        @break
                                        @case(5)
                                        &nbsp;<i class="fa fa-circle-o text-blue" title="Em disputa"></i>
                                        @break
                                        @case(6)
                                        &nbsp;<i class="fa fa-circle-o text-blue" title="Devolvida"></i>
                                        @break
                                        @case(7)
                                        &nbsp;<i class="fa fa-circle-o text-red" title="Reprovado"></i>
                                        @break
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-default mt-0 mb-0 p-0" data-toggle="modal" data-target="#modal-default-{{$order->cd_pedido}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                                <td class=" text-center" id="btn_atributos">
                                    <a class="btn btn-default mt-0 mb-0 p-0" href="#"><i class="fa fa-print"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div align="center">
                        {{ $listOrder->links() }}
                    </div>

                    <!-- Moda Variações -->
                    <!--modal -->
                    @foreach($listOrder as $order)
                        <div class="modal fade bd-example-modal-lg" id="modal-default-{{$order->cd_pedido}}">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Pedido&nbsp;<small>Nº#</small>{{$order->cd_pedido}}</h4>
                                </div>

                                <div class="modal-body" style="padding: 25px !important;">
                                    {{--<div class="pad margin no-print">
                                        <div class="callout callout-info" style="margin-bottom: 0!important;">
                                            <h4><i class="fa fa-info"></i> Note:</h4>
                                            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                                        </div>
                                    </div>--}}

                                    <!-- Main content -->
                                        <!-- title row -->
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h2 class="page-header">
                                                    <img style="width:112px; height:112px;" src=" {{ asset('img/company/').$dadosEmpresa[0]->nm_fantasia }}" alt="">
                                                    <small class="pull-right">Data de Emissão:&nbsp;{{ date( 'd/m/Y' , strtotime($order->dt_compra))}}</small>
                                                    <p>Vip-X MarketPlace</p>

                                                </h2>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- info row -->
                                        <div class="row invoice-info">
                                            <div class="col-sm-4 invoice-col">
                                                DE
                                                <address>
                                                    <strong>{{$dadosEmpresa[0]->nm_fantasia}}</strong><br>
                                                    Cnpj: &nbsp;{{$eCnpj}}<br>
                                                    {{$dadosEmpresa[0]->ds_endereco}},&nbsp;Nº&nbsp;{{$dadosEmpresa[0]->cd_numero_endereco}}&nbsp;-&nbsp;{{$dadosEmpresa[0]->ds_complemento}}<br>
                                                    {{$dadosEmpresa[0]->nm_bairro}},&nbsp;{{$dadosEmpresa[0]->nm_cidade}}&nbsp;-&nbsp;{{$dadosEmpresa[0]->sg_uf}}<br>
                                                    Cep: &nbsp;{{$eCep}}<br>
                                                    Telefone:&nbsp;{{$ePhone}}<br>

                                                </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                                Para
                                                <address>
                                                    <strong>John Doe</strong><br>
                                                    795 Folsom Ave, Suite 600<br>
                                                    San Francisco, CA 94107<br>
                                                    Phone: (555) 539-1037<br>
                                                    Email: john.doe@example.com
                                                </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                                <b>Pedido Nº#{{$order->cd_pedido}}</b><br>
                                                <br>
                                                <b>Order ID:</b> 4F3S8J<br>
                                                <b>Payment Due:</b> 2/22/2014<br>
                                                <b>Account:</b> 968-34567
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- Table row -->
                                        <div class="row">
                                            <div class="col-xs-12 table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Qty</th>
                                                        <th>Product</th>
                                                        <th>Serial #</th>
                                                        <th>Description</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Call of Duty</td>
                                                        <td>455-981-221</td>
                                                        <td>El snort testosterone trophy driving gloves handsome</td>
                                                        <td>$64.50</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Need for Speed IV</td>
                                                        <td>247-925-726</td>
                                                        <td>Wes Anderson umami biodiesel</td>
                                                        <td>$50.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Monsters DVD</td>
                                                        <td>735-845-642</td>
                                                        <td>Terry Richardson helvetica tousled street art master</td>
                                                        <td>$10.70</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Grown Ups Blue Ray</td>
                                                        <td>422-568-642</td>
                                                        <td>Tousled lomo letterpress</td>
                                                        <td>$25.99</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <div class="row">
                                            <!-- accepted payments column -->
                                            <div class="col-xs-12">
                                                <p class="lead">Payment Methods:</p>
                                                <img src="{{ asset('img/admin/credit/visa.png') }}" alt="Visa">
                                                <img src="{{ asset('img/admin/credit/mastercard.png') }}" alt="Mastercard">
                                                <img src="{{ asset('img/admin/credit/american-express.png') }}" alt="American Express">
                                                <img src="{{ asset('img/admin/credit/paypal2.png') }}" alt="Paypal">

                                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
                                                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                                </p>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-xs-12">
                                                <p class="lead">Amount Due 2/22/2014</p>

                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th style="width:50%">Subtotal:</th>
                                                            <td>$250.30</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tax (9.3%)</th>
                                                            <td>$10.34</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Shipping:</th>
                                                            <td>$5.80</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Total:</th>
                                                            <td>$265.24</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- this row will not appear when printing -->
                                        <div class="row no-print">
                                            <div class="col-xs-12">
                                                <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                                                <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
                                                </button>
                                                <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                                                    <i class="fa fa-download"></i> Generate PDF
                                                </button>
                                            </div>
                                        </div>

                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    @endforeach
                    <!-- /.modal -->
                </div>
            </div>
        </section>
    </div>

    <script src="{{asset('js/admin/jquery.cookie.js')}}"></script>
    <script>
        $()
        //Campo pesquisa de produtos
        $(function () {
            $( '#table' ).searchable({
                striped: true,
                oddRow: { 'background-color': '#f5f5f5' },
                evenRow: { 'background-color': '#fff' },
                searchType: 'fuzzy'
            });

            $( '#searchable-container' ).searchable({
                searchField: '#container-search',
                selector: '.row',
                childSelector: '.col-xs-4',
                show: function( elem ) {
                    elem.slideDown(100);
                },
                hide: function( elem ) {
                    elem.slideUp( 100 );
                }
            })
        });

        //Abrir o modal ao clicar no botão Atributos
        $('#btn_atributos').click(function(e){

            // e.preventDefault();
            //
            // var my_cookie = $.cookie($('.modal-check').attr('name'));
            // if (my_cookie && my_cookie == "true") {
            //     $(this).prop('checked', my_cookie);
            //     console.log('checked checkbox');
            // }
            // else{
            //     $('#myModal').modal('show');
            //     console.log('uncheck checkbox');
            // }
            //
            // $(".modal-check").change(function() {
            //     $.cookie($(this).attr("name"), $(this).prop('checked'), {
            //         path: '/',
            //         expires: 1
            //     });
            // });
        });

    </script>

    <script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap4.js"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- page script -->
@stop