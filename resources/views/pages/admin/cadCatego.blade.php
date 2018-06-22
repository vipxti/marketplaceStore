@extends('layouts.admin.app')

@section('content')


    <link rel="stylesheet" href="{{asset('css/admin/TreeViewEstilo.css')}}">
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

        <!-- Cadastrar Categorias -->
        <section class="content">
            @include('partials.admin._alerts')

            <div class="row">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Categoria</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                            <select id="categorias" class="form-control select2-selection select2-selection--single" name="cd_categoria" >
                                                <option></option>
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
                                        <div class="form-group" style="margin-right: 0 !important;">
                                            <label>Cadastrar/Alterar</label>
                                            <div class="input-group-prepend">
                                                <input class="form-control" type="hidden" id="catId" name="catId">
                                                <input type="text" id="catName" class="form-control" name="nm_categoria" maxlength="35">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

               <!-- Cadastrar Sub-Categoria -->
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sub-Categoria</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                            <select id="subcategorias" class="form-control form-control select2-selection select2-selection--single" style="width: 100%;" name="cd_sub_categoria" >
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
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-right: 0 !important;">
                                            <label>Cadastrar/Alterar</label>
                                            <div class="input-group-prepend">
                                                <input class="form-control" type="hidden" id="subcatId" name="cat_sub_Id">
                                                <input type="text" id="subCatNome" class="form-control" name="nm_sub_categoria" maxlength="35">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
            </div>

            <div class="row">
                <!-- Associação dos produtos -->
                <div class="col-md-6">
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
                                        <div class="col-md-6">
                                            <div class="input-group-prependp">
                                                <label>Principal</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                                    <select id="categorias" class="form-control form-control select2-selection select2-selection--single" style="width: 100%;" name="cd_categoria" >
                                                        <option></option>
                                                        @foreach($categorias as $categoria)
                                                            <option value="{{ $categoria->cd_categoria }}">{{ $categoria->nm_categoria }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="margin-right: 0 !important;">
                                        <label>Associar Sub-Categoria</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                            <select id="subcategorias" class="form-control select2 form-control select2-selection select2-selection--single" multiple="multiple" style="width: 100%;" name="cd_sub_categorias[]" >
                                                @foreach($subcategorias as $subcategoria)
                                                    <option value="{{ $subcategoria->cd_sub_categoria }}">{{ $subcategoria->nm_sub_categoria }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Lista das categorias cadastradas -->
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Lista de Categorias</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    @foreach($categorias as $categoria)
                                        <ul class="treeview lista">
                                            <li id="liCategoria" onclick="listarSubCategorias({{$categoria->cd_categoria}}, this)"><a href="#">
                                                {{$categoria->nm_categoria}}
                                                <ul class="ulFilho"></ul>
                                                </a>
                                            </li>
                                        </ul>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>


    <script src="{{ asset('js/admin/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/admin/TreeViewScript.js') }}"></script>
    <script>
        var arrayCat = [];
        var verificaCat = false;
        function listarSubCategorias(categoria, elementLi){

            for(var i=0; i < arrayCat.length; i++){
                if(categoria == arrayCat[i]){
                    verificaCat = true;
                }
            }

            if(!verificaCat) {
                $.ajax({
                    url: '{{ url('/admin/subcat') }}/' + categoria,
                    type: 'GET',
                    success: function (data) {
                        //console.log(data.subcat);
                        //console.log($(elementLi).find(".filho"));
                        $(elementLi).find(".filho").empty();
                        $.each(data.subcat, function (index, subcategoria) {
                            $(elementLi).append(`<ul><li class="filho">` + subcategoria.nm_sub_categoria + `</li></ul>`);
                        })

                        arrayCat.push(categoria);
                    }
                });
            }
            verificaCat = false;
        }
        $('#categorias').change(function (e) {
            e.preventDefault();
            $cd_categoria = $(this).val();
            $("#catId").val($('#categorias option:selected').val());
            $("#catName").val($('#categorias option:selected').text());
            $.ajax({
                url: '{{ url('/admin/subcat') }}/' + $cd_categoria,
                type: 'GET',
                success: function (data) {
                    $('#subcategorias').empty();
                    $.each(data.subcat, function(index, subcategoria) {
                        $('#subcategorias').append(`<option value="` + subcategoria.cd_sub_categoria + `">` + subcategoria.nm_sub_categoria + `</option>`);
                    });
                    $("#subCatNome").val($("#subcategorias option:selected").text());
                }
            });
        });
        $("#subcategorias").change(function(){
            $("#subcatId").val($("#subcategorias option:selected").val());
            $("#subCatNome").val($("#subcategorias option:selected").text());
            console.log($("#subcategorias option:selected").val());
            console.log($("#subcategorias option:selected").text());
        });
        $(function(){
            $('.select2').select2();
        })
    </script>
@stop
