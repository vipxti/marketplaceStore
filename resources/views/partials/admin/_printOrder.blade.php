<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$dadosEmpresa[0]->nm_fantasia}}&nbsp;|&nbsp;Pedido:&nbsp;{{$dadosCliente[0]->cd_pedido}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('css/app/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('css/app/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/app/AdminLTE.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper p-2">
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header pl-3">{{$dadosEmpresa[0]->nm_fantasia}}</h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                DE
                <address>
                    <strong>{{$dadosEmpresa[0]->nm_fantasia}}</strong><br>
                    Cnpj:&nbsp;{{$eCnpj}}<br>
                    {{$dadosEmpresa[0]->ds_endereco}},&nbsp;Nº
                    {{$dadosEmpresa[0]->cd_numero_endereco}}
                    &nbsp;-&nbsp;
                    {{$dadosEmpresa[0]->ds_complemento}}<br>
                    {{$dadosEmpresa[0]->nm_bairro}},&nbsp;{{$dadosEmpresa[0]->nm_cidade}}&nbsp;-&nbsp;{{$dadosEmpresa[0]->sg_uf}}&nbsp;/&nbsp;Cep:&nbsp;{{$eCep}}<br>
                    Tel:&nbsp;{{$ePhone}}<br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                PARA
                <address>
                    <strong>{{$dadosCliente[0]->nm_destinatario}}</strong><br>
                    {{$dadosCliente[0]->ds_endereco}},&nbsp;Nº
                    {{$dadosCliente[0]->cd_numero_endereco}}
                    &nbsp;-&nbsp;
                    {{$dadosCliente[0]->ds_complemento}}<br>
                    {{$dadosCliente[0]->nm_bairro}},&nbsp;{{$dadosCliente[0]->nm_cidade}}&nbsp;-&nbsp;{{$dadosCliente[0]->sg_uf}}&nbsp;/&nbsp;Cep:&nbsp;{{$eCep}}<br>
                    Cel:&nbsp;{{$cPhone}}<br>
                    Email:&nbsp;{{$dadosCliente[0]->email}}
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Cód.&nbsp;PagSeguro:&nbsp;</b>{{$dadosCliente[0]->cd_pagseguro}}<br>
                <b>Cód.&nbsp;Trasação:&nbsp;</b>{{$dadosCliente[0]->cd_referencia}}<br>

                <b>Pedido&nbsp;ID:</b>&nbsp;{{$dadosCliente[0]->cd_pedido}}<br>
                <b>Data de Pagamento:</b>&nbsp;{{ date( 'd/m/Y' , strtotime($dadosCliente[0]->dt_alteracao))}}<br>
                <b>Usuário:</b>&nbsp;{{$dadosCliente[0]->nm_cliente}}
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Ean</th>
                            <th>Sku</th>
                            <th>Qtd</th>
                            <th>Nome do Produto</th>
                            <th>Un</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productsOders as $key => $prductOder)
                            <tr>
                                <td>{{$prductOder->cd_produto}}</td>
                                <td>{{$prductOder->cd_ean}}</td>
                                <td>{{$prductOder->cd_nr_sku}}</td>
                                <td>{{$prductOder->qt_produto}}</td>
                                <td>{{$prductOder->nm_produto}}</td>
                                <td>{{str_replace(".", ",", ($prductOder->vl_produto))}}</td>
                                <td>{{str_replace(".", ",", ($prductOder->qt_produto * $prductOder->vl_produto))}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <!-- /.col -->
            <div class="col-md-2 pull-left">
                <p class="lead">Data do Pagamento&nbsp;{{ date( 'd/m/Y' , strtotime($dadosCliente[0]->dt_alteracao))}}</p>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Sub Total:</th>
                            <td>R$:&nbsp;{{str_replace(".", ",", ($dadosCliente[0]->vl_total - $dadosCliente[0]->vl_frete))}}</td>
                        </tr>
                        <tr>
                            <th>Frete:</th>
                            <td>R$:&nbsp;{{str_replace(".", ",", $dadosCliente[0]->vl_frete)}}</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>R$:&nbsp;{{str_replace(".", ",", $dadosCliente[0]->vl_total)}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>

</html>
