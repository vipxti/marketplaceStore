@extends('layouts.app.app')

@section('content')

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

                                <h4 id="precoProduto" class="price">R$ {{ number_format($variations[0]['vl_produto_variacao'], 2, ',', '.') }}</h4>
                                
                            @else

                                <h4 id="precoProduto" class="price">R$ {{ number_format($product[0]['vl_produto'], 2, ',', '.') }}</h4>
                                
                            @endif

                            @if ($isVariation)

                                @if($variations[0]['qt_produto_variacao'] > 5)

                                    <p class="available">Disponibilidade: <span class="disponivel" class="text-muted">Em estoque</span></p>

                                @else

                                    <p class="available">Disponibilidade: <span class="disponivel" class="text-muted">Não disponível</span></p>

                                @endif
                                
                            @else

                                @if($product[0]['qt_produto'] > 5)

                                    <p class="available">Disponibilidade: <span class="disponivel" class="text-muted">Em estoque</span></p>

                                @else

                                    <p class="available">Disponibilidade: <span class="disponivel" class="text-muted">Não disponível</span></p>

                                @endif
                                
                            @endif

                            <div class="single_product_ratings mb-15">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
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

                                <div id="tamanhos" class="widget size mb-50">
                                
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

                                @if($variations[0]['qt_produto_variacao'] <= 5)

                                    <p>SEM ESTOQUE</p>

                                @else

                                    <form action="{{ route('cart.buy') }}" class="cart clearfix mb-50 d-flex" method="post">
                                    {{ csrf_field() }}

                                        <input type="hidden" name="cd_produto" value="">
                                        <input type="hidden" name="nm_produto" value="">
                                        <input type="hidden" name="ds_produto" value="">
                                        <input type="hidden" name="vl_produto" value="">
                                        <input type="hidden" name="qt_produto" value="">
                                        <input type="hidden" name="sku_produto" value="">
                                        <input type="hidden" name="slug_produto" value="">
                                        <input type="hidden" name="ds_altura" value="">
                                        <input type="hidden" name="ds_largura" value="">
                                        <input type="hidden" name="ds_comprimento" value="">
                                        <input type="hidden" name="ds_peso" value="">
                                        <input type="hidden" name="im_produto" value="">

                                        <button type="submit" id="btnComprar" class="btn cart-submit d-block" disabled>Comprar</button>

                                    </form>

                                    {{-- <div class="quantity">
                                        <span id="1" class="qty-minus">
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </span>
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="12" name="quantity" value="1" disabled>
                                        <span id="1" class="qty-plus">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </span>
                                    </div> --}}

                                @endif
                                
                            @else

                                @if($product[0]['qt_produto'] <= 5)

                                    <p>SEM ESTOQUE</p>

                                @else

                                    <form action="{{ route('cart.buy') }}" class="cart clearfix mb-50 d-flex" method="post">
                                    {{ csrf_field() }}

                                        <input type="hidden" name="cd_produto" value="{{ $product[0]['cd_produto'] }}">
                                        <input type="hidden" name="nm_produto" value="{{ $product[0]['nm_produto'] }}">
                                        <input type="hidden" name="ds_produto" value="{{ $product[0]['ds_produto'] }}">
                                        <input type="hidden" name="vl_produto" value="{{ $product[0]['vl_produto'] }}">
                                        <input id="qtProdEstoque" type="hidden" name="qt_produto" value="{{ $product[0]['qt_produto'] }}">
                                        <input type="hidden" name="sku_produto" value="{{ $product[0]['cd_nr_sku'] }}">
                                        <input type="hidden" name="slug_produto" value="{{ $product[0]['nm_slug'] }}">
                                        <input type="hidden" name="ds_altura" value="{{ $product[0]['ds_altura'] }}">
                                        <input type="hidden" name="ds_largura" value="{{ $product[0]['ds_largura'] }}">
                                        <input type="hidden" name="ds_comprimento" value="{{ $product[0]['ds_comprimento'] }}">
                                        <input type="hidden" name="ds_peso" value="{{ $product[0]['ds_peso'] }}">
                                        <input type="hidden" name="im_produto" value="{{ $images[0]['im_produto'] }}">

                                        <button type="submit" id="btnComprar" class="btn cart-submit d-block">Comprar</button>

                                    </form>

                                    {{-- <div class="quantity">
                                        <span id="1" class="qty-minus">
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </span>
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="12" name="quantity" value="1" disabled>
                                        <span id="1" class="qty-plus">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </span>
                                    </div> --}}

                                @endif
                                
                            @endif

                    </div>

                </div>

            </div>

            <p>&nbsp;</p>

            <!--Informações do produto -->
            <div class="row">

                <form id="accordion" role="tablist">
                    <div class="card">
                        <div class="card-header" role="tab" id="headingOne">
                            <h6>
                                <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Informação do produto</a>
                            </h6>
                        </div>

                        @if ($isVariation)

                            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <p class="infoProduto">{{ $variations[0]['ds_produto_variacao'] }}</p>
                                </div>
                            </div>

                        @else

                            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <p class="infoProduto">{{ $product[0]['ds_produto'] }}</p>
                                </div>
                            </div>
                            
                        @endif

                    </div>
                </form>

            </div>
        </div>

    </section>

    <script>

        $(document).ready(function(){
            var descricao = $('#desc_prod').val();
            $('#texto_desc').html(descricao);



        });

        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        let codigos = new Array();
        let sizeSelected = false;

        let selectedProductSku = '';

        let prod = new Array();

        $.each($('input[name="cod[]"]'), function(i, v){
            codigos[i] = v.value;
        });

        $('.qty-plus').click(function(e){

            var qtd = parseInt($('#qty').val());
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var qtdEstoque = parseInt($('#qtProdEstoque').val());

            if (qtd == qtdEstoque - 5) {
              
                $(this).attr('disabled');    

            }
            else {

                $.ajax({
                    url: '{{ url('/page/cart/plus/details') }}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, qtd: 1},
                    dataType: 'JSON',
                    success: function (r) {

                        console.log(r.qtd);

                    }
                });               
                    
            } 

        });

        //Diminui a quantidade de cada item no carrinho
        $('.qty-minus').click(function (e){

            var sku = $(this).attr('id');
            var qtd = parseInt($('#qty' + id).val());
            var precoProd = parseFloat($('#precoProd' + id).html().replace('R$ ', '').replace(',', '.'));
            
            if (qtd == 1) {
                
                $('.qty-minus').attr('disabled');    

            }
            else {

                qtd -= 1;

                $('.qty-minus').attr('disabled');

                $.ajax({
                    url: '{{ url('/page/cart/minus') }}/' + idx,
                    type: 'GET',
                    data: {},
                    success: function (r) {

                        location.reload();

                        $('.cart_quantity').html(r.qtCarrinho);
                        $('#qty' + id).val(r.cartSession[idx].qtdIndividual);
                        $('#valorTotal' + idx).html('R$ ' + r.cartSession[idx].valorTotalProduto.toFixed(2).replace('.', ','));
                        $('#precoSubTotal').html('R$ ' + r.subTotal.toFixed(2).replace('.', ','));
                        $('#precoCalcTotal').html('R$ ' + r.total.toFixed(2).replace('.', ','));
                        
                    }
                });

            }

        });

        $('a[name="btn_color[]"]').click(function (){

            $.ajax({

                url: '{{ route('product.sizes') }}',
                type: 'POST',
                data: {_token: CSRF_TOKEN, cds_produto: codigos, cd_cor: this.id},
                success: function (d) {

                    console.log(d);

                    if (d.data.length > 0) {

                        let rootPath = '{{ asset('img/products') }}' + '/'

                        $('#thumb1Carrossel').css('background-image','url(' + rootPath + d.images[0].im_produto + ')');
                        $('#fotoGrande1').attr('src', '' + rootPath + d.images[0].im_produto +'');

                        $('#tamanhos').removeClass('d-none');
                        $('.listaDeTamanhos').empty();
                        
                        $.each(d.data, function (i, v) {

                            if (d.sizeType == 'N') {
                                $('.listaDeTamanhos').append('<li class="' + v.cd_nr_sku + '"><a id="' + v.cd_nr_sku + '" name="sizes[]" href="javascript:void(0);">' + v.nm_tamanho_num + '</a></li>&nbsp;&nbsp;');
                            }

                            if (d.sizeType == 'L') {
                                $('.listaDeTamanhos').append('<li class="' + v.cd_nr_sku + '"><a id="' + v.cd_nr_sku + '" name="sizes[]" href="javascript:void(0);">' + v.nm_tamanho_letra + '</a></li>&nbsp;&nbsp;');
                            }

                        })

                        $.each(d.images, function (i, v) {

                            if (i > 0) {
                                $('#thumb' + (i + 1) + 'Carrossel').css('background-image','url(' + rootPath + v.im_produto + ')');
                                $('#fotoGrande' + (i + 1)).attr('src', '' + rootPath + v.im_produto +'');
                            }
                            
                        });
                    }

                }
            });

        });

        $('.listaDeTamanhos').on('click', 'li a', function () {

            selectedProductSku = this.id;

            $.ajax({
                url: '{{ route('product.variation.data') }}',
                type: 'POST',
                data: {_token: CSRF_TOKEN, sku: selectedProductSku},
                success: function (d) {

                    console.log(d.variation[0])

                    $('input[name="cd_produto"]').val(d.variation[0].cd_produto);
                    $('input[name="nm_produto"]').val(d.variation[0].nm_produto);
                    $('input[name="ds_produto"]').val(d.variation[0].ds_produto_variacao);
                    $('input[name="vl_produto"]').val(d.variation[0].vl_produto_variacao);
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
                    
                }
            });


        })

    </script>

@stop
