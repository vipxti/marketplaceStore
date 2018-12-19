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

        #noty-holder{
            width: 100%;
            top: 0;
            font-weight: bold;
            z-index: 1031; /* Max Z-Index in Fixed Nav Menu is 1030*/
            text-align: center;
            position: fixed;
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
                                <div class="col-12 col-sm-4 col-md-3 single_gallery_item shoes">
                                    <div class="product-img">
                                        <img class="tamanhoimg" src="{{ URL::asset('img/products/' . $produto->im_produto) }}" alt="{{ $produto->nm_slug }}">
                                        <div class="product-quicview">
                                            <a href="{{ route('products.details', $produto->nm_slug)}}"><i class="fa fa-plus"></i></a>
                                            <p>&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                            @if(\Illuminate\Support\Facades\Auth::check())
                                                @if($wishlist[$key]->cd_cliente != Auth::user()->cd_cliente)
                                                    <a id="wishlist" href="javascript:void(0)" class="{{$produto->cd_nr_sku}}"><i class="fa fa-heart-o"></i></a>
                                                @else
                                                    <a id="wishlist" href="javascript:void(0)" class="{{$produto->cd_nr_sku}}"><i class="fa fa-heart"></i></a>
                                                @endif
                                            @else
                                                <a id="wishlist" href="javascript:void(0)" class="{{$produto->cd_nr_sku}}"><i class="fa fa-heart-o"></i></a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="product-description">
                                        <h4 style="color: #dc3545" class="product-price">R$ {{ str_replace(".", ",", $produto->vl_produto) }}</h4>
                                        <p><b class="parcelas">3x</b> de <b class="parcelas">R$ {{number_format(($produto->vl_produto/3), 2)}}</b> sem juros </p>
                                        <p style="max-height: 20px; text-overflow: ellipsis">{{ $produto->nm_produto }}</p>
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>

                                        @if ($variation[$key]->nm_produto_variacao != null && $variation[$key]->cd_produto == $produto->cd_produto)

                                            @if($produto->qt_produto <= 0)
                                                <p class="semestoque">SEM ESTOQUE</p>
                                            @else
                                                <div>
                                                    <a class="btnvariacao box" href="{{ route('products.details', $produto->nm_slug)}}"><i class="icon-bag" aria-hidden="true"></i>&nbsp; COMPRAR</a>
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
                                                @if($produto->qt_produto <= 0)
                                                    <div>
                                                        <p class="btn semestoque">SEM ESTOQUE</p>
                                                    </div>
                                                @else
                                                    <div class="text-center">
                                                        <button id="btn_comprar_produto" type="submit" class="btn btncomprar box" style="overflow: hidden"><i class="icon-bag" aria-hidden="true"></i>&nbsp;COMPRAR</button>
                                                    </div>
                                                @endif
                                            </form>

                                        @endif

                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>

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

    <script>
        $(function(){
           $('button#btn_comprar_produto').click(function(){
               let id = $(this).parent().parent().find("input[name='sku_produto']").val();
               let preco = $(this).parent().parent().find("input[name='vl_produto']").val();

               fbq('track', 'AddToCart', {
                   value: preco,
                   currency: 'BRL',
                   content_ids: id,
               });

           });

            function createNoty(message, type) {
                var html = '<div class="aleatorio alert alert-' + type + ' alert-dismissable page-alert col-md-3 offset-md-9">';
                html += '<button type="button" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>';
                html += message;
                html += '</div>';
                $(html).hide().prependTo('#noty-holder').slideDown();
            };

           let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
           $('a#wishlist').click(function(){
                let sku = $(this).prop('class');
                let a = $(this);

                @if(Auth::check())
                    $.ajax({
                        url: '{{route('save.product.wishlist')}}',
                        type: 'post',
                        data: {_token: CSRF_TOKEN, fk_id_sku: sku},
                        success: function(data){
                            if(data.deuErro == false){

                                if(a.find('i').hasClass('fa-heart-o')) {
                                    a.find('i').removeClass('fa-heart-o').addClass('fa-heart');

                                    createNoty('Adicionado na Lista de Desejos!', 'success');

                                    $('.aleatorio').fadeOut(2000, function(){
                                        $(this).remove();
                                    });
                                }
                                else {
                                    a.find('i').removeClass('fa-heart').addClass('fa-heart-o');

                                    createNoty('Removido da Lista de Desejos!', 'warning');

                                    $('.aleatorio').fadeOut(2000, function(){
                                        $(this).remove();
                                    });
                                }

                            }
                            else{
                                createNoty('Erro ao adicionar na Lista de Desejos.', 'danger');

                                $('.aleatorio').fadeOut(2000, function(){
                                    $(this).remove();
                                });

                            }
                        }
                    });
                @else
                   createNoty('Usuário precisa estar logado.', 'warning');

                   $('.aleatorio').fadeOut(2000, function(){
                       $(this).remove();
                   });
                @endif



           });
        });
    </script>

@stop
