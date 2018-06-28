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
                                <td class="total_price"><span id="valorTotal"></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="cart-footer d-flex mt-30">

                        <div class="back-to-shop">
                            <button type="button" class="btn btn-danger" style="border-radius: 0px; font-size: 14px">Continuar Comprando</button>
                        </div>
                        <div class="update-checkout w-50" style="padding: 0 4px">
                            <button type="button" class="btn btn-danger" style="border-radius: 0px; font-size: 14px; background-color: #3a3a3a">Limpar Carrinho</button>
                            <button type="button" class="btn btn-danger" style="border-radius: 0px; font-size: 14px; background-color: #3a3a3a">Atualizar Carrinho</button>
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
                            <button class="btn btn-danger" id="btnCalcFrete" type="button" style="border-radius: 0px">Calcular</button><br>
                            <p style="font-size: 0.90em" id="msgErroCep"></p>
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
                                <input type="radio" id="customRadio1" name="customRadio" value="2" class="custom-control-input" checked>
                                <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio1">
                                    <span id="sedex">Expresso </span><span id="precoSedex"></span><span id="diasSedex"></span>
                                </label>
                            </div>
                            <div class="custom-control custom-radio mb-14">
                                <input type="radio" id="customRadio2" name="customRadio" value="1" class="custom-control-input">
                                <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio2">
                                    <span id="pac">Normal </span><span id="precoPac"></span><span id="diasPac"></span>
                                </label>
                            </div>{{--
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input" checked>
                                <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio3">
                                    <span>Retirar no Local</span>
                                    <span>Grátis</span>
                                </label>
                            </div>--}}
                        </div>
                    </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="cart-total-area mt-70">
                        <div class="cart-page-heading">
                            <h5>Total</h5>
                            <p>Informações da compra</p>
                        </div>
                        <ul class="cart-total-chart">
                            <li><span>Subtotal</span> <span id="precoSubTotal">-</span></li>
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

                                <button type="button" id="finalizar" class="btn btn-danger" style="width: 100%; border-radius: 0px; font-weight: 700; font-size: 14px">Finalizar Compra</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ****** Area final do carrinho ****** -->

    <script src="{{ asset('js/app/pagseguro.lightbox.js') }}"></script>

    <script>

        $(document).ready(function(){
            $('#precoSubTotal').html($('#precoProd').html());
            $('#valorTotal').html($('#precoProd').html());
        });

        $('#btnCalcFrete').click(function(){

            $("#msgErroCep").html("");
            //Nova variável "cep" somente com dígitos.
            var cep = $('#campoCep').val().replace(/\D/g, '');
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;
            //Valida o formato do CEP.
            if(validacep.test(cep)) {
                //Consulta o webservice viacep.com.br/
                $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        console.log("oi");
                        $objF = {
                            cep: $('#campoCep').val(),
                            altura: '{{$produto[0]->ds_altura}}',
                            largura: '{{$produto[0]->ds_largura}}',
                            peso: '{{$produto[0]->ds_peso}}',
                            comprimento: '{{$produto[0]->ds_comprimento}}'
                        };

                        $.ajax({
                            url: '{{ url('/pages/calculaFrete') }}/' + $objF.cep + ',' + $objF.altura + ',' + $objF.largura + ',' + $objF.peso  + ',' + $objF.comprimento,
                            type: 'GET',
                            async: false,
                            success: function(data){
                                console.log(data);
                            },
                            error: function(){
                                console.log("Erro");


                            }
                        });
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        $("#msgErroCep").html("CEP não encontrado.").css("color", "red");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                $("#msgErroCep").html("Formato de CEP inválido.").css("color", "red");
            } //end if.

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

        var preco = null;
        var qtd=0;
        var total=0;
        $('.qty-minus').click(function(){
            if(preco==null){
                preco = $('#precoProd').html().replace('R$', '').replace(',', '.');
                qtd = $('#qty').val();
                total = preco;
            }

            if(qtd > 1) {
                total = preco * (qtd - 1);
                qtd--;
            }

            $('#qty').val(qtd);
            $('#valorTotal').html('R$ ' + total.toFixed(2).toString().replace('.', ','));
            $('#precoSubTotal').html('R$ ' + total.toFixed(2).toString().replace('.', ','));
        });

        $('.qty-plus').click(function(){
            if(preco==null){
                preco = $('#precoProd').html().replace('R$', '').replace(',', '.');
                qtd = $('#qty').val();
                total = preco;
            }

            if(qtd < {{$produto[0]->qt_produto}} - 1) {
                qtd++;
                total = preco * qtd;
            }

            $('#qty').val(qtd);
            $('#valorTotal').html('R$ ' + total.toFixed(2).toString().replace('.', ','));
            $('#precoSubTotal').html('R$ ' + total.toFixed(2).toString().replace('.', ','));
        });


    </script>

@stop
