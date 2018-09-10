@extends('layouts.admin.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1><i class="fa fa-tags"></i>&nbsp;&nbsp;Vincular</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li><a href="#">Integração</a></li>
            <li><a href="#">Bling</a></li>
            <li class="active">Cadastrar Canais</li>
        </ol>
    </section>

    <section class="content">
        @include('partials.admin._alerts')
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Cadastrar Canal</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <form action="{{route('channel.bling.save')}}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nome Canal:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="text" class="form-control" name="nome_canal" required maxlength="45">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Comissão: (%)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                    <input type="text" class="form-control" name="comissao" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Taxa do Canal:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                    <input type="text" class="form-control" name="taxa" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Imposto: (%)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-line-chart"></i></span>
                                    <input type="text" class="form-control" name="imposto" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>PAC:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-bar-chart"></i></span>
                                    <input type="text" class="form-control" name="pac" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Despesa Fixa: (%)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-bar-chart"></i></span>
                                    <input type="text" class="form-control" name="despesa_fixa" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Taxa do Cartão: (%)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-bar-chart"></i></span>
                                    <input type="text" class="form-control" name="taxa_cartao" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Marketing: (%)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-bar-chart"></i></span>
                                    <input type="text" class="form-control" name="marketing" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                        </div>
                    </div>
                    <!-- .row -->
                </form>

            </div>
            <!-- .box-body -->
        </div>
        <!-- .box-primary -->
    </section>

    <!-- SESSÃO DA LISTA DOS CANAIS -->
    <section class="content">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Lista dos Canais</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th style="text-align: left">Nome Canal</th>
                            <th style="text-align: left">Comissão</th>
                            <th style="text-align: left">Taxa</th>
                            <th style="text-align: left">Imposto</th>
                            <th style="text-align: left">PAC</th>
                            <th style="text-align: left">Despesa Fixa</th>
                            <th style="text-align: left">Taxa Cartão</th>
                            <th style="text-align: left">Marketing</th>
                            <th style="text-align: left"></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($canais as $c)
                            <tr>
                                <td>{{$c->nome_canal}}</td>
                                <td>{{$c->comissao}}</td>
                                <td>{{$c->taxa}}</td>
                                <td>{{$c->imposto}}</td>
                                <td>{{$c->pac}}</td>
                                <td>{{$c->despesa_fixa}}</td>
                                <td>{{$c->taxa_cartao}}</td>
                                <td>{{$c->marketing}}</td>
                                <td>
                                    <a href="{{route('channel.bling.edit', $c->id_canais)}}" class="btn btn-primary">
                                        <i class="fa fa-pencil"></i>
                                        &nbsp;&nbsp;Editar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--  FIM SESSÃO DA LISTA -->
</div>

<script>

</script>

@stop