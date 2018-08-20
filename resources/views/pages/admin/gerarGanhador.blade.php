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

        <!--SESSÃO DO SORTEIO-->
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
                    <div>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modal_configuracao" title="Configuração">
                            <span class="fa fa-cog pull-right" style="font-size: 22px;"></span>
                        </a>
                    </div>
                    <div class="text-center">
                        <img src="{{asset('img/app/core-img/logo1.png')}}">
                    </div>
                    <div class="row">
                        <div id="div_nome_premio" class="col-lg-4 col-lg-offset-4">
                            <div class="form-group">
                                <p>Informe o nome do prêmio:</p>

                                    <input id="premio_ganhador" type="text" class="form-control">

                            </div>
                        </div>
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
        <!-- FIM SESSÃO SORTEIO -->

        <!-- MODAL CONFIGURAÇÃO DE PÚBLICO -->
        <div class="modal fade" id="modal_configuracao">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Público do Sorteio</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <p>Escolha o público que irá participar do sorteio: </p>
                            @if(count($publico) == 0)
                                <input type="radio" id="radioMasculino" name="genero" value="0">
                                <label for="radioMasculino">Masculino</label><br/>
                                <input type="radio" id="radioFeminino" name="genero" value="1">
                                <label for="radioFeminino">Feminino</label><br/>
                                <input type="radio" id="radioAmbos" name="genero" value="2">
                                <label for="radioAmbos">Ambos</label>
                            @elseif($publico[0]->ic_configuracao_sorteio == 0)
                                <input type="radio" id="radioMasculino" name="genero" value="0" checked>
                                <label for="radioMasculino">Masculino</label><br/>
                                <input type="radio" id="radioFeminino" name="genero" value="1">
                                <label for="radioFeminino">Feminino</label><br/>
                                <input type="radio" id="radioAmbos" name="genero" value="2">
                                <label for="radioAmbos">Ambos</label>
                            @elseif($publico[0]->ic_configuracao_sorteio == 1)
                                <input type="radio" id="radioMasculino" name="genero" value="0">
                                <label for="radioMasculino">Masculino</label><br/>
                                <input type="radio" id="radioFeminino" name="genero" value="1" checked>
                                <label for="radioFeminino">Feminino</label><br/>
                                <input type="radio" id="radioAmbos" name="genero" value="2">
                                <label for="radioAmbos">Ambos</label>
                            @else
                                <input type="radio" id="radioMasculino" name="genero" value="0">
                                <label for="radioMasculino">Masculino</label><br/>
                                <input type="radio" id="radioFeminino" name="genero" value="1">
                                <label for="radioFeminino">Feminino</label><br/>
                                <input type="radio" id="radioAmbos" name="genero" value="2" checked>
                                <label for="radioAmbos">Ambos</label>
                            @endif
                        </div>

                        <p>&nbsp;</p>
                        <div class="row">
                            <p>Para que os ganhadores possam participar no sorteio novamente, clique no botão abaixo.</p>
                            <button id="btn_resetar_ganhador" type="text" class="btn btn-primary">
                                <i class="fa fa-refresh"></i>&nbsp;&nbsp;
                                Resetar Ganhadores</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn_sair_modal" type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                        <button id="btn_salvar_publico" type="button" class="btn btn-primary">Salvar Público</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIM DO MODAL -->

        <!-- SESSÃO DA LISTA DOS PARTICIPANTES -->
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
        <!--  FIM SESSÃO DA LISTA -->
    </div>

    <script src="{{asset('js/admin/sweetalert.min.js')}}"></script>
    <script>


        $(function(){
            var arrayCupons = [];
            var arrayNomes = [];
            var arrayCelulares = [];
            carregaArray();
            //======================================================================================================
            //FUNÇÃO QUE POPULA OS ARRAYS AO CARREGAR A PÁGINA
            function carregaArray(){

                @foreach($participantes_sorteio as $c)
                    console.log({{$c->id_sorteio}});
                    arrayCupons.push('{{$c->id_sorteio}}');
                    arrayNomes.push('{{$c->nome}}');
                    arrayCelulares.push('{{$c->celular}}');
                @endforeach

            }

            //======================================================================================================
            //BOTÃO PARA GERAR O SORTEIO
            let valor_ganhador = '';
            $('#btn_sorteio').click(function(){

                if($('#premio_ganhador').val() == ""){
                    swal('Ops', 'O prêmio do ganhador não foi escrito.', 'warning');
                }
                else {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $(this).css('display', 'none');
                    $('#div_nome_premio').attr('hidden', true);
                    valor_ganhador = Math.floor((Math.random() * arrayCupons.length) + 1);

                    $('#num_ganhador').removeAttr('hidden');
                    $('#nm_ganhador').removeAttr('hidden');

                    let menor_num = arrayCupons[0];
                    let maior_num = arrayCupons[arrayCupons.length - 1];

                    let contador = 0;

                    let primeiro_intervalo = setInterval(function () {
                        let num_random = Math.floor((Math.random() * maior_num) + menor_num);

                        $('#p_num_ganhador').html(num_random);

                        contador++;
                        if (contador >= 30) {
                            clearInterval(primeiro_intervalo);
                            $('#p_num_ganhador').html(arrayCupons[valor_ganhador - 1]);
                            $('#p_nm_ganhador').html(arrayNomes[valor_ganhador - 1]);
                            $('#btn_sorteio').attr('hidden', true);
                            $('#div_wpp').removeAttr('hidden');

                            $.ajax({
                                url: '{{route('lottery.save.winner')}}',
                                type: 'post',
                                data: {_token: CSRF_TOKEN, cupom: arrayCupons[valor_ganhador - 1]},
                                success: function(data){
                                    console.log(data);
                                }
                            })
                        }

                    }, 150);
                }
            });

            //======================================================================================================
            //BOTÃO PARA ENVIAR MENSAGEM PARA O GANHADOR DO SORTEIO
            $('#btn_msg_wpp').click(function(){

                let premio = $("#premio_ganhador").val().toUpperCase();

                let mensagem = "Parabéns%20você%20é%20o%20ganhador%20do%20sorteio%20do%20Shopping%20Vip-X,%20" +
                    "entre%20em%20contato%20através%20do%20WhatsApp%20em%20até%205%20dias%20e%20faça%20o%20seu%20agendamento%20" +
                    "no%20salão%20Maktub%20Beauty%20Care.%0A" +
                    "%0A" +
                    "Seu%20prêmio:%20%2A" + premio + ".%2A%0A" +
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

            //======================================================================================================
            //BOTÃO PARA SALVAR O PUBLICO DO SORTEIO
            $('#btn_salvar_publico').click(function(){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                let publico = '';
                if($('#radioMasculino').is(':checked')){
                    publico = $('#radioMasculino').val();
                }
                else if($('#radioFeminino').is(':checked')){
                    publico = $('#radioFeminino').val();
                }
                else{
                    publico = $('#radioAmbos').val();
                }

                $.ajax({
                    url: '{{route('lottery.save.public')}}',
                    type: 'post',
                    data: {_token: CSRF_TOKEN, publico: publico},
                    success: function(data){
                        if(data.deuErro == false){
                            swal('Sucesso', 'Público salvo com sucesso.', 'success').then(()=>{
                                window.location.href = '{{route('lottery.prize.page')}}';
                            });
                        }
                        else{
                            swal('Erro', 'Erro ao salvar público.', 'error').then(()=>{
                                window.location.href = '{{route('lottery.prize.page')}}';
                            });
                        }
                    }
                })

            });


            //======================================================================================================
            //BOTÃO PARA SAIR DO MODAL
            $('#btn_sair_modal').click(function(){

            });

            //======================================================================================================
            //BOTÃO PARA RESETAR OS GANHADORES
            $('#btn_resetar_ganhador').click(function(){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: '{{route('lottery.reset.winner')}}',
                    type: 'post',
                    data: {_token: CSRF_TOKEN},
                    success: function(data){
                        if(data.deuErro == false){
                            swal('Sucesso', 'Ganhadores resetados com sucesso.', 'success').then(()=>{
                                window.location.href = '{{route('lottery.prize.page')}}';
                            });
                        }
                        else{
                            swal('Erro', 'Erro ao resetar ganhadores.', 'error').then(()=>{
                                window.location.href = '{{route('lottery.prize.page')}}';
                            });
                        }
                    }
                })
            });

        });
    </script>


@stop