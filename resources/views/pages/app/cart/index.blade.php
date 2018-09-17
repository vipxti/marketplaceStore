@extends('layouts.app.app')

@section('content')

    <link rel="stylesheet" href="{{asset('css/app/input.css')}}">

    <style>

        .custom-radios div {
            display: inline-block;
        }
        .custom-radios input[type="radio"] {
            display: none;
        }
        .custom-radios input[type="radio"] + label {
            color: #333;
            font-family: Arial, sans-serif;
            font-size: 5px;
        }
        .custom-radios input[type="radio"] + label span {
            display: inline-block;
            width: 18px;
            height: 18px;
            margin: -1px 4px 0 0;
            vertical-align: middle;
            cursor: pointer;
            border-radius: 50%;
            border: 2px solid #f1c40f;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
            background-repeat: no-repeat;
            background-position: center;
            text-align: center;
            line-height:22px;
        }
        .custom-radios input[type="radio"] + label span img {
            opacity: 0;
            transition: all .3s ease;
        }
        .custom-radios input[type="radio"]#color-3 + label span {
            background-color: #f1c40f;
        }
        .custom-radios input[type="radio"]:checked + label span {

            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3E%3Ccircle r='3' fill='%23fff'/%3E%3C/svg%3E");
            position: absolute;
            top: .25rem;
            left: 0;
            display: block;
            width: 1rem;
            height: 1rem;
            content: "";
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 70% 70%;
        }
    </style>

    <!-- ****** Cart Area Start ****** -->
    <br><br><br>
    <div class="cart_area clearfix">

        <div class="container">
            <div class="row">
                @if(Session::get('cart') == null)
                    <div class="col-12 col-md-12 text-center">
                        <img src="{{asset('img/app/bg-img/carrinhovazio.png')}}" alt="">
                    </div>
                    <div class="col-12 col-md-12 text-center">
                        <a href="{{ route('products.page')}}" class="btn btn-template" style="width: 100%">Continuar Comprando</a>
                    </div>
                @else

                        <div class="col-12">
                            <div class="cart-table table-responsive clearfix">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Valor</th>
                                        <th>Quantidade</th>
                                        <th>Total</th>
                                        <th>Excluir</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <input type="hidden" name="qtdItensCarrinho" value="{{ Session::get('qtCartItems') }}">
                                    <input type="hidden" id="alturaTotal" name="alturaTotal" value="{{ Session::get('totalHeight') }}">
                                    <input type="hidden" id="larguraTotal" name="larguraTotal" value="{{ Session::get('totalWidth') }}">
                                    <input type="hidden" id="comprimentoTotal" name="comprimentoTotal" value="{{ Session::get('totalLength') }}">
                                    <input type="hidden" id="pesoTotal" name="pesoTotal" value="{{ Session::get('totalWeight') }}">
                                    @foreach(Session::get('cart') as $key => $produto)
                                        <input id="{{ 'idx' . $key }}" type="hidden" name="{{ 'idx['. $key .']' }}" value="{{ $key }}">
                                        <input id="{{ 'qtProdEstoque' . $key }}" type="hidden" value="{{ $produto['qtdProdutoEstoque'] }}">
                                        <tr>
                                            <td class="cart_product_img d-flex align-items-center">
                                                <a href="{{ route('products.details', $produto['slugProduto']) }}">
                                                    <img src="{{ URL::asset('img/products' . '/' . $produto['imagemProduto']) }}" alt="Product">
                                                </a>
                                                <p style="font-size: 16px">{{ $produto['nomeProduto'] }}</p>
                                            </td>
                                            <td class="price"><span id="{{ 'precoProd' . $key }}">R$ {{ number_format($produto['valorProduto'], 2, ',', '.') }}</span></td>
                                            <td class="qty">
                                                <div class="quantity">
                                                        <span id="{{ $key }}" class="qty-minus">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </span>
                                                    <input type="text" class="qty-text" id="{{ 'qty' . $key }}" step="1" min="1" max="99" name="quantity" disabled value="{{ $produto['qtdIndividual'] }}">
                                                    <span id="{{ $key }}" class="qty-plus">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </span>
                                                    {{--<i id="spinner_qtd" class="fa fa-spinner fa-pulse fa-3x fa-fw" style="font-size: 22px; visibility: hidden"></i>--}}
                                                </div>
                                            </td>
                                            <td class="total_price">
                                                    <span id="{{ 'valorTotal' . $key }}">
                                                        R$ {{ number_format($produto['valorTotalProduto'], 2, ',', '.') }}
                                                    </span>
                                            </td>
                                            <td>
                                                <form action="{{ route('cart.product.delete') }}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="cod_produto_carrinho" value="{{ $key }}">
                                                    <button type="submit" class="btn btn-link" style="color: #d59431;"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart-footer d-flex mt-30">
                                <div>
                                    <a href="{{ route('products.page') }}" class="btn btn-template" style="font-size: 14px;">Continuar Comprando</a>
                                </div>

                                <div class="update-checkout w-50">
                                    <form action="{{ route('cart.clear') }}" method="post">
                                        {{ csrf_field() }}
                                        @foreach(Session::get('cart') as $key => $produto)
                                            <input type="hidden" name="{{ 'idx[' . $key . ']' }}" value="{{ $produto['skuProduto'] }}">
                                        @endforeach
                                        <button type="submit" class="btn btn-template" style="font-size: 14px; border-color: #3a3a3a; background-color: #3a3a3a">Limpar Carrinho</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="coupon-code-area mt-70">
                            <div class="cart-page-heading">
                                <h5>CEP</h5>

                                @if ($cep == null)
                                    <p class="text-justify">Digite seu CEP</p>
                                @else
                                    <p class="text-justify">Escolha o CEP</p>
                                @endif
                                
                            </div>


                            @if (Auth::check())

                                @if ($cep == null)

                                    {{--<input type="hidden" id="cd_cep" name="cd_cep" value="">
                                    <input type="hidden" name="cepPrincipal" id="cepPrincipal" value="">
                                    <input type="text" name="cep" id="cep" value="" required>
                                    <button id="calculateShipping" type="button"><i class="fa fa-search"></i></button>--}}
                                    <div class="row col-md-12 mb-15">
                                        {{--<input type="hidden" id="cd_cep" name="cd_cep" value="{{ $cep[0]['cd_cep'] }}">--}}
                                        <input type="text" name="cep" id="cep" value="" required>
                                        <button class="btn btn-template" id="calculateShipping" type="button" style="border: none; width: 61px"><i class="fa fa-search"></i></button>
                                        <p id="msgCep" class="small text-danger"></p>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="small text-danger">Não há endereço cadastrado em sua conta.<br>Para concluir a compra cadastre um endereço</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNewAddress">
                                                Adicionar novo endereço
                                            </button>
                                        </div>
                                    </div>

                                @else

                                    <div class="row">

                                        @foreach ($cep as $key => $c)

                                            @if ($c['ic_principal'] == 1)

                                                <input type="hidden" name="cepPrincipal" id="cepPrincipal" value="{{ $c['cd_cep'] }}">

                                                <div class="col-md-12">
                                                    <input type="radio" class="destino_cliente" name="nm_dest" id="{{ 'nm_dest' . ($key + 1) }}" checked>
                                                    <label class="h6" for="{{ 'nm_dest' . ($key + 1) }}">{{ $c['nm_destinatario'] }}</label>
                                                    <br>
                                                    <span>CEP:&nbsp;</span><span id="{{ 'num_cep' . ($key + 1) }}">{{ $c['cd_cep'] }}</span>
                                                    <br>
                                                    <span class="small">{{ $c['ds_endereco'] }}, {{ $c['cd_numero_endereco'] }}</span>
                                                    <p></p>
                                                </div>

                                            @else

                                                <div class="col-md-12">
                                                    <input type="radio" class="destino_cliente" name="nm_dest" id="{{ 'nm_dest' . ($key + 1) }}">
                                                    <label class="h6" for="{{ 'nm_dest' . ($key + 1) }}">{{ $c['nm_destinatario'] }}</label>
                                                    <br>
                                                    <span>CEP:&nbsp;</span><span id="{{ 'num_cep' . ($key + 1) }}">{{$c['cd_cep']}}</span>
                                                    <br>
                                                    <span class="small">{{ $c['ds_endereco'] }}, {{ $c['cd_numero_endereco'] }}</span>
                                                    <p></p>
                                                </div>

                                            @endif

                                        @endforeach

                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center">
                                            <p class="small">Caso queira adicionar outro endereço clique no botão abaixo</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNewAddress">
                                                Adicionar novo endereço
                                            </button>
                                        </div>
                                    </div>

                                @endif

                            @else
                                <div class="row col-md-12 mb-15">
                                    {{--<input type="hidden" id="cd_cep" name="cd_cep" value="{{ $cep[0]['cd_cep'] }}">--}}
                                    <input type="text" name="cep" id="cep" value="" required>
                                    <button class="btn btn-template" id="calculateShipping" type="button" style="border: none; width: 61px"><i class="fa fa-search"></i></button>
                                    <p id="msgCep" class="small text-danger"></p>
                                </div>
                            @endif
                                

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="shipping-method-area mt-70">
                            <div class="cart-page-heading">
                                <h5>Qual envio prefere?</h5>
                                <p>Escolha uma Opção</p>
                            </div>

                            @if ($cep == null)
                                
                                <div class="custom-control custom-radio mb-15">
                                    <input type="radio" id="customRadio1" name="customRadio" value="1" class="custom-control-input" disabled>
                                    <label id="labelRadio1" class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio1">
                                        <span id="pac">&nbsp;Normal</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoPac"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoPac"></span>
                                    </label>
                                </div>
                                <div class="custom-control custom-radio mb-15">
                                    <input type="radio" id="customRadio2" name="customRadio" value="2" class="custom-control-input" disabled>
                                    <label id="labelRadio2" class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio2">
                                        <span id="sedex">&nbsp;Expresso</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoSedex"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoSedex"></span>
                                    </label>
                                </div>
                                <div id="divMaktub" hidden class="custom-control custom-radio mb-15">
                                    <input type="radio" id="customRadio3" name="customRadio" value="3" class="custom-control-input">
                                    <label id="labelRadio3" class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio3">
                                        <span id="maktub">&nbsp;Entrega Vip-X</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoMaktub"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoMaktub"></span>
                                    </label>
                                </div>

                            @else

                                @if (Session::has('shippingData'))

                                    @if (Session::get('shippingData')[0]['tipo'] == 1)
                                        <div class="custom-control custom-radio mb-15">
                                            <input type="radio" id="customRadio1" name="customRadio" value="1" class="custom-control-input" checked>
                                            <label id="labelRadio1" class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio1">
                                                {{--<span id="pac">&nbsp;Normal</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoPac">R$ {{ Session::get('shippingOptions')[0]['valorPac'] }}</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoPac">{{ Session::get('shippingOptions')[0]['prazoPac'] . ' dias úteis ' }}</span>--}}
                                                <span id="pac">&nbsp;Normal</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoPac"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoPac"></span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-radio mb-15">
                                            <input type="radio" id="customRadio2" name="customRadio" value="2" class="custom-control-input">
                                            <label id="labelRadio2" class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio2">
                                                {{--<span id="sedex">&nbsp;Expresso</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoSedex">R$ {{ Session::get('shippingOptions')[0]['valorSedex'] }}</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoSedex">{{ Session::get('shippingOptions')[0]['prazoSedex'] . ' dias úteis ' }}</span>--}}
                                                <span id="sedex">&nbsp;Expresso</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoSedex"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoSedex"></span>
                                            </label>
                                        </div>
                                        <div id="divMaktub" hidden class="custom-control custom-radio mb-15">
                                            <input type="radio" id="customRadio3" name="customRadio" value="3" class="custom-control-input">
                                            <label id="labelRadio3" class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio3">
                                                {{--<span id="maktub">&nbsp;Entrega Vip-X</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoMaktub">R$ {{ Session::get('shippingOptions')[0]['valorMaktub'] }}</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoMaktub">{{ Session::get('shippingOptions')[0]['prazoSedex'] . ' dias úteis ' }}</span>--}}
                                                <span id="maktub">&nbsp;Entrega Vip-X</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoMaktub"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoMaktub"></span>
                                            </label>
                                        </div>
                                    @elseif(Session::get('shippingData')[0]['tipo'] == 2)
                                        <div class="custom-control custom-radio mb-15">
                                            <input type="radio" id="customRadio1" name="customRadio" value="1" class="custom-control-input">
                                            <label id="labelRadio1" class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio1">
                                                <span id="pac">&nbsp;Normal</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoPac"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoPac"></span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-radio mb-15">
                                            <input type="radio" id="customRadio2" name="customRadio" value="2" class="custom-control-input" checked>
                                            <label id="labelRadio2" class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio2">
                                                <span id="sedex">&nbsp;Expresso</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoSedex"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoSedex"></span>
                                            </label>
                                        </div>
                                        <div id="divMaktub" hidden class="custom-control custom-radio mb-15">
                                            <input type="radio" id="customRadio3" name="customRadio" value="3" class="custom-control-input">
                                            <label id="labelRadio3" class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio3">
                                                <span id="maktub">&nbsp;Entrega Vip-X</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoMaktub"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoMaktub"></span>
                                            </label>
                                        </div>
                                    @else
                                        <div class="custom-control custom-radio mb-15">
                                            <input type="radio" id="customRadio1" name="customRadio" value="1" class="custom-control-input">
                                            <label id="labelRadio1" class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio1">
                                                <span id="pac">&nbsp;Normal</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoPac"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoPac"></span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-radio mb-15">
                                            <input type="radio" id="customRadio2" name="customRadio" value="2" class="custom-control-input">
                                            <label id="labelRadio2" class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio2">
                                                <span id="sedex">&nbsp;Expresso</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoSedex"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoSedex"></span>
                                            </label>
                                        </div>
                                        <div id="divMaktub" hidden class="custom-control custom-radio mb-15">
                                            <input type="radio" id="customRadio3" name="customRadio" value="3" class="custom-control-input" checked>
                                            <label id="labelRadio3" class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio3">
                                                <span id="maktub">&nbsp;Entrega Vip-X</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoMaktub"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoMaktub"></span>
                                            </label>
                                        </div>
                                    @endif

                                @else
                                    <div class="custom-control custom-radio mb-15">
                                        <input type="radio" id="customRadio1" name="customRadio" value="1" class="custom-control-input">
                                        <label id="labelRadio1" class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio1">
                                            <span id="pac">&nbsp;Normal</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoPac"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoPac"></span>
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio mb-15">
                                        <input type="radio" id="customRadio2" name="customRadio" value="2" class="custom-control-input" checked>
                                        <label id="labelRadio2" class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio2">
                                            <span id="sedex">&nbsp;Expresso</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoSedex"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoSedex"></span>
                                        </label>
                                    </div>
                                    <div id="divMaktub" hidden class="custom-control custom-radio mb-15">
                                        <input type="radio" id="customRadio3" name="customRadio" value="3" class="custom-control-input">
                                        <label id="labelRadio3" class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio3">
                                            <span id="maktub">&nbsp;Entrega Vip-X</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoMaktub"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoMaktub"></span>
                                        </label>
                                    </div>
                                @endif
                                
                            @endif

                            <div>
                                <p id="pMsgErro" class="text-danger small" hidden></p>
                                <p id="pMsgErro2" class="text-danger small" hidden></p>
                            </div>

                        </div>

                    </div>

                    <div class="col-12 col-lg-4">
                        <div class="cart-total-area mt-70">
                            <div class="cart-page-heading">
                                <h5>Valor do Carrinho</h5>
                                <p>Informações Finais</p>
                            </div>

                            <ul class="cart-total-chart">
                                <li>
                                    <span>Subtotal</span>
                                    <span id="precoSubTotal">R$ {{ number_format((Session::get('subtotalPrice')), 2, ',', '.') }}</span>
                                </li>
                                <li>
                                    <span>Frete</span>
                                    @if (Session::has('shippingData'))
                                        <span id="precoFrete">R$ {{ number_format((Session::get('shippingData')[0]['valor']), 2, ',', '.') }}</span>
                                    @else
                                        <span id="precoFrete">R$ ---</span>
                                    @endif
                                </li>
                                <li>
                                    <input type="hidden"  id="valorTotal" name="valorTotal" value="{{ Session::get('totalPrice') }}">
                                    <span>
                                        <strong>Total</strong>
                                    </span>
                                    <span id="precoTotal">
                                        @if($cep != null)
                                            <strong>R$ {{ number_format((Session::get('totalPrice')), 2, ',', '.') }}</strong>
                                        @else
                                            <strong>R$ {{ number_format((Session::get('subtotalPrice')), 2, ',', '.') }}</strong>
                                        @endif
                                    </span>
                                </li>
                            </ul>

                            @if (Auth::check())
                                @if($cep != null)
                                    <a id="btnConcluirCompra" href="{{ route('payment.checkout') }}" class="btn btn-template w-100">Concluir Compra</a>
                                @else
                                    <a id="btnConcluirCompra" href="{{ route('payment.checkout') }}" class="btn btn-template w-100 disabled">Concluir Compra</a>
                                @endif
                            @else
                                <button id="btnRedirectLogin" class="btn btn-template w-100">Faça Login para finalizar compra</button>
                            @endif
                        
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal novo endereço -->
    @component('pages.app.components.modals.newaddress')                                                
    @endcomponent

    <br><br><br><br>

