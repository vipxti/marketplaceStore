<form action="{{ route('client.address.update') }}" method="post">
    {{ csrf_field() }}

    <input type="hidden" id="ibge_update" name="cd_ibge" value="">
    <input type="hidden" id="pais_update" name="nm_pais" value="">

    <!-- Nome do destinatário -->
    <div class="row">

        <div class="col-md-6" hidden>
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control id_cliente_endereco" name="id_cliente_endereco" required maxlength="50">
                    <label class="form-label">id cliente</label>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group form-float">
                <div class="form-line focused">
                    <input type="text" class="form-control nm_destinatario" name="nm_destinatario" required maxlength="50">
                    <label class="form-label">Nome do destinatário</label>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group form-float">
                <div class="form-line focused">
                    <input type="text" class="form-control sobrenome_destinatario" name="sobrenome_destinatario" required maxlength="50">
                    <label class="form-label">Sobrenome do destinatário</label>
                </div>
            </div>
        </div>

    </div>

    <!-- CEP -->
    <div class="row">
        
        <div class="col-md-4">
            <div class="form-group form-float">
                <div class="form-line focused">
                    <input type="number" id="campo_cep_update" class="form-control cd_cep" name="cd_cep" required>
                    <label class="form-label">CEP</label>
                </div>
            </div>
            <p class="msg-cpf" style="font-size:14px"></p>
        </div>

        <div class="col-md-5">

            <div class="form-group form-float">
                <div class="form-line focused">
                    <input type="text" id="cidade_update" class="form-control nm_cidade" name="nm_cidade" required>
                    <label class="form-label">Cidade</label>
                </div>
            </div>

        </div>

        <div class="col-md-3">

            <div class="form-group form-float">
                <div class="form-line focused">
                    <input type="text" id="uf_update" class="form-control sg_uf" name="sg_uf" required>
                    <label class="form-label">Estado</label>
                </div>
            </div>

        </div>

    </div>

    <div class="row">

        <!-- Complemnto -->
        <div class="col-md-9">
            <div class="form-group form-float">
                <div class="form-line focused">
                    <input type="text" id="rua_update" class="form-control ds_endereco" name="ds_endereco" required>
                    <label class="form-label">Rua/Avenida</label>
                </div>
            </div>
        </div>

        <div class="col-md-3">

            <div class="form-group form-float">
                <div class="form-line focused">
                    <input type="number" class="form-control cd_numero_endereco" name="cd_numero_endereco" required>
                    <label class="form-label">Número</label>
                </div>
            </div>

        </div>

    </div>

    <div class="row">

        <!-- Complemento -->
        <div class="col-md-6">
            <div class="form-group form-float">
                <div class="form-line focused">
                    <input type="text" class="form-control ds_complemento" name="ds_complemento">
                    <label class="form-label">Complemento</label>
                </div>
            </div>
        </div>

        <!-- Complemento -->
        <div class="col-md-6">
            <div class="form-group form-float">
                <div class="form-line focused">
                    <input type="text" class="form-control ds_ponto_referencia" name="ds_ponto_referencia">
                    <label class="form-label">Ponto de referência</label>
                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <!-- Bairro -->
        <div class="col-md-12">
            <div class="form-group form-float">
                <div class="form-line focused">
                    <input type="text" id="bairro_update" class="form-control nm_bairro" name="nm_bairro" required>
                    <label class="form-label">Bairro</label>
                </div>
            </div>
        </div>
    </div>

    <p>&nbsp;</p><p>&nbsp;</p>

    <!-- Botões Salvar -->
    <div class="row">
        <div class="col-12">

            <button type="submit" class="btn btn-primary" style="background-color: #d59431">Atualizar</button>

        </div>
    </div>                                        

</form>

<script>

    function limpa_formulario_cep() {
        // Limpa valores do formulário de cep.
        $("#rua_update").val("");
        $("#bairro_update").val("");
        $("#cidade_update").val("");
        $("#pais_update").val("");
        $("#ibge_update").val("");
        $("#uf_update").val("");
    }

    //Quando o campo cep perde o foco.
    $("#campo_cep_update").focusout(function() {

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
                $("#rua_update").val("...");
                $("#bairro_update").val("...");
                $("#cidade_update").val("...");
                $("#pais_update").val("...");
                $("#uf_update").val("...");
                //Consulta o webservice viacep.com.br/
                $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#rua_update").parent().addClass("focused");
                        $("#rua_update").val(dados.logradouro);
                        //$("#rua").attr("disabled", "disabled");
                        $("#bairro_update").parent().addClass("focused");
                        $("#bairro_update").val(dados.bairro);
                        //$("#bairro").attr("disabled", "disabled");
                        $("#cidade_update").parent().addClass("focused");
                        $("#cidade_update").val(dados.localidade);
                        //$("#cidade").attr("disabled", "disabled");
                        $("#pais_update").parent().addClass("focused");
                        $("#pais_update").val('Brasil');
                        //$("#pais").attr("disabled", "disabled");
                        $("#uf_update").parent().addClass("focused");
                        $("#uf_update").val(dados.uf);
                        //$("#uf").attr("disabled", "disabled");
                        $("#ibge_update").val(dados.ibge);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulario_cep();
                        $(".msg-cpf").html("CEP não encontrado.").css("color", "red");
                        $("#rua_update").removeAttr("disabled");
                        $("#bairro_update").removeAttr("disabled");
                        $("#cidade_update").removeAttr("disabled");
                        $("#pais_update").removeAttr("disabled");
                        $("#uf_update").removeAttr("disabled");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulario_cep();
                $(".msg-cpf").html("Formato de CEP inválido.").css("color", "red");
                $("#rua_update").removeAttr("disabled");
                $("#bairro_update").removeAttr("disabled");
                $("#cidade_update").removeAttr("disabled");
                $("#pais_update").removeAttr("disabled");
                $("#uf_update").removeAttr("disabled");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulario_cep();
            $("#rua_update").removeAttr("disabled");
            $("#bairro_update").removeAttr("disabled");
            $("#cidade_update").removeAttr("disabled");
            $("#pais_update").removeAttr("disabled");
            $("#uf_update").removeAttr("disabled");
        }
    });

</script>