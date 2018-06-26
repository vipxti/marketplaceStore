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

                                {{-- Foreach aqui!!!!! --}}

                                <td class="cart_product_img d-flex align-items-center">
                                    <a href="#"><img src="{{ asset('img/products/' . $imagem[0]->im_produto) }}" alt="Product"></a>
                                    <h6>{{ $imagem[0]->nm_produto }}</h6>
                                </td>

                                <td class="price"><span id="precoProd">R$ {{ str_replace('.', ',', $imagem[0]->vl_produto) }}</span></td>

                                <td class="qty">
                                    <div class="quantity">
                                        <span class="qty-minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="99" name="quantity" value="1">
                                        <span class="qty-plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                    </div>
                                </td>
                                <td class="total_price"><span id="#valorTotal"></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="cart-footer d-flex mt-30">
                        <div class="back-to-shop">
                            <a href="{{ route('index') }}">Continuar Comprando</a>
                        </div>
                        <div class="update-checkout w-50" style="padding: 0 4px">
                            <a href="#">Limpar Carrinho</a>
                            <a href="#">Atualizar Carrinho</a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="coupon-code-area mt-70">
                        <div class="cart-page-heading">
                            <h5>Calcular Frete</h5>
                            <p><b>Insira o CEP do endereço que deseja receber o produto.</b></p>
                            <p>Assim você poderá calcular o frete e conhecer os serviços disponíveis</p>
                        </div>
                        <form action="#">
                            <input type="search" name="search">
                            <button type="submit">Calcular</button>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="shipping-method-area mt-70">
                        <div class="cart-page-heading">
                            <h5>Qual envio prefere?</h5>
                            <p>Escolha uma Opção</p>
                        </div>
                        <div class="custom-control custom-radio mb-14">
                            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                            <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio1">
                                <span>Normal</span>
                                <span>R$ 20,20</span>
                            </label>
                        </div>
                        <div class="custom-control custom-radio mb-14">
                            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                            <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio2">
                                <span>Expresso</span>
                                <span>R$ 30,00</span>
                            </label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input" checked>
                            <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio3">
                                <span>Retirar no Local</span>
                                <span>Grátis</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-12">
                    <div class="cart-total-area mt-70">
                        <div class="cart-page-heading">
                            <h5>Total</h5>
                            <p>informações da compra</p>
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
    <!-- ****** Area final do carrinho ****** -->

    <script>

        $('.qty-minus').on('click', function (e) {

            $preco = $('#precoProd').html().replace('R$ ', '').replace(',', '.');

            $qtd = $('#qty').val();

            if ($qtd == 0) {

                $num = 1;

            }
            else {

                $num = parseInt($qtd) - 1;

            }

            $('#qty').val($num);

            var $total = parseFloat($preco) * $num;

            console.log($total);

            $('#valorTotal').html($total);


        })

        $('.qty-plus').on('click', function (e) {

            $preco = $('#precoProd').html().replace('R$ ', '').replace(',', '.');

            $qtd = $('#qty').val();

            if ($qtd == 0) {

                $num = 1;

            }
            else {

                $num = parseInt($qtd) + 1;

            }

            $('#qty').val($num);

            var $total = parseFloat($preco) * $num;

            console.log($total);

            $('#valorTotal').innerHTML = $total;


        })

    </script>

@stop
