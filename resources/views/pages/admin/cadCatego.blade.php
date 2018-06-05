@extends('layouts.admin.app')

@section('content')

    <script type="text/javascript">

        function duplicarCampos(){
            var clone = document.getElementById('subcategoria').cloneNode(true);
            var destino = document.getElementById('destino');
            destino.appendChild (clone);
            var camposClonados = clone.getElementsByTagName('input');
            for(i=0; i<camposClonados.length;i++){
                camposClonados[i].value = '';
            }
        }
        function removerCampos(id){
            var node1 = document.getElementById('destino');
            node1.removeChild(node1.childNodes[0]);
        }
    </script>


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
                                            <select id="subcategorias" class="form-control select2" style="width: 100%;" name="cd_subcategoria" >
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <form id="fCat" class="form-horizontal" action="#" method="post">
                                    {{ csrf_field() }}
                                    <div class="col-md-6">
                                        <label>Alterar Categoria</label>
                                        <input class="form-control" type="hidden" id="catId" name="catId">
                                        <input type="text" class="form-control" id="catName" name="catName" maxlength="35">
                                    </div>
                                    <div>&nbsp;</div>

                                    <div class="col-md-12 text-right" >
                                        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
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
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <form id="fCat" class="form-horizontal" action="#" method="post">
                                    {{ csrf_field() }}

                                    <div class="col-md-6" id="subcategoria">
                                        <label>&nbsp;</label>
                                        <input class="form-control" type="hidden" name="catId">

                                        <input type="text" class="form-control" name="catName" maxlength="35">
                                        <div class="text-right">
                                            <img src="{{ asset('img/admin/add.png') }}" style="cursor: pointer; height: 15px; width: 15px" onclick="duplicarCampos();">
                                            <img src="{{ asset('img/admin/remover.png') }}" style="cursor: pointer; height: 15px; width: 15px" onclick="removerCampos(this);">
                                        </div>
                                    </div>

                                    <div id="destino">
                                    </div>
                                    <div>&nbsp;</div>

                                    <div class="col-md-12 text-right" >
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
                                <div class="col-md-6">
                                    <label>Principal</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-tag"></i>
                                        </div>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <form id="fCat" class="form-horizontal" action="#" method="post">
                                    {{ csrf_field() }}
                                    <div class="col-md-6">
                                        <label>Alterar Categoria</label>
                                        <input class="form-control" type="hidden" id="catId" name="catId">
                                        <input type="text" class="form-control" id="catName" name="catName" maxlength="35">
                                    </div>
                                    <div>&nbsp;</div>

                                    <div class="col-md-12 text-right" >
                                        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
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