<script src="{{asset('js/app/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/app/waves.js')}}"></script>
<script src="{{asset('js/app/input.js')}}"></script>
<script src="{{asset('js/app/form-validation.js')}}"></script>

<script>

    const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $(function () {

        let cep = $('#cepPrincipal').val();
        let peso = parseFloat($('#pesoTotal').val());
        peso = peso / 1000;
        let qtd = 0;

        if (cep != "") {

            new Promise((resolve, reject) => {
                $('.qty-text').each(function(){
                    console.log($(this).val());
                    qtd += parseInt($(this).val());
                    console.log(qtd);
                });

                resolve();
            })
            .then(() => {
                throw new Error('Não foi capaz de buscar dados do frete');
            })
            .catch(() => {
                ajaxFrete($('#num_cep1').text());
            });

        }

        //==============================================================================================================
        //FUNÇÃO PARA CALCULAR FRETE
        function ajaxFrete(cep){
            $.ajax({
                url: '{{ route('shipping.calculate') }}',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    //cep: $('#cep').val(),
                    cep: cep,
                    width: $('#larguraTotal').val(),
                    height: $('#alturaTotal').val(),
                    length: $('#comprimentoTotal').val(),
                    weight: peso,
                    price: $('#valorTotal').val(),
                    quantity: qtd
                },
                success: function (values) {

                    $('#customRadio1').removeAttr('disabled');
                    $('#customRadio2').removeAttr('disabled');
                    $('#customRadio3').removeAttr('disabled');

                    let prazoPac = values.fretes.pac.prazo + 3;
                    let prazoSedex = values.fretes.sedex.prazo + 3;

                    $('#prazoPac').html(prazoPac + ' dias úteis');
                    $('#prazoSedex').html(prazoSedex + ' dias úteis');

                    $('#precoSedex').html('R$ ' + values.fretes.sedex.valor[0]);
                    $('#precoPac').html('R$ ' + values.fretes.pac.valor[0]);

                    $('.destino_cliente').removeAttr('disabled');

                    console.log(values.fretes.maktub.valor);

                    if(values.fretes.maktub.valor != 0){
                        $('#divMaktub').removeAttr('hidden');
                        $('#precoMaktub').html('R$ ' + values.fretes.maktub.valor);
                        $('#prazoMaktub').html(values.fretes.maktub.prazo + ' horas');
                    }
                    else{
                        $('#divMaktub').attr('hidden', true);
                        $('#precoMaktub').html('');
                        $('#prazoMaktub').html('');
                    }

                    if(values.fretes.sedex.obs != ""){
                        $('#pMsgErro').text(values.fretes.sedex.obs);
                        $('#pMsgErro2').text("Obs: Regra acima não se aplica a Entrega Vip-X.");
                        $('#pMsgErro').removeAttr('hidden');
                        $('#pMsgErro2').removeAttr('hidden');
                    }
                    else{
                        $('#pMsgErro').text("");
                        $('#pMsgErro2').text("");
                        $('#pMsgErro').attr('hidden', true);
                        $('#pMsgErro2').attr('hidden', true);
                    }


                }
            })
                .done(function(){
                    let shippingPrice = '';
                    let days = '';
                    let type = '';
                    if($('#customRadio1').is(':checked')) {
                        shippingPrice = $('#precoPac').html().replace('R$ ', '').replace(',', '.');
                        days = $('#prazoPac').html().substring(0, 1);
                        type = $('#customRadio1').val();

                        ajaxRadioButton(shippingPrice, days, type);
                    }
                    else if($('#customRadio2').is(':checked')) {
                        shippingPrice = $('#precoSedex').html().replace('R$ ', '').replace(',', '.');
                        days = $('#prazoSedex').html().substring(0, 1);
                        type = $('#customRadio2').val();

                        ajaxRadioButton(shippingPrice, days, type);
                    }
                    else if($('#customRadio3').is(':checked')){
                        if(!$('#divMaktub').is(':hidden')) {
                            shippingPrice = $('#precoMaktub').html().replace('R$ ', '').replace(',', '.');
                            days = 2;
                            type = $('#customRadio3').val();

                            ajaxRadioButton(shippingPrice, days, type);
                        }
                        else{
                            $('#customRadio1').prop('checked', true);
                            shippingPrice = $('#precoPac').html().replace('R$ ', '').replace(',', '.');
                            days = $('#prazoPac').html().substring(0, 1);
                            type = $('#customRadio1').val();

                            ajaxRadioButton(shippingPrice, days, type);
                        }
                    }
                });
        }

        let timer;
        //==============================================================================================================
        //CASO O CLIENTE ESTEJA LOGADO, ELE PODERÁ ESCOLHER QUAL ENDEREÇO QUE ELE QUER QUE ENVIE, DOS ENDEREÇOS CADASTRADOS
        $('.destino_cliente').click(function(){
            let id = $(this).attr('id');
            id = id.substr(id.length - 1, id.length);
            let cep = $('#num_cep'+id).text();
            $('.destino_cliente').attr('disabled', true);
            ajaxFrete(cep);
        });

        //==============================================================================================================
        //VERIFICA O CEP DO CLIENTE
        $('#cep').blur(function(){
            let retorno = verificaCEP();
        });

        //Quando o campo cep perde o foco.
        function verificaCEP() {
            $("#msgCep").html("");
            let cep = $('#cep').val().replace(/\D/g, '');

            if (cep != "") {

                var validacep = /^[0-9]{8}$/;

                if(validacep.test(cep)) {

                    $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                        if (!("erro" in dados)) {

                        }
                        else {
                            $("#msgCep").html("CEP não encontrado.");
                            return false;
                        }
                    });
                }
                else {
                    $("#msgCep").html("Formato de CEP inválido.");
                    return false;
                }
            }

            return true;
        }

        //==============================================================================================================
        //Aumenta a quantidade de cada item no carrinho
        $('.qty-plus').click(function(e){

            var idx = $(this).attr('id');
            var qtd = parseInt($('#qty' + idx).val());
            var precoProd = parseFloat($('#precoProd' + idx).html().replace('R$ ', '').replace(',', '.'));
            var qtdEstoque = parseInt($('#qtProdEstoque' + idx).val());

            if (qtd == qtdEstoque - 5) {

                $(this).attr('disabled');

            }
            else {

                qtd += 1;

                $.ajax({
                    url: '{{ url('/page/cart/plus') }}/' + idx,
                    type: 'GET',
                    success: function (r) {

                        location.reload();

                        $('.cart_quantity').html(r.qtCarrinho);
                        $('#qty' + idx).val(r.cartSession[idx].qtdIndividual);
                        $('#valorTotal' + idx).html('R$ ' + r.cartSession[idx].valorTotalProduto.toFixed(2).replace('.', ','));
                        $('#precoSubTotal').html('R$ ' + r.subTotal.toFixed(2).replace('.', ','));
                        $('#precoCalcTotal').html('R$ ' + r.total.toFixed(2).replace('.', ','));

                    }
                });

            }

        });

        //==============================================================================================================
        //Diminui a quantidade de cada item no carrinho
        $('.qty-minus').click(function (e){

            var idx = $(this).attr('id');
            var qtd = parseInt($('#qty' + idx).val());
            var precoProd = parseFloat($('#precoProd' + idx).html().replace('R$ ', '').replace(',', '.'));

            if (qtd == 1) {

                $('.qty-minus').attr('disabled');

            }
            else {

                qtd -= 1;

                $('.qty-minus').attr('disabled');

                $.ajax({
                    url: '{{ url('/page/cart/minus') }}/' + idx,
                    type: 'GET',
                    data: {},
                    success: function (r) {

                        location.reload();

                        $('.cart_quantity').html(r.qtCarrinho);
                        $('#qty' + idx).val(r.cartSession[idx].qtdIndividual);
                        $('#valorTotal' + idx).html('R$ ' + r.cartSession[idx].valorTotalProduto.toFixed(2).replace('.', ','));
                        $('#precoSubTotal').html('R$ ' + r.subTotal.toFixed(2).replace('.', ','));
                        $('#precoCalcTotal').html('R$ ' + r.total.toFixed(2).replace('.', ','));

                    }
                });

            }

        });

        //==============================================================================================================
        //CASO O CLIENTE NÃO ESTEJA LOGADO, BOTÃO CALCULA O FRETE DO CLIENTE
        $('#calculateShipping').click(function () {
            console.log($('#cep').val().length);

            let cepValido = verificaCEP();
            console.log(cepValido)

            if($('#cep').val().length == 8 && cepValido)
                ajaxFrete($('#cep').val());
            else{
                $('#divMaktub').attr('hidden', true);
                $('#precoPac').html('');
                $('#precoSedex').html('');
                $('#precoMaktub').html('');
                $('#precoFrete').html('R$ ---');
                $('#prazoPac').html('');
                $('#prazoSedex').html('');
                $('#prazoMaktub').html('');
                $('#pMsgErro').html('');
                $('#precoTotal').html('<strong>' + $('#precoSubTotal').text() + '</strong>');
                $('#customRadio1').attr('disabled', true);
                $('#customRadio2').attr('disabled', true);
                $('#customRadio3').attr('disabled', true);

            }
        });

        //==============================================================================================================
        //CHAMA A FUNÇÃO ajaxRadioButton PARA ATUALIZAR OS PREÇOS
        $('#customRadio1').click(function () {

            let shippingPrice = $('#precoPac').html().replace('R$ ', '').replace(',', '.');
            let days = $('#prazoPac').html().substring(0, 1);
            let type = $(this).val();

            ajaxRadioButton(shippingPrice, days, type);

        });

        //==============================================================================================================
        //CHAMA A FUNÇÃO ajaxRadioButton PARA ATUALIZAR OS PREÇOS
        $('#customRadio3').click(function(){
            let shippingPrice = $('#precoMaktub').html().replace('R$ ', '').replace(',', '.');
            let days = 2;
            let type = $(this).val();

            ajaxRadioButton(shippingPrice, days, type);
        });

        //==============================================================================================================
        //FUNÇÃO PARA ATUALIZAR OS PREÇOS DOS RADIOBUTTONS
        function ajaxRadioButton(shippingPrice, days, type){
            $.ajax({
                url: '{{ route('shipping.data') }}',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    shippingType: type,
                    shippingPrice: shippingPrice,
                    shippingDays: days,
                    totalPrice: $('#valorTotal').val()
                },
                success: function (value) {

                    //$('#btnConcluirCompra').removeClass('disabled');
                    let precoTotal = parseFloat(value.shippingData.precoTotal).toFixed(2);
                    let precoFrete = parseFloat(value.shippingData.valor).toFixed(2);
                    console.log(precoTotal);
                    console.log(precoFrete);

                    $('#precoFrete').html('R$ ' + precoFrete.replace('.', ','));
                    $('#precoTotal').html('<strong>R$ ' + precoTotal.replace('.', ',') + '</strong>');

                }
            });
        }

        //==============================================================================================================
        //CHAMA A FUNÇÃO ajaxRadioButton PARA ATUALIZAR OS PREÇOS
        $('#customRadio2').click(function () {

            let shippingPrice = $('#precoSedex').html().replace('R$ ', '').replace(',', '.');
            let days = $('#prazoSedex').html().substring(0, 1);
            let type = $(this).val();

            ajaxRadioButton(shippingPrice, days, type);

        });

        //==============================================================================================================
        //REDIRECT PARA P LOGIN DO CLIENTE, CASO NÃO ESTEJA LOGADO
        $('#btnRedirectLogin').click(function(){
            $.ajax({
                url: '{{route('cart.data')}}',
                type: 'post',
                data: {_token: CSRF_TOKEN},
                success: function(){
                    window.location.href = '{{route('client.login')}}';
                }
            });
        });

        //==============================================================================================================
        //CHAMA O MODAL PARA CADASTRAR UM ENDEREÇO NOVO
        $('#modalNewAddress').on('show.bs.modal', function (e) {

            let button = $(e.relatedTarget)
            let dataAddress = button.data('address')

            let modal = $(this)

            $.ajax({
                url: '{{ route('cart.route') }}',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                },
                success: function (val) {
                    console.log(val);
                }
            })

        });

    });

    </script>

@stop
