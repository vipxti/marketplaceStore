@extends('layouts.admin.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">
            <h1><i class="fa fa-th-list" style="padding: 0px 16px"></i>&nbsp;&nbsp;Menu</h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                    <li><a href="#">Configuração</a></li>
                    <li class="active">Menu</li>
                </ol>
        </section>
        <!-- Campos Cadastrar Menu e SubMenu -->
        <section class="content">

            @include('partials.admin._alerts')


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
                        <form action="{{ route('menu.edit') }}" method="post">
                            {{ csrf_field() }}

                            <table style="width: 60%">
                                <tr>
                                    <td>
                                        <div>
                                            <div class="form-group">
                                                <label>Menu</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-cube"></i></span>
                                                    <input type="text" class="form-control" name="nm_menu" maxlength="50">
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                </tr>
                            </table>

                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

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
                        <form action="{{ route('menu.edit') }}" method="post">
                            {{ csrf_field() }}

                            <table style="width: 60%">
                                <tr>
                                    <td>
                                        <div>
                                            <div class="form-group">
                                                <label>Sub-Menu</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                                    <input type="text" class="form-control" name="nm_menu" maxlength="50">
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                </tr>
                            </table>

                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Associar Menu e SubMenu -->
        <section class="content">

            @include('partials.admin._alerts')

          <div class="col-md-12">
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
                    <form action="{{ route('menu.edit') }}" method="post">
                        {{ csrf_field() }}

                        <div class="col-md-12">

                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Menu 1</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-cube"></i></span>
                                            <input type="text" maxlength="9" class="form-control" value="{{ $menus[0]->nm_menu }}" name="nm_menu1">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sub-Menu</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                            <select class="form-control select2" multiple="multiple" name="nm_sub_menu1[]">
                                                @foreach($submenus as $submenu)

                                                    <option>{{ $submenu->nm_sub_menu }}</option>

                                                @endforeach
                                            </select>
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
          </div>
        </section>



    </div>

    <script src="{{ asset('js/admin/select2.full.min.js') }}"></script>

    <script>

        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

        })

    </script>

@stop
