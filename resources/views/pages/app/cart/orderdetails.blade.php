@extends('layouts.app.app')

@section('content')

    <div class="container" STYLE="margin-bottom: 3.5%;">
        <div class="row" style="margin-top: 2.5%;">
            @include('partials.admin._alerts')
            <div class="col-12 col-md-12">
                <p class="h4 text-center">Detalhes da sua compra</p>
            </div>

            <div class="col-12 col-md-12" >
                <div class="cart-table clearfix table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Valor</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cart as $key => $produto)
                            {{--{{dd($produto)}}--}}
                            <tr>
                                <td class="cart_product_img d-flex align-items-center align-middle">
                                    <a href="javascipt:void(0);">
                                        <img src="{{ URL::asset('img/products' . '/' . $produto['imagemProduto']) }}" alt="Product">
                                    </a>
                                    <p style="font-size: 14px;">{{ $produto['nomeProduto'] }}</p>
                                </td>
                                <td class="qty align-middle text-center">
                                    <div class="quantity">
                                        <span>{{ $produto['qtdIndividual'] }}</span>
                                    </div>
                                </td>
                                <td class="price align-middle align-items-center">
                                    <span id="{{ 'precoTotalProd' . $key }}">
                                        R$ {{ number_format($produto['valorTotalProduto'], 2, ',', '.') }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            @if ($shippingData[0]['tipo'] == 1)
                                <td class="text-right" colspan="2"><b>FRETE ESCOLHIDO:</b> PAC</td>
                                <td class="price align-middle align-items-center">
                                    <span id="precoFrete">
                                        R$ {{ number_format(($shippingData[0]['valor']), 2, ',', '.') }}
                                    </span>
                                </td>
                            @elseif($shippingData[0]['tipo'] == 2)
                                <td class="text-right" colspan="2"><b>FRETE ESCOLHIDO:</b></b> SEDEX</td>
                                <td class="price align-middle align-items-center">
                                    <span id="precoFrete">
                                        R$ {{ number_format(($shippingData[0]['valor']), 2, ',', '.') }}
                                    </span>
                                </td>
                            @else
                                <td class="text-right" colspan="2"><b>FRETE ESCOLHIDO:</b></b> ENTREGA VIP-X</td>
                                <td class="price align-middle align-items-center">
                                    <span id="precoFrete">
                                        R$ {{ number_format(($shippingData[0]['valor']), 2, ',', '.') }}
                                    </span>
                                </td>
                            @endif
                        </tr>
                        @if ($paymentType == 'cartao')
                            @if ($creditCardInfo[0]['installmentQuantity'] > 3)
                                <tr>
                                    <td class="text-right" colspan="2"><b>JUROS PARCELAMENTO:</b></td>
                                    <td class="price align-middle align-items-center">
                                        <span id="precoJuros">
                                            R$ {{ number_format(($creditCardInfo[0]['totalAmount'] - Session::get('totalPrice')) , 2, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td class="text-right" colspan="2"><strong>TOTAL</strong></td>
                                <td class="total_price align-middle">
                                    <span id="valorTotal">
                                        <strong>R$ {{ number_format($creditCardInfo[0]['totalAmount'], 2, ',', '.') }}</strong>
                                    </span>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td class="text-right" colspan="2"><strong>TOTAL</strong></td>
                                <td class="total_price align-middle">
                                    <span id="valorTotal">
                                        {{--<strong>R$ {{ number_format( ($produto['valorTotalProduto'] + $shippingData[0]['valor']), 2, ',', '.') }}</strong>--}}
                                        <strong>R$ {{number_format(\Illuminate\Support\Facades\Session::get('totalPrice'), 2, ',', '.')}}</strong>
                                    </span>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-12 col-md-12">
                <div class="col-11 col-md-11">
                    @if ($paymentType == 'boleto')
                        <p><b>FORMA DE PAGAMENTO:</b>&nbsp;BOLETO BANCÁRIO</p>
                    @else
                        @if ($creditCardInfo[0]['installmentQuantity'] > 3)
                            <p>Forma de pagamento: {{ $creditCardInfo[0]['installmentQuantity'] }}x com juros no cartão de crédito (R$&nbsp;{{ number_format($creditCardInfo[0]['totalAmount'], 2, ',', '.') }})</p>
                        @else
                            <p>Forma de pagamento: {{ $creditCardInfo[0]['installmentQuantity'] }}x sem juros no cartão de crédito (R$&nbsp;{{ number_format($creditCardInfo[0]['totalAmount'], 2, ',', '.') }})</p>
                        @endif
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="col-12 col-md-12">
                    <a href="{{ route('cart.page') }}" class="btn btn-template pull-left">Revisar pedido</a>
                    @if ($paymentType == 'boleto')
                        <form action="{{ route('payment.ticket') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" class="senderHash" name="senderHash" value="">
                            <input type="hidden" name="cd_cliente" value="{{ Auth::user()->cd_cliente }}">
                            <button id="btn_finalizar" type="submit" class="btn btn-template pull-right" disabled>Finalizar Compra</button>
                        </form>
                    @else
                        <form action="{{ route('payment.creditcard') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" class="senderHash" name="senderHash" value="">
                            <input type="hidden" name="cardToken" value="{{ $creditCardInfo[0]['cardToken'] }}">
                            <input type="hidden" name="cd_cliente" value="{{ Auth::user()->cd_cliente }}">
                            <button id="btn_finalizar" type="submit" class="btn btn-template pull-right" disabled>Finalizar Compra</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            PagSeguroDirectPayment.onSenderHashReady(function(response){
                if(response.status == 'error') {
                    return false;
                }
                $('.senderHash').val(response.senderHash)
                $('#btn_finalizar').removeAttr('disabled');
            });

            $('#btn_finalizar').click(function(e){
                //e.preventDefault();
            });

            {{--console.log({{ number_format( ($produto['valorTotalProduto'] + $shippingData[0]['valor']), 2, ',', '.') }});
            console.log({{number_format($produto['valorTotalProduto'])}});
            console.log({{number_format($shippingData[0]['valor'])}});
            console.log({{\Illuminate\Support\Facades\Session::get('totalPrice')}});--}}
        })
    </script>

@stop