@extends('layouts.admin.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-check-square-o"></i>&nbsp;&nbsp;Gerar Sorteio</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Sorteio</a></li>
                <li><a class="active">Gerar Sorteio</a></li>
            </ol>
        </section>

        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Gerar Sorteio</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="text-center">
                        <img src="{{asset('img/app/core-img/logo.png')}}">
                    </div>
                    <div class="text-center">
                        <div id="num_ganhador" hidden>
                            <p id="p_num_ganhador" style="font-size: 100px;">0</p>
                        </div>
                        <div id="nm_ganhador" hidden>
                            <p style="font-size: 26px">O Ganhador é:</p>
                            <p id="p_nm_ganhador" style="font-size: 40px"></p>
                        </div>
                        <br>
                        <div>
                            <button id="btn_sorteio" type="button" class="btn btn-warning" style="width: 200px"><i class="fa fa-diamond"></i>&nbsp;&nbsp;Sortear</button>
                        </div>
                        <div id="div_wpp" hidden>
                            <p style="font-size: 20px">Enviar mensagem no Whatsapp do ganhador:</p>
                            <button id="btn_msg_wpp" type="button" class="btn btn-primary" style="width: 200px;"><i class="fa fa-whatsapp"></i>&nbsp;&nbsp;Enviar Mensagem</button>
                        </div>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
        </section>

        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista dos participantes</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="text-align: left">Cupom</th>
                                <th style="text-align: left">Nome</th>
                                <th style="text-align: left">CPF</th>
                                <th style="text-align: left">Celular</th>
                                <th style="text-align: left">Email</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($cupom as $c)
                                    <tr>
                                        <td>{{$c->id_sorteio}}</td>
                                        <td>{{$c->nome}}</td>
                                        <td>{{$c->cpf}}</td>
                                        <td>{{$c->celular}}</td>
                                        <td>{{$c->email}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>


        $(function(){
            var arrayCupons = [];
            var arrayNomes = [];
            var arrayCelulares = [];
            carregaArray();
            function carregaArray(){

                @foreach($cupom as $c)
                    console.log({{$c->id_sorteio}});
                    arrayCupons.push('{{$c->id_sorteio}}');
                    arrayNomes.push('{{$c->nome}}');
                    arrayCelulares.push('{{$c->celular}}');
                @endforeach

            }

            let valor_ganhador = '';
            $('#btn_sorteio').click(function(){

                $(this).css('display', 'none');
                valor_ganhador = Math.floor((Math.random() * arrayCupons.length) + 1);

                //$('#p_num_ganhador').html(arrayCupons[valor_ganhador - 1]);
                $('#num_ganhador').removeAttr('hidden');
                $('#nm_ganhador').removeAttr('hidden');

                /*for(let i = 0; i <= arrayCupons[valor_ganhador - 1]; i++){
                    $('#p_num_ganhador').html(arrayCupons[i]);
                }*/
                //let i = 0;

                let menor_num = arrayCupons[0];
                let maior_num = arrayCupons[arrayCupons.length - 1];

                let contador = 0;

                let primeiro_intervalo = setInterval(function(){
                    let num_random = Math.floor((Math.random() * maior_num) + menor_num);

                    $('#p_num_ganhador').html(num_random);

                    contador++;
                    if(contador >= 30){
                        clearInterval(primeiro_intervalo);
                        $('#p_num_ganhador').html(arrayCupons[valor_ganhador - 1]);
                        $('#p_nm_ganhador').html(arrayNomes[valor_ganhador - 1]);
                        $('#btn_sorteio').attr('hidden', true);
                        $('#div_wpp').removeAttr('hidden');
                    }

                }, 150);


                /*var primeiro_intervalo = setInterval(function(){
                    console.log("valor i: " + i + ": valor ganhador: " + valor_ganhador);
                    $('#p_num_ganhador').html(arrayCupons[i]);
                    i++;

                    if(i == valor_ganhador) {
                        i=0;
                        var intervalo = setInterval(function(){
                            console.log("valor i: " + i + ": valor ganhador: " + valor_ganhador);
                            $('#p_num_ganhador').html(arrayCupons[i]);
                            i++;

                            if(i == valor_ganhador) {
                                clearInterval(intervalo);
                                $('#p_nm_ganhador').html(arrayNomes[valor_ganhador - 1]);
                            }
                        }, 150);

                        clearInterval(primeiro_intervalo);
                    }
                }, 150);*/
            });

            $('#btn_msg_wpp').click(function(){
                //console.log(arrayCelulares[valor_ganhador - 1]);

                let mensagem = "Parabéns%20você%20é%20o%20ganhador%20do%20sorteio%20do%20Shopping%20Vip-X,%20" +
                    "entre%20em%20contato%20através%20do%20WhatsApp%20em%20até%205%20dias%20e%20faça%20o%20seu%20agendamento%20" +
                    "no%20salão%20Maktub%20Beauty%20Care.%0A" +
                    "%0A" +
                    "Aproveite%20e%20conheça%20nosso%20novo%20site%20e%20nossos%20produtos%0A" +
                    "www.vipx.com.br%0A" +
                    "%0A" +
                    "Obrigado%20pela%20participação%20e%20não%20esqueça%20em%20breve%20mais%20sorteios%20Ao%20vivo%20no%20Instagram%0A" +
                    "www.instagram.com/maktubbeautycare/%20ou%20@maktubbeautycare." +
                    "%0A" +
                    "%0A%2AEm%2A%20%2Aapoio:%2A%20www.instagram.com/shoppingvipx/";

                let wpp = "https://api.whatsapp.com/send?phone=55" + arrayCelulares[valor_ganhador - 1] + "&text=" + mensagem;

                window.open(wpp, '_blank');

            });

        });
    </script>


@stop