@extends('layouts.app.app')

@section('content')

    <link rel="stylesheet" href="{{asset('css/app/input.css')}}">

    <div class="container">

        <p>&nbsp;</p>

        <p class="h3 text-center">Formas de pagamento</p>

        <p>&nbsp;</p>

        <nav class="nav-justified">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">
                    Boleto
                </a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Cartão de crédito</a>
            </div>
        </nav>
    
        <div class="tab-content" id="nav-tabContent">

            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                <p>&nbsp;</p>

                <p class="text-justify">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Velit laboriosam, enim id totam incidunt quaerat blanditiis non! Assumenda, asperiores a. Esse blanditiis cum sit molestias sapiente saepe corrupti unde accusamus?Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error fuga neque nam enim provident odit ratione minima quas obcaecati aspernatur quam, quibusdam libero laboriosam aut excepturi reprehenderit consequatur? Accusantium, obcaecati?
                </p>

                <p>&nbsp;</p>

                <div class="col-12 col-md-4 offset-md-4 d-flex justify-content-center">

                    <button id="ticketPayment" class="btn btn-template w-100">Finalizar compra</button>

                </div>

                <p>&nbsp;</p>

            </div>

            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                <p>&nbsp;</p>

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

                    <p>&nbsp;</p>

                    <div id="finalizar" class="col-12 col-md-4 offset-md-4 d-flex justify-content-center">

                        <button type="button" id="creditCardPayment" class="btn btn-template w-100 d-none">Finalizar compra</button>

                    </div>

                </form>

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

                <p>&nbsp;</p>

            </div>

        </div>

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

                            $.each(v.installments, function (i, values) {
                                $.each(values, function (id, val) {
                                    
                                    if (val.quantity > 3) {
                                        $('#installmentsOptions').append('<option value="' + val.quantity + '">' + val.quantity + 'x de R$ ' + (val.installmentAmount).toFixed(2).replace('.', ',') + ' com juros (R$ '+ (val.installmentAmount * val.quantity).toFixed(2).replace('.', ',') +')</option>');
                                    } else {
                                        $('#installmentsOptions').append('<option value="' + val.quantity + '">' + val.quantity + 'x de R$ ' + (val.installmentAmount).toFixed(2).replace('.', ',') + ' sem juros (R$ '+ (val.installmentAmount * val.quantity).toFixed(2).replace('.', ',') +')</option>');
                                    }

                                    
                                })
                                
                            })

                        },
                        error: function (d) {
                            
                        }
                    });

                },
                error: function (response) {
                    binCard = ''
                }
            });

        });

        $('#creditCardPayment').click(function (e) {
            e.preventDefault();

            PagSeguroDirectPayment.onSenderHashReady(function(response){
                if(response.status == 'error') {
                    return false;
                }

                $('#senderHash').val(response.senderHash);

            });

            $.ajax({

                url: '{{ route('cart.checkout.creditcard') }}',
                type: 'POST',
                data: $('#formCreditCard').serialize(),
                success: function (d) {

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
                }

            });

        });

    </script>

@stop