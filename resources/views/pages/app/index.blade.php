@extends('layouts.app.app')

@section('content')

    <link rel="stylesheet" href="{{asset('css/app/estiloInstagram.css')}}">
    <link rel="stylesheet" href="{{asset('css/app/magnific.css')}}">

    <!-- ****** Top Catagory Area Start ****** -->
    <section class="top_catagory_area d-md-flex clearfix">
        <!-- Single Catagory -->
        <div class="single_catagory_area d-flex align-items-center bg-img" style="background-image: url(img/app/bg-img/bg-2.jpg);">
            <div class="catagory-content">
                <h6>Os melhores preços e acessórios</h6>
                <h2>Sapatos 30%</h2>
                <a href="#" class="btn karl-btn">Compre Agora</a>
            </div>
        </div>
        <!-- Single Catagory -->
        <div class="single_catagory_area d-flex align-items-center bg-img" style="background-image: url(img/app/bg-img/bg-3.png);">
            <div class="catagory-content">
                <h6>Os melhores produtos e maquiagens</h6>
                <h2>Novidades Beleza </h2>
                <a href="#" class="btn karl-btn">Compre Agora</a>
            </div>
        </div>
    </section>
    <!-- ****** Top Catagory Area End ****** -->

    <!-- ****** New Arrivals Area Start ****** -->
    <section class="new_arrivals_area section_padding_100_0 clearfix">
        {{-- <div class="karl-projects-menu mb-50">
            <div class="text-center portfolio-menu">
                <button class="btn active" data-filter="*">Todos</button>
                <button class="btn" data-filter=".women">Mulher</button>
                <button class="btn" data-filter=".man">Homem</button>
                <button class="btn" data-filter=".access">Acessórios</button>
                <button class="btn" data-filter=".shoes">Sapatos</button>
                <button class="btn" data-filter=".kids">Kids</button>
            </div>
        </div> --}}
        <p>&nbsp;</p>
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
                    <div class="col-12 col-sm-6 col-md-4 single_gallery_item women wow fadeInUpBig" data-wow-delay="0.2s" style="margin-bottom: 13% !important;">
                        <!-- Product Image -->
                        <div class="product-img">
                            <img src="{{ URL::asset('img/products/' . $produto->im_produto) }}" alt="{{ $produto->nm_slug }}">
                            <div class="product-quicview">
                                <a href="{{ route('products.details', $produto->nm_slug)}}"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div class="product-description">
                            <h4 class="product-price">R$ {{ str_replace(".", ",", $produto->vl_produto) }}</h4>
                            <p>{{ $produto->nm_produto }}</p>
                            <!-- Add to Cart -->
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

                                    <br>
                                    <p>SEM ESTOQUE</p>

                                @else

                                    <button type="submit" class="btn btn-link add-to-cart-btn" style="text-decoration: none; padding: 0"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp; COMPRAR</button>

                                @endif

                                
                                {{-- <a href="{{ route('cart.buy') }}" class="add-to-cart-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp; COMPRAR</a> --}}
                            </form> 
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ****** New Arrivals Area End ****** -->

    <!-- ****** Offer Area Start ****** -->
    <section class="offer_area height-700 section_padding_100 bg-img" style="background-image: url(img/app/bg-img/bg-5.png);">
        <div class="container h-100">
            <div class="row h-100 align-items-end justify-content-end">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="offer-content-area wow fadeInUp" data-wow-delay="1s">
                        <h2>Oferta Especial <span class="karl-level">Hot</span></h2>
                        <p>Catharine Hill Sombras Variadas 1017 - Paleta De Sombras Com 30 Cores Diferentes De Acabamentos Opacos E Cintilantes.</p>
                        <div class="offer-product-price">
                            <h3><span class="regular-price">R$126,99</span> R$106,00</h3>
                        </div>
                        <a href="{{ route('products.details', 'catharine-hill-paleta-de-sombras-variadas-30-cores') }}" target="_blank"  class="btn karl-btn mt-30">Compre Agora</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{asset('js/app/magnific.min.js')}}"></script>

@stop
