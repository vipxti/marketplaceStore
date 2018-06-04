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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Produto</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                        <input type="text" class="form-control" name="nm_produto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Código (Ean)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                        <input type="text" class="form-control" name="cd_ean">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Código (SKU)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                        <input type="text" class="form-control" name="cd_ean">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descrição</label>
                                    <div class="input-group">
                                    <textarea id="bold" name="ds_produto" rows="2" cols="107%" style="font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 2px;">
                                    </textarea>
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
                                <label>Tamanho</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                    <select class="form-control select2" style="width: 100%;" name="cd_tamanho">
                                        <option value=""></option>
                                        @foreach($tamanhos as $tamanho)

                                            <option value="{{ $tamanho->cd_tamanho }}">{{ $tamanho->nm_tamanho }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div>&nbsp;</div>

                        <div class="col-md-12">


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Largura</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                                        <input type="number" class="form-control" name="ds_largura">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Altura</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-arrows-v"></i></span>
                                        <input type="number" class="form-control" name="ds_altura">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Peso</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                                        <input type="number" class="form-control" name="ds_peso">
                                    </div>
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



                        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                    </form>
                </div>
                <!--<div class="box-footer">
                    Footer
                </div>-->
                <!-- /.box-footer-->
            </div>
        </section>
    </div>

    <script>

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

    </script>

@stop


