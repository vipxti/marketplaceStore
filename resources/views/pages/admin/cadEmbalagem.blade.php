@extends('layouts.admin.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">
            <h1><i class="fa fa-cube" style="padding: 0px 16px"></i>&nbsp;&nbsp;Cadastrar Embalagem</h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                    <li><a href="#">Produtos</a></li>
                    <li><a href="#">Atributos</a></li>
                    <li class="active">Cadastrar Embalagem</li>
                </ol>
        </section>

        <!-- Associar Menu e SubMenu -->
        <section class="content">

         @include('partials.admin._alerts')

          <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Cadastrar</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <form action="{{ route('menu.edit') }}" method="post">
                        {{ csrf_field() }}

                        <!-- Largura, Altura e Peso -->

                            <table style="width: 75%">
                                <tr>
                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label>Largura</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                                                <input type="number" class="form-control campo_largura" required name="ds_largura" min="0">
                                            </div>
                                            <i class="msg_largura"></i>
                                        </div>
                                    </td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>

                                    <td>
                                        <div class="form-group">
                                            <label>Altura</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-arrows-v"></i></span>
                                                <input type="number" class="form-control campo_altura" required name="ds_altura" min="0">
                                            </div>
                                            <i class="msg_altura"></i>
                                        </div>
                                    </td>
                                    <td>&nbsp;&nbsp;&nbsp;</td>

                                    <td>
                                        <div class="form-group">
                                            <label>Peso (g)</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                                                <input type="number" class="form-control campo_peso" required name="ds_peso" min="0">
                                            </div>
                                            <i class="msg_peso"></i>
                                        </div>
                                    </td>
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

    </div>

    <script src="{{ asset('js/admin/select2.full.min.js') }}"></script>

    <script>

        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

        })

    </script>

@stop
