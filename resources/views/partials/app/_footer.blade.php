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
                            <h6 class="no-margin text-uppercase">Entregamos todo Brasil</h6><span>Entregas via Correio</span>
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
                        <img src="{{asset('img/app/core-img/logo1.png')}}">
                    </a>
                    <p></p>
                    <ul class="social-menu list-inline">
                        <li class="list-inline-item" style="font-size: 20px"><a href="https://www.facebook.com/MaktubBeauty/?ref=br_rs" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item" style="font-size: 20px"><a href="https://www.instagram.com/maktubbeauty/" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
                <div class="site-links col-lg-2 col-md-6">
                    <h5 class="text-uppercase">Dúvidas</h5>
                    <ul class="list-unstyled">
                        <li> <a href="{{route('terms.troca')}}">Trocas e Devoluções</a></li>
                        <li> <a href="{{route('terms.envios')}}">Prazos e Envios</a></li>
                        <li><a href="{{route('terms.lojasegura')}}">Loja Segura</a></li>
                        <li><a href="{{route('terms.contato')}}">Contato</a></li>
                    </ul>
                </div>
                <div class="site-links col-lg-2 col-md-6">
                    <h5 class="text-uppercase">Empresa</h5>
                    <ul class="list-unstyled">
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
                <div class="newsletter col-md-4">
                    <h5 class="text-uppercase">Nossa Loja Física</h5>
                    <div style="color: inherit;">Maktub Beauty a maior loja de maquiagem da baixada santista.</div>
                    <div style="color: inherit;">Localizada no centro de São Vicente.</div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyrights">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="text col-md-6">
                    <p style="color:#999">&copy; 2018  <a href="https://maktubbeauty.com.br/" target="_blank" style="color: #d59431; text-decoration: none">Maktub Beauty - Ecommerce</a> Todos os direitos reservados.</p>
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