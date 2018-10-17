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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><i class="fa fa-picture-o"></i>&nbsp;&nbsp;Banner Principal</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Configuração Home</a></li>
                <li class="active">Banner</li>
            </ol>
        </section>

        <!-- BANNER 1 -->
        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Banner</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <form action="{{ route('save.banner') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Titulo</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                        <input type="text" maxlength="40" class="form-control" name="titulo_banner">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="form-group">
                                    <label>URL</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                        <input type="text" maxlength="100" class="form-control" name="url_banner">
                                    </div>
                                </div>
                            </div>

                            <div>&nbsp;</div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Banner<small>&nbsp;(recomendavél usar tamanho de 1500x485)</small></label>
                                    <div class="file-loading">
                                        <input id="input-41" name="images[]" type="file" accept="image/*" multiple>
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
        </section>


        <!-- LISTA DE BANNERS -->

        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de Banners</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body">

                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table id="table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Banner</th>
                                        <th>Titulo</th>
                                        <th>Url</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($banner as $b)
                                        <tr>
                                            <td>{{$b->id_banner}}</td>
                                            <td><img class="" src="{{ URL::asset('img/app/banner/' . $b->img_banner) }}" alt="{{ $b->titulo_banner }}" style="width: 150px; height: 120px;"></td>
                                            <td>{{$b->titulo_banner}}</td>
                                            @if($b->url_banner != null)
                                                <td>{{$b->url_banner}}</td>
                                            @else
                                                <td>-</td>
                                            @endif
                                            <td class="pull-right">
                                                <button id="btn_editar" title="Editar Banner"
                                                        class="fa fa-pencil btn btn-outline-warning"
                                                        data-toggle="modal" data-target="#modal-default" style="color: #367fa9">
                                                </button>
                                                <button id="btn_excluir"
                                                        value="{{$b->id_banner}}"
                                                        title="Deletar Banner"
                                                        class="btn btn-outline-warning"
                                                        style="color: #cc0000">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- MODAL ATUALIZA BANNER -->
        <form action="{{route('update.banner')}}" method="post" enctype="multipart/form-data">

            <div class="modal fade" id="modal-default">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Atualizar Banner</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-12">

                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>ID Banner:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                    <input id="id_modal" type="text" class="form-control" name="id_banner" readonly required maxlength="45">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Titulo Banner:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                                    <input id="titulo_modal" type="text" class="form-control" name="titulo_banner" required maxlength="40">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Url Banner:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                                    <input id="url_modal" type="text" class="form-control" name="url_banner" maxlength="100">
                                                </div>
                                            </div>
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
        <!-- FIM MODAL BANNER -->

    </div>
    <script>
        $(function(){
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $('button#btn_editar').click(function(){
                let campoTR = $(this).parent().parent();
                let id = campoTR.find('td:first').text();
                let titulo = campoTR.find('td:eq(2)').text();
                let url = campoTR.find('td:eq(3)').text();

                if(url === "-")
                    url = "";

                $('#id_modal').val(id);
                $('#titulo_modal').val(titulo);
                $('#url_modal').val(url);
            });

            $('button#btn_excluir').click(function(){
                let id_banner = $(this).val();
                let campoTR = $(this).parent().parent();

                swal({
                    title: "Você tem certeza que deseja deletar ?",
                    text: "Uma vez deletada, você não terá mais acesso a esse banner.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((vaiApagar) => {
                        if(vaiApagar){

                            $.ajax({
                                url: '{{url('admin/delete/banner/')}}/' + id_banner,
                                type: 'post',
                                data: {_token: CSRF_TOKEN},
                                success: function(data){
                                    if(data.deuErro == false){
                                        campoTR.fadeOut(500, function () {
                                            $(this).remove();

                                            swal("Banner deletado com sucesso!", {
                                                icon: "success",
                                            });
                                        });
                                    }
                                    else{
                                        swal("Erro ao deletar o banner.", {
                                            icon: "error",
                                        });
                                    }
                                }
                            });
                        }
                    });
            });
        });
    </script>
@stop
