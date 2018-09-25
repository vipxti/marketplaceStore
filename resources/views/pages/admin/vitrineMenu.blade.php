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
                <li class="active">Vitrine</li>
            </ol>
        </section>
        <div class="row">
            <div class="col-md-7">
                <!-- ALTERAÇÃO DOS PRODUTOS HOME -->
                <!-- Tabelas dos produtos -->

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
                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                    <tr>
                                        <th style="text-align: left">Nº</th>
                                        <th style="text-align: left">Nome</th>
                                        <th style="text-align: left">Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($produtos as $produto)
                                        <tr>
                                            <td>{{ $produto->cd_produto }} </td></td>
                                            <td>{{ $produto->nm_produto }} </td>
                                            <td class="text-right"></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div align="center">
                                    {{ $produtos->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-4">
                <!-- NUMEROS DE ITENS NA HOME -->
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
                            <form action="{{ route('numemro.itens.vitrine.page') }}" method="post">
                                {{ csrf_field() }}
                                <div class="col-md-12" >
                                    <label>Produtos (Linhas)</label>
                                    <div class="input-group" style="margin-bottom: 15px;">
                                        <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                        <select id="vitrineItens" class="form-control select2" style="width: 100%;" name="nItens">
                                            @foreach($nItensVitrine as $nItenVitrine)
                                                <option value="{{$nItenVitrine->id_menu_itens_vitrine}}" class="ativo{{$nItenVitrine->menu_itens_vitrine_ativo}}">{{$nItenVitrine->menu_itens_vitrine}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success  pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>
    <script>
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $( document ).ready(function() {

            {{--$.ajax({
                url: '{{ route('produtos.vitrine.page') }}',
                type: 'post',
                data: {_token: CSRF_TOKEN},
                success: function(data){
                    console.log("Carregar todos os Produtos!!!");
                    console.log(data.produtos);
                }

            });--}}

        });
        $(function(){
            function selecionaAtivo(){
                $('#vitrineItens').val($('.ativo1').val());
            }
            selecionaAtivo();

        });
    </script>
@stop
