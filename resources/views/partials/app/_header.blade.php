<script src="{{asset('js/app/popper.min.js')}}"></script>

<style>
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -8px;

    }

</style>


<header class="header_area">
    <!-- Top Header Area Start -->
    <div class="top_header_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-end">
                <div class="col-12 col-lg-12">
                    <div class="top_single_area d-flex align-items-center">
                        <!-- Logo Area -->
                        <div class="top_logo">
                            <a href="{{ route('index')}}"><img style="width: 110px" src="{{ asset('img/app/core-img/logo.png') }}" alt=""></a>
                        </div>
                        <form id="enviaFiltro" action="{{route('productsFilterCatSubCat.page')}}" method="post">
                            {{csrf_field()}}
                            <input type="text" id="cdVerificador" name="catSubCat" hidden>
                            <input type="text" id="cdCatSub" name="id" hidden>
                        </form>
                        <!--Carrinho e Menu -->
                        <div class="header-cart-menu d-flex align-items-center ml-auto">
                            <div class="main-menu-area">

                                <nav class="navbar navbar-expand-lg align-items-start">
                                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar1">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbar1" style="padding-right: 180px">
                                        <ul class="navbar-nav">
                                            <!-- Beleza e Saúde -->
                                            <li class="nav-item dropdown menuLi">
                                                <a href="#" id="menu" data-toggle="dropdown" class="nav-link dropdown-toggle corFundoPrincipal">Beleza e Saúde</a>
                                                <ul class="dropdown-menu menuUl">
                                                    <li id="c" class="dropdown-submenu">
                                                        <a id="10" href="#" data-toggle="dropdown" class="cormenu dropdown-item listagem">Maquiagem</a>
                                                        <ul class="dropdown-menu">
                                                            <li id="s">
                                                                <a id="31" href="#" class="cormenu dropdown-item listagem">Batom</a>
                                                            </li>
                                                            <li id="s">
                                                                <a id="7" href="#" class="dropdown-item listagem">Gloss</a>
                                                            </li>
                                                            <li id="s">
                                                                <a id="8" href="#" class="dropdown-item listagem">Base</a>
                                                            </li>
                                                            <li id="s">
                                                                <a id="9" href="#" class="dropdown-item listagem">Blush</a>
                                                            </li>
                                                            <li id="s">
                                                                <a id="10" href="#" class="dropdown-item listagem">Primer</a>
                                                            </li>
                                                            <li id="s">
                                                                <a id="11" href="#" class="dropdown-item listagem">Pó Compacto</a>
                                                            </li>
                                                            <li id="s">
                                                                <a id="12" href="#" class="dropdown-item listagem">Iluminador</a>
                                                            </li>
                                                            <li id="s">
                                                                <a id="13" href="#" class="dropdown-item listagem">Corretivo</a>
                                                            </li>
                                                            <li id="s">
                                                                <a id="14" href="#" class="dropdown-item listagem">Delineador</a>
                                                            </li>
                                                            <li id="s">
                                                                <a id="15" href="#" class="dropdown-item listagem">Máscara</a>
                                                            </li>
                                                            <li id="s">
                                                                <a id="16" href="#" class="dropdown-item listagem">Glitter</a>
                                                            </li>
                                                            <li id="s">
                                                                <a id="17" href="#" class="dropdown-item listagem">Sombras</a>
                                                            </li>
                                                            <li id="s">
                                                                <a id="18" href="#" class="dropdown-item listagem">Cílios</a>
                                                            </li>
                                                            <li id="s">
                                                                <a id="19" href="#" class="dropdown-item listagem">Lápis</a>
                                                            </li>
                                                            <li id="s">
                                                                <a id="20" href="#" class="dropdown-item listagem">Maletas</a>
                                                            </li>
                                                            <li id="s">
                                                                <a id="21" href="#" class="dropdown-item listagem">Pincel</a>
                                                            </li>
                                                            <li id="s">
                                                                <a id="22" href="#" class="dropdown-item listagem">Esmalte</a>
                                                            </li>
                                                            <li id="s">
                                                                <a id="23" href="#" class="dropdown-item listagem">Acessórios</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>

                                            <!-- Moda -->
                                            <li class="nav-item dropdown menuLi">
                                                <a href="#" id="menu" data-toggle="dropdown" class="nav-link dropdown-toggle corFundoPrincipal">Moda</a>
                                                <ul class="dropdown-menu menuUl">
                                                    <li id="c" class="dropdown-submenu">
                                                        <a id="14" href="#" data-toggle="dropdown" class="dropdown-item listagem">Masculino</a>
                                                        <ul class="dropdown-menu">
                                                            <li id="s">
                                                                <a id="24" href="#" class="dropdown-item listagem">Cuecas</a>
                                                            </li>
                                                            <li id="s">
                                                                <a id="25" href="#" class="dropdown-item listagem">Sungas</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li id="c" class="dropdown-submenu">
                                                        <a id="15" href="#" data-toggle="dropdown" class="dropdown-item listagem">Feminino</a>
                                                        <ul class="dropdown-menu">
                                                            <li id="s">
                                                                <a id="26" href="#" class="dropdown-item listagem">Vestido</a>
                                                            </li>
                                                            <li id="s">
                                                                <a id="27" href="#" class="dropdown-item listagem">Conjunto</a>
                                                            </li>
                                                        </ul>

                                                    </li>
                                                    <li id="c" class="dropdown-submenu">
                                                        <a href="#" data-toggle="dropdown" class="dropdown-item">Unissex</a>
                                                    </li>
                                                </ul>
                                            </li>

                                            <!-- Tecnologia -->
                                            <li class="nav-item dropdown menuLi">
                                                <a href="#" id="menu" data-toggle="dropdown" class="nav-link dropdown-toggle corFundoPrincipal">Tecnologia</a>
                                                <ul class="dropdown-menu menuUl">
                                                    <li id="c" class="dropdown-submenu">
                                                        <a id="13" href="#" data-toggle="dropdown" class="dropdown-item">Eletrônica</a>
                                                        <ul class="dropdown-menu">
                                                            <li id="s">
                                                                <a href="#" class="dropdown-item">LED</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>

                                            <!-- Promoção -->
                                            <li class="nav-item dropdown menuLi">
                                                <a href="#" id="menu" data-toggle="dropdown" class="nav-link dropdown-toggle corFundoPrincipal">Promoções</a>
                                                <ul class="dropdown-menu menuUl">
                                                    <li id="c" class="dropdown-submenu">
                                                        <a href="#" data-toggle="dropdown" class="dropdown-item">Kits e Combos</a>
                                                    </li>
                                                    <li id="c" class="dropdown-submenu">
                                                        <a href="#" data-toggle="dropdown" class="dropdown-item">Preço Baixo</a>
                                                    </li>
                                                    <li id="c" class="dropdown-submenu">
                                                        <a href="#" data-toggle="dropdown" class="dropdown-item">Outlet</a>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li class="nav-item dropdown menuLi">
                                                <a href="{{ route('products.page') }}" id="menu" class="nav-link corFundoPrincipal">Produtos</a>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>

                            <!-- Carrinho -->
                            <div class="cart">

                                @if(Session::get('qtCart') == 0)

                                    <a href="{{ route('cart.page') }}" id="header-cart-btn">
                                        <span class="cart_quantity">0</span>
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>

                                @else

                                    <a href="{{ route('cart.page') }}" id="header-cart-btn">
                                        <span class="cart_quantity">{{ Session::get('qtCart') }}</span>
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>

                                @endif

                                <!-- Cart List Area Start -->
                                <ul class="cart-list">
                                    <li>
                                        <a href="#" class="image">
                                            <img src="{{ asset('img/app/product-img/product-10.jpg') }}" class="cart-thumb" alt="">
                                        </a>
                                        <div class="cart-item-desc">
                                            <h6><a href="#">Womens Fashion</a></h6>
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
                                            <h6><a href="#">Womens Fashion</a></h6>
                                            <p>1x - <span class="price">R$10</span></p>
                                        </div>
                                        <span class="dropdown-product-remove"><i class="icon-cross"></i></span>
                                    </li>
                                    <li class="total">
                                        <span class="pull-right">Total: R$20.00</span>
                                        <a href="#" class="btn btn-sm btn-cart">Carrinho</a>
                                        <a href="#" class="btn btn-sm btn-checkout">Conferir</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="header-right-side-menu ml-15">
                                <div class="dropdown show">
                                    <a href="javascript:void(0);" class="dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        @if(Auth::check())
                                            <span>&nbsp;{{ $nome }}</span>
                                        @endif
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        @if(Auth::check())

                                            <a class="dropdown-item" href="{{ route('client.dashboard') }}">Minha Conta</a>
                                            <a class="dropdown-item" href="{{ route('client.logout') }}">Sair</a>

                                        @else

                                            <a class="dropdown-item" href="{{ route('client.login') }}">Fazer login</a>
                                            <a class="dropdown-item" href="{{ route('client.register') }}">Cadastrar</a>

                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    //expande o submenu quando passar o mouse em cima do menu
    $('.dropdown-submenu > a').on("mouseover", function(e) {
        var submenu = $(this);
        $('.dropdown-submenu .dropdown-menu').removeClass('show');
        submenu.next('.dropdown-menu').addClass('show');
        e.stopPropagation();
    });

    //esconde os menus quando o pai fecha
    $('.dropdown').on("hidden.bs.dropdown", function() {
        $('.dropdown-menu.show').removeClass('show');
    });

    //esconde o submenu quando o mouse sai dele
    $('.dropdown-submenu > ul').on("mouseleave", function() {
        $('.dropdown-submenu > ul').removeClass('show');
    });

    /*$('.corFundoPrincipal').on('mouseover', function(){
        //console.log($(this).siblings('.dropdown-menu'));
        //$(this).siblings().find('.dropdown-menu').addClass('show');
    });*/

    //esconder o menu e submenu quando o mouse sair dele
    $('.dropdown-menu').on('mouseleave', function(){
        $(this).removeClass('show');
    });

    $('.corFundoPrincipal').on('mouseover', function(){
       /* $(this).css('background-color', '#d33889');
        $(this).css('color', 'white');*/
    });

    $('.menuLi').on('mouseover', function(){
        $(this).parent().addClass('show');
        $(this).find('.menuUl').addClass('show');
    });

    $('.menuLi').on('mouseleave', function(){
        $(this).parent().removeClass('show');
        $('.menuLi').find('.menuUl').removeClass('show');
    });

    $('.corFundoPrincipal').on('mouseleave', function(){
       /* $(this).css('background-color', '#f5f5f5');
        $(this).css('color', '#212529');*/
        /*$(this).parent().removeClass('show');
        $(this).siblings('.dropdown-menu').removeClass('show');*/
    });

    $('.listagem').click(function(){
        var catSubCat= $(this).attr('id');
        var id = $(this).parent().attr('id');

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $('#cdVerificador').val(catSubCat);
        $('#cdCatSub').val(id);

        console.log($('#cdVerificador').val());
        console.log($('#cdCatSub').val());

        $('#enviaFiltro').submit();

    });

    $(document).ready(function(){
        $('.dropdown-submenu a.test').on("click", function(e){
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
        });
    });

</script>
