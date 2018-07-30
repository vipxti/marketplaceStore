@extends('layouts.admin.app')

@section('content')
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
    <link rel="stylesheet" href="{{ asset('css/admin/btInterativo.css') }}">

    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-list-alt"></i>&nbsp;&nbsp;Lista de Produtos</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Produtos</a></li>
                <li class="active">Lista de Produtos</li>
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
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">

                        <!-- Botão pesquisar -->

                    <div style="padding-left: 70%">
                        <div>
                            <input type="search" id="search" value="" class="form-control">
                        </div>
                    </div>
                    <div>&nbsp;</div>


                    <div class="dataTables_length" style="padding-left: 90%" id="example1_length">
                        <select name="example1_length" aria-controls="example1" class="form-control form-control-sm">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>

                    <!-- Tabelas dos produtos -->

                    <table class="table" id="table">
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
                                <td>{{ $produto->cd_produto }} </td>
                                <td>{{ $produto->cd_nr_sku }} </td>
                                <td>{{ $produto->nm_produto }} </td>
                                <td>R$ {{ str_replace('.', ',', $produto->vl_produto) }} </td>
                                <td id="qt_produto">{{ str_replace('.', ',', $produto->qt_produto) }} </td>
                                <td id="colBotoes" class="text-right">
                                    <button id="btn_editar" class="fa fa-pencil btn btn-outline-warning" data-toggle="modal" data-target="#modal-default" style="color: #367fa9"></button>
                                    <button type="submit" id="btn_atributos" class="fa fa-plus btn btn-outline-success" onclick="pagVariacao({{$produto->cd_produto}});" style="color: #008d4c;">
                                        {{--<a href="{{ url('/admin/product/variation/' . $produto->cd_produto) }}">
                                            <i class="fa fa-plus"></i>
                                        </a>--}}
                                    </button>
                                    <button id="btn_excluir" class="fa fa-trash btn btn-outline-warning" style="color: #cc0000"></button>
                                </td>
                                {{--<td type="submit" id="btn_atributos" class="btn btn-outline-success" style="color: #008d4c;"><a href="{{ url('/admin/product/variation/' . $produto->cd_produto) }}"><i class="fa fa-plus"></i></a></td>--}}

                            </tr>


                        @endforeach
                        </tbody>
                    </table>



                    <br>
                    <div class="text-center">

                        {{ $produtos->links() }}

                    </div>

                    <!-- Moda Variações -->
                    <form action="{{route('product.update')}}" method="post" enctype="multipart/form-data">
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
                                            <!-- Nome do Produto  -->
                                                <div class="row">

                                                    <div class="col-md-12">

                                                        <div class="form-group">
                                                            <label>Nome do Produto</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                                                <input type="text" class="form-control campo_nome" name="nm_produto" required maxlength="50">
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

                                                                    {{--@foreach($categorias as $categoria)
                                                                        <option value="{{ $categoria->cd_categoria }}">{{ $categoria->nm_categoria }}</option>
                                                                    @endforeach--}}

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
                                                            <textarea id="bold" class="campo_desc form-control" name="ds_produto" required rows="5" style="resize: none"  maxlength="1500"></textarea>
                                                            <p class="msg_desc"></p>
                                                        </div>
                                                        <p><span class="qtd_palavras">1500</span> caracteres</p>

                                                    </div>

                                                </div>

                                                <!-- Imagens e Status -->
                                                {{--<div class="row">

                                                    <div class="col-md-6">

                                                        <div class="form-group">
                                                            <label>Imagens</label>
                                                            <div class="file-loading">
                                                                <input id="input-41" name="images[]" type="file" accept="image/*" multiple>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>--}}

                                                <!-- Botões Salvar -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="switch__container pull-left">
                                                            <input id="switch-shadow" class="switch switch--shadow" type="checkbox" name="status" checked>
                                                            <label for="switch-shadow"></label>
                                                        </div>
                                                        <label class="mHswitch" for="switch-shadow">Produto Ativado</label>

                                                        {{--<button type="submit" id="btn_salvar" class="btn btn-success pull-right" disabled><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                                        <button type="button" id="btn_cancelar" class="btn btn-danger pull-right" style="margin-right: 1%!important;"><i class="fa fa-times"></i>&nbsp;&nbsp;Limpar</button>--}}
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


        });

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

        function pagVariacao(cd_prod){
            window.location.href = '{{ url('/admin/product/variation/') }}' + '/' + cd_prod;
        }

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

        var categoriaProd = "";
        var cdCategoriaProd = "";
        var clicouOriginal = clicou;
        $('button#btn_editar').click(function(){
            var campoTR = $(this).parent().parent();
            var sku = campoTR.find('td:eq(1)').html();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            clicouOriginal = clicou;
            $.ajax({
                url: '{{route('verify.sku.products')}}',
                type: 'POST',
                data: {_token: CSRF_TOKEN, sku: sku},
                success: function(data){
                    console.log(data);
                    console.log(data[0].nm_produto);

                    $('.campo_nome').val(data[0].nm_produto);
                    $('#campo_sku').val(data[0].cd_nr_sku);
                    $('#campo_ean').val(data[0].cd_ean);
                    categoriaProd = data[0].nm_categoria;
                    cdCategoriaProd = data[0].cd_categoria;
                    $('.campo_preco').val(data[0].vl_produto);
                    $('.campo_qtd').val(data[0].qt_produto);
                    $('.campo_largura').val(data[0].ds_largura);
                    $('.campo_altura').val(data[0].ds_altura);
                    $('.campo_comprimento').val(data[0].ds_comprimento);
                    $('.campo_peso').val(data[0].ds_peso);

                    if(data[0].cd_status_produto == 1){
                        console.log("Produto Ativado");
                        $('#switch-shadow').attr('checked', 'checked');
                        $('.mHswitch').text("Produto Ativado");
                        clicou = false;
                    }
                    else{
                        console.log("Produto Desativado");
                        $('#switch-shadow').removeAttr('checked');
                        $('.mHswitch').text("Produto Desativado");
                        clicou = true;
                    }

                    $('.campo_desc').text("");
                    $('.campo_desc').text(data[0].ds_produto);
                    contarPalavras();

                    $('.campo_desc').on("input", function () {
                        contarPalavras();
                    });

                }
            }).done(function(){

                $.ajax({
                    url: '{{route('verify.category.products')}}',
                    type: 'GET',
                    success: function(data){
                        console.log(data.categoria);
                        $('#categorias').empty();

                        $.each(data.categoria, function(index, categoria){


                            $('#categorias').append(`<option value="` + categoria.cd_categoria + `">` + categoria.nm_categoria + `</option>`);

                            if(categoriaProd == categoria.nm_categoria){
                                $('option[value=' + categoria.cd_categoria + ']').prop('selected', 'true');
                            }
                        });
                    }
                }).done(function(){
                    buscaSubCategoria(cdCategoriaProd);
                });

            });
        });

        $('#categorias').change(function(){
            var cdCategoria = $(this).val();
            buscaSubCategoria(cdCategoria);
        });

        function buscaSubCategoria(cdCategoria){
            $.ajax({
                url: '{{ url('/admin/subcat') }}/' + cdCategoria,
                type: 'GET',
                success: function (data) {

                    $('#subcategorias').empty();

                    $.each(data.subcat, function(index, subcategoria) {

                        $('#subcategorias').append(`<option value="` + subcategoria.cd_sub_categoria + `">` + subcategoria.nm_sub_categoria + `</option>`);
                    })

                }
            });
        }

        function contarPalavras(){
            var conteudo = $('.campo_desc').val();
            var qtdCaracter = 1500 - conteudo.length;

            $('.qtd_palavras').html(qtdCaracter);
        }


    </script>

    <script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>


@stop

