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
    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-plus"></i>&nbsp;&nbsp;Cadastrar Marcas</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li class="active">Cadastrar Marcas</li>
            </ol>
        </section>

        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Cadastrar Marca</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{route('marca.save')}}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nome Marca:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-puzzle-piece"></i></span>
                                        <input type="text" class="form-control" name="nome_marca" required maxlength="45">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                            </div>
                        </div>
                        <!-- .row -->
                    </form>

                </div>
                <!-- .box-body -->
            </div>
            <!-- .box-primary -->
        </section>

        <!-- SESSÃO DA LISTA DOS CANAIS -->
        <section class="content">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista das Marcas</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="text-align: left">ID Marca</th>
                                <th style="text-align: left">Nome Marca</th>
                                <th style="text-align: left"></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($marca as $m)
                                <tr>
                                    <td>{{$m->id_marca}}</td>
                                    <td>{{$m->nome_marca}}</td>
                                    <td>
                                    <td class="pull-right">
                                        <button id="btn_editar" title="Editar Marca"
                                                class="fa fa-pencil btn btn-outline-warning"
                                                data-toggle="modal" data-target="#modal-default" style="color: #367fa9">
                                        </button>
                                        {{--<a href="{{route('marca.update', $m->id_marca)}}" title="Editar Marca" class="btn btn-outline-warning">
                                            <i class="fa fa-pencil"></i>
                                        </a>--}}
                                        <button id="btn_excluir"
                                                value="{{$m->id_marca}}"
                                                title="Deletar Marca"
                                                class="btn btn-outline-warning"
                                                style="color: #cc0000">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!--  FIM SESSÃO DA LISTA -->

        <!-- MODAL ATUALIZA MARCA -->
        <form action="{{route('marca.update')}}" method="post" enctype="multipart/form-data">

            <div class="modal fade" id="modal-default">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Atualizar Nome Marca</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-12">


                                {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>ID Marca:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                    <input id="id_modal" type="text" class="form-control" name="id_marca" readonly required maxlength="45">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nome Marca:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-puzzle-piece"></i></span>
                                                    <input id="nome_modal" type="text" class="form-control" name="nome_marca" required maxlength="45">
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
        <!-- FIM MODAL MARCA -->
    </div>

    <script src="{{asset('js/admin/sweetalert.min.js')}}"></script>
    <script>
        $(function(){
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $('button#btn_editar').click(function(){
                let campoTR = $(this).parent().parent();
                let id = campoTR.find('td:first').text();
                let nome = campoTR.find('td:eq(1)').text();

                $('#id_modal').val(id);
                $('#nome_modal').val(nome);
            });

            $('button#btn_excluir').click(function(){
                let id_marca = $(this).val();
                let campoTR = $(this).parent().parent();

                swal({
                    title: "Você tem certeza que deseja deletar ?",
                    text: "Uma vez deletada, você não terá mais acesso a essa loja.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((vaiApagar) => {
                        if(vaiApagar){

                            $.ajax({
                                url: '{{route('marca.delete')}}',
                                type: 'post',
                                data: {_token: CSRF_TOKEN, id_marca: id_marca},
                                success: function(data){
                                    if(data.deuErro == false){
                                        campoTR.fadeOut(500, function () {
                                            $(this).remove();

                                            swal("Loja deletada com sucesso!", {
                                                icon: "success",
                                            });
                                        });
                                    }
                                    else{
                                        swal("Erro ao deletar a loja.", {
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