@extends('layouts.admin.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Configuração dos Produtos</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Configuração Home</a></li>
                <li class="active">Produto Home</li>
            </ol>
        </section>




        <!-- ALTERAÇÃO DOS PRODUTOS HOME -->

        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
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
                            <label>Produtos (Linhas)</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                <select class="form-control select2" style="width: 100%;" name="cd_tamanho">
                                   <option value="3">3</option>
                                   <option value="6">6</option>
                                   <option value="9">9</option>
                                   <option value="12">12</option>
                                   <option value="15">15</option>
                                   <option value="#">Todos</option>
                                </select>
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
