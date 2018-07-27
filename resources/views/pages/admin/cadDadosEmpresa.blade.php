@extends('layouts.admin.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><i class="fa fa-edit"></i>&nbsp;&nbsp;Dados Cadastrais</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Empresa</a></li>
                <li class="active">Dados Cadastrais</li>
            </ol>
        </section>

        <!-- DADOS CADASRAIS-->
        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Cadastrar/Alterar</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{route('company.register.data')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Razão Social &nbsp;<i style="color: red !important;">*</i></label>
                                <input type="text" class="form-control" id="nm_razao_social" name="nm_razao_social" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome Fantasia</label>
                                <input type="text" class="form-control" id="nm_fantasia" name="nm_fantasia">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Telefone&nbsp;<i style="color: red !important;">*</i></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" id="campo_cel1" class="form-control" name="cd_tel" required
                                           data-inputmask='"mask": "(99) 9999-9999"' data-mask >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sel1">Tipo de Pessoa &nbsp;<i style="color: red !important;">*</i></label>
                                <select class="form-control" id="sel1" readonly name="ic_tipo_pessoa" required>
                                    <option value="J" selected >Pessoa Júridica</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Cnpj&nbsp;&nbsp;<i style="color: red !important;">*</i></label>
                                <input type="text" class="form-control" id="cd_cnpj" name="cd_cnpj" required maxlength="14">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Inscrição Estadual&nbsp;&nbsp;<i class="fa fa-info-circle" aria-hidden="true" title="Incrição Estadual do estabelecimento" style="color: #9e9e9e !important;"></i></label>
                                <input type="text" class="form-control" id="cd_ie" name="cd_ie" maxlength="20">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group" style="padding:32.5px 0;">
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="ic_ie_isento" name="ic_ie_isento" checked>
                                    IE Isento
                                </label>
                            </div>
                        </div>
                        <div class="clearfix visible-xs-block"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Inscrição Municipal</label>
                                <input type="text" class="form-control" id="cd_im" name="cd_im">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Cnae</label>
                                <input type="text" class="form-control" id="nm_cnae" name="nm_cnae" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sel1">Código de Regime Tributario&nbsp;&nbsp;<i style="color: red !important;">*</i></label>
                                <select class="form-control" id="sel1" name="cd_regime_tributario"  required>
                                    <option value="" ></option>
                                    <option value="1">Simples nacional</option>
                                    <option value="2">Simples nacional - Excesso de sublimite de receita bruta</option>
                                    <option value="3">Regime normal</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sel1">Código da Loja API Bling&nbsp;&nbsp;<i style="color: red !important;">*</i> &nbsp;<i class="fa fa-info-circle" aria-hidden="true" title="Código da loja utilizado na API do Bling no campo 'Número identificador da loja' para associar os envios." style="color: #9e9e9e !important;"></i></label>
                                <input type="text" class="form-control" id="cd_api_bling" name="cd_api_bling" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>API key&nbsp;<i style="color: red !important;">*</i>&nbsp;&nbsp;<i class="fa fa-info-circle" aria-hidden="true" title="Código da segurança utilizado na API do Bling no campo 'Número identificador da API key' para associar os envios." style="color: #9e9e9e !important;"></i></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input class="form-control" type="text" id="cd_api_key" name="cd_api_key" required>
                                </div>
                            </div>
                        </div>
                        <div>&nbsp;</div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Cep&nbsp;<i style="color: red !important;">*</i></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="text" id="campo_cep" maxlength="9" class="form-control" name="cd_cep"
                                           data-inputmask='"mask": "99999-999"' data-mask required>
                                </div>
                                <p class="msg-cpf"></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Cidade&nbsp;<i style="color: red !important;">*</i></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa  fa-map-signs"></i></span>
                                <input type="text" id="cidade" class="form-control" name="nm_cidade" maxlength="50" required>
                            </div>
                        </div>
                        <input type="hidden" id="ibge" name="cd_ibge" value="">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Rua&nbsp;<i style="color: red !important;">*</i></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                    <input type="text" id="rua" class="form-control" name="ds_endereco" maxlength="100" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Numero&nbsp;<i style="color: red !important;">*</i></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                    <input type="number" id="numero" class="form-control" name="cd_numero_endereco" min="0" required>
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Ponto de Referencia</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-pin"></i></span>
                                    <input type="text" id="ponto_referencia" class="form-control" name="ds_ponto_referencia" maxlength="50">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Bairro&nbsp;<i style="color: red !important;">*</i></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-street-view"></i></span>
                                <input type="text" id="bairro" class="form-control" name="nm_bairro" maxlength="50" required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <label>Estado&nbsp;<i style="color: red !important;">*</i></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map"></i></span>
                                <input type="text" id="uf" class="form-control" name="sg_uf" maxlength="4" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>País&nbsp;<i style="color: red !important;">*</i></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map"></i></span>
                                <input type="text" id="pais" class="form-control" name="nm_pais" maxlength="30" required>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 30px !important;">
                            <div class="form-group">
                                <label>Logo</label>
                                <div class="input-group"><div class="file-loading">
                                        <input id="image" name="image" type="file" accept="image/png, image/jpeg, image/jpg">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-trash"></i>&nbsp; Cancelar</button>
                            <button type="submit" class="btn btn-success pull-right" style="margin-right: 10px;"><i class="fa   fa-save"></i>&nbsp; Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script src="{{ asset('js/admin/select2.full.min.js') }}"></script>
    <script src="{{asset('js/admin/jquery.blockUI.js')}}"></script>

    <script>
        //Busca Cep
        function limpa_formulario_cep() {
            // Limpa valores do formulário de cep.
            $("#rua").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#pais").val("");
            $("#ibge").val("");
            $("#uf").val("");
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
                    $("#uf").val("...");
                    //Consulta o webservice viacep.com.br/
                    $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#rua").parent().addClass("focused");
                            $("#rua").val(dados.logradouro);
                            //$("#rua").attr("disabled", "disabled");
                            $("#bairro").parent().addClass("focused");
                            $("#bairro").val(dados.bairro);
                            //$("#bairro").attr("disabled", "disabled");
                            $("#cidade").parent().addClass("focused");
                            $("#cidade").val(dados.localidade);
                            //$("#cidade").attr("disabled", "disabled");
                            $("#pais").parent().addClass("focused");
                            $("#pais").val('Brasil');
                            //$("#pais").attr("disabled", "disabled");
                            $("#uf").parent().addClass("focused");
                            $("#uf").val(dados.uf);
                            //$("#uf").attr("disabled", "disabled");
                            $("#ibge").val(dados.ibge);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulario_cep();
                            $(".msg-cpf").html("CEP não encontrado.").css("color", "red");
                            $("#rua").removeAttr("disabled");
                            $("#bairro").removeAttr("disabled");
                            $("#cidade").removeAttr("disabled");
                            $("#pais").removeAttr("disabled");
                            $("#uf").removeAttr("disabled");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulario_cep();
                    $(".msg-cpf").html("Formato de CEP inválido.").css("color", "red");
                    $("#rua").removeAttr("disabled");
                    $("#bairro").removeAttr("disabled");
                    $("#cidade").removeAttr("disabled");
                    $("#pais").removeAttr("disabled");
                    $("#uf").removeAttr("disabled");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulario_cep();
                $("#rua").removeAttr("disabled");
                $("#bairro").removeAttr("disabled");
                $("#cidade").removeAttr("disabled");
                $("#pais").removeAttr("disabled");
                $("#uf").removeAttr("disabled");
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
