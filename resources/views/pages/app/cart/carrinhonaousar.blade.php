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

                                {{--{{ dd($produtos[0]) }}--}}

                                @foreach($produtos as $key => $produto)

                                    <p>{{ Session::get('qtd' . $produto['skuProduto']) }}</p>

                                    <td class="cart_product_img d-flex align-items-center">
                                        <a href="#"><img src="{{ asset('img/products/' . $imagem[$key]->im_produto) }}" alt="Product"></a>
                                        <h6>{{ $produto['nomeProduto'] }}</h6>
                                    </td>

                                    <td class="price"><span id="precoProd">R$ {{ str_replace('.', ',', $produto['valorProduto']) }}</span></td>

                                    <td class="qty">
                                        <div class="quantity">
                                            <span class="qty-minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                            <input type="number" class="qty-text" id="qty" step="1" min="1" max="5" name="quantity" value="{{ Session::get('qtd' . $produto['skuProduto']) }}">
                                            <span class="qty-plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                            <i id="spinner_qtd" class="fa fa-spinner fa-pulse fa-3x fa-fw" style="font-size: 22px; visibility: hidden"></i>
                                        </div>
                                    </td>
                                    <td class="total_price"><span id="valorTotal"></span></td>

                                @endforeach

                            </tr>
                            </tbody>
                            
                        </table>
                    </div>

                    <div class="cart-footer d-flex mt-30">
                        <div class="back-to-shop">
                            <button type="button" class="btn btn-danger" style="border-radius: 0px; font-size: 14px; background-color: #d33889">Continuar Comprando</button>
                        </div>
                        <div class="update-checkout w-50">
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
                            <p>Insira o CEP do endereço que deseja receber o produto.</p>
                            <p>Assim você poderá calcular o frete e conhecer os serviços disponíveis</p>
                        </div>
                        <form>
                            <input id="campoCep" type="text" name="cep_cliente" maxlength="8" style="padding: 0 10px !important; border: 0.5px solid #1e282c !important;">
                            <button class="btn btn-danger" id="btnCalcFrete" type="button" style="border-radius: 0px !important; width: 90px !important;">Calcular</button><br>
                            <p style="font-size: 0.90em" id="msgErroCep"></p>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="col-md-12 col-lg-12">
                        <div class="cart-page-heading">
                            <h5>Qual envio prefere?</h5>
                            <p>Escolha uma Opção</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="custom-control custom-radio">
                            <div class="col-4 col-sm-4" style="height: 50px; !important;">
                                <input type="radio" id="customRadio2" name="customRadio" value="1" class="custom-control-input" checked>
                                <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio2">
                                    <span id="pac">&nbsp;Normal</span>
                                </label>
                            </div>

                            <div class="col-4 col-sm-4" style="height: 50px; !important;">
                                <input type="radio" id="customRadio1" name="customRadio" value="2" class="custom-control-input" >
                                <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio1">
                                    <span id="sedex">&nbsp;Expresso</span>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10 col-sm-10" style="height: 25px; !important;">
                                <span id="precoPac"></span>
                            </div>
                            <div class="w-100 d-none d-md-block"></div>
                            <div class="col-10 col-sm-10" style="height: 25px; !important;">
                                <span id="diasPac"></span>
                            </div>
                            <div class="col-10 col-sm-10" style="height: 25px; !important;">
                                <span id="precoSedex"></span>
                            </div>
                            <div class="w-100 d-none d-md-block"></div>
                            <div class="col-10 col-sm-10" style="height: 25px; !important;">
                                <span id="diasSedex" ></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ****** Area final do carrinho ****** -->

    <script src="{{ asset('js/app/pagseguro.lightbox.js') }}"></script>

    <script>

        //JA SETA OS VALORES AO CARREGAR A PAGINA
        $(document).ready(function(){
            $('#precoSubTotal').html('R$ ' + (parseFloat($('#precoProd').html().replace('R$ ', '')) * parseInt($('#qty').val())).toFixed(2).replace('.', ','));
            $('#valorTotal').html('R$ ' + (parseFloat($('#precoProd').html().replace('R$ ', '')) * parseInt($('#qty').val())).toFixed(2).replace('.', ','));
        });

        var totalCalc = false;
        //CALCULO FRETE
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

                        consultaFrete($('#spinner_btn'));

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
        });


        //CONSULTA O WEBSERVICE OU OFFLINE O CEP
        /*function consultaFrete(spinner){
            var qtd = $('#qty').val();

            $.each({{ $produtos }}, function (i, v) {
                var pesoTotal += parseFloat(`{{$produtos[${i}]['pesoProduto']}}`);
                var alturaTotal += parseFloat(`{{$produtos[${i}]['alturaProduto']}}`);
                var larguraTotal += parseFloat(`{{$produtos[${i}]['larguraProduto']}}`);
                var comprimento += parseFloat(`{{$produtos[${i}]['comprimentoProduto']}}`);
            })
            
            pesoTotal = (pesoTotal / 1000);
            pesoTotal = pesoTotal * qtd;

            $objF = {
                cep: $('#campoCep').val(),
                altura: alturaTotal.toFixed(2),
                largura: larguraTotal.toFixed(2),
                peso: pesoTotal.toFixed(2),
                comprimento: comprimentoTotal.toFixed(2)
            };

            spinner.css('visibility', 'visible');
            $('#finalizar').attr('disabled', 'disabled');

            $.ajax({
                url: '{{ url('/page/calculaFrete') }}/' + $objF.cep + ',' + $objF.altura + ',' + $objF.largura + ',' + $objF.peso  + ',' + $objF.comprimento,
                type: 'GET',
                success: function(data){
                    console.log('oy');
                    $('#precoPac').html('R$ ' + data.freteCalculado[0].valor.toFixed(2).toString().replace('.', ','));
                    $('#diasPac').html(data.freteCalculado[0].prazo + ' dias');
                    $('#precoSedex').html('R$ ' + data.freteCalculado[1].valor.toFixed(2).toString().replace('.', ','));
                    $('#diasSedex').html(data.freteCalculado[1].prazo + ' dias');

                    verificaFrete(spinner);

                },
                error: function(){
                    console.log("Erro Correio");

                    //CONSULTA OFFLINE CASO O WEBSERVICE NAO FUNCIONAR
                    $.ajax({
                        url: '{{url('/page/calculaFreteOffline')}}/' + $objF.cep + ',' + $objF.peso,
                        type: 'GET',
                        success: function (data) {
                            console.log("yo");
                            if (data.freteCalculado[0].metodo == "PAC") {
                                $('#precoPac').html('R$ ' + data.freteCalculado[0].preco_frete.toString().replace('.', ','));
                                $('#diasPac').html(data.freteCalculado[0].qtd_dias + ' dias');
                                $('#precoSedex').html('R$ ' + data.freteCalculado[1].preco_frete.toString().replace('.', ','));
                                $('#diasSedex').html(data.freteCalculado[1].qtd_dias + ' dias');
                                $('#customRadio2').removeAttr('disabled');
                                console.log("if");
                            }
                            else{
                                $('#precoSedex').html('R$ ' + data.freteCalculado[0].preco_frete.toString().replace('.', ','));
                                $('#diasSedex').html(data.freteCalculado[0].qtd_dias + ' dias');
                                $('#precoPac').html('');
                                $('#diasPac').html('');
                                $('#customRadio2').attr('disabled', 'disabled');
                            }

                            verificaFrete(spinner);
                        },
                        error: function () {
                            console.log("Erro");
                        }
                    });
                }
            });



        }*/

        function verificaFrete(spinner){
            if ($('#customRadio1').is(':checked')) {
                $('#precoCalcFrete').html($('#precoSedex').html().replace('.', ','));
                $('#tipoServForm').val($('#customRadio1').val());
            }
            else {
                $('#precoCalcFrete').html($('#precoPac').html().replace('.', ','));
                $('#tipoServForm').val($('#customRadio2').val());
            }

            /*$('#precoSubTotal').html($('#valorTotal').html());
            $('#qtdProd').val($('#qty').val());*/
            totalCalc = true;

            atualizaFrete();

            /*$('#freteForm').val(precoFrete.toFixed(2));*/
            $('#finalizar').removeAttr('disabled');
            spinner.css('visibility', 'hidden');
        }

        //VERIFICA SE O SEDEX ESTA SELECIONADO
        $('#customRadio1').on("click", function(){
            $('#precoCalcFrete').html($('#precoSedex').html().replace('.', ','));
            $('#tipoServForm').val($(this).val());
            atualizaFrete();
        });

        //VERIFICA SE O PAC ESTA SELECIONADO
        $('#customRadio2').on("click", function(){
            $('#precoCalcFrete').html($('#precoPac').html().replace('.', ','));
            $('#tipoServForm').val($(this).val());
            atualizaFrete();
        });

        //ATUALIZA FRETE
        var precoSub;
        var precoFrete;
        function atualizaFrete(){
            precoSub = $('#precoSubTotal').html().replace('R$', '').replace(',', '.');
            precoFrete =  $('#precoCalcFrete').html().replace('R$', '').replace(',', '.');
            precoSub = parseFloat(precoSub);
            precoFrete = parseFloat(precoFrete);
            var calcTotal = precoSub + precoFrete;

            $('#precoCalcTotal').html('R$ ' + calcTotal.toFixed(2).toString().replace('.',','));
            $('#freteForm').val(precoFrete.toFixed(2));
        }

        //ABRE O LIGHTBOX DA PAGSEGURO
        $('#finalizar').click(function (e) {
            //e.preventDefault();

            var cdCompra = null;

            $.ajax({
                //url: '/pages/calculaFrete/' + objF,
                url: '{{ url('page/pagseguro/redirect') }}',
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

            // {{--$.ajax({--}}
            // {{--//url: '/pages/calculaFrete/' + objF,--}}
            // {{--url: '{{ url('/pagseguro/redirect') }}',--}}
            // {{--type: 'POST',--}}
            // {{--success: function(data){--}}
            // {{--console.log(data.codigo_compra);--}}
            // {{--},--}}
            // {{--error: function () {--}}
            // {{--console.log('erro');--}}
            // {{--}--}}
            // {{--});--}}

            });

            //SO HABILITA O CAMPO CEP SE ESTIVER PREENCHIDO
            $('#campoCep').on("input", function(){
                if($(this).length != 8){
                    $('#precoCalcFrete').html("-");
                    $('#precoCalcTotal').html("-");
                    $('#precoSedex').html("");
                    $('#precoPac').html("");
                    $('#diasPac').html("");
                    $('#diasSedex').html("");
                    $('#finalizar').attr('disabled', 'disabled');
                    totalCalc=false;
                }
            });

            var preco = null;
            var qtd=0;
            var total=0;
            //DIMINUI O ITEM DA QTD
            $('.qty-minus').click(function(){
                if(preco==null){
                    preco = $('#precoProd').html().replace('R$', '').replace(',', '.');
                    qtd = $('#qty').val();
                    total = preco;
                }

                if(qtd > 1) {
                    total = preco * (qtd - 1);
                    qtd--;
                    $('.qty-plus').removeAttr('disabled');
                } else {
                    $(this).attr('disabled', 'disabled');
                }

                $('#qty').val(qtd);
                $('#valorTotal').html('R$ ' + total.toFixed(2).toString().replace('.', ','));
                $('#precoSubTotal').html('R$ ' + total.toFixed(2).toString().replace('.', ','));
                $('#qtdProd').val($('#qty').val());
                if(totalCalc){
                    atualizaFrete();
                    consultaFrete($('#spinner_qtd'));
                }

            });

            //AUMENTA O ITEM DA QTD
            $('.qty-plus').click(function(){
                if(preco==null){
                    preco = $('#precoProd').html().replace('R$', '').replace(',', '.');
                    qtd = $('#qty').val();
                    total = preco;
                }

            // if(qtd < {{ $produtos[$idx]['qtdProdutoEstoque'] }} - 1) {
            //     qtd++;
            //     total = preco * qtd;
            //     $('.qty-minus').removeAttr('disabled');
            // }
            // else {
            //     $(this).attr('disabled', 'disabled');
            // }

                $('#qty').val(qtd);
                $('#valorTotal').html('R$ ' + total.toFixed(2).toString().replace('.', ','));
                $('#precoSubTotal').html('R$ ' + total.toFixed(2).toString().replace('.', ','));
                $('#qtdProd').val($('#qty').val());

                if(totalCalc) {
                    atualizaFrete();
                    consultaFrete($('#spinner_qtd'));
                }

            });
    </script>

@stop
