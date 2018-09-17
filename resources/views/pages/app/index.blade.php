@extends('layouts.app.app')

@section('content')

    <style>
        .semestoque {
            width: 100%;
            margin: 0;
            font-size: 13px;
            font-weight: 700;
            color: #3a3a3a;
            background-color: #f5f5f5;
            text-decoration: none
        }

        .btncomprar {
            width:100%;
            margin: 0;
            font-size: 13px;
            font-weight: 700;
            color:#3a3a3a;
            background-color:#f5f5f5;
            text-decoration: none;
            border: none !important
        }

    </style>

    <link rel="stylesheet" href="{{asset('css/app/magnific.css')}}">

    <!-- Banner Principal-->
    <section class="hero hero-home no-padding">
        <div class="owl-carousel owl-theme hero-slider">
            <!-- Banner 1 -->
            <div style="background: url({{asset('img/app/bg-img/hero-bg.png')}});" class="item d-flex align-items-center has-pattern">
                <div class="container">
                    <div class="row" style="color: #fff">
                        <div class="col-lg-6">
                            <h1 style="color: #d59431;font-size: 2.0rem">Make Up</h1>
                            <ul class="lead">
                                <li><strong>Vult</strong></li>
                                <li><strong>Pó</strong> Compacto</li>
                                <li><strong>R$ 21,99</strong> Imperdível</li>
                            </ul>
                            <a href="#" class="btn btn-template wide shop-now">Saiba Mais</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Banner 2 -->
            <div style="background: url({{asset('img/app/bg-img/hero-bg-2.png')}});" class="item d-flex align-items-center has-pattern">
                <div class="container">
                    <div class="row" style="color: #fff">
                        <div class="col-lg-6">
                            <h1 style="color: #d59431; font-size: 2.0rem">Feminices</h1>
                            <ul class="lead">
                                <li><strong>Bruna</strong> Tavares</li>
                                <li><strong>Base</strong> Cremosa</li>
                                <li><strong>R$ 34,99</strong> Imperdível</li>
                            </ul>
                            <a href="#" class="btn btn-template wide shop-now">Saiba Mais</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Banner 3 -->
            <div style="background: url({{asset('img/app/bg-img/hero-bg-3.png')}});" class="item d-flex align-items-center has-pattern">
                <div class="container">
                    <div class="row" style="color: #fff">
                        <div class="col-lg-6">
                            <h1 style="color: #d59431; font-size: 2.0rem">Inspiration</h1>
                            <ul class="lead">
                                <li><strong>Ruby</strong> Rose</li>
                                <li><strong>Paleta de</strong> Sombra</li>
                                <li><strong>R$ 109,99</strong> Imperdível</li>
                            </ul>
                            <a href="#" class="btn btn-template wide shop-now">Saiba Mais</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="new_arrivals_area section_padding_100_0 clearfix">
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
            <div class="row karl-new-arrivals text-center">
                @foreach($produtos as $key => $produto)
                    <div class="col-12 col-sm-4 col-md-3 single_gallery_item shoes wow fadeInUpBig">
                        <div class="product-img">
                            <img src="{{ URL::asset('img/products/' . $produto->im_produto) }}" alt="{{ $produto->nm_slug }}">
                            <div class="product-quicview">
                                <a href="{{ route('products.details', $produto->nm_slug)}}"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>

                        <div class="product-description">
                            <h4 style="color: #d59431" class="product-price">R$ {{ str_replace(".", ",", $produto->vl_produto) }}</h4>
                            <p style="max-height: 20px; text-overflow: ellipsis">{{ $produto->nm_produto }}</p>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>


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
                                    <div>
                                        <p class="btn semestoque">SEM ESTOQUE</p>
                                    </div>
                                @else
                                    <div>
                                        <button type="submit" class="btn btncomprar" style="overflow: hidden"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;COMPRAR</button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
       {{-- <div class="container">
            <div class="row text-center">
                @foreach($produtos as $key => $produto)

                    <div class="col-12 col-md-3 single_gallery_item">

                        <div class="product-img" style="width: 245px !important; height: 265px !important;">
                            <img src="{{ URL::asset('img/products/' . $produto->im_produto) }}" alt="{{ $produto->nm_slug }}">
                            <div class="product-quicview">
                                <a href="{{ route('products.details', $produto->nm_slug)}}"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>


                        <div class="product-description">
                            <h4 class="product-price">R$ {{ str_replace(".", ",", $produto->vl_produto) }}</h4>
                            <p>{{ $produto->nm_produto }}</p>


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
                                    <div>
                                        <p class="btn semestoque">SEM ESTOQUE</p>
                                    </div>
                                @else
                                    <div>
                                        <button type="submit" class="btn btncomprar"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;COMPRAR</button>
                                    </div>
                                @endif
                            </form> 
                        </div>
                    </div>
                @endforeach
            </div>
        </div>--}}
    </section>



    <section class="offer_area height-700 section_padding_100 bg-img" style="background-image: url({{asset('img/app/bg-img/bg-5.png')}});">
        <div class="container h-100">
            <div class="row h-100 align-items-end justify-content-end">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="offer-content-area wow fadeInUp" data-wow-delay="1s">
                        <h2>Oferta Especial <span class="karl-level">Hot</span></h2>
                        <p>Catharine Hill Sombras Variadas 1017 - Paleta De Sombras Com 30 Cores Diferentes De Acabamentos Opacos E Cintilantes.</p>
                        <div class="offer-product-price">
                            <h3><span class="regular-price">R$126,99</span> R$106,99</h3>
                        </div>
                        <a href="{{ route('products.details', 'catharine-hill-paleta-de-sombras-variadas-30-cores') }}" target="_blank" class="btn btn-template wide shop-now">Comprar Agora</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{asset('js/app/magnific.min.js')}}"></script>

@stop
