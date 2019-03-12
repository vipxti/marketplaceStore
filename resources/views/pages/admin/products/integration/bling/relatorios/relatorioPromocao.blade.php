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

        .botao{
            border: 1px solid #367fa9;
            color:#367fa9;
        }

        .borda_erro {
            border: 1px solid #dd4b39;
        }

        .small_erro {
            color: #dd4b39;
            margin-left: 42px;
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
                <li class="active">Relatório Promoção</li>
            </ol>
        </section>

        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Relatório Promoção</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="input-excel">Escolha o arquivo Excel:</label>
                            <input type="file" id="input-excel" accept=".xlsx, .csv, .xls"/>
                            <br/>
                            <div id="div-excel" class="table-responsive"></div>

                            <button id="btn_premio" class="btn btn-success" style="margin: 0 auto; display: none;"
                                    data-toggle="modal" data-target="#modal_premio">
                                <i class="fa fa-trophy"></i>&nbsp;&nbsp;Prêmio
                            </button>
                        </div>
                        <!-- .col-md-12 -->
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
    <div class="modal fade" id="modal_premio">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Escolha o prêmio</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 25px;">
                    <div class="row">
                        <div class="col-md-12" style="margin-left: 20px;">
                            <div class="radio">
                                <label><input id="opcPremio" type="radio" name="opcao" checked value="0">Calculo por premiação</label>
                            </div>
                            <div class="radio">
                                <label><input id="opcPorcentagem" type="radio" name="opcao" value="1">Calculo por porcentagem de vendas</label>
                            </div>
                        </div>
                        <!-- .col-md-12-->
                        <p>&nbsp;</p>
                        <div class="col-md-12 justify-content-center">
                            <div class="form-group">
                                <label for="promocao">Nome da promoção:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-gift"></i></span>
                                    <input id="promocao" type="text" class="form-control"/>
                                </div>
                                <small id="msg_erro_promocao" class="small_erro"></small>
                            </div>
                            <!-- .form-group-->
                            <div id="div_escolha_premio">
                                <div class="form-group">
                                    <label for="premio">Prêmio</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input id="premio" type="text" class="form-control"/>
                                    </div>
                                    <small id="msg_erro" class="small_erro"></small>
                                </div>
                            </div>
                            <!-- #div_escolha_premio -->
                            <div id="div_escolha_porcentagem" style="display: none;">
                                <div class="form-group">
                                    <label for="porcentagem">Porcentagem para ser calculada</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                        <input id="porcentagem" type="text" class="form-control"/>
                                    </div>
                                    <small id="msg_erro_porcentagem" class="small_erro"></small>
                                </div>
                            </div>
                            <!-- #div_escolha_porcentagem -->
                        </div>
                        <!-- .col-md-12 -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn botao" data-dismiss="modal">Sair</button>
                    <button id="btn_ganhadores" type="button" class="btn btn-primary">Ganhadores</button>
                </div>
            </div>
            <!-- .modal-content -->
        </div>
        <!-- .modal-dialog -->
    </div>
    <!-- FIM DO MODAL -->

    <!-- MODAL TABELA GANHADORAS -->
    <div class="modal fade" id="modal_ganhadores">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ganhadores</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 25px;">
                    <div class="row">
                        <div id="div_tabela" class="table-responsive">
                            <table id="table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th style="text-align: center;"><span id="nome_promocao"></span></th>
                                        <th>&nbsp;</th>
                                        <th><span id="premio_promocao"></span></th>
                                    </tr>
                                    <tr>
                                        <th>Ranking</th>
                                        <th>Vendedor</th>
                                        <th>Total Venda</th>
                                        <th>Prêmio</th>
                                    </tr>
                                </thead>
                                <tbody id="corpo_tabela">

                                </tbody>
                            </table>
                        </div>
                        <!-- #div_tabela -->

                        <button id="btn_export_excel" type="button" class="btn btn-success pull-right"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Exportar Excel</button>
                        <button id="btn_export_pdf" type="button" class="btn btn-danger pull-right" style="margin-right: 5px;"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Exportar PDF</button>
                        <button id="btn_msg_wpp" type="button" class="btn btn-success pull-right" style="margin-right: 5px;">
                            <i class="fa fa-whatsapp"></i>&nbsp;&nbsp;Msg Whatsapp
                        </button>
                    </div>
                    <!-- .row -->
                    <div id="div_p" class="row"></div>
                </div>
                <!-- .modal-body -->
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn botao" style="display: table; margin: 0 auto;" data-dismiss="modal">Sair</button>
                </div>
            </div>
            <!-- .modal-content -->
        </div>
        <!-- .modal-dialog -->
    </div>
    <!-- FIM DO MODAL -->

    <script lang="javascript" src={{asset('js/admin/xlsx.full.min.js')}}></script>
    <script src="{{asset('js/admin/jspdf.min.js')}}"></script>
    <script src="{{asset('js/admin/jquery.base64.js')}}"></script>
    <script src="{{asset('js/admin/jquery.btechco.excelexport.js')}}"></script>
    <script>
        $(function(){

            //gera a tabela pelo arquivo excel selecionado
            $('#input-excel').change(function(e){
                let reader = new FileReader();
                reader.readAsArrayBuffer(e.target.files[0]);
                reader.onload = function(e) {
                    let data = new Uint8Array(reader.result);
                    let wb = XLSX.read(data,{type:'array'});
                    let htmlstr = XLSX.write(wb,{sheet:"", type:'binary',bookType:'html'});

                    $('#div-excel').find('table').remove();
                    $('#div-excel')[0].innerHTML += htmlstr;

                    $('#div-excel').find('table').addClass('table table-striped').attr('id', 'table-excel');
                    $('#table-excel').find('tbody tr:first').css('font-weight', '700');

                    $.each($('#table-excel').find('tbody tr'), function(idx, result) {
                        let td = $('<td>');

                        if (idx !== 0) {
                            let button = `<button id="btn_excluir" class="fa fa-times btn btn-outline-warning" style="color: #cc0000"></button>`;
                            td.append(button);
                        }

                        $(this).append(td);

                        $('#btn_premio').css('display', 'table');
                        ativaExcluir();
                    });

                }
            });

            //ativa o botao excluir depois que a tabela foi gerada
            function ativaExcluir(){
                $('button#btn_excluir').click(function(){
                    let campoTR = $(this).parent().parent();

                    campoTR.fadeOut(500, function () {
                        $(this).remove();
                    });

                });
            }

            //pega valores de venda e nomes de vendedora dentro da tabela gerada pelo excel
            //e coloca dentro dos arrays
             function pegaValoresTabela(){
                $('#corpo_tabela').find('tr').remove();
                arrayVendas = [];
                arrayVendedoras = [];

                $.each($('#table-excel').find('tbody tr'), function(idx, result) {
                    if (idx !== 0) {
                        arrayVendas.push(parseFloat($(this).find('td:eq(5)').text().replace(',', '')));
                        arrayVendedoras.push($(this).find('td:first').text());
                    }
                });
            }

            //ordena o array em forma decrescente pra ver as vencedoras
            function ordenaArrays(){
                let troca = 1;
                while ( troca === 1) {
                    troca = 0;
                    for (let i = arrayVendas.length; i > 0; i--) {
                        if (arrayVendas[i] > arrayVendas[i - 1]) {

                            //ordena os preços de venda
                            let aux = arrayVendas[i];
                            arrayVendas[i] = arrayVendas[i - 1];
                            arrayVendas[i - 1] = aux;

                            //ordena o nome das vendedoras
                            let aux2 = arrayVendedoras[i];
                            arrayVendedoras[i] = arrayVendedoras[i - 1];
                            arrayVendedoras[i - 1] = aux2;

                            troca = 1;
                        }
                    }
                }
            }

            //limpa as msgs e bordas de erro dos inputs
            function limpaMsgErro(){
                $('#premio').removeClass('borda_erro');
                $('#msg_erro').html('');
                $('#promocao').removeClass('borda_erro');
                $('#msg_erro_promocao').html('');
                $('#porcentagem').removeClass('borda_erro');
                $('#msg_erro_porcentagem').html('');
            }

            //faz a manipulação da DOM para pder inserir as linhas na tabela
            let porcentagem = [30, 22, 16, 11, 9, 7, 5];
            function montaTabelaGanhadores(ehPromocao){
                for (let i = 0; i < arrayVendas.length; i++) {
                    let tr = $('<tr>');

                    let tdRank = $('<td>').text((i + 1) + " º ");
                    let trofeu = $('<i>');
                    if(i === 0)
                        trofeu.addClass('fa fa-trophy').css('color', '#e9ec07');
                    else if(i > 0 && i < 3)
                        trofeu.addClass('fa fa-star').css('color', '#e9ec07');
                    else if(i > 2 && i < 7)
                        trofeu.addClass('fa fa-thumbs-up').css('color', '#07a2ec');
                    else
                        trofeu.addClass('fa fa-frown-o').css('color', '#dd4b39');

                    tdRank.append(trofeu);

                    let tdVendedor = $('<td>').text(arrayVendedoras[i]);
                    let tdVenda = $('<td>').text("R$ " + arrayVendas[i]);
                    let tdPremio = $('<td>');

                    if(ehPromocao) {
                        if(i < porcentagem.length)
                            tdPremio.text("R$ " + (parseFloat($('#premio').val()) * (porcentagem[i] / 100)).toFixed(2));
                        else
                            tdPremio.text("R$ 0");
                    }
                    else
                        tdPremio.text("R$ " + (parseFloat(arrayVendas[i]) * (parseFloat($('#porcentagem').val()) / 100)).toFixed(2));

                    tr.append(tdRank);
                    tr.append(tdVendedor);
                    tr.append(tdVenda);
                    tr.append(tdPremio);
                    $('#corpo_tabela').append(tr);
                }

                $('#nome_promocao').html($('#promocao').val().toUpperCase());

                if(ehPromocao)
                    $('#premio_promocao').html("R$ " + parseFloat($('#premio').val()).toFixed(2));
                else
                    $('#premio_promocao').html($("#porcentagem").val() + "%");

            }

            let arrayVendas = [];
            let arrayVendedoras = [];
            $('#btn_ganhadores').click(function(){
                //se a opção de premio estiver selecionado vai fazer a verificação do input
                //e preencher a tabela com os preços que das 7 vendedoras e o premio
                if($('#promocao').val() !== "") {

                    if ($('#opcPremio').prop('checked')) {

                        //chama função para limpar as msgs e bordas de erro
                        limpaMsgErro();

                        if ($('#premio').val() !== "") {

                            if (!parseFloat($('#premio').val())) {
                                $('#premio').addClass('borda_erro');
                                $('#msg_erro').html('Preencha o campo com valores numéricos.');
                                return;
                            }

                            //chama a função para pegar os valores da tabela
                            pegaValoresTabela();

                            //chama a função para ordenar os arrays de forma decrescente
                            ordenaArrays();

                            //chama função para montar tabela de ganhadores
                            montaTabelaGanhadores(true);//condição true para dizer que é para calculo de promoção

                            //fecha/abre os modais
                            $('#modal_ganhadores').modal('show');
                        }
                        else if ($('#premio').val() === "") {
                            $('#premio').addClass('borda_erro');
                            $('#msg_erro').html('Preencha o campo com o valor do prêmio.');
                        }


                        //se a porcentagem estiver selecionado
                        //vai preencher a tabela com a a porcentagem de todas as vendedoras em cima da vemda
                    } else if ($('#opcPorcentagem').prop('checked')) {

                        //chama função para limpar as msgs e bordas de erro
                        limpaMsgErro();

                        if ($('#porcentagem').val() !== "") {

                            if (!parseFloat($('#porcentagem').val())) {
                                $('#porcentagem').addClass('borda_erro');
                                $('#msg_erro_porcentagem').html('Preencha o campo com valores numéricos.');
                                return;
                            }

                            //chama a função para pegar os valores da tabela
                            pegaValoresTabela();

                            //chama função para ordenar os arrays de forma decrescente
                            ordenaArrays();

                            //chama função para montar tabela de ganhadores
                            montaTabelaGanhadores(false);//condição false para dizer que é para calculo de porcentagem

                            //fecha/abre os modais
                            $('#modal_ganhadores').modal('show');
                        }
                        else {
                            $('#porcentagem').addClass('borda_erro');
                            $('#msg_erro_porcentagem').html('Preencha o campo com o valor da porcentagem.');
                        }
                    }
                }
                else if ($('#promocao').val() === "") {
                    $('#promocao').addClass('borda_erro');
                    $('#msg_erro_promocao').html('Preencha o campo com o nome da promoção.');
                }

            });

            //transforma a tabela das ganhadoras em um arquivo excel
            $("#btn_export_excel").click(function(){
                $("#table").btechco_excelexport({
                    containerid: "table",
                    datatype: $datatype.Table,
                    filename: 'Lista de Ganhadoras'
                });
            });

            //chama a função demoFromHTML
            $('#btn_export_pdf').click(function(){
                demoFromHTML();
            });

            //função para exportar a tabela das ganhadoras em um arquivo pdf
            function demoFromHTML() {
                let pdf = new jsPDF('p', 'pt', 'letter');
                source = $('#div_tabela')[0];

                specialElementHandlers = {
                    '#bypassme': function (element, renderer) {
                        return true
                    }
                };
                margins = {
                    top: 80,
                    bottom: 60,
                    left: 40,
                    width: 522
                };

                pdf.fromHTML(
                    source,
                    margins.left,
                    margins.top, {
                        'width': margins.width,
                        'elementHandlers': specialElementHandlers
                    },

                    function (dispose) {
                        pdf.save('Lista de Ganhadoras.pdf');
                    }, margins);
            }

            //faz a troca das divs escondendo uma e mostrando a outra
            function trocaDivs(divOut, divIn){
                divOut.fadeOut(300, function(){
                    divIn.fadeIn(300);
                });
            }

            //ao mudar o radio button esconde e mostra a div do premio
            $("input[name='opcao']").click(function(){
                if($(this).val() == 1){
                    trocaDivs($('#div_escolha_premio'), $('#div_escolha_porcentagem'));
                }
                else{
                    trocaDivs($('#div_escolha_porcentagem'), $('#div_escolha_premio'));
                }
            });

            //ao fechar o modal da tabela das ganhadoras é limpado todos os inputs
            $('#modal_ganhadores').on('hidden.bs.modal', function(){
                $('#promocao').val("");
                $('#premio').val("");
                $('#porcentagem').val("");
            });

            //retorna um array com os valores do premio das vendedoras
            function valorPremio(){
                let array = [];

                $.each($('#table').find('tbody tr'), function(idx, result){
                    array.push($(this).find('td:eq(3)').text());
                });

                return array;
            }

            //cria mensagem com as ganhadoras dos premios para enviar por whatsapp
            $('#btn_msg_wpp').click(function(){
                let promocao = $('#promocao').val().toUpperCase();
                let premio;

                if($('#opcPremio').prop('checked'))
                    premio = "*Prêmio:* R$ " + parseFloat($('#premio').val()).toFixed(2);
                else
                    premio = "*Prêmio:* " + $('#porcentagem').val() + "%25";

                let msg = "*Promoção:* " + promocao +
                        "%0A" + premio +
                        "%0A" +
                        "%0A*Colocação:*" +
                        "%0A";

                let arrayPremio = valorPremio();

                for(let i = 0; i < arrayVendas.length; i++){

                    if(i === 0)
                        msg += "*" + (i + 1) + "º Colocado* 😍🏆😍";
                    else if(i > 0 && i < 3)
                        msg += "*" + (i + 1) + "º Colocado* ⭐";
                    else if(i > 2 && i < 7)
                        msg += "*" + (i + 1) + "º Colocado* 👍🏼";
                    else
                        msg += (i + 1) + "º Colocado 🙁";

                    msg += "%0ANome: " + arrayVendedoras[i];
                    msg += "%0ATotal Vendas: R$ " + arrayVendas[i];
                    msg += "%0APrêmio: " + arrayPremio[i];
                    msg += "%0A%0A";
                }

                let re = new RegExp(' ', 'g');
                msg = msg.replace(re, '%20');

                let wpp = "https://api.whatsapp.com/send?phone=&text=" + msg;

                window.open(wpp, '_blank');

            });

        });
    </script>

@stop