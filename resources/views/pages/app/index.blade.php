@extends('layouts.app.app')

@section('content')


    <style type='text/css'>
        /* Body for this page */
        body{margin:0 auto;}
        .nav {background:white;color:black;height:80px;padding:15px;}
        .nav, p {font-family: 'Open Sans';font-weight: 500;text-align: center;}

        /* Instagrid.css */
        instagrid-title, h2, p {text-align: center;font-family: 'Open Sans';}
        strong {font-weight:800;}

        /* Instagrid.css media queries */
        @media screen and (max-width : 480px) {
            #ody li{width:25%}
            #ody li:nth-child(1){width:50%}
        }
        #ody{width:100%;display:block;margin:0;padding:0;line-height:0}
        #ody img{height:100%;width:100%}
        #ody a{padding:0;margin:0;position:relative;display:inline-block}
        #ody li{width:16.66%;display:inline-block;position:relative;margin:0!important;padding:0px!important;float:left}
        #ody li:nth-child(1){width:33.33%}

        /*#ody li:nth-child(2) {
            width: 33.33%;
        }*/
        #ody .instagrid-z{width:100%;height:100%;margin-top:-100%;opacity:0;letter-spacing:1px;background:rgba(0,0,0,0.7);position:absolute;font:normal 600 12px Catamaran, sans-serif;color:#ffffff;line-height:normal}
        #ody a:hover .instagrid-z{opacity:1;zoom:1;filter:alpha(opacity=100)}
        .instagrids{display:table;vertical-align:middle;height:100%;width:100%}
        .instagrid-outter{display:table-cell;vertical-align:middle;height:100%;width:100%;text-align:center;}
        #instagridz.widget.insta h2.title{text-align:center;}
        #instagridz.widget.insta h2.title:before{content:&#39;&#39;;border-top:0px solid #efefef;left:0;right:0;position:absolute;top:50%}
        #instagridz.widget.insta h2.title p{display:inline-block;background:#000;padding:0 20px;position:relative}}
    </style>

    <script src="{{asset('js/app/instagram.js')}}"></script>

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
            <div class="single_slide height-800 bg-img background-overlay" style="background-image: url(img/app/bg-img/bg-4.jpg);">
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

    <!-- ****** Top Catagory Area Start ****** -->
    <section class="top_catagory_area d-md-flex clearfix">
        <!-- Single Catagory -->
        <div class="single_catagory_area d-flex align-items-center bg-img" style="background-image: url(img/app/bg-img/bg-2.jpg);">
            <div class="catagory-content">
                <h6>Acessórios</h6>
                <h2>Vendas 30%</h2>
                <a href="#" class="btn karl-btn">Compre Agora</a>
            </div>
        </div>
        <!-- Single Catagory -->
        <div class="single_catagory_area d-flex align-items-center bg-img" style="background-image: url(img/app/bg-img/bg-3.jpg);">
            <div class="catagory-content">
                <h6>Os melhores designer</h6>
                <h2>Moda Feminina</h2>
                <a href="#" class="btn karl-btn">Compre Agora</a>
            </div>
        </div>
    </section>
    <!-- ****** Top Catagory Area End ****** -->

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
                                        <img src="{{ asset('img/app/product-img/product-1.jpg') }}" alt="">
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
                                        <h5 class="price">R$120.99 <span>R$130</span></h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia expedita quibusdam aspernatur, sapiente consectetur accusantium perspiciatis praesentium eligendi, in fugiat?</p>
                                        <a href="#">Ver detalhes completos do produto</a>
                                </div>
                                    <!-- Add to Cart Form -->
                                    <form class="cart" method="post">
                                        <div class="quantity">
                                            <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </span>
                                            <input type="number" class="qty-text" id="qty" step="1" min="1" max="12" name="quantity" value="1">
                                            <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <button type="submit" name="addtocart" value="5" class="cart-submit">Add ao carrinho</button>
                                        <!-- Wishlist -->
                                        <div class="modal_pro_wishlist">
                                            <a href="#" target="_blank"><i class="ti-heart"></i></a>
                                        </div>
                                        <!-- Compare -->
                                        <div class="modal_pro_compare">
                                            <a href="#" target="_blank"><i class="ti-stats-up"></i></a>
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

    <!-- ****** New Arrivals Area Start ****** -->
    <section class="new_arrivals_area section_padding_100_0 clearfix">
        <div class="karl-projects-menu mb-100">
            <div class="text-center portfolio-menu">
                <button class="btn active" data-filter="*">Todos</button>
                <button class="btn" data-filter=".women">Mulher</button>
                <button class="btn" data-filter=".man">Homem</button>
                <button class="btn" data-filter=".access">Acessórios</button>
                <button class="btn" data-filter=".shoes">Sapatos</button>
                <button class="btn" data-filter=".kids">Kids</button>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_heading text-center">
                        <h2>NOVOS PRODUTOS</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row karl-new-arrivals">
                @foreach($produtos as $key => $produto)
                    <!-- Single gallery Item Start -->
                    <div class="col-12 col-sm-6 col-md-4 single_gallery_item women wow fadeInUpBig" data-wow-delay="0.2s">
                        <!-- Product Image -->
                        <div class="product-img">
                            <img src="{{ URL::asset('img/products' . '/' . $imagemPrincipal[$key]->im_produto)  }}" alt="">
                            <div class="product-quicview">
                                <a href="#" data-toggle="modal" data-target="#quickview"><i class="ti-plus"></i></a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div class="product-description">
                            <h4 class="product-price">R$ {{ str_replace(".", ",", $produto->vl_produto) }}</h4>
                            <p>{{ $produto->nm_produto }}</p>
                            <!-- Add to Cart -->
                            <a href="{{ url('/page/carrinho/' . $produto->cd_produto) }}" class="add-to-cart-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp COMPRAR</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ****** New Arrivals Area End ****** -->

    <!-- ****** Offer Area Start ****** -->
    <section class="offer_area height-700 section_padding_100 bg-img" style="background-image: url(img/app/bg-img/bg-5.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-end justify-content-end">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="offer-content-area wow fadeInUp" data-wow-delay="1s">
                        <h2>White t-shirt <span class="karl-level">Hot</span></h2>
                        <p>* Free shipping until 25 Dec 2017</p>
                        <div class="offer-product-price">
                            <h3><span class="regular-price">R$25.90</span> R$15.90</h3>
                        </div>
                        <a href="#" class="btn karl-btn mt-30">Compre Agora</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ****** Offer Area End ****** -->

    <!-- ****** Popular Brands Area Start ****** -->
    <section class="karl-testimonials-area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_heading text-center">
                        <h2>Instagram</h2>

                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">

                    <div id='ody'></div>
                </div>
            </div>
        </div>
    </section>

    <script type='text/javascript'>
       /* var feed=new ody({get:"user",
            limit:9,

            resolution:"standard_resolution",


            userId:4479769937,
            accessToken:"4479769937.d58614b.95ed9230bc564aedb27083af9c0875a4"
        });feed.run();*/

    </script>
    <!-- ****** Popular Brands Area End ****** -->

@stop
