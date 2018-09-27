@extends('layouts.app.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12" style="margin-top: 40px; margin-bottom: 15px;">

                <p class="h2 text-center">Resultado da compra</p>
                @if ($orderData[0]['statusCompra'] == '1')

                    <p class="text-center text-success" style="font-size: 20px">Pedido realizado com sucesso!!!</p>
                    <div class="d-flex justify-content-center">
                        <p style="width: 75px; height: 75px"><img src="{{asset('img/app/bg-img/correct.png')}}" alt=""></p>
                    </div>
                    <br>
                    <div class="text-center">
                        <p>Você receberá uma confirmação de pagamento pelo seu e-mail registrado.</p>
                        <p>Os prazos variam de acordo com o tempo de confirmação de pagamento da instituição financeira utilizada (no caso de pagamento por Cartão de Crédito).</p>
                        <p>No caso de pagamento feito via boleto bancário, o prazo para confirmação pode ser de até 3 dias úteis.</p>
                    </div>

                    @if ($orderData[0]['tipoPagamento'] == 'boleto')
                        <p class="d-flex justify-content-center">O código de sua compra no valor de R$ {{ number_format($orderData[0]['valorTotal'], 2, ',', '.') }} é &nbsp;<strong>{{ $orderData[0]['codigo'] }}</strong>.</p>
                        <p class="d-flex justify-content-center">Para realizar o pagamento, basta clicar no botão abaixo "Gerar boleto" e imprimir o boleto que será em outra aba de seu navegador.</p>
                        <p>&nbsp;</p>
                        <a href="{{ $orderData[0]['linkBoleto'] }}" class="btn btn-template d-flex justify-content-center" target="_blank">Imprimir boleto</a>
                    @endif
                @else

                        <p class="text-center text-danger" style="font-size: 20px">Pagamento não Concluido</p>
                        <div class="d-flex justify-content-center">
                            <p style="width: 75px; height: 75px"><img src="{{asset('img/app/bg-img/buyerror.png')}}" alt=""></p>
                        </div>
                        <br>
                        <div class="text-center">
                            <p>Todo Pagamento iniciado e não concluído (por problema no internet banking, boleto não pago até a data de vencimento, falta de plugin java, entre outros) será automaticamente cancelado.</p>
                            <p>Se você quiser simplesmente alterar a forma de pagamento, o procedimento é o mesmo:desconsiderar este pagamento e fazer um novo.</p>
                        </div>
                        <br>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-template" href="{{ route('cart.page')}}">Voltar ao Carrinho</a>
                        </div>

                @endif
            </div>
        </div>
    </div>
@stop