@extends('layouts.app.app')

@section('content')

    <link rel="stylesheet" href="{{asset('css/app/input.css')}}">

    <div class="container">
        <input type="hidden" id="orderValue" name="orderValue" value="{{ Session::get('totalPrice') }}">
        <input type="hidden" id="cardToken" name="cardToken" value="">
        <p>&nbsp;</p>
        <p class="h3 text-center">Formas de pagamento</p>
        <p>&nbsp;</p>
        <ul class="nav nav-tabs nav-fill">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#creditCard">Cartão de crédito</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#ticket">Boleto</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content" style="border-left: 1px solid #dee2e6; border-right: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6; margin-bottom: 2.5%;" >
            <div class="tab-pane container  active" id="creditCard">

                <div class="col-12">

                    <p>&nbsp;</p>

                    <form id="creditCardData">
                        {{ csrf_field() }}

                        <div class="row">

                            <div class="col-12 col-md-4 col-sm-6 offset-md-2">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input id="ownerName" type="text" class="form-control" name="client_name" required maxlength="50">
                                        <label class="form-label">Nome do titular</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-sm-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input id="cardNumber" type="text" class="form-control" name="card_number" required maxlength="16">
                                        <label class="form-label">Número do cartão</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-3 col-sm-4 offset-md-2">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input id="cvv" type="text" class="form-control" name="cvv" required maxlength="3" style="font-size: 0.9rem;">
                                        <label class="form-label" style="font-size: 0.9rem;">CVV</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-2 col-sm-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label" style="font-size: 0.7rem;">Mês vencimento</label>
                                        <select id="months" name="months" class="form-control" style="font-size: 0.9rem; padding-top: 7px; padding-bottom: 7px;">
                                            <option value=""></option>
                                            @foreach ($months as $month)
                                                @if ($month < 10)
                                                    <option value="{{ $month }}">{{ '0' . $month }}</option>
                                                @else
                                                    <option value="{{ $month }}">{{ $month }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-3 col-sm-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label" style="font-size: 0.7rem;">Ano vencimento</label>
                                        <select id="years" name="years" class="form-control" style="font-size: 0.9rem; padding-top: 7px; padding-bottom: 7px;">
                                            <option value=""></option>
                                            @foreach ($years as $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p>&nbsp;</p>

                        <div class="row">

                            <div class="col-12 col-md-4 offset-md-4 d-flex justify-content-center">

                                <button id="generateInstallments" type="button" class="btn btn-template">Escolher Parcelas</button>

                            </div>

                        </div>

                    </form>

                    <p>&nbsp;</p>

                    <div id="installments" class="row d-none">

                        <div class="col-12 col-md-4 offset-md-4">

                            <p>&nbsp;</p>

                            <div class="form-group form-float">

                                <div class="form-line">

                                    <label class="form-label" style="font-size: 0.9rem;">Parcelas</label>
                                    <select id="installmentsOptions" name="installments" class="form-control" style="font-size: 0.9rem; padding-top: 7px; padding-bottom: 7px;">
                                    </select>

                                </div>

                            </div>

                        </div>

                        <p>&nbsp;</p>

                        <div class="col-12 col-md-8 d-flex justify-content-center">

                            <p>&nbsp;</p>

                            <a href="{{ route('payment.order.creditcard.details')}}" class="btn btn-template col-12 col-md-6 offset-md-6" style="width: 100%">Prosseguir</a>

                        </div>

                    </div>

                    <div class="col-12">

                        <p>&nbsp;</p>

                        <div class="card">

                            <div class="card-header text-center">

                                Cartões disponíveis para pagamento

                            </div>

                            <div class="card-body">

                                <div id="imagesCard" class="col-12 col-md-8 offset-md-2 text-center"></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
            <div class="tab-pane container fade" id="ticket">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <br>
                        <div class="text-justify" style="padding: 0 15px">
                            <h5>IMPORTANTE</h5>
                            <p>&nbsp;</p>
                            <p>O Boleto Bancário será exibido após a confirmação da sua compra e poderá ser impresso para pagamento em qualquer agência bancária ou casas lotéricas.</p>
                            <p> Você terá 2 dias úteis para efetuar o pagamento do boleto.</p>
                            <p>Em caso de não pagamento do boleto, seu pedido será cancelado. O boleto será válido somente para este pedido.</p>
                            <p>Caso você queira repetir a compra, não pague o boleto novamente, realize um novo pedido.</p>
                            <p style="color: #d59431"><b>*Tarifa de boleto: R$ 1,00.</b></p>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <a href="{{ route('payment.order.ticket.details')}}" class="btn btn-template" style="width: 30%">Prosseguir</a>
                    </div>
                </div>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>
    
    <script src="{{asset('js/app/waves.js')}}"></script>
    <script src="{{asset('js/app/input.js')}}"></script>
    <script src="{{asset('js/admin/sweetalert.min.js')}}"></script>
    
    <script>

        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        let binCard = '';
        let cardToken = '';
    
        $(function () {
            //==============================================================================================================
            //INICIA A SESSÃO DO PAGSEGURO
            $.ajax({
                url: '{{ route('payment.checkout.session.id') }}',
                type: 'POST',
                data: {_token: CSRF_TOKEN},
                success: function (d) {
                    console.log(d);
                    PagSeguroDirectPayment.setSessionId(d.idSessao[0]);

                    $('#creditCards').empty();

                    PagSeguroDirectPayment.getPaymentMethods({
                        success: function(response) {   
                            $('#creditCards').append('<option value=""></option>');

                            $.each(response.paymentMethods.CREDIT_CARD.options, function (i, v) {

                                if (v.status == 'AVAILABLE') {
                                    $('#imagesCard').append('<img src="https://stc.pagseguro.uol.com.br' + v.images.MEDIUM.path + '" class="img-fluid img-thumbnail" style="margin-bottom: 8px;">&nbsp;&nbsp;&nbsp;&nbsp;');
                                }
                                
                            })

                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });

                }
            });

        });

        //==============================================================================================================
        //AO CLICAR NO BOTÃO DE ESCOLHER PARCELAS, VAI SER GERADO AS PARCELAS, E CRIA O TOKEN DO CARTÃO DE CRÉDITO
        $('#generateInstallments').click(function () {
            console.log('oi');
            $('#installments').removeClass('d-none');

            PagSeguroDirectPayment.getBrand({
            cardBin: $('#cardNumber').val().substr(0, 6),
                success: function (d) {
                    console.log('sucesso ao gerar as parcelas.');
                    console.log(d);

                    let brandName = d.brand.name;

                    PagSeguroDirectPayment.getInstallments({
                        amount: parseFloat($('#orderValue').val()),
                        maxInstallmentNoInterest: 3,
                        brand: brandName,
                        success: function (v) {
                            console.log(v);
                            $('#installmentsOptions').empty();

                            $.each(v.installments, function (i, values) {
                                $.each(values, function (id, val) {                                                                 
                                    
                                    if (val.quantity > 3) {
                                        $('#installmentsOptions').append('<option value="' + val.installmentAmount + '_' + val.totalAmount + '">' + val.quantity + 'x de R$ ' + (val.installmentAmount).toFixed(2).replace('.', ',') + ' com juros (R$ '+ (val.totalAmount).toFixed(2).replace('.', ',') +')</option>');
                                    } else {
                                        $('#installmentsOptions').append('<option value="' + val.installmentAmount + '_' + val.totalAmount + '">' + val.quantity + 'x de R$ ' + (val.installmentAmount).toFixed(2).replace('.', ',') + ' sem juros (R$ '+ (val.totalAmount).toFixed(2).replace('.', ',') +')</option>');
                                    }

                                })
                                
                            })

                        }
                    });

                },
                error: function (response) {
                    /*console.log('erro ao pegar as parcelas.');
                    console.log(response);*/

                    swal('Ops', 'Cartão não acessível.\nEscolha outro cartão para pagamento.', 'warning');
                    $('#installments').addClass('d-none');

                    binCard = ''
                }
            });

            let cardData = {
                cardNumber: $('#cardNumber').val(),
                cvv: $('#cvv').val(),
                expirationMonth: $('#months option:selected').text(),
                expirationYear: $('#years option:selected').text(),
                success: function (response) {
                    cardToken = response.card.token;
                    $('#cardToken').val(cardToken);

                    $.ajax({
                        url: '{{ route('payment.creditcard.info') }}',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN,
                            cardToken: cardToken,
                            cardNumber: $('#cardNumber').val(),
                            cvv: $('#cvv').val(),
                            expirationMonth: $('#months option:selected').text(),
                            expirationYear: $('#years option:selected').text(),
                            quantity: 1,
                            installmentAmount: $('#orderValue').val(),
                            totalAmount: $('#orderValue').val(),
                            newToken: true
                        },
                        success: function () {
                        }
                    })


                }
            };

            PagSeguroDirectPayment.createCardToken(cardData)

        });

        //==============================================================================================================
        //AO CLICAR NO SELECT DAS PARCELAS, ALGO ACONTECE
        $('#installmentsOptions').on('change', function () {

            let installmentValues = ($('#installmentsOptions option:selected').val()).split('_');

            let installmentAmount = installmentValues[0];
            let totalAmount = installmentValues[1];

            $.ajax({
                url: '{{ route('payment.creditcard.info') }}',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    cardToken: cardToken,
                    cardNumber: $('#cardNumber').val(),
                    cvv: $('#cvv').val(),
                    expirationMonth: $('#months option:selected').text(),
                    expirationYear: $('#years option:selected').text(),
                    quantity: ($('#installmentsOptions option:selected').index() + 1),
                    installmentAmount: installmentAmount,
                    totalAmount: totalAmount,
                },
                success: function () {
                }
            });
            
        });

    </script>

@stop