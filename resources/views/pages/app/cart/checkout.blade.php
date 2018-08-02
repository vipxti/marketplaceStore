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
                                    <input type="text" class="form-control" name="client_name" required maxlength="50">
                                    <label class="form-label">Nome do titular</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 col-sm-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="card_number" required maxlength="16">
                                    <label class="form-label">Número do cartão</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-3 col-sm-4 offset-md-2">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="cvv" required maxlength="3" style="font-size: 0.7rem;">
                                    <label class="form-label" style="font-size: 0.7rem;">CVV</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-2 col-sm-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label" style="font-size: 0.7rem;">Mês vencimento</label>
                                    <select id="months" name="months" class="form-control" style="font-size: 0.7rem;">
                                    </select>                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 col-sm-4">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label" style="font-size: 0.7rem;">Ano vencimento</label>
                                    <select id="years" name="years" class="form-control" style="font-size: 0.7rem;">
                                    </select> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <p>&nbsp;</p>

                    <div class="col-12 col-md-4 offset-md-4 d-flex justify-content-center">

                        <button type="button" id="creditCardPayment" class="btn btn-template w-100">Finalizar compra</button>

                    </div>

                </form>

                <p>&nbsp;</p>

                <div class="card">

                    <div class="card-header text-center">

                        Cartões Disponíveis
                    
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
                url: '{{ route('cart.checkout.submit') }}',
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

        $('input[name="card_number"]').blur(function () {

            PagSeguroDirectPayment.getBrand({
            cardBin: $(this).val().substr(0, 6),
                success: function (d) {
                    binCard = d.brand.name
                },
                error: function (response) {
                    binCard = ''
                    $('input[name="card_number"]').val('Cartão inválido').addClass('text-danger')
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

                let cardData = {
                    cardNumber: $('input[name="card_number"]').val(),
                    cvv: $('input[name="cvv"]').val(),
                    expirationMonth: $('#months').val(),
                    expirationYear: $('#years').val(),
                    success: function (response) {
                        console.log(response.card.token);
                    }
                }

                PagSeguroDirectPayment.createCardToken(cardData)

            });

            

            $.ajax({

                url: '{{ route('cart.checkout.creditcard') }}',
                type: 'POST',
                data: $('#formCreditCard').serialize(),
                success: function (d) {
                    PagSeguroDirectPayment.createCardToken(d)
                },
                error: function (response) {
                    console.log(response.message)
                }

            });

        });

    </script>

@stop