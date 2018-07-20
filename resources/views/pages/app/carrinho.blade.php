@extends('layouts.app.app')

@section('content')

    <!-- ****** Cart Area Start ****** -->
    <br><br><br>
    <div class="cart_area clearfix">
        <div class="container">

           {{-- <div class="row">
                <div class="col-12">
                    <div class="section_heading text-center">
                        <h3><i class="fa fa-shopping-cart"></i>&nbsp; Meu Carrinho</h3>
                    </div>
                </div>
            </div>--}}

            <p>&nbsp;</p>

            @if(Session::get('cart') == null)

                <div class="row">
                    <div class="col-12 text-center">
                        <img src="{{asset('img/app/bg-img/carrinhovazio.png')}}" alt="">
                    </div>
                </div>

                <br><br>

                <div class="row">
                    <div class="col-12 col-md-12 text-right">
                        <a href="{{ route('index') }}" class="btn btn-danger" style="border-radius: 0px; font-size: 14px; background-color: #d33889; width: 100%;">Continuar Comprando</a>
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
                                                <a href="{{ route('products.details', $produto['slugProduto']) }}">
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
                                                    
                                                    <button type="submit" class="btn btn-danger" style="background-color: #d33889; border-radius:0px">
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

                                <a href="{{ route('index') }}"><button type="button" class="btn btn-danger" style="border-radius: 0px; font-size: 14px; background-color: #d33889">Continuar Comprando</button></a>

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

                    <p>&nbsp;</p>

                    <div class="col-12">
                    
                        <div class="cart-page-heading">
                            <h5>Qual envio prefere?</h5>
                            <p>Escolha uma Opção</p>
                        </div>

                    </div>

                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="customRadio" value="1" class="custom-control-input" checked>
                            <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio2">
                                <span id="pac">&nbsp;Normal</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="custom-control custom-radio">   
                            <input type="radio" id="customRadio1" name="customRadio" value="2" class="custom-control-input" >
                            <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio1">
                                <span id="sedex">&nbsp;Expresso</span>
                            </label>
                        </div>
                    </div>
                </div>

                <p>&nbsp;</p>

                <div class="row">
                    <div class="col-10 col-sm-10">
                        <p class="h6">Obs: O valor do frete será calculado pelo PagSeguro</p>
                    </div> 
                </div>

                <div class="row">
                    <div class="col-12">
                    
                        <div class="cart-total-area mt-30">
                        
                            <ul class="cart-total-chart">
                                <li>
                                    <span>
                                        <strong>Subtotal</strong>
                                    </span>
                                    
                                    <span id="precoSubTotal">
                                        <strong>R$ {{ number_format(Session::get('subtotalPrice'), 2, ',', '.') }}</strong>
                                    </span>
                                </li>

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

                                {{-- <input type="hidden" name="fretecal" value=""> --}}
                                {{-- <input id="freteForm" type="hidden" name="freteval" value=""> --}}
                                <input id="tipoServForm" type="hidden" name="tipoServ" value="1">

                                @if(Auth::check())

                                    <input type="hidden" name="nome" value="{{ Auth::user()->nm_cliente }}">
                                    <input type="hidden" name="email_cliente" value="{{ Auth::user()->email }}">
                                    <input type="hidden" name="numero_cpf" value="{{ Auth::user()->cd_cpf_cnpj }}">
                                    <input type="hidden" name="telefone" value="{{ $telefone }}">

                                    @if (count($enderecoCliente) == 0)

                                        <a href="{{ route('client.dashboard') }}"><button type="button" id="fazerlogin" class="btn btn-danger" style="width: 100%; border-radius: 0px; font-weight: 700; font-size: 14px; background-color: #d33889">É preciso cadastrar um endereço para finalizar a compra</button></a>

                                    @else

                                        <input type="hidden" name="cep" value="{{ $enderecoCliente[0]['cd_cep'] }}">
                                        <input type="hidden" name="endereco" value="{{ $enderecoCliente[0]['ds_endereco'] }}">
                                        <input type="hidden" name="complemento_endereco" value="{{ $enderecoCliente[0]['ds_complemento'] }}">
                                        <input type="hidden" name="numero_endereco" value="{{ $enderecoCliente[0]['cd_numero_endereco'] }}">
                                        <input type="hidden" name="cidade" value="{{ $enderecoCliente[0]['nm_cidade'] }}">
                                        <input type="hidden" name="bairro" value="{{ $enderecoCliente[0]['nm_bairro'] }}">
                                        <input type="hidden" name="estado" value="{{ $enderecoCliente[0]['sg_uf'] }}">
                                        <input type="hidden" name="pais" value="{{ $enderecoCliente[0]['nm_pais'] }}">

                                        <button type="button" id="finalizar" class="btn btn-danger" style="width: 100%; border-radius: 0px; font-weight: 700; font-size: 14px; background-color: #d33889">Finalizar Compra</button>
                                        
                                    @endif

                                @else

                                    <a href="{{ route('client.login') }}"><button type="button" id="fazerlogin" class="btn btn-danger" style="width: 100%; border-radius: 0px; font-weight: 700; font-size: 14px; background-color: #d33889">Faça login para finalizar sua compra</button></a>

                                @endif

                                {{--<input type="hidden" name="telefone" value="{{ $cliente[0]->fk_cd_telefone }}">
                                <input type="hidden" name="data_nascimento" value="{{ $cliente[0]->dt_nascimento }}">--}}
    
                            </form>

                        </div>
                    </div>
                </div>

            @endif

        </div>
    </div>
    
    <br><br><br><br>
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
              
                $(this).attr('disabled');    

            }
            else {

                qtd += 1;

                $.ajax({
                    url: '{{ url('/page/cart/plus') }}/' + idx,
                    type: 'GET',
                    success: function (r) {

                        location.reload();

                        $('.cart_quantity').html(r.qtCarrinho);
                        $('#qty' + idx).val(r.cartSession[idx].qtdIndividual);
                        $('#valorTotal' + idx).html('R$ ' + r.cartSession[idx].valorTotalProduto.toFixed(2).replace('.', ','));
                        $('#precoSubTotal').html('R$ ' + r.subTotal.toFixed(2).replace('.', ','));
                        $('#precoCalcTotal').html('R$ ' + r.total.toFixed(2).replace('.', ','));

                    }
                });               
                    
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

                        location.reload();

                        $('.cart_quantity').html(r.qtCarrinho);
                        $('#qty' + idx).val(r.cartSession[idx].qtdIndividual);
                        $('#valorTotal' + idx).html('R$ ' + r.cartSession[idx].valorTotalProduto.toFixed(2).replace('.', ','));
                        $('#precoSubTotal').html('R$ ' + r.subTotal.toFixed(2).replace('.', ','));
                        $('#precoCalcTotal').html('R$ ' + r.total.toFixed(2).replace('.', ','));
                        
                    }
                });

            }

        });

        $('#customRadio2').click(function (e) {
            var tipoServ = $('#customRadio2').val();
            
            $('#tipoServForm').val(tipoServ);
        });

        $('#customRadio1').click(function (e) {
            var tipoServ = $('#customRadio1').val();
            
            $('#tipoServForm').val(tipoServ);
        });

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

                    console.log(cdCompra);

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

    </script>

@stop
