@extends('layouts.app.app')

@section('content')

    <link rel="stylesheet" href="{{asset('css/app/estiloWizard.css')}}">
    <link rel="stylesheet" href="{{asset('css/app/input.css')}}">

    <div class="checkout_area section_padding_100">
        <div class="container">
            <form id="form_validation" class="signup" action="" method="post">
                <ul id="section-tabs">
                    <li class="current active"><span></span>Endereço</li>
                    <li><span></span>Forma de Envio</li>
                    <li><span></span>Forma de Pagamento</li>
                    <li><span></span>Dados de Pagamento</li>
                    <li><span></span>Finalizar Pedido</li>
                </ul>
                <div id="fieldsets">
                    <fieldset class="current col-md-12">
                        <div class="row">

                            <!-- Formulario de endereço -->
                            <div>

                                <!-- cep -->
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="cep" required>
                                            <label class="form-label">Cep</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Estado e Cidade -->
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group form-float col-md-6">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="estado" required>
                                                <label class="form-label">Estado</label>
                                            </div>
                                        </div>

                                        <div class="form-group form-float col-md-6">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="cidade" required>
                                                <label class="form-label">Cidade</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Rua/Avenida -->
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group form-float col-md-6">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="endereco" required>
                                                <label class="form-label">Rua/Avenida</label>
                                            </div>
                                        </div>

                                        <div class="form-group form-float col-md-6">
                                            <div class="form-line">
                                                <input type="numero" class="form-control" name="numero" required>
                                                <label class="form-label">Número</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Complemento -->
                                <div class="col-md-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="complemento" required>
                                            <label class="form-label">Complemento</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bairro -->
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="bairro" required>
                                            <label class="form-label">Bairro</label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Detalhes do produto -->
                            <div class="text-center col-md-5">
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
                    <fieldset class="next col-md-12">
                        <div class="row">


                            <div style="padding: 0 60px">

                                <div class="col-md-12">
                                    <div class="cart-page-heading">
                                        <h5>Qual é seu endereço para envio?</h5>
                                        <p>Confira a baixo o endereço de envio</p>
                                    </div>
                                </div>

                                <!-- Rua/Avenida -->
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group form-float col-md-6">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="endereco" required disabled>
                                                <label class="form-label">Rua/Avenida</label>
                                            </div>
                                        </div>

                                        <div class="form-group form-float col-md-6">
                                            <div class="form-line">
                                                <input type="numero" class="form-control" name="numero" required disabled>
                                                <label class="form-label">Número</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Complemento -->
                                <div class="col-md-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="complemento" required disabled>
                                            <label class="form-label">Complemento</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bairro -->
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="bairro" required disabled>
                                            <label class="form-label">Bairro</label>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <!-- Modificar endereço -->
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <label><a href="">Modificar endereço</a></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Escolher a forma de envio -->
                                <div class="col-md-12">
                                    <div class="shipping-method-area mt-70">
                                        <div class="cart-page-heading">
                                            <h5>Qual envio prefere?</h5>
                                            <p>Escolha uma das  Opções a baixo</p>
                                        </div>
                                        <div class="custom-control custom-radio mb-14">
                                            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio1">
                                                <span>Normal&nbsp;</span>
                                                <span>R$ 20,20</span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-radio mb-14">
                                            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio2">
                                                <span>Expresso&nbsp;</span>
                                                <span>R$ 30,00</span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input" checked>
                                            <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio3">
                                                <span>Retirar no Local&nbsp;</span>
                                                <span>Grátis</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Detalhes do produto -->
                            <div class="text-center col-md-5">
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
                    <fieldset class="next col-md-12">
                        <div class="row">

                            <div style="padding: 0 60px">

                                <!-- Header -->
                                <div class="col-md-12">
                                    <div class="cart-page-heading">
                                        <h5>Como você prefere pagar?</h5>
                                        <p>Escolha uma das opções de pagamento a baixo</p>
                                    </div>
                                </div>

                                <!-- Rua/Avenida -->
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group form-float col-md-6">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="endereco" required disabled>
                                                <label class="form-label">Rua/Avenida</label>
                                            </div>
                                        </div>

                                        <div class="form-group form-float col-md-6">
                                            <div class="form-line">
                                                <input type="numero" class="form-control" name="numero" required disabled>
                                                <label class="form-label">Número</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Complemento -->
                                <div class="col-md-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="complemento" required disabled>
                                            <label class="form-label">Complemento</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bairro -->
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="bairro" required disabled>
                                            <label class="form-label">Bairro</label>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <!-- Modificar endereço -->
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <label><a href="">Modificar endereço</a></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Escolher a forma de envio -->
                                <div class="col-md-12">
                                    <div class="shipping-method-area mt-70">
                                        <div class="cart-page-heading">
                                            <h5>Qual envio prefere?</h5>
                                            <p>Escolha uma das  Opções a baixo</p>
                                        </div>
                                        <div class="custom-control custom-radio mb-14">
                                            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio1">
                                                <span>Normal&nbsp;</span>
                                                <span>R$ 20,20</span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-radio mb-14">
                                            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio2">
                                                <span>Expresso&nbsp;</span>
                                                <span>R$ 30,00</span>
                                            </label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input" checked>
                                            <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio3">
                                                <span>Retirar no Local&nbsp;</span>
                                                <span>Grátis</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Detalhes do produto -->
                            <div class="text-center col-md-5">
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
                    <fieldset class="next col-md-12">
                        <div class="row">

                            <!-- Formulario de endereço -->
                            <div style="padding: 0 60px">

                                <!-- Nome -->
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="cep" required>
                                            <label class="form-label">Cep</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Estado e Cidade -->
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group form-float col-md-6">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="estado" required>
                                                <label class="form-label">Estado</label>
                                            </div>
                                        </div>

                                        <div class="form-group form-float col-md-6">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="cidade" required>
                                                <label class="form-label">Cidade</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Complemnto -->
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group form-float col-md-6">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="endereco" required>
                                                <label class="form-label">Rua/Avenida</label>
                                            </div>
                                        </div>

                                        <div class="form-group form-float col-md-6">
                                            <div class="form-line">
                                                <input type="numero" class="form-control" name="numero" required>
                                                <label class="form-label">Número</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Complemento -->
                                <div class="col-md-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="complemento" required>
                                            <label class="form-label">Complemento</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bairro -->
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="bairro" required>
                                            <label class="form-label">Bairro</label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Detalhes do produto -->
                            <div class="text-center col-md-5">
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
                    <fieldset class="next col-md-12">
                        <div class="row">

                            <!-- Formulario de endereço -->
                            <div style="padding: 0 60px">

                                <!-- Nome -->
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" class="form-control" name="cep" required>
                                            <label class="form-label">Cep</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Estado e Cidade -->
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group form-float col-md-6">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="estado" required>
                                                <label class="form-label">Estado</label>
                                            </div>
                                        </div>

                                        <div class="form-group form-float col-md-6">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="cidade" required>
                                                <label class="form-label">Cidade</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Complemnto -->
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group form-float col-md-6">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="endereco" required>
                                                <label class="form-label">Rua/Avenida</label>
                                            </div>
                                        </div>

                                        <div class="form-group form-float col-md-6">
                                            <div class="form-line">
                                                <input type="numero" class="form-control" name="numero" required>
                                                <label class="form-label">Número</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Complemento -->
                                <div class="col-md-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="complemento" required>
                                            <label class="form-label">Complemento</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bairro -->
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="bairro" required>
                                            <label class="form-label">Bairro</label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Detalhes do produto -->
                            <div class="text-center col-md-5">
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
                    <a class="btn" id="next" style="color: #fff">Próximo</a>
                    <input type="submit" class="btn">
                </div>
            </form>
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
