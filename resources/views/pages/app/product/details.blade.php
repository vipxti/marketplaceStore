@extends('layouts.app.app')

@section('content')

    <!-- ****** Quick View Modal Area Start ****** -->
    <div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="modal-body">
                    <div class="quickview_body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-5">
                                    <div class="quickview_pro_img">
                                        <img id="imgProdModal" src="" alt="">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="quickview_pro_des">
                                        <h4 class="title">Boutique Silk Dress</h4>
                                        <div class="top_seller_product_rating mb-15">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        <h5 class="price">R$ 0000</h5>
                                        <p>Desc prod</p>
                                        <a href="#">Ver detalhes completos do produto</a>
                                    </div>
                                    <!-- Add to Cart Form -->
                                    <form class="cart" method="post">
                                        <div class="quantity">
                                            <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>

                                            <input type="number" class="qty-text" id="qty" step="1" min="1" max="12" name="quantity" value="1">

                                            <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                        </div>
                                        <button type="submit" name="addtocart" value="5" class="cart-submit">Add ao carrinho</button>
                                        <!-- Wishlist -->
                                        <div class="modal_pro_wishlist">
                                            <a href="wishlist.html" target="_blank"><i class="ti-heart"></i></a>
                                        </div>
                                        <!-- Compare -->
                                        <div class="modal_pro_compare">
                                            <a href="compare.html" target="_blank"><i class="ti-stats-up"></i></a>
                                        </div>
                                    </form>

                                    <div class="share_wf mt-30">
                                        <p>Compartilhe com amigos</p>
                                        <div class="_icon">
                                            <a href="https://www.facebook.com/Celestial-Moda-Evang%C3%A9lica-480913635394202/"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                            <a href="https://www.instagram.com/celestial_moda_evangelica/?hl=pt-br"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ****** Quick View Modal Area End ****** -->

    <!-- ****** Welcome Slides Area Start ****** -->
    <section class="welcome_area">
        <div class="welcome_slides owl-carousel">
            <!-- Single Slide Start -->
            <div class="single_slide height-800 bg-img background-overlay" style="background-image: url(img/app/bg-img/bg-1.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <div class="welcome_slide_text">
                                <h6 data-animation="bounceInDown" data-delay="0" data-duration="500ms">* Only today we offer free shipping</h6>
                                <h2 data-animation="fadeInUp" data-delay="500ms" data-duration="500ms">Fashion Trends</h2>
                                <a href="#" class="btn karl-btn" data-animation="fadeInUp" data-delay="1s" data-duration="500ms">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Slide Start -->
            <div class="single_slide height-800 bg-img background-overlay" style="background-image: {{ asset('img/app/bg-img/bg-4.jpg') }} );">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <div class="welcome_slide_text">
                                <h6 data-animation="fadeInDown" data-delay="0" data-duration="500ms">* Only today we offer free shipping</h6>
                                <h2 data-animation="fadeInUp" data-delay="500ms" data-duration="500ms">Summer Collection</h2>
                                <a href="#" class="btn karl-btn" data-animation="fadeInLeftBig" data-delay="1s" data-duration="500ms">Check Collection</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Slide Start -->
            <div class="single_slide height-800 bg-img background-overlay" style="background-image: url(img/app/bg-img/bg-2.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <div class="welcome_slide_text">
                                <h6 data-animation="fadeInDown" data-delay="0" data-duration="500ms">* Only today we offer free shipping</h6>
                                <h2 data-animation="bounceInDown" data-delay="500ms" data-duration="500ms">Women Fashion</h2>
                                <a href="#" class="btn karl-btn" data-animation="fadeInRightBig" data-delay="1s" data-duration="500ms">Check Collection</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Nav bar do produto -->
    <div class="breadcumb_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="{{ route('products.page') }}">Início</a></li>
                        <li class="breadcrumb-item active">{{ $product->nm_produto }}</li>
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

                                    @foreach($productImages as $key => $pImages)

                                        @if($key > 0)

                                            <li data-target="#product_details_slider" data-slide-to="{{ $key }}" style="{{ 'background-image: url(' . URL::asset('img/products/' . $pImages['im_produto']) . ');' }}">
                                            </li>

                                        @endif

                                    @endforeach

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

                        <p>&nbsp;</p><p>&nbsp;</p>

                        {{-- @if (count($productVariation) > 0)

                            <p>Com variação</p>                          
                            
                        @endif --}}

                        {{-- <div class="widget size mb-30">
                            <h6 class="widget-title">Tamanho</h6>
                            <div class="widget-desc">
                                <ul>
                                    <li><a href="#">32</a></li>
                                    <li><a href="#">34</a></li>
                                    <li><a href="#">36</a></li>
                                    <li><a href="#">38</a></li>
                                    <li><a href="#">40</a></li>
                                    <li><a href="#">42</a></li>
                                </ul>
                            </div>
                        </div> --}}

                        

                        {{-- <div class="widget color mb-50">
                            <h6 class="widget-title">Cor</h6>
                            <div class="widget-desc">
                                <ul class="d-flex justify-content-between">
                                    <li class="gray"><a href="#"><span class="text-center">(3)</span></a></li>
                                    &nbsp;&nbsp;
                                    <li class="red"><a href="#"><span class="text-center">(25)</span></a></li>
                                    &nbsp;&nbsp;
                                    <li class="yellow"><a href="#"><span class="text-center">(112)</span></a></li>
                                    &nbsp;&nbsp;
                                    <li class="green"><a href="#"><span class="text-center">(72)</span></a></li>
                                    &nbsp;&nbsp;
                                    <li class="teal"><a href="#"><span class="text-center">(9)</span></a></li>
                                    &nbsp;&nbsp;
                                    <li class="cyan"><a href="#"><span class="text-center">(29)</span></a></li>
                                </ul>
                            </div>
                        </div> --}}

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

                        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <p>{{ $product->ds_produto }}</p>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </section>

    <script>

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
