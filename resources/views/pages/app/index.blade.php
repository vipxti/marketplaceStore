@extends('layouts.app.app')

@section('content')

    <style>
        .semestoque {
            width: 100%;
            margin: 0;
            font-size: 13px;
            font-weight: 700;
            color: #171717;
            text-decoration: none
        }

        .btncomprar {
            width:100%;
            margin: 0;
            font-size: 13px;
            font-weight: 700;
            color:#fff;
            background-color:#171717;
            text-decoration: none;
            border: none !important
        }

        .tamanhoimg {

            width: 255px;
            height: 255px;
            background-size: 100% 100%;
            -webkit-background-size: 100% 100%;
            -o-background-size: 100% 100%;
            -khtml-background-size: 100% 100%;
            -moz-background-size: 100% 100%;
        }

        .parcelas{
            color: #d59431 ;
        }
    </style>

    <link rel="stylesheet" href="{{asset('css/app/magnific.css')}}">

    <section class="hero hero-home no-padding">
        <div class="owl-carousel owl-theme hero-slider">
            <!-- Banner 1 -->
            <div style="background: url({{asset('img/app/bg-img/hero-bg.png')}}); max-height: 535px !important;" class="item has-pattern">
                <div class="container">
                    <div class="row" style="color: #fff">
                        <div class="col-lg-6">
                            <h1 style="color: #d59431;font-size: 2.0rem"></h1>
                            <ul class="lead">
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                            </ul>
                            <p>&nbsp;</p>
                           {{-- <a href="#" class="btn btn-template wide shop-now">Saiba Mais</a>--}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Banner 2 -->
            <div style="background: url({{asset('img/app/bg-img/hero-bg-2.png')}}); max-height: 535px !important;" class="item has-pattern">
                <div class="container">
                    <div class="row" style="color: #fff">
                        <div class="col-lg-6">
                            <h1 style="color: #d59431; font-size: 2.0rem"></h1>
                            <ul class="lead">
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                            </ul>
                            <p>&nbsp;</p>
                            {{--<a href="#" class="btn btn-template wide shop-now">Saiba Mais</a>--}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Banner 3 -->
            <div style="background: url({{asset('img/app/bg-img/hero-bg-3.png')}}); max-height: 535px !important;" class="item has-pattern">
                <div class="container">
                    <div class="row" style="color: #fff">
                        <div class="col-lg-6">
                            <h1 style="color: #d59431; font-size: 2.0rem"></h1>
                            <ul class="lead">
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                            </ul>
                            <p>&nbsp;</p>
                            {{--<a href="#" class="btn btn-template wide shop-now">Saiba Mais</a>--}}
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
                        <img src="{{asset('img/app/bg-img/novosprodutos.png')}}">
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row karl-new-arrivals text-center">
                @foreach($produtos as $key => $produto)
                    <div class="col-12 col-sm-4 col-md-3 single_gallery_item shoes wow fadeInUpBig">
                        <div class="product-img">
                            <img class="tamanhoimg" src="{{ URL::asset('img/products/' . $produto->im_produto) }}" alt="{{ $produto->nm_slug }}">
                            <div class="product-quicview">
                                <a href="{{ route('products.details', $produto->nm_slug)}}"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>

                        <div class="product-description">
                            <h4 style="color: #171717" class="product-price">R$ {{ str_replace(".", ",", $produto->vl_produto) }}</h4>
                            <p><b class="parcelas">3x</b> de <b class="parcelas">R$ {{number_format(($produto->vl_produto/3), 2)}}</b> sem juros </p>
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
    </section>

    <script src="{{asset('js/app/magnific.min.js')}}"></script>

@stop
