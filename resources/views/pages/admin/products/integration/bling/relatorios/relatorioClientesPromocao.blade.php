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
            <h1><i class="fa fa-paperclip"></i>&nbsp;&nbsp;Relatório</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Integração</a></li>
                <li><a href="#">Bling</a></li>
                <li><a href="#">Relatórios</a></li>
                <li class="active">Relatório de Clientes</li>
            </ol>
        </section>

        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Relatório de Clientes</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="input-excel">Escolha o arquivo Excel:</label>
                            <input type="file" id="input-excel" accept=".xlsx, .csv, .xls"/>
                        </div>
                        <!-- .col-md-4 -->
                        <div class="div_hidden" style="display: none;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="estado">Filtro por estado:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-flag"></i></span>
                                        <select id="estado" class="form-control">
                                            <option value="">Selecione a opção</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- .form-group -->
                            </div>
                            <!-- .col-md-3 -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cidade">Filtro por cidade:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-flag"></i></span>
                                        <select id="cidade" class="form-control">
                                            <option value="">Selecione a opção</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- .form-group -->
                            </div>
                            <!-- .col-md-3 -->
                            <div class="col-md-3 text-center">
                                <button class="btn btn-success" style="margin: 27px 0 10px 0;"
                                        data-toggle="modal" data-target="#modal_wpp">
                                    <i class="fa fa-whatsapp"></i>&nbsp;&nbsp;Msg Whatsapp
                                </button>
                            </div>
                            <!-- .col-md-3 -->
                        </div>
                        <!-- .div_hidden -->

                        <div id="div-excel" class="col-md-12 table-responsive">
                            <hr/>
                        </div>

                    </div>
                    <!-- .row -->
                </div>
                <!-- .box-body -->
            </div>
            <!-- .box-primary -->
        </section>
    </div>
    <!-- .content-wrapper -->

    <!-- MODAL PREMIO -->
    <div class="modal fade" id="modal_wpp">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insira a mensagem</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 25px;">
                    <div class="row">
                        <div class="col-md-12 justify-content-center">
                            <div class="form-group">
                                <label for="msg_wpp">Mensagem para Whatsapp:</label>
                                <div class="input-group">
                                    <textarea id="msg_wpp" rows="10" cols="85" style="resize: none;"></textarea>
                                </div>
                            </div>
                            <!-- .form-group-->
                        </div>
                        <!-- .col-md-12 -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        <i class="fa fa-chevron-left" style="font-size: 12px;"></i>
                        &nbsp;&nbsp;Voltar
                    </button>
                    <button id="btn_msg_wpp" type="button" class="btn btn-success">
                        <i class="fa fa-whatsapp"></i>
                        &nbsp;&nbsp;Enviar
                    </button>
                </div>
            </div>
            <!-- .modal-content -->
        </div>
        <!-- .modal-dialog -->
    </div>
    <!-- FIM DO MODAL -->

    <script lang="javascript" src={{asset('js/admin/xlsx.full.min.js')}}></script>
    <script>
        $(function(){

            let arrayUF = [];
            //gera a tabela pelo arquivo excel selecionado
            $('#input-excel').change(function(e){
                let reader = new FileReader();
                reader.readAsArrayBuffer(e.target.files[0]);
                reader.onload = function(e) {
                    let data = new Uint8Array(reader.result);
                    let wb = XLSX.read(data,{type:'array'});
                    let htmlstr = XLSX.write(wb,{sheet:"", type:'binary',bookType:'html'});

                    arrayUF = [];
                    $('.div_hidden').css('display', 'block');
                    $('#div-excel').find('table').remove();
                    $('#div-excel')[0].innerHTML += htmlstr;

                    $('#div-excel').find('table').addClass('table table-striped').attr('id', 'table-excel');
                    $('#table-excel').find('tbody tr:first').css('font-weight', '700');

                    monta_td("#", $('tbody tr:first'));

                    let contador = 1;
                    $.each($('#table-excel').find('tbody tr:not(:first)'), function(idx, result){

                        //vai remover as pessoas que estiverem com o estado ou numero de celular inválido
                        if($(this).find('td:eq(4)').text().length < 11 ||
                            $(this).find('td:eq(1)').text().length < 2)
                        {
                            $(this).remove();
                        }
                        else {
                            //checa se os nomes estão no formato utf-8 e faz a correção caso estaja errado
                            check_utf8($(this).find('td:eq(2)'));
                            check_utf8($(this).find('td:first'));

                            //insere os estados dentro da array, mas só os que nao estiverem inseridos ainda
                            if (!arrayUF.includes($(this).find('td:eq(1)').text())) {
                                arrayUF.push($(this).find('td:eq(1)').text());
                            }

                            //insere a mascara do numero do celular
                            contador = mascara_num($(this), contador);

                        }

                    });

                    monta_select($('#estado'), arrayUF);

                }
            });

            function monta_td(texto, tr){
                let td = $('<td>').text(texto);
                tr.prepend(td);
            }

            //função que insere a mascara do celular
            function mascara_num(tr, contador){
                let num = tr.find('td:eq(4)').text();
                num = num.replace(/\s/g, '').replace('(', '').replace('-', '').replace(')', '');

                //caso tenha como o primeiro o numero 0
                //é removido para que todos fiquem no padrão
                if(num.substr(0, 1) === "0")
                    num = num.substr(1);

                //se o numero for maior que 6 é pq é um celular
                //e o telefones residenciais sao removidos
                if(num.substr(2,1) > 6) {

                    if (num.length === 11)
                        num = "(" + num.substr(0, 2) + ") " + num.substr(2, 5) + "-" + num.substr(7, 4);
                    else
                        num = "(" + num.substr(0, 2) + ") " + num.substr(2, 4) + "-" + num.substr(6, 4);

                    tr.find('td:eq(4)').text(num);

                    monta_td(contador, tr);
                    contador++;
                }
                else
                    tr.remove();

                return contador;

            }

            //função para verificar se os nomes e cidades estão no formato utf-8
            function check_utf8(td){
                let texto = decode_utf8(td.text());

                try {
                    td.text(decode_utf8(texto));
                }
                catch(e){
                    td.text(texto);
                }
            }

            //deixa o nome no formato utf8
            function decode_utf8(texto) {
                return decodeURIComponent(escape(texto));
            }

            //filtra os dados da tabela de acordo com o estado selecionado
            let arrayCidade = [];
            $('#estado').change(function(){
                let filtro = $(this).val();
                arrayCidade = [];

                if(filtro !== "")
                    filtrar_tabela(filtro, 2);
                else
                    $('tbody tr').css('display', 'table-row');

                monta_select($('#cidade'), arrayCidade);
            });

            //pra cada estado/cidade dentro do array é criado uma opção dentro do select
            //para utilizar como filtro
            function monta_select(select, array){
                array.sort();
                select.find('option:not(:first)').remove();
                $.each(array, function(idx, result){
                    let option = $('<option>').text(result).val(result);
                    select.append(option);
                });
            }

            //filtra os dados da tabela de acordo com a cidade selecionado
            $('#cidade').change(function(){
                let filtro = $(this).val();

                if(filtro !== ""){
                   filtrar_tabela(filtro, 3);
                }
                else{
                    filtrar_tabela($('#estado').val(), 2);
                }
            });

            function filtrar_tabela(filtro, n){
                $.each($('tbody tr:not(:first)'), function(){
                    if(filtro !== $(this).find('td:eq(' + n + ')').text()){
                        $(this).css('display', 'none');
                    }
                    else{
                        $(this).css('display', 'table-row');

                        if(!arrayCidade.includes($(this).find('td:eq(3)').text())){
                            arrayCidade.push($(this).find('td:eq(3)').text());
                        }
                    }
                });
            }

            let arrayCelular = [];
            function pega_telefones(filtro, n){
                arrayCelular = [];

                $.each($('tbody tr:not(:first)'), function(idx, result){
                    if(filtro === $(this).find('td:eq('+ n + ')').text()) {

                        let num = $(this).find('td:eq(5)').text();
                        num = num.replace(/\s/g, '').replace('(', '').replace('-', '').replace(')', '');

                        if (!arrayCelular.includes(num))
                            arrayCelular.push('55' + num);

                    }
                });
            }

            //cria mensagem com as ganhadoras dos premios para enviar por whatsapp
            $('#btn_msg_wpp').click(function(){
                let msg = $('#msg_wpp').val();
                let re = new RegExp('\n', 'g');

                msg = msg.replace(re, '%0A').replace(/\s/g, '%20');

                if($('#cidade').val() !== "")
                    pega_telefones($('#cidade').val(), 3);
                else
                    pega_telefones($('#estado').val(), 2);


                let wpp = "https://api.whatsapp.com/send?phone=" + arrayCelular + "&text=" + msg;
                window.open(wpp, '_blank');
            });

        });
    </script>

@stop