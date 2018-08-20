<form action="{{ route('client.address.save') }}" method="post">
    {{ csrf_field() }}

    <input type="hidden" id="ibge" name="cd_ibge" value="">
    <input type="hidden" id="pais" name="nm_pais" value="">

    <!-- Nome do destinatário -->
    <div class="row">

        <div class="col-md-12">

            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" name="nm_destinatario" required maxlength="50">
                    <label class="form-label">Nome do destinatário</label>
                </div>
            </div>

        </div>

    </div>

    <!-- CEP -->
    <div class="row">
        
        <div class="col-md-4">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="number" id="campo_cep" class="form-control" name="cd_cep" required>
                    <label class="form-label">CEP</label>
                </div>
            </div>
            <p class="msg-cpf" style="font-size:14px"></p>
        </div>

        <div class="col-md-5">

            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" id="cidade" class="form-control" name="nm_cidade" required>
                    <label class="form-label">Cidade</label>
                </div>
            </div>

        </div>

        <div class="col-md-3">

            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" id="uf" class="form-control" name="sg_uf" required>
                    <label class="form-label">Estado</label>
                </div>
            </div>

        </div>

    </div>

    <div class="row">

        <!-- Complemnto -->
        <div class="col-md-9">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" id="rua" class="form-control" name="ds_endereco" required>
                    <label class="form-label">Rua/Avenida</label>
                </div>
            </div>
        </div>

        <div class="col-md-3">

            <div class="form-group form-float">
                <div class="form-line">
                    <input type="numero" class="form-control" name="cd_numero_endereco" required>
                    <label class="form-label">Número</label>
                </div>
            </div>

        </div>

    </div>

    <div class="row">

        <!-- Complemento -->
        <div class="col-md-6">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" name="ds_complemento">
                    <label class="form-label">Complemento</label>
                </div>
            </div>
        </div>

        <!-- Complemento -->
        <div class="col-md-6">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" name="ds_ponto_referencia">
                    <label class="form-label">Ponto de referência</label>
                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <!-- Bairro -->
        <div class="col-md-12">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" id="bairro" class="form-control" name="nm_bairro" required>
                    <label class="form-label">Bairro</label>
                </div>
            </div>
        </div>
    </div>

    <p>&nbsp;</p><p>&nbsp;</p>

    <!-- Botões Salvar -->
    <div class="row">
        <div class="col-12">

            <button type="submit" class="btn btn-primary" style="background-color: #d59431">Adicionar Endereço</button>

        </div>
    </div>                                        

</form>

<script>

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

</script>