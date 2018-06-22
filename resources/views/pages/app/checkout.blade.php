@extends('layouts.app.app')

@section('content')
    <link rel="stylesheet" href="{{asset('css/app/estiloWizard.css')}}">
    <link rel="stylesheet" href="{{asset('css/app/input.css')}}">
    <!-- ****** Checkout Area Start ****** -->
    <div class="checkout_area section_padding_100">
        <div class="container">
            <div class="row">
                <form id="form_validation" class="signup" action="" method="">
                    <ul id="section-tabs">
                        <li class="current active"><span></span> Passo 1</li>
                        <li><span></span> Passo 2</li>
                        <li><span></span> Passo 3</li>
                        <li><span></span> Passo 4</li>
                        <li><span></span> Passo 5</li>
                    </ul>
                    <div id="fieldsets">
                        <fieldset class="current col-md-12">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="order-details-confirmation">

                                        <!-- Imagem do Produto -->
                                        <span>
                                            <img class="badge__product-icon picture-image" src="https://http2.mlstatic.com/D_NQ_NP_632155-MLB27524314306_062018-Z.jpg" srcset="https://http2.mlstatic.com/D_NQ_NP_632155-MLB27524314306_062018-Z.jpg" style="height: 70px" data-object-fit="cover">
                                        </span>

                                        <!-- Nome do produto -->
                                        <div class="cart-page-heading">
                                            <h5>Geforce Zotac Gtx Performance Nvidia Gtx 660 2gb Ddr5 192bit</h5>
                                            <p>Quantidade: 1</p>
                                        </div>

                                        <!-- Preços do produto -->
                                        <ul class="order-details-form">

                                            <li><span>Produto</span><span>R$&nbsp;95,99</span></li>
                                            <li><span>Envio</span><span>R$&nbsp;11,90</span></li>
                                            <li><span>Total</span><span>R$&nbsp;107.89</span></li>
                                        </ul>

                                        <div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nome" required>
                                                    <label class="form-label">Nome</label>
                                                </div>
                                            </div>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="email" class="form-control" name="email" required>
                                                    <label class="form-label">Email</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <!-- Detalhes do produto -->
                                <div class="col-md-5 text-center">
                                    <div class="order-details-confirmation">

                                        <!-- Imagem do Produto -->
                                        <span>
                                            <img class="badge__product-icon picture-image" src="https://http2.mlstatic.com/D_NQ_NP_632155-MLB27524314306_062018-Z.jpg" srcset="https://http2.mlstatic.com/D_NQ_NP_632155-MLB27524314306_062018-Z.jpg" style="height: 70px" data-object-fit="cover">
                                        </span>

                                        <!-- Nome do produto -->
                                        <div class="cart-page-heading">
                                            <h5>Geforce Zotac Gtx Performance Nvidia Gtx 660 2gb Ddr5 192bit</h5>
                                            <p>Quantidade: 1</p>
                                        </div>

                                        <!-- Preços do produto -->
                                        <ul class="order-details-form">

                                            <li><span>Produto</span><span>R$&nbsp;95,99</span></li>
                                            <li><span>Envio</span><span>R$&nbsp;11,90</span></li>
                                            <li><span>Total</span><span>R$&nbsp;107.89</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="next">

                        </fieldset>
                        <fieldset class="next">

                        </fieldset>
                        <fieldset class="next">

                        </fieldset>
                        <fieldset class="next">

                        </fieldset>
                    </div>
                </form>


              {{--<div class="col-12 col-md-6">
                    <div class="checkout_details_area mt-50 clearfix">

                        <div class="cart-page-heading">
                            <h5>Endereço de entrega</h5>
                        </div>

                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="first_name">Nome <span>*</span></label>
                                    <input type="text" class="form-control" id="first_name" value="" required>
                                </div>
                                <div class="col-8 mb-3">
                                    <label for="street_address">Endereço <span>*</span></label>
                                    <input type="text" class="form-control mb-3" id="street_address" value="">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="street_address">Nº <span>*</span></label>
                                    <input type="text" class="form-control mb-3" id="street_address" value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="postcode">Cep <span>*</span></label>
                                    <input type="text" class="form-control" id="postcode" value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="city">Bairro <span>*</span></label>
                                    <input type="text" class="form-control" id="city" value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="state">Cidade <span>*</span></label>
                                    <input type="text" class="form-control" id="state" value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="state">Estado <span>*</span></label>
                                    <input type="text" class="form-control" id="city" value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="country">Pais <span>*</span></label>
                                    <select class="custom-select d-block w-100" id="country">
                                        <option selected value="Brasil">Brasil</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="phone_number">Celular <span>*</span></label>
                                    <input type="number" class="form-control" id="phone_number" min="0" value="">
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="email_address">E-mail <span>*</span></label>
                                    <input type="email" class="form-control" id="email_address" value="">
                                </div>

                                <div class="col-12">
                                    <div class="custom-control custom-checkbox d-block mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Termos e Condições</label>
                                    </div>
                                    <div class="custom-control custom-checkbox d-block mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                                        <label class="custom-control-label" for="customCheck2">Criar Conta</label>
                                    </div>
                                    <div class="custom-control custom-checkbox d-block">
                                        <input type="checkbox" class="custom-control-input" id="customCheck3">
                                        <label class="custom-control-label" for="customCheck3">Assinar Newsletter</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>--}}

              {{--  <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                    <div class="order-details-confirmation">

                        <div class="cart-page-heading">
                            <h5>Seu Carrinho</h5>
                        </div>

                        <ul class="order-details-form mb-4">
                            <li><span>Produto</span> <span>Total</span></li>
                            <li><span>Blusa Amarela</span> <span>$59.90</span></li>
                            <li><span>Subtotal</span> <span>R$ 29,99</span></li>
                            <li><span>Envio</span> <span>Grátis</span></li>
                            <li><span>Total</span> <span>R$ 29,99</span></li>
                        </ul>


                        <div id="accordion" role="tablist" class="mb-4">
                            <div class="card">
                                <div class="card-header" role="tab" id="headingOne">
                                    <h6 class="mb-0">
                                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne"><i class="fa fa-circle-o mr-3"></i>Pag Seguro</a>
                                    </h6>
                                </div>

                                <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" role="tab" id="headingTwo">
                                    <h6 class="mb-0">
                                        <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-circle-o mr-3"></i>Pagar na Retirada</a>
                                    </h6>
                                </div>
                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" role="tab" id="headingThree">
                                    <h6 class="mb-0">
                                        <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="fa fa-circle-o mr-3"></i>Cartão de Crédito</a>
                                    </h6>
                                </div>
                                <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" role="tab" id="headingFour">
                                    <h6 class="mb-0">
                                        <a class="collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour"><i class="fa fa-circle-o mr-3"></i>Transferencia bancaria </a>
                                    </h6>
                                </div>
                                <div id="collapseFour" class="collapse show" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn karl-checkout-btn">Finalizar</a>
                    </div>
                </div>--}}

            </div>
        </div>
    </div>
    <script src="{{asset('js/app/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/app/waves.js')}}"></script>
    <script src="{{asset('js/app/input.js')}}"></script>
    <script src="{{asset('js/app/form-validation.js')}}"></script>
    <script>
        $("#next").on("click", function(e){
            console.log(e.target);
            nextSection();
        });

        $("form").on("submit", function(e){
            if ($("#next").is(":visible") || $("fieldset.current").index() < 3){
                e.preventDefault();
            }
        });

        function goToSection(i){
            console.log(i);
            $("fieldset:gt("+i+")").removeClass("current").addClass("next");
            $("fieldset:lt("+i+")").removeClass("current");
            $("#section-tabs li").eq(i).addClass("current").siblings().removeClass("current");
            setTimeout(function(){
                $("fieldset").eq(i).removeClass("next").addClass("current active");
                if ($("fieldset.current").index() == 4){
                    $("#next").hide();
                    $("input[type=submit]").show();
                } else {
                    $("#next").show();
                    $("input[type=submit]").hide();
                }
            }, 80);

        }

        function nextSection(){
            var i = $("fieldset.current").index();
            if (i < 4){
                $("#section-tabs li").eq(i+1).addClass("active");
                goToSection(i+1);
            }
        }

        $("#section-tabs li").on("click", function(e){
            var i = $(this).index();
            if ($(this).hasClass("active")){
                goToSection(i);
            } else {
                alert("Por favor preencha as sessões anteriores!");
            }
        });
    </script>
    <!-- ****** Checkout Area End ****** -->
@stop
