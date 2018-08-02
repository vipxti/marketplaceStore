<!--logo-->
<style type="text/css">
    #logoMK {
        display: inline-block;
        margin-left: 10%;
    }
    .maktub {
        font-family: "Jonah_DEMO"!important;
        font-weight: bold;
        font-stretch: expanded;
        font-size: 2.8em !important;
        color: rgb(213, 148, 49);
        -moz-transform: matrix( 1.29504084392096,0,0,1.07351221611133,0,0);
        -webkit-transform: matrix( 1.29504084392096,0,0,1.07351221611133,0,0);
        -ms-transform: matrix( 1.29504084392096,0,0,1.07351221611133,0,0);
        margin: 0 0 0 0 !important;
    }
    .beauty {
        margin: -5% 0 0 58%;
        font-family: "Jonah_DEMO"!important;
        font-size: 2.2em !important;
        color: rgb(255, 255, 255);
        -moz-transform: matrix( 0.78480609431106,0,0,0.78480609431106,0,0);
        -webkit-transform: matrix( 0.78480609431106,0,0,0.78480609431106,0,0);
        -ms-transform: matrix( 0.78480609431106,0,0,0.78480609431106,0,0);
    }
    footer.main-footer .main-block{
        padding-bottom: 4% !important;
    }
    .text-uppercase{
        margin-top: 15px !important;
    }
</style>

<!-- Footer-->
<footer class="main-footer">
    <!-- Service Block-->
    <div class="services-block">
        <div class="container">
            <div class="row">
                <!-- frete Grátis -->
                <div class="col-lg-4 d-flex justify-content-center justify-content-lg-start">
                    <div class="item d-flex align-items-center">
                        <div class="icon"><i class="icon-truck"></i></div>
                        <div class="text">
                            <h6 class="no-margin text-uppercase">Entregamos em todo Pais</h6><span>Entrega via Correio</span>
                        </div>
                    </div>
                </div>

                <!-- Pagamento Seguro -->
                <div class="col-lg-4 d-flex justify-content-center">
                    <div class="item d-flex align-items-center">
                        <div class="icon"><i class="icon-secure-shield"></i></div>
                        <div class="text">
                            <h6 class="no-margin text-uppercase">Pagamento Seguro</h6><span>PagSeguro</span>
                        </div>
                    </div>
                </div>

                <!-- Suporte -->
                <div class="col-lg-4 d-flex justify-content-center">
                    <div class="item d-flex align-items-center">
                        <div class="icon"><i class="icon-headphones"></i></div>
                        <div class="text">
                            <h6 class="no-margin text-uppercase">13 97424-8882</h6><span>Suporte de Segunda à Sábado</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Block -->
    <div class="main-block">
        <div class="container">
            <div class="row">
                <div class="info col-lg-4">
                    <a href="{{ route('index')}}" class="navbar-brand">
                        <div id="logoMK">
                            <div class="maktub">MAKTUB</div>
                            <div class="beauty">BEAUTY</div>
                        </div>
                        {{--<img src="{{asset('img/app/core-img/logo.png')}}">--}}
                    </a>
                    <p></p>
                    <ul class="social-menu list-inline">
                        <li class="list-inline-item"><a href="https://www.facebook.com/MaktubBeauty/?ref=br_rs" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item" ><a href="https://www.instagram.com/maktubbeauty/" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li>
                        <li class="list-inline-item" ><a href="#" target="_blank" title="Instagram"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
                <div class="site-links col-lg-2 col-md-6">
                    <h5 class="text-uppercase">Dúvidas</h5>
                    <ul class="list-unstyled">
                        <li> <a href="#">Trocas e Devoluções</a></li>
                        <li> <a href="#">Prazos e Envios</a></li>
                        <li><a href="#">Loja Segura</a></li>
                    </ul>
                </div>
                <div class="site-links col-lg-2 col-md-6">
                    <h5 class="text-uppercase">Empresa</h5>
                    <ul class="list-unstyled">
                        {{--<li><a href="#">Central de Atendimento</a></li>--}}
                        <li><a href="{{route('company.terms')}}">Quem Somos</a></li>
                        @if(Auth::check())
                            <li>
                                <a href="{{ route('client.dashboard') }}">Minha Conta</a>
                            </li>
                            <li>
                                <a href="{{ route('client.logout') }}">Sair</a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('client.login') }}">Fazer login</a>
                            </li>
                            <li>
                                <a href="{{ route('client.register') }}">Cadastrar-se</a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="newsletter col-lg-4">
                    <h5 class="text-uppercase">Assine a nossa newsletter</h5>
                    <p style="color: #d59431">Deixe seu e-mail e receba os melhores preços e ofertas.</p>
                    <form action="#" id="newsletter-form">
                        <div class="form-group">
                            <input type="email" name="subscribermail" placeholder="Digite seu email aqui">
                            <button type="submit"> <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="copyrights">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="text col-md-6">
                    <p>&copy; 2018  <a href="https://vipx.com.br" target="_blank" style="color: #d59431; text-decoration: none">Vip-X Marketplace </a> Todos os direitos reservados.</p>
                </div>
                <div class="payment col-md-6 clearfix">
                    <ul class="payment-list list-inline-item pull-right">
                        <li class="list-inline-item"><img src="{{asset('img/app/bg-img/visa.svg')}}"></li>
                        <li class="list-inline-item"><img src="{{asset('img/app/bg-img/mastercard.svg')}}"></li>
                        <li class="list-inline-item"><img src="{{asset('img/app/bg-img/paypal.svg')}}"></li>
                        <li class="list-inline-item"><img src="{{asset('img/app/bg-img/western-union.svg')}}"></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>