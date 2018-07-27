@extends('layouts.app.app')

@section('content')

    {{--dd($produtoCatSubCat)--}}

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
                                    <form action="{{ route('cart.buy') }}" class="cart" method="post">
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
    <!-- ****** Welcome Slides Area End ****** -->


    {{--<section class="new_arrivals_area section_padding_100_0 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_heading text-center">
                        <h3>Produtos</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row karl-new-arrivals">

            @foreach($produtos as $key => $produto)

                <!-- Single gallery Item Start -->
                <div class="col-12 col-sm-6 col-md-4 single_gallery_item women wow fadeInUpBig" data-wow-delay="0.2s">

                    <div class="product-img">
                        <img src="{{ URL::asset('img/products' . '/' . $imagemPrincipal[$key]->im_produto)  }}" alt="">
                        <div class="product-quicview">
                            <a href="#" data-toggle="modal" data-target="#quickview"><i class="ti-plus"></i></a>
                        </div>
                    </div>

                    <!-- Descrição do Produto -->
                    <div class="product-description">
                        <h4 class="product-price">R$ {{ str_replace(".", ",", $produto->vl_produto) }}</h4>
                        <p>{{ $produto->nm_produto }}</p>
                        <!-- Add to Cart -->
                        <a href="#" class="add-to-cart-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbspCOMPRAR</a>
                    </div>
                    <!-- Imagens do Produto -->

                </div>

            @endforeach

            </div>

            <div class="d-flex justify-content-center">

                {{ $produtos->links("pagination::bootstrap-4") }}

            </div>

        </div>

    </section>--}}

    <section class="shop_grid_area section_padding_100">
        <div class="container">
            <div class="row">
                <!-- NavBar Lateral -->
                <div class="col-12 col-md-4 col-lg-3">
                    {{-- <div class="shop_sidebar_area">
                        <!-- Menu categorias lateral -->
                        <div class="widget catagory mb-50">
                            <!--  Side Nav  -->
                            <div class="nav-side-menu">
                                <h6 class="mb-0">Categorias</h6>
                                <div class="menu-list">
                                    <ul id="menu-content2" class="menu-content collapse out">
                                        <!-- Acessórios -->
                                        <li data-toggle="collapse" data-target="#women2">
                                            <a href="#">Acessórios</a>
                                            <ul class="sub-menu collapse show" id="women2">
                                                <li><a href="#">Bijuterias</a></li>
                                                <li><a href="#">Relógios</a></li>
                                                <li><a href="#">Música</a></li>
                                                <li><a href="#">TV e Áudio</a></li>
                                            </ul>
                                        </li>
                                        <!-- Informática -->
                                        <li data-toggle="collapse" data-target="#man2" class="collapsed">
                                            <a href="#">Informática</a>
                                            <ul class="sub-menu collapse" id="man2">
                                                <li><a href="#">Computadores</a></li>
                                                <li><a href="#">Acessórios</a></li>
                                                <li><a href="#">Games</a></li>
                                                <li><a href="#">Celular</a></li>
                                            </ul>
                                        </li>
                                        <!-- Beleza -->
                                        <li data-toggle="collapse" data-target="#kids2" class="collapsed">
                                            <a href="#">Beleza</a>
                                            <ul class="sub-menu collapse" id="kids2">
                                                <li><a href="#">Perfume</a></li>
                                                <li><a href="#">Maquiagem</a></li>
                                                <li><a href="#">Cabelos</a></li>
                                                <li><a href="#">Pele</a></li>
                                            </ul>
                                        </li>
                                        <!-- Moda -->
                                        <li data-toggle="collapse" data-target="#bags2" class="collapsed">
                                            <a href="#">Moda</a>
                                            <ul class="sub-menu collapse" id="bags2">
                                                <li><a href="#">Feminina</a></li>
                                                <li><a href="#">Masculina</a></li>
                                                <li><a href="#">Infantil</a></li>
                                                <li><a href="#">Esportiva</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Filtro de preço lateral -->
                        <div class="widget price mb-50">
                            <h6 class="widget-title mb-30">Filtro por preço</h6>
                            <div class="widget-desc">
                                <div class="slider-range">
                                    <div data-min="0" data-max="3000" data-unit="$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="0" data-value-max="1350" data-label-result="Price:">
                                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    </div>
                                    <div class="range-price">Preço: 0 - 1350</div>
                                </div>
                            </div>
                        </div>

                        <!-- Filtro de cor lateral -->
                        <div class="widget color mb-70">
                            <h6 class="widget-title mb-30">Filtro por cor</h6>
                            <div class="widget-desc">
                                <ul class="d-flex justify-content-between">
                                    <li class="gray"><a href="#"><span class="text-center"></span></a></li>
                                    &nbsp;&nbsp;
                                    <li class="red"><a href="#"><span class="text-center"></span></a></li>
                                    &nbsp;&nbsp;
                                    <li class="yellow"><a href="#"><span class="text-center"></span></a></li>
                                    &nbsp;&nbsp;
                                    <li class="green"><a href="#"><span class="text-center"></span></a></li>
                                    &nbsp;&nbsp;
                                    <li class="teal"><a href="#"><span class="text-center"></span></a></li>
                                    &nbsp;&nbsp;
                                    <li class="cyan"><a href="#"><span class="text-center"></span></a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Tamanhos lateral -->
                        <div class="widget size mb-50">
                            <h6 class="widget-title mb-30">Filtro por tamanho</h6>
                            <div class="widget-desc">
                                <ul class="d-flex justify-content-between">
                                    <li><a href="#">PP</a></li>
                                    <li><a href="#">P</a></li>
                                    <li><a href="#">M</a></li>
                                    <li><a href="#">G</a></li>
                                    <li><a href="#">GG</a></li>
                                    <li><a href="#">GGG</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Recomendados lateral -->
                        <div class="widget recommended">
                            <h6 class="widget-title mb-30">Recomendado</h6>

                            <div class="widget-desc">
                                <!-- Single Recommended Product -->
                                <div class="single-recommended-product d-flex mb-30">
                                    <div class="single-recommended-thumb mr-3">
                                        <img src="img/product-img/product-10.jpg" alt="">
                                    </div>
                                    <div class="single-recommended-desc">
                                        <h6>Men’s T-shirt</h6>
                                        <p>$ 39.99</p>
                                    </div>
                                </div>
                                <!-- Single Recommended Product -->
                                <div class="single-recommended-product d-flex mb-30">
                                    <div class="single-recommended-thumb mr-3">
                                        <img src="img/product-img/product-11.jpg" alt="">
                                    </div>
                                    <div class="single-recommended-desc">
                                        <h6>Blue mini top</h6>
                                        <p>$ 19.99</p>
                                    </div>
                                </div>
                                <!-- Single Recommended Product -->
                                <div class="single-recommended-product d-flex">
                                    <div class="single-recommended-thumb mr-3">
                                        <img src="img/product-img/product-12.jpg" alt="">
                                    </div>
                                    <div class="single-recommended-desc">

                                        <h6>Women’s T-shirt</h6>
                                        <p>$ 39.99</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <!-- Produtos e Contador páginas -->
                <div class="col-12 col-md-8 col-lg-12 d-flex justify-content-center">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="row karl-new-arrivals">

                                @if (count($produtoCatSubCat) == 0)

                                    <p>&nbsp;</p>
                                        <p class="h2">Não há produtos nessa categoria</p>
                                    <p>&nbsp;</p>
                                    
                                @else

                                    @foreach($produtoCatSubCat as $key => $produto)

                                        <div class="col-12 col-sm-6 col-lg-4 single_gallery_item wow fadeInUpBig" data-wow-delay="0.2s">
                                            <div class="product-img">
                                                <img src="{{ URL::asset('img/products' . '/' . $produto->im_produto)}}" alt="">
                                                <div class="product-quicview">
                                                    <a href="{{ route('products.details', $produto->nm_slug) }}"><i class="ti-plus"></i></a>
                                                </div>
                                            </div>

                                            <div class="product-description">
                                                <h4 class="product-price">R$ {{ str_replace(".", ",", $produto->vl_produto) }}</h4>
                                                <p>{{ $produto->nm_produto }}</p>
                                                <!-- Botão comprar -->

                                                <form action="{{ route('cart.buy') }}" method="post">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="cd_produto" value="{{ $produto->cd_produto }}">
                                                    <input type="hidden" name="nm_produto" value="{{ $produto->nm_produto }}">
                                                    <input type="hidden" name="ds_produto" value="{{ $produto->ds_produto }}">
                                                    <input type="hidden" name="vl_produto" value="{{ $produto->vl_produto }}">
                                                    <input type="hidden" name="qt_produto" value="{{ $produto->qt_produto }}">
                                                    <input type="hidden" name="sku_produto" value="{{ $produto->cd_nr_sku }}">
                                                    <input type="hidden" name="slug_produto" value="{{ $produto->nm_slug }}">
                                                    <input type="hidden" name="ds_altura" value="{{ $produto->ds_altura }}">
                                                    <input type="hidden" name="ds_largura" value="{{ $produto->ds_largura }}">
                                                    <input type="hidden" name="ds_comprimento" value="{{ $produto->ds_comprimento }}">
                                                    <input type="hidden" name="ds_peso" value="{{ $produto->ds_peso }}">
                                                    <input type="hidden" name="im_produto" value="{{ $produto->im_produto }}">

                                                    @if($produto->qt_produto < 5)
                                                        <p style="font-weight: 600; color: #d59431; padding-top: 10px">SEM ESTOQUE</p>
                                                    @else

                                                        <button type="submit" class="btn btn-link add-to-cart-btn" style="text-decoration: none;"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp; COMPRAR</button>

                                                    @endif

                                                </form>
                                            </div>
                                        </div>

                                    @endforeach
                                    
                                @endif



                            </div>

                            <div class="d-flex justify-content-center">

                                {{-- $produtoCatSubCat->links("pagination::bootstrap-4") --}}

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>

    <script>

        $('#quickview').on('show', function (e) {

            var link = e.relatedTarget(),
                $modal = $(this)

            console.log($modal);

        });

    </script>

@stop
