<header class="header_area">

    <!-- Top Header Area Start -->

    <div class="top_header_area">

        <div class="container h-100">

            <div class="row h-100 align-items-center justify-content-end">


                <div class="col-12 col-lg-7">

                    <div class="top_single_area d-flex align-items-center">

                        <!-- Logo Area -->

                        <div class="top_logo">

                            <a href="#"><img src="{{ asset('img/app/core-img/logo.png') }}" alt=""></a>

                        </div>

                        <!-- Cart & Menu Area -->

                        <div class="header-cart-menu d-flex align-items-center ml-auto">

                            <!-- Cart Area -->

                            <div class="cart">

                                <a href="#" id="header-cart-btn" target="_blank"><span class="cart_quantity">2</span> <i
                                            class="fa fa-shopping-cart"></i> Carrinho R$20,00</a>
                                <!-- Cart List Area Start -->

                                <ul class="cart-list">

                                    <li>

                                        <a href="#" class="image"><img
                                                    src="{{ asset('img/app/product-img/product-10.jpg') }}"
                                                    class="cart-thumb" alt=""></a>

                                        <div class="cart-item-desc">

                                            <h6>
                                                <a href="#">
                                                    Womens Fashion
                                                </a>
                                            </h6>

                                            <p>1x - <span class="price">R$10</span></p>

                                        </div>

                                        <span class="dropdown-product-remove">
                                            <i class="icon-cross"></i>
                                        </span>

                                    </li>


                                    <li>

                                        <a href="#" class="image">
                                            <img src="{{ asset('img/app/product-img/product-11.jpg') }}"
                                                 class="cart-thumb" alt=""></a>

                                        <div class="cart-item-desc">

                                            <h6>
                                                <a href="#">
                                                    Womens Fashion
                                                </a>
                                            </h6>

                                            <p>1x - <span class="price">R$10</span></p>

                                        </div>

                                        <span class="dropdown-product-remove"><i class="icon-cross"></i></span>

                                    </li>

                                    <li class="total">

                                        <span class="pull-right">Total: R$20.00</span>

                                        <a href="cart.html" class="btn btn-sm btn-cart">
                                            Carrinho
                                        </a>

                                        <a href="checkout-1.html" class="btn btn-sm btn-checkout">
                                            Conferir
                                        </a>

                                    </li>

                                </ul>

                            </div>
                            <div class="header-right-side-menu ml-15">
                                <a href="{{ route('admin.login') }}">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </a>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Top Header Area End -->

    <div class="main_header_area">

        <div class="container h-100">

            <div class="row h-100">

                <div class="col-12 d-md-flex justify-content-between">

                    <!-- Header Social Area -->

                    <div class="header-social-area">

                        <a href="https://www.instagram.com/celestial_moda_evangelica/?hl=pt-br"><span
                                    class="karl-level">Compartilhar</span>
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                        </a>

                        <a href="https://www.facebook.com/Celestial-Moda-Evang%C3%A9lica-480913635394202/"><i
                                    class="fa fa-facebook" aria-hidden="true"></i></a>

                    </div>

                    <!-- Menu Area -->

                    <div class="main-menu-area">

                        <nav class="navbar navbar-expand-lg align-items-start">

                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#karl-navbar" aria-controls="karl-navbar" aria-expanded="false"
                                    aria-label="Toggle navigation"><span class="navbar-toggler-icon"><i
                                            class="ti-menu"></i></span></button>

                            <div class="collapse navbar-collapse align-items-start collapse" id="karl-navbar">

                                <ul class="navbar-nav animated" id="nav">

                                    <li class="nav-item active"><a class="nav-link" href="index.html">Início</a></li>

                                    <li class="nav-item dropdown">

                                        <a class="nav-link dropdown-toggle" href="#" id="karlDropdown" role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>

                                        <div class="dropdown-menu" aria-labelledby="karlDropdown">

                                            <a class="dropdown-item" href="index.html">Início</a>

                                            <a class="dropdown-item" href="shop.html">Shop</a>

                                            <a class="dropdown-item" href="product-details.html">Produtos em
                                                Destaque</a>

                                            <a class="dropdown-item" href="cart.html">Carrinho</a>

                                            <a class="dropdown-item" href="checkout.html">Checkout</a>

                                        </div>

                                    </li>

                                    <li class="nav-item"><a class="nav-link" href=" {{ route('admin.indexConfigproduto') }}">Vestidos</a></li>

                                    <li class="nav-item"><a class="nav-link" href="#">Sapatos</a></li>

                                    <li class="nav-item"><a class="nav-link" href="#">Contato</a></li>

                                </ul>

                            </div>

                        </nav>

                    </div>

                    <!-- Help Line -->

                    <div class="help-line">

                        <a href="tel:+346573556778"><i class="fa fa-whatsapp"></i>&nbsp &nbsp(13) 98858-6788</a>

                    </div>

                </div>

            </div>

        </div>

    </div>

    </div>

</header>
