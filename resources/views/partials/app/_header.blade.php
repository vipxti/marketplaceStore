<style>
    #loadingPrincipal{
        width: 100vw;
        height: 100vh;
        background: rgba(255,255,255,0.70);
        position: fixed;
        top: 0;
        left: 0;
        z-index: 9999;
    }
    .sk-circle {
        margin: 40px auto;
        width: 40px;
        height: 40px;
        position: relative; }
    .sk-circle .sk-child {
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0; }
    .sk-circle .sk-child:before {
        content: '';
        display: block;
        margin: 0 auto;
        width: 15%;
        height: 15%;
        background-color: #333;
        border-radius: 100%;
        -webkit-animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
        animation: sk-circleBounceDelay 1.2s infinite ease-in-out both; }
    .sk-circle .sk-circle2 {
        -webkit-transform: rotate(30deg);
        -ms-transform: rotate(30deg);
        transform: rotate(30deg); }
    .sk-circle .sk-circle3 {
        -webkit-transform: rotate(60deg);
        -ms-transform: rotate(60deg);
        transform: rotate(60deg); }
    .sk-circle .sk-circle4 {
        -webkit-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        transform: rotate(90deg); }
    .sk-circle .sk-circle5 {
        -webkit-transform: rotate(120deg);
        -ms-transform: rotate(120deg);
        transform: rotate(120deg); }
    .sk-circle .sk-circle6 {
        -webkit-transform: rotate(150deg);
        -ms-transform: rotate(150deg);
        transform: rotate(150deg); }
    .sk-circle .sk-circle7 {
        -webkit-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        transform: rotate(180deg); }
    .sk-circle .sk-circle8 {
        -webkit-transform: rotate(210deg);
        -ms-transform: rotate(210deg);
        transform: rotate(210deg); }
    .sk-circle .sk-circle9 {
        -webkit-transform: rotate(240deg);
        -ms-transform: rotate(240deg);
        transform: rotate(240deg); }
    .sk-circle .sk-circle10 {
        -webkit-transform: rotate(270deg);
        -ms-transform: rotate(270deg);
        transform: rotate(270deg); }
    .sk-circle .sk-circle11 {
        -webkit-transform: rotate(300deg);
        -ms-transform: rotate(300deg);
        transform: rotate(300deg); }
    .sk-circle .sk-circle12 {
        -webkit-transform: rotate(330deg);
        -ms-transform: rotate(330deg);
        transform: rotate(330deg); }
    .sk-circle .sk-circle2:before {
        -webkit-animation-delay: -1.1s;
        animation-delay: -1.1s; }
    .sk-circle .sk-circle3:before {
        -webkit-animation-delay: -1s;
        animation-delay: -1s; }
    .sk-circle .sk-circle4:before {
        -webkit-animation-delay: -0.9s;
        animation-delay: -0.9s; }
    .sk-circle .sk-circle5:before {
        -webkit-animation-delay: -0.8s;
        animation-delay: -0.8s; }
    .sk-circle .sk-circle6:before {
        -webkit-animation-delay: -0.7s;
        animation-delay: -0.7s; }
    .sk-circle .sk-circle7:before {
        -webkit-animation-delay: -0.6s;
        animation-delay: -0.6s; }
    .sk-circle .sk-circle8:before {
        -webkit-animation-delay: -0.5s;
        animation-delay: -0.5s; }
    .sk-circle .sk-circle9:before {
        -webkit-animation-delay: -0.4s;
        animation-delay: -0.4s; }
    .sk-circle .sk-circle10:before {
        -webkit-animation-delay: -0.3s;
        animation-delay: -0.3s; }
    .sk-circle .sk-circle11:before {
        -webkit-animation-delay: -0.2s;
        animation-delay: -0.2s; }
    .sk-circle .sk-circle12:before {
        -webkit-animation-delay: -0.1s;
        animation-delay: -0.1s; }

    @-webkit-keyframes sk-circleBounceDelay {
        0%, 80%, 100% {
            -webkit-transform: scale(0);
            transform: scale(0); }
        40% {
            -webkit-transform: scale(1);
            transform: scale(1); } }

    @keyframes sk-circleBounceDelay {
        0%, 80%, 100% {
            -webkit-transform: scale(0);
            transform: scale(0); }
        40% {
            -webkit-transform: scale(1);
            transform: scale(1); } }
</style>

<!-- Tweaks for older IEs--><!--[if lt IE 9] ]-->
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<!-- navbar-->
<header class="header">
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-K88JHSV');</script>

    {{--dd($menuNav)--}}
    {{--dd($menuNavegacao)--}}
    <!-- End Google Tag Manager -->
    <div id="telaLoading" hidden>
        <div id="loadingPrincipal" class="d-flex align-items-center justify-content-center">
            {{--<img src="{{asset('img/app/loadingCircle.gif')}}" class="img-fluid"></a>--}}
            <div class="sk-circle">
                <div class="sk-circle1 sk-child"></div>
                <div class="sk-circle2 sk-child"></div>
                <div class="sk-circle3 sk-child"></div>
                <div class="sk-circle4 sk-child"></div>
                <div class="sk-circle5 sk-child"></div>
                <div class="sk-circle6 sk-child"></div>
                <div class="sk-circle7 sk-child"></div>
                <div class="sk-circle8 sk-child"></div>
                <div class="sk-circle9 sk-child"></div>
                <div class="sk-circle10 sk-child"></div>
                <div class="sk-circle11 sk-child"></div>
                <div class="sk-circle12 sk-child"></div>
            </div>
        </div>
    </div>
    <div id="noty-holder"></div><!-- HERE IS WHERE THE NOTY WILL APPEAR-->
    <nav class="navbar navbar-expand-lg">
        <div class="search-area">
            <div class="search-area-inner d-flex align-items-center justify-content-center">
                <div class="close-btn"><i class="icon-close"></i></div>
                <form id="formPesquisa" action="{{route('productsFilterCatSubCat.page')}}" method="get">

                    <div class="form-group">
                        <input type="search" name="search" id="search" placeholder="Pesquisar produto...">
                        <input type="search" name="id" id="idProd" hidden>
                        <input type="search" name="catSubCat" id="catSubCatProd" hidden>
                        <button id="btnPesquisaProd" type="button" class="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-fluid">
            <a href="{{ route('index')}}" class="navbar-brand">
                <img src="{{asset('img/app/core-img/logo1.png')}}">
            </a>
            <button type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
                    aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right">
                <i class="fa fa-bars"></i>
            </button>

            <form id="formLista" action="{{route('productsFilterCatSubCat.page')}}" method="get">

                <input type="search" name="id" id="idProdLista" hidden>
                <input type="search" name="catSubCat" id="catSubCatProdLista" hidden>
            </form>

            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="navbar-nav mx-auto">
                    <!-- Início -->
                    <li class="nav-item dropdown"><a id="navbarHomeLink" href="{{ route('index')}}" aria-haspopup="true" aria-expanded="false" class="nav-link active">Início</a>
                        <ul aria-labelledby="navbarDropdownHomeLink" class="dropdown-menu"></ul>
                    </li>

            @if(count($menuNavegacao) > 0)
                @if($menuNavegacao[0]['menu_ativo'] === 0)

                    <!-- APRESENTAÇÃO DO MENU EM FORMA DE CATEGORIAS -->
                    @for($i = 0; $i < sizeof($categoriaSubCat); $i++)
                        @if($i == 0 || $categoriaSubCat[$i]->nm_categoria != $categoriaSubCat[$i-1]->nm_categoria)
                            {{--<p>{{$categoriaSubCat[$i]->nm_categoria}}</p>--}}
                            <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" class="nav-link">{{$categoriaSubCat[$i]->nm_categoria}}<i class="fa fa-angle-down"></i></a>
                                <div class="dropdown-menu megamenu">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <div class="row">
                                                <p hidden>{{$contador = 0}}</p>
                                                <p hidden>{{$flag = 0}}</p>
                                                <p hidden>{{$primeiro = 0}}</p>
                                                @for($j = 0; $j < sizeof($categoriaSubCat); $j++)
                                                    @if($categoriaSubCat[$i]->cd_categoria == $categoriaSubCat[$j]->cd_categoria)
                                                        @if($j==0 || $primeiro == 0)
                                                            <p hidden>{{$flag = 1}}</p>
                                                            <p hidden>{{$primeiro = 1}}</p>
                                                            <div class="col-lg-3">

                                                                <ul style="margin-bottom: 0 !important;">
                                                                    <li id="c">
                                                                        <a id="{{$categoriaSubCat[$j]->cd_categoria}}"
                                                                           href="javascript:void(0)"
                                                                           class="listagem">
                                                                            <strong class="text-uppercase" style="font-size: 16px">{{$categoriaSubCat[$j]->nm_categoria}}</strong>
                                                                        </a>
                                                                    </li>
                                                                </ul>

                                                                <ul class="list-unstyled">
                                                        @elseif(is_int($contador/10))
                                                            <p hidden>{{$flag = 1}}</p>
                                                            <div class="col-lg-3">

                                                                <ul class="list-unstyled">
                                                        @endif

                                                            <li id="s"><a id="{{$categoriaSubCat[$j]->cd_sub_categoria}}" href="javascript:void(0)" class="listagem">{{$categoriaSubCat[$j]->nm_sub_categoria}}</a></li>
                                                            <p hidden>{{$contador++}}</p>

                                                        @if(is_int($contador/10))
                                                                </ul>
                                                            </div>
                                                            <p hidden>{{$flag = 0}}</p>
                                                        @endif
                                                    @endif
                                                @endfor
                                                @if($flag==1)
                                                        </ul>
                                                    </div>
                                                @endif

                                            </div>

                                            <!-- Icons de descontos -->
                                            <div class="row services-block">
                                                <div class="col-xl-3 col-lg-6 d-flex">
                                                    <div class="item d-flex align-items-center">
                                                        <div class="icon"><i class="icon-truck text-primary"></i></div>
                                                        <div class="text"><span class="text-uppercase">Entregamos todo Brasil</span>
                                                            <small>Entregas via Correio</small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-3 col-lg-6 d-flex">
                                                    <div class="item d-flex align-items-center">
                                                        <div class="icon"><i class="icon-headphones text-primary"></i></div>
                                                        <div class="text"><span class="text-uppercase">13 97424-8882</span>
                                                            <small>Suporte de Segunda à Sábado</small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-3 col-lg-6 d-flex">
                                                    <div class="item d-flex align-items-center">
                                                        <div class="icon"><i class="icon-secure-shield text-primary"></i></div>
                                                        <div class="text"><span class="text-uppercase">Pagamento Seguro</span>
                                                            <small>PagSeguro</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Produto Destaque -->
                                        <div class="col-lg-3 text-center product-col hidden-lg-down">
                                            <a href="" class="product-image">
                                                <img src="{{asset('img/app/bg-img/menu/product1.png')}}" class="img-fluid"></a>
                                            <h6 class="text-uppercase product-heading"><a href="">Catharine Hill Sombras 30 cores</a>
                                            </h6>
                                            <ul class="rate list-inline"></ul>
                                            <strong class="price" style="color: #dc3545">R$ 106,00</strong>
                                            <a href="http://maktubbeauty.com.br/page/product/catharine-hill-paleta-de-sombras-variadas-30-cores" class="btn btn-template wide" target="_blank">Adicionar ao Carrinho</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endfor
                @else
                    <!-- APRESENTAÇÃO DO MENU EM FORMA DE TÓPICOS -->

                    @for($i = 0; $i<sizeof($menuNav); $i++)
                        {{--<p>{{$menuNav[$i]->nm_menu}}</p>--}}
                        <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" class="nav-link">{{$menuNav[$i]->nm_menu}}<i class="fa fa-angle-down"></i></a>
                            <div class="dropdown-menu megamenu">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="row">
                                            <p hidden>{{$contador = 0}}</p>
                                            <p hidden>{{$flag = 0}}</p>
                                            @for($j = 0; $j < sizeof($categoriaSubCat[$i]); $j++)


                                                {{--<p>{{$categoriaSubCat[$i][$j]->nm_categoria}}</p>--}}
                                                @if($categoriaSubCat[$i][$j]->cd_sub_categoria != null)

                                                    @if($j == 0 ||
                                                        $categoriaSubCat[$i][$j]->nm_categoria != $categoriaSubCat[$i][$j - 1]->nm_categoria)
                                                        <p hidden>{{$contador = 0}}</p>
                                                        <p hidden>{{$flag = 1}}</p>
                                                        <div class="col-lg-3">

                                                                <ul style="margin-bottom: 0 !important;">
                                                                    <li id="c">
                                                                        <a id="{{$categoriaSubCat[$i][$j]->cd_categoria}}"
                                                                           href="javascript:void(0)"
                                                                           class="listagem">
                                                                            <strong class="text-uppercase" style="font-size: 16px">{{$categoriaSubCat[$i][$j]->nm_categoria}}</strong>
                                                                        </a>
                                                                    </li>
                                                                </ul>


                                                            <ul class="list-unstyled">
                                                    @elseif(is_int($contador/10))
                                                        <p hidden>{{$flag = 1}}</p>
                                                        <div class="col-lg-3">
                                                            <ul class="list-unstyled">
                                                    @endif

                                                        <li id="s">
                                                            <a id="{{$categoriaSubCat[$i][$j]->cd_sub_categoria}}"
                                                               href="javascript:void(0)"
                                                               class="listagem">
                                                                    {{$categoriaSubCat[$i][$j]->nm_sub_categoria}}
                                                            </a>
                                                        </li>
                                                        <p hidden>{{$contador++}}</p>

                                                           {{-- </ul>
                                                        </div>--}}

                                                        @if(is_int($contador/10))
                                                                </ul>
                                                            </div>
                                                            <p hidden>{{$flag = 0}}</p>
                                                        @endif

                                                        @if(($j + 1) < sizeof($categoriaSubCat[$i]))
                                                            @if($categoriaSubCat[$i][$j]->nm_categoria != $categoriaSubCat[$i][$j + 1]->nm_categoria)
                                                                @if($flag == 1)
                                                                        </ul>
                                                                    </div>
                                                                    <p hidden>{{$flag = 0}}</p>
                                                                @endif
                                                            @endif
                                                        @endif

                                                @endif

                                            @endfor

                                            @if($flag==1)
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Icons de descontos -->
                                        <div class="row services-block">
                                            <div class="col-xl-3 col-lg-6 d-flex">
                                                <div class="item d-flex align-items-center">
                                                    <div class="icon"><i class="icon-truck text-primary"></i></div>
                                                    <div class="text"><span class="text-uppercase">Entregamos Brasil</span>
                                                        <small>Entregas via Correio</small>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-3 col-lg-6 d-flex">
                                                <div class="item d-flex align-items-center">
                                                    <div class="icon"><i class="icon-headphones text-primary"></i></div>
                                                    <div class="text"><span class="text-uppercase">13 97424-8882</span>
                                                        <small>Suporte de Segunda à Sábado</small>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-3 col-lg-6 d-flex">
                                                <div class="item d-flex align-items-center">
                                                    <div class="icon"><i class="icon-secure-shield text-primary"></i></div>
                                                    <div class="text"><span class="text-uppercase">Pagamento Seguro</span>
                                                        <small>PagSeguro</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Produto Destaque -->
                                    <div class="col-lg-3 text-center product-col hidden-lg-down">
                                        <a href="" class="product-image">
                                            <img src="{{asset('img/app/bg-img/menu/product1.png')}}" class="img-fluid"></a>
                                        <h6 class="text-uppercase product-heading"><a href="">Catharine Hill Sombras 30 cores</a>
                                        </h6>
                                        <ul class="rate list-inline"></ul>
                                        <strong class="price" style="color: #dc3545">R$ 106,00</strong>
                                        {{--<a href="https://produto.mercadolivre.com.br/MLB-1023655655-catharine-hill-sombras-variadas-1017-paleta-de-sombras-_JM" class="btn btn-template wide" target="_blank">Adicionar ao Carrinho</a>--}}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endfor
                @endif
            @endif
                    <!-- Queridinhos -->
                    <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" class="nav-link">Queridinhos<i class="fa fa-angle-down"></i></a>
                        <div class="dropdown-menu megamenu">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="row">
                                        <!-- Maquiagem -->
                                        <div class="col-lg-3"><strong class="text-uppercase">Queridinhos</strong>
                                            <ul class="list-unstyled">
                                                <li><a href="">Queridinhos Camila Oliver</a></li>
                                                <li><a href="">Queridinhos Grace Galdino</a></li>
                                                <li><a href="">&nbsp;</a></li>
                                                <li><a href="">&nbsp;</a></li>
                                                <li><a href="">&nbsp;</a></li>
                                                <li><a href="">&nbsp;</a></li>
                                                <li><a href="">&nbsp;</a></li>
                                                <li><a href="">&nbsp;</a></li>
                                                <li><a href="">&nbsp;</a></li>
                                                <li><a href="">&nbsp;</a></li>
                                                <br>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Icons de descontos -->
                                    <div class="row services-block">
                                        <div class="col-xl-3 col-lg-6 d-flex">
                                            <div class="item d-flex align-items-center">
                                                <div class="icon"><i class="icon-truck text-primary"></i></div>
                                                <div class="text"><span class="text-uppercase">Entregamos todo Brasil</span>
                                                    <small>Entregas via Correio</small>
                                                </div>
                                            </div>
                                        </div>
                                        {{--<div class="col-xl-3 col-lg-6 d-flex">
                                            <div class="item d-flex align-items-center">
                                                <div class="icon"><i class="icon-coin text-primary"></i></div>
                                                <div class="text"><span class="text-uppercase">5% de Desconto</span>
                                                    <small>Boleto, depósito ou transferência</small>
                                                </div>
                                            </div>
                                        </div>--}}
                                        <div class="col-xl-3 col-lg-6 d-flex">
                                            <div class="item d-flex align-items-center">
                                                <div class="icon"><i class="icon-headphones text-primary"></i></div>
                                                <div class="text"><span class="text-uppercase">13 97424-8882</span>
                                                    <small>Suporte de Segunda à Sábado</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 d-flex">
                                            <div class="item d-flex align-items-center">
                                                <div class="icon"><i class="icon-secure-shield text-primary"></i></div>
                                                <div class="text"><span class="text-uppercase">Pagamento Seguro</span>
                                                    <small>PagSeguro</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 text-center product-col hidden-lg-down"><a href="" class="product-image"><img src="{{asset('img/app/bg-img/menu/product5.png')}}" class="img-fluid"></a>
                                    <h6 class="text-uppercase product-heading"><a href=""></a></h6>
                                    <ul class="rate list-inline"></ul>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Produtos -->
                    <li class="nav-item"><a href="{{route('products.page')}}" class="nav-link">Produtos</a>
                    </li>
                </ul>

                <div class="right-col d-flex align-items-lg-center flex-column flex-lg-row">
                    <!-- Search Button-->
                    <div class="search"><i class="fa fa-search"></i></div>
                    <!-- User Not Logged - link to login page-->
                    <div class="user dropdown show">

                        @if (Auth::check())

                            <a id="" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                                <i class="fa fa-user" style="color: #d59431;"></i>
                            </a>

                        @else

                            <a id="" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                                <i class="fa fa-user"></i>
                            </a>

                        @endif


                        <div aria-labelledby="" class="dropdown-menu">
                            <!-- user menu-->
                            @if(Auth::check())
                                <div class="dropdown-submenu">
                                    <a href="javascript:void(0);">{{ Auth::user()->nm_cliente }}</a>
                                </div>
                                <hr>
                                <div class="dropdown-submenu">
                                    <a href="{{ route('client.dashboard') }}">Minha Conta</a>
                                </div>
                                <div class="dropdown-submenu">
                                    <a href="{{ route('client.logout') }}">Sair</a>
                                </div>
                            @else
                                <div class="dropdown-submenu">
                                    <a href="{{ route('client.login') }}">Fazer login</a>
                                </div>
                                <div class="dropdown-submenu">
                                    <a href="{{ route('client.register') }}">Criar nova Conta</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- Cart Dropdown-->
                    <div class="cart dropdown show">
                        @if(Session::get('qtCart') == 0)
                            <a id="cartdetails" href="{{ route('cart.page') }}" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                        @else
                            <a id="cartdetails" href="{{ route('cart.page') }}" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                                <i class="fa fa-shopping-cart"></i>
                                <div class="cart-no">{{ Session::get('qtCart') }}</div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>

    $('.listagem').click(function(){
        var catSubCat= $(this).attr('id');
        var id = $(this).parent().attr('id');

        $('#idProdLista').val(id);
        $('#catSubCatProdLista').val(catSubCat);
        $('#formLista').submit();
    });

    $('#btnPesquisaProd').click(function(){
        enviarDadoPesquisa();
    });

    function enviarDadoPesquisa(){
        var nomeProd = $('#search').val();
        $('#idProd').val('pesquisa');
        $('#catSubCatProd').val(nomeProd);

        $('#formPesquisa').submit();
    }

    $('#search').keypress(function(event){

        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            enviarDadoPesquisa();
        }

    });
</script>