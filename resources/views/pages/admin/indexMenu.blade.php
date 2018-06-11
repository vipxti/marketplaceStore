@extends('layouts.admin.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Menu principal</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Configuração</a></li>
                <li class="active">Menu</li>
            </ol>
        </section>

        <!-- ALTERAÇÃO DO HOTPOST -->

        <section class="content">

            @include('partials.admin._alerts')

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Menu</h3>
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
                                        <!--<input type="text" maxlength="9" class="form-control" name="cd_cep">-->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Menu 2</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-cube"></i></span>
                                    <input type="text" maxlength="9" class="form-control" name="nm_menu2">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sub-Menu</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                    <select class="form-control select2" multiple="multiple" name="nm_sub_menu2[]">
                                        <option>Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                   <!-- <input type="text" maxlength="9" class="form-control" name="cd_cep">-->
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Menu 3</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-cube"></i></span>
                                    <input type="text" maxlength="9" class="form-control" name="nm_menu3">
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sub-Menu</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                    <select class="form-control select2" multiple="multiple" name="nm_sub_menu3[]">
                                        <option>Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                    <!--<input type="text" maxlength="9" class="form-control" name="cd_cep">-->
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Menu 4</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-cube"></i></span>
                                    <input type="text" maxlength="9" class="form-control" name="nm_menu4">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sub-Menu</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                    <select class="form-control select2" multiple="multiple" name="nm_sub_menu4[]">
                                        <option>Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                    <!--<input type="text" maxlength="9" class="form-control" name="cd_cep">-->
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Menu 5</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-cube"></i></span>
                                    <input type="text" maxlength="9" class="form-control" name="nm_menu5">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sub-Menu</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                    <select class="form-control select2" multiple="multiple" name="nm_sub_menu5[]">
                                        <option>Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                   <!-- <input type="text" maxlength="9" class="form-control" name="cd_cep"> -->
                                </div>
                            </div>
                        </div>
                        </div>

                        <!--<div class="col-md-6">
                            <div class="form-group">
                                <label>Sub-Manu</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                    <select class="form-control select2" multiple="multiple"data-placeholder="Select a State"
                                            style="width: 100%;">

                                        <option>Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>

                                    </select>
                                </div>
                            </div>
                        </div>-->

                        <div>&nbsp;</div>

                    </div>

                       <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                       </div>
                    </form>
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
