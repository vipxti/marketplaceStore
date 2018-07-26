@extends('layouts.app.app')

@section('content')

    <!-- Nav bar do produto -->
    <div class="breadcumb_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="{{ route('products.page') }}">Início</a></li>

                        @if ($isVariation)

                            <li class="breadcrumb-item active">{{ $product->nm_produto_variacao }}</li>
                            
                        @else

                            <li class="breadcrumb-item active">{{ $product->nm_produto }}</li>
                            
                        @endif
   
                    </ol>
                    <!-- btn -->
                    <a href="{{ route('products.page') }}" class="backToHome d-block"><i class="fa fa-angle-double-left"></i> Voltar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Produto e detalhes -->
    <section class="single_product_details_area section_padding_0_100">

        <div class="container">
            <div class="row">

                <div class="col-12 col-md-6">
                    <div class="single_product_thumb">
                        <div id="product_details_slider" class="carousel slide" data-ride="carousel">

                            <ol class="carousel-indicators">

                                <li class="active" data-target="#product_details_slider" data-slide-to="0" style="{{ 'background-image: url(' . URL::asset('img/products/' . $productImages[0]['im_produto']) . ');' }}">
                                </li>

                                @if(count($productImages) > 1)

                                    @if ($isVariation)

                                        @foreach($productImages as $key => $pImages)

                                            @if($key > 0)

                                                <li data-target="#product_details_slider" data-slide-to="{{ $key }}" style="{{ 'background-image: url(' . URL::asset('img/products/' . $pImages['im_produto']) . ');' }}">
                                                </li>

                                            @endif

                                        @endforeach
                                        
                                    @else

                                        @foreach($productImages as $key => $pImages)

                                            @if($key > 0)

                                                <li data-target="#product_details_slider" data-slide-to="{{ $key }}" style="{{ 'background-image: url(' . URL::asset('img/products/' . $pImages['im_produto']) . ');' }}">
                                                </li>

                                            @endif

                                        @endforeach
                                        
                                    @endif    

                                @endif

                            </ol>

                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="{{ URL::asset('img/products/' . $productImages[0]['im_produto']) }}" alt="First slide">
                                </div>

                                @if(count($productImages) > 1)

                                    @foreach($productImages as $key => $pImages)

                                        @if($key > 0)

                                            <div class="carousel-item">
                                                <a class="gallery_img" href="{{ URL::asset('img/products/' . $pImages['im_produto']) }}">
                                                <img class="d-block w-100" src="{{ URL::asset('img/products/' . $pImages['im_produto']) }}" alt="slide">
                                                </a>
                                            </div>

                                        @endif

                                    @endforeach

                                @endif

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">

                    <div class="single_product_desc">

                        @if ($isVariation)

                            <h4 class="title">{{ $product->nm_produto_variacao }}</h4>

                            <h4 class="price">R$ {{ number_format($product->vl_produto_variacao, 2, ',', '.') }}</h4>

                            @if($product->qt_produto_variacao > 5)

                                <p class="available">Disponibilidade: <span class="text-muted">Em estoque</span></p>

                            @else

                                <p class="available">Disponibilidade: <span class="text-muted">Não disponível</span></p>

                            @endif

                            <div class="single_product_ratings mb-15">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>

                            <p>&nbsp;</p>

                            @if (count($variations) > 0)

                                @if ($totalCores > 0)

                                    <div class="widget color mb-50">
                                        <h6 class="widget-title">Cor</h6>

                                        <div class="widget-desc">
                                        
                                            <ul class="d-flex justify-content-between">

                                                @foreach ($colors as $color)

                                                    <li class="{{ str_slug($color->nm_cor, '-') }}"><a href="{{ route('products.details', '') }}" style="background-color: {{ $color->hex }} !important;"><span class="text-center">({{ $color->qt_total_cor }})</span></a></li>
                                                    &nbsp;&nbsp;
                                                    
                                                @endforeach

                                                {{-- @foreach ($variations as $key => $variation)

                                                    @if (count($productColors[$key]) > 0)

                                                        @foreach ($productColors[$key] as $color)
                                                            <li class="{{ str_slug($color['nm_cor'], '-') }}"><a href="{{ route('products.details', $variation->nm_slug_variacao) }}" style="background-color: {{ $color['hex'] }} !important;"><span class="text-center">({{ $variation->qt_produto_variacao }})</span></a></li>
                                                            &nbsp;&nbsp;
                                                            
                                                        @endforeach

                                                    @endif

                                                @endforeach --}}

                                            </ul>
                                
                                        </div>

                                    </div>
                                    
                                @endif

                                @if ($totalNumeros > 0)

                                    <div class="widget size mb-30">
                                        <h6 class="widget-title">Tamanho</h6>

                                        <div class="widget-desc">
                                            <ul>

                                                @foreach ($variations as $key => $variation)

                                                    @if (count($productNumberSizes[$key]) > 0)

                                                        @foreach ($productNumberSizes[$key] as $number)
                                                        
                                                            <li><a href="{{ route('products.details', $variation->nm_slug_variacao) }}">{{ $number['nm_tamanho_num'] }}</a></li>

                                                        @endforeach

                                                    @endif
                                                    
                                                @endforeach

                                            </ul>

                                        </div>
                                
                                    </div>

                                @endif

                                @if ($totalLetras > 0)

                                    <div class="widget size mb-30">
                                        <h6 class="widget-title">Tamanho</h6>

                                        <div class="widget-desc">
                                            <ul>

                                                @foreach ($variations as $key => $variation)

                                                    @if (count($productLetterSizes[$key]) > 0)

                                                        @foreach ($productLetterSizes[$key] as $letter)

                                                        {{ $letter }}
                                                        
                                                            <li><a href="{{ route('products.details', $variation->nm_slug_variacao) }}">{{ $letter['nm_tamanho_letra'] }}</a></li>

                                                        @endforeach

                                                    @endif
                                                    
                                                @endforeach

                                            </ul>

                                        </div>
                                
                                    </div>

                                @endif

                            @endif

                            <p>&nbsp;</p>

                            @if($product->qt_produto_variacao <= 5)

                                <p>SEM ESTOQUE</p>

                            @else

                                <!-- Botão adicionar carrinho -->
                                <form action="{{ route('cart.buy') }}" class="cart clearfix mb-50 d-flex" method="post">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="cd_produto" value="{{ $product->cd_produto_variacao }}">
                                    <input type="hidden" name="nm_produto" value="{{ $product->nm_produto_variacao }}">
                                    <input type="hidden" name="ds_produto" value="{{ $product->ds_produto_variacao }}">
                                    <input type="hidden" name="vl_produto" value="{{ $product->vl_produto_variacao }}">
                                    <input id="qtProdEstoque" type="hidden" name="qt_produto" value="{{ $product->qt_produto_variacao }}">
                                    <input type="hidden" name="sku_produto" value="{{ $product->cd_nr_sku }}">
                                    <input type="hidden" name="slug_produto" value="{{ $product->nm_slug_variacao }}">
                                    <input type="hidden" name="ds_altura" value="{{ $product->ds_altura }}">
                                    <input type="hidden" name="ds_largura" value="{{ $product->ds_largura }}">
                                    <input type="hidden" name="ds_comprimento" value="{{ $product->ds_comprimento }}">
                                    <input type="hidden" name="ds_peso" value="{{ $product->ds_peso }}">
                                    <input type="hidden" name="im_produto" value="{{ $productImages[0]['im_produto'] }}">

                                    {{-- <div class="quantity">
                                        <span id="1" class="qty-minus">
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </span>
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="12" name="quantity" value="1" disabled>
                                        <span id="1" class="qty-plus">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </span>
                                    </div> --}}

                                    <button type="submit" class="btn cart-submit d-block">Comprar</button>       
                                </form>

                            @endif
                            
                        @else

                            <h4 class="title">{{ $product->nm_produto }}</h4>

                            <h4 class="price">R$ {{ number_format($product->vl_produto, 2, ',', '.') }}</h4>

                            @if($product->qt_produto > 5)

                                <p class="available">Disponibilidade: <span class="text-muted">Em estoque</span></p>

                            @else

                                <p class="available">Disponibilidade: <span class="text-muted">Não disponível</span></p>

                            @endif

                            <div class="single_product_ratings mb-15">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>

                            <p>&nbsp;</p>

                            @if (count($variations) > 0)

                                @if ($totalCores > 0)

                                    <div class="widget color mb-50">
                                        <h6 class="widget-title">Cor</h6>

                                        <div class="widget-desc">
                                        
                                            <ul class="d-flex justify-content-between">

                                                @foreach ($colors as $color)

                                                    <li class="{{ str_slug($color->nm_cor, '-') }}"><a href="{{ route('products.details', '') }}" style="background-color: {{ $color->hex }} !important;"><span class="text-center">({{ $color->qt_total_cor }})</span></a></li>
                                                    &nbsp;&nbsp;
                                                    
                                                @endforeach

                                                {{-- @foreach ($variations as $key => $variation)

                                                    @if (count($productColors[$key]) > 0)

                                                        @foreach ($productColors[$key] as $color)
                                                            <li class="{{ str_slug($color['nm_cor'], '-') }}"><a href="{{ route('products.details', $variation->nm_slug_variacao) }}" style="background-color: {{ $color['hex'] }} !important;"><span class="text-center">({{ $variation->qt_produto_variacao }})</span></a></li>
                                                            &nbsp;&nbsp;
                                                            
                                                        @endforeach

                                                    @endif

                                                @endforeach --}}

                                            </ul>
                                
                                        </div>

                                    </div>
                                    
                                @endif

                            @endif

                            <p>&nbsp;</p>

                            @if($product->qt_produto <= 5)

                                <p>SEM ESTOQUE</p>

                            @else

                                <!-- Botão adicionar carrinho -->
                                <form action="{{ route('cart.buy') }}" class="cart clearfix mb-50 d-flex" method="post">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="cd_produto" value="{{ $product->cd_produto }}">
                                    <input type="hidden" name="nm_produto" value="{{ $product->nm_produto }}">
                                    <input type="hidden" name="ds_produto" value="{{ $product->ds_produto }}">
                                    <input type="hidden" name="vl_produto" value="{{ $product->vl_produto }}">
                                    <input id="qtProdEstoque" type="hidden" name="qt_produto" value="{{ $product->qt_produto }}">
                                    <input type="hidden" name="sku_produto" value="{{ $product->cd_nr_sku }}">
                                    <input type="hidden" name="slug_produto" value="{{ $product->nm_slug }}">
                                    <input type="hidden" name="ds_altura" value="{{ $product->ds_altura }}">
                                    <input type="hidden" name="ds_largura" value="{{ $product->ds_largura }}">
                                    <input type="hidden" name="ds_comprimento" value="{{ $product->ds_comprimento }}">
                                    <input type="hidden" name="ds_peso" value="{{ $product->ds_peso }}">
                                    <input type="hidden" name="im_produto" value="{{ $productImages[0]['im_produto'] }}">

                                    {{-- <div class="quantity">
                                        <span id="1" class="qty-minus">
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </span>
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="12" name="quantity" value="1" disabled>
                                        <span id="1" class="qty-plus">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </span>
                                    </div> --}}

                                    <button type="submit" class="btn cart-submit d-block">Comprar</button>       
                                    
                                </form>

                            @endif
                            
                        @endif

                    </div>

                </div>

            </div>

            <p>&nbsp;</p>

            <!--Informações do produto -->
            <div class="row">

                <form id="accordion" role="tablist">
                    <div class="card">
                        <div class="card-header" role="tab" id="headingOne">
                            <h6>
                                <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Informação do produto</a>
                            </h6>
                        </div>

                        @if ($isVariation)

                            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <p>{{ $product->ds_produto_variacao }}</p>
                                </div>
                            </div>

                        @else

                            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    {{--<p>{{ $product->ds_produto }}</p>--}}
                                    <input type="text" id="desc_prod" value="{{ $product->ds_produto }}" hidden>
                                    <div id="texto_desc">

                                    </div>
                                </div>
                            </div>
                            
                        @endif

                    </div>
                </form>

            </div>
        </div>

    </section>

    <script>

        $(document).ready(function(){
            var descricao = $('#desc_prod').val();
            $('#texto_desc').html(descricao);
        });

        $('.qty-plus').click(function(e){

            var qtd = parseInt($('#qty').val());
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var qtdEstoque = parseInt($('#qtProdEstoque').val());

            if (qtd == qtdEstoque - 5) {
              
                $(this).attr('disabled');    

            }
            else {

                $.ajax({
                    url: '{{ url('/page/cart/plus/details') }}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, qtd: 1},
                    dataType: 'JSON',
                    success: function (r) {

                        console.log(r.qtd);

                    }
                });               
                    
            } 

        });

        //Diminui a quantidade de cada item no carrinho
        $('.qty-minus').click(function (e){

            var sku = $(this).attr('id');
            var qtd = parseInt($('#qty' + id).val());
            var precoProd = parseFloat($('#precoProd' + id).html().replace('R$ ', '').replace(',', '.'));
            
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
                        $('#qty' + id).val(r.cartSession[idx].qtdIndividual);
                        $('#valorTotal' + idx).html('R$ ' + r.cartSession[idx].valorTotalProduto.toFixed(2).replace('.', ','));
                        $('#precoSubTotal').html('R$ ' + r.subTotal.toFixed(2).replace('.', ','));
                        $('#precoCalcTotal').html('R$ ' + r.total.toFixed(2).replace('.', ','));
                        
                    }
                });

            }

        });

    </script>

@stop
