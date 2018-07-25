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
                        <thead>
                        <tr>
                            <th style="text-align: left">Nº</th>
                            <th style="text-align: left">Data</th>
                            <th style="text-align: left">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>05/07/2018 às 09:15:21</td>
                                <td title="Reprovado">&nbsp;<i class="fa fa-circle-o text-red"></i></td>
                                <td class="btn btn-outline-warning" style="color: #367fa9;">
                                    <a href="#" data-toggle="modal" data-target="#modal-default">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                                <td type="submit" id="btn_atributos" class="btn btn-outline-success">
                                    <a href="#"><i class="fa fa-print"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>05/07/2018 às 09:15:21</td>
                                <td title="Pendente">&nbsp;<i class="fa fa-circle-o text-yellow"></i></td>
                                <td class="btn btn-outline-warning" style="color: #367fa9;">
                                    <a href="#" data-toggle="modal" data-target="#modal-default">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                                <td type="submit" id="btn_atributos" class="btn btn-outline-success">
                                    <a href="#"><i class="fa fa-print"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>05/07/2018 às 09:15:21</td>
                                <td title="Aprovado">&nbsp;<i class="fa fa-circle-o text-green"></i></td>
                                <td class="btn btn-outline-warning" style="color: #367fa9;">
                                    <a href="#" data-toggle="modal" data-target="#modal-default">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                                <td type="submit" id="btn_atributos" class="btn btn-outline-success">
                                    <a href="#"><i class="fa fa-print"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Moda Variações -->
                    <form action="#" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <!--modal -->
                        <div class="modal fade bd-example-modal-lg" id="modal-default">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Pedido Nº<small>#007612</small></h4>
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
                                                        <img style="width:112px; height:112px;" src=" {{ asset('img/company/nologo.png') }}" alt="">
                                                        <small class="pull-right">Data de Emissão: 02/10/2018</small>
                                                        <p>Vip-X galeria</p>

                                                    </h2>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- info row -->
                                            <div class="row invoice-info">
                                                <div class="col-sm-4 invoice-col">
                                                    DE
                                                    <address>
                                                        <strong>Admin, Inc.</strong><br>
                                                        795 Folsom Ave, Suite 600<br>
                                                        San Francisco, CA 94107<br>
                                                        Phone: (804) 123-5432<br>
                                                        Email: info@almasaeedstudio.com
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
                                                    <b>Pedido Nº#007612</b><br>
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
                        <!-- /.modal -->
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script src="{{asset('js/admin/jquery.cookie.js')}}"></script>
    <script>
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