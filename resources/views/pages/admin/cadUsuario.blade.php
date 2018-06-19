@extends('layouts.admin.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><i class="fa fa-edit"></i>&nbsp;&nbsp;Cadastrar Usuário</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Usuário</a></li>
                <li class="active">Cadastrar Usuário</li>
            </ol>
        </section>


        <!-- PERFIL USUARIO -->
        <section class="content">

            @include('partials.admin._alerts')

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Alterar</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.edit') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="cd_usuario" value="{{ Auth::user()->cd_usuario }}">
                        <div class="col-md-12">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" id="campo_nome" class="form-control" name="nm_usuario" maxlength="40" value="{{ Auth::user()->nm_usuario }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-at"></i></span>
                                        <input type="text" id="campo_email" class="form-control" name="email" maxlength="35" value="{{ Auth::user()->email }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Alterar Senha</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input type="password" id="campo_senha" class="form-control" name="password" minlength="6">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nível de Acesso</label>
                                    <div class="form-group has-feedback">
                                        <select class="form-control" style="width: 100%;" name="cd_acesso">
                                            <option value=""></option>

                                            @foreach($acessos as $acesso)
                                                <option value="{{ $acesso->cd_acesso }}">{{ $acesso->nm_acesso }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 text-right">
                            <button id="btn_alterar" type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Alterar</button>
                        </div>

                    </form>
                </div>
            </div>
        </section>

        <!-- CADASTRO USUARIO -->
        <section class="content">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Cadastrar</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <form action="#" method="post">
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <div class="col-md-3">
                            <div class="form-group">
                                <label>Celular 1</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                    <input type="text" id="campo_cel1" class="form-control" name="cd_celular1" required
                                    data-inputmask='"mask": "(99) 99999-9999"' data-mask >
                                </div>
                            </div>
                        </div>
                            <div class="col-md-3">
                             <div class="form-group">
                                 <label>Celular 2</label>
                                 <div class="input-group">
                                     <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                     <input type="text" id="campo_cel2" class="form-control" name="cd_celular2"
                                     data-inputmask='"mask": "(99) 99999-9999"' data-mask>
                                 </div>
                             </div>
                         </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>CEP</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="text" id="campo_cep" maxlength="9" class="form-control" name="cd_cep"
                                        data-inputmask='"mask": "99999-999"' data-mask>
                                    </div>
                                    <p class="msg-cpf"></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Cidade</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa  fa-map-signs"></i></span>
                                    <input type="text" id="cidade" class="form-control" name="nm_cidade" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Rua</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                        <input type="text" id="rua" class="form-control" name="ds_endereco" maxlength="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-3">
                             <div class="form-group">
                                 <label>Numero</label>
                                 <div class="input-group">
                                     <span class="input-group-addon"><i class="fa fa-bell"></i></span>
                                     <input type="number" id="numero" class="form-control" name="ds_numero_endereco" min="0">
                                 </div>
                             </div>
                         </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Complemento</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
                                        <input type="text" id="complemento" class="form-control" name="ds_complemento" maxlength="20">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                             <div class="form-group">
                                 <label>Ponto de Referencia</label>
                                 <div class="input-group">
                                     <span class="input-group-addon"><i class="fa fa-map-pin"></i></span>
                                     <input type="text" id="ponto_referencia" class="form-control" name="ds_ponto_referencia" maxlength="50">
                                 </div>
                             </div>
                         </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label>Bairro</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-street-view"></i></span>
                                    <input type="text" id="bairro" class="form-control" name="nm_bairro" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>País</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map"></i></span>
                                    <input type="text" id="pais" class="form-control" name="nm_pais" maxlength="30">
                                </div>
                            </div>
                         </div>
                        <div>&nbsp;</div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Foto Usuário</label>
                                <div class="input-group"><div class="file-loading">
                                        <input id="input-41" name="image" type="file">
                                    </div>
                                </div>
                            </div>
                        </div>
                       <div class="col-md-12 text-right">
                           <button type="submit" id="btn_salvar" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                       </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script src="{{ asset('js/admin/select2.full.min.js') }}"></script>
    <script src="{{asset('js/admin/jquery.blockUI.js')}}"></script>

    <script>

            function limpa_formulario_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#pais").val("");
                $("#ibge").val("");
            }

            //Quando o campo cep perde o foco.
            $("#campo_cep").focusout(function() {

                $(".msg-cpf").html("");
                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');
                //Verifica se campo cep possui valor informado.
                if (cep != "") {
                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;
                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {
                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#pais").val("...");
                        //Consulta o webservice viacep.com.br/
                        $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#pais").val("Brasil");
                               // $("#uf").val(dados.uf);
                                //$("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulario_cep();
                                $(".msg-cpf").html("CEP não encontrado.").css("color", "red");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulario_cep();
                        $(".msg-cpf").html("Formato de CEP inválido.").css("color", "red");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulario_cep();
                }
            });

        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Money Euro
            $('[data-mask]').inputmask()

        })

        $('#btn_salvar').click(function(){
            telaBloqueio();
        });

        $('#btn_alterar').click(function(){
            telaBloqueio();
        });

        function telaBloqueio(){
            $.blockUI({
                message: 'Salvando...',
                css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: .5,
                    color: '#fff'
                } });

            setTimeout($.unblockUI, 4000);
        }

    </script>
@stop
