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
                                        <a href="#"><img src="" alt="Product"></a>
                                        <h6>Produto Teste</h6>
                                    </td>

                                    <td class="price"><span id="precoProd">R$ 1000,00</span></td>

                                    <td class="qty">
                                        <div class="quantity">
                                            <span class="qty-minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                            <input type="number" class="qty-text" id="qty" step="1" min="1" max="99" name="quantity" value="1">
                                            <span class="qty-plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                            <i id="spinner_qtd" class="fa fa-spinner fa-pulse fa-3x fa-fw" style="font-size: 22px; visibility: hidden"></i>
                                        </div>
                                    </td>
                                    
                                    <td class="total_price"><span id="valorTotal"></span></td>

                                    {{-- Foreach aqui!!!!! --}}

                                    {{-- {{ dd($produtos) }} --}}
                                    {{-- {{ dd($imagem) }} --}}

                                    {{-- @foreach($produtos as $key => $produto)

                                        <p>{{ Session::get('qtd' . $produto['skuProduto']) }}</p>

                                        <td class="cart_product_img d-flex align-items-center">
                                            <a href="#"><img src="{{ asset('img/products/' . $imagem[$key]->im_produto) }}" alt="Product"></a>
                                            <h6>{{ $produto['nomeProduto'] }}</h6>
                                        </td>

                                        <td class="price"><span id="precoProd">R$ {{ str_replace('.', ',', $produto['valorProduto']) }}</span></td>

                                        <td class="qty">
                                            <div class="quantity">
                                                <span class="qty-minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                                <input type="number" class="qty-text" id="qty" step="1" min="1" max="99" name="quantity" value="{{ Session::get('qtd' . $produto['skuProduto']) }}">
                                                <span class="qty-plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                                <i id="spinner_qtd" class="fa fa-spinner fa-pulse fa-3x fa-fw" style="font-size: 22px; visibility: hidden"></i>
                                            </div>
                                        </td>
                                        <td class="total_price"><span id="valorTotal"></span></td>
                                        
                                    @endforeach --}}
                                    
                                </tr>

                            </tbody>
                        
                        </table>
                    
                    </div>

                    <div class="cart-footer d-flex mt-30">

                        <div class="back-to-shop">
                            <button type="button" class="btn btn-danger" style="border-radius: 0px; font-size: 14px; background-color: #d33889">Continuar Comprando</button>
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
                            <button class="btn btn-danger" id="btnCalcFrete" type="button" style="border-radius: 0px">Calcular</button>
                            <i id="spinner_btn" class="fa fa-spinner fa-pulse fa-3x fa-fw" style="font-size: 22px; visibility: hidden"></i><br>
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
                                    <span id="sedex">Expresso &nbsp;</span><span id="precoSedex"></span><span id="diasSedex"></span>
                                </label>
                            </div>
                            <div class="custom-control custom-radio mb-14">
                                <input type="radio" id="customRadio2" name="customRadio" value="1" class="custom-control-input">
                                <label class="custom-control-label d-flex align-items-center justify-content-between" for="customRadio2">
                                    <span id="pac">Normal &nbsp;</span><span id="precoPac"></span><span id="diasPac"></span>
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
                            <li><span>Envio</span> <span id="precoCalcFrete">-</span></li>
                            <li><span><strong>Total</strong></span> <span><strong id="precoCalcTotal">-</strong></span></li>
                        </ul>

                        {{-- <form id="formComprar">
                            {{ csrf_field() }}

                            @foreach($produtos as $key => $produto)

                                <!-- array dos produtos -->
                                <input type="hidden" name="id[]" value="{{ $key + 1}}">
                                <input type="hidden" name="code[]" id="code" value="{{ $produto['uidProduto'] }}" />
                                <input type="hidden" name="descricao[]" value="{{ $produto['nomeProduto'] }}">
                                <input type="hidden" id="qtdProd" name="quantidade[]" value="{{ $produto['qtdIndividual'] }}">
                                <input type="hidden" name="valor[]" value="{{ $produto['valorProduto'] }}">
                                <input type="hidden" name="peso[]" value="{{ $produto['pesoProduto'] }}">
                                <input type="hidden" name="fretecal[]" value="">
                                <input type="hidden" name="largura[]" value="{{ $produto['larguraProduto'] }}">
                                <input type="hidden" name="altura[]" value="{{ $produto['alturaProduto'] }}">
                                <input type="hidden" name="comprimento[]" value="{{ $produto['comprimentoProduto'] }}">
                                <input id="freteForm" type="hidden" name="freteval[]" value="">
                                <input id="tipoServForm" type="hidden" name="tipoServ[]" value="">

                            @endforeach

                            <!-- array do cliente -->
                            {{--  <input type="hidden" name="cep" value="{{ $cliente[0]->cd_cep }}">
                            <input type="hidden" name="endereco" value="{{ $cliente[0]->ds_endereco }}">
                            <input type="hidden" name="numero" value="{{ $cliente[0]->cd_numero_endereco }}">
                            <input type="hidden" name="bairro" value="{{ $cliente[0]->nm_bairro }}">
                            <input type="hidden" name="cidade" value="{{ $cliente[0]->nm_cidade }}">
                            <input type="hidden" name="estado" value="{{ $cliente[0]->nm_uf }}">
                            <input type="hidden" name="pais" value="{{ $cliente[0]->nm_pais }}">--}}

                            @if(Auth::check())

                                <input type="hidden" name="email_cliente" value="{{ Auth::user()->email }}">
                                <input type="hidden" name="nome" value="{{ Auth::user()->nm_cliente }}">
                                <input type="hidden" name="numero_cpf" value="{{ Auth::user()->cd_cpf_cnpj }}">

                            @endif

                            
                            {{--<input type="hidden" name="telefone" value="{{ $cliente[0]->fk_cd_telefone }}">
                            <input type="hidden" name="data_nascimento" value="{{ $cliente[0]->dt_nascimento }}">--}}

                            <button type="button" id="finalizar" disabled class="btn btn-danger" style="width: 100%; border-radius: 0px; font-weight: 700; font-size: 14px; background-color: #d33889">Finalizar Compra</button>
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>   

@stop