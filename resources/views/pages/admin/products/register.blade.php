@extends('layouts.admin.app')

@section('content')

    <style type="text/css">
        /* Estilo iOS */
        .mHswitch{
            cursor: pointer;
            margin-left: 2% !important;
        }
        .switch {
            visibility: hidden;
            position: absolute;
            margin-left: -9999px;

        }
        .switch + label {
            display: block;
            position: relative;
            cursor: pointer;
            outline: none;
            user-select: none;
        }

        .switch--shadow + label {
            padding: 2px;
            width: 45px;
            height: 20px;
            background-color: #dddddd;
            border-radius: 60px;
        }
        .switch--shadow + label:before,
        .switch--shadow + label:after {
            display: block;
            position: absolute;
            top: 1px;
            left: 1px;
            bottom: 1px;
            content: "";
        }
        .switch--shadow + label:before {
            right: 1px;
            background-color: #f1f1f1;
            border-radius: 60px;
            transition: background 0.4s;
        }
        .switch--shadow + label:after {
            width: 18px;
            background-color: #fff;
            border-radius: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            transition: all 0.4s;
        }
        .switch--shadow:checked + label:before {
            background-color: #8ce196;
        }
        .switch--shadow:checked + label:after {
            transform: translateX(26px);
        }

        /* Estilo Flat */
        .switch--flat + label {
            padding: 2px;
            width: 120px;
            height: 60px;
            background-color: #dddddd;
            border-radius: 60px;
            transition: background 0.4s;
        }
        .switch--flat + label:before,
        .switch--flat + label:after {
            display: block;
            position: absolute;
            content: "";
        }
        .switch--flat + label:before {
            top: 2px;
            left: 2px;
            bottom: 2px;
            right: 2px;
            background-color: #fff;
            border-radius: 60px;
            transition: background 0.4s;
        }
        .switch--flat + label:after {
            top: 4px;
            left: 4px;
            bottom: 4px;
            width: 56px;
            background-color: #dddddd;
            border-radius: 52px;
            transition: margin 0.4s, background 0.4s;
        }
        .switch--flat:checked + label {
            background-color: #8ce196;
        }
        .switch--flat:checked + label:after {
            margin-left: 60px;
            background-color: #8ce196;
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Produto</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Produtos</li>
            <li><a href="#">Cadastrar</a></li>
        </ol>
    </section>

    <section class="content">

        @include('partials.admin._alerts')

        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title">Cadastro de Produto</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>

            </div>

            <div class="box-body">

                <div class="row">

                    <div class="col-md-12">

                        <form action="{{ route('product.save') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <!-- Nome do Produto  -->
                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label>Nome do Produto</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                            <input type="text" class="form-control campo_nome" name="nm_produto" required maxlength="70">
                                        </div>
                                        <i class="msg_nome_prod"></i>
                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <!-- Códigos SKU e Ean  -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Código (SKU)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                            <input id="campo_sku" type="text" class="form-control campo_sku" name="cd_sku" required maxlength="20">

                                        </div>
                                            <i class="msg_sku"></i>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Código (EAN)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                            <input id="campo_ean" type="text" class="form-control campo_ean" name="cd_ean" maxlength="13">
                                        </div>
                                        <i class="msg_ean"></i>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <!-- Categorias -->
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Categoria</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                            <select id="categorias" class="form-control select2 campo_cat" style="width: 100%;" required name="cd_categoria">
                                                <option value=""></option>

                                                @foreach($categorias as $categoria)
                                                    <option value="{{ $categoria->cd_categoria }}">{{ $categoria->nm_categoria }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <i class="msg_cat"></i>
                                    </div>

                                </div>

                                <!-- Subcategorias -->
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Sub-Categoria</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                            <select id="subcategorias" class="form-control select2 campo_subcat" style="width: 100%;" required name="cd_sub_categoria" >

                                            </select>
                                        </div>
                                        <i class="msg_subcat"></i>
                                    </div>

                                </div>

                            </div>
                        
                            <!-- Preço e quantidade  -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Preço</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">R$</span>
                                            <input type="text" class="form-control campo_preco" required name="vl_produto">
                                        </div>
                                        <i class="msg_preco"></i>
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Quantidade</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">0-9</span>
                                            <input type="number" class="form-control campo_qtd" required name="qt_produto" min="0">
                                        </div>
                                        <i class="msg_qtd"></i>
                                    </div>

                                </div>

                            </div>

                            <!-- Largura, Altura, Comprimento e Peso -->
                            <div class="row">

                                <div class="col-md-3">

                                    <div class="form-group">
                                        <label>Largura</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                                            <input type="number" class="form-control campo_largura" required name="ds_largura" min="0">
                                        </div>
                                        <i class="msg_largura"></i>
                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-group">
                                        <label>Altura</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-arrows-v"></i></span>
                                            <input type="number" class="form-control campo_altura" required name="ds_altura" min="0">
                                        </div>
                                        <i class="msg_altura"></i>
                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-group">
                                        <label>Comprimento</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                                            <input type="number" class="form-control campo_comprimento" required name="ds_comprimento" min="0">
                                        </div>
                                        <i class="msg_peso"></i>
                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-group">
                                        <label>Peso (g)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                                            <input type="number" class="form-control campo_peso" required name="ds_peso" min="0">
                                        </div>
                                        <i class="msg_peso"></i>
                                    </div>

                                </div>

                            </div>

                            <!-- Descrição  -->
                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label>Descrição do Produto</label>
                                        <textarea id="bold" class="campo_desc form-control" name="ds_produto" required rows="5" style="resize: none"  maxlength="1500">
                                        </textarea>
                                        <p class="msg_desc"></p>
                                    </div>
                                    <p><span class="qtd_palavras">1500</span> caracteres</p>

                                </div>

                            </div>

                            <!-- Imagens e Status -->
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Imagens</label>
                                        <div class="file-loading">
                                            <input id="input-41" name="images[]" type="file" accept="image/*" multiple>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Botões Salvar -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="switch__container pull-left">
                                        <input id="switch-shadow" class="switch switch--shadow" type="checkbox" name="status" checked>
                                        <label for="switch-shadow"></label>
                                    </div>
                                    <label class="mHswitch" for="switch-shadow">Produto Ativado</label>

                                    <button type="submit" id="btn_salvar" class="btn btn-success pull-right" disabled><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                    <button type="button" id="btn_cancelar" class="btn btn-danger pull-right" style="margin-right: 1%!important;"><i class="fa fa-times"></i>&nbsp;&nbsp;Limpar</button>
                                </div>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<script src="{{asset('js/admin/jquery.cookie.js')}}"></script>
<script src="{{asset('js/admin/jquery.blockUI.js')}}"></script>
<script src="{{asset('js/admin/nanobar.js')}}"></script>
<script src="{{asset('js/admin/switchery.js')}}"></script>

<script>

    //Chama a função de contagem de palavras ao carregar a página
    $(document).ready(function(){

        contadorPalavras();


        $('#categorias').val("");
        $('#subcategorias').val("");


        var clicou=false;

        $('.switch').click(function(){
            if(!clicou){
                $(this).removeAttr('checked');
                $('.mHswitch').text("Produto Desativado");
                clicou = true;
            }
            else {
                $(this).attr('checked','checked');
                $('.mHswitch').text("Produto Ativado");
                clicou = false;
            }
        });

    });

    $('#categorias').change(function (e) {
        e.preventDefault();

        $cd_categoria = $(this).val();

        $.ajax({

            url: '{{ url('/admin/subcat') }}/' + $cd_categoria,
            type: 'GET',
            success: function (data) {

                $('#subcategorias').empty();

                $.each(data.subcat, function(index, subcategoria) {

                    $('#subcategorias').append(`<option value="` + subcategoria.cd_sub_categoria + `">` + subcategoria.nm_sub_categoria + `</option>`);
                })

            }

        })

    });


    //Tela de espera ao salvar
    $('#btn_salvar').click(function(){
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

        setTimeout($.unblockUI, 12000);
    });

    //Validação do campo NOME DO PRODUTO
    $('.campo_nome').blur(function(){
        var campo = $(this).val();
        $('.msg_nome_prod').html("");

        if(campo.length == 0)
            $('.msg_nome_prod').html("Campo obrigatório.").css("color", "red");

        verificaAtributos();
    });

    //Validação do campo EAN
    $('#campo_ean').blur(function(){

        var campo = $('#campo_ean').val();
        var regra = /^[0-9]+$/;

        $('.msg_ean').html("");

        if(!campo.match(regra) && campo.length > 0){
            $('.msg_ean').html("Campo deve ser numérico").css("color", "red");
        }
        else if(campo.length < 13 && campo.length > 0) {
            $('.msg_ean').html("Campo deve conter 0 ou 13 caracteres.").css("color", "red");
        }

        verificaAtributos();
    });


    //Validação do campo SKU
    $('#campo_sku').blur(function() {

        var campo = $('#campo_sku').val();
        var regra = /^[a-zA-Z0-9]+$/;

        $('.msg_sku').html("");

        if (campo.length == 0) {
            $('.msg_sku').html("Campo obrigatório.").css("color", "red");
        }
        else if (!regra.exec(campo)) {
            $('.msg_sku').html("Proibido caracteres especiais.").css("color", "red");
        }

        verificaAtributos();
    });

    //Validação do campo DESCRIÇÃO
    $('.campo_desc').blur(function() {

        var campo = $('.campo_desc').val();

        $('.msg_desc').html("");

        if (campo.length == 0) {
            $('.msg_desc').html("Campo obrigatório.").css("color", "red");
        }
        verificaAtributos();
    });

    //Validação do campo PREÇO
    $('.campo_preco').blur(function() {


        var campo = $('.campo_preco').val();
        var reg = /^(\d{1,3}(.\d{3})*|(\d+))(.\d{2})?$/;

        $('.msg_preco').html("");

        if (campo.length == 0) {
            $('.msg_preco').html("Campo obrigatório.").css("color", "red");
        }
        else if(!reg.exec(campo))
            $('.msg_preco').html("Campo digitado de forma incorreta.").css("color", "red");

        verificaAtributos();
    });
    //Validação do campo CATEGORIA
    $('.campo_cat').blur(function() {

        var campo = $('.campo_cat').val();

        $('.msg_cat').html("");

        if (campo == "") {
            $('.msg_cat').html("Campo obrigatório.").css("color", "red");
        }

        verificaAtributos();
    });

    //Validação do campo CATEGORIA
    $('.campo_subcat').blur(function() {

        var campo = $('.campo_subcat').val();

        $('.msg_subcat').html("");

        if (campo == "") {
            $('.msg_subcat').html("Campo obrigatório.").css("color", "red");
        }

        verificaAtributos();
    });

    //Validação do campo QUANTIDADE
    $('.campo_qtd').blur(function() {

        var campo = $('.campo_qtd').val();

        $('.msg_qtd').html("");

        if (campo == "") {
            $('.msg_qtd').html("Campo obrigatório.").css("color", "red");
        }

        verificaAtributos();
    });

    //Validação do campo LARGURA
    $('.campo_largura').blur(function() {

        var campo = $('.campo_largura').val();

        $('.msg_largura').html("");

        if (campo == "") {
            $('.msg_largura').html("Campo obrigatório.").css("color", "red");
        }

        verificaAtributos();
    });

    //Validação do campo ALTURA
    $('.campo_altura').blur(function() {

        var campo = $('.campo_altura').val();

        $('.msg_altura').html("");

        if (campo == "") {
            $('.msg_altura').html("Campo obrigatório.").css("color", "red");
        }

        verificaAtributos();
    });

    //Validação do campo PESO
    $('.campo_peso').blur(function() {

        var campo = $('.campo_peso').val();

        $('.msg_peso').html("");

        if (campo == "") {
            $('.msg_peso').html("Campo obrigatório.").css("color", "red");
        }

        verificaAtributos();
    });


    //Contagem de palavras na TextArea da Descrição
    function contadorPalavras() {

        $('.campo_desc').text("");

        $('.campo_desc').on("input", function () {
            var conteudo = $('.campo_desc').val();
            var qtdCaracter = 1500 - conteudo.length;


            $('.qtd_palavras').html(qtdCaracter);

        });
    };

    $('#sl_tamanho_letra').change(function (e) {

        e.preventDefault();

        $selValue = $(this).val();

        if ($selValue != "") {

            $('#sl_tamanho_num').val("");

        }

    });

    $('#sl_tamanho_num').change(function (e) {

        e.preventDefault();

        $selValue = $(this).val();

        if ($selValue != "") {

            $('#sl_tamanho_letra').val("");

        }

    });

    //Abrir o modal ao clicar no botão Atributos
    $('#btn_atributos').click(function(e){
            e.preventDefault();

            var my_cookie = $.cookie($('.modal-check').attr('name'));
            if (my_cookie && my_cookie == "true") {
                $(this).prop('checked', my_cookie);
                console.log('checked checkbox');
            }
            else{
                $('#myModal').modal('show');
                console.log('uncheck checkbox');
            }

            $(".modal-check").change(function() {
                $.cookie($(this).attr("name"), $(this).prop('checked'), {
                    path: '/',
                    expires: 1
                });
            });

        //mostrar os campos já digitados no cadastro de produtos dentro do modal
        $('.campo_nome_modal').val($('.campo_nome').val());
        $('.campo_desc_modal').val($('.campo_desc').val());
        $('.campo_ean_modal').val($('#campo_ean').val());
        $('.campo_sku_modal').val($('#campo_sku').val());
        $('.campo_preco_modal').val($('.campo_preco').val());
        $('.campo_qtd_modal').val($('.campo_qtd').val());
        $('.campo_largura_modal').val($('.campo_largura').val());
        $('.campo_altura_modal').val($('.campo_altura').val());
        $('.campo_peso_modal').val($('.campo_peso').val());
        $('.campo_cat_modal').val($('.campo_cat').val());
        $('.campo_subcat_modal').val($('.campo_subcat').val());

        carregaNanobar();
        //nanobar.go(100);

    });

    //Função chama NanoBar
    function carregaNanobar(){
        var nanobar = new Nanobar();
        nanobar.go(30);

        setTimeout(function(){
            nanobar.go(100);
        }, 1000)
    }

    //Verifica botão Atributos
    function verificaAtributos(){
        var regra = /^[0-9]+$/;

        if ($('.campo_nome').val() != "" &&
            $('.campo_sku').val() != "" &&
            $('.campo_preco').val() != "" &&
            $('.campo_cat').val() != "" &&
            $('.campo_subcat').val() != "" &&
            $('.campo_qtd').val() != "" &&
            $('.campo_largura').val() != "" &&
            $('.campo_altura').val() != "" &&
            $('.campo_peso').val() != "" &&
            $('.campo_desc').val() != "" &&
            ($('.campo_ean').val().length == 0 ||
            ($('.campo_ean').val().length == 13 && regra.exec($('.campo_ean').val())))){
            $('#btn_atributos').removeAttr("disabled");
            $('#btn_salvar').removeAttr("disabled");
        }
        else {
            $('#btn_atributos').attr("disabled", "disabled");
            $('#btn_salvar').attr("disabled", "disabled");
        }

    }

</script>

@stop


