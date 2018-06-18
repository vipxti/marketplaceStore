@extends('layouts.app.app')

@section('content')
    <!-- ****** Checkout Area Start ****** -->
    <div class="checkout_area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
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
                </div>

                <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                    <div class="order-details-confirmation">

                        <div class="cart-page-heading">
                            <h5>Seu Pedido</h5>
                            <p>Detalhes</p>
                        </div>

                        <ul class="order-details-form mb-4">
                            <li><span>Produto</span> <span>Total</span></li>
                            <li><span>Cocktail Yellow dress</span> <span>$59.90</span></li>
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
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integ er bibendum sodales arcu id te mpus. Ut consectetur lacus.</p>
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
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo quis in veritatis officia inventore, tempore provident dignissimos.</p>
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
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse quo sint repudiandae suscipit ab soluta delectus voluptate, vero vitae</p>
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
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est cum autem eveniet saepe fugit, impedit magni.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="#" class="btn karl-checkout-btn">Place Order</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- ****** Checkout Area End ****** -->
@stop
