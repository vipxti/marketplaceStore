@extends('layouts.admin.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">
            <h1>Menu</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="{{route('admin.dashboard')}}">Configurações</a></li>
                <li><a class="active">Aparência</a></li>
            </ol>
        </section>

        <section id="content" class="content">

            <!--MENU-->


            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>


                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-12">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sub-Manu</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-tags"></i>
                                            </div>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <form id="fSubCat" class="form-horizontal" action="#" method="post">

                                    <div class="col-md-6">
                                        <div class="form-group has-success">
                                            <label><br></label>
                                            <input class="form-control" type="hidden" id="subCatId" name="subCatId">
                                            <input type="text" class="form-control" id="subCatName" name="subCatName" maxlength="35">
                                            <label class="control-label" hidden for="inputSuccess"><i class="fa fa-check"></i></label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <!--SUB-MENU-->

            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>


                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-12">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sub-Manu</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-tags"></i>
                                            </div>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <form id="fSubCat" class="form-horizontal" action="#" method="post">

                                    <div class="col-md-6">
                                        <div class="form-group has-success">
                                            <label><br></label>
                                            <input class="form-control" type="hidden" id="subCatId" name="subCatId">
                                            <input type="text" class="form-control" id="subCatName" name="subCatName" maxlength="35">
                                            <label class="control-label" hidden for="inputSuccess"><i class="fa fa-check"></i></label>
                                        </div>
                                    </div>

                                   <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="content-header">
            <h1>Banner Primário</h1>
        </section>

        <!--MENU-->


        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>


                <div class="box-body">
                    <div class="row">

                        <div class="col-md-8">

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Texto 1</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-photo"></i>
                                        </div>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Banner 1</label>
                                    <div class="input-group">
                                        <div class="file-loading">
                                            <input id="input-41" name="input41[]" type="file" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>




                        <div class="col-md-8">

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Texto 2</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-photo"></i>
                                        </div>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Banner 2</label>
                                    <div class="input-group">
                                        <div class="file-loading">
                                            <input id="input-41" name="input41[]" type="file" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>

                    </div>
                </div>
            </div>
        </div>




    </div>



@stop
