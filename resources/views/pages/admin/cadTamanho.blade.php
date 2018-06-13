@extends('layouts.admin.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="padding: 0 20px"><i class="fa fa-arrows-h"></i>&nbsp;&nbsp;Cadastrar Tamanho</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Produtos</a></li>
                <li><a href="#">Atributos</a></li>
                <li><a class="active">Cadastrar Tamanhos</a></li>
            </ol>
        </section>

        <!-- Campos tamanho -->
        <section class="content">

            @include('partials.admin._alerts')


            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="box-body">
                        <form action="{{ route('numbersize.save') }}" method="post">
                            {{ csrf_field() }}

                            <table style="width: 60%">
                                <tr>
                                    <td>
                                        <div>
                                            <div class="form-group">
                                                <label>Tamanho (Número)</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa fa-arrows-h"></i></span>
                                                    <input type="number" class="form-control" name="nm_tamanho_num" min="0">
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
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="box-body">
                        <form action="{{ route('lettersize.save') }}" method="post">
                            {{ csrf_field() }}

                            <table style="width: 60%">
                                <tr>
                                    <td>
                                        <div>
                                            <div class="form-group">
                                                <label>Tamanho (Letra)</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa fa-arrows-h"></i></span>
                                                    <input type="text" class="form-control" name="nm_tamanho_letra">
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

        <!-- Tabelas -->
        <section class="content">

            @include('partials.admin._alerts')


            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tamanho por Número Cadastrado</h3>
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="box-body">
                        <!--<form action="{{ route('menu.edit') }}" method="post">
                            {{ csrf_field() }}

                        </form>-->
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Tamanho</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tNum as $num)
                                    <tr>
                                        <td>{{$num->cd_tamanho_num}}</td>
                                        <td>{{$num->nm_tamanho_num}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tamanho por Letra Cadastrado</h3>
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="box-body">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Tamanho</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tLetra as $letra)
                                    <tr>
                                        <td>{{$letra->cd_tamanho_letra}}</td>
                                        <td>{{$letra->nm_tamanho_letra}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
