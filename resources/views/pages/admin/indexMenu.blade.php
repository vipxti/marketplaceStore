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
                <li><a href="#">Configurações Home</a></li>
                <li><a href="{{ route('menu.edit') }}" class="active">Menu</a></li>
            </ol>
        </section>

        <!-- Campos Cadastrar Menu e SubMenu -->
        <section class="content">
            @include('partials.admin._alerts')
            <!-- Cadastrar Menu -->
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
                        <form id="fCat" class="form-horizontal" action="#" method="post">
                            {{ csrf_field() }}
                            <div class="col-md-6">
                                <div class="form-group" style="margin-right: 0 !important;">
                                    <label>Cadastrar/Alterar</label>
                                    <div class="input-group-prepend">
                                        <input class="form-control" type="hidden" id="catId" name="catId">
                                        <input type="text" id="nm_menu" name="nm_menu" class="form-control" maxlength="50">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                            </div>
                        </form>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Menu</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                    <select id="at_menu" name="at_menu" class="form-control form-control select2-selection select2-selection--single" style="width: 100%;"  >
                                        <option value="">Menu</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Cadastrar SubMenu -->
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cadastrar Sub-Menu</h3>
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <form id="fCat" class="form-horizontal" action="#" method="post">
                            {{ csrf_field() }}
                            <div class="col-md-6">
                                <div class="form-group" style="margin-right: 0 !important;">
                                    <label>Cadastrar/Alterar</label>
                                    <div class="input-group-prepend">
                                        <input type="text" id="nm_sub_menu" name="nm_sub_menu" class="form-control"  maxlength="50">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                            </div>
                        </form>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sub-Menu</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                    <select id="at_sub_menu" name="at_sub_menu" class="form-control form-control select2-selection select2-selection--single" style="width: 100%;" >
                                        <option value="">SubMenu</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cadastrar Associação -->
        <section class="content">
            <div class="col-md-6">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Associação</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <form id="fCat" class="form-horizontal" action="#" method="post">
                            {{ csrf_field() }}
                            <div>
                                <div>
                                    <div class="col-md-6">
                                        <div class="input-group-prependp">
                                            <label>Menu</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                                <select id="ac_menu" name="ac_menu" class="form-control form-control select2-selection select2-selection--single" style="width: 100%;" >
                                                    <option>Menu</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="margin-right: 0 !important;">
                                    <label>Sub-Menu</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                        <select id="subcategorias" class="form-control select2 form-control select2-selection select2-selection--single" multiple="multiple" style="width: 100%;" name="nm_sub_menu1[]" >
                                            <option>Sub-Menu</option>
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

        <!-- Listar Menu e Sub-Menu -->
        <section class="content">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Lista de Menus</h3>
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
                                    <li id="liMenu">
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
    <script>
        $(function(){
            $('.select2').select2();
        })
    </script>
@stop
