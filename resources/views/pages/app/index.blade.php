@extends('layouts.app.app')

@section('content')

    <style>
        .semestoque {
            width: 100%;
            margin: 0;
            font-size: 13px;
            font-weight: 700;
            color: #d59431;
            text-decoration: none
        }

        .btncomprar {
            width: 100%;
            margin: 0;
            font-size: 13px;
            font-weight: 700;
            color:#fff;
            background-color:#3a3a3a;
            text-decoration: none;
            border: none !important
        }

        .btnvariacao {
            width: 100% !important;
            height: 35px;
            padding-top: 7px;
            font-size: 13px;
            font-weight: 700 !important;
            color:#fff !important;
            background-color:#3a3a3a;
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
            color: #d59431;
        }

        .box span {
            position: absolute !important;
            top: 50% !important;
            left: 50% !important;
            transform: translate(-50%, -50%) !important;
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
                    <div class="col-12 col-sm-4 col-md-3 single_gallery_item shoes">
                        <div class="product-img">
                            <img class="tamanhoimg" src="{{ URL::asset('img/products/' . $produto->im_produto) }}" alt="{{ $produto->nm_slug }}">
                            <div class="product-quicview">
                                <a href="{{ route('products.details', $produto->nm_slug)}}"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>

                        <div class="product-description">
                            <h4 style="color: #dc3545" class="product-price">R$ {{ str_replace(".", ",", $produto->vl_produto) }}</h4>
                            <p><b class="parcelas">3x</b> de <b class="parcelas">R$ {{number_format(($produto->vl_produto/3), 2)}}</b> sem juros </p>
                            <p style="max-height: 20px; text-overflow: ellipsis">{{ $produto->nm_produto }}</p>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>

                            @if(array_key_exists($key, $arrayVariation))
                                @if($produto->qt_produto < 5)
                                    <p class="semestoque">SEM ESTOQUE</p>
                                @else
                                    <div>
                                        <a class="btnvariacao box" href="{{ route('products.details', $produto->nm_slug)}}"><i class="icon-bag" aria-hidden="true"></i>&nbsp; COMPRAR</a>
                                    </div>
                                @endif
                            @else
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
                                            <button type="submit" class="btn btncomprar box" style="overflow: hidden"><i class="icon-bag" aria-hidden="true"></i>&nbsp;COMPRAR</button>
                                        </div>
                                    @endif
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="categories">
        <div class="container">
            <header class="text-center">
                <h2 class="text-uppercase"><small>Produtos e Serviços</small></h2>
            </header>
            <div class="row text-left">
                <div class="col-lg-4"><a href="http://maktubbeauty.com.br/page/product/filter?search=Base+Liquida&id=pesquisa&catSubCat=Base+Liquida">
                        <div style="background-image: url(img/banner-1.png);" class="item d-flex align-items-end">
                            <div class="content">
                                <h3 class="h5">Base</h3><span>Coleções</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4"><a href="http://maktubbeauty.com.br/page/product/filter?id=s&catSubCat=53">
                        <div style="background-image: url(img/banner-2.png);" class="item d-flex align-items-end">
                            <div class="content">
                                <h3 class="h5">Paletas</h3><span>Novidades</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4"><a href="">
                        <div style="background-image: url(img/banner-3.png);" class="item d-flex align-items-end">
                            <div class="content">
                                <h3 class="h5">Queridinhos</h3><span>Parceiros</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script src="{{asset('js/app/magnific.min.js')}}"></script>

@stop
