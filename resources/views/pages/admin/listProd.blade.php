@extends('layouts.admin.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/admin/btInterativo.css') }}">

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Lista de Produtos
                <small>(Celestial Moda Evangélica)</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Produtos</a></li>
                <li class="active">Listar Produtos</li>
            </ol>
        </section>

        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                                title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">

            <!-- Botão pesquisar -->

                    <div class="row">
                        <div class="col-md-6">
                            <input type="search" id="search" value="" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="dataTables_length" id="example1_length">
                            <select name="example1_length" aria-controls="example1" class="form-control form-control-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>

            <!-- lista de produtos -->

                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table" id="table">
                                <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>SKU</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Preço</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($produtos as $produto)

                                    <tr>
                                        <td>{{ $produto->cd_produto }} </td>
                                        <td>{{ $produto->nm_produto }} </td>
                                        <td>{{ $produto->nm_produto }} </td>
                                        <td>{{ $produto->ds_produto }} </td>
                                        <td>{{ $produto->vl_produto }} </td>
                                        <td>
                                            <div class="material-button-anim">
                                                <ul class="list-inline" id="options">
                                                    <li class="option">
                                                        <button class="material-button option1" type="button">
                                                            <span class="fa fa-phone" aria-hidden="true"></span>
                                                        </button>
                                                    </li>
                                                    <li class="option">
                                                        <button class="material-button option2" type="button">
                                                            <span class="fa fa-envelope-o" aria-hidden="true"></span>
                                                        </button>
                                                    </li>
                                                    <li class="option">
                                                        <button class="material-button option3" type="button">
                                                            <span class="fa fa-pencil" aria-hidden="true"></span>
                                                        </button>
                                                    </li>
                                                </ul>
                                                <button class="material-button material-button-toggle" type="button">
                                                    <span class="fa fa-plus" aria-hidden="true"></span>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                            <hr>
                        </div>
                    </div>
                </div>
               </div>
                <!-- /.box-body -->
                <div class="box-footer hidden">

                </div>
                <!-- /.box-footer-->

            <!-- /.box -->

        </section>
    </div>

    <script>
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

    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });

        $(document).ready(function(){
            $('.material-button-toggle').on("click", function () {
                $(this).toggleClass('open');
                $('.option').toggleClass('scale-on');
            });
        });
    </script>

@stop

