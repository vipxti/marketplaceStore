@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-tags"></i>&nbsp;&nbsp;Vincular</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Integração</a></li>
                <li><a href="#">Bling</a></li>
                <li class="active">Editar Canais</li>
            </ol>
        </section>

        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar Canal</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{route('channel.bling.save.alteration')}}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <input type="text" name="id_canais" value="{{$canal->id_canais}}" hidden>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nome Canal:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="text" class="form-control" name="nome_canal" required maxlength="45" value="{{$canal->nome_canal}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Comissão: (%)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                        <input type="text" class="form-control" name="comissao" required value="{{$canal->comissao}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Taxa do Canal:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input type="text" class="form-control" name="taxa" required value="{{$canal->taxa}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Imposto: (%)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-line-chart"></i></span>
                                        <input type="text" class="form-control" name="imposto" required value="{{$canal->imposto}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>PAC:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-bar-chart"></i></span>
                                        <input type="text" class="form-control" name="pac" required value="{{$canal->pac}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Despesa Fixa: (%)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-bar-chart"></i></span>
                                        <input type="text" class="form-control" name="despesa_fixa" required value="{{$canal->despesa_fixa}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Taxa do Cartão: (%)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-bar-chart"></i></span>
                                        <input type="text" class="form-control" name="taxa_cartao" required value="{{$canal->taxa_cartao}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Marketing: (%)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-bar-chart"></i></span>
                                        <input type="text" class="form-control" name="marketing" required value="{{$canal->marketing}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Alterar</button>
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

    <script>

    </script>

@stop