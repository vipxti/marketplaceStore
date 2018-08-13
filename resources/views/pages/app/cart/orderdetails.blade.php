@extends('layouts.app.app')

@section('content')

    <div class="container">

        <div class="row">

            @include('partials.app._alerts')

        </div>

        <div class="row">

            <p>&nbsp;</p>

            <div class="col-12">

                <p class="h4">Detalhes da sua compra</p>

            </div>

        </div>

        <p>&nbsp;</p>

        <div class="row">

            <div class="col-12 offset-md-1">

                <div class="cart-table clearfix">
                            
                    <table class="table table-responsive">
                        
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                    
                        <tbody>

                            @foreach($cart as $key => $produto)

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

                                        <td class="text-right" colspan="2">Frete escolhido: PAC</td>

                                        <td class="price align-middle align-items-center">
                                            <span id="precoFrete">
                                                R$ {{ number_format(strval($shippingData[0]['valor']), 2, ',', '.') }}
                                            </span>
                                        </td>

                                    @else

                                        <td class="text-right" colspan="2">Frete escolhido: Sedex</td>

                                        <td class="price align-middle align-items-center">
                                            <span id="precoFrete">
                                                R$ {{ number_format(strval($shippingData[0]['valor']), 2, ',', '.') }}
                                            </span>
                                        </td>
                                        
                                    @endif

                                </tr>

                                @if ($paymentType == 'cartao')

                                    @if ($creditCardInfo[0]['installmentQuantity'] > 3)

                                        <tr>

                                            <td class="text-right" colspan="2">Juros parcelamento:</td>
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
                                                <strong>R$ {{ number_format( ($produto['valorTotalProduto'] + $shippingData[0]['valor']), 2, ',', '.') }}</strong>
                                            </span>
                                        </td>

                                    </tr>
 
                                @endif

                        </tbody>

                    </table>
                
                </div>

            </div>

        </div>

        <p>&nbsp;</p>

        <div class="row">

            @if ($paymentType == 'boleto')

                <div class="col-12">

                    <p>Forma de pagamento: Boleto bancário</p>

                </div>
                
            @else

                <div class="col-12">

                    @if ($creditCardInfo[0]['installmentQuantity'] > 3)

                        <p>Forma de pagamento: {{ $creditCardInfo[0]['installmentQuantity'] }}x com juros no cartão de crédito (R$&nbsp;{{ number_format($creditCardInfo[0]['totalAmount'], 2, ',', '.') }})</p>
                        
                    @else

                        <p>Forma de pagamento: {{ $creditCardInfo[0]['installmentQuantity'] }}x sem juros no cartão de crédito (R$&nbsp;{{ number_format($creditCardInfo[0]['totalAmount'], 2, ',', '.') }})</p>
                        
                    @endif

                </div>
                
            @endif

        </div>

        <p>&nbsp;</p>

        <div class="row">

            <div class="col-12 col-md-2">

                 <a href="{{ route('cart.page') }}" class="btn btn-template">Revisar pedido</a>

            </div>

            <div class="col-12 col-md-3">

                @if ($paymentType == 'boleto')

                    <form action="{{ route('payment.ticket') }}" method="post">
                        {{ csrf_field() }}

                        <input type="hidden" class="senderHash" name="senderHash" value="">
                        <input type="hidden" name="cd_cliente" value="{{ Auth::user()->cd_cliente }}">

                        <button type="submit" class="btn btn-template">Finalizar compra</button>

                    </form>
                    
                @else

                    <form action="{{ route('payment.creditcard') }}" method="post">
                        {{ csrf_field() }}

                        <input type="hidden" class="senderHash" name="senderHash" value="">
                        <input type="hidden" name="cardToken" value="{{ $creditCardInfo[0]['cardToken'] }}">
                        <input type="hidden" name="cd_cliente" value="{{ Auth::user()->cd_cliente }}">

                        <button type="submit" class="btn btn-template">Finalizar compra</button>

                    </form>
                
                @endif

            </div>

        </div>

        <p>&nbsp;</p>

    </div>

    <script>
    
        $(function () {

            PagSeguroDirectPayment.onSenderHashReady(function(response){

                if(response.status == 'error') {
                    return false;
                }

                $('.senderHash').val(response.senderHash)
                
            })

        })
    
    </script>
    
@stop