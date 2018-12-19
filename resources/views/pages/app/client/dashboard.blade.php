@extends('layouts.app.app')

@section('content')

    <link rel="stylesheet" href="{{asset('css/app/input.css')}}">
    <style>
        .wishItem{
            padding: 2rem 1rem;
            margin-bottom: 15px;
            background-color: #e9ecef;
            border-radius: .3rem;
            /*height: 210px;*/
            width: 100%;
        }

        .semestoque {
            width: 100%;
            margin: 0;
            font-size: 13px;
            font-weight: 700;
            color: #d59431;
            text-decoration: none
        }

        .tamanhoimg {

            width: 150px;
            height: 150px;
            background-size: 100% 100%;
            -webkit-background-size: 100% 100%;
            -o-background-size: 100% 100%;
            -khtml-background-size: 100% 100%;
            -moz-background-size: 100% 100%;
        }

        .btncomprar {
            margin: 0;
            font-size: 13px;
            font-weight: 700;
            color:#fff;
            background-color:#3a3a3a;
            text-decoration: none;
            border: none !important;
        }

    </style>

    <section class="new_arrivals_area section_padding_100_0 clearfix">

        <div class="container">

            <div class="row">

                <div class="col-md-12">

                    @include('partials.app._alerts')

                </div>

            </div>

            <div class="row">

                <div class="col-12">

                    <div class="section_heading text-center text-left">

                        <h3>
                            <i class="fa fa-sliders"></i>&nbsp;Minha Conta
                        </h3>
                    
                    </div>
                
                </div>
            
            </div>

            <ul class="nav nav-tabs flex-column flex-sm-row nav-justified" id="myAccountTabs" role="tablist">

                <li class="nav-item">
                    <a class="flex-sm-fill text-sm-center nav-link active" id="myorders-tab" data-toggle="tab" href="#myorders" role="tab" aria-controls="myorders" aria-selected="true">Meus pedidos</a>
                </li>

                <li class="nav-item">
                    <a class="flex-sm-fill text-sm-center nav-link" id="mydata-tab" data-toggle="tab" href="#mydata" role="tab" aria-controls="mydata" aria-selected="false">Dados Pessoais</a>
                </li>

                <li class="nav-item">
                    <a class="flex-sm-fill text-sm-center nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="false">Endereço</a>
                </li>

                <li class="nav-item">
                    <a class="flex-sm-fill text-sm-center nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Lista de Desejos</a>
                </li>

            </ul>
            
            <div class="tab-content" id="tabs">

                {{-- Aba minhas compras --}}
                <div class="tab-pane fade show active" id="myorders" role="tabpanel" aria-labelledby="myorders-tab">

                    <p>&nbsp;</p>

                    <div class="row">

                        <div class="col-12 d-flex justify-content-center">

                            <!-- Tabelas dos Pedidos -->
                            <table class="table table-striped" id="table">
                                <thead style="border-bottom: none !important;">
                                    <tr >
                                        <th style="text-align: left; border-bottom: none !important;">Nº</th>
                                        <th style="text-align: left; border-bottom: none !important;">Data</th>
                                        <th style="text-align: left; border-bottom: none !important;">Status</th>
                                        <th style="text-align: left; border-bottom: none !important;">Ação</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach($listOrder as $order)
                                        <tr>
                                            <td>{{$order->cd_pedido}}</td>
                                            <td>{{ date( 'd/m/Y' , strtotime($order->dt_compra))}}</td>
                                            <td class="ext-center" style="width: 1% !important;">
                                                @switch($order->cd_status)
                                                    @case(1)
                                                        &nbsp;<i class="fa fa-circle-o text-warning" title="Aguardando pagamento"></i>
                                                    @break
                                                    @case(2)
                                                        &nbsp;<i class="fa fa-circle-o text-info" title="Em análise"></i>
                                                    @break
                                                    @case(3)
                                                        &nbsp;<i class="fa fa-circle-o text-success" title="Paga"></i>
                                                    @break
                                                    @case(4)
                                                        &nbsp;<i class="fa fa-circle-o text-success" title="Disponível"></i>
                                                    @break
                                                    @case(5)
                                                        &nbsp;<i class="fa fa-circle-o text-info" title="Em disputa"></i>
                                                    @break
                                                    @case(6)
                                                        &nbsp;<i class="fa fa-circle-o text-info" title="Devolvida"></i>
                                                    @break
                                                    @case(7)
                                                        &nbsp;<i class="fa fa-circle-o text-danger" title="Reprovado"></i>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td >
                                                <button id="btnOrder" class="btn btn-default mt-0 mb-0 p-0" data-toggle="modal" data-target="#modal-default" onclick="vIdBtn({{$order->cd_pedido}})"><i class="fa fa-eye"></i></button>
                                                <button class="btnPrintList btn btn-default mt-0 mb-0 p-0" value="{{$order->cd_pedido}}"><i class="fa fa-print"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-2">
                        {{ $listOrder->links() }}
                    </div>

                    <p>&nbsp;</p><p>&nbsp;</p>

                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-md-2 text-center">
                            <a href="{{route('cart.page')}}" class="btn btn-template">Ir para carrinho</a>
                        </div>
                    </div>
                </div>

                {{-- Aba dados pessoais --}}
                <div class="tab-pane fade" id="mydata" role="tabpanel" aria-labelledby="mydata-tab">
                    <p>&nbsp;</p><p>&nbsp;</p>
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-md-3">
                            <button id="btn_dados_pessoais" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUpdateClientData">Atualizar</button>
                        </div>
                    </div>
                </div>

                {{-- Aba endereço --}}
                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">

                    <p>&nbsp;</p>

                    <div class="row">

                        @foreach ($endereco as $key => $e)

                            @if ($e->ic_principal == 1)
                                <div class="col-12 col-md-6 d-flex justify-content-center">
                                    <div class="card w-75" style="border: 1px solid #d59431;">
                                        <div class="card-body">
                                            <h6 class="card-subtitle">
                                                <p class="h3">{{ $e->nm_destinatario }}</p>
                                            </h6>
                                            <p class="card-text">
                                                {{ $e->ds_endereco }}, {{$e->cd_numero_endereco}}
                                                <br>
                                                {{ $e->nm_bairro }} - {{$e->nm_cidade}}/{{$e->sg_uf}}
                                                <p>&nbsp;</p>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUpdateAddress" data-address="{{ $e }}">
                                                    Atualizar endereço
                                                </button>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                            @else
                                <div class="col-12 col-md-6 d-flex justify-content-center">
                                    <div class="card w-75">
                                        <div class="card-body">
                                            <h6 class="card-subtitle">
                                                <p class="h3">{{ $e->nm_destinatario }}</p>
                                            </h6>
                                            <p class="card-text">
                                                
                                                {{ $e->ds_endereco }}, {{$e->cd_numero_endereco}}
                                                <br>
                                                {{ $e->nm_bairro }} - {{$e->nm_cidade}}/{{$e->sg_uf}}

                                                <p>&nbsp;</p>

                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUpdateAddress" data-address="{{ $e }}">
                                                    Atualizar endereço
                                                </button>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>

                    <div class="row d-flex justify-content-center">

                        <div class="col-12 col-md-3">

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNewAddress">

                                Adicionar novo endereço

                            </button>

                        </div>

                    </div>

                </div>

                {{-- Aba Lista de Desejos --}}
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                    <p>&nbsp;</p>

                    <div class="row d-flex justify-content-center">

                        @if(count($wishlist) > 0)
                            <div class="col-md-12 mb-3">
                                <h4 class="text-center">
                                    <i class="fa fa-heart" style="color: #d59431;"></i>&nbsp;
                                    {{$wishlist[0]->nm_cliente}}
                                    <span style="font-size: 20px;"> - Você tem <span id="span_qtd_produto">{{count($wishlist)}}</span> produto(s) na sua lista</span>
                                </h4>
                            </div>

                            @foreach($wishlist as $w)
                                <div class="wishItem row">
                                    <div class="col-md-2">
                                        <figure class="figure">
                                            <img class="tamanhoimg rounded"
                                                 src="{{ URL::asset('img/products/' . $w->im_produto) }}"
                                                 alt="{{ $w->nm_produto }}">
                                            <a href="{{route('products.details', $w->nm_slug)}}"></a>
                                        </figure>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{route('products.details', $w->nm_slug)}}" style="padding-left: 15px; width: 100%; max-width: 450px;">
                                            <h5>{{$w->nm_produto}}</h5>
                                            <small>SKU: {{$w->cd_nr_sku}}</small>
                                            <p>R$ {{str_replace('.', ',', $w->vl_produto)}}</p>

                                            <p><b>3x</b> de <b>R$ {{number_format(($w->vl_produto/3), 2)}} sem juros</b></p>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        @if($w->qt_produto <= 0)
                                            <div class="text-md-center">
                                                <p class="btn semestoque">SEM ESTOQUE</p>
                                            </div>
                                        @else
                                            <div class="text-md-center">
                                                <button href="{{route('products.details', $w->nm_slug)}}" class="btn btncomprar"><i class="icon-bag"></i>&nbsp;COMPRAR</button>
                                                <input class="sku_wish" type="hidden" value="{{$w->cd_nr_sku}}">
                                                <button id="btn_exluir_wish" type="button" class="btn btncomprar"><i class="fa fa-trash-o"></i>&nbsp;EXCLUIR</button>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            @endforeach
                        @else

                            <div class="col-md-12">
                                <h5 class="text-center">Você ainda não tem favoritos!</h5>
                            </div>

                        @endif

                    </div>
                </div>

            </div>

            <p>&nbsp;</p>

        </div>

        {{-- Modais --}}
        <!--Modal Pedido-->
        <div class="modal fade bd-example-modal-lg" id="modal-default">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Pedido&nbsp;<small id="nPedido"></small></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                    {{--<div class="pad margin no-print">
                        <div class="callout callout-info" style="margin-bottom: 0!important;">
                            <h4><i class="fa fa-info"></i> Note:</h4>
                            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                        </div>
                    </div>--}}

                    <!-- Main content -->
                        <!-- title row -->
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <h2 class="page-header">
                                    <small class="pull-right">
                                        <div id="dtCompra"></div>
                                        <br>
                                        <h5 id="statusPedido" class="pull-right"></h5>
                                    </small>
                                    <img id="imLogo"  class="ml-lg-5" style="width:112px; height:112px;" src="" alt="">
                                    <p id="nmLogoFantasia" class="ml-0"></p>

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
                                <b>Data de Pag.:</b>&nbsp;<small id="dtAlteracao"></small><br>
                                <b>Usuário:</b>&nbsp;<small id="cNmCliente"></small>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-md-12 col-xs-12 table-responsive">
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
                                    <tbody id="tbodyPedidos"></tbody>
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
                            <div class="col-md-12 col-xs-12">
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
                            <div class="col-md-12 col-xs-12">
                                <button id="btnPrint" class="btn btn-default" value=""><i class="fa fa-print"></i>&nbsp;Imprimir</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!-- Modal novo endereço -->
        @component('pages.app.components.modals.newaddress')                                                
        @endcomponent

        <!-- Modal aualizar endereço -->
        @component('pages.app.components.modals.updateaddress')
        @endcomponent

        <!-- Modal aualizar dados cliente -->
        @component('pages.app.components.modals.updateclientdata')                                                
        @endcomponent

    </section>

    <script src="{{asset('js/app/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/app/waves.js')}}"></script>
    <script src="{{asset('js/app/input.js')}}"></script>
    <script src="{{asset('js/app/form-validation.js')}}"></script>
    <script src="{{ asset('js/app/select2.full.min.js') }}"></script>

    <script>

        $(function() {
            //Money Euro
            $('[data-mask]').inputmask();

            $('button#btn_exluir_wish').click(function(){
                let sku = $(this).parent().find('.sku_wish').val();
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                let container = $(this).parent().parent().parent();

                $.ajax({
                    url: '{{route('delete.wish')}}',
                    type: 'post',
                    data: {_token: CSRF_TOKEN, fk_id_sku: sku},
                    success: function (data) {
                        if(data.deuErro == false){
                            container.fadeOut(500, function(){
                                $(this).remove();
                            });

                            $('#span_qtd_produto').html(data.wish.length);
                        }
                    }
                });
            });
        });

        $('#modalUpdateAddress').on('show.bs.modal', function (e) {

            let button = $(e.relatedTarget);
            let dataAddress = button.data('address');

            let modal = $(this);

            modal.find('.nm_destinatario').val(dataAddress.nm_destinatario);
            modal.find('.sobrenome_destinatario').val(dataAddress.sobrenome_destinatario);
            modal.find('.id_cliente_endereco').val(dataAddress.id_cliente_endereco);
            modal.find('.cd_cep').val(dataAddress.cd_cep);
            modal.find('.nm_cidade').val(dataAddress.nm_cidade);
            modal.find('.sg_uf').val(dataAddress.sg_uf);
            modal.find('.ds_endereco').val(dataAddress.ds_endereco);
            modal.find('.cd_numero_endereco').val(dataAddress.cd_numero_endereco);
            modal.find('.ds_complemento').val(dataAddress.ds_complemento);
            modal.find('.ds_ponto_referencia').val(dataAddress.ds_ponto_referencia);
            modal.find('.nm_bairro').val(dataAddress.nm_bairro);

        });

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
                $('#tbodyPedidos').empty();
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
                                    $("<td>").append(value.vl_produto.replace('.', ",")),
                                    $("<td>").append(sbToal.toString().replace('.', ","))
                                )
                            )
                        });

                        let pedProdVariacao = data.dadosPedido.original.prductsOdersVariacao;
                        $.each( pedProdVariacao, function( key, value ) {
                            let sbToal = (data.dadosPedido.original.prductsOdersVariacao[key].qt_produto * data.dadosPedido.original.prductsOdersVariacao[key].vl_produto_variacao);
                            $('#project-table>tbody').append(
                                $("<tr>").append(
                                    $("<td>").append(value.cd_produto_variacao),
                                    $("<td>").append(value.cd_ean_variacao),
                                    $("<td>").append(value.cd_nr_sku),
                                    $("<td>").append(value.qt_produto),
                                    $("<td>").append(value.nm_produto_variacao),
                                    $("<td>").append(value.vl_produto_variacao.replace('.', ",")),
                                    $("<td>").append(sbToal.toString().replace('.', ","))
                                )
                            )
                        });

                    }
                });
            }
    </script>

@stop
