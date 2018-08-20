@extends('layouts.admin.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-user-plus"></i>&nbsp;&nbsp;Participante</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Sorteio</a></li>
                <li><a class="active">Cadastrar Participante</a></li>
            </ol>
        </section>

        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Consultar Participante</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CPF do Participante</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>
                                    <input id="cpf_participante" type="text" class="form-control" required
                                           data-inputmask='"mask": "999.999.999-99"' data-mask>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" style="margin-top: 26px;">
                                <button id="btnConsultarParticipante" type="button" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp;&nbsp;Consultar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Cadastrar Participante</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <input id="id_participante" type="text" hidden>
                    <form id="formParticipante" action="{{route('lottery.save.participant')}}" method="post">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input id="nm_participante" type="text" class="form-control" name="nome" required maxlength="50">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-at"></i></span>
                                        <input id="email_participante" type="email" class="form-control" name="email" maxlength="50">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>CPF</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>
                                        <input id="cpf" type="text" class="form-control" required name="cpf"
                                               data-inputmask='"mask": "999.999.999-99"' data-mask>
                                    </div>
                                    <i id="msg_cpf"></i>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Whatsapp</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-whatsapp"></i></span>
                                        <input id="wpp_participante" type="text" class="form-control" required name="celular"
                                               data-inputmask='"mask": "(99) 99999-9999"' data-mask>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gênero</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-universal-access"></i></span>
                                        <select id="genero_participante" class="form-control" required name="genero">
                                            <option value=""></option>
                                            <option value="0">Masculino</option>
                                            <option value="1">Feminino</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>&nbsp;</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group text-right">
                                    <button id="btnAlterarParticipante" type="button"
                                            class="btn btn-primary pull-left" style="display: none">
                                            <i class="fa fa-save"></i>
                                            &nbsp;&nbsp;Alterar
                                    </button>
                                    <button id="btnParticiparSorteio" type="button"
                                            class="btn btn-warning pull-right" style="display: none">
                                            <i class="fa fa-save"></i>
                                            &nbsp;&nbsp;Participar Sorteio
                                    </button>
                                    <button id="btnSalvarAlteracao" type="button"
                                            class="btn btn-success pull-right" style="display: none">
                                            <i class="fa fa-save"></i>
                                            &nbsp;&nbsp;Salvar Alterações
                                    </button>
                                    <button id="btnSalvarParticipante" type="button" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

    <script src="{{ asset('js/admin/select2.full.min.js') }}"></script>
    <script src="{{asset('js/admin/sweetalert.min.js')}}"></script>
    <script>
        $(function(){
            //=====================================================================================================
            //INICIALIZA A MÁSCARA DOS CAMPOS
            $('.select2').select2();
            $('[data-mask]').inputmask();

            //=====================================================================================================
            //AO PERDER O FOCO DO CAMPO CPF VERIFICA SE OS DADOS PREENCHIDOS ESTÃO CORRETOS
            $('#cpf').blur(function(e){
                e.preventDefault();
                var cpf_cnpj = $(this).val().replace(/\D/g, '');
                //console.log(cpf_cnpj);
                var cpfValido = validarCPF(cpf_cnpj);
                $('#msg_cpf').html("");

                if(!cpfValido && cpf_cnpj != "") {
                    $('#msg_cpf').html("CPF/CNPJ inválido.").css("color", "red").css("font-size", "small");
                    $("#btnSalvarParticipante").attr("disabled", "disabled");
                }
                else if(cpf_cnpj.length < 11 && cpf_cnpj.length > 0){
                    $('#msg_cpf').html("CPF/CNPJ inválido.").css("color", "red").css("font-size", "small");
                    $("#btnSalvarParticipante").attr("disabled", "disabled");
                }
                else if(cpf_cnpj.length == 11){
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('lottery.consult.cpf.participant') }}',
                        type: 'post',
                        data: {_token: CSRF_TOKEN, cpf: cpf_cnpj},
                        success: function(data){
                            if(data.cpf_cnpj.length > 0){
                                $('#msg_cpf').html("CPF/CNPJ já existente.").css("color", "red").css("font-size", "small");
                                $("#btnSalvarParticipante").attr("disabled", "disabled");
                            }
                            else{
                                console.log("passou");
                                $("#btnSalvarParticipante").removeAttr("disabled");
                            }
                        }
                    });
                }

            });

            //=====================================================================================================
            //FUNÇÃO PARA VALIDAÇÃO DO CPF
            function validarCPF(cpf){
                var numeros, digitos, soma, i, resultado, digitos_iguais;
                digitos_iguais = 1;
                if (cpf.length < 11)
                    return false;
                for (i = 0; i < cpf.length - 1; i++)
                    if (cpf.charAt(i) != cpf.charAt(i + 1))
                    {
                        digitos_iguais = 0;
                        break;
                    }
                if (!digitos_iguais)
                {
                    numeros = cpf.substring(0,9);
                    digitos = cpf.substring(9);
                    soma = 0;
                    for (i = 10; i > 1; i--)
                        soma += numeros.charAt(10 - i) * i;
                    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                    if (resultado != digitos.charAt(0))
                        return false;
                    numeros = cpf.substring(0,10);
                    soma = 0;
                    for (i = 11; i > 1; i--)
                        soma += numeros.charAt(11 - i) * i;
                    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                    if (resultado != digitos.charAt(1))
                        return false;
                    return true;
                }
                else
                    return false;
            }

            //=====================================================================================================
            //BOTÃO PARA SALVAR O CLIENTE
            $('#btnSalvarParticipante').click(function(){
                let id_participante = $('#id_participante').val();
                let nome_participante = $('#nm_participante').val();
                let email_participante = $('#email_participante').val();
                let cpf_participante = $('#cpf').val();
                let wpp_participante = $('#wpp_participante').val();
                let genero_participante = $('#genero_participante').val();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                if(nome_participante == "" || cpf_participante=="" ||
                    wpp_participante == "" || genero_participante==""){
                    swal('Ops', 'Um dos campos obrigatórios não foi preenchido.', 'warning');
                }
                else {

                    $.ajax({
                        url: '{{route('lottery.save.participant')}}',
                        type: 'post',
                        data: {
                            _token: CSRF_TOKEN, id: id_participante, nome: nome_participante, email: email_participante,
                            cpf: cpf_participante, celular: wpp_participante, genero: genero_participante
                        },
                        success: function (data) {
                            console.log(data);
                            if (data.deuErro == false) {
                                swal({
                                    title: "Sucesso",
                                    text: "Dados do participante salvo com sucesso!\n" +
                                    "Seu número do cupom é: " + data.cupom.id_sorteio,
                                    icon: "success",
                                    buttons: {
                                        wpp_button: {
                                            text: "Mensagem Whatsapp",
                                            value: 1,
                                            visible: true
                                        },
                                        ok_button: {
                                            text: "Ok",
                                            value: 0,
                                            visible: true
                                        }
                                    }
                                })
                                    .then((valor) => {
                                        switch (valor) {
                                            case 0:
                                                swal({
                                                    title: "Atenção",
                                                    text: "Seu número do cupom é: " + data.cupom.id_sorteio,
                                                    icon: "info"
                                                })
                                                    .then(() => {
                                                        window.location.href = '{{route('lottery.participant.page')}}';
                                                    });

                                                break;
                                            case 1:

                                                let mensagem = "Olá,%20%2A" + data.dados_cliente.nome + "%2A%20agora%20o%20Sr(a)%20está%20participando%20de%20nosso%20sorteio%20Shopping%20Vip-X%20" +
                                                    "e%20o%20seu%20cupom%20de%20sorteio%20é%20o%20%2Anúmero%2A%20%2A" + data.cupom.id_sorteio + ".%2A%0A" +
                                                    "%0A" +
                                                    "Acompanhe%20diariamente%20os%20sorteios%20Ao%20Vivo%20no%20nosso%20Instagram%20www.instagram.com/maktubbeautycare/%20ou%20" +
                                                    "@maktubbeautycare.%0A" +
                                                    "%0A" +
                                                    "Serão%20sorteios%20diários%20de%20até%205%20unhas%20por%20dia%20e%201%20sorteio%20semanal%20de%20Alongamento%20de%20Cílios,%20" +
                                                    "Hidratação%20com%20Escova,%20Designer%20de%20Sobrancelha%20e%20Maquiagem%20Expressa.%0A" +
                                                    "%0A" +
                                                    "Aproveite%20e%20conheça%20nosso%20novo%20site:%20www.vipx.com.br,%20use%20o%20%2Acupom%2A%20%2AVIPX5%2A%20em%20suas%20compres%20online%20" +
                                                    "e%20ganhe%2010%25%20de%20desconto." +
                                                    "%0A" +
                                                    "%0A%2AEm%2A%20%2Aapoio:%2A%20https://www.instagram.com/shoppingvipx/";

                                                let wpp = "https://api.whatsapp.com/send?phone=55" + data.dados_cliente.celular + "&text=" + mensagem;

                                                window.open(wpp, '_blank');

                                                window.location.href = '{{route('lottery.participant.page')}}';

                                                break;
                                        }

                                    });
                            }
                            else {
                                swal({
                                    title: "Erro",
                                    text: "Erro ao salvar dados do participante.",
                                    icon: "error"
                                })
                                    .then(() => {
                                        window.location.href = '{{route('lottery.participant.page')}}';
                                    });
                            }
                        }
                    });
                }
            });

            //=====================================================================================================
            //BOTÃO PARA CONSULTAR O CLIENTE PELO CPF
            $('#btnConsultarParticipante').click(function(){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var cpf_participante = $('#cpf_participante').val().replace(/\D/g, '');

                if(cpf_participante != "") {
                    $.ajax({
                        url: '{{route('lottery.consult.cpf.participant')}}',
                        type: 'post',
                        data: {_token: CSRF_TOKEN, cpf: cpf_participante},
                        success: function (data) {
                            if (data.cpf_cnpj.length > 0) {
                                console.log("existe cliente");
                                console.log(data);

                                $('#id_participante').val(data.cpf_cnpj[0].id).attr('readonly', true);
                                $('#nm_participante').val(data.cpf_cnpj[0].nome).attr('readonly', true);
                                $('#email_participante').val(data.cpf_cnpj[0].email).attr('readonly', true);
                                $('#cpf').val(data.cpf_cnpj[0].cpf).attr('readonly', true);
                                $('#wpp_participante').val(data.cpf_cnpj[0].celular).attr('readonly', true);
                                $('#genero_participante').val(data.cpf_cnpj[0].ic_genero).attr('disabled', true);

                                $('#btnSalvarParticipante').attr('disabled', true).css('display', 'none');
                                $('#btnAlterarParticipante').css('display', 'block');
                                $('#btnParticiparSorteio').css('display', 'block');
                                $('#msg_cpf').css('display', 'none');
                            }
                            else {
                                swal('Ops', 'Participante ainda não cadastrado.', 'info');
                                $('#cpf').val(cpf_participante);
                            }
                        }
                    });
                }
                else{
                    $('#id_participante').val("").removeAttr('readonly');
                    $('#nm_participante').val("").removeAttr('readonly');
                    $('#email_participante').val("").removeAttr('readonly');
                    $('#cpf').val("").removeAttr('readonly');
                    $('#wpp_participante').val("").removeAttr('readonly');
                    $('#genero_participante').val("").removeAttr('disabled');

                    $('#btnSalvarParticipante').removeAttr('disabled').css('display', 'block');
                    $('#btnAlterarParticipante').css('display', 'none');
                    $('#btnParticiparSorteio').css('display', 'none');
                    $('#msg_cpf').css('display', 'block');
                }
            });

            $('#cpf_participante').keypress(function () {
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13'){
                    $('#btnConsultarParticipante').click();
                }
            });

            //=====================================================================================================
            //BOTÃO PARA HABILITAR A EDIÇÃO DOS DADOS DO PARTICIPANTE
            $('#btnAlterarParticipante').click(function(){
                $('#nm_participante').removeAttr('readonly').focus();
                $('#email_participante').removeAttr('readonly');
                $('#wpp_participante').removeAttr('readonly');
                $('#genero_participante').removeAttr('disabled');

                $('#btnAlterarParticipante').css('display', 'none');
                $('#btnParticiparSorteio').css('display', 'none');
                $('#btnSalvarAlteracao').css('display', 'block');
            });

            //=====================================================================================================
            //BOTÃO PARA SALVAR AS ALTERAÇÕES DOS DADOS DO PARTICIPANTE
            $('#btnSalvarAlteracao').click(function(){
                let id_participante = $('#id_participante').val();
                let nome_participante = $('#nm_participante').val();
                let email_participante = $('#email_participante').val();
                let cpf_participante = $('#cpf').val();
                let wpp_participante = $('#wpp_participante').val();
                let genero_participante = $('#genero_participante').val();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


                if(nome_participante == "" || cpf_participante=="" ||
                    wpp_participante == "" || genero_participante==""){
                    swal('Ops', 'Um dos campos obrigatórios não foi preenchido.', 'warning');
                }
                else {
                    $.ajax({
                        url: '{{route('lottery.update.participant')}}',
                        type: 'POST',
                        data: {
                            _token: CSRF_TOKEN, id: id_participante, nome: nome_participante, email: email_participante,
                            cpf: cpf_participante, celular: wpp_participante, genero: genero_participante
                        },
                        success: function (data) {
                            if (data.deuErro == false) {
                                swal({
                                    title: "Sucesso",
                                    text: "Dados do participante atualizado com sucesso!",
                                    icon: "success"
                                })
                                    .then(() => {
                                        window.location.href = '{{route('lottery.participant.page')}}';
                                    });
                            }
                            else {
                                swal({
                                    title: "Erro",
                                    text: "Erro ao atualizar dados do participante.",
                                    icon: "error"
                                })
                                    .then(() => {
                                        window.location.href = '{{route('lottery.participant.page')}}';
                                    });
                            }
                        }
                    });
                }

            });

            //=====================================================================================================
            //CASO O PARTICIPANTE NÃO TENHA CUPOM O BOTÃO ADICIONAR O PARTICIPANTE NO SORTEIO
            $('#btnParticiparSorteio').click(function(){
                let id_participante = $('#id_participante').val();
                let nome_participante = $('#nm_participante').val();
                let wpp_participante = $('#wpp_participante').val().replace(/\D/g, '');
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: '{{route('old.participant.lottery')}}',
                    type: 'post',
                    data: {_token: CSRF_TOKEN, id: id_participante},
                    success: function(data){
                        console.log(data);
                        if(data.jaExiste == true) {
                            swal({
                                title: "Ops",
                                text: "Já está participando do sorteio.",
                                icon: "info",
                                buttons: {
                                    wpp_button: {
                                        text: "Mensagem Whatsapp",
                                        value: 1,
                                        visible: true
                                    },
                                    ok_button: {
                                        text: "Fechar",
                                        value: 0,
                                        visible: true
                                    }
                                }
                            })
                                .then((valor) => {
                                    if(valor == 1){
                                        let mensagem = "Olá,%20%2A" + nome_participante +"%2A%20agora%20o%20Sr(a)%20está%20participando%20de%20nosso%20sorteio%20Shopping%20Vip-X%20" +
                                            "e%20o%20seu%20cupom%20de%20sorteio%20é%20o%20%2Anúmero%2A%20%2A" + data.cupom[0].id_sorteio +".%2A%0A" +
                                            "%0A" +
                                            "Acompanhe%20diariamente%20os%20sorteios%20Ao%20Vivo%20no%20nosso%20Instagram%20www.instagram.com/maktubbeautycare/%20ou%20" +
                                            "@maktubbeautycare.%0A" +
                                            "%0A" +
                                            "Serão%20sorteios%20diários%20de%20até%205%20unhas%20por%20dia%20e%201%20sorteio%20semanal%20de%20Alongamento%20de%20Cílios,%20" +
                                            "Hidratação%20com%20Escova,%20Designer%20de%20Sobrancelha%20e%20Maquiagem%20Expressa.%0A" +
                                            "%0A" +
                                            "Aproveite%20e%20conheça%20nosso%20novo%20site:%20www.vipx.com.br,%20use%20o%20%2Acupom%2A%20%2AVIPX5%2A%20em%20suas%20compres%20online%20" +
                                            "e%20ganhe%2010%25%20de%20desconto."+
                                            "%0A" +
                                            "%0A%2AEm%2A%20%2Aapoio:%2A%20www.instagram.com/shoppingvipx/";

                                        let wpp = "https://api.whatsapp.com/send?phone=55" + wpp_participante + "&text=" + mensagem;

                                        window.open(wpp, '_blank');

                                        window.location.href = '{{route('lottery.participant.page')}}';

                                    }
                                    else {
                                        window.location.href = '{{route('lottery.participant.page')}}';
                                    }
                                });
                        }
                        else if(data.deuErro == false){

                            swal({
                                title: "Sucesso",
                                text: "Participante cadastrado no sorteio com sucesso!\n" +
                                "Seu número do cupom é: " + data.cupom.id_sorteio,
                                icon: "success",
                                buttons:{
                                    wpp_button:{
                                        text: "Mensagem Whatsapp",
                                        value: 1,
                                        visible: true
                                    },
                                    ok_button: {
                                        text:"Ok",
                                        value: 0,
                                        visible: true
                                    }
                                }
                            })
                                .then((valor) => {
                                    switch (valor){
                                        case 0:
                                            swal({
                                                title: "Atenção",
                                                text: "Seu número do cupom é: " + data.cupom.id_sorteio,
                                                icon: "info"
                                            })
                                                .then(() => {
                                                    window.location.href = '{{route('lottery.participant.page')}}';
                                                });

                                            break;
                                        case 1:

                                            let mensagem = "Olá,%20%2A" + nome_participante +"%2A%20agora%20o%20Sr(a)%20está%20participando%20de%20nosso%20sorteio%20Shopping%20Vip-X%20" +
                                                "e%20o%20seu%20cupom%20de%20sorteio%20é%20o%20%2Anúmero%2A%20%2A" + data.cupom.id_sorteio +".%2A%0A" +
                                                "%0A" +
                                                "Acompanhe%20diariamente%20os%20sorteios%20Ao%20Vivo%20no%20nosso%20Instagram%20www.instagram.com/maktubbeautycare/%20ou%20" +
                                                "@maktubbeautycare.%0A" +
                                                "%0A" +
                                                "Serão%20sorteios%20diários%20de%20até%205%20unhas%20por%20dia%20e%201%20sorteio%20semanal%20de%20Alongamento%20de%20Cílios,%20" +
                                                "Hidratação%20com%20Escova,%20Designer%20de%20Sobrancelha%20e%20Maquiagem%20Expressa.%0A" +
                                                "%0A" +
                                                "Aproveite%20e%20conheça%20nosso%20novo%20site:%20www.vipx.com.br,%20use%20o%20%2Acupom%2A%20%2AVIPX5%2A%20em%20suas%20compres%20online%20" +
                                                "e%20ganhe%2010%25%20de%20desconto." +
                                                "%0A" +
                                                "%0A%2AEm%2A%20%2Aapoio:%2A%20www.instagram.com/shoppingvipx/";

                                            let wpp = "https://api.whatsapp.com/send?phone=55" + wpp_participante + "&text=" + mensagem;

                                            window.open(wpp, '_blank');

                                            window.location.href = '{{route('lottery.participant.page')}}';

                                            break;
                                    }

                                });
                        }
                        else{
                            swal({
                                title: "Erro",
                                text: "Erro ao atualizar dados do participante.",
                                icon: "error"
                            })
                                .then(() => {
                                    window.location.href = '{{route('lottery.participant.page')}}';
                                });
                        }
                    }
                });
            });
        })
    </script>
@stop