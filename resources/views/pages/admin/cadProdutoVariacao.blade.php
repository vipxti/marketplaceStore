@extends('layouts.admin.app')

@section('content')

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-pencil"></i>&nbsp;&nbsp;Variação de produtos</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Produto</li>
            <li><a href="#">Cadastro de produto</a></li>
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

                        <form id="frmCadastroProduto" action="{{ route('product.variation.save') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <input type="hidden" id="categorias" value="{{ $ultimoProduto[0]->cd_categoria }}" name="cd_categoria_variacao">
                            <input type="hidden" id="subcategorias" value="{{ $ultimoProduto[0]->cd_sub_categoria }}" name="cd_sub_categoria_variacao" >
                            <input type="hidden" id="codProduto" value="{{ $ultimoProduto[0]->cd_produto }}" name="cd_produto_principal">

                            <div class="row">

                                <!-- Nome do Produto -->
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label>Nome do Produto</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                            <input type="text" class="form-control campo_nome_modal" name="nm_produto_variacao" value="{{ $ultimoProduto[0]->nm_produto }}" maxlength="70">
                                        </div>
                                        <i class="msg_nome_prod"></i>
                                    </div>

                                </div>

                            </div>

                            <!-- Códigos SKU e EAN -->
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Código (SKU)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                            <input id="campo_sku" type="text" class="form-control campo_sku_modal" name="cd_sku_variacao" maxlength="20" value="{{ $ultimoProduto[0]->cd_nr_sku }}" style="text-transform: uppercase">

                                        </div>
                                        <i class="msg_sku"></i>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Código (EAN)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                            <input id="campo_ean" type="text" class="form-control campo_ean_modal" name="cd_ean_variacao" value="{{ $ultimoProduto[0]->cd_ean }}" maxlength="13">
                                        </div>
                                        <i class="msg_ean"></i>
                                    </div>

                                </div>

                            </div>

                            <!-- Tamanhos -->
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label>Tamanho (Letra)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                            <select id="sl_tamanho_letra" class="form-control select2" style="width: 100%;" name="cd_tamanho_letra_variacao">
                                                <option value=""></option>
                                                @foreach($tamanhosLetras as $tamanhoLetra)
                                                    <option value="{{ $tamanhoLetra->cd_tamanho_letra }}">{{ $tamanhoLetra->nm_tamanho_letra }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <i class="msg_tam_letra"></i>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label>Tamanho (Número)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                            <select id="sl_tamanho_num" class="form-control select2" style="width: 100%;" name="cd_tamanho_num_variacao">
                                                <option value=""></option>
                                                @foreach($tamanhosNumeros as $tamanhoNumero)
                                                    <option value="{{ $tamanhoNumero->cd_tamanho_num }}">{{ $tamanhoNumero->nm_tamanho_num }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <i class="msg_tam_num"></i>
                                    </div>

                                </div>

                            </div>

                            <!-- Cor, Preço e Quantidade -->
                            <div class="row">

                                <div class="col-md-4">

                                    <div class="form-group">

                                        <label>Cor</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-paint-brush"></i></span>
                                            <select class="form-control select2" style="width: 100%;" name="cd_cor_variacao" >
                                                <option value=""></option>
                                                @foreach($cores as $cor)
                                                    <option value="{{ $cor->cd_cor }}">{{ $cor->nm_cor }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <i class="msg_cor"></i>
                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="form-group">

                                        <label>Preço</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">R$</span>
                                            <input type="text" class="form-control campo_preco" required name="vl_produto_variacao" value="{{ str_replace('.', ',', $ultimoProduto[0]->vl_produto) }}">
                                        </div>
                                        <i class="msg_preco"></i>
                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label>Quantidade</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">0-9</span>
                                            <input type="number" class="form-control campo_qtd_modal" name="qt_produto_variacao" value="{{ $ultimoProduto[0]->qt_produto }}" min="0">
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
                                            <input type="number" class="form-control campo_largura" required name="ds_largura_variacao" value="{{ $ultimoProduto[0]->ds_largura }}" min="0">
                                        </div>
                                        <i class="msg_largura"></i>
                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-group">
                                        <label>Altura</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-arrows-v"></i></span>
                                            <input type="number" class="form-control campo_altura" required name="ds_altura_variacao" value="{{ $ultimoProduto[0]->ds_altura }}" min="0">
                                        </div>
                                        <i class="msg_altura"></i>
                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-group">
                                        <label>Comprimento</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                                            <input type="number" class="form-control campo_comprimento" required name="ds_comprimento_variacao" value="{{ $ultimoProduto[0]->ds_comprimento }}" min="0">
                                        </div>
                                        <i class="msg_peso"></i>
                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-group">
                                        <label>Peso (g)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                                            <input type="number" class="form-control campo_peso" required name="ds_peso_variacao" value="{{ $ultimoProduto[0]->ds_peso }}" min="0">
                                        </div>
                                        <i class="msg_peso"></i>
                                    </div>

                                </div>

                            </div>

                            <!-- Descrição -->
                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label>Descrição do Produto</label>
                                        <textarea id="bold" class="campo_desc form-control" name="ds_produto_variacao" required rows="5" style="resize: none"  maxlength="1500">
                                            {{ $ultimoProduto[0]->ds_produto }}
                                        </textarea>
                                    </div>
                                    <p class="msg_desc"></p>
                                    <p><span class="qtd_palavras">1500</span>&nbsp;caracteres</p>

                                </div>

                            </div>

                            <!-- Imagens e Status -->
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Imagens</label>
                                        <div class="input-group">
                                            <div class="file-loading">
                                                <input id="input-41" name="images_variacao[]" type="file" accept="image/*" multiple>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="col-md-6">

                                    <input type="checkbox" class="js-switch" name="status_variacao" checked/> Ativar/Desativar Produto

                                </div>

                            </div>

                            <!-- Botão Salvar -->
                            <div class="row">

                                <div class="col-md-12">

                                    <button type="submit" id="btn_salvar" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>

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
<script src="{{asset('js/admin/nanobar.min.js')}}"></script>
<script src="{{asset('js/admin/jquery.blockUI.js')}}"></script>
<script>

    //Chama a função de contagem de palavras ao carregar a página
    $(document).ready(function(){

        var elem = document.querySelector('.js-switch');
        var init = new Switchery(elem);

        contadorPalavras();

    });

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
        $('.campo_desc').text("{{ $ultimoProduto[0]->ds_produto }}");
        contarPalavras();

        $('.campo_desc').on("input", function () {
            contarPalavras();
        });
    };

    function contarPalavras(){
        var conteudo = $('.campo_desc').val();
        var qtdCaracter = 1500 - conteudo.length;

        $('.qtd_palavras').html(qtdCaracter);
    }

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

    //Abrir o modal ao clicar no botão alterar
    // $('#btn_atributos').click(function(e){
    //     //e.preventDefault();
    //
    //     var my_cookie = $.cookie($('.modal-check').attr('name'));
    //     if (my_cookie && my_cookie == "true") {
    //         $(this).prop('checked', my_cookie);
    //         console.log('checked checkbox');
    //     }
    //     else{
    //         $('#myModal').modal('show');
    //         console.log('uncheck checkbox');
    //     }
    //
    //     $(".modal-check").change(function() {
    //         $.cookie($(this).attr("name"), $(this).prop('checked'), {
    //             path: '/',
    //             expires: 1
    //         });
    //     });
    //
    //     //mostrar os campos já digitados no cadastro de produtos dentro do modal
    //     $('.campo_nome_modal').val($('.campo_nome').val());
    //     $('.campo_desc_modal').val($('.campo_desc').val());
    //     $('.campo_ean_modal').val($('#campo_ean').val());
    //     $('.campo_sku_modal').val($('#campo_sku').val());
    //     $('.campo_preco_modal').val($('.campo_preco').val());
    //     $('.campo_qtd_modal').val($('.campo_qtd').val());
    //     $('.campo_largura_modal').val($('.campo_largura').val());
    //     $('.campo_altura_modal').val($('.campo_altura').val());
    //     $('.campo_peso_modal').val($('.campo_peso').val());
    //     $('.campo_cat_modal').val($('.campo_cat').val());
    //     $('.campo_subcat_modal').val($('.campo_subcat').val());
    //
    //     console.log($('.campo_cat_modal').val());
    //     console.log($('.campo_subcat_modal').val());
    //
    // });

    $('#btn_atributos').on('click', function (e) {
        e.preventDefault();

        $.ajax({

            url: '{{ url('/product') }}',
            type: 'POST',
            data: $('#frmCadastroProduto').serialize(),
            success: function () {

                var my_cookie = $.cookie($('.modal-check').attr('name'));
                if (my_cookie && my_cookie === 'true') {
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

                console.log($('.campo_cat_modal').val());
                console.log($('.campo_subcat_modal').val());

            }

        })

    });

    //Verifica botão Atributos
    // function verificaAtributos(){
    //     var regra = /^[0-9]+$/;
    //
    //     if ($('.campo_nome').val() != "" &&
    //         $('.campo_sku').val() != "" &&
    //         $('.campo_preco').val() != "" &&
    //         $('.campo_cat').val() != "" &&
    //         $('.campo_subcat').val() != "" &&
    //         $('.campo_qtd').val() != "" &&
    //         $('.campo_largura').val() != "" &&
    //         $('.campo_altura').val() != "" &&
    //         $('.campo_comprimento').val() != "" &&
    //         $('.campo_peso').val() != "" &&
    //         $('.campo_desc').val() != "" &&
    //         ($('.campo_ean').val().length == 0 ||
    //         ($('.campo_ean').val().length == 13 && regra.exec($('.campo_ean').val())))){
    //         $('#btn_atributos').removeAttr("disabled");
    //         $('#btn_salvar').removeAttr("disabled");
    //     }
    //     else {
    //         $('#btn_atributos').attr("disabled", "disabled");
    //         $('#btn_salvar').attr("disabled", "disabled");
    //     }
    //
    // }
</script>

@stop