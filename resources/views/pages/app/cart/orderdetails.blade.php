@extends('layouts.app.app')

@section('content')

    <div class="container">

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
                                <th>Valor</th>
                                <th>Quantidade</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                    
                        <tbody>

                            @foreach(Session::get('cart') as $key => $produto)

                                <tr>

                                    <td class="cart_product_img d-flex align-items-center align-middle">

                                        <a href="javascipt:void(0);">
                                            <img src="{{ URL::asset('img/products' . '/' . $produto['imagemProduto']) }}" alt="Product">
                                        </a>
                                        <p style="font-size: 14px;">{{ $produto['nomeProduto'] }}</p>

                                    </td>

                                    <td class="price align-middle align-items-center"><span id="{{ 'precoProd' . $key }}">R$ {{ number_format($produto['valorProduto'], 2, ',', '.') }}</span></td>

                                    <td class="qty align-middle text-center">
                                        <div class="quantity">

                                            <span>{{ $produto['qtdIndividual'] }}</span>
                                            
                                        </div>
                                    </td>

                                    <td class="total_price align-middle">
                                        <span id="{{ 'valorTotal' . $key }}">
                                            R$ {{ number_format($produto['valorTotalProduto'], 2, ',', '.') }}
                                        </span>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>
                
                </div>

            </div>

        </div>

        <p>&nbsp;</p>

        <div class="row">

            @if ($paymentType == 'boleto')

                <div class="col-12">

                    <p>Forma de pagamento: Boleto</p>

                </div>
                
            @else

                <div class="col-12">

                    @if (Session::get('creditCardInfo')[0]['installmentQuantity'] > 3)

                        <p>Forma de pagamento: {{ Session::get('creditCardInfo')[0]['installmentQuantity'] }}x com juros no cartão de crédito (R$&nbsp;{{ number_format(Session::get('creditCardInfo')[0]['installmentAmount'], 2, ',', '.') }})</p>
                        
                    @else

                        <p>Forma de pagamento: {{ Session::get('creditCardInfo')[0]['installmentQuantity'] }}x sem juros no cartão de crédito (R$&nbsp;{{ number_format(Session::get('creditCardInfo')[0]['installmentAmount'], 2, ',', '.') }})</p>
                        
                    @endif

                </div>
                
            @endif

        </div>

        <p>&nbsp;</p>

        <div class="row">

            @if ($paymentType == 'boleto')

                <form action="{{ route('payment.ticket') }}" method="post">
                    {{ csrf_field() }}

                    <input type="hidden" class="senderHash" name="senderHash" value="">
                    <input type="hidden" name="cd_cliente" value="{{ Auth::user()->cd_cliente }}">

                    <button type="submit" class="btn btn-template">Finalizar compra</button>

                </form>
                
            @else

                <form action="#" method="post">

                    <input type="hidden" class="senderHash" name="senderHash" value="">
                    <input type="hidden" name="cardToken" value="{{ Session::get('creditCardInfo')[0]['cardToken'] }}">
                    <input type="hidden" name="cd_cliente" value="{{ Auth::user()->cd_cliente }}">

                    <button type="submit" class="btn btn-template">Finalizar compra</button>

                </form>
                
            @endif


        </div>

    </div>

    <script>
    
        $(function () {

            PagSeguroDirectPayment.onSenderHashReady(function(response){

                if(response.status == 'error') {
                    location.reload()
                    return false;
                }

                $('.senderHash').val(response.senderHash)
                
            })

        })
    
    </script>
    
@stop