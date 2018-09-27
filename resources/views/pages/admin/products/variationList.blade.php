@extends('layouts.admin.app')

@section('content')
    <!-- ESTILO DO BOTÃO TRANSPARENTE NA TABLE -->
    <style type="text/css">
        /*deixar botão transparente*/
        button {
            background-color: Transparent;
            background-repeat:no-repeat;
            border: none;
            cursor:pointer;
            overflow: hidden;
            outline:none;
        }

        /*deixar setas do input do tipo number invisivel*/
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            cursor:pointer;
            display:block;
            width:8px;
            color: #333;
            text-align:center;
            position:relative;
        }
        input[type=number] {
            -moz-appearance: textfield;
            appearance: textfield;
            margin: 0;
        }
    </style>

    <!-- ESTILO DO CHECKBOX DA APPLE -->
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

    <!-- ESTILO DA APRESENTAÇÃO DAS IMAGENS -->
    <style type="text/css">
        .imagem_produto:hover{
            opacity: 0.5;
            cursor: pointer;
        }

        .imagem_principal{
            border-style: dashed;
            border-color: #0f0f0f;
            border-width: 3px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/admin/btInterativo.css') }}">

    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-list-alt"></i>&nbsp;&nbsp;Lista de Variações de Produtos</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Produtos</a></li>
                <li class="active">Lista de Variações de Produtos</li>
            </ol>
        </section>

        <section class="content">

        @include('partials.admin._alerts')

        <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">

                    <!-- Botão pesquisar -->

                    <div class="row">

                        <div class="col-md-4">
                            <h4><b>Produto Pai:</b> {{$produtoPai[0]->nm_produto}}</h4>
                            <h4><b>SKU:</b> {{$produtoPai[0]->cd_nr_sku}}</h4>
                        </div>

                        <div class="col-md-4 pull-right">

                            <a></a>

                        </div>

                    </div>

                <!-- Tabelas dos produtos -->

                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead>
                            <tr>
                                <th style="text-align: left">Nº</th>
                                <th style="text-align: left">SKU</th>
                                <th style="text-align: left">Nome</th>
                                <th style="text-align: left">Preço</th>
                                <th style="text-align: left">Qtd</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($produtos as $produto)
                                {{--{{dd($produto)}}--}}
                                <tr>
                                    <td>{{ $produto->cd_produto_variacao }} </td>
                                    <td>{{ $produto->cd_nr_sku }} </td>
                                    <td>{{ $produto->nm_produto_variacao }} </td>
                                    <td>R$ {{ str_replace('.', ',', $produto->vl_produto_variacao) }} </td>
                                    <td id="qt_produto">{{ str_replace('.', ',', $produto->qt_produto_variacao) }} </td>
                                    <td id="colBotoes" class="text-right">
                                        <button id="btn_editar" title="Atualizar Produto" class="fa fa-pencil btn btn-outline-warning" data-toggle="modal" data-target="#modal-default" style="color: #367fa9"></button>
                                        <button id="btn_excluir" title="Deletar Produto" class="fa fa-trash btn btn-outline-warning" style="color: #cc0000"></button>
                                    </td>
                                    {{--<td type="submit" id="btn_atributos" class="btn btn-outline-success" style="color: #008d4c;"><a href="{{ url('/admin/product/variation/' . $produto->cd_produto) }}"><i class="fa fa-plus"></i></a></td>--}}

                                </tr>


                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <br>
                    <div class="text-center">

                        {{ $produtos->links() }}

                    </div>

                    <!-- Moda Variações -->
                    <form action="{{route('product.variation.update')}}" method="post" enctype="multipart/form-data">
                        <!-- MODAL ATUALIZA DADOS -->
                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Atualizar Dados do Produto</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">

                                            <div class="col-md-12">


                                            {{ csrf_field() }}

                                                <input type="hidden" id="categorias" value="{{ $produtoPai[0]->cd_categoria }}" name="cd_categoria_variacao">
                                                <input type="hidden" id="subcategorias" value="{{ $produtoPai[0]->cd_sub_categoria }}" name="cd_sub_categoria_variacao" >
                                                <input type="hidden" id="codProduto" value="{{ $produtoPai[0]->cd_produto }}" name="cd_produto_principal">
                                            <!-- Nome do Produto  -->
                                                <div class="row">

                                                    <div class="col-md-12">

                                                        <div class="form-group">
                                                            <label>Nome do Produto</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                                                <input type="text" class="form-control campo_nome" name="nm_produto_variacao" required maxlength="70">
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
                                                                <input id="campo_sku" type="text" class="form-control campo_sku" name="cd_sku_variacao" required readonly maxlength="20">

                                                            </div>
                                                            <i class="msg_sku"></i>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Código (EAN)</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                                                <input id="campo_ean" type="text" class="form-control campo_ean" name="cd_ean_variacao" maxlength="13">
                                                            </div>
                                                            <i class="msg_ean"></i>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Cor</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-paint-brush"></i></span>
                                                                <select id="campo_cor" class="form-control" name="cd_cor_variacao">
                                                                    <option></option>
                                                                    @foreach($cores as $cor)
                                                                        <option value="{{$cor->cd_cor}}">{{$cor->nm_cor}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Tamanho (Letra)</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                                                <select id="campo_letra" class="form-control" name="cd_tamanho_letra_variacao">
                                                                    <option value="0"></option>
                                                                    @foreach($tamanhosLetras as $tamanho)
                                                                        <option value="{{$tamanho->cd_tamanho_letra}}">{{$tamanho->nm_tamanho_letra}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Tamanho (Número)</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                                                <select id="campo_numero" class="form-control" name="cd_tamanho_num_variacao">
                                                                    <option value="0"></option>
                                                                    @foreach($tamanhosNumeros as $tamanho)
                                                                        <option value="{{$tamanho->cd_tamanho_num}}">{{$tamanho->nm_tamanho_num}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
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
                                                                <input type="text" class="form-control campo_preco" required name="vl_produto_variacao">
                                                            </div>
                                                            <i class="msg_preco"></i>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">

                                                        <div class="form-group">
                                                            <label>Quantidade</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">0-9</span>
                                                                <input type="number" class="form-control campo_qtd" required name="qt_produto_variacao" min="0">
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
                                                                <input type="number" class="form-control campo_largura" required name="ds_largura_variacao" min="0">
                                                            </div>
                                                            <i class="msg_largura"></i>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-3">

                                                        <div class="form-group">
                                                            <label>Altura</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrows-v"></i></span>
                                                                <input type="number" class="form-control campo_altura" required name="ds_altura_variacao" min="0">
                                                            </div>
                                                            <i class="msg_altura"></i>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-3">

                                                        <div class="form-group">
                                                            <label>Comprimento</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                                                                <input type="number" class="form-control campo_comprimento" required name="ds_comprimento_variacao" min="0">
                                                            </div>
                                                            <i class="msg_peso"></i>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-3">

                                                        <div class="form-group">
                                                            <label>Peso (g)</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                                                                <input type="number" class="form-control campo_peso" required name="ds_peso_variacao" min="0">
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
                                                            <textarea id="bold" class="campo_desc form-control" name="ds_produto_variacao" required rows="5" style="resize: none"  maxlength="1500"></textarea>
                                                            <p class="msg_desc"></p>
                                                        </div>
                                                        <p><span class="qtd_palavras">1500</span> caracteres</p>

                                                    </div>

                                                </div>

                                                <p>&nbsp;</p>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Imagens já salvas: (clique sobre a imagem para apagar)</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="divImages" class="row">

                                                </div>
                                                <p>&nbsp;</p>

                                                <!-- Imagens e Status -->
                                                <div class="row">

                                                    <div class="col-md-6">

                                                        <div class="form-group">
                                                            <label>Adicionar imagens</label>
                                                            <div class="file-loading">
                                                                <input id="input-41" name="images_variacao[]" type="file" accept="image/*" multiple>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- Botões Salvar -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="switch__container pull-left">
                                                            <input id="switch-shadow" class="switch switch--shadow" type="checkbox" name="status_variacao" checked>
                                                            <label for="switch-shadow"></label>
                                                        </div>
                                                        <label class="mHswitch" for="switch-shadow">Produto Ativado</label>
                                                    </div>
                                                </div>



                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="btnSairModal" type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>
                                        <button id="btnUpdateProd" type="submit" class="btn btn-primary">Salvar Alterações</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </form>

                </div>
            </div>
        </section>
    </div>

    <script src="{{asset('js/admin/jquery.cookie.js')}}"></script>
    <script src="{{asset('js/admin/jquery.blockUI.js')}}"></script>
    <script src="{{asset('js/admin/sweetalert.min.js')}}"></script>
    <script>
        //Campo pesquisa de produtos
        $(function () {
            $( '#table' ).searchable({
                striped: true,
                oddRow: { 'background-color': '#f5f5f5' },
                evenRow: { 'background-color': '#fff' },
                searchType: 'fuzzy'
            });

            $( '#searchable-container' ).searchable({
                searchField: '#container-search',
                selector: '.row',
                childSelector: '.col-xs-4',
                show: function( elem ) {
                    elem.slideDown(100);
                },
                hide: function( elem ) {
                    elem.slideUp( 100 );
                }
            });

            ativaEditar();

            function msgAguarde(){
                $('.campo_nome').val('Aguarde...');
                $('#campo_sku').val('Aguarde...');
                $('#campo_ean').val('Aguarde...');
                $('.campo_preco').val('Aguarde...');
                $('.campo_qtd').val('Aguarde...');
                $('.campo_largura').val('Aguarde...');
                $('.campo_altura').val('Aguarde...');
                $('.campo_comprimento').val('Aguarde...');
                $('.campo_peso').val('Aguarde...');
            }

            var clicouOriginal = clicou;
            function ativaEditar() {
                $('button#btn_editar').click(function () {
                    console.log('clicou editar');
                    let campoTR = $(this).parent().parent();
                    let sku = campoTR.find('td:eq(1)').html();
                    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    clicouOriginal = clicou;

                    msgAguarde();

                    $.ajax({
                        url: '{{route('verify.sku.variation.products')}}',
                        type: 'POST',
                        data: {_token: CSRF_TOKEN, sku: sku},
                        success: function (data) {
                            console.log(data);
                            /*console.log(data[0][0].nm_produto);
                            console.log(data[1]);*/

                            $('.campo_nome').val(data[0][0].nm_produto_variacao);
                            $('#campo_sku').val(data[0][0].cd_nr_sku);
                            $('#campo_ean').val(data[0][0].cd_ean_variacao);
                            $('.campo_preco').val(data[0][0].vl_produto_variacao);
                            $('.campo_qtd').val(data[0][0].qt_produto_variacao);
                            $('.campo_largura').val(data[0][0].ds_largura);
                            $('.campo_altura').val(data[0][0].ds_altura);
                            $('.campo_comprimento').val(data[0][0].ds_comprimento);
                            $('.campo_peso').val(data[0][0].ds_peso);
                            $('#campo_cor').val(data["cor"][0].cd_cor);
                            if(data["letra"].length > 0)
                                $('#campo_letra').val(data["letra"][0].cd_tamanho_letra);
                            if(data["numero"].length > 0)
                                $('#campo_numero').val(data["numero"][0].cd_tamanho_num);

                            if (data[0][0].cd_status_produto_variacao == 1) {
                                console.log("Produto Ativado");
                                $('#switch-shadow').attr('checked', 'checked');
                                $('.mHswitch').text("Produto Ativado");
                                clicou = false;
                            }
                            else {
                                console.log("Produto Desativado");
                                $('#switch-shadow').removeAttr('checked');
                                $('.mHswitch').text("Produto Desativado");
                                clicou = true;
                            }

                            $('.campo_desc').text("");
                            $('.campo_desc').text(data[0][0].ds_produto_variacao);
                            contarPalavras();

                            $.each(data[1], function (i, v) {
                                console.log("indice: " + i + " : valor: " + v.im_produto);
                                console.log("imagem principal: " + v.ic_img_principal);
                                let caminho = v.im_produto;

                                $('#divImages').append('<div id="divImProd' + i + '" class="col-md-3 imagem_produto"></div>');

                                let img;
                                if (v.ic_img_principal == 1) {
                                    img = $('<img />', {
                                        id: 'idImagem',
                                        src: '{{ URL::asset('img/products' . '/') }}' + '/' + caminho,
                                        //src: v.im_produto,
                                        alt: data[0][0].nm_produto,
                                        class: 'imagem_principal',
                                        value: caminho,
                                        style: 'width: 150px; height: 220px;'
                                    });
                                }
                                else {
                                    img = $('<img />', {
                                        id: 'idImagem',
                                        src: '{{ URL::asset('img/products' . '/') }}' + '/' + caminho,
                                        //src: v.im_produto,
                                        alt: data[0][0].nm_produto,
                                        value: caminho,
                                        style: 'width: 150px; height: 220px;'
                                    });
                                }

                                img.appendTo($('#divImProd' + i));
                            });

                            ativaEventos();



                        }
                    });
                });
            }

            $('#search_button').click(function(){
                pesquisarProduto();
            });

            $('#search_input').keypress(function(event){
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13'){
                    pesquisarProduto();
                }
            });

            function pesquisarProduto(){
                console.log("oi");
                let valor_pesquisa = $('#search_input').val();
                console.log(valor_pesquisa);
                $('table>tbody').find('tr').remove();

                $.ajax({
                    url: '{{route('products.list.query')}}',
                    type: 'get',
                    data: {searchData: valor_pesquisa},
                    success: function(data){
                        console.log(data);

                        for(let i = 0; i<data.length; i++){
                            console.log(data[i]);
                            let tr = $('<tr></tr>');
                            let tdCdProd = $('<td></td>').text(data[i].cd_produto);
                            let tdSku = $('<td></td>').text(data[i].cd_nr_sku);
                            let tdNmProd = $('<td></td>').text(data[i].nm_produto);
                            let tdVlProd = $('<td></td>').text(data[i].vl_produto);
                            let tdQtdProd = $('<td></td>').text(data[i].qt_produto);
                            let tdBotoes = '<td id="colBotoes" class="text-right">' +
                                '<button id="btn_editar" title="Atualizar Produto" class="fa fa-pencil btn btn-outline-warning" data-toggle="modal" data-target="#modal-default" style="color: #367fa9"></button>' +
                                '<button type="submit" title="Adicionar Variação" id="btn_atributos" class="fa fa-plus btn btn-outline-success" onclick="pagVariacao('+data[i].cd_produto+');" style="color: #008d4c;"></button>' +
                                '<button id="btn_excluir" title="Deletar Produto" class="fa fa-trash btn btn-outline-warning" style="color: #cc0000"></button>' +
                                '</td>';

                            tr.append(tdCdProd, tdSku, tdNmProd, tdVlProd, tdQtdProd, tdBotoes);
                            $('table>tbody').append(tr);

                        }

                        ativaEditar();

                    },
                    error: function(data){

                    }
                });
            }

        });


        $('button#btn_excluir').click(function(){

        });

        var clicou=false;

        $('#modal-default').on('hide.bs.modal', function(){
            $('#divImages').empty();
            console.log("modal fechou");
        });

        function ativaEventos(){
            $('.imagem_produto').click(function(){
                let caminho_imagem = $(this).find('img').attr('value');
                let url_atual = window.location.href;
                let div_img = $(this);
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                let sku = $('#campo_sku').val();
                console.log(div_img);
                console.log(div_img.parent());
                console.log($('#divImages').find('div').find('img'));
                console.log(div_img.find('img'));

                swal({
                    title: "Atenção",
                    text: "O que deseja fazer com esta imagem?",
                    icon: "info",
                    buttons: {
                        cancel:{
                            text: "Cancelar",
                            value: 0,
                            visible: true
                        },
                        excluir: {
                            text:"Excluir",
                            value: 1,
                            visible: true,
                            className: "swal-button--danger"
                        },
                        principal: {
                            text:"Definir como principal",
                            value: 2,
                            visible: true
                        }
                    }
                }).then((valor) => {
                    switch(valor){
                        case 1:
                            console.log("excluir");

                            console.log('deletou');
                            console.log(caminho_imagem);

                            $.ajax({
                                url: '{{route('product.delete.image')}}',
                                type: 'post',
                                data: {_token: CSRF_TOKEN, cd_sku: sku, img_path: caminho_imagem},
                                success: function(data){
                                    console.log(data);
                                    if(data.deuErro === false){
                                        div_img.fadeOut(1000,function(){
                                            console.log('desapareceu');
                                            div_img.remove();
                                            swal('Sucesso', 'Imagem deletada com sucesso!', 'success');
                                        });
                                    }
                                    else{
                                        swal('Ops', 'Ocorreu um erro ao tentar apagar a imagem.', 'warning');
                                    }

                                },
                                error: function(data){
                                    swal('Ops', 'Ocorreu um erro ao tentar apagar a imagem.', 'warning');
                                }
                            });
                            break;

                        case 2:
                            console.log("definir principal");

                            $.ajax({
                                url: '{{route('product.update.image')}}',
                                type: 'post',
                                data: {_token: CSRF_TOKEN, cd_nr_sku: sku, img_prod: caminho_imagem},
                                success: function(data){
                                    console.log(data);
                                    if(data.deuErro === false) {
                                        swal('Sucesso', 'Imagem definida como principal com sucesso!', 'success');
                                        $('#divImages').find('div').find('img').removeClass('imagem_principal');
                                        div_img.find('img').addClass('imagem_principal');
                                    }
                                    else{
                                        swal('Ops', 'Ocorreu um erro ao tentar definir a imagem como principal.', 'warning');
                                    }
                                },
                                error: function(data){
                                    swal('Ops', 'Ocorreu um erro ao tentar definir a imagem como principal.', 'warning');
                                }
                            });

                            break;

                    }
                });

            });

            $('.campo_desc').on("input", function () {
                contarPalavras();
            });
        }

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

        $('#btnUpdateProd').click(function(){
            $.blockUI({
                message: 'Carregando...',
                css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: .5,
                    color: '#fff'
                }
            });

            setTimeout($.unblockUI, 12000);
        });

        $('#btnSairModal').click(function(){
            clicou = clicouOriginal;

            //$('.mHswitch').click();
        });

        function contarPalavras(){
            var conteudo = $('.campo_desc').val();
            var qtdCaracter = 1500 - conteudo.length;

            $('.qtd_palavras').html(qtdCaracter);
        }


    </script>

    <script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>


@stop

