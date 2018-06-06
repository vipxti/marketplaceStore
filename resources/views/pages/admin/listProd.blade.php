@extends('layouts.admin.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
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

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de produtos cadastrados</h3>
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

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="nm_produto" maxlength="50">
                                <span class="input-group-addon"><i class="fa  fa-search"></i></span>
                            </div>
                        </div>
                    </div>


                    <table class="table table-striped" style="width:100%">

                        <thead>

                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th style="width: 1%"> <i class="fa fa-chevron-down"></i></th>
                            <th style="width: 1%"><i class="fa fa-remove"></i></th>
                        </tr>

                        </thead>
                        <tbody>

                        @foreach($produtos as $produto)

                            <tr>
                                <td>{{ $produto->cd_produto }} </td>
                                <td>{{ $produto->nm_produto }} </td>
                                <td>{{ $produto->ds_produto }} </td>
                                <td>{{ $produto->vl_produto }} </td>
                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>
                <!-- /.box-body -->
                <div class="box-footer hidden">

                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@stop
