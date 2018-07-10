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
                                            <button id="btn_editar" class="fa fa-pencil btn btn-outline-warning" style="color: #367fa9"></button>
                                            <button type="submit" id="btn_atributos" class="fa fa-plus btn btn-outline-success" onclick="pagVariacao({{$produto->cd_produto}});" style="color: #008d4c;">
                                                {{--<a href="{{ url('/admin/product/variation/' . $produto->cd_produto) }}">
                                                    <i class="fa fa-plus"></i>
                                                </a>--}}
                                            </button>
                                            <button id="btn_excluir" class="fa fa-trash btn btn-outline-warning" style="color: #cc0000"></button>
                                            <button id="btn_salvar" class="fa fa-check btn btn-outline-warning" style="color: #008d4c; display:none"></button>
                                            <button id="btn_cancelar" class="fa fa-remove btn btn-outline-warning" style="color: #cc0000; display: none"></button>
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
                            <form action="{{ route('product.save') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class='modal fade' id='myModal'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content' style="width: 130%">
                                            <div class='modal-header'>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class='modal-title'>
                                                    <strong><i class="fa fa-sort-amount-desc"></i>&nbsp;&nbsp;Cadastrar Variações</strong>
                                                </h4>
                                            </div>

                                            <div class='modal-body'>

                                                <!-- Nome do Produto (Modal) -->
                                                <table style="width: 100%">
                                                    <tr>
                                                        <td>
                                                            <div>
                                                                <div class="form-group">
                                                                    <label>Nome do Produto</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                                                        <input type="text" class="form-control campo_nome_modal" name="nm_produto" maxlength="50">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>

                                                <!-- Códigos SKU e Ean (Modal) -->
                                                <table style="width: 100%">
                                                    <tr>
                                                        <td style="width: 50%">
                                                            <div>
                                                                <div class="form-group">
                                                                    <label>Código (SKU)</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                                                        <input id="campo_sku" type="text" class="form-control campo_sku_modal" name="cd_sku" maxlength="20" style="text-transform: uppercase">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>&nbsp;&nbsp;&nbsp;</td>

                                                        <td style="width: 50%">
                                                            <div>
                                                                <div class="form-group">
                                                                    <label>Código (EAN)</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                                                        <input id="campo_ean" type="text" class="form-control campo_ean_modal" name="cd_ean" maxlength="13">
                                                                    </div>
                                                                    <i class="msg_ean"></i>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>

                                                <!-- Categorias (Modal) -->
                                                <table style="width: 100%">
                                                    <tr>

                                                        <input type="hidden" id="categorias" class="form-control select2 campo_cat_modal" style="width: 100%;" name="cd_categoria">

                                                        <td>&nbsp;&nbsp;&nbsp;</td>

                                                        <input type="hidden" id="subcategorias" class="form-control select2 campo_subcat_modal" style="width: 100%;" name="cd_sub_categoria" >

                                                    </tr>
                                                </table>
                                                <br>

                                                <!-- Tamanhos (Modal) -->
                                                <table style="width: 100%">
                                                    <tr>
                                                        <td style="width: 50%">
                                                            <label>Tamanho (Letra)</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                                                <select id="sl_tamanho_letra" class="form-control select2" style="width: 100%;" name="cd_tamanho_letra">
                                                                    <option value=""></option>
                                                                    @foreach($tamanhosLetras as $tamanhoLetra)
                                                                        <option value="{{ $tamanhoLetra->cd_tamanho_letra }}">{{ $tamanhoLetra->nm_tamanho_letra }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>

                                                        <td>&nbsp;&nbsp;&nbsp;</td>

                                                        <td style="width: 50%">
                                                            <label>Tamanho (Número)</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                                                <select id="sl_tamanho_num" class="form-control select2" style="width: 100%;" name="cd_tamanho_num">
                                                                    <option value=""></option>
                                                                    @foreach($tamanhosNumeros as $tamanhoNumero)
                                                                        <option value="{{ $tamanhoNumero->cd_tamanho_num }}">{{ $tamanhoNumero->nm_tamanho_num }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <br>

                                                <!-- Cor (Modal) -->
                                                <table style="width: 100%">
                                                    <tr>
                                                        <td style="width: 51%">
                                                            <label>Cor</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-paint-brush"></i></span>
                                                                <select class="form-control select2" style="width: 100%;" name="cd_cor" >
                                                                    <option value=""></option>
                                                                    @foreach($cores as $cor)
                                                                        <option value="{{ $cor->cd_cor }}">{{ $cor->nm_cor }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>

                                                        <td>&nbsp;&nbsp;&nbsp;</td>

                                                        <td style="width: 25%">
                                                            <div>
                                                                <label>Preço</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">R$</span>
                                                                    <input type="number" class="form-control campo_preco_modal" name="vl_produto" min="0">
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>&nbsp;&nbsp;&nbsp;</td>

                                                        <td style="width: 25%">
                                                            <div>
                                                                <label>Quantidade</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">0-9</span>
                                                                    <input type="number" class="form-control campo_qtd_modal" name="qt_produto" min="0">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <br>

                                                <!-- Laegura, Altura e Peso (Modal) -->
                                                <table style="width: 100%">
                                                    <tr>
                                                        <td>
                                                            <div class="form-group">
                                                                <label>Largura</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                                                                    <input type="number" class="form-control campo_largura_modal" name="ds_largura" min="0">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>&nbsp;&nbsp;&nbsp;</td>

                                                        <td>
                                                            <div class="form-group">
                                                                <label>Altura</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="fa fa-arrows-v"></i></span>
                                                                    <input type="number" class="form-control campo_altura_modal" name="ds_altura" min="0">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>&nbsp;&nbsp;&nbsp;</td>

                                                        <td>
                                                            <div class="form-group">
                                                                <label>Peso (g)</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                                                                    <input type="number" class="form-control campo_peso_modal" name="ds_peso" min="0">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>

                                                <!-- Descrição (Modal)  -->
                                                <table style="width: 100%">
                                                    <tr>
                                                        <td>
                                                            <div>
                                                                <div class="form-group">
                                                                    <label>Descrição do Produto</label>
                                                                    <div class="input-group">
                                                                       <textarea id="bold" class="campo_desc_modal" name="ds_produto" rows="5" cols="112%" style="line-height: 40px; border: 1px solid #dddddd; padding: 2px; resize: none"  maxlength="1500">
                                                                       </textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><p><span class="qtd_palavras">1500</span> caracteres</p></td>
                                                    </tr>
                                                </table>

                                                <!-- Imagens e Status (Modal) -->
                                                <table style="width: 100%">
                                                    <tr>
                                                        <td>
                                                            <div>
                                                                <div>
                                                                    <div class="form-group">
                                                                        <label>Imagens</label>
                                                                        <div class="input-group">
                                                                            <div class="file-loading">
                                                                                <input id="input-41" name="images[]" type="file" accept="image/*" multiple>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div>
                                                                <div class="box-header"><h3 class="box-title">Ativa/Desativar Produto</h3></div>
                                                                <div class="box-body">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" class="flat-red campo_status" name="status" checked>
                                                                        <label class="">Status</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>

                                                <!-- Botão Salvar (Modal) -->
                                                <div style="width: 100%" class="text-right">
                                                    <button type="submit" id="btn_salvar" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>
                </section>
            </div>

    <script src="{{asset('js/admin/jquery.cookie.js')}}"></script>
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
            })
        });

        function pagVariacao(cd_prod){
            window.location.href = '{{ url('/admin/product/variation/') }}' + '/' + cd_prod;
        }

        //Abrir o modal ao clicar no botão Atributos
        $('#btn_atributos').click(function(e){

            // e.preventDefault();
            //
            // var my_cookie = $.cookie($('.modal-check').attr('name'));
            // if (my_cookie && my_cookie == "true") {
            //     $(this).prop('checked', my_cookie);
            //     console.log('checked checkbox');
            // }
            // else{
            //     $('#myModal').modal('show');
            //     console.log('uncheck checkbox');
            // }
            //
            // $(".modal-check").change(function() {
            //     $.cookie($(this).attr("name"), $(this).prop('checked'), {
            //         path: '/',
            //         expires: 1
            //     });
            // });
        });

        var conteudoOriginal;
        //Ação de clicar no editar, pegando o conteudo e criando o input para edição
        $('button#btn_editar').click(function(){
            var campoTR = $(this).parent().parent();

            var conteudo =  campoTR.find("td:eq(4)").text();
            conteudoOriginal = conteudo;

            var campo_qt_produto = campoTR.find('#qt_produto');
            campo_qt_produto.text("");

            var campo_input = "<input id='caixa_editar' type='text' maxlength='4' ' value='" + conteudoOriginal + "'></input>";
            campo_qt_produto.append(campo_input);
            campoTR.find('#caixa_editar').focus();

            trocaBotoes(campoTR);

            campoTR.siblings().find('td:eq(5)').children().attr("disabled", "disabled");
        });

        //Ação que salva o valor digitado dentro do input, e coloca o novo valor dentro do TD
        $('button#btn_salvar').click(function(){
            var campoTR = $(this).parent().parent();
            var conteudoAtualizado = campoTR.find("#caixa_editar").val();
            var campo_qt_produto = campoTR.find("td:eq(4)");
            var regLetras = new RegExp("^[0-9]*$");

            if(conteudoAtualizado.length == 0 || !regLetras.exec(conteudoAtualizado)){
                $("#caixa_editar").focus();

                return;
            }

            campo_qt_produto.text(conteudoAtualizado);

            campo_qt_produto.remove('#caixa_editar');

            campoTR.siblings().find('td:eq(5)').children().removeAttr("disabled");

            trocaBotoes(campoTR);
        });

        //Ação para cancelar as mudanças feitas dentro do input
        $('button#btn_cancelar').click(function(){
            var campoTR = $(this).parent().parent();
            var campo_qt_produto = campoTR.find("td:eq(4)");
            campo_qt_produto.remove("#caixa_editar");

            campo_qt_produto.text(conteudoOriginal);

            campoTR.siblings().find('td:eq(5)').children().removeAttr("disabled");
            trocaBotoes(campoTR);
        });


        //Função para troca de botões, transição do display none para block
        function trocaBotoes(campoTR){
            campoTR.find('#btn_editar').toggle();
            campoTR.find('#btn_excluir').toggle();
            campoTR.find('#btn_salvar').toggle();
            campoTR.find('#btn_cancelar').toggle();
            campoTR.find('#btn_atributos').toggle();
        }

    </script>

    <script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>
 {{--   <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap4.js"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- page script -->--}}



@stop

