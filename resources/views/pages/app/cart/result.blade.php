@extends('layouts.app.app')

@section('content')

    {{ dd($orderData) }}

    <p class="h2 text-center">Resultado da compra</p>

    @if ($orderData['statusCompra'] == 'Ok')
        
        <p>Pedido realizado com sucesso!!!</p>

        @if ($orderData['tipoPagamento'] == 'boleto')
            
            <p>O código de sua compra no valor de R$ {{ number_format($orderData['valorTotal'], 2, ',', '.') }} é <strong>{{ $orderData['codigo'] }}</strong>.</p>
            <p>Para realizar o pagamento, basta clicar no botão abaixo "Gerar boleto" e imprimir o boleto que será em outra aba de seu navegador.</p>

            <p>&nbsp;</p>

            <a href="{{ $orderData['linkBoleto'] }}" class="btn btn-template" target="_blank">Gerar boleto</a>

        @else

            
            
        @endif

    @else
        
        <p>Mensagem de erro</p>

    @endif

@stop