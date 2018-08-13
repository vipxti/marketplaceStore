@extends('layouts.app.app')

@section('content')

    <!-- ****** Cart Area Start ****** -->
    <br><br><br>
    <div class="cart_area clearfix">

        {{--<div class="container">

           --}}{{-- <div class="row">
                <div class="col-12">
                    <div class="section_heading text-center">
                        <h3><i class="fa fa-shopping-cart"></i>&nbsp; Meu Carrinho</h3>
                    </div>
                </div>
            </div>--}}{{--

            <p>&nbsp;</p>

            @if(Session::get('cart') == null)
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="{{asset('img/app/bg-img/carrinhovazio.png')}}" alt="">
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-12 col-md-12 text-right">
                        <a href="{{ route('products.page')}}" class="btn btn-template" style="width: 100%">Continuar Comprando</a>
                    </div>
                </div>
            @else

                <div class="row">
                    <div class="col-12">
                        <div class="cart-table clearfix">
                            <table class="table table-responsive">
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
                                                    <i id="spinner_qtd" class="fa fa-spinner fa-pulse fa-3x fa-fw" style="font-size: 22px; visibility: hidden"></i>
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
                </div>

                <p>&nbsp;</p>

                <div class="row">

                    <div class="col-12 col-md-5">

                        <div class="cart-page-heading">
                            <p>&nbsp;</p>
                            <p class="h2 text-justify">Digite seu CEP</p>
                            <p>&nbsp;</p>
                            <form>
                                <label for="cep"> </label>
                                @if (Auth::check())
                                    <input type="hidden" id="cd_cep" name="cd_cep" value="{{ $cep[0]['cd_cep'] }}">
                                    <input type="text" name="cep" id="cep" value="{{ $cep[0]['cd_cep'] }}">
                                @else
                                    <input type="hidden" id="cd_cep" name="cd_cep" value="{{ $cep[0]['cd_cep'] }}">
                                    <input type="text" name="cep" id="cep" value="">
                                @endif
                                <button id="calculateShipping" type="button" style="padding:0 12px;"><i class="fa fa-search"></i></button>
                            </form>
                        </div>

                    </div>

                    <p>&nbsp;</p>

                    <div class="col-12 offset-md-1 col-md-5 d-flex text-justify">

                        <ul class="cart-page-heading w-100">

                            <h5>Qual envio prefere?</h5>
                            <p>Escolha uma Opção</p>

                            @if (Session::has('shippingData'))
                                @if (Session::get('shippingData')[0]['tipo'] == 1)
                                    <p>&nbsp;</p>
                                    <div class="custom-control custom-radio">

                                        <input type="radio" id="customRadio1" name="customRadio" value="1" class="custom-control-input" checked>
                                        <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio1">

                                            @if (Session::get('shippingOptions')[0]['prazoPac'] == 1)

                                                <span id="pac">&nbsp;Normal</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoPac">R$ {{ Session::get('shippingOptions')[0]['valorPac'] }}</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoPac">{{ Session::get('shippingOptions')[0]['prazoPac'] . ' dia útil ' }}</span>

                                            @else

                                                <span id="pac">&nbsp;Normal</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoPac">R$ {{ Session::get('shippingOptions')[0]['valorPac'] }}</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoPac">{{ Session::get('shippingOptions')[0]['prazoPac'] . ' dias úteis ' }}</span>

                                            @endif

                                        </label>

                                    </div>
                                    <div class="custom-control custom-radio">

                                        <input type="radio" id="customRadio2" name="customRadio" value="2" class="custom-control-input">
                                        <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio2">

                                            @if (Session::get('shippingOptions')[0]['prazoSedex'] == 1)

                                                <span id="sedex">&nbsp;Expresso</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoSedex">R$ {{ Session::get('shippingOptions')[0]['valorSedex'] }}</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoSedex">{{ Session::get('shippingOptions')[0]['prazoSedex'] . ' dia útil ' }}</span>

                                            @else

                                                <span id="sedex">&nbsp;Expresso</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoSedex">R$ {{ Session::get('shippingOptions')[0]['valorSedex'] }}</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoSedex">{{ Session::get('shippingOptions')[0]['prazoSedex'] . ' dias úteis ' }}</span>

                                            @endif

                                        </label>

                                    </div>
                                @else
                                    <p>&nbsp;</p>
                                    <div class="custom-control custom-radio">

                                        <input type="radio" id="customRadio1" name="customRadio" value="1" class="custom-control-input">
                                        <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio1">
                                            <span id="pac">&nbsp;Normal</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoPac"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoPac"></span>
                                        </label>

                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio2" name="customRadio" value="2" class="custom-control-input" checked>
                                        <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio2">
                                            <span id="sedex">&nbsp;Expresso</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoSedex"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoSedex"></span>
                                        </label>
                                    </div>
                                @endif
                            @else
                                <p>&nbsp;</p>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="customRadio" value="1" class="custom-control-input" disabled>
                                    <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio1">
                                        <span id="pac">&nbsp;Normal</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoPac"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoPac"></span>
                                    </label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="customRadio" value="2" class="custom-control-input" disabled>
                                    <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio2">
                                        <span id="sedex">&nbsp;Expresso</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoSedex"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoSedex"></span>
                                    </label>
                                </div>
                            @endif

                        </ul>

                    </div>

                </div>

                <p>&nbsp;</p>

                <div class="row">

                    <div class="col-12 offset-md-6 col-md-5">
                        <ul class="cart-total-chart w-100">

                            <li>
                                <span>Subtotal</span>

                                <span id="precoSubTotal">
                                    R$ {{ number_format((Session::get('subtotalPrice')), 2, ',', '.') }}
                                </span>
                            </li>

                            <li>

                                <span>Frete</span>
                                @if (Session::has('shippingData'))
                                    <span id="precoFrete">
                                        R$ {{ number_format((Session::get('shippingData')[0]['valor']), 2, ',', '.') }}
                                    </span>
                                @else
                                    <span id="precoFrete">
                                        R$ ---
                                    </span>
                                @endif
                            </li>

                            <li>

                                <span><strong>VALOR TOTAL</strong></span>

                                <input type="hidden"  id="valorTotal" name="valorTotal" value="{{ Session::get('totalPrice') }}">

                                <span id="precoTotal">
                                    <strong>R$ {{ number_format((Session::get('totalPrice')), 2, ',', '.') }}</strong>
                                </span>

                            </li>

                        </ul>
                    </div>

                    <p>&nbsp;</p>

                    <div class="col-12 offset-md-9 col-md-7">

                        <div class="cart-total-area mt-30">

                            <a href="{{ route('payment.checkout') }}" class="btn btn-template w-25">Concluir Compra</a>

                        </div>

                    </div>

                </div>

            @endif

        </div>--}}
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
                    <div class="row">
                        <div class="col-12">
                            <div class="cart-table clearfix">
                                <table class="table table-responsive">
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
                                                    <i id="spinner_qtd" class="fa fa-spinner fa-pulse fa-3x fa-fw" style="font-size: 22px; visibility: hidden"></i>
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
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="coupon-code-area mt-70">
                            <div class="cart-page-heading">
                                <h5>Cep</h5>
                                <p text-justify>Digite seu CEP</p>
                            </div>
                            <form>
                                @if (Auth::check())
                                    <input type="hidden" id="cd_cep" name="cd_cep" value="{{ $cep[0]['cd_cep'] }}">
                                    <input type="text" name="cep" id="cep" value="{{ $cep[0]['cd_cep'] }}" required>
                                @else
                                    <input type="hidden" id="cd_cep" name="cd_cep" value="{{ $cep[0]['cd_cep'] }}">
                                    <input type="text" name="cep" id="cep" value="" required>
                                @endif
                                <button id="calculateShipping" type="button"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="shipping-method-area mt-70">
                            <div class="cart-page-heading">
                                <h5>Qual envio prefere?</h5>
                                <p>Escolha uma Opção</p>
                            </div>
                            @if (Session::has('shippingData'))
                                @if (Session::get('shippingData')[0]['tipo'] == 1)
                                    <div class="custom-control custom-radio mb-30">
                                        <input type="radio" id="customRadio1" name="customRadio" value="1" class="custom-control-input" checked>
                                        <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio1">
                                            @if (Session::get('shippingOptions')[0]['prazoPac'] == 1)
                                                <span id="pac">&nbsp;Normal</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoPac">R$ {{ Session::get('shippingOptions')[0]['valorPac'] }}</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoPac">{{ Session::get('shippingOptions')[0]['prazoPac'] . ' dia útil ' }}</span>
                                            @else
                                                <span id="pac">&nbsp;Normal</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoPac">R$ {{ Session::get('shippingOptions')[0]['valorPac'] }}</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoPac">{{ Session::get('shippingOptions')[0]['prazoPac'] . ' dias úteis ' }}</span>
                                            @endif
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio mb-30">
                                        <input type="radio" id="customRadio2" name="customRadio" value="2" class="custom-control-input">
                                        <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio2">
                                            @if (Session::get('shippingOptions')[0]['prazoSedex'] == 1)
                                                <span id="sedex">&nbsp;Expresso</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoSedex">R$ {{ Session::get('shippingOptions')[0]['valorSedex'] }}</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoSedex">{{ Session::get('shippingOptions')[0]['prazoSedex'] . ' dia útil ' }}</span>
                                            @else
                                                <span id="sedex">&nbsp;Expresso</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoSedex">R$ {{ Session::get('shippingOptions')[0]['valorSedex'] }}</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoSedex">{{ Session::get('shippingOptions')[0]['prazoSedex'] . ' dias úteis ' }}</span>
                                            @endif
                                        </label>
                                    </div>
                                @else
                                    <div class="custom-control custom-radio mb-30">
                                        <input type="radio" id="customRadio1" name="customRadio" value="1" class="custom-control-input">
                                        <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio1">
                                            <span id="pac">&nbsp;Normal</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoPac"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoPac"></span>
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio mb-30">
                                        <input type="radio" id="customRadio2" name="customRadio" value="2" class="custom-control-input" checked>
                                        <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio2">
                                            <span id="sedex">&nbsp;Expresso</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoSedex"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoSedex"></span>
                                        </label>
                                    </div>
                                @endif
                            @else
                                <div class="custom-control custom-radio mb-30">
                                    <input type="radio" id="customRadio1" name="customRadio" value="1" class="custom-control-input" disabled>
                                    <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio1">
                                        <span id="pac">&nbsp;Normal</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoPac"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoPac"></span>
                                    </label>
                                </div>
                                <div class="custom-control custom-radio mb-30">
                                    <input type="radio" id="customRadio2" name="customRadio" value="2" class="custom-control-input" disabled>
                                    <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio2">
                                        <span id="sedex">&nbsp;Expresso</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="precoSedex"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="prazoSedex"></span>
                                    </label>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-total-area mt-70">
                            <div class="cart-page-heading">
                                <h5>Valor do Carrinho</h5>
                                <p>Informaçoes Finais</p>
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
                                    <strong>R$ {{ number_format((Session::get('totalPrice')), 2, ',', '.') }}</strong>
                                </span>
                                </li>
                            </ul>
                            <a href="{{ route('payment.checkout') }}" class="btn btn-template w-100">Concluir Compra</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>


    <br><br><br><br>

    <script>

        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(function () {



        })

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

        $('#calculateShipping').click(function () {

            $.ajax({
                url: '{{ route('shipping.calculate') }}',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    cep: $('#cep').val(),
                    width: $('#larguraTotal').val(),
                    height: $('#alturaTotal').val(),
                    length: $('#comprimentoTotal').val(),
                    weight: $('#pesoTotal').val(),
                    price: $('#valorTotal').val()
                },
                success: function (values) {

                    $('#customRadio1').removeAttr('disabled')
                    $('#customRadio2').removeAttr('disabled')

                    let prazoPac = values.fretes.pac.prazo + 3;
                    let prazoSedex = values.fretes.sedex.prazo + 3;

                    if (prazoPac == 1) {

                        $('#prazoPac').html(prazoPac + ' dia útil');

                    } else {

                        $('#prazoPac').html(prazoPac + ' dias úteis');

                    }

                    $('#precoPac').html('R$ ' + values.fretes.pac.valor[0]);

                    if (prazoSedex == 1) {

                        $('#prazoSedex').html(prazoSedex + ' dia útil');

                    } else {

                        $('#prazoSedex').html(prazoSedex + ' dias úteis');

                    }

                    $('#precoSedex').html('R$ ' + values.fretes.sedex.valor[0]);

                }
            })

        })

        $('#customRadio1').click(function () {

            let shippingPrice = $('#precoPac').html().replace('R$ ', '').replace(',', '.');
            let days = $('#prazoPac').html().substring(0, 1);

            $.ajax({
                url: '{{ route('shipping.data') }}',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    shippingType: $(this).val(),
                    shippingPrice: shippingPrice,
                    shippingDays: days,
                    totalPrice: $('#valorTotal').val()
                },
                success: function (value) {

                    let precoTotal = parseFloat(value.shippingData.precoTotal).toFixed(2);
                    let precoFrete = parseFloat(value.shippingData.valor).toFixed(2);

                    $('#precoFrete').html('R$ ' + precoFrete.replace('.', ','))
                    $('#precoTotal').html('<strong>R$ ' + precoTotal.replace('.', ',') + '</strong>')

                }
            })
        });

        $('#customRadio2').click(function () {

            let shippingPrice = $('#precoSedex').html().replace('R$ ', '').replace(',', '.');
            let days = $('#prazoSedex').html().substring(0, 1);

            $.ajax({
                url: '{{ route('shipping.data') }}',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    shippingType: $(this).val(),
                    shippingPrice: shippingPrice,
                    shippingDays: days,
                    totalPrice: $('#valorTotal').val()
                },
                success: function (value) {

                    let precoTotal = parseFloat(value.shippingData.precoTotal).toFixed(2);
                    let precoFrete = parseFloat(value.shippingData.valor).toFixed(2);

                    $('#precoFrete').html('R$ ' + precoFrete.replace('.', ','))
                    $('#precoTotal').html('<strong>R$ ' + precoTotal.replace('.', ',') + '</strong>')

                }
            })

        });

    </script>

@stop
