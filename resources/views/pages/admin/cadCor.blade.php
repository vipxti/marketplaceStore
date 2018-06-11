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
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table" id="table">
                                <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Cores</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($cores as $cor)

                                        <tr>

                                            <td>{{ $cor->cd_cor }}</td>
                                            <td>{{ $cor->nm_cor }}</td>


                                        </tr>

                                    @endforeach
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
