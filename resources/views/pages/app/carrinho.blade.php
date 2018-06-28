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
                        <form>
                            <input id="campoCep" type="text" name="cep_cliente" maxlength="8">
                            <button id="btnCalcFrete" type="button" disabled>Calcular</button>
                        </form>
                    </div>
                </div>
                {{--<div class="col-12 col-md-6 col-lg-6">
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
                </div>--}}
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="cart-total-area mt-70">
                        <div class="cart-page-heading">
                            <h5>Total</h5>
                            <p>Informações da compra</p>
                        </div>
                        <ul class="cart-total-chart">
                            <li><span>Subtotal</span> <span>R$ 29,99</span></li>
                            <li><span>Envio</span> <span>-</span></li>
                            <li><span><strong>Total</strong></span> <span><strong>-</strong></span></li>
                        </ul>

                        <form id="formComprar">
                            {{ csrf_field() }}

                            <!-- array dos produtos -->
                            <input type="hidden" name="id" value="1">
                            <input type="hidden" name="code" id="code" value="" />
                            <input type="hidden" name="descricao" value="{{ $produto[0]->nm_produto }}">
                            <input type="hidden" name="quantidade" value="2">
                            <input type="hidden" name="valor" value="{{ $produto[0]->vl_produto }}">
                            <input type="hidden" name="peso" value="{{ $produto[0]->ds_peso }}">
                            <input type="hidden" name="fretecal" value="">
                            <input type="hidden" name="largura" value="{{ $produto[0]->ds_largura }}">
                            <input type="hidden" name="altura" value="{{ $produto[0]->ds_altura }}">
                            <input type="hidden" name="comprimento" value="{{ $produto[0]->ds_comprimento }}">

                            <!-- array do cliente -->
                          {{--  <input type="hidden" name="cep" value="{{ $cliente[0]->cd_cep }}">
                            <input type="hidden" name="endereco" value="{{ $cliente[0]->ds_endereco }}">
                            <input type="hidden" name="numero" value="{{ $cliente[0]->cd_numero_endereco }}">
                            <input type="hidden" name="bairro" value="{{ $cliente[0]->nm_bairro }}">
                            <input type="hidden" name="cidade" value="{{ $cliente[0]->nm_cidade }}">
                            <input type="hidden" name="estado" value="{{ $cliente[0]->nm_uf }}">
                            <input type="hidden" name="pais" value="{{ $cliente[0]->nm_pais }}">--}}

                            <input type="hidden" name="email_cliente" value="{{ $cliente[0]->email }}">
                            <input type="hidden" name="nome" value="{{ $cliente[0]->nm_cliente }}">
                            <input type="hidden" name="numero_cpf" value="{{ $cliente[0]->cd_cpf_cnpj }}">
                            {{--<input type="hidden" name="telefone" value="{{ $cliente[0]->fk_cd_telefone }}">
                            <input type="hidden" name="data_nascimento" value="{{ $cliente[0]->dt_nascimento }}">--}}

                                <button type="button" id="finalizar" class="btn btn-danger">Finalizar Compra</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ****** Area final do carrinho ****** -->

    <script src="{{ asset('js/app/pagseguro.lightbox.js') }}"></script>

    <script>

        {{--  function enviaPagseguro(){
            $.post('{{url( '/pages/pagseguro/redirect')}}','',function(data){
                $('#code').val(data);
                $('#comprar').submit();
            })
        }--}}

    </script>


    <script>

        $('#btnCalcFrete').click(function(e){
            e.preventDefault();
            {{--var cepCliente = $('#campoCep').val();
            var altura = '{{$produto[0]->ds_altura}}';
            var largura = '{{$produto[0]->ds_largura}}';
            var peso = '{{$produto[0]->ds_peso}}';
            var comprimento = '{{$produto[0]->ds_comprimento}}';--}}

            $objF = {
                    cep: $('#campoCep').val(),
                    altura: '{{$produto[0]->ds_altura}}',
                    largura: '{{$produto[0]->ds_largura}}',
                    peso: '{{$produto[0]->ds_peso}}',
                    comprimento: '{{$produto[0]->ds_comprimento}}'
                };

            $.ajax({
                //url: '/pages/calculaFrete/' + objF,
                url: '{{ url('/pages/calculaFrete') }}/' + $objF.cep + ',' + $objF.altura + ',' + $objF.largura + ',' + $objF.peso  + ',' + $objF.comprimento,
                type: 'GET',
                success: function(data){
                    console.log(data);
                }
            });

            /*console.log("CEP Cliente: " + cepCliente);
            console.log("Altura: " + altura);
            console.log("Largura: " + largura);
            console.log("Peso: " + peso);
            console.log("Comprimento: " + comprimento);*/

        });

        $('#finalizar').click(function (e) {
            //e.preventDefault();

            var cdCompra = null;

            $.ajax({
                //url: '/pages/calculaFrete/' + objF,
                url: '{{ url('pages/pagseguro/redirect') }}',
                type: 'POST',
                data: $("#formComprar").serialize(),
                success: function(codigoCompra){

                    $.each(codigoCompra, function () {
                        var key = Object.keys(this)[0];
                        cdCompra = this[key];
                    })

                    //console.log(cdCompra);

                    PagSeguroLightbox(cdCompra);
                },
                error: function () {
                    console.log('erro');
                }
            });

            {{--$.ajax({--}}
            {{--//url: '/pages/calculaFrete/' + objF,--}}
            {{--url: '{{ url('/pagseguro/redirect') }}',--}}
            {{--type: 'POST',--}}
            {{--success: function(data){--}}
            {{--console.log(data.codigo_compra);--}}
            {{--},--}}
            {{--error: function () {--}}
            {{--console.log('erro');--}}
            {{--}--}}
            {{--});--}}

        });

        $('#campoCep').on("input", function(){
            if($(this).val().length == 8){
                $('#btnCalcFrete').removeAttr("disabled");
            }else {
                $('#btnCalcFrete').attr("disabled", "disabled");
            }
        });

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
