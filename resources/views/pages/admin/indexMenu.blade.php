@extends('layouts.admin.app')

@section('content')


    <link rel="stylesheet" href="{{asset('css/admin/TreeViewEstilo.css')}}">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
           <h1 style="padding: 0 20px"><i class="fa fa-tags"></i>&nbsp;&nbsp;Categorias</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Produtos</a></li>
                <li><a href="#">Atributos</a></li>
                <li><a class="active">Cadastrar Categorias</a></li>
            </ol>
        </section>

        <!-- Cadastrar Categorias -->
        <section class="content">
            @include('partials.admin._alerts')
            <!-- Cadastrar Categoria -->
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cadastrar Menu</h3>
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Categoria</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                    <select id="categorias" class="form-control select2-selection select2-selection--single" name="cd_categoria" >
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <form id="fCat" class="form-horizontal" action="{{ route('category.save') }}" method="post">
                            {{ csrf_field() }}
                            <div class="col-md-6">
                                <div class="form-group" style="margin-right: 0 !important;">
                                    <label>Cadastrar/Alterar</label>
                                    <div class="input-group-prepend">
                                        <input class="form-control" type="hidden" id="catId" name="catId">
                                        <input type="text" id="catName" class="form-control" name="nm_categoria" maxlength="35">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Cadastrar Sub-Categoria -->
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cadastrar Sub-Categoria</h3>
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sub-Categoria</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                    <select id="subcategorias" class="form-control form-control select2-selection select2-selection--single" style="width: 100%;" name="cd_sub_categoria" >
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <form id="fCat" class="form-horizontal" action="{{ route('subcategory.save') }}" method="post">
                            {{ csrf_field() }}
                            <div class="col-md-6">
                                <div class="form-group" style="margin-right: 0 !important;">
                                    <label>Cadastrar/Alterar</label>
                                    <div class="input-group-prepend">
                                        <input type="text" id="subCatNome" class="form-control" name="nm_sub_categoria" maxlength="35">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
        <!-- Cadastrar Associação -->
        <section class="content">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Associação</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <form id="fCat" class="form-horizontal" action="{{ route('catsubcat.associate') }}" method="post">
                            {{ csrf_field() }}
                            <div>
                                <div>
                                    <div class="col-md-6">
                                        <div class="input-group-prependp">
                                            <label>Principal</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                                <select id="categorias" class="form-control form-control select2-selection select2-selection--single" style="width: 100%;" name="cd_categoria" >
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="margin-right: 0 !important;">
                                    <label>Associar Sub-Categoria</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                        <select id="subcategorias" class="form-control select2 form-control select2-selection select2-selection--single" multiple="multiple" style="width: 100%;" name="cd_sub_categorias[]" >
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Listar Categorias Pais e Filhas -->
        <section class="content">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Lista de Categorias</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <ul class="treeview lista">
                                    <li id="liCategoria">
                                        <ul></ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="{{ asset('js/admin/select2.full.min.js') }}"></script>

@stop
