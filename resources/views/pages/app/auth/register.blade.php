@extends('layouts.app.app')

@section('content')
    <link rel="stylesheet" href="{{asset('css/app/input.css')}}">

    <!-- ****** Area do cadastro  ****** -->
    <section class="new_arrivals_area section_padding_100_0 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_heading text-center">
                        <h3><i class="fa fa-users"></i>&nbsp; Cadastre-se</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">

            @include('partials.admin._alerts')

        <form id="form_advanced_validation" action="{{ route('client.save') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
                <!-- Nome do Cliente  -->
                <div class="row">
                    <div class="col-md-9" style="padding-left: 26%">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="nm_cliente" required maxlength="50">
                                <label class="form-label">Nome</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- E-mail -->
                <div class="row">
                    <div class="col-md-9" style="padding-left: 26%">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="email" class="form-control" name="email" required maxlength="50">
                                <label class="form-label">Email</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Senha e data de nascimento -->
                <div class="row">
                    <div class="col-md-6" style="padding-left: 26%">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="password" class="form-control" name="password" required maxlength="20">
                                <label class="form-label">Senha</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" style="padding-right: 26%">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="dt_nascimento"
                                        data-inputmask='"mask": "99/99/9999"' data-mask required maxlength="20"
                                        pattern="/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/">
                                <label class="form-label">Data de Nascimento</label>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- CNPJ/CPF e Telefone -->
                <div class="row">
                    <div class="col-md-6" style="padding-left: 26%">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" class="form-control" name="cd_cpf_cnpj" required maxlength="20">
                                <label class="form-label">CPF ou CNPJ</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" style="padding-right: 26%">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="cd_celular1"
                                        data-inputmask='"mask": "(99) 99999-9999"' data-mask required maxlength="20">
                                <label class="form-label">Telefone</label>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <!-- Foto Cliente -->
                <div class="row">
                    <div class="col-md-12" style="padding-left: 26%">
                        <div class="form-group">
                            <label></label>Foto</label>
                            <div class="input-group">
                                <div class="file-loading">
                                    <input id="input-41" name="image" type="file" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <p>&nbsp;</p>

                <!-- Botão Salvar -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div>
                            <button type="submit" id="btn_salvar" class="btn btn-danger" style="width: 547px; background-color: #ff084e"><i class="fa fa-save"></i>&nbsp;&nbsp;Cadastrar</button>
                        </div>
                    </div>
                </div>

                <p>&nbsp;</p>

            </form>
        </div>
    </section>
    <!-- ****** Fim da area de cadastro ****** -->

    <script src="{{asset('js/app/jquery.validate.js')}}"></script>
    <script src="{{asset('js/app/waves.js')}}"></script>
    <script src="{{asset('js/app/input.js')}}"></script>
    <script src="{{asset('js/app/form-validation.js')}}"></script>
    <script src="{{ asset('js/app/select2.full.min.js') }}"></script>
    <script>

        $('#quickview').on('show', function (e) {

            var link = e.relatedTarget(),
                $modal = $(this)

            console.log($modal);

        });

        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Money Euro
            $('[data-mask]').inputmask()

        })

        //Verificação e exibição de erros do campo CPF/CNPJ
        $('#cpf_cnpj').blur(function(e){
            e.preventDefault();

            $cpf_cnpj = $(this).val();

            $.ajax({
                url: '{{ url('/page/register') }}/' + $cpf_cnpj,
                type: 'GET',
                success: function(data){

                    var cnpjValido = validarCNPJ($cpf_cnpj);
                    var cpfValido = validarCPF($cpf_cnpj);

                    if($cpf_cnpj.length > 15){
                        $('.msg-erro').html("Limite de 15 caracteres excedido.").css("color", "red");
                    }
                    else if(data.cpf_cnpj.length > 0){
                        $('.msg-erro').html("CPF/CNPJ já existente.").css("color", "red");
                    }
                    else if(!cpfValido && !cnpjValido) {
                        $('.msg-erro').html("CPF/CNPJ inválido.").css("color", "red");
                    }
                }

            });
        });

        //VALIDAÇÃO DA SENHA E EXEBIÇÃO DE ERROS
        $('.campo_senha').blur(function(){
            var campo = $('.campo_senha').val();
            var reg = new RegExp("^(?=.*[A-Z])(?=.{6,})");

            $('.msg-senha').html("");

            if(!reg.exec(campo))
                $('.msg-senha').html("Mínimo 1 caracter maiúsculo.").css("color", "red").css("font-size", "small");

        });

        //VALIDAÇÃO DO CNPJ
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

        //VALIDAÇÃO DO CPF
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