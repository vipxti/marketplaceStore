@extends('layouts.admin.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Cadastrar Tamanho</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Produto</a></li>
                <li class="active">Cadastrar Tamanho</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>


                <div class="box-body">
                    <form action="{{ route('numbersize.save') }}" method="post">
                        {{ csrf_field() }}

                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tamanho (Número)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa fa-arrows-h"></i></span>
                                    <input type="number" class="form-control" name="nm_tamanho_num" min="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                    </div>

                    </form>
                </div>
                <!--<div class="box-footer">
                    Footer
                </div>-->
                <!-- /.box-footer-->
            </div>
        </section>

        <section class="content">
            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <form action="{{ route('lettersize.save') }}" method="post">
                        {{ csrf_field() }}

                        <div class="col-md-12">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tamanho (Letra)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa fa-arrows-h"></i></span>
                                        <input type="text" class="form-control" name="nm_tamanho_letra">
                                    </div>
                                </div>
                            </div>

                            <div>&nbsp;</div>
                        </div>

                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                        </div>

                    </form>
                </div>
                <!--<div class="box-footer">
                    Footer
                </div>-->
                <!-- /.box-footer-->
            </div>
        </section>

        <!-- LISTA DE CORES CADASTRADAS -->
        <section class="content-header">
            <h1>Tamanhos Cadastrados</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table" id="table">
                                <thead>
                                <tr>
                                    <th>Tamanhos</th>
                                </tr>
                                </thead>

                                <tbody>
                                <td>#</td>
                                </tbody>
                            </table>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
