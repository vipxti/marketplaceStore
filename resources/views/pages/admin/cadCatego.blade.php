@extends('layouts.admin.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">

           <h1>
              Categorias/Sub-Categorias
           </h1>

            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a class="active">Categoria/Sub-Categoria</a></li>
            </ol>

        </section>

        <section id="content" class="content">
            <!--CATEGORIA-->
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <label>Principal</label>
                                   <!-- <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-tag"></i>
                                        </div>
                                        <input type="text" class="form-control">
                                    </div>-->
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                        <select id="categorias" class="form-control select2" style="width: 100%;" name="cd_categoria">
                                            <option value=""></option>
                                            @foreach($categorias as $categoria)

                                                <option value="{{ $categoria->cd_categoria }}">{{ $categoria->nm_categoria }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <form id="fCat" class="form-horizontal" action="{{ route('category.save') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="col-md-6">
                                        <label>Alterar Categoria</label>
                                        <input class="form-control" type="hidden" id="catId" name="catId">
                                        <input type="text" class="form-control" id="catName"  name="nm_categoria" maxlength="35">
                                    </div>
                                    <div>&nbsp;</div>

                                    <button type="submit" class="btn btn-success pull-right">&nbsp;&nbsp;Salvar</button>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="box-footer box-info"></div>
                </div>
            </div>

            <!--SUB-CATEGORIA-->

            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sub-Catagoria</label>
                                       <!-- <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-tags"></i>
                                            </div>
                                            <input type="text" class="form-control">
                                        </div>-->
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                            <select id="categorias" class="form-control select2" style="width: 100%;" name="cd_cor">
                                                <option value=""></option>
                                                @foreach($categorias as $categoria)

                                                    <option value="{{ $categoria->cd_categoria }}">{{ $categoria->nm_categoria }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <form id="fSubCat" class="form-horizontal" action="#" method="post">
                                    {{ csrf_field() }}
                                    <div class="col-md-6">
                                        <div class="form-group has-success">
                                            <label>
                                                <br>
                                            </label>
                                            <input class="form-control" type="hidden" id="subCatId" name="subCatId">
                                            <input type="text" class="form-control" id="subCatName" name="subCatName" maxlength="35">
                                            <label class="control-label" hidden for="inputSuccess"><i class="fa fa-check"></i></label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success pull-right">Salvar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                             <form id="fCat" class="form-horizontal" action="#" method="post">
                                 <div class="col-md-6">
                                     <label>Categoria</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-paint-brush"></i></span>
                                            <select id="categorias" class="form-control select2" style="width: 100%;" name="cd_cor">
                                                <option value=""></option>
                                                @foreach($categorias as $categoria)

                                                    <option value="{{ $categoria->cd_categoria }}">{{ $categoria->nm_categoria }}</option>
                                                @endforeach
                                            </select>
                                         </div>
                                     </div>

                                     <div class="col-md-6">
                                         <label>Sub-Categoria</label>
                                         <div class="input-group">
                                             <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                             <select id="subcategorias" class="form-control select2" style="width: 100%;" name="cd_sub_categooria">
                                                 <option selected="selected"></option>

                                             </select>
                                         </div>
                                     </div>
                                 <div>
                                 </div>

                                 <div class="col-md-12">
                                     <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                 </div>
                             </form>
                        </div>
                    </div>

                    <div class="box-footer box-info"></div>
                </div>
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
