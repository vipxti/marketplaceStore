@extends('layouts.admin.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/admin/btInterativo.css') }}">

    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-list-alt"></i>&nbsp;&nbsp;Lista de Produtos</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Produtos</a></li>
                <li class="active">Listar Produtos</li>
            </ol>
        </section>

        <section class="content">
            <!-- Default box -->
            <div class="box box-primary">
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

            <!-- BOTÃO PESQUISAR -->

                    <div style="padding-left: 70%">
                        <div>
                            <input type="search" id="search" value="" class="form-control">
                        </div>
                    </div>
                    <div>&nbsp;</div>


                        <div class="dataTables_length" style="padding-left: 90%" id="example1_length">
                            <select name="example1_length" aria-controls="example1" class="form-control form-control-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>

            <!-- TABELA DOS PRODUTOS -->


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
                                        <td class="btn btn-outline-warning" style="color: #367fa9"><i class="fa fa-pencil"></i></td>
                                        <td class="btn btn-outline-danger" style="color: #cc0000"><i class="fa fa-trash-o"></i></td>
                                    </tr>


                                @endforeach
                                </tbody>
                            </table>



                    <div class="text-center">

                        {{ $produtos->links() }}

                    </div>

                </div>
               </div>
                <!-- /.TABELA DOS PRODUTOS -->
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



@stop

