@extends('layouts.admin.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.admin._alerts')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><i class="fa fa-paint-brush"></i>&nbsp;&nbsp;Cadastrar Cor</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Produto</a></li>
                <li class="active">Cadastrar Cor</li>
            </ol>
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
                    <form action="{{ route('color.save') }}" method="post">
                        {{ csrf_field() }}

                        <div class="col-md-12">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Cor</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-paint-brush"></i></span>
                                            <input type="text" maxlength="" class="form-control" name="nm_cor">
                                        </div>
                                    </div>
                                </div>

                            <div>&nbsp;</div>
                        </div>

                        <div class="col-md-12 text-right">
                            <button type="submit" id="btnSalvarCor" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                        </div>

                    </form>
                </div>
            </div>
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
                            <th style="text-align: right">Código</th>
                            <th style="text-align: right">Cor</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($cores as $cor)

                            <tr style="text-align: right">
                                <td>{{ $cor->cd_cor }}</td>
                                <td>{{ $cor->nm_cor }}</td>
                                <td class="btn btn-outline-warning" style="color: #367fa9"><i class="fa fa-pencil"></i></td>
                                <td type="submit" id="btn_atributos" class="btn btn-outline-success" style="color: #008d4c"><i class="fa fa-plus"></i></td>
                                <td class="btn btn-outline-danger" style="color: #cc0000"><i class="fa fa-trash-o"></i></td>
                            </tr>


                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{--<div class="box-body">

                    <table class="table" id="table">
                        <thead>
                        <tr>
                            <th style="text-align: right">Código</th>
                            <th style="text-align: right">Cor</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($cores as $cor)

                            <tr style="text-align: right">
                                <td>{{ $cor->cd_cor }}</td>
                                <td>{{ $cor->nm_cor }}</td>
                                <td class="btn btn-outline-warning" style="color: #367fa9"><i class="fa fa-pencil"></i></td>
                                <td type="submit" id="btn_atributos" class="btn btn-outline-success" style="color: #008d4c"><i class="fa fa-plus"></i></td>
                                <td class="btn btn-outline-danger" style="color: #cc0000"><i class="fa fa-trash-o"></i></td>
                            </tr>


                        @endforeach
                        </tbody>
                    </table>
                </div>--}}
            </div>
        </section>
    </div>


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
