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
            <h1 style="padding: 0 20px"><i class="fa fa-arrows-h"></i>&nbsp;&nbsp;Cadastrar Tamanho</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Produtos</a></li>
                <li><a href="#">Atributos</a></li>
                <li><a class="active">Cadastrar Tamanhos</a></li>
            </ol>
        </section>

        <!-- Campos tamanho -->
        <section class="content">

            @include('partials.admin._alerts')


            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="box-body">
                        <form action="{{ route('numbersize.save') }}" method="post">
                            {{ csrf_field() }}

                            <table style="width: 60%">
                                <tr>
                                    <td>
                                        <div>
                                            <div class="form-group">
                                                <label>Tamanho (Número)</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa fa-arrows-h"></i></span>
                                                    <input type="number" class="form-control" name="nm_tamanho_num" min="0">
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                </tr>
                            </table>

                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="box-body">
                        <form action="{{ route('lettersize.save') }}" method="post">
                            {{ csrf_field() }}

                            <table style="width: 60%">
                                <tr>
                                    <td>
                                        <div>
                                            <div class="form-group">
                                                <label>Tamanho (Letra)</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa fa-arrows-h"></i></span>
                                                    <input type="text" class="form-control" name="nm_tamanho_letra">
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                </tr>
                            </table>

                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tabelas -->
        <section class="content">

            @include('partials.admin._alerts')


            <!-- LISTA DE TAMANHO POR NÚMERO -->
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tamanho por Número Cadastrado</h3>
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="box-body">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Código</th>
                                    <th class="text-center">Tamanho</th>
                                </tr>
                            </thead>
                            <tbody id="tam_num">
                                @foreach($tNum as $num)
                                    <tr class="text-center">
                                        <td>{{$num->cd_tamanho_num}}</td>
                                        <td id="tam">{{$num->nm_tamanho_num}}</td>
                                        <td class="text-right">
                                            <button id="btn_editar" class="fa fa-pencil btn btn-outline-warning" style="color: #367fa9"></button>
                                            <button id="btn_excluir" class="fa fa-trash btn btn-outline-warning" style="color: #cc0000"></button>
                                            <button id="btn_salvar" class="fa fa-check btn btn-outline-warning" style="color: #008d4c; display:none"></button>
                                            <button id="btn_cancelar" class="fa fa-remove btn btn-outline-warning" style="color: #cc0000; display: none"></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>


            <!-- LISTA DE TAMANHO POR LETRA -->
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tamanho por Letra Cadastrado</h3>
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="box-body">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Código</th>
                                    <th class="text-center">Tamanho</th>
                                </tr>
                            </thead>
                            <tbody id="tam_letra">
                                @foreach($tLetra as $letra)
                                    <tr class="text-center">
                                        <td>{{$letra->cd_tamanho_letra}}</td>
                                        <td id="tam">{{$letra->nm_tamanho_letra}}</td>
                                        <td class="text-right">
                                            <button id="btn_editar" class="fa fa-pencil btn btn-outline-warning" style="color: #367fa9"></button>
                                            <button id="btn_salvar" class="fa fa-check btn btn-outline-warning" style="color: #008d4c; display:none"></button>
                                            <button id="btn_cancelar" class="fa fa-remove btn btn-outline-warning" style="color: #cc0000; display: none"></button>
                                            <button id="btn_excluir" class="fa fa-trash btn btn-outline-warning" style="color: #cc0000"></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="{{ asset('js/admin/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/admin/jquery.inputmask.bundle.js') }}"></script>
    <script>

        $(document).ready(function(){

            //cor branco
            $("table tbody#tam_letra tr:odd").css("background-color", "#fff");
            //cor cinza
            $("table tbody#tam_letra tr:even").css("background-color", "#f5f5f5");
            //cor branco
            $("table tbody#tam_num tr:odd").css("background-color", "#fff");
            //cor cinza
            $("table tbody#tam_num tr:even").css("background-color", "#f5f5f5");

            var conteudoOriginal;

            //Ação de clicar no editar, pegando o conteudo e criando o input para edição
            $('button#btn_editar').click(function(){
                var campoTR = $(this).parent().parent();

                var conteudo =  campoTR.find("td:eq(1)").text();
                conteudoOriginal = conteudo;

                var campo_tam = campoTR.find('#tam');
                campo_tam.text("");

                var campo_input = "<input id='caixa_editar' type='text' maxlength='4' ' value='" + conteudoOriginal + "'></input>";
                campo_tam.append(campo_input);
                campoTR.find('#caixa_editar').focus();

                trocaBotoes(campoTR);

                campoTR.siblings().find('td:eq(2)').children("button#btn_editar").attr("disabled", "disabled");
                campoTR.siblings().find('td:eq(2)').children("button#btn_excluir").attr("disabled", "disabled");
            });

            //Ação que salva o valor digitado dentro do input, e coloca o novo valor dentro do TD
            $('button#btn_salvar').click(function(){
                var campoTR = $(this).parent().parent();
                var conteudoAtualizado = campoTR.find("#caixa_editar").val();
                var campo_tam = campoTR.find("td:eq(1)");

                if(conteudoAtualizado.length == 0){
                    $("#caixa_editar").focus();

                    return;
                }

                campo_tam.text(conteudoAtualizado);

                campo_tam.remove('#caixa_editar');

                campoTR.siblings().find('td:eq(2)').children("button#btn_editar").removeAttr("disabled");
                campoTR.siblings().find('td:eq(2)').children("button#btn_excluir").removeAttr("disabled");
                trocaBotoes(campoTR);
            });


            //Ação para cancelar as mudanças feitas dentro do input
            $('button#btn_cancelar').click(function(){
                var campoTR = $(this).parent().parent();
                var campo_tam = campoTR.find("td:eq(1)");
                campo_tam.remove("#caixa_editar");

                campo_tam.text(conteudoOriginal);

                campoTR.siblings().find('td:eq(2)').children("button#btn_editar").removeAttr("disabled");
                campoTR.siblings().find('td:eq(2)').children("button#btn_excluir").removeAttr("disabled");
                trocaBotoes(campoTR);
            });

            //Função para troca de botões, transição do display none para block
            function trocaBotoes(campoTR){
                campoTR.find('#btn_editar').toggle();
                campoTR.find('#btn_excluir').toggle();
                campoTR.find('#btn_salvar').toggle();
                campoTR.find('#btn_cancelar').toggle();
            }

        });
    </script>
@stop
