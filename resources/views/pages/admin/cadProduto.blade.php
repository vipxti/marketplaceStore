@extends('layouts.admin.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Produto</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active">Produto</li>
                <li><a href="#">Cadastro de produto</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
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
                    <form action="{{ route('product.save') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-12">

                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Nome do Produto</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                        <input type="text" class="form-control" name="nm_produto" maxlength="50">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Código (SKU)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                        <input id="campo_sku" type="text" class="form-control" name="cd_ean" maxlength="20" style="text-transform: uppercase">

                                    </div>
                                    <p class="msg_sku"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Código (Ean)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                        <input id="campo_ean" type="text" class="form-control" name="cd_ean" maxlength="13">
                                    </div>
                                    <p class="msg_ean"></p>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descrição do Produto</label>
                                    <div class="input-group">
                                    <textarea id="bold" class="campo_desc" name="ds_produto" rows="5" cols="107%" style="font-size: 14px; line-height: 40px; border: 1px solid #dddddd; padding: 2px; resize: none" maxlength="1500">
                                    </textarea>
                                        <p><span class="qtd_palavras">1500</span> caracteres</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Preço</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input type="number" class="form-control" name="vl_produto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Categoria</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                    <select id="categorias" class="form-control select2" style="width: 100%;" name="cd_categoria">
                                        <option value=""></option>

                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->cd_categoria }}">{{ $categoria->nm_categoria }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Sub-Categoria</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                        <select id="subcategorias" class="form-control select2" style="width: 100%;" name="cd_subcategoria" >
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-4">
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
                            </div>
                            <div class="col-md-4">
                                <label>Tamanho (Letra)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                    <select class="form-control select2" style="width: 100%;" name="cd_tamanho_letra">
                                        <option value=""></option>
                                        @foreach($tamanhosLetras as $tamanhoLetra)
                                            <option value="{{ $tamanhoLetra->cd_tamanho_letra }}">{{ $tamanhoLetra->nm_tamanho_letra }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Tamanho (Número)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                    <select class="form-control select2" style="width: 100%;" name="cd_tamanho_num">
                                        <option value=""></option>
                                        @foreach($tamanhosNumeros as $tamanhoNumero)
                                        <option value="{{ $tamanhoNumero->cd_tamanho_num }}">{{ $tamanhoNumero->nm_tamanho_num }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div>&nbsp;</div>
                        <div class="col-md-10">
                            <div class="col-md-3">
                                <label>Largura</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                                    <input type="number" name="ds_largura">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Altura</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-arrows-v"></i></span>
                                    <input type="number" name="ds_altura">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Peso</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                                    <input type="number" name="ds_peso">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div>&nbsp;</div>
                            <div>&nbsp;</div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Imagens</label>
                                    <div class="input-group">
                                        <div class="file-loading">
                                            <input id="input-41" name="images[]" type="file" accept="image/*" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="box-header"><h3 class="box-title">Ativa/Desativar Produto</h3></div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <input type="checkbox" class="flat-red" name="status" checked>
                                        <label class="">Status</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                      <div class="col-md-12">
                        <div class="col-md-1">
                           <button type="submit" id="btn_atributos" class="btn btn-success pull-right"><i class="fa fa-sort-amount-desc"></i>&nbsp;&nbsp;Atributos</button>
                                <div class='modal fade' id='myModal'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class='modal-title'>
                                                    <strong>INSERIR ATRIBUTOS</strong>
                                                </h4>
                                            </div>
                                            <!-- / modal-header -->
                                            <div class='modal-body'>
                                                <!-- COLOCAR AQUI OS CAMPOS PARA FICAR DENTRO DO MODAL -->
                                                <label>Nome</label>
                                                <input type="text">
                                            </div>
                                            <!-- / modal-body -->
                                        </div>
                                        <!-- / modal-content -->
                                    </div>
                                    <!--/ modal-dialog -->
                                </div>
                                <!-- / modal -->
                        </div>
                        <div class="col-md-1">
                           <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                         </div>
                      </div>

                    </form>
                </div>
                <!--<div class="box-footer">
                    Footer
                </div>-->
                <!-- /.box-footer-->
            </div>
        </section>
    </div>

    <script src="{{asset('js/admin/jquery.cookie.js')}}"></script>
    <script>

        //Chama a funcção de contagem de palavras ao carregar a página
        $(document).ready(function(){
           contadorPalavras();
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

        });


        //Contagem de palavras na TextArea da Descrição
        function contadorPalavras() {

            $('.campo_desc').text("");

            $('.campo_desc').on("input", function () {
                var conteudo = $('.campo_desc').val();
                var qtdCaracter = 1500 - conteudo.length;


                $('.qtd_palavras').html(qtdCaracter);

            });
        }

        //Abrir o modal ao clicar no botão alterar
        $('#btn_atributos').click(function(){

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

        });


    </script>

@stop


