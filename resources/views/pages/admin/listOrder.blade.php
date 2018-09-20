@extends('layouts.admin.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-list-alt"></i>&nbsp;&nbsp;Lista de Pedidos</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Produtos</a></li>
                <li class="active">Lista de Pedidos</li>
            </ol>
        </section>

        <section class="content">
            @include('partials.admin._alerts')

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <!-- Tabelas dos Pedidos -->
                    <table class="table" id="table">
                        <thead style="border-bottom: none !important;">
                        <tr >
                            <th style="text-align: left; border-bottom: none !important;">Nº Pedido</th>
                            <th style="text-align: left; border-bottom: none !important;">Data</th>
                            <th style="text-align: left; border-bottom: none !important;">Código de Referência</th>
                            <th style="text-align: left; border-bottom: none !important;">Status</th>
                            <th style="text-align: left; border-bottom: none !important;">Ação</th>
                        </tr>
                        </thead>
                        <tbody >
                        @foreach($listOrder as $order)
                            <tr>
                                <td>{{$order->cd_pedido}}</td>
                                <td>{{ date( 'd/m/Y' , strtotime($order->dt_compra))}}</td>
                                <td>{{strtoupper($order->cd_referencia)}}</td>
                                <td class="ext-center" style="width: 1% !important;">
                                    @switch($order->cd_status)
                                        @case(1)
                                        &nbsp;<i class="fa fa-circle-o text-yellow" title="Aguardando pagamento"></i>
                                        @break
                                        @case(2)
                                        &nbsp;<i class="fa fa-circle-o text-blue" title="Em análise"></i>
                                        @break
                                        @case(3)
                                        &nbsp;<i class="fa fa-circle-o text-green" title="Paga"></i>
                                        @break
                                        @case(4)
                                        &nbsp;<i class="fa fa-circle-o text-green" title="Disponível"></i>
                                        @break
                                        @case(5)
                                        &nbsp;<i class="fa fa-circle-o text-blue" title="Em disputa"></i>
                                        @break
                                        @case(6)
                                        &nbsp;<i class="fa fa-circle-o text-blue" title="Devolvida"></i>
                                        @break
                                        @case(7)
                                        &nbsp;<i class="fa fa-circle-o text-red" title="Reprovado"></i>
                                        @break
                                    @endswitch
                                </td>
                                <td>
                                    <button id="btnOrder" class="btn btn-default mt-0 mb-0 p-0" onclick="vIdBtn({{$order->cd_pedido}})" data-toggle="modal" data-target="#modal-default">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button class="btnPrintList btn btn-default mt-0 mb-0 p-0" value="{{$order->cd_pedido}}"><i class="fa fa-print"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div align="center">
                        {{ $listOrder->links() }}
                    </div>

                    <!-- Moda Variações -->
                    <!--modal -->

                        <div class="modal fade bd-example-modal-lg" id="modal-default">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Pedido&nbsp;<small id="nPedido"></small></h4>

                                </div>

                                <div class="modal-body" style="padding: 25px !important;">
                                    {{--<div class="pad margin no-print">
                                        <div class="callout callout-info" style="margin-bottom: 0!important;">
                                            <h4><i class="fa fa-info"></i> Note:</h4>
                                            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                                        </div>
                                    </div>--}}

                                    <!-- Main content -->
                                        <!-- title row -->
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h2 class="page-header">
                                                    <img id="imLogo" style="margin-left:1.5%; width:112px; height:112px;" src="" alt="">
                                                    <small class="pull-right">
                                                        <div id="dtCompra"></div>
                                                        <br>
                                                        <h5 id="statusPedido" class="pull-right"></h5>
                                                    </small>
                                                    <p id="nmLogoFantasia"></p>
                                                </h2>

                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- info row -->
                                        <div class="row invoice-info">
                                            <div class="col-sm-4 invoice-col">
                                                DE
                                                <address>
                                                    <strong ><b id="nmFantasia"></b></strong>
                                                    <div>Cnpj:&nbsp;<small id="eCnpj"></small></div>
                                                    <small id="dsEndereco"></small>,&nbsp;nº<small id="nEnd"></small>&nbsp;-&nbsp;<small id="dsComplemento"></small>
                                                    <small id="nmBairro"></small>,<br><small id="nmCidade"></small>&nbsp;-&nbsp;<small id="sgUf"></small>
                                                    &nbsp;/&nbsp;Cep:&nbsp;<small id="eCep"></small>
                                                    <div>Telefone:&nbsp;<small id="ePhone"></small></div>
                                                </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                                PARA
                                                <address>
                                                    <strong><b id="cNmDestinatario"></b></strong><br>
                                                    <small id="cDsEndereco"></small>,&nbsp;nº<small id="cNumeroEndereco"></small><br><small id="cComplemento"></small>&nbsp;-&nbsp;<small id="cDsPontoReferencia"></small><br>
                                                    <small id="cNmBairro"></small>,&nbsp;<small id="cNmCidade"></small>&nbsp;-&nbsp;<small id="cSgUf"></small>
                                                    &nbsp;/&nbsp;Cep:&nbsp;<small id="cCep"></small>
                                                    <div>Telefone:&nbsp;<small id="cCelular1"></small></div>
                                                    E-Mail:&nbsp;<small id="cEmail"></small>
                                                </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                                <div><b>Cód. PagSeguro:</b>&nbsp;<small id="cdPagseguro" ></small></div>
                                                <div><b>Cód. Trasação:</b>&nbsp;<small id="cdReferencia" ></small></div>
                                                <div><b>Nº Pedido:</b>&nbsp;<small id="cPedido" ></small></div>
                                                <b>Data de Pagamento:</b>&nbsp;<small id="dtAlteracao"></small><br>
                                                <b>Usuário:</b>&nbsp;<small id="cNmCliente"></small>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- Table row -->
                                        <div class="row">
                                            <div class="col-xs-12 table-responsive">
                                                <p class="lead">Itens da Venda</p>
                                                <table id="project-table" class="table table-striped">
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
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <div class="row">
                                            <!-- accepted payments column -->
                                            {{--<div class="col-xs-12">
                                                <p class="lead">Payment Methods:</p>
                                                <img src="{{ asset('img/admin/credit/visa.png') }}" alt="Visa">
                                                <img src="{{ asset('img/admin/credit/mastercard.png') }}" alt="Mastercard">
                                                <img src="{{ asset('img/admin/credit/american-express.png') }}" alt="American Express">
                                                <img src="{{ asset('img/admin/credit/paypal2.png') }}" alt="Paypal">

                                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                                    Observação...
                                                </p>
                                            </div>--}}
                                            <!-- /.col -->
                                            <div class="col-xs-12">
                                                <p class="lead">Resumo dos Valores:</p>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th style="width:50%">Sub Total:</th>
                                                            <td id="vlSTotal"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Frete:</th>
                                                            <td id="vlFrete"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Total:</th>
                                                            <td id="vlTotal"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- this row will not appear when printing -->
                                        <div class="row no-print">
                                            <div class="col-xs-12">
                                                <button id="btnPrint" class="btn btn-default" value=""><i class="fa fa-print"></i>&nbsp;Imprimir</button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </div>
            </div>
        </section>
    </div>

    <script src="{{asset('js/admin/jquery.cookie.js')}}"></script>
    <script>
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        function print(id) {
            window.open('{{ url('admin/pedido/print/') }}' + '/' + id, '_blank');

        }

        $('#btnPrint').click(function(){
            print($(this).val());
        });
        $('button.btnPrintList').click(function(){
            print($(this).val());
        });

        function vIdBtn(id){
            let idOder = id;
            $.ajax({
                url: '{{ route('order.modal.list') }}',
                type: 'post',
                data: {_token: CSRF_TOKEN, idOder: idOder},
                success: function(data){
                    // DADDOS DA EMPRESA
                    $("#nmLogoFantasia").html(data.dadosPedido.original.dadosEmpresa.nm_fantasia);
                    $("#nmFantasia").html(data.dadosPedido.original.dadosEmpresa.nm_fantasia);
                    $("#eCep").html(data.dadosPedido.original.eCep);
                    $("#eCnpj").html(data.dadosPedido.original.eCnpj);
                    $("#ePhone").html(data.dadosPedido.original.ePhone);
                    $("#nEnd").html(data.dadosPedido.original.dadosEmpresa.cd_numero_endereco);
                    $("#dsComplemento").html(data.dadosPedido.original.dadosEmpresa.ds_complemento);
                    $("#dsEndereco").html(data.dadosPedido.original.dadosEmpresa.ds_endereco);
                    $("#nmBairro").html(data.dadosPedido.original.dadosEmpresa.nm_bairro);
                    $("#nmCidade").html(data.dadosPedido.original.dadosEmpresa.nm_cidade);
                    $("#sgUf").html(data.dadosPedido.original.dadosEmpresa.sg_uf,);
                    $("#imLogo").attr("src", '/img/company/' + data.dadosPedido.original.dadosEmpresa.im_logo);


                    // DADDOS Do CLIENTE
                    $("#cNmDestinatario").html(data.dadosPedido.original.dadosCliente.nm_destinatario);
                    $("#cNmCliente").html(data.dadosPedido.original.dadosCliente.nm_cliente);
                    $("#cCelular1").html(data.dadosPedido.original.dadosCliente.cd_celular1);
                    $("#cCep").html(data.dadosPedido.original.dadosCliente.cd_cep);
                    $("#cCpfCnpj").html(data.dadosPedido.original.dadosCliente.cd_cpf_cnpj);
                    $("#cNumeroEndereco").html(data.dadosPedido.original.dadosCliente.cd_numero_endereco);
                    $("#cComplemento").html(data.dadosPedido.original.dadosCliente.ds_complemento);
                    $("#cDsEndereco").html(data.dadosPedido.original.dadosCliente.ds_endereco);
                    $("#cDsPontoReferencia").html(data.dadosPedido.original.dadosCliente.ds_ponto_referencia);
                    $("#cEmail").html(data.dadosPedido.original.dadosCliente.email);
                    $("#cNmBairro").html(data.dadosPedido.original.dadosCliente.nm_bairro);
                    $("#cNmCidade").html(data.dadosPedido.original.dadosCliente.nm_cidade);
                    $("#cSgUf").html(data.dadosPedido.original.dadosCliente.sg_uf);

                    //DADOS DO PEDIDO
                    let stPedido = data.dadosPedido.original.dadosCliente.cd_status;
                    let strPedido = "";
                    let subTotal = (data.dadosPedido.original.dadosCliente.vl_total - data.dadosPedido.original.dadosCliente.vl_frete);

                    switch(stPedido) {
                        case 1:
                            strPedido = ('Aguardando pagamento');
                            $("#statusPedido").html(strPedido);
                            break;
                        case 2:
                            strPedido =('Em análise');
                            $("#statusPedido").html(strPedido);
                            break;
                        case 3:
                            strPedido =('Paga');
                            $("#statusPedido").html(strPedido);
                            break;
                        case 4:
                            strPedido =('Disponível');
                            $("#statusPedido").html(strPedido);
                            break;
                        case 5:
                            strPedido =('Em disputa');
                            $("#statusPedido").html(strPedido);
                            break;
                        case 6:
                            strPedido =('Devolvida');
                            $("#statusPedido").html(strPedido);
                            break;
                        case 7:
                            strPedido =('Reprovado');
                            $("#statusPedido").html(strPedido);
                            break;
                        default:
                            strPedido =("ERRO!!");
                            $("#statusPedido").html(strPedido);
                    }

                    $("#nPedido").html('Nº#' + data.dadosPedido.original.dadosCliente.cd_pedido);
                    $("#cPedido").html('#' + data.dadosPedido.original.dadosCliente.cd_pedido);
                    $("#cdReferencia").html(data.dadosPedido.original.dadosCliente.cd_referencia);
                    $("#cdPagseguro").html(data.dadosPedido.original.dadosCliente.cd_pagseguro);
                    //

                    let dt_compra = data.dadosPedido.original.dadosCliente.dt_compra;
                    let dateComprar = dt_compra.split('-');
                    let novaDatacompra = dateComprar[2] + '/' + dateComprar[1] + '/' + dateComprar[0];

                    $("#dtCompra").html('Data de Emissão ' + novaDatacompra);


                    let dt_alteracao = data.dadosPedido.original.dadosCliente.dt_alteracao;
                    let dateAr = dt_alteracao.split('-');
                    let novaData = dateAr[2] + '/' + dateAr[1] + '/' + dateAr[0];

                    $("#dtAlteracao").html(novaData);

                    $("#vlSTotal").html('R$ ' + subTotal.toFixed(2).replace('.',","));
                    $("#vlFrete").html('R$ ' + data.dadosPedido.original.dadosCliente.vl_frete.replace('.',","));
                    $("#vlTotal").html('R$ ' + data.dadosPedido.original.dadosCliente.vl_total.replace('.',","));

                    //IMPRESSAO DO PEDIDO
                    $("#btnPrint").val(data.dadosPedido.original.dadosCliente.cd_pedido);


                    let pedProd = data.dadosPedido.original.prductsOders;
                    $.each( pedProd, function( key, value ) {
                        let sbToal = (data.dadosPedido.original.prductsOders[key].qt_produto * data.dadosPedido.original.prductsOders[key].vl_produto);
                        $('#project-table>tbody').append(
                            $("<tr>").append(
                                $("<td>").append(value.cd_produto),
                                $("<td>").append(value.cd_ean),
                                $("<td>").append(value.cd_nr_sku),
                                $("<td>").append(value.qt_produto),
                                $("<td>").append(value.nm_produto),
                                $("<td>").append(value.vl_produto.replace('.',",")),
                                $("<td>").append(sbToal.toString().replace('.',",")),
                            )
                        )
                    });

                }
            });
        }
    </script>
    <!-- SlimScroll -->
    <script src="{{asset('js/admin/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('js/admin/fastclick.js')}}"></script>
    <!-- page script -->
@stop