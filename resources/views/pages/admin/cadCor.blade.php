@extends('layouts.admin.app')

@section('content')
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
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><i class="fa fa-paint-brush"></i>&nbsp;&nbsp;Cadastrar Cor</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Produto</a></li>
                <li class="active">Cadastrar Cor</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('partials.admin._alerts')

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <form action="{{ route('color.save') }}" method="post">
                        {{ csrf_field() }}

                        <div class="col-md-12">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Cor</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-paint-brush"></i></span>
                                            <input type="text" minlength="0" maxlength="40" class="form-control" name="nm_cor">
                                        </div>
                                    </div>
                                </div>

                            <div>&nbsp;</div>
                        </div>

                        <div class="col-md-12 text-right">
                            <button type="submit" id="btnSalvarCor" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                        </div>

                    </form>
                </div>
            </div>
        </section>



        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body">

                    <!-- Botão pesquisar -->
                    <div style="padding-left: 70%">
                        <div>
                            <input type="search" id="search" value="" class="form-control">
                        </div>
                    </div>
                    <div>&nbsp;</div>


                    <div class="dataTables_length" style="padding-left: 90%" id="example1_length">
                        <select name="example1_length" aria-controls="example1" class="form-control form-control-sm">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>

                    <!-- Tabelas dos produtos -->


                    <table class="table" id="table">
                        <thead>
                        <tr>
                            <th class="text-center">Código</th>
                            <th class="text-center">Cor</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($cores as $cor)

                            <tr class="text-center">
                                <td>{{ $cor->cd_cor }}</td>
                                <td id="nome_cor">{{ $cor->nm_cor }}</td>
                                <td class="text-right">
                                    <button id="btn_editar" class="fa fa-pencil btn btn-outline-warning" style="color: #367fa9"></button>
                                    <button id="btn_salvar" class="fa fa-check btn btn-outline-success" style="color: #008d4c; display: none"></button>
                                    <button id="btn_cancelar" class="fa fa-remove btn btn-outline-danger" style="color: #cc0000; display: none"></button>
                                    <button id="btn_excluir" class="fa fa-trash btn btn-outline-warning" style="color: #cc0000"></button>
                                </td>
                            </tr>


                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <script src="{{asset('js/admin/jquery.blockUI.js')}}"></script>
    <script>
        $('#btnSalvarCor').click(function(){
            $.blockUI({
                message: 'Salvando...',
                css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: .5,
                    color: '#fff'
                } });

            setTimeout($.unblockUI, 4000);
        });



        $(document).ready(function(){

            //cor branco
            $("table tbody tr:odd").css("background-color", "#fff");
            //cor cinza
            $("table tbody tr:even").css("background-color", "#f5f5f5");

            var conteudoOriginal;

            //Ação de clicar no editar, pegando o conteudo e criando o input para edição
            $('button#btn_editar').click(function(){
                var campoTR = $(this).parent().parent();

                var conteudo =  campoTR.find("td:eq(1)").text();
                conteudoOriginal = conteudo;

                var campo_cor = campoTR.find('#nome_cor');
                campo_cor.text("");

                var campo_input = "<input id='caixa_editar' type='text' maxlength='40' ' value='" + conteudoOriginal + "'></input>";
                campo_cor.append(campo_input);
                campoTR.find('#caixa_editar').focus();

                trocaBotoes(campoTR);

                campoTR.siblings().find('td:eq(2)').children("button#btn_editar").attr("disabled", "disabled");
                campoTR.siblings().find('td:eq(2)').children("button#btn_excluir").attr("disabled", "disabled");
            });

            //Ação que salva o valor digitado dentro do input, e coloca o novo valor dentro do TD
            $('button#btn_salvar').click(function(){
                var campoTR = $(this).parent().parent();
                var conteudoAtualizado = campoTR.find("#caixa_editar").val();
                var campo_cor = campoTR.find("td:eq(1)");

                if(conteudoAtualizado.length == 0){
                    $("#caixa_editar").focus();

                    return;
                }

                campo_cor.text(conteudoAtualizado);

                campo_cor.remove('#caixa_editar');

                campoTR.siblings().find('td:eq(2)').children("button#btn_editar").removeAttr("disabled");
                campoTR.siblings().find('td:eq(2)').children("button#btn_excluir").removeAttr("disabled");
                trocaBotoes(campoTR);
            });


            //Ação para cancelar as mudanças feitas dentro do input
            $('button#btn_cancelar').click(function(){
                var campoTR = $(this).parent().parent();
                var campo_cor = campoTR.find("td:eq(1)");
                campo_cor.remove("#caixa_editar");

                campo_cor.text(conteudoOriginal);

                campoTR.siblings().find('td:eq(2)').children("button#btn_editar").removeAttr("disabled");
                campoTR.siblings().find('td:eq(2)').children("button#btn_excluir").removeAttr("disabled");
                trocaBotoes(campoTR);
            });

            //Função para troca de botões, transição do display none para block
            function trocaBotoes(campoTR){
                campoTR.find('#btn_editar').toggle();
                campoTR.find('#btn_salvar').toggle();
                campoTR.find('#btn_cancelar').toggle();
                campoTR.find('#btn_excluir').toggle();
            }

        });
    </script>

@stop
