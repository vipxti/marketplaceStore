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

        <section class="content-header">
            <div class="content">

                @include('partials.admin._alerts')
                
                <div class="row">

                    <!-- Cadastro das cores -->
                    <div class="col-md-4">

                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Cor</h3>
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
                                        <div class="form-group">
                                            <label>Cadastar Cor</label>
                                            <div class="input-group">
                                                <input class="form-control" type="hidden" id="cd_cor" name="cd_cor" value="NULL">
                                                <span class="input-group-addon"><i class="fa fa-paint-brush"></i></span>
                                                <input type="text" id="nm_cor" minlength="0" maxlength="40" class="form-control" name="nm_cor">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button type="submit" id="btnSalvarCor" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                    <!-- Alteração das cores -->
                    <div class="col-md-7">

                        <!-- Lista das cores cadastradas -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Lista de Cores</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6 col-md-8" style="margin-left: 25% !important;">
                                        <!-- Botão pesquisar -->
                                        <div class="input-group">
                                            <input type="search" class="form-control"  id="search" name="search"  placeholder="Buscar...">
                                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-md-4" >
                                        <div class="dataTables_length" id="example1_length">
                                            <!-- Botão LIMITS -->
                                            <select name="example1_length" aria-controls="example1" class="form-control form-control-sm">
                                                <option selected value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <!-- Tabelas dos produtos -->
                                <table class="table" id="table">
                                    <thead>
                                    <tr>
                                        <th class="text-left">Código</th>
                                        <th class="text-left">Cor</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($cores as $cor)
                                        <tr class="text-center">
                                            <td id="id_cor" class="text-left">{{ $cor->cd_cor }}</td>
                                            <td id="nome_cor" class="text-left">{{ $cor->nm_cor }}</td>
                                            <td id="colBotoes" class="text-right">
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

            setTimeout($.unblockUI, 6000);
        });

        //Campo pesquisa de produtos
        $(function () {
            $( '#table' ).searchable({
                striped: true,
                oddRow: { 'background-color': '#f5f5f5' },
                evenRow: { 'background-color': '#fff' },
                searchType: 'fuzzy'
            });

            $( '#searchable-container' ).searchable({
                searchField: '#container-search',
                selector: '.row',
                childSelector: '.col-xs-4',
                show: function( elem ) {
                    elem.slideDown(100);
                },
                hide: function( elem ) {
                    elem.slideUp( 100 );
                }
            })
        });

        $(document).ready(function(){

            //Carrega as letras já cadastradas dentro de um array
            var arrayCor = [];
            $('#nm_cor').one("click", function(){
                $("tbody td:nth-child(2)").each(function(){
                    arrayCor.push($(this).text().toUpperCase());
                });
            });

            //Ao digitar faz a verificação se determinado número já existe
            var verificaCor = false;
            $('#nm_cor').on("input", function(){
                var regInicio = new RegExp("^\\s+");
                var regMeio = new RegExp("\\s+");
                var regFinal = new RegExp("\\s+$");

                for(var i=0; i<arrayCor.length; i++){
                    if($(this).val().toUpperCase().replace(regInicio, "").replace(regFinal, "").replace(regMeio, " ") == arrayCor[i])
                        verificaCor = true;
                }
                if(verificaCor)
                    $('#btnSalvarCor').attr("disabled", "disabled");
                else
                    $('#btnSalvarCor').removeAttr("disabled");

                verificaCor = false;
            });

            //Função chamada quando um input, para edição da cor, for gerado
            function verificaCaixaEditar() {
                //Carrega as letras já cadastradas dentro de um array
                $('#caixa_editar').one("click", function () {
                    if (arrayCor.length == 0) {
                        $("tbody td:nth-child(2)").each(function () {
                            arrayCor.push($(this).text().toUpperCase());
                        });
                    }
                });

                //Ao digitar faz a verificação se determinado número já existe
                $('#caixa_editar').on("input", function () {
                    var regInicio = new RegExp("^\\s+");
                    var regMeio = new RegExp("\\s+");
                    var regFinal = new RegExp("\\s+$");

                    for(var i=0; i<arrayCor.length; i++){
                        if($(this).val().toUpperCase().replace(regInicio, "").replace(regFinal, "").replace(regMeio, " ") == arrayCor[i])
                            verificaCor = true;
                    }
                    if(verificaCor)
                        $(this).parent().parent().find('#colBotoes').find('#btn_salvar').attr("disabled", "disabled");
                    else
                        $(this).parent().parent().find('#colBotoes').find('#btn_salvar').removeAttr("disabled");

                    verificaCor = false;
                });
            }

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
                verificaCaixaEditar();

                trocaBotoes(campoTR);

                campoTR.siblings().find('td:eq(2)').children("button#btn_editar").attr("disabled", "disabled");
                campoTR.siblings().find('td:eq(2)').children("button#btn_excluir").attr("disabled", "disabled");
            });

            //Ação que salva o valor digitado dentro do input, e coloca o novo valor dentro do TD
            $('button#btn_salvar').click(function(){
                var campoTR = $(this).parent().parent();
                var conteudoAtualizado = campoTR.find("#caixa_editar").val();
                var campo_cor = campoTR.find("td:eq(1)");
                var id = campoTR.find('#id_cor').text();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                if(conteudoAtualizado.length == 0){
                    $("#caixa_editar").focus();

                    return;
                }

                campo_cor.text(conteudoAtualizado);

                $.ajax({
                    url: '{{ route('color.update') }}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, cd_cor: id, nm_cor: conteudoAtualizado},
                    dataType: 'JSON',
                    success: function (e) {
                        console.log(e.message);
                    }
                });

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

            $('button#btn_excluir').click(function(){
                var campoTR = $(this).parent().parent();
                var conteudoAtualizado = campoTR.find("td:eq(1)").text();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var id = campoTR.find('#id_cor').text();


                $.ajax({
                    url: '{{ route('color.delete') }}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, cd_cor: id, nm_cor: conteudoAtualizado},
                    dataType: 'JSON',
                    success: function (e) {
                        console.log(e.message);
                        campoTR.fadeOut(500, function () {
                            $(this).remove();
                            //cor branco
                            $("table tbody tr:odd").css("background-color", "#fff");
                            //cor cinza
                            $("table tbody tr:even").css("background-color", "#f5f5f5");
                        });
                    }
                });



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

    <script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>

@stop
