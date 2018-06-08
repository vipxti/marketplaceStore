@extends('layouts.admin.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">

           <h1>Categorias</h1>

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
                                    <div class="form-group">
                                        <label>Categoria</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                            <select id="categorias" class="form-control select2" style="width: 100%;" name="cd_categoria" >
                                                <option value=""></option>

                                                @foreach($categorias as $categoria)

                                                    <option value="{{ $categoria->cd_categoria }}">{{ $categoria->nm_categoria }}</option>

                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <form id="fCat" class="form-horizontal" action="{{ route('category.save') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="col-md-6">
                                        <label>Alterar Categoria</label>
                                        <input class="form-control" type="hidden" id="catId" name="catId">
                                        <input type="text" class="form-control" id="catName" name="nm_categoria" maxlength="35">
                                    </div>
                                    <div>&nbsp;</div>
                                    <div>&nbsp;</div>


                                    <div class="col-md-12 text-right" >
                                        <button type="submit" id="btn_salvar"  class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--SUB-CATEGORIA-->
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
                                    <div class="form-group">
                                        <label>Sub-Categoria</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                            <select id="subcategorias" class="form-control select2" style="width: 100%;" name="cd_subcategoria" >
                                                <option value=""></option>

                                                @foreach($subcategorias as $subcategoria)

                                                    <option value="{{ $subcategoria->cd_sub_categoria }}">{{ $subcategoria->nm_sub_categoria }}</option>

                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <form id="fCat" class="form-horizontal" action="{{ route('subcategory.save') }}" method="post">
                                    {{ csrf_field() }}

                                    <div class="col-md-6" id="subcategoria">
                                        <label>&nbsp;</label>
                                        <input class="form-control" type="hidden" name="catId">

                                        <input type="text" class="form-control" name="nm_sub_category" maxlength="35">
                                        <div class="text-right">

                                            {{--<div class="icon-tamanho">--}}
                                                {{--<button  type="submit" class="btn btn-danger"><i class="fa fa-remove"></i></button>--}}
                                                {{--<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>--}}
                                            {{--</div>--}}

                                        </div>
                                    </div>
                                    <div>&nbsp;</div>

                                    <div class="col-md-12" >
                                        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!--CATEGORIAS -->
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

                                <form id="fCat" class="form-horizontal" action="{{ route('catsubcat.associate') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="col-md-6">
                                        <label>Principal</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                            <select id="categorias" class="form-control select2" style="width: 100%;" name="cd_categoria" >

                                                @foreach($categorias as $categoria)

                                                    <option value="{{ $categoria->cd_categoria }}">{{ $categoria->nm_categoria }}</option>

                                                @endforeach

                                            </select>
                                        </div>
                                        <p>&nbsp;</p>
                                    </div>
                                </div>

                                <form id="fCat" class="form-horizontal" action="{{ route('catsubcat.associate') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="col-md-6">
                                        <label>Associar Sub-Categoria</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                            <select id="subcategorias" class="form-control select2" multiple="multiple" style="width: 100%;" name="cd_sub_categorias[]" >

                                                @foreach($subcategorias as $subcategoria)

                                                    <option value="{{ $subcategoria->cd_sub_categoria }}">{{ $subcategoria->nm_sub_categoria }}</option>

                                                @endforeach

                                            </select>
                                        </div>
                                        <div>&nbsp;</div>
                                        <div class="col-md-12 text-right" >
                                            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                </div>
            </div>

        </section>
    </div>

    <script src="{{ asset('js/admin/select2.full.min.js') }}"></script>
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

        // $('#btn_salvar').click(function (e) {
        //     e.preventDefault();
        //
        //     console.log('Ok');
        //
        //
        //
        // });

        $(function(){
            $('.select2').select2()
        })

    </script>

@stop
