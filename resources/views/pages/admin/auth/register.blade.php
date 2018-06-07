@extends('layouts.admin.panel')
@section('content')

    @include('partials.admin._alerts')

    <div class="register-box">
        <div class="register-box-body">
            <p class="login-box-msg">Registre uma nova conta</p>
            <form action="{{ route('admin.register.submit') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="nm_usuario" placeholder="Nome Completo" maxlength="40">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div id ="status_cpf_cnpj" class="form-group has-feedback">

                    <input type="number" id="cpf_cnpj" class="form-control " name="cd_cpf_cnpj" placeholder="CPF/CNPJ" required>
                    <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
                    <p class="msg-erro"></p>
                </div>
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="email" placeholder="Email" maxlength="35">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input id="verifica_senha" type="password" class="form-control" name="password" placeholder="Senha" minlength="6">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <p class="msg-senha"></p>
                </div>
                {{--<div class="form-group has-feedback">
                    <input type="password" class="form-control" name="conf_senha" placeholder="Confirmar senha">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>--}}
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox">Estou de acordo com os <a href="#">termos</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <div class="social-auth-links text-center">
                <p>- OU -</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i>Inscreva-se usando o Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
            </div>
            <a href="{{route('admin.login')}}" class="text-center">Eu já tenho uma conta</a>
        </div>
        <!-- /.form-box -->
    </div>

    <script>
        $('#cpf_cnpj').blur(function(e){
            e.preventDefault();

            $cpf_cnpj = $(this).val();

            $.ajax({
                url: '{{ url('/admin/register') }}/' + $cpf_cnpj,
                type: 'GET',
                success: function(data){



                    var cnpjValido = validarCNPJ($cpf_cnpj);
                    var cpfValido = validarCPF($cpf_cnpj);


                    if($cpf_cnpj.length > 15){
                        $('#status_cpf_cnpj').addClass('has-error');

                        $('.msg-erro').html("Limite de 15 caracteres excedido.").css("color", "red");
                    }
                    else if(data.cpf_cnpj.length > 0){
                        $('#status_cpf_cnpj').addClass('has-error');

                        $('.msg-erro').html("CPF/CNPJ já existente.").css("color", "red");

                    }
                    else if(!cpfValido && !cnpjValido) {
                        $('#status_cpf_cnpj').addClass('has-error');

                        $('.msg-erro').html("CPF/CNPJ inválido.").css("color", "red");
                    }
                    else{
                        $('#status_cpf_cnpj').removeClass('has-error');
                        $('#status_cpf_cnpj').addClass('has-success');

                        $('.msg-erro').html("CPF/CNPJ é válido.").css("color", "green");
                    }

            }

            });
        });




        $('#verifica_senha').blur(function(){
            var campo = $('#verifica_senha').val();
            var reg = new RegExp("^(?=.*[A-Z])(?=.{6,})");

            $('.msg-senha').html("");

            if(!reg.exec(campo))
                $('.msg-senha').html("Senha deve conter no mínimo 1 caracter maiúsculo.").css("color", "red");

        });






        function validarCNPJ(cnpj) {

            cnpj = cnpj.replace(/[^\d]+/g,'');

            if(cnpj == '') return false;

            if (cnpj.length != 14)
                return false;

            // Elimina CNPJs invalidos conhecidos
            if (cnpj == "00000000000000" ||
                cnpj == "11111111111111" ||
                cnpj == "22222222222222" ||
                cnpj == "33333333333333" ||
                cnpj == "44444444444444" ||
                cnpj == "55555555555555" ||
                cnpj == "66666666666666" ||
                cnpj == "77777777777777" ||
                cnpj == "88888888888888" ||
                cnpj == "99999999999999")
                return false;

            // Valida DVs
            var tamanho = cnpj.length - 2
            var numeros = cnpj.substring(0,tamanho);
            var digitos = cnpj.substring(tamanho);
            var soma = 0;
            var pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2)
                    pos = 9;
            }
            var resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(0))
                return false;

            tamanho = tamanho + 1;
            numeros = cnpj.substring(0,tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (var i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2)
                    pos = 9;
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(1))
                return false;

            return true;
        }


        function validarCPF(cpf)
        {
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


    </script>

@stop





