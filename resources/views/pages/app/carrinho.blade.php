@extends('layouts.app.app')

@section('content')

    <!-- ****** Cart Area Start ****** -->
    <div class="cart_area section_padding_100 clearfix">

        <div class="container">

            <div class="row">

                <div class="col-lg-10 offset-lg-1 col-md-10 offset-md-1">

                    <p class="h3">Meu carrinho</p>

                </div>

            </div>

            <p>&nbsp;</p>

            @if(Session::get('cart') == null)

                <div class="row">

                    <div class="col-12 col-md-11 offset-md-1" style="border: 1px solid black;">

                        <p>&nbsp;</p>

                        <p class="h2 text-center">Não há produtos no carrinho</p>
                        <p>&nbsp;</p>
                        <p class="h5 text-justify">
                            Para inserir algum produto no seu carrinho, navegue pela página de produtos. Ao encontrar os itens desejados, clique no botão COMPRAR localizado na página do produto.
                        </p>

                        <p>&nbsp;</p>

                    </div>     

                </div>

                <p>&nbsp;</p>

                <div class="row">

                    <div class="col-12 col-md-12 text-right">

                        <a href="{{ route('index') }}" class="btn btn-danger" style="border-radius: 0px; font-size: 14px; background-color: #d33889">Continuar Comprando</a>

                    </div>

                </div>

            @else
            
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
                                        <th></th>
                                    </tr>
                                
                                </thead>
                                
                                <tbody>

                                    <input type="hidden" name="qtdItensCarrinho" value="{{ Session::get('qtCartItems') }}">

                                    <input type="hidden" id="alturaTotal" name="alturaTotal" value="{{ Session::get('totalHeight') }}">
                                    <input type="hidden" id="larguraTotal" name="larguraTotal" value="{{ Session::get('totalWidth') }}">
                                    <input type="hidden" id="comprimentoTotal" name="comprimentoTotal" value="{{ Session::get('totalLength') }}">
                                    <input type="hidden" id="pesoTotal" name="pesoTotal" value="{{ Session::get('totalWeight') }}">

                                    @foreach(Session::get('cart') as $key => $produto)

                                        <input id="{{ 'idx' . $key }}" type="hidden" name="{{ 'idx['. $key .']' }}" value="{{ $key }}">
                                        <input id="{{ 'qtProdEstoque' . $key }}" type="hidden" value="{{ $produto['qtdProdutoEstoque'] }}">

                                        <tr>

                                            <td class="cart_product_img d-flex align-items-center">
                                                <a href="{{ route('products.details', $produto['skuProduto']) }}">
                                                    <img src="{{ URL::asset('img/products' . '/' . $produto['imagemProduto']) }}" alt="Product">
                                                </a>
                                                <h5>{{ $produto['nomeProduto'] }}</h5>
                                            </td>

                                            <td class="price"><span id="{{ 'precoProd' . $key }}">R$ {{ number_format($produto['valorProduto'], 2, ',', '.') }}</span></td>

                                            <td class="qty">
                                                <div class="quantity">
                                                    <span id="{{ $key }}" class="qty-minus">
                                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                                    </span>
                                                    
                                                    <input type="text" class="qty-text" id="{{ 'qty' . $key }}" step="1" min="1" max="99" name="quantity" disabled value="{{ $produto['qtdIndividual'] }}">
                                                    
                                                    <span id="{{ $key }}" class="qty-plus">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </span>
                                                    
                                                    <i id="spinner_qtd" class="fa fa-spinner fa-pulse fa-3x fa-fw" style="font-size: 22px; visibility: hidden"></i>
                                                </div>
                                            </td>

                                            <td class="total_price">
                                                <span id="{{ 'valorTotal' . $key }}">
                                                    R$ {{ number_format($produto['valorTotalProduto'], 2, ',', '.') }}
                                                </span>
                                            </td>
                                            
                                            <td>
                                                <form action="{{ route('cart.product.delete') }}" method="post">
                                                    {{ csrf_field() }}
                                                    
                                                    <input type="hidden" name="cod_produto_carrinho" value="{{ $key }}">
                                                    
                                                    <button type="submit" class="btn btn-danger">
                                                        Excluir
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>
                            
                            </table>
                        
                        </div>

                        <div class="cart-footer d-flex mt-30">
                            <div class="back-to-shop">
                                
                                <a href="{{ route('index') }}" class="btn btn-danger" style="border-radius: 0px; font-size: 14px; background-color: #d33889">Continuar Comprando</a>

                            </div>

                            <div class="update-checkout w-50">
                                <form action="{{ route('cart.clear') }}" method="post">
                                    {{ csrf_field() }}

                                    @foreach(Session::get('cart') as $key => $produto)

                                        <input type="hidden" name="{{ 'idx[' . $key . ']' }}" value="{{ $produto['skuProduto'] }}">

                                    @endforeach

                                    <button type="submit" class="btn btn-danger" style="border-radius: 0px; font-size: 14px; background-color: #3a3a3a">Limpar Carrinho</button>

                                </form>
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

                                @if(Auth::check())

                                    <input id="campoCep" type="text" name="cep_cliente" maxlength="8" value={{ $enderecoCliente[0]['cd_cep'] }} style="padding: 0 10px !important;">

                                @else

                                    <input id="campoCep" type="text" name="cep_cliente" maxlength="8" style="padding: 0 10px !important;">

                                @endif

                                <button class="btn btn-danger" id="btnCalcFrete" type="button" style="border-radius: 0px">Calcular</button>
                                <i id="spinner_btn" class="fa fa-spinner fa-pulse fa-3x fa-fw" style="font-size: 22px; visibility: hidden"></i><br>
                                <p style="font-size: 0.90em" id="msgErroCep"></p>
                            </form>
                        </div>
                    </div>

                <div class="col-12 col-md-6 col-lg-6" style="margin-top: 70px !important;">
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

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="cart-total-area mt-70">
                        <div class="cart-page-heading">
                            <h5>Total</h5>
                            <p>Informações da compra</p>
                        </div>
                        <ul class="cart-total-chart">
                            <li><span>Subtotal</span> <span id="precoSubTotal">R$ {{ number_format(Session::get('subtotalPrice'), 2, ',', '.') }}</span></li>
                            <li><span>Envio</span> <span id="precoCalcFrete">-</span></li>
                        <li><span><strong>Total</strong></span> <span><strong id="precoCalcTotal">R$ {{ number_format(Session::get('totalPrice'), 2, ',', '.') }}</strong></span></li>
                        </ul>

                        <form id="formComprar">
                            {{ csrf_field() }}

                            @foreach(Session::get('cart') as $key => $produto)

                                <!-- array dos produtos -->
                                <input type="hidden" name="id[]" value="{{ ($key + 1) }}">
                                <input type="hidden" id="qtdProd" name="quantidade[]" value="{{ $produto['qtdIndividual'] }}">
                                <input type="hidden" name="descricao[]" value="{{ $produto['nomeProduto'] }}">
                                <input type="hidden" name="valor[]" value="{{ $produto['valorProduto'] }}">
                                <input type="hidden" name="peso[]" value="{{ $produto['pesoTotalProduto'] }}">
                                <input type="hidden" name="largura[]" value="{{ $produto['larguraTotalProduto'] }}">
                                <input type="hidden" name="altura[]" value="{{ $produto['alturaTotalProduto'] }}">
                                <input type="hidden" name="comprimento[]" value="{{ $produto['comprimentoTotalProduto'] }}">
                                    

                            @endforeach

                            <input type="hidden" name="fretecal" value="">
                            <input id="freteForm" type="hidden" name="freteval" value="">
                            <input id="tipoServForm" type="hidden" name="tipoServ" value="">

                        <!-- array do cliente -->
                            {{--  <input type="hidden" name="cep" value="{{ $cliente[0]->cd_cep }}">
                              <input type="hidden" name="endereco" value="{{ $cliente[0]->ds_endereco }}">
                              <input type="hidden" name="numero" value="{{ $cliente[0]->cd_numero_endereco }}">
                              <input type="hidden" name="bairro" value="{{ $cliente[0]->nm_bairro }}">
                              <input type="hidden" name="cidade" value="{{ $cliente[0]->nm_cidade }}">
                              <input type="hidden" name="estado" value="{{ $cliente[0]->nm_uf }}">
                              <input type="hidden" name="pais" value="{{ $cliente[0]->nm_pais }}">--}}

                            @if(Auth::check())

                                <input type="hidden" name="nome" value="{{ Auth::user()->nm_cliente }}">
                                <input type="hidden" name="email_cliente" value="{{ Auth::user()->email }}">
                                <input type="hidden" name="numero_cpf" value="{{ Auth::user()->cd_cpf_cnpj }}">
                                <input type="hidden" name="telefone" value="{{ $telefone }}">
                                <input type="hidden" name="cep" value="{{ $enderecoCliente[0]['cd_cep'] }}">
                                <input type="hidden" name="endereco" value="{{ $enderecoCliente[0]['ds_endereco'] }}">
                                <input type="hidden" name="complemento_endereco" value="{{ $enderecoCliente[0]['ds_complemento'] }}">
                                <input type="hidden" name="numero_endereco" value="{{ $enderecoCliente[0]['cd_numero_endereco'] }}">
                                <input type="hidden" name="cidade" value="{{ $enderecoCliente[0]['nm_cidade'] }}">
                                <input type="hidden" name="bairro" value="{{ $enderecoCliente[0]['nm_bairro'] }}">
                                <input type="hidden" name="estado" value="{{ $enderecoCliente[0]['sg_uf'] }}">
                                <input type="hidden" name="pais" value="{{ $enderecoCliente[0]['nm_pais'] }}">

                                <button type="button" id="finalizar" disabled class="btn btn-danger" style="width: 100%; border-radius: 0px; font-weight: 700; font-size: 14px; background-color: #d33889">Finalizar Compra</button>

                            @else

                                <a href="{{ route('client.login') }}"><button type="button" id="fazerlogin" class="btn btn-danger" style="width: 100%; border-radius: 0px; font-weight: 700; font-size: 14px; background-color: #d33889">Faça login para finalizar sua compra</button></a> 

                            @endif


                            {{--<input type="hidden" name="telefone" value="{{ $cliente[0]->fk_cd_telefone }}">
                            <input type="hidden" name="data_nascimento" value="{{ $cliente[0]->dt_nascimento }}">--}}

                            
                        </form>
                    </div>
                </div>

            @endif

        </div>

    </div>
    <!-- ****** Area final do carrinho ****** -->

    <script src="{{ asset('js/app/pagseguro.lightbox.js') }}"></script>

    <script>

        //Aumenta a quantidade de cada item no carrinho
        $('.qty-plus').click(function(e){

            var idx = $(this).attr('id');
            var qtd = parseInt($('#qty' + idx).val());
            var precoProd = parseFloat($('#precoProd' + idx).html().replace('R$ ', '').replace(',', '.'));
            var qtdEstoque = parseInt($('#qtProdEstoque' + idx).val());

            if (qtd == qtdEstoque - 5) {
              
                $('.qty-plus').attr('disabled');    

            }
            else {

                qtd += 1;

                $('.qty-plus').attr('disabled');

                $.ajax({
                    url: '{{ url('/page/cart/plus') }}/' + idx,
                    type: 'GET',
                    success: function (r) {

                        $('.cart_quantity').html(r.qtCarrinho);
                        $('#qty' + idx).val(r.cartSession[idx].qtdIndividual);
                        $('#valorTotal' + idx).html('R$ ' + r.cartSession[idx].valorTotalProduto.toFixed(2).replace('.', ','));
                        $('#precoSubTotal').html('R$ ' + r.subTotal.toFixed(2).replace('.', ','));
                        $('#precoCalcTotal').html('R$ ' + r.total.toFixed(2).replace('.', ','));
                        
                    }
                });

                $('.qty-plus').attr('disabled');

                setTimeout(() => {
                    $('.qty-plus').removeAttr('disabled');
                }, 3000);
                    
            } 

        });

        //Diminui a quantidade de cada item no carrinho
        $('.qty-minus').click(function (e){

            var idx = $(this).attr('id');
            var qtd = parseInt($('#qty' + idx).val());
            var precoProd = parseFloat($('#precoProd' + idx).html().replace('R$ ', '').replace(',', '.'));
            
            if (qtd == 1) {
                
                $('.qty-minus').attr('disabled');    

            }
            else {

                qtd -= 1;

                $('.qty-minus').attr('disabled');

                $.ajax({
                    url: '{{ url('/page/cart/minus') }}/' + idx,
                    type: 'GET',
                    data: {},
                    success: function (r) {

                        $('.cart_quantity').html(r.qtCarrinho);
                        $('#qty' + idx).val(r.cartSession[idx].qtdIndividual);
                        $('#valorTotal' + idx).html('R$ ' + r.cartSession[idx].valorTotalProduto.toFixed(2).replace('.', ','));
                        $('#precoSubTotal').html('R$ ' + r.subTotal.toFixed(2).replace('.', ','));
                        $('#precoCalcTotal').html('R$ ' + r.total.toFixed(2).replace('.', ','));
                        
                    }
                });

            }

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
        function consultaFrete(spinner){
            
            var pesoTotal = $('#pesoTotal').val();
            var alturaTotal = $('#alturaTotal').val();
            var larguraTotal = $('#larguraTotal').val();
            var comprimentoTotal = $('#comprimentoTotal').val();

            console.log(pesoTotal);

            pesoTotal = (pesoTotal / 1000);

            $objF = {
                cep: $('#campoCep').val(),
                altura: parseFloat(alturaTotal).toFixed(2),
                largura: parseFloat(larguraTotal).toFixed(2),
                peso: parseFloat(pesoTotal).toFixed(2),
                comprimento: parseFloat(comprimentoTotal).toFixed(2)
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



        }

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
    </script>

@stop
