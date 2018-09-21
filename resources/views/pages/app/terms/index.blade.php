@extends('layouts.app.app')

@section('content')
    <style type="text/css">
        @import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        section{
            padding: 60px 0;
        }
        section .section-title{
            text-align:center;
            color:#d59431;
            margin-bottom:50px;
            text-transform:uppercase;
        }
        #what-we-do{
            background:#ffffff;
        }
        #what-we-do .card{
            padding: 1rem!important;
            border: none;
            margin-bottom:1rem;
            -webkit-transition: .5s all ease;
            -moz-transition: .5s all ease;
            transition: .5s all ease;
        }
        #what-we-do .card:hover{
            -webkit-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
            -moz-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
            box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
        }
        #what-we-do .card .card-block{
            padding-left: 50px;
            position: relative;
        }
        #what-we-do .card .card-block a{
            color: #d59431 !important;
            font-weight:700;
            text-decoration:none;
        }
        #what-we-do .card .card-block a i{
            display:none;

        }
        #what-we-do .card:hover .card-block a i{
            display:inline-block;
            font-weight:700;

        }
        #what-we-do .card .card-block:before{
            font-family: FontAwesome;
            position: absolute;
            font-size: 39px;
            color: #d59431;
            left: 0;
            -webkit-transition: -webkit-transform .2s ease-in-out;
            transition:transform .2s ease-in-out;
        }
        #what-we-do .card .block-1:before{
            content: "\f00c";
        }
        #what-we-do .card .block-2:before{
            content: "\f0eb";
        }
        #what-we-do .card .block-3:before{
            content: "\f023";
        }
        #what-we-do .card .block-4:before{
            content: "\f209";
        }
        #what-we-do .card .block-5:before{
            content: "\f0a1";
        }
        #what-we-do .card .block-6:before{
            content: "\f06b";
        }
        #what-we-do .card:hover .card-block:before{
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
            -webkit-transition: .5s all ease;
            -moz-transition: .5s all ease;
            transition: .5s all ease;
        }
    </style>

        <!-- Intro Section -->
    <section id="what-we-do">
        <div class="container-fluid">
            <h2 class="section-title mb-2 h2">Dúvidas</h2>
            <p class="text-center text-muted h5">Dúvidas sobre alguns de nossos serviços, respostas abaixo.</p>
            <div class="row mt-50">
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-block block-1">
                            <h3 class="card-title">Trocas e Devoluções</h3>
                            <p class="card-text">A partir da data de recebimento do produto, você tem 7 dias corridos para solicitar a devolução do pedido.</p>
                            <a class="read-more" >Saiba Mais<i class="fa fa-angle-double-right ml-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-block block-6">
                            <h3 class="card-title">Prazos e Entregas</h3>
                            <p class="card-text">A Lux Confort conta com prazo de entrega que varia de acordo com a sua região e a forma de envio selecionada.</p>
                            <a class="read-more" >Saiba Mais<i class="fa fa-angle-double-right ml-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-block block-3">
                            <h3 class="card-title">Loja Segura</h3>
                            <p class="card-text">A Lux Confort sempre estará preocupada em proteger seus dados com segurança e privacidade. Os seus dados cadastrais são armazenados de forma segura e sigilosa.</p>
                            <a class="read-more" >Saiba Mais<i class="fa fa-angle-double-right ml-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <div class="card">
                        <div class="card-block block-4">
                            <h3 class="card-title">Contato</h3>
                            <p class="card-text">Suporte de Segunda à Sábado.</p>
                            <a class="read-more" >Saiba Mais<i class="fa fa-angle-double-right ml-2"></i></a>
                        </div>
                    </div>
                </div>
        </div>
    </section>





@stop
