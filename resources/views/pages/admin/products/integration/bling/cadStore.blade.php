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
            <h1><i class="fa fa-tags"></i>&nbsp;&nbsp;Cadastrar Lojas Bling</h1>
            <ol class="breadcrumb">
                <li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="javascript:void(0)">Integração</a></li>
                <li><a href="javascript:void(0)">Bling</a></li>
                <li><a href="javascript:void(0)">Atualizar Produtos</a></li>
                <li class="active">Cadastrar Loja</li>
            </ol>
        </section>

        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Cadastrar Loja</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{route('save.store.bling')}}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ID Loja:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
                                        <input type="text" class="form-control" name="id_loja" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nome Loja:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                        <input type="text" class="form-control" name="nome_loja" required  maxlength="45">
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
                    <h3 class="box-title">Lista das Lojas</h3>
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
                                <th style="text-align: left">ID Loja</th>
                                <th style="text-align: left">Nome Loja</th>
                                <th style="text-align: left"></th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($lojas as $loja)
                                    <tr>
                                        <td>{{$loja->id_loja}}</td>
                                        <td>{{$loja->nome_loja}}</td>
                                        <td class="pull-right">
                                            <a href="{{route('index.edit.store.bling', $loja->id_loja)}}" title="Editar Loja" class="btn btn-outline-warning">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <button id="btn_excluir"
                                                value="{{$loja->id_loja}}"
                                               title="Deletar Loja"
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
        </section>
        <!--  FIM SESSÃO DA LISTA -->
    </div>

    <script src="{{asset('js/admin/sweetalert.min.js')}}"></script>
    <script>
        $(function(){
            $('button#btn_excluir').click(function(){
                console.log($(this).val());
                let id_loja = $(this).val();
                let campoTR = $(this).parent().parent();
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


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
                                url: '{{url('admin/bling/delete/storebling/')}}/' + id_loja,
                                type: 'post',
                                data: {_token: CSRF_TOKEN},
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