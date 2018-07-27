<!-- Tweaks for older IEs--><!--[if lt IE 9] ]-->
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<!-- navbar-->
<header class="header">
    <nav class="navbar navbar-expand-lg">
        <div class="search-area">
            <div class="search-area-inner d-flex align-items-center justify-content-center">
                <div class="close-btn"><i class="icon-close"></i></div>
                <form action="#">
                    <div class="form-group">
                        <input type="search" name="search" id="search" placeholder="Pesquisar produto...">
                        <button type="submit" class="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-fluid">
            <a href="{{ route('index')}}" class="navbar-brand"><img src="{{asset('img/logo.png')}}"></a>
            <button type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
                    aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right">
                <i class="fa fa-bars"></i>
            </button>

            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="navbar-nav mx-auto">
                    <!-- Início -->
                    <li class="nav-item dropdown"><a id="navbarHomeLink" href="{{ route('index')}}" aria-haspopup="true" aria-expanded="false" class="nav-link active">Início</a>
                        <ul aria-labelledby="navbarDropdownHomeLink" class="dropdown-menu"></ul>
                    </li>

                    <!-- Maquiagem -->
                    <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" class="nav-link">Maquiagem<i class="fa fa-angle-down"></i></a>
                        <div class="dropdown-menu megamenu">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="row">
                                        <!-- Face -->
                                        <div class="col-lg-3"><strong class="text-uppercase">Face</strong>
                                            <ul class="list-unstyled">
                                                <li><a href="">Base</a></li>
                                                <li><a href="">Corretivo</a></li>
                                                <li><a href="">Pó</a></li>
                                                <li><a href="">Blush</a></li>
                                                <li><a href="">Primer</a></li>
                                                <li><a href="">Sérum</a></li>
                                                <li><a href="">Iluminador</a></li>
                                                <li><a href="">BB Cleam</a></li>
                                                <li><a href="">Bronzeador</a></li>
                                                <li><a href="">Demaquilante</a></li>
                                            </ul>
                                        </div>

                                        <!-- Lábios -->
                                        <div class="col-lg-3"><strong class="text-uppercase">Lábios</strong>
                                            <ul class="list-unstyled">
                                                <li><a href="">Batom Matte</a></li>
                                                <li><a href="">Batom Líquido Matte</a></li>
                                                <li><a href="">Batom Cremoso</a></li>
                                                <li><a href="">Contorno Labial</a></li>
                                                <li><a href="">Gloss</a></li>
                                                <li><a href="">Hidratante</a></li>
                                                <li><a href="">Batom Líquido Matte Metalizado</a></li>
                                                <!--<li><a href="index2.html"><span class="badge badge-success ml-2">New</span></a></li>
                                                <li><a href="index3.html"><span class="badge badge-success ml-2">New</span></a></li>-->
                                            </ul>
                                        </div>

                                        <!-- Olhos -->
                                        <div class="col-lg-3"><strong class="text-uppercase">Olhos</strong>
                                            <ul class="list-unstyled">
                                                <li><a href="">Delineador</a></li>
                                                <li><a href="">Máscara de Cílios</a></li>
                                                <li><a href="">Fixador | Primer</a></li>
                                                <li><a href="">Lápis</a></li>
                                                <li><a href="">Pigmento</a></li>
                                                <li><a href="">Glitter</a></li>
                                                <li><a href="">Sombras</a></li>
                                            </ul>
                                        </div>

                                        <!-- Sobrancelhas -->
                                        <div class="col-lg-3"><strong class="text-uppercase">Sobrancelhas</strong>
                                            <ul class="list-unstyled">
                                                <li><a href="">Iluminador</a></li>
                                                <li><a href="">Lápis</a></li>
                                                <li><a href="">Sombra</a></li>
                                                <li><a href="">Acessórios</a></li>
                                                <li><a href="">Delineador</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Icons de descontos -->
                                    <div class="row services-block">
                                        <div class="col-xl-3 col-lg-6 d-flex">
                                            <div class="item d-flex align-items-center">
                                                <div class="icon"><i class="icon-truck text-primary"></i></div>
                                                <div class="text"><span class="text-uppercase">Entregamos em todo Pais</span>
                                                    <small>Entrega via Correio</small>
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

                                <!-- Produto Destaque -->
                                <div class="col-lg-3 text-center product-col hidden-lg-down"><a href="" class="product-image"><img src="{{asset('img/product1.png')}}" class="img-fluid"></a>
                                    <h6 class="text-uppercase product-heading"><a href="">Catharine Hill Sombras 30
                                            cores</a></h6>
                                    <ul class="rate list-inline">
                                    </ul>
                                    <strong class="price text-primary">R$ 106,00</strong><a href="https://produto.mercadolivre.com.br/MLB-1023655655-catharine-hill-sombras-variadas-1017-paleta-de-sombras-_JM"
                                            class="btn btn-template wide" target="_blank">Adicionar ao Carrinho</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Pincel -->
                    <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" class="nav-link">Pincel<i class="fa fa-angle-down"></i></a>
                        <div class="dropdown-menu megamenu">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="row">
                                        <!-- Individual -->
                                        <div class="col-lg-3"><strong class="text-uppercase">Individual</strong>
                                            <ul class="list-unstyled">
                                                <li><a href="">Para Sombra</a></li>
                                                <li><a href="">Para Sombra</a></li>
                                                <li><a href="">Para Lábios</a></li>
                                                <li><a href="">Para Sobrancelhas</a></li>
                                                <li><a href="">Para Pó</a></li>
                                                <li><a href="">Para Blush | Contorno</a></li>
                                                <li><a href="">Para Base | Primer</a></li>
                                                <li><a href="">Para Delinear</a></li>
                                                <li><a href="">Para Iluminador</a></li>
                                                <li><a href="">Para Corretivo</a></li>
                                                <li><a href="">Para Aplicador | Esponja</a></li>
                                            </ul>
                                        </div>

                                        <!-- Kit -->
                                        <div class="col-lg-3"><strong class="text-uppercase">Kit</strong>
                                            <ul class="list-unstyled">
                                                <li><a href="">Para Face</a></li>
                                                <li><a href="">Para Olhos</a></li>
                                                <li><a href="">Completo</a></li>
                                                <li><a href="">Monte Seu Kit</a></li>
                                            </ul>
                                        </div>

                                        <!-- Higienizador -->
                                        <div class="col-lg-3"><strong class="text-uppercase">Higienizador</strong>
                                            <ul class="list-unstyled">
                                                <li><a href="">Pincel para Limpeza</a></li>
                                                <li><a href="">Algodão</a></li>
                                                <li><a href="">Esponja</a></li>
                                                <li><a href="">Spray</a></li>
                                                <li><a href="">Tapete</a></li>
                                            </ul>
                                        </div>

                                        <!-- Tratamento Facial -->
                                        <div class="col-lg-3"><strong class="text-uppercase">Tratamento Facial</strong>
                                            <ul class="list-unstyled">
                                                <li><a href="">Pele Mista | Oleosa</a></li>
                                                <li><a href="">Pele com Acne</a></li>
                                                <li><a href="">Todo Tipo de Pele</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Icons de descontos -->
                                    <div class="row services-block">
                                        <div class="col-xl-3 col-lg-6 d-flex">
                                            <div class="item d-flex align-items-center">
                                                <div class="icon"><i class="icon-truck text-primary"></i></div>
                                                <div class="text"><span class="text-uppercase">Entregamos em todo Pais</span>
                                                    <small>Entrega via Correio</small>
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
                                <div class="col-lg-3 text-center product-col hidden-lg-down"><a href="" class="product-image"><img src="{{asset('img/product3.png')}}" class="img-fluid"></a>
                                    <h6 class="text-uppercase product-heading"><a href="">Kit 12 Pinceis Pincel Macrilan
                                            Maquiagem E Necessaire Rosa</a></h6>
                                    <ul class="rate list-inline">
                                    </ul>
                                    <strong class="price text-primary">R$ 27,00</strong><a
                                            href="https://produto.mercadolivre.com.br/MLB-1023235686-kit-12-pinceis-pincel-macrilan-maquiagem-e-necessaire-rosa-_JM"
                                            class="btn btn-template wide" target="_blank">Adicionar ao Carrinho</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Paleta -->
                    <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" class="nav-link">Paletas<i class="fa fa-angle-down"></i></a>
                        <div class="dropdown-menu megamenu">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="row">
                                        <!-- Face -->
                                        <div class="col-lg-3"><strong class="text-uppercase">Paletas Para
                                                Maquiagem</strong>
                                            <ul class="list-unstyled">
                                                <li><a href="">Paleta de Base/Corretivo</a></li>
                                                <li><a href="">Paleta de Sombra</a></li>
                                                <li><a href="">Paleta de Base</a></li>
                                                <li><a href="">Paleta de Pó</a></li>
                                                <li><a href="">Paleta de Blush</a></li>
                                                <li><a href="">Paleta de Contorno</a></li>
                                                <li><a href="">Paleta de Iluminador</a></li>
                                                <li><a href="">&nbsp;</a></li>
                                                <li><a href="">&nbsp;</a></li>
                                                <li><a href="">&nbsp;</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Icons de descontos -->
                                    <div class="row services-block">
                                        <div class="col-xl-3 col-lg-6 d-flex">
                                            <div class="item d-flex align-items-center">
                                                <div class="icon"><i class="icon-truck text-primary"></i></div>
                                                <div class="text"><span class="text-uppercase">Entregamos em todo Pais</span>
                                                    <small>Entrega via Correio</small>
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
                                <div class="col-lg-3 text-center product-col hidden-lg-down"><a href="" class="product-image"><img src="{{asset('img/product2.png')}}" class="img-fluid"></a>
                                    <h6 class="text-uppercase product-heading"><a href="">Ruby Rose Base Liquida Matte
                                            L3</a></h6>
                                    <ul class="rate list-inline">
                                    </ul>
                                    <strong class="price text-primary">R$ 14,99</strong><a
                                            href="https://produto.mercadolivre.com.br/MLB-1044322474-ruby-rose-base-liquida-matte-l3-_JM"
                                            class="btn btn-template wide" target="_blank">Adicionar ao Carrinho</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Acessório -->
                    <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" class="nav-link">Acessórios<i class="fa fa-angle-down"></i></a>
                        <div class="dropdown-menu megamenu">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="row">
                                        <!-- Maquiagem -->
                                        <div class="col-lg-3"><strong class="text-uppercase">Maquiagem</strong>
                                            <ul class="list-unstyled">
                                                <li><a href="">Esponja | Aplicador</a></li>
                                                <li><a href="">Espelho</a></li>
                                                <li><a href="">Curvex</a></li>
                                                <li><a href="">Apontador</a></li>
                                                <li><a href="">Uso Profissional</a></li>
                                                <li><a href="">&nbsp;</a></li>
                                                <li><a href="">&nbsp;</a></li>
                                                <li><a href="">&nbsp;</a></li>
                                                <li><a href="">&nbsp;</a></li>
                                                <li><a href="">&nbsp;</a></li>
                                                <br>

                                            </ul>
                                        </div>

                                        <!-- Organizador -->
                                        <div class="col-lg-3"><strong class="text-uppercase">Organizador</strong>
                                            <ul class="list-unstyled">
                                                <li><a href="">Maletas de Maquiagem</a></li>
                                                <li><a href="">Acrílicos</a></li>
                                                <li><a href="">Nécessario | Case</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Icons de descontos -->
                                    <div class="row services-block">
                                        <div class="col-xl-3 col-lg-6 d-flex">
                                            <div class="item d-flex align-items-center">
                                                <div class="icon"><i class="icon-truck text-primary"></i></div>
                                                <div class="text"><span class="text-uppercase">Entregamos em todo Pais</span>
                                                    <small>Entrega via Correio</small>
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
                                <div class="col-lg-3 text-center product-col hidden-lg-down"><a href="" class="product-image"><img src="{{asset('img/product4.png')}}" class="img-fluid"></a>
                                    <h6 class="text-uppercase product-heading"><a href="">Kiss Delineador Em Gel 24h
                                            Preto</a></h6>
                                    <ul class="rate list-inline">
                                    </ul>
                                    <strong class="price text-primary">R$ 99,99</strong><a
                                            href="https://produto.mercadolivre.com.br/MLB-1024854469-le-vengee-kit-pincel-de-unicornio-c-10-_JM"
                                            class="btn btn-template wide" target="_blank">Adicionar ao Carrinho</a>
                                </div>
                            </div>
                        </div>
                    </li>

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
                                                <div class="text"><span class="text-uppercase">Entregamos em todo Pais</span>
                                                    <small>Entrega via Correio</small>
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
                                <div class="col-lg-3 text-center product-col hidden-lg-down"><a href="" class="product-image"><img src="{{asset('img/product5.png')}}" class="img-fluid"></a>
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
                        <a id="" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                            <i class="fa fa-user"></i>
                        </a>
                        <div aria-labelledby="" class="dropdown-menu">
                            <!-- user menu-->
                            @if(Auth::check())
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

                        <!-- cart itens-->
                        {{--<div aria-labelledby="cartdetails" class="dropdown-menu">
                            @if(Session::get('qtCart') == 0)
                                <!-- cart item-->
                                <div class="cart-product">
                                    <small>NÃO HA PRODUTOS NO CARRINHO&nbsp;<i class="fa fa-shopping-cart fa-2x">&nbsp;</i></small>
                                </div>
                            @else
                                <!-- cart item-->
                                    <div class="dropdown-item cart-product">
                                        <div class="d-flex align-items-center">
                                            <div class="img"><img src="{{asset('img/hoodie-man-1.png')}}" class="img-fluid"></div>
                                            <div class="details d-flex justify-content-between">
                                                <div class="text"><a href="#"><strong>Heather Gray Hoodie</strong></a>
                                                    <small>Quantity: 1</small>
                                                    <span class="price">$75.00 </span></div>
                                                <a href="#" class="delete"><i class="fa fa-trash-o"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- total price-->
                                    <div class="dropdown-item total-price d-flex justify-content-between">
                                        <span>Total </span><strong class="text-primary">&nbsp;&nbsp;$75.00</strong></div>
                                    <!-- call to actions-->
                                    <div class="dropdown-item CTA d-flex"><a href="cart.html" class="btn btn-template wide">View
                                            Cart</a><a href="checkout1.html" class="btn btn-template wide">Checkout</a>
                                    </div>
                            @endif
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>