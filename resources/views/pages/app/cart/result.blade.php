@extends('layouts.app.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">

                <p class="h2 text-center">Resultado da compra</p>

                @if ($orderData[0]['statusCompra'] == '1')
                    
                    <p>Pedido realizado com sucesso!!!</p>

                    @if ($orderData[0]['tipoPagamento'] == 'boleto')
                        
                        <p>O código de sua compra no valor de R$ {{ number_format($orderData[0]['valorTotal'], 2, ',', '.') }} é <strong>{{ $orderData[0]['codigo'] }}</strong>.</p>
                        <p>Para realizar o pagamento, basta clicar no botão abaixo "Gerar boleto" e imprimir o boleto que será em outra aba de seu navegador.</p>

                        <p>&nbsp;</p>

                        <a href="{{ $orderData[0]['linkBoleto'] }}" class="btn btn-template" target="_blank">Gerar boleto</a>

                    @else

                        
                        
                    @endif

                @else
                    
                    <p>Mensagem de erro</p>

                @endif

            </div>
        </div>
    </div>

    

@stop