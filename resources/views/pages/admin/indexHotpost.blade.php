@extends('layouts.admin.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Hot Post</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Configuração</a></li>
                <li class="active">Hot Post</li>
            </ol>
        </section>




        <!-- ALTERAÇÃO DO HOTPOST -->

        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Hot Post</h3>
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


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Preço Falso</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input type="number" class="form-control" name="ds_endereco" min="0">
                                    </div>
                                </div>
                            </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Preço Verdadeiro</label>
                                <div class="input-group">
                                    <span class="input-group-addon">R$</span>
                                    <input type="number" class="form-control" name="ds_endereco" min="0">
                                </div>
                            </div>
                        </div>

                        <div>&nbsp;</div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Hot Banner</label>
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
