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
            <h1><i class="fa fa-arrows-h"></i>&nbsp;&nbsp;Cadastrar Tamanho</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Produtos</a></li>
                <li><a href="#">Atributos</a></li>
                <li><a class="active">Cadastrar Tamanhos</a></li>
            </ol>
        </section>

        <section class="content">

            @include('partials.admin._alerts')

            <div class="row">
               <!-- Cadastrar tamanho números  -->
               <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Número</h3>
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
                                                <label>Cadastrar Tamanho (Número)</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa fa-arrows-h"></i></span>
                                                    <input id="nm_num" type="number" class="form-control" name="nm_tamanho_num" min="0">
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                </tr>
                            </table>

                            <div class="col-md-12 text-right">
                                <button id="btnSalvarNum" type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

               <!-- Cadastrar tamanho letras  -->
               <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Letra</h3>
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
                                                <label>Cadastrar Tamanho (Letra)</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa fa-arrows-h"></i></span>
                                                    <input id="nm_letra" type="text" class="form-control" name="nm_tamanho_letra" style="text-transform: uppercase">
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                </tr>
                            </table>

                            <div class="col-md-12 text-right">
                                <button id="btnSalvarLetra" type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>


            @include('partials.admin._alerts')

            <div class="row">
               <!-- Lista de tamanhos por números -->
               <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tamanhos Cadastrados</h3>
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
                                        <td id="colBotoes" class="text-right">
                                            <button id="btn_editar" class="fa fa-pencil btn btn-outline-warning" style="color: #367fa9"></button>
                                            <button id="btn_excluir_num" class="fa fa-trash btn btn-outline-warning" style="color: #cc0000"></button>
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

               <!-- Lista de tamanhos por letras -->
               <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tamanhos Cadastrados</h3>
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
                                        <td id="colBotoes" class="text-right">
                                            <button id="btn_editar" class="fa fa-pencil btn btn-outline-warning" style="color: #367fa9"></button>
                                            <button id="btn_salvar" class="fa fa-check btn btn-outline-warning" style="color: #008d4c; display:none"></button>
                                            <button id="btn_cancelar" class="fa fa-remove btn btn-outline-warning" style="color: #cc0000; display: none"></button>
                                            <button id="btn_excluir_letra" class="fa fa-trash btn btn-outline-warning" style="color: #cc0000"></button>
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

    <script src="{{ asset('js/admin/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/admin/jquery.inputmask.bundle.js') }}"></script>
    <script src="{{asset('js/admin/jquery.blockUI.js')}}"></script>
    <script>

        $('#btnSalvarNum').click(function(){
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

        $('#btnSalvarLetra').click(function(){
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

        $(document).ready(function(){

            //Carrega os números já cadastrados dentro de um array
            var arrayNum = [];
            $('#nm_num').one("click", function(){
                arrayNum = [];
                carregaArray($("tbody#tam_num td:nth-child(2)"), arrayNum);
            });

            //Carrega as letras já cadastradas dentro de um array
            var arrayLetra = [];
            $('#nm_letra').one("click", function(){
                arrayNum = [];
                carregaArray($("tbody#tam_letra td:nth-child(2)"), arrayLetra);
            });

            //Função para carregar os arrays
            function carregaArray(opcoes, array){
                console.log("1º " + array);
                opcoes.each(function(){
                    array.push($(this).text().toUpperCase());
                });
                console.log("2º " + array);
            }

            //Ao digitar faz a verificação se determinado número já existe
            var verificaNum = false;
            $('#nm_num').on("input", function(){
                for(var i=0; i<arrayNum.length; i++){
                    if($(this).val() == arrayNum[i])
                        verificaNum = true;
                }
                if(verificaNum)
                    $("#btnSalvarNum").attr("disabled", "disabled");
                else
                    $("#btnSalvarNum").removeAttr("disabled");

                verificaNum = false;
            });

            //Ao digitar faz a verificação se determinada letra já existe
            var verificaLetra = false;
            $('#nm_letra').on("input", function(){
                var regInicio = new RegExp("^\\s+");
                var regMeio = new RegExp("\\s+");
                var regFinal = new RegExp("\\s+$");

                for(var i=0; i<arrayLetra.length; i++){
                    if($(this).val().toUpperCase().replace(regInicio, "").replace(regFinal, "").replace(regMeio, "") == arrayLetra[i]) {
                        verificaLetra = true;
                    }
                }
                if(verificaLetra)
                    $("#btnSalvarLetra").attr("disabled", "disabled");
                else
                    $("#btnSalvarLetra").removeAttr("disabled");

                verificaLetra = false;
            });

            //cor branco
            $("table tbody#tam_letra tr:odd").css("background-color", "#fff");
            //cor cinza
            $("table tbody#tam_letra tr:even").css("background-color", "#f5f5f5");
            //cor branco
            $("table tbody#tam_num tr:odd").css("background-color", "#fff");
            //cor cinza
            $("table tbody#tam_num tr:even").css("background-color", "#f5f5f5");

            //Função chamada quando um input, para edição da cor, for gerado
            function verificaCaixaEditar() {

                var verifica = false;
                //Carrega as letras já cadastradas dentro de um array
                /*$('#caixa_editar').one("click", function () {
                    if(parseInt(conteudoOriginal)) {
                        if(arrayNum.length == 0) {
                            carregaArray($("tbody#tam_num td:nth-child(2)"), arrayNum);
                        }
                    }else {
                        if(arrayLetra.length == 0) {
                            carregaArray($("tbody#tam_letra td:nth-child(2)"), arrayLetra);
                        }
                    }
                });*/

                //Ao digitar faz a verificação se determinado número já existe
                $('#caixa_editar').on("input", function () {
                    var regInicio = new RegExp("^\\s+");
                    var regMeio = new RegExp("\\s+");
                    var regFinal = new RegExp("\\s+$");
                    var array = [];
                    var valor = $(this).val().toUpperCase().replace(regInicio, "").replace(regFinal, "").replace(regMeio, "");
                    var numero = false;

                    if(parseInt(conteudoOriginal)){
                        array = arrayNum;
                        numero = true;
                    } else {
                        array = arrayLetra;
                    }

                    for (var i = 0; i < array.length; i++) {
                        if (valor == array[i])
                            verifica = true;
                    }


                    if (verifica)
                        $(this).parent().parent().find('#colBotoes').find('#btn_salvar').attr("disabled", "disabled");
                    else
                        $(this).parent().parent().find('#colBotoes').find('#btn_salvar').removeAttr("disabled");

                    if(numero){
                        if(!parseInt(valor))
                            $(this).parent().parent().find('#colBotoes').find('#btn_salvar').attr("disabled", "disabled");
                    } else {
                        if(parseInt(valor))
                            $(this).parent().parent().find('#colBotoes').find('#btn_salvar').attr("disabled", "disabled");
                    }

                    verifica = false;
                });
            }

            function verificaArray(){
                if(parseInt(conteudoOriginal)) {
                    arrayNum = [];
                    if(arrayNum.length == 0) {
                        carregaArray($("tbody#tam_num td:nth-child(2)"), arrayNum);
                    }
                }else {
                    arrayLetra = [];
                    if(arrayLetra.length == 0) {
                        carregaArray($("tbody#tam_letra td:nth-child(2)"), arrayLetra);
                    }
                }
            }

            var conteudoOriginal;

            //Ação de clicar no editar, pegando o conteudo e criando o input para edição
            $('button#btn_editar').click(function(){
                var campoTR = $(this).parent().parent();

                var conteudo =  campoTR.find("td:eq(1)").text();
                conteudoOriginal = conteudo;

                var campo_tam = campoTR.find('#tam');
                verificaArray();
                campo_tam.text("");

                var campo_input = "<input id='caixa_editar' type='text' maxlength='4' style=\"text-transform: uppercase\" ' value='" + conteudoOriginal + "'></input>";
                campo_tam.append(campo_input);
                campoTR.find('#caixa_editar').focus();
                verificaCaixaEditar();

                trocaBotoes(campoTR.find('td:eq(2)').children());
                campoTR.siblings().find('td:eq(2)').children().attr("disabled", "disabled");
            });

            //Ação que salva o valor digitado dentro do input, e coloca o novo valor dentro do TD
            $('button#btn_salvar').click(function(){
                var campoTR = $(this).parent().parent();
                var conteudoAtualizado = campoTR.find("#caixa_editar").val();
                var id = campoTR.find('td:eq(0)').text();
                var campo_tam = campoTR.find("td:eq(1)");
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var regInicio = new RegExp("^\\s+");
                var regMeio = new RegExp("\\s+");
                var regFinal = new RegExp("\\s+$");
                conteudoAtualizado = conteudoAtualizado.replace(regInicio, "").replace(regFinal, "").replace(regMeio, "");

                if(conteudoAtualizado.length == 0){
                    $("#caixa_editar").focus();

                    return;
                }

                if(campoTR.parent().is('#tam_num')){
                    $.ajax({
                        url: '{{ route('numbersize.update') }}',
                        type: 'POST',
                        data: {_token: CSRF_TOKEN, cd_tamanho_num: id, nm_tamanho_num: conteudoAtualizado},
                        dataType: 'JSON',
                        success: function (e) {
                            console.log(e.message);
                            carregaArray($("tbody#tam_num td:nth-child(2)"), arrayNum);
                        }
                    });
                    console.log("tabela numero");
                }
                else {
                    conteudoAtualizado = conteudoAtualizado.toUpperCase();
                    $.ajax({
                        url: '{{ route('lettersize.update') }}',
                        type: 'POST',
                        data: {_token: CSRF_TOKEN, cd_tamanho_letra: id, nm_tamanho_letra: conteudoAtualizado},
                        dataType: 'JSON',
                        success: function (e) {
                            console.log(e.message);
                            carregaArray($("tbody#tam_letra td:nth-child(2)"), arrayLetra);
                        }
                    });
                    console.log("tabela letra");
                }

                campo_tam.text(conteudoAtualizado);

                campo_tam.remove('#caixa_editar');

                campoTR.siblings().find('td:eq(2)').children().removeAttr("disabled");

                trocaBotoes(campoTR.find('td:eq(2)').children());
            });


            //Ação para cancelar as mudanças feitas dentro do input
            $('button#btn_cancelar').click(function(){
                var campoTR = $(this).parent().parent();
                var campo_tam = campoTR.find("td:eq(1)");
                campo_tam.remove("#caixa_editar");

                campo_tam.text(conteudoOriginal);

                campoTR.siblings().find('td:eq(2)').children().removeAttr("disabled");
                trocaBotoes(campoTR.find('td:eq(2)').children());
            });

            $('button#btn_excluir_letra').click(function(){
                var campoTR = $(this).parent().parent();
                var id = campoTR.find('td:eq(0)').text();
                var conteudo = campoTR.find('td:eq(1)').text();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: '{{ route('lettersize.delete') }}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, cd_tamanho_letra: id, nm_tamanho_letra: conteudo},
                    dataType: 'JSON',
                    success: function (e) {
                        console.log(e.message);
                        campoTR.fadeOut(500, function () {
                            $(this).remove();
                            //cor branco
                            $("table tbody#tam_letra tr:odd").css("background-color", "#fff");
                            //cor cinza
                            $("table tbody#tam_letra tr:even").css("background-color", "#f5f5f5");
                            //carrega o array novamente
                            carregaArray($("tbody#tam_letra td:nth-child(2)"), arrayLetra);
                        });
                    }
                });

            });

            $('button#btn_excluir_num').click(function(){
                var campoTR = $(this).parent().parent();
                var id = campoTR.find('td:eq(0)').text();
                var conteudo = campoTR.find('td:eq(1)').text();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: '{{ route('numbersize.delete') }}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, cd_tamanho_num: id, nm_tamanho_num: conteudo},
                    dataType: 'JSON',
                    success: function (e) {
                        console.log(e.message);
                        campoTR.fadeOut(500, function () {
                            $(this).remove();
                            //cor branco
                            $("table tbody#tam_num tr:odd").css("background-color", "#fff");
                            //cor cinza
                            $("table tbody#tam_num tr:even").css("background-color", "#f5f5f5");
                            //carrega o array novamente
                            carregaArray($("tbody#tam_num td:nth-child(2)"), arrayNum);
                        });
                    }
                });

                console.log(id);
                console.log(campoTR);
            });

            //Função para troca de botões, transição do display none para block
            function trocaBotoes(botoes){
                botoes.toggle();
            }

        });
    </script>
@stop
