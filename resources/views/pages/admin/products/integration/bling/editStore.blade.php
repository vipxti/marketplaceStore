@extends('layouts.admin.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1><i class="fa fa-tags"></i>&nbsp;&nbsp;Cadastrar Lojas Bling</h1>
        <ol class="breadcrumb">
            <li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li><a href="javascript:void(0)">Integração</a></li>
            <li><a href="javascript:void(0)">Bling</a></li>
            <li><a href="javascript:void(0)">Atualizar Produtos</a></li>
            <li class="active">Editar Loja</li>
        </ol>
    </section>

    <section class="content">
        @include('partials.admin._alerts')
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Cadastrar Loja</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <form action="{{route('edit.store.bling')}}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>ID Loja:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
                                    <input type="text" class="form-control" name="id_loja" readonly value="{{$loja->id_loja}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nome Loja:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                    <input type="text" class="form-control" name="nome_loja" value="{{$loja->nome_loja}}" required  maxlength="45">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Editar</button>
                        </div>
                    </div>
                    <!-- .row -->
                </form>

            </div>
            <!-- .box-body -->
        </div>
        <!-- .box-primary -->
    </section>
</div>
@stop