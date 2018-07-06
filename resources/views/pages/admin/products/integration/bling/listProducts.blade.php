@extends('layouts.admin.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/admin/btInterativo.css') }}">

    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-list-alt"></i>&nbsp;&nbsp;Lista de Produtos</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Produtos</a></li>
                <li class="active">Lista de Produtos</li>
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
                    <!-- Botão pesquisar -->
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

                    <!-- Tabelas dos produtos -->

                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th style="text-align: left">SKU</th>
                                <th style="text-align: left">Gtin</th>
                                <th style="text-align: left">Gtin Embalagem</th>
                                <th style="text-align: left">Nome</th>
                                <th style="text-align: left">Tipo</th>
                                <th style="text-align: left">Un</th>
                                <th style="text-align: left">Preço</th>
                                <th style="text-align: left">Ps Liquido</th>
                                <th style="text-align: left">Ps Bruto</th>
                                <th style="text-align: left">Imagen</th>
                                <th style="text-align: left">Descrição</th>
                                <th style="text-align: left">LarG Produo</th>
                                <th style="text-align: left">Alt Produto</th>
                                <th style="text-align: left">Comprimento</th>
                                <th style="text-align: left">Situação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>T74747474747</td>
                                <td>0998876654635</td>
                                <td>0998876654665</td>
                                <td>PROD TESTE</td>
                                <td>PRODUTO<BR>SERVICO</td>
                                <td>Un</td>
                                <td>Preço</td>
                                <td>UN<BR>
                                    PC<BR>
                                    CX<BR>
                                    KIT<BR>
                                </td>
                                <td>R$ 300,00</td>
                                <td>IMG</td>
                                <td>2CM</td>
                                <td>3CM</td>
                                <td>4CM</td>
                                <td>ATIVO<BR>INATIVO</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Moda Variações -->
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

