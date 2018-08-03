@extends('layouts.app.app')

@section('content')

    <section class="shop_grid_area section_padding_100">
        <div class="container">
            <div class="row">
                <!-- Produtos e Contador páginas -->
                <div class="col-12 col-md-12 col-lg-12 justify-content-center">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="row karl-new-arrivals d-flex">
                                @foreach($produtos as $key => $produto)
                                    <div class="col-12 col-sm-4 col-md-3 single_gallery_item pull-left">
                                        <div class="product-img" style="width: 275px !important; height: 395px !important;">
                                            <img src="{{ URL::asset('img/products' . '/' . $produto->im_produto) }}" alt="{{ $produto->nm_slug }}">
                                            <div class="product-quicview">
                                                <a href="{{ route('products.details', $produto->nm_slug) }}"><i class="ti-plus"></i></a>
                                            </div>
                                        </div>

                                        <div class="product-description text-center">
                                            <h4 class="product-price">R$ {{ str_replace(".", ",", $produto->vl_produto) }}</h4>
                                            <p>{{ $produto->nm_produto }}</p>

                                            @if ($variation[$key]->cd_produto != null)

                                                @if($produto->qt_produto < 5)
                                                    <p style="font-weight: 600; color: #d59431; padding-top: 10px">SEM ESTOQUE</p>
                                                @else
                                                    <div class="col-12 col-md-12 d-flex justify-content-center">
                                                        <a class="btn btn-link add-to-cart-btn" href="{{ route('products.details', $produto->nm_slug) }}" style="text-decoration: none; padding: 0"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp; COMPRAR</a>
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
                                                        <p style="font-weight: 600; color: #d59431; padding-top: 10px">SEM ESTOQUE</p>
                                                    @else
                                                        <div class="col-12 col-md-12 d-flex justify-content-center">
                                                            <button type="submit" class="btn btn-link add-to-cart-btn" style="text-decoration: none; padding: 0"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp; COMPRAR</button>
                                                        </div>
                                                    @endif
                                                </form>

                                            @endif

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <p>&nbsp;</p><p>&nbsp;</p>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12 d-flex justify-content-center">
                                <div class="shop_pagination_area wow fadeInUp" data-wow-delay="1.1s">
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
