@extends('layouts.app.app')

@section('content')

        <!-- Contact Section -->
        <section id="contact" class="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading" style="color: #d59431">Contato</h2>
                        <h3 class="text-muted" style="font-size: 18px">Envie-nos a sua mensagem, ajude-nos a melhorar.</h3>
                        <p>&nbsp;</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <form action="{{ route('enviar.email') }}" method="post" enctype="multipart/form-data">
                        {{--<form name="sentMessage" id="contactForm" >--}}
                            {{ csrf_field() }}
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nm_cliente" placeholder="Seu Nome *" id="name" required data-validation-required-message="Digite seu Name.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email_cliente" placeholder="Seu E-Mail *" id="email" required data-validation-required-message="Digite seu E-Mail.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <input type="tel" class="form-control" name="tel_cliente" placeholder="Seu Telefone *" id="phone" required data-validation-required-message="Digite seu Número de Telefone.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <textarea class="form-control" name="msg_cliente" placeholder="Sua Mensagem *" id="message" required data-validation-required-message="Digite sua Mensagem." rows="6" maxlength="1500" style="resize: none;"></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-lg-12 text-center">
                                    <div id="success"></div>
                                    <button type="submit" class="btn btn-template">Enviar Mensagem</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <p>&nbsp;</p>
            <p>&nbsp;</p>

            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 style="color: #d59431; font-size: 25px">Conheça nossa Loja Fisica</h2>
                        <p>&nbsp;</p>
                        <h3 class="section-subheading text-muted"></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="location" class="d-flex justify-content-center">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14583.307733368389!2d-46.3849294!3d-23.9665593!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6d544802d1b4e2b4!2sMaktub+Beauty!5e0!3m2!1spt-BR!2sbr!4v1533650947100" width="650" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<script>
    $(function(){

    });
</script>

@stop
