@extends('layouts.admin.app')

@section('content')
    <link rel="stylesheet" href="{{asset('css/admin/sweetalert.css')}}">
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
                    <input type="hidden" id="countColor" name="countColor" value="{{$colorCount}}">
                    <!-- Alteração das cores -->
                    <div class="col-md-12">

                        <!-- Lista das cores cadastradas -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Lista de Cores</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="box-body">
                                <!-- Tabelas dos produtos -->
                                <table class="table" id="table">
                                    <thead>
                                    <tr>
                                        <th class="text-left">Código</th>
                                        <th class="text-left">#Hex</th>
                                        <th class="text-left">Cor</th>
                                        <th class="text-left">Status</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($cores as $cor)
                                        <tr class="text-center">
                                            <td id="id_cor" class="text-left">{{ $cor->cd_cor }}</td>
                                            <td id="id_cor" style="vertical-align: inherit !important; width: 60px !important;"><div style="height: 15px; width: 35px; background-color:{{ $cor->hex }};"></div></td>
                                            <td id="nome_cor" class="text-left">{{ $cor->nm_cor }}</td>
                                            <td id="status" class="text-left">
                                                <input id="{{ $cor->cd_cor }}" type="checkbox" class="js-switch" name="status"/>
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
    <script src="{{asset('js/admin/sweetalert.min.js')}}"></script>
    <script src="{{asset('js/admin/switchery.js')}}"></script>
    <script>

        $(document).ready(function(){

            for(i=0; i<($('#countColor').val());i++){
                var elem = document.getElementById(i+1);
                var init = new Switchery(elem);
            }

        });

        $('.switchery').click(function(){
            console.log('oi');
        });

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

            setTimeout($.unblockUI, 12000);
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
            function carregarCoresCadastradas(){
                arrayCor = [];
                $("tbody td:nth-child(2)").each(function () {
                    arrayCor.push($(this).text().toUpperCase());
                });
            }

            $('#nm_cor').one("click", function(){
                carregarCoresCadastradas();
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
                /*$('#caixa_editar').one("click", function () {
                    if (arrayCor.length == 0) {
                        carregarCoresCadastradas();
                    }
                });*/

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
                carregarCoresCadastradas();
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
                        carregarCoresCadastradas();
                        swal("Atualização", "Cor atualizada com sucesso!", "success");
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


                swal({
                    title: "Você tem certeza que deseja deletar ?",
                    text: "Uma vez deletada, você não terá mais acesso a essa cor.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                        if (willDelete) {
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

                                        carregarCoresCadastradas();
                                        swal("Cor deletada com sucesso!", {
                                            icon: "success",
                                        });
                                    });
                                }
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
