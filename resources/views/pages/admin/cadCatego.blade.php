@extends('layouts.admin.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
           <h1 style="padding: 0 20px"><i class="fa fa-tags"></i>&nbsp;&nbsp;Categorias</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Produtos</a></li>
                <li><a href="#">Atributos</a></li>
                <li><a class="active">Cadastrar Categorias</a></li>
            </ol>
        </section>


        <section class="content">

            @include('partials.admin._alerts')


            <!-- Cadastrar Categoria -->
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cadastrar Menu</h3>
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="box-body">
                        <form id="fCat" class="form-horizontal" action="{{ route('category.save') }}" method="post">
                            {{ csrf_field() }}

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Categoria</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                        <select id="categorias" class="form-control select2" name="cd_categoria" >
                                            <option value=""></option>

                                            @foreach($categorias as $categoria)

                                                <option value="{{ $categoria->cd_categoria }}">{{ $categoria->nm_categoria }}</option>

                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Alterar Categoria</label>
                                    <div class="input-group">
                                        <input class="form-control" type="hidden" id="catId" name="catId">
                                        <input type="text" class="form-control" id="catName" name="nm_categoria" maxlength="35">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Cadastrar Categoria -->
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cadastrar Sub-Categoria</h3>
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="box-body">

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Sub-Categoria</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                        <select id="subcategorias" class="form-control select2" style="width: 100%;" name="cd_sub_categoria" >
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

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Alterar Sub-Categoria</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="nm_sub_categoria" maxlength="35">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cadastrar Categoria -->
        <section class="content">

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Associação</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="box-body">

                        <form id="fCat" class="form-horizontal" action="{{ route('catsubcat.associate') }}" method="post">
                            {{ csrf_field() }}

                            <div>
                                <div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Principal</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                                <select id="categorias" class="form-control select2" style="width: 100%;" name="cd_categoria" >

                                                    @foreach($categorias as $categoria)

                                                        <option value="{{ $categoria->cd_categoria }}">{{ $categoria->nm_categoria }}</option>

                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div>
                                    <div class="col-md-offset-1">
                                        <div class="form-group">
                                            <label>Associar Sub-Categoria</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                                <select id="subcategorias" class="form-control select2" multiple="multiple" style="width: 100%;" name="cd_sub_categorias[]" >

                                                    @foreach($subcategorias as $subcategoria)

                                                        <option value="{{ $subcategoria->cd_sub_categoria }}">{{ $subcategoria->nm_sub_categoria }}</option>

                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                            </div>
                        </form>
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

        $(function(){
            $('.select2').select2()
        })

    </script>

@stop
