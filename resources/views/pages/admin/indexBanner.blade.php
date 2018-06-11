@extends('layouts.admin.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><i class="fa fa-picture-o"></i>&nbsp;&nbsp;Banner Principal</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Configuração</a></li>
                <li class="active">Banner</li>
            </ol>
        </section>

        <!-- BANNER 1 -->
        <section class="content">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Banner 1</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <form action="{{ route('product.save') }}" method="post">
                        {{ csrf_field() }}

                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Titulo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                    <input type="text" maxlength="9" class="form-control" name="cd_cep">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Descrição</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <input type="text" maxlength="9" class="form-control" name="cd_cep">
                                </div>
                            </div>
                        </div>

                        <div>&nbsp;</div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Banner</label>
                                <div class="input-group">
                                    <div class="file-loading">
                                        <input id="input-41" name="input41[]" type="file" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                       <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                       </div>
                    </form>
                </div>
            </div>
        </section>


        <!-- BANNER 2 -->

        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Banner 2</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <form action="{{ route('product.save') }}" method="post">
                        {{ csrf_field() }}

                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Titulo</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                        <input type="text" maxlength="9" class="form-control" name="cd_cep">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Descrição</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                        <input type="text" maxlength="9" class="form-control" name="cd_cep">
                                    </div>
                                </div>
                            </div>

                            <div>&nbsp;</div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Banner</label>
                                    <div class="input-group">
                                        <div class="file-loading">
                                            <input id="input-41" name="input41[]" type="file" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@stop
