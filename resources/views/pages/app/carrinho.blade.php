@extends('layouts.app.app')

@section('content')

    <!-- ****** Cart Area Start ****** -->
    <div class="cart_area section_padding_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cart-table clearfix">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Valor</th>
                                <th>Quantidade</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="cart_product_img d-flex align-items-center">
                                    <a href="#"><img src="{{asset('img/app/product-img/product-3.jpg')}}" alt="Product"></a>
                                    <h6>Brinco Coração</h6>
                                </td>
                                <td class="price"><span>R$ 29,99</span></td>
                                <td class="qty">
                                    <div class="quantity">
                                        <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="99" name="quantity" value="1">
                                        <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                    </div>
                                </td>
                                <td class="total_price"><span>R$ 29,99</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="cart-footer d-flex mt-30">
                        <div class="back-to-shop w-50">
                            <a href="{{route('index')}}">Continuar Comprando</a>
                        </div>
                        <div class="update-checkout w-50 text-right">
                            <a href="#">Limpar Carrinho</a>
                            <a href="#">Atualizar Carrinho</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="coupon-code-area mt-70">
                        <div class="cart-page-heading">
                            <h5>Código do Cupom</h5>
                            <p>Entre com Código do Cupom</p>
                        </div>
                        <form action="#">
                            <input type="search" name="search" placeholder="#569ab15">
                            <button type="submit">Salvar</button>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="shipping-method-area mt-70">
                        <div class="cart-page-heading">
                            <h5>Modo de Envio</h5>
                            <p>Escolha uma Opção</p>
                        </div>
                        <div class="custom-control custom-radio mb-30">
                            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                            <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio1"><span>Correios - Pac</span><span>R$ 20,20</span></label>
                        </div>
                        <div class="custom-control custom-radio mb-30">
                            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                            <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio2"><span>Correios - Sedex</span><span>R$ 25,00</span></label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input" checked>
                            <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio3"><span>Retirar no Local</span><span>Grátis</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="cart-total-area mt-70">
                        <div class="cart-page-heading">
                            <h5>Total</h5>
                            <p>informções da compra</p>
                        </div>
                        <ul class="cart-total-chart">
                            <li><span>Subtotal</span> <span>R$ 29,99</span></li>
                            <li><span>Envio</span> <span>Grátis</span></li>
                            <li><span><strong>Total</strong></span> <span><strong>R$ 29,99</strong></span></li>
                        </ul>
                        <a href="{{ route('checkout.page') }}" class="btn karl-checkout-btn">Finalizar Compra</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ****** Cart Area End ****** -->
@stop
