@extends('layouts.app.app')

@section('content')

    <link rel="stylesheet" href="{{asset('css/app/input.css')}}">

    <div class="container">

        <p>&nbsp;</p>

        <p class="h3 text-center">Formas de pagamento</p>

        <p>&nbsp;</p>

        <div class="row text-center">
            <div class="col-12 col-md-6">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="ticketPayment" name="customRadio" class="custom-control-input" checked>
                    <label class="custom-control-label" for="ticketPayment">Boleto</label>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="creditCardPayment" name="customRadio" class="custom-control-input">
                    <label class="custom-control-label" for="creditCardPayment">Cartão de crédito</label>
                </div>
            </div>
        </div>

        <div id="ticket" class="row">          

            <div class="col-12 col-md-6 col-sm-8 offset-md-3">

                <p>&nbsp;</p>

                <p class="h5 text-justify">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod odio perferendis inventore, aut qui fuga labore voluptates, sed repellat vel itaque excepturi quam quos velit quas dolorem. Et, ipsa dignissimos. Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus voluptas cumque sit, voluptatibus voluptatum quia officiis facere omnis assumenda nam optio, odit aperiam vero libero. Quia dolore quisquam quo inventore.
                </p>

            </div>

        </div>

        <div id="creditCard" class="row d-none">

            <p>&nbsp;</p>

            <div class="col-12">

                <form id="formCreditCard">
                    {{ csrf_field() }}

                    <input id="senderHash" type="hidden" name="senderHash" value="">
                    <input id="cardToken" type="hidden" name="cardToken" value="">

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
                                    <input id="cvv" type="text" class="form-control" name="cvv" required maxlength="3" style="font-size: 0.7rem;">
                                    <label class="form-label" style="font-size: 0.7rem;">CVV</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-2 col-sm-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label" style="font-size: 0.7rem;">Mês vencimento</label>
                                    <select id="months" name="months" class="form-control" style="font-size: 0.9rem; padding-top: 7px; padding-bottom: 7px;">
                                    </select>                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 col-sm-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label" style="font-size: 0.7rem;">Ano vencimento</label>
                                    <select id="years" name="years" class="form-control" style="font-size: 0.9rem; padding-top: 7px; padding-bottom: 7px;">
                                    </select> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <p>&nbsp;</p>

                    <div class="row">

                        <div class="col-12 col-md-4 offset-md-4 d-flex justify-content-center">

                            <button id="generateInstallments" type="button" class="btn btn-template">

                                Gerar parcelamento

                            </button>

                        </div>

                    </div>

                    <p>&nbsp;</p>

                    <div id="installments" class="row d-none">

                        <div class="col-12 col-md-8 col-sm-6 offset-md-2">

                            <div class="form-group form-float">

                                <div class="form-line">

                                    <label class="form-label" style="font-size: 0.9rem;">Parcelas</label>
                                    <select id="installmentsOptions" name="installments" class="form-control" style="font-size: 0.9rem; padding-top: 7px; padding-bottom: 7px;"></select>

                                </div>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        <div class="row">

            <p>&nbsp;</p>

            <div class="col-12">

                <div id="finalizar" class="col-12 col-md-3 offset-md-7 justify-content-right">

                    <button type="button" id="btnProssegir" class="btn btn-template w-100">Prossegir</button>

                </div>

            </div>

        </div>

        <div id="cardBrands" class="row d-none">

            <div class="col-12">

                <p>&nbsp;</p>

                <div class="card">

                    <div class="card-header text-center">

                        Cartões Disponíveis para pagamento
                    
                    </div>

                    <div class="card-body">
                        
                        <div id="imagesCard" class="col-12 col-md-8 offset-md-2 text-center">
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <p>&nbsp;</p>

    </div>
    
    <script src="{{asset('js/app/waves.js')}}"></script>
    <script src="{{asset('js/app/input.js')}}"></script>
    
    <script>

        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        let binCard = '';
    
        $(function () {

            let years = [];
            let months = [];
            let iniitalYear = (new Date).getFullYear()

            if ($('#ownerName').val() == '' || $('#cardNumber').val() == '' || $('#cvv').val() == '' || $('#months').val() == '' || $('#years').val() == '') {
                $('#generateInstallments').attr('disabled')
            }
            else {
                $('#generateInstallments').removeAttr('disabled')
            }

            for (let j = 0; j < 12; j++) {
               months[j] = (j + 1);
            }

            $.each(months, function (i, v) {

                if (v < 10) {
                    $('#months').append('<option value="' + v + '">0' + v + '</option>');
                }
                else {
                    $('#months').append('<option value="' + v + '">' + v + '</option>');
                }
 
            })

            for (let i = 0; i < 10; i++) {
                years[i] = iniitalYear++;
            }

            $.each(years,function (i, v) {
                $('#years').append('<option value="' + v + '">' + v + '</option>');
            })
            
            $.ajax({
                url: '{{ route('cart.checkout.session.id') }}',
                type: 'POST',
                data: {_token: CSRF_TOKEN},
                success: function (d) {
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

        $('#ticketPayment').click(function () {
            $('#creditCard').addClass('d-none')
            $('#ticket').removeClass('d-none')
            $('#cardBrands').addClass('d-none')
        })

        $('#creditCardPayment').click(function () {
            $('#ticket').addClass('d-none')
            $('#creditCard').removeClass('d-none')
            $('#cardBrands').removeClass('d-none')
        })

        $('#generateInstallments').click(function () {

            $('#installments').removeClass('d-none')
            $('#creditCardPayment').removeClass('d-none')

            PagSeguroDirectPayment.getBrand({
            cardBin: $('#cardNumber').val().substr(0, 6),
                success: function (d) {

                    let brandName = d.brand.name

                    PagSeguroDirectPayment.getInstallments({
                        amount: 500,
                        maxInstallmentNoInterest: 3,
                        brand: brandName,
                        success: function (v) {

                            let total = 0

                            $.each(v.installments, function (i, values) {
                                $.each(values, function (id, val) {

                                    total = parseFloat(val.installmentAmount).toFixed(10) * val.quantity
                                    
                                    if (val.quantity > 3) {
                                        $('#installmentsOptions').append('<option value="' + val.quantity + '">' + val.quantity + 'x de R$ ' + (val.installmentAmount).toFixed(2).replace('.', ',') + ' com juros (R$ '+ (total).toFixed(2).replace('.', ',') +')</option>');
                                    } else {
                                        $('#installmentsOptions').append('<option value="' + val.quantity + '">' + val.quantity + 'x de R$ ' + (val.installmentAmount).toFixed(2).replace('.', ',') + ' sem juros (R$ '+ Math.round((total)).toFixed(2).replace('.', ',') +')</option>');
                                    }

                                    
                                })
                                
                            })

                        }
                    });

                },
                error: function (response) {
                    binCard = ''
                }
            });

        });

        $('#btnProssegir').click(function (e) {
            e.preventDefault();

            if ($('#creditCardPayment').is(':checked')) {

                PagSeguroDirectPayment.onSenderHashReady(function(response){
                    if(response.status == 'error') {
                        return false;
                    }

                    $('#senderHash').val(response.senderHash);

                });

                $.ajax({

                    url: '{{ route('cart.checkout.creditcard.token') }}',
                    type: 'POST',
                    data: $('#formCreditCard').serialize(),
                    success: function (d) {

                        console.log(d);
                        

                        let cardData = {
                            cardNumber: d.data.cardNumber,
                            cvv: d.data.cvv,
                            expirationMonth: d.data.expirationMonth,
                            expirationYear: d.data.expirationYear,
                            success: function (response) {
                                $('#cardToken').val(response.card.token);
                            }
                        }

                        PagSeguroDirectPayment.createCardToken(cardData)
                    },
                    error: function (response) {
                        console.log(response.message)
                    },
                    complete: function () {

                        $.get('{{ route('cart.order.details') }}', function (data) {
                            window.location(data)
                        })
                    
                    }

                });
                
            }

        });

    </script>

@stop