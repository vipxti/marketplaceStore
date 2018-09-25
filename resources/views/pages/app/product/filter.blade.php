@extends('layouts.app.app')

@section('content')

    <style>
        .parcelas{
            color: #ce1312;
        }
    </style>

        <section class="shop_grid_area section_padding_100">
        <div class="container">
            <div class="row">
                <!-- Produtos e Contador páginas -->
                <div class="col-12 col-md-8 col-lg-12 d-flex justify-content-center">
                    <div class="row">
                        <div class="row karl-new-arrivals text-center">
                            @if (count($produtoCatSubCat) == 0)
                                <h5 style="text-align: center !important; margin: 60px 0 60px 0 !important;">NÃO HÁ PRODUTOS NESSA CATEGORIA</h5>
                            @else
                                @foreach($produtoCatSubCat as $key => $produto)

                                    <div class="col-12 col-sm-4 col-md-3 single_gallery_item">
                                        <div class="product-img img-fluid mx-auto d-block" >
                                            <img class="w-100 mx-auto d-block" style="width: 285px !important; height: 375px !important;" src="{{ URL::asset('img/products' . '/' . $produto->im_produto)}}" alt="">
                                            <div class="product-quicview">
                                                <a href="{{ route('products.details', $produto->nm_slug) }}"><i class="ti-plus"></i></a>
                                            </div>
                                        </div>

                                        <div class="product-description" style="padding: 0 5%">
                                            <h4 class="product-price">R$ {{ str_replace(".", ",", $produto->vl_produto) }}</h4>
                                            <p><b class="parcelas">3x</b> de <b class="parcelas">R$ {{number_format(($produto->vl_produto/3), 2)}}</b> sem juros </p>
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
                                                    <p class="btn" style="width:100%; margin: 0; font-size: 13px; font-weight: 700; color:#3a3a3a; background-color:#f5f5f5; text-decoration: none;">SEM ESTOQUE</p>
                                                @else
                                                    <button type="submit" class="btn" style=" width:100%; margin: 0; font-size: 13px; font-weight: 700; color:#3a3a3a; background-color:#f5f5f5; text-decoration: none; border: none !important;"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp; COMPRAR</button>
                                                @endif
                                            </form>
                                        </div>
                                    </div>

                                @endforeach
                            @endif
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
