@extends('layouts.admin.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-check-square-o"></i>&nbsp;&nbsp;Pedidos PagSeguro</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">PagSeguro</a></li>
                <li><a class="active">Pedidos PagSeguro</a></li>
            </ol>
        </section>

        <!--SESSÃO DO SORTEIO-->
        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Pedidos PagSeguro</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <button id="btn_busca_pedidos" class="btn btn-primary">Buscar Pedidos</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="table-responsive">
                            <table id="pagseguro_table" class="table-striped">
                                <thead>
                                    <tr>
                                       <th>Referência</th>
                                       <th>Status</th>
                                       <th>Método de pagamento</th>
                                       <th>Valor compra</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        $(function(){
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $('#btn_busca_pedidos').click(function(){
                console.log("oi");

                $.ajax({
                   url: '{{route('pagseguro.pedido.transacao')}}',
                   type: 'post',
                   data: {_token: CSRF_TOKEN},
                   success: function(data){
                       console.log('sucesso');
                        console.log(data);
                   },
                    error: function(data){
                        console.log('erro');
                        console.log(data);
                    }
                });
            });

        });
    </script>

@stop