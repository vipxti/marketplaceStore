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

    <section class="section_padding_100">
        <div class="container">
            <div class="row">
                <!-- Produtos e Contador páginas -->

                <div class="col-md-12 d-flex justify-content-center">
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
                                            @if ($variation[$key]->cd_produto != null)
                                                @if($produto->qt_produto < 5)
                                                    <p style="font-weight: 600; color: #d59431; padding-top: 10px">SEM ESTOQUE</p>
                                                @else
                                                    <div class="col-12 col-md-12">
                                                        <a class="btn" href="{{ route('products.details', $produto->nm_slug) }}" style="width:100%; margin: 0; font-size: 13px; font-weight: 700; color:#3a3a3a; background-color:#f5f5f5; text-decoration: none;"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp; COMPRAR</a>
                                                    </div>
                                                @endif
                                            @else
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
                                                        <div>
                                                            <p class="btn semestoque">SEM ESTOQUE</p>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <button type="submit" class="btn btncomprar" style="overflow: hidden"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;COMPRAR</button>
                                                        </div>
                                                    @endif
                                                </form>

                                            @endif

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <p>&nbsp;</p><p>&nbsp;</p>

                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <div class="shop_pagination_area wow">
                                    <nav aria-label="Page navigation">
                                        {{ $produtos->links() }}
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
