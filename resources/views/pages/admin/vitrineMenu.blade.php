@extends('layouts.admin.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><i class="fa fa-th-large"></i>&nbsp;&nbsp;Configuração dos Produtos</h1>
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
                    <form action="{{ route('vitrine.itens.page') }}" method="post">
                        {{ csrf_field() }}

                        <div class="col-md-12">
                            <div class="col-md-4">
                                <label>Produtos (Linhas)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                    <select id="vitrineItens" class="form-control select2" style="width: 100%;" name="nItens">
                                        @foreach($nItensVitrine as $nItenVitrine)
                                            <option value="{{$nItenVitrine->id_menu_itens_vitrine}}" class="ativo{{$nItenVitrine->menu_itens_vitrine_ativo}}">{{$nItenVitrine->menu_itens_vitrine}}</option>
                                        @endforeach
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

    <script>
        $(function(){
            function selecionaAtivo(){
                $('#vitrineItens').val($('.ativo1').val());
            }
            selecionaAtivo();

        });
    </script>
@stop
