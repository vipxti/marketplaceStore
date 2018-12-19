@extends('layouts.app.app')

@section('content')

    <style>
        .quebra {
            font-family: 'Open Sans', sans-serif;
            font-weight: 400;
            overflow-x: auto;
            white-space: -moz-pre-wrap;
            white-space: -o-pre-wrap;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .btnmaisemenos{
            border: none;
            width: 100px;
            padding: 0px 0px 0px 30px;
        }

        .preco{
            color: #dc3545;
        }

        .estrela {
            color: #ff9800;
            border-color: #ff9d21;
        }

        .fonte {
            font-size: 30px;
        }

        .fundo-comentario {
            background-color: #f5f5f5;
            border: 1px solid #e3e3e3;
            border-radius: 6px;
            padding-top: 5px;
            margin: 10px;
        }

        .cartao {
            border: 1px solid rgba(0,0,0,.125);
        }

        .cabecalho {
            border-bottom: 1px solid rgba(0,0,0,.125);
            background-color: #a9a9a9;
        }

        .titulo {
            color: #fff;
            width: 100%;
        }

        .corpo {
            background-color: rgba(0,0,0,.03);
        }

    </style>
    <script>
        fbq('track', 'ViewContent', {
            value: '{{$product[0]['vl_produto']}}',
            currency: 'BRL',
            content_ids: '{{$product[0]['cd_nr_sku']}}',
        });
    </script>
    <!-- Ignite UI Required Combined CSS Files -->
    <link href="http://cdn-na.infragistics.com/igniteui/2018.2/latest/css/themes/infragistics/infragistics.theme.css" rel="stylesheet" />
    <link href="http://cdn-na.infragistics.com/igniteui/2018.2/latest/css/structure/infragistics.css" rel="stylesheet" />
    <!-- Ignite UI Required Combined JavaScript Files -->
    <script src="http://cdn-na.infragistics.com/igniteui/2018.2/latest/js/infragistics.core.js"></script>
    <script src="http://cdn-na.infragistics.com/igniteui/2018.2/latest/js/infragistics.dv.js"></script>


    <!-- Nav bar do produto -->
    <div class="breadcumb_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb d-flex align-items-center">
                        <li class="breadcrumb-item"><a href="{{ route('products.page') }}">Início</a></li>

                        <li class="breadcrumb-item active">{{ $product[0]['nm_produto'] }}</li>

                    </ol>
                    <!-- btn -->
                    <a href="{{ route('products.page') }}" class="backToHome d-block"><i class="fa fa-angle-double-left"></i> Voltar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Produto e detalhes -->
    <section class="single_product_details_area section_padding_0_100">

        <div class="container">

            <div class="row">

                <div class="col-12 col-md-6">
                    <div class="single_product_thumb">
                        <div id="product_details_slider" class="carousel slide" data-ride="carousel">

                            <ol class="carousel-indicators">

                                <li class="active" id="thumb1Carrossel" data-target="#product_details_slider" data-slide-to="0" style="{{ 'background-image: url(' . URL::asset('img/products/' . $images[0]['im_produto']) . ');' }}">
                                </li>

                                @if(count($images) > 1)

                                    @foreach($images as $key => $image)

                                        @if($key > 0)

                                            <li id="{{ 'thumb' . ($key + 1) . 'Carrossel' }}" data-target="#product_details_slider" data-slide-to="{{ $key }}" style="{{ 'background-image: url(' . URL::asset('img/products/' . $image['im_produto']) . ');' }}">
                                            </li>

                                        @endif

                                    @endforeach

                                @endif

                            </ol>

                            <div class="carousel-inner">

                                <div class="carousel-item active">
                                    <img id="fotoGrande1" class="d-block w-100" src="{{ URL::asset('img/products/' . $images[0]['im_produto']) }}" alt="First slide" style="width: 1000px; heigth: 1444px;">
                                </div>

                                @if(count($images) > 1)

                                    @foreach($images as $key => $image)

                                        @if($key > 0)

                                            <div class="carousel-item">
                                                <a class="gallery_img" href="{{ URL::asset('img/products/' . $image['im_produto']) }}">
                                                    <img id="{{ 'fotoGrande' . ($key + 1) }}" class="d-block" src="{{ URL::asset('img/products/' . $image['im_produto']) }}" alt="slide" style="width: 1000px; heigth: 1444px;">
                                                </a>
                                            </div>

                                        @endif

                                    @endforeach

                                @endif

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">

                    <div class="single_product_desc">

                        <h4 id="nomeProduto" class="title">{{ $product[0]['nm_produto'] }}</h4>

                        @if ($isVariation)

                            <h4 id="precoProduto" class="price preco">R$ {{ number_format($variations[0]['vl_produto_variacao'], 2, ',', '.') }}</h4>

                        @else

                            <h4 id="precoProduto" class="price preco">R$ {{ number_format($product[0]['vl_produto'], 2, ',', '.') }}</h4>

                        @endif

                        @if ($isVariation)

                            @if($variations[0]['qt_produto_variacao'] > 0)

                                <p class="available">Disponibilidade: <span class="disponivel" class="text-muted">Em estoque</span></p>

                            @else

                                <p class="available">Disponibilidade: <span class="disponivel" class="text-muted">Não disponível</span></p>

                            @endif

                        @else

                            @if($product[0]['qt_produto'] > 0)

                                <p class="available">Disponibilidade: <span class="disponivel" class="text-muted">Em estoque</span></p>

                            @else

                                <p class="available">Disponibilidade: <span class="disponivel" class="text-muted">Não disponível</span></p>

                            @endif

                        @endif


                        <div>
                            <p class="available"><span id="qtd_vendas_prod">{{$vendas}}</span>&nbsp;vendas</p>
                        </div>

                        <div id="div_estrela_avaliacao" class="single_product_ratings mb-15">
                            <a id="estrela_avaliacao"
                               href="javascript:void(0)"
                               title="Avaliar Produto"
                               data-toggle="modal"
                               data-target="#modal-default">
                                @switch(round($media))
                                    @case(0)
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @break
                                    @case(1)
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @break
                                    @case(2)
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @break
                                    @case(3)
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @break
                                    @case(4)
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @break
                                    @case(5)
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    @break
                                @endswitch
                                <strong style="font-size: 12px;">{{'('. count($comentarios) . ' AVALIAÇÕES)'}}</strong>
                            </a>

                        </div>

                        <p>&nbsp;</p>

                        @if ($hasVariation)

                            @if ($totalCores > 0)

                                <div class="widget color mb-50">
                                    <h6 class="widget-title">Cor</h6>

                                    <div class="widget-desc">

                                        <ul class="d-flex justify-content-between">

                                            @foreach ($codProds as $c)

                                                <input type="hidden" name="cod[]" value="{{ $c }}">

                                            @endforeach

                                            @foreach ($colors as $key => $color)

                                                <li>

                                                    <a href="javascript:void(0)" id="{{ $color->cd_cor }}" name="btn_color[]" style="background-color: {{ $color->hex }};"></a>

                                                </li>&nbsp;&nbsp;

                                            @endforeach

                                        </ul>

                                    </div>

                                </div>

                            @endif

                            @if($sizeType == 'N' || $sizeType == 'L')
                                <div id="tamanhos" class="widget size mb-50">
                            @else
                                <div id="tamanhos" hidden class="widget size mb-50">
                            @endif

                                <h6 class="widget-title">Tamanho</h6>

                                <div class="widget-desc">

                                    <ul class="listaDeTamanhos">

                                        @if ($sizeType == 'N')

                                            @foreach ($sizes as $size)

                                                <li class="{{ $size['cd_nr_sku'] }}">

                                                    <a id="{{ $size['cd_nr_sku'] }}" name="sizes[]" href="javascript:void(0);">{{ $size['nm_tamanho_num'] }}</a>

                                                </li>&nbsp;&nbsp;

                                            @endforeach

                                        @endif

                                        @if ($sizeType == 'L')

                                            @foreach ($sizes as $size)

                                                <li class="{{ $size['cd_nr_sku'] }}">

                                                    <a id="{{ $size['cd_nr_sku'] }}" name="sizes[]" href="javascript:void(0);">{{ $size['nm_tamanho_letra'] }}</a>

                                                </li>&nbsp;&nbsp;

                                            @endforeach

                                        @endif

                                    </ul>

                                </div>

                            </div>

                        @endif

                        <p>&nbsp;</p>

                        @if ($isVariation)

                            @if($variations[0]['qt_produto_variacao'] <= 0)

                                <p id="pSemEstoque">SEM ESTOQUE</p>
                                <div id="divFormProduto" hidden>

                            @else
                                <p id="pSemEstoque" hidden>SEM ESTOQUE</p>
                                <div id="divFormProduto">
                            @endif
                                    <form action="{{ route('cart.buy') }}" class="cart clearfix mb-50 d-flex" method="post">
                                        {{ csrf_field() }}

                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div class="quantity">
                                            <span class="qty-minus" style="pointer-events: none; padding-top: 10px">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </span>
                                        </div>

                                        <input type="number" class="btnmaisemenos" id="qty" step="1" min="1" max="1" name="quantity" value="1" disabled>

                                        <div class="quantity">
                                            <span class="qty-plus " style="pointer-events: none; padding-top: 10px">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </span>
                                        </div>

                                        <input type="hidden" name="cd_produto" value="">
                                        <input type="hidden" name="nm_produto" value="">
                                        <input type="hidden" name="ds_produto" value="">
                                        <input type="hidden" name="vl_produto" value="">
                                        <input type="hidden" id="qtdDetalhes" name="qt_produto_detalhes" value="">
                                        <input type="hidden" name="qt_produto" value="">
                                        <input type="hidden" name="sku_produto" value="">
                                        <input type="hidden" name="slug_produto" value="">
                                        <input type="hidden" name="ds_altura" value="">
                                        <input type="hidden" name="ds_largura" value="">
                                        <input type="hidden" name="ds_comprimento" value="">
                                        <input type="hidden" name="ds_peso" value="">
                                        <input type="hidden" name="im_produto" value="">

                                        <button type="submit" id="btnComprar" class="btn btn-template d-block" style="width: 125px; height: 40px" disabled>Comprar</button>

                                    </form>
                                </div>



                        @else

                            @if($product[0]['qt_produto'] <= 0)

                                <p>SEM ESTOQUE</p>

                            @else

                                <form action="{{ route('cart.buy') }}" class="cart clearfix mb-50 d-flex" method="post">
                                    {{ csrf_field() }}


                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="quantity">
                                        <span class="qty-minus" style="padding-top: 10px">
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </span>
                                    </div>

                                    <input type="number" class="btnmaisemenos" id="qty" step="1" min="1" max="12" name="quantity" value="1" disabled>
                                    <div class="quantity">
                                        <span class="qty-plus" style="padding-top: 10px">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </span>
                                    </div>

                                    <input type="hidden" name="cd_produto" value="{{ $product[0]['cd_produto'] }}">
                                    <input type="hidden" name="nm_produto" value="{{ $product[0]['nm_produto'] }}">
                                    <input type="hidden" name="ds_produto" value="{{ $product[0]['ds_produto'] }}">
                                    <input type="hidden" name="vl_produto" value="{{ $product[0]['vl_produto'] }}">
                                    <input type="hidden" id="qtdDetalhes" name="qt_produto_detalhes" value="1">
                                    <input id="qtProdEstoque" type="hidden" name="qt_produto" value="{{ $product[0]['qt_produto'] }}">
                                    <input type="hidden" name="sku_produto" value="{{ $product[0]['cd_nr_sku'] }}">
                                    <input type="hidden" name="slug_produto" value="{{ $product[0]['nm_slug'] }}">
                                    <input type="hidden" name="ds_altura" value="{{ $product[0]['ds_altura'] }}">
                                    <input type="hidden" name="ds_largura" value="{{ $product[0]['ds_largura'] }}">
                                    <input type="hidden" name="ds_comprimento" value="{{ $product[0]['ds_comprimento'] }}">
                                    <input type="hidden" name="ds_peso" value="{{ $product[0]['ds_peso'] }}">
                                    <input type="hidden" name="im_produto" value="{{ $images[0]['im_produto'] }}">

                                    <button type="submit" id="btnComprar" class="btn btn-template d-block" style="width: 125px; height: 40px">Comprar</button>

                                </form>

                            @endif

                        @endif

                    </div>

                </div>

            </div>

            <p>&nbsp;</p>

            <!--Informações do produto -->
            <div class="row">
                <div class="col-md-12">
                <div id="accordion" role="tablist">
                    <div class="card cartao">
                        <div class="card-header cabecalho" role="tab" id="headingOne">
                            <h6>
                                <a class="titulo" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Informação do produto</a>
                            </h6>
                        </div>

                        @if ($isVariation)

                            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body corpo">
                                    <pre class="infoProduto quebra">{{ $variations[0]['ds_produto_variacao'] }}</pre>
                                </div>
                            </div>

                        @else

                            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body corpo">
                                    <pre class="infoProduto quebra">{{ $product[0]['ds_produto'] }}</pre>
                                </div>
                            </div>

                        @endif

                    </div>

                    <div class="card cartao">
                        <div id="headingComentarios" class="card-header cabecalho" role="tab">
                            <h6>
                                <a class="titulo" data-toggle="collapse" href="#collapseComentarios" aria-expanded="true" aria-controls="collapseComentarios">
                                    Comentários
                                </a>
                            </h6>
                        </div>
                        <div id="collapseComentarios" class="collapse" role="tabpanel" aria-labelledby="headingComentarios" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">

                                    <!-- Target element for the igDoughnutChart -->
                                    <div class="col-md-1">
                                        <div id="chart2"></div>
                                    </div>
                                    <div class="col-md-4 align-self-center" style="padding-left: 45px;">
                                        <p>{{$recomendacao}}% das pessoas recomendam esse produto</p>
                                    </div>
                                    <div class="col-md-4 single_product_ratings justify-content-center" style="padding-left: 25px; padding-top: 20px;">
                                        <strong style="font-size: 30px;">{{number_format($media, 1)}}</strong>
                                        @switch(round($media))
                                            @case(0)
                                            <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                            @break
                                            @case(1)
                                            <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                            @break
                                            @case(2)
                                            <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                            @break
                                            @case(3)
                                            <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                            @break
                                            @case(4)
                                            <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                            @break
                                            @case(5)
                                            <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                            <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                            @break
                                        @endswitch
                                        <small>{{'(' . count($comentarios) . ')'}}</small>
                                    </div>
                                    <div class="col-md-3 justify-content-center" style="padding-left: 60px; padding-top: 23px;">
                                        <button type="button" class="btn btn-primary"
                                                data-dismiss="modal"
                                                data-toggle="modal"
                                                data-target="#modal-comentario">Avaliar</button>
                                    </div>

                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col mb-15">
                                        <h5 class="title"><small class="pull-right">{{count($comentarios)}} Comentários</small>Comentários</h5>
                                    </div>
                                </div>
                                <div class="row">

                                    @foreach($comentarios as $c)
                                        <div class="col-md-12">
                                            <div class="fundo-comentario">
                                                <div class="col-md-12 mt-2">
                                                    <p><b>{{$c->nm_cliente . ' - ' . $c->titulo_comentario}}</b>
                                                        <small class="pull-right" style="color: #b5b5b5;">{{date_create($c->dt_comentario)->format('d-m-Y')}}</small> -
                                                        {{--<div class="mb-3">--}}
                                                        @switch($c->aval_star)
                                                            @case(1)
                                                            <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o estrela" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o estrela" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o estrela" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o estrela" aria-hidden="true"></i>
                                                            @break
                                                            @case(2)
                                                            <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                            <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o estrela" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o estrela" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o estrela" aria-hidden="true"></i>
                                                            @break
                                                            @case(3)
                                                            <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                            <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                            <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o estrela" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o estrela" aria-hidden="true"></i>
                                                            @break
                                                            @case(4)
                                                            <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                            <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                            <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                            <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                            <i class="fa fa-star-o estrela" aria-hidden="true"></i>
                                                            @break
                                                            @case(5)
                                                            <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                            <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                            <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                            <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                            <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                            @break
                                                        @endswitch
                                                    </p>
                                                    {{--</div>--}}
                                                </div>
                                                <div class="col-md-10">
                                                    <p style="font-size: 14px;">{{$c->desc_comentario}}</p>
                                                </div>
                                            </div>
                                            <hr/>
                                        </div>
                                    @endforeach

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
    </section>

    <!--MODAL DE LISTA DE COMENTARIOS-->
    <div class="modal" tabindex="-1" role="dialog" id="modal-default">
        <div class="" role="document" style="max-width: 900px; margin: 1.75rem auto;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Avaliação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <!-- Target element for the igDoughnutChart -->
                        <div class="col-md-1">
                            <div id="chart"></div>
                        </div>
                        <div class="col-md-4 align-self-center" style="padding-left: 45px;">
                            <p>{{$recomendacao}}% das pessoas recomendam esse produto</p>
                        </div>
                        <div class="col-md-4 single_product_ratings justify-content-center" style="padding-left: 25px; padding-top: 20px;">
                            <strong style="font-size: 30px;">{{number_format($media, 1)}}</strong>
                            @switch(round($media))
                                @case(0)
                                <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                @break
                                @case(1)
                                    <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                    <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                    <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                    <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                    <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                    @break
                                @case(2)
                                    <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                    <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                    <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                    <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                    <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                    @break
                                @case(3)
                                    <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                    <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                    <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                    <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                    <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                    @break
                                @case(4)
                                    <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                    <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                    <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                    <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                    <i class="fa fa-star-o fonte estrela" aria-hidden="true"></i>
                                    @break
                                @case(5)
                                    <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                    <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                    <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                    <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                    <i class="fa fa-star fonte estrela" aria-hidden="true"></i>
                                    @break
                            @endswitch
                            <small>{{'(' . count($comentarios) . ')'}}</small>
                        </div>
                        <div class="col-md-3 justify-content-center" style="padding-left: 60px; padding-top: 23px;">
                            <button type="button" class="btn btn-primary"
                                    data-dismiss="modal"
                                    data-toggle="modal"
                                    data-target="#modal-comentario">Avaliar</button>
                        </div>

                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col mb-15">
                            <h5 class="title"><small class="pull-right">{{count($comentarios)}} Comentários</small>Comentários</h5>
                        </div>
                    </div>
                    <div class="row">

                        @foreach($comentarios as $c)
                            <div class="col-md-12">
                                <div class="fundo-comentario">
                                    <div class="col-md-12 mt-2">
                                        <p><b>{{$c->nm_cliente . ' - ' . $c->titulo_comentario}}</b>
                                            <small class="pull-right" style="color: #b5b5b5;">{{date_create($c->dt_comentario)->format('d-m-Y')}}</small> -
                                        {{--<div class="mb-3">--}}
                                            @switch($c->aval_star)
                                                @case(1)
                                                    <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o estrela" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o estrela" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o estrela" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o estrela" aria-hidden="true"></i>
                                                    @break
                                                @case(2)
                                                    <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                    <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o estrela" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o estrela" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o estrela" aria-hidden="true"></i>
                                                    @break
                                                @case(3)
                                                    <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                    <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                    <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o estrela" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o estrela" aria-hidden="true"></i>
                                                    @break
                                                @case(4)
                                                    <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                    <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                    <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                    <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o estrela" aria-hidden="true"></i>
                                                    @break
                                                @case(5)
                                                    <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                    <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                    <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                    <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                    <i class="fa fa-star estrela" aria-hidden="true"></i>
                                                    @break
                                            @endswitch
                                        </p>
                                        {{--</div>--}}
                                    </div>
                                    <div class="col-md-10">
                                        <pre style="font-size: 14px;">{{$c->desc_comentario}}</pre>
                                    </div>
                                </div>
                                <hr/>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->

    <!--MODAL PARA FAZER O COMENTARIO-->
    <form action="{{route('save.product.avaliation')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal" tabindex="-1" role="dialog" id="modal-comentario">
            <div class="" role="document" style="max-width: 900px; margin: 1.75rem auto;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Avalie este produto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input id="fk_id_sku" type="hidden" name="fk_id_sku" value="{{$product[0]['cd_sku']}}">
                            <input id="slug" type="hidden" name="slug" value="{{$product[0]['nm_slug']}}">
                            @if(\Illuminate\Support\Facades\Auth::check())
                                <input id="fk_id_cliente" type="hidden" name="fk_id_cliente" value="{{\Illuminate\Support\Facades\Auth::user()->cd_cliente}}">
                            @endif
                            <div class="col-md-12">
                                <label for="star1">Sua avaliação para este produto: *</label>
                            </div>

                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input id="star1" type="radio" class="form-check-input" name="fk_id_star" value="1" required>
                                    <label class="form-check-label" for="star1">Ruim</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="star2" type="radio" class="form-check-input" name="fk_id_star" value="2" required>
                                    <label class="form-check-label" for="star2">Regular</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="star3" type="radio" class="form-check-input" name="fk_id_star" value="3" required>
                                    <label class="form-check-label" for="star3">Bom</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="star4" type="radio" class="form-check-input" name="fk_id_star" value="4" required>
                                    <label class="form-check-label" for="star4">Ótimo</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="star5" type="radio" class="form-check-input" name="fk_id_star" value="5" required>
                                    <label class="form-check-label" for="star5">Excelente</label>
                                </div>
                            </div>

                            <p>&nbsp;</p>

                            <div class="col-md-12">
                                <label>Você recomenda esse produto ? *</label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input id="recomenda1" type="radio" class="form-check-input" value="1" name="recomenda" required>
                                    <label class="form-check-label" for="recomenda1">Sim</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="recomenda2" type="radio" class="form-check-input" value="0" name="recomenda" required>
                                    <label class="form-check-label" for="recomenda2">Não</label>
                                </div>
                            </div>

                            <p>&nbsp;</p>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="titulo">Titulo do comentário: *</label>
                                    <div class="input-group">
                                        <input id="titulo" class="form-control" name="titulo_comentario" required>
                                    </div>
                                    <small class="form-text text-muted">
                                        Ex: Gostei muito do produto!
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descricao">Opnião sobre o produto: *</label>
                                    <textarea id="descricao" class="form-control" rows="5" maxlength="250" style="resize: none;" name="desc_comentario" required></textarea>
                                    <small class="form-text text-muted">
                                        Limite de 250 caracteres.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn_cancelar" type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <button id="btn_comentar" type="submit" class="btn btn-primary">Comentar</button>
                        @else
                            <a class="btn btn-primary" href="{{route('client.login')}}">Faça login para comentar</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
    </form>

    <script>
        $(function () {

            let data = [
                { "Avaliacao": "", "aval": {{$recomendacao}} },
                { "Avaliacao": "", "aval": {{$nao_recomenda}} }
            ];

            $("#chart").igDoughnutChart({
                width: "100px",
                height: "100px",
                innerExtent: 75,
                series:
                    [{
                        name: "aval",
                        labelMemberPath: "Avaliacao",
                        valueMemberPath: "aval",
                        dataSource: data,
                        labelsPosition: "bestFit",
                        formatLabel: function (context) {
                            //return context.itemLabel + " (" + context.item.aval + ")";
                            return context.itemLabel + "";
                        }
                    }]
            });

            $("#chart2").igDoughnutChart({
                width: "100px",
                height: "100px",
                innerExtent: 75,
                series:
                    [{
                        name: "aval",
                        labelMemberPath: "Avaliacao",
                        valueMemberPath: "aval",
                        dataSource: data,
                        labelsPosition: "bestFit",
                        formatLabel: function (context) {
                            //return context.itemLabel + " (" + context.item.aval + ")";
                            return context.itemLabel + "";
                        }
                    }]
            });
        });
    </script>
    <script>

        $(document).ready(function(){
            var descricao = $('#desc_prod').val();
            $('#texto_desc').html(descricao);

        });

        $(function() {
            $('button#btnComprar').click(function () {
                let id = $(this).parent().parent().find("input[name='sku_produto']").val();
                let preco = $(this).parent().parent().find("input[name='vl_produto']").val();

                fbq('track', 'AddToCart', {
                    value: preco,
                    currency: 'BRL',
                    content_ids: id,
                });

            });
        });

        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        let codigos = new Array();
        let sizeSelected = false;

        let qtd = parseInt($('#qty').val());

        let selectedProductSku = '';

        let prod = new Array();

        $.each($('input[name="cod[]"]'), function(i, v){
            codigos[i] = v.value;
        });

        $('.qty-plus').click(function(e){

            //var qtdEstoque = parseInt($('#qtProdEstoque').val());
            let qtdEstoque = parseInt($('input[name="qt_produto"]').val());

            if (qtd >= qtdEstoque - 5) {

                $(this).attr('disabled');
                $('.qty-plus').css('pointer-events', 'none');

            }
            else {

                $('.qty-minus').css('pointer-events', 'auto');

                qtd++;

                $('#qty').val(qtd);
                $('#qtdDetalhes').val(qtd);

            }

        });

        //Diminui a quantidade de cada item no carrinho
        $('.qty-minus').click(function (e){

            if (qtd == 1) {

                $('.qty-minus').css('pointer-events', 'none');

            }
            else {

                $('.qty-plus').css('pointer-events', 'auto');

                qtd--;

                $('#qty').val(qtd);
                $('#qtdDetalhes').val(qtd);

            }

        });

        function carroselAdicionaImagem(d){
            let rootPath = '{{ asset('img/products') }}' + '/';

            $('.carousel-inner').find('div').remove();
            $('.carousel-indicators').find('li').remove();

            $('.carousel-indicators').append(
                `<li class="active" id="thumb1Carrossel" data-target="#product_details_slider" data-slide-to="0"
                style="background-image: url(` + rootPath + d.images[0].im_produto + `);">
                </li>`);

            $('.carousel-inner').append(
                `<div class="carousel-item active">
                    <img id="fotoGrande1" class="d-block w-100" src="` + rootPath + d.images[0].im_produto +`"
                    alt="First slide" style="width: 1000px; heigth: 1444px;">
                </div>`);

            //$('#thumb1Carrossel').css('background-image','url(' + rootPath + d.images[0].im_produto + ')');
            //$('#fotoGrande1').attr('src', '' + rootPath + d.images[0].im_produto +'');

            $.each(d.images, function (i, v) {
                if (i > 0) {
                    console.log('entrou if');
                    //$('#thumb' + (i + 1) + 'Carrossel').css('background-image','url(' + rootPath + v.im_produto + ')');
                    $('.carousel-indicators').append(
                        `<li id="thumb` + (i + 1) + `Carrossel"
                        data-target="#product_details_slider" data-slide-to="` + i + `"
                        style="background-image: url(` + rootPath + v.im_produto + `);">
                        </li>`);

                    $('.carousel-inner').append(
                        `<div class="carousel-item">
                            <a class="gallery_img" href="">
                                <img id="fotoGrande` + (i + 1) + `" class="d-block" src="` + rootPath + v.im_produto + `" alt="slide"
                                style="width: 1000px; heigth: 1444px;">
                            </a>
                        </div>`);

                    //$('#fotoGrande' + (i + 1)).attr('src', '' + rootPath + v.im_produto +'');
                }

            });
        }

        $('a[name="btn_color[]"]').click(function (){
            $('#btnComprar').attr('disabled', true);

            $.ajax({

                url: '{{ route('product.sizes') }}',
                type: 'POST',
                data: {_token: CSRF_TOKEN, cds_produto: codigos, cd_cor: this.id},
                success: function (d) {

                    console.log(d);
                    if(d.cor[0].qt_produto_variacao <= 5){
                        console.log('menor que 5');
                        $('#pSemEstoque').removeAttr('hidden');
                        $('#divFormProduto').attr('hidden', true);
                    }
                    else{
                        console.log('maior que 5');
                        $('#divFormProduto').removeAttr('hidden');
                        $('#pSemEstoque').attr('hidden', true);
                    }

                    if (d.data.length > 0) {

                        $('.qty-plus').css('pointer-events', 'none');
                        $('.qty-minus').css('pointer-events', 'none');

                        $('#tamanhos').removeClass('d-none');
                        $('.listaDeTamanhos').empty();

                        $.each(d.data, function (i, v) {

                            if (d.sizeType == 'N') {
                                $('.listaDeTamanhos').append('<li class="' + v.cd_nr_sku + '"><a id="' + v.cd_nr_sku + '" name="sizes[]" href="javascript:void(0);">' + v.nm_tamanho_num + '</a></li>&nbsp;&nbsp;');
                                $("#tamanhos").removeAttr('hidden');
                            }

                            if (d.sizeType == 'L') {
                                $('.listaDeTamanhos').append('<li class="' + v.cd_nr_sku + '"><a id="' + v.cd_nr_sku + '" name="sizes[]" href="javascript:void(0);">' + v.nm_tamanho_letra + '</a></li>&nbsp;&nbsp;');
                                $("#tamanhos").removeAttr('hidden');
                            }

                        });

                        carroselAdicionaImagem(d);

                    }
                    else{
                        //console.log(d);

                        ajaxPreencheDadosProduto(d.cor[0].cd_nr_sku);

                        $('#btnComprar').removeAttr('disabled');
                        $('#tamanhos').addClass('d-none');

                        carroselAdicionaImagem(d);
                    }

                }
            });

        });

        function ajaxPreencheDadosProduto(selectedProductSku, ehLi = false){
            $.ajax({
                url: '{{ route('product.variation.data') }}',
                type: 'POST',
                data: {_token: CSRF_TOKEN, sku: selectedProductSku},
                success: function (d) {
                    //console.log(d);

                    if(d.variation[0].qt_produto_variacao <= 5) {
                        $('.disponivel').html('Não disponível');
                        $('#pSemEstoque').removeAttr('hidden');
                        $('#divFormProduto').attr('hidden', true);
                    }
                    else {
                        $('.disponivel').html('Em Estoque');
                        $('#divFormProduto').removeAttr('hidden');
                        $('#pSemEstoque').attr('hidden', true);
                    }

                    if(ehLi)
                        carroselAdicionaImagem(d);

                    qtd = 1;
                    $('#qty').val(1);

                    $('input[name="cd_produto"]').val(d.variation[0].cd_produto);
                    $('input[name="nm_produto"]').val(d.variation[0].nm_produto_variacao);
                    $('input[name="ds_produto"]').val(d.variation[0].ds_produto_variacao);
                    $('input[name="vl_produto"]').val(d.variation[0].vl_produto_variacao);
                    $('input[name="qt_produto_detalhes"]').val($('#qty').val());
                    $('input[name="qt_produto"]').val(d.variation[0].qt_produto_variacao);
                    $('input[name="sku_produto"]').val(d.variation[0].cd_nr_sku);
                    $('input[name="slug_produto"]').val(d.variation[0].nm_slug);
                    $('input[name="ds_altura"]').val(d.variation[0].ds_altura);
                    $('input[name="ds_largura"]').val(d.variation[0].ds_largura);
                    $('input[name="ds_comprimento"]').val(d.variation[0].ds_comprimento);
                    $('input[name="ds_peso"]').val(d.variation[0].ds_peso);
                    $('input[name="im_produto"]').val(d.variation[0].im_produto);

                    $('#precoProduto').html('R$ ' + (d.variation[0].vl_produto_variacao).replace('.', ','));

                    $('.infoProduto').html(d.variation[0].ds_produto_variacao);

                    $('#btnComprar').removeAttr('disabled');
                    $('.qty-minus').css('pointer-events', 'auto');
                    $('.qty-plus').css('pointer-events', 'auto');

                    $('#qtd_vendas_prod').html(d.vendas);

                }
            });
        }

        $('.listaDeTamanhos').on('click', 'li a', function () {

            let selectedProductSku = this.id;

            $('.qty-plus').css('pointer-events', 'auto');

            ajaxPreencheDadosProduto(selectedProductSku, true);

        });

    </script>

@stop
