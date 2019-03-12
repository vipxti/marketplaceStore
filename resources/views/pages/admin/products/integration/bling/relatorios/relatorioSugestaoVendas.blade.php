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

    <style>
        .periodos{
            background-color: #f5f5f5;
            border: 1px solid #e3e3e3;
            border-radius: 6px;
            padding-top: 5px;
            margin: 10px 10px 10px 20px;
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
                <li class="active">Sugestão de Compra</li>
            </ol>
        </section>

        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Sugestão de Compras</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-7 periodos">
                            <div class="col-md-5" style="margin-top: 5px;">
                                <label for="input-excel">Excel lista de vendas:</label>
                                <input type="file" id="input-excel" accept=".xlsx, .csv, .xls"/>
                            </div>
                            <!-- .col-md-3 -->
                            <div class="col-md-5" style="margin-top: 5px;">
                                <label for="input-excel-estoque">Excel lista de estoque:</label>
                                <input type="file" id="input-excel-estoque" accept=".xlsx, .csv, .xls"/>
                            </div>
                            <!-- .col-md-3 -->
                            <div class="col-md-2{{--text-center--}}" style="margin: 25px 0 25px 0;">
                                <button id="btn_visualizar" class="btn btn-primary pull-right" style="/*width: 100%;*/ margin-bottom: 15px;">
                                    <i class="fa fa-eye"></i>&nbsp;&nbsp;Visualizar</button>
                            </div>

                            <p style="padding-left: 15px;"><b><span style="color: red">*Atenção: </span>
                                 O período de datas deve ser o mesmo colocado no BLING para evitar erros nos cálculos.</b>
                            </p>

                            {{--<div class="col-md-7 periodos">--}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="periodo_de">Período de:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input id="periodo_de" type="date" class="form-control"/>
                                        </div>
                                    </div>
                                    <!-- .form-group -->
                                    <div class="form-group">
                                        <label for="periodo_ate">Até:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input id="periodo_ate" type="date" class="form-control"/>
                                        </div>
                                    </div>
                                    <!-- .form-group -->
                                </div>
                                <!-- .col-md-2 -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="previsao">Previsão: (dias)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input id="previsao" type="number" class="form-control" min="0"/>
                                        </div>
                                    </div>
                                    <!-- .form-group -->
                                    <div class="form-group">
                                        <label for="seguranca">Crescimento: (%)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                            <input id="seguranca" type="number" class="form-control" min="0"/>
                                        </div>
                                    </div>
                                    <!-- .form-group -->
                                </div>
                            <div class="col-md-2" style="height: 140px;">
                                <button id="btn_calcular" class="btn btn-primary pull-right" style="margin-top: 20px; /*width: 100%;*/">
                                    <i class="fa fa-calculator"></i>&nbsp;&nbsp;Calcular</button>
                            </div>
                            {{--</div>--}}
                        </div>


                        <div class="col-md-4 text-center">
                            <p>&nbsp;</p>
                            <img src="{{asset('img/app/core-img/logo1.png')}}"/>
                            <p>&nbsp;</p>
                            <div class="col-md-12" style="margin-bottom: 15px;">
                                <button id="btn_export_pdf" type="button" class="btn btn-danger" style="width: 215px;">
                                    <i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Exportar PDF</button>
                            </div>
                            <div class="col-md-12" style="margin-bottom: 15px;">
                                <button id="btn_export_excel" type="button" class="btn btn-success" style="width: 215px;">
                                    <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Exportar Excel</button>
                            </div>
                            <div class="col-md-12">
                                <button id="btn_export_table_pdf" type="button" class="btn btn-danger" style="width: 215px;">
                                    <i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Exportar Tabela em PDF</button>
                            </div>
                        </div>

                        <div id="div-excel" class="col-md-12 table-responsive" style="display: none;">
                            <hr/>
                        </div>

                        <div id="div-excel-hidden" style="display: none;"></div>

                    </div>
                    <!-- .row -->
                </div>
                <!-- .box-body -->
            </div>
            <!-- .box-primary -->
        </section>
    </div>
    <!-- .content-wrapper -->

    <script lang="javascript" src={{asset('js/admin/xlsx.full.min.js')}}></script>
    <script src="{{asset('js/admin/jquery.base64.js')}}"></script>
    <script src="{{asset('js/admin/jquery.btechco.excelexport.js')}}"></script>
    <script src="{{asset('js/admin/jquery.cookie.js')}}"></script>
    <script src="{{asset('js/admin/jquery.blockUI.js')}}"></script>
    <script>
        $(function(){

            //gera a tabela pelo arquivo excel selecionado
            $('#input-excel').change(function(e){
                let p1 = new Promise((resolve, reject) => {
                    bloqueia_tela();

                    resolve();
                });

                p1.then(function(){
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

                        //remove da tabela principal os campos de 'Desconto', 'Frete', 'Preço Médio' e 'Valor de Venda'
                        $.each($('#table-excel').find('tbody tr'), function(idx, result){
                            for(let i = 7; i >= 4; i--){
                                $(this).find('td:eq(' + i + ')').remove();
                            }

                            if($(this).find('td:first').text() === ""){
                                $(this).remove();
                            }

                            $(this).find('td:eq(1)').text("");


                            let td = verifica_pos_qtd("Produto", $('#table-excel'));
                            check_utf8($(this).find('td:eq(' + td + ')'));

                            td = verifica_pos_qtd("CÃ³digo", $('#table-excel'));
                            let td2 = verifica_pos_qtd("CÃÂ³digo", $('#table-excel'));
                            if(td !== 0 || td2 !== 0)
                                check_utf8($(this).find('td:eq(2)'));
                        });

                        //seta a sugestao como falsa para nao ter erros em novas consultas
                        //pois se continuasse verdadeiro, ele deletava as duas ultimas tds
                        existe_sugestao = false;
                        //cria_thead();

                        //caso o arquivo de estoque já foi selecionado
                        //é montado a união das tabelas
                        if($('#input-excel-estoque').val() !== "" && $('#input-excel').val() !== "")
                            monta_tabela();
                    }

                    $.unblockUI();
                }, function(){
                    $.unblockUI();
                });

            });

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

            function bloqueia_tela(){
                if($('#input-excel-estoque').val() !== "" && $('#input-excel').val() !== "") {
                    $.blockUI({
                        //message: 'Carregando...',
                        css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .5,
                            color: '#fff'
                        }
                    });
                }
            }

            //gera a tabela pelo arquivo excel selecionado
            $('#input-excel-estoque').change(function(e){
                let p1 = new Promise((resolve, reject) => {
                    bloqueia_tela();

                    resolve();
                });

                p1.then(function(){
                    let reader = new FileReader();
                    reader.readAsArrayBuffer(e.target.files[0]);
                    reader.onload = function(e) {
                        let data = new Uint8Array(reader.result);
                        let wb = XLSX.read(data,{type:'array'});
                        let htmlstr = XLSX.write(wb,{sheet:"", type:'binary',bookType:'html'});

                        $('#div-excel-hidden').find('table').remove();
                        $('#div-excel-hidden')[0].innerHTML += htmlstr;

                        $('#div-excel-hidden').find('table').attr('id', 'table-excel-hidden');

                        //seta a sugestao como falsa para nao ter erros em novas consultas
                        //pois se continuasse verdadeiro, ele deletava as duas ultimas tds
                        existe_sugestao = false;

                        $.each($('#table-excel-hidden').find('tbody tr'), function(){
                            let td = verifica_pos_qtd("Produto", $('#table-excel-hidden'));
                            check_utf8($(this).find('td:eq(' + td + ')'));

                            td = verifica_pos_qtd("CÃ³digo", $('#table-excel-hidden'));
                            check_utf8($(this).find('td:eq(' + td + ')'));
                        });

                        //caso o arquivo de vendas já foi selecionado
                        //é montado a união das tabelas
                        if($('#input-excel').val() !== "" && $('#input-excel-estoque').val() !== "")
                            monta_tabela();

                    }

                    $.unblockUI();
                }, function () {
                    $.unblockUI();
                });


            });

            //monta a tabela com os dados dos arquivos do excel
            let montou_tabela = false;
            async function monta_tabela(){
                let flag = false;

                //caso ja tenha montado a tabela anteriormente,
                //toda vez que for montar dnv vai remover o td da qtd_estoque
                if(montou_tabela) {
                    let td_qtd = verifica_pos_qtd("Qtde Estoque", $('#table-excel'));

                    if(td_qtd !== 0) {
                        $.each($("#table-excel").find('tbody tr'), function () {
                            for(let i = $(this).find('td').length; i > td_qtd; i--){
                                $(this).find('td:eq(' + i + ')').remove();
                            }

                            $(this).find('td:eq(' + td_qtd + ')').remove();
                        });
                    }
                }

                let custo_total = 0;
                //passa pela tabela de estoque a procura dos itens que foram vendidos
                //de acordo com o arquivo de lista de vendas
                $.each($('#table-excel').find('tbody tr'), function(idx, result){

                    let sku = $(this).find('td:eq(2)').text();

                    //se não existir sku cadastrado no produto
                    //a consulta é feita pelo nome
                    if(sku === "")
                        sku = $(this).find('td:first').text();

                    let existe_sku = false;

                    if(idx !== 0) {
                        let pos_qtd = verifica_pos_qtd("Qtde", $('#table-excel'));
                        let qtd = $(this).find('td:eq(' + pos_qtd + ')').text();
                        $(this).find('td:eq(' + pos_qtd + ')').text(parseInt(qtd));
                    }


                    $.each($('#table-excel-hidden').find('tbody tr'), function(index){
                        //caso exista o sku ele monta um td na tabela principal
                        if(sku === $(this).find('td:first').text() || sku === $(this).find('td:eq(1)').text()){
                            if(!flag){
                                montar_tr('Qtde Estoque', $('#table-excel').find('tbody tr:eq(' + idx + ')'));
                                montar_tr('Valor unitário', $('#table-excel').find('tbody tr:eq(' + idx + ')'));
                                flag = true;
                            }else {
                                //vai procurar na tabela de estoque o campo com a "Quantidade"
                                //para pegar o seu indice para pegar os seus dados
                                let pos_qtd = verifica_pos_qtd("Quantidade", $('#table-excel-hidden'));
                                let qtd = parseInt($(this).find('td:eq(' + pos_qtd + ')').text());

                                montar_tr(qtd/*.replace(',', '')*/,
                                    $('#table-excel').find('tbody tr:eq(' + idx + ')'));

                                let pos_valor = verifica_pos_qtd("Valor unitÃ¡rio", $('#table-excel-hidden'));

                                if(pos_valor === 0)
                                    pos_valor = verifica_pos_qtd("Valor unitÃÂ¡rio", $('#table-excel-hidden'));

                                let custo = parseFloat($(this).find('td:eq(' + pos_valor + ')').text()).toFixed(2)/*.replace(',', '')*/;

                                montar_tr(custo, $('#table-excel').find('tbody tr:eq(' + idx + ')'));
                                custo_total+=parseFloat(custo);
                            }

                            existe_sku = true;
                        }

                        //caso o sku foi encontrado, ele sai do loop
                        if(existe_sku)
                            return false;

                    });
                });

                //caso exista alguma td que nao foi preenchida por nao ter encontrado o produto
                //esse loop vai preenchendo elas com o valor vazio
                $.each($('#table-excel').find('tbody tr'), function(){
                    if($(this).find('td').length < 6) {
                        montar_tr("", $(this));
                        montar_tr("", $(this));
                    }
                });
                let pos_valor = verifica_pos_qtd("Valor unitário", $('#table-excel'));
                $('#table-excel').find('tbody tr:last').find('td:eq(' + pos_valor + ')').text(parseFloat(custo_total).toFixed(2));

                montou_tabela = true;
            }

            //procura a posição de uma determinada td na tabela passada por parametro
            function verifica_pos_qtd(texto, table){
                let pos_qtd = 0;
                $.each(table.find('tbody tr:first td'), function(idx, result){

                    if($(this).text() === texto)
                        pos_qtd = idx;

                });
                return pos_qtd;
            }

            //vincula as tds com as trs
            function montar_tr(texto, tr){
                let td = $('<td>>').text(texto);
                tr.append(td);
            }

            //mostra a tabela montada, caso os dois arquivos do excel ja estejam selecionado
            $('#btn_visualizar').click(function(){
                if($('#input-excel').val() !== "" && $('#input-excel-estoque').val() !== "")
                    $('#div-excel').css('display', 'block');
            });

            //faz o calculo da sugestao de acordo com as datas e porcentagem que foi passado
            let existe_sugestao = false;
            $('#btn_calcular').click(function(){

                //declaração das variaveis para encontrar a diferença das datas
                let de = new Date($('#periodo_de').val());
                let ate = new Date($('#periodo_ate').val());
                let dias = Math.abs(de.getTime() - ate.getTime());
                let diferenca = Math.ceil(dias / (1000 * 3600 * 24));

                if(diferenca === 0)
                    diferenca = 1;

                let preco_total = 0;
                let sugestao_total = 0;

                //passa atraves da table para montar os tds com a qtd de compra sugerida
                $.each($('#table-excel').find('tbody tr:not(:last)'), function(idx, result){

                    //caso uma sugestão já foi feita anteriormente,
                    //ela é removida para que se possa criar uma nova
                    if(existe_sugestao) {
                        $(this).find('td:last').remove();
                        $(this).find('td:last').remove();
                        $(this).find('td:last').remove();
                    }

                    if(idx === 0) {
                        montar_tr('Sugestão', $(this));
                        montar_tr('Preço', $(this));
                        montar_tr('', $(this));
                    }
                    else{
                        let previsao = $('#previsao').val();
                        let qtd = $(this).find('td:eq(3)').text();
                        let pos_qtd = verifica_pos_qtd("Qtde Estoque", $('#table-excel'));
                        let qtd_estoque = $(this).find('td:eq(' + pos_qtd + ')').text();

                        if(qtd_estoque === "")
                            qtd_estoque = 0;

                        let sugestao = Math.ceil((qtd / diferenca) * previsao);

                        sugestao = Math.round(sugestao + (qtd * ($('#seguranca').val() / 100)));
                        sugestao = sugestao - qtd_estoque;

                        if(sugestao < 0)
                            sugestao = 0;

                        sugestao_total += sugestao;

                        montar_tr(sugestao, $(this));

                        let pos_preco = verifica_pos_qtd("Valor unitário", $('#table-excel'));
                        let preco = $(this).find('td:eq(' + pos_preco + ')').text();

                        if(preco === "")
                            preco = 0;
                        else
                            preco = parseFloat(preco);

                        preco = preco * sugestao;
                        preco_total += preco;

                        montar_tr(parseFloat(preco).toFixed(2), $(this));

                        let td_botoes = `<td id="colBotoes" class="text-right">
                                            <button id="btn_editar" class="fa fa-pencil btn btn-outline-warning btn_sugestao" style="color: #367fa9"></button>
                                            <button id="btn_salvar" class="fa fa-check btn btn-outline-warning btn_sugestao" style="color: #008d4c; display:none"></button>
                                            <button id="btn_cancelar" class="fa fa-remove btn btn-outline-warning btn_sugestao" style="color: #cc0000; display: none"></button>
                                        </td>`;

                        $(this).append(td_botoes);
                    }
                });

                if(existe_sugestao) {
                    $('#table-excel').find('tbody tr:last').find('td:last').remove();
                    $('#table-excel').find('tbody tr:last').find('td:last').remove();
                }

                montar_tr(sugestao_total, $('#table-excel').find('tbody tr:last'));
                montar_tr("R$ " + parseFloat(preco_total).toFixed(2), $('#table-excel').find('tbody tr:last'));

                existe_sugestao = true;
                ativa_editar();
            });

            function conta_total_sugest(){
                let preco_total = 0;
                let sug_total = 0;
                let pos_preco = verifica_pos_qtd("Preço", $('#table-excel'));
                let pos_sug = verifica_pos_qtd("Sugestão", $('#table-excel'));

                $.each($('#table-excel').find('tbody tr:not(:last)'), function(idx, result){
                    if(idx !== 0){
                        let preco = parseFloat($(this).find('td:eq(' + pos_preco + ')').text());
                        preco_total += preco;
                        let sugestao = parseFloat($(this).find('td:eq(' + pos_sug + ')').text());
                        sug_total += sugestao;
                    }
                });

                $('#table-excel').find('tbody tr:last').find('td:eq(' + pos_preco + ')').text("R$ " + parseFloat(preco_total).toFixed(2));
                $('#table-excel').find('tbody tr:last').find('td:eq(' + pos_sug+ ')').text(sug_total);
            }

            //função para ativar os botões de edição da sugestão
            function ativa_editar(){
                //pega o valor da td e insere no input para a edição
                let conteudo_original;
                $('button#btn_editar').click(function(){
                    const campo_tr = $(this).parent().parent();
                    const td_sugestao = campo_tr.find('td:eq(7)');
                    conteudo_original = td_sugestao.text();

                    td_sugestao.text("");

                    let input_sugestao = `<input id="input_sugestao" type="number" value="` + conteudo_original + `"/>`;
                    td_sugestao.append(input_sugestao);

                    ativa_input();

                    //quando a opção de edição for selecionada
                    //os botões são trocados e bloqueia os outros botões de edição
                    campo_tr.find('td:last').find('.btn_sugestao').toggle();
                    campo_tr.siblings().find('td:last').children().attr("disabled", "disabled");
                });

                //caso a operação for cancelada, o td volta a ter a quantidade original
                $('button#btn_cancelar').click(function(){
                    const campo_tr = $(this).parent().parent();
                    const td_sugestao = campo_tr.find('td:eq(7)');

                    //remove o input de edição, coloca o valor original na td,
                    //faz a troca e desbloqueia os botões de edição
                    $('#input_sugestao').remove();
                    td_sugestao.text(conteudo_original);
                    campo_tr.find('td:last').find('.btn_sugestao').toggle();
                    campo_tr.siblings().find('td:last').children().removeAttr("disabled");
                });

                //pega o valor inserido no input e coloca dentro da td,
                //atualizando o seu valor
                $('button#btn_salvar').click(function(){
                    const campo_tr = $(this).parent().parent();
                    const td_sugestao = campo_tr.find('td:eq(7)');
                    const td_preco = campo_tr.find('td:eq(8)');

                    let conteudo = $('#input_sugestao').val();

                    let pos_preco = verifica_pos_qtd("Valor unitário", $('#table-excel'));
                    let preco = parseFloat(campo_tr.find('td:eq(' + pos_preco + ')').text());

                    preco = preco * conteudo;

                    //remove o input de edição, coloca o valor original na td,
                    //faz a troca e desbloqueia os botões de edição
                    td_sugestao.text(conteudo);
                    td_preco.text(parseFloat(preco).toFixed(2));
                    conta_total_sugest();

                    $('#input_sugestao').remove();
                    campo_tr.find('td:last').find('.btn_sugestao').toggle();
                    campo_tr.siblings().find('td:last').children().removeAttr("disabled");
                });
            }

            function ativa_input(){
                $('#input_sugestao').keypress(function(event){
                    let keycode = (event.keyCode ? event.keyCode : event.which);

                    let campo_tr = $(this).parent().parent();
                    let btn_salvar = campo_tr.find('td:last').find('#btn_salvar');

                    if(keycode === 13) {
                        btn_salvar.click();
                    }
                });
            }

            //transforma a tabela das ganhadoras em um arquivo excel
            $("#btn_export_excel").click(function(){
                $("#table-excel").btechco_excelexport({
                    containerid: "table-excel",
                    datatype: $datatype.Table,
                    filename: 'Sugestão de vendas'
                });
            });

            //chama a função demoFromHTML
            $('#btn_export_pdf').click(function(){
                let obj = {
                    'tabela': [],
                    'thead': [],
                    'titulo': []
                };

                obj.thead.push({
                    'produto': 'Produto', 'codigo': 'Código', 'sugestao': 'Sugestão',
                    'preco': 'Custo', 'estoque': 'Estoque Atual', 'custo': 'Custo Total', 'venda': 'Venda', 'venda_total': 'Venda Total'
                });

                obj.titulo.push({'title': 'Relatório de Compra/Reposição'});

                let pos_cod = verifica_pos_qtd("Código", $('#table-excel'));
                let pos_sug = verifica_pos_qtd("Sugestão", $('#table-excel'));
                let pos_preco = verifica_pos_qtd("Preço", $('#table-excel'));
                let pos_est = verifica_pos_qtd("Qtde Estoque", $('#table-excel'));
                let pos_total = verifica_pos_qtd("Total Venda", $('#table-excel'));
                let pos_custo = verifica_pos_qtd("Valor unitário", $('#table-excel'));
                let pos_qtd_venda = verifica_pos_qtd("Qtde", $('#table-excel'));
                let custo_total = 0;
                let venda_total = 0;
                let sug_total = 0;
                let venda_sug_total = 0;
                let est_total = 0;

                $.each($('#table-excel').find('tbody tr:not(:last)'), function(idx, result){

                    if(idx !== 0) {

                        if (parseInt($(this).find('td:eq(' + pos_sug + ')').text()) !== 0) {
                            let produto = $(this).find('td:first').text();
                            let codigo = $(this).find('td:eq(' + pos_cod + ')').text();
                            let sugestao = $(this).find('td:eq(' + pos_sug + ')').text();
                            let preco = $(this).find('td:eq(' + pos_preco + ')').text();
                            let est = $(this).find('td:eq(' + pos_est + ')').text();
                            if(est === "")
                                est = 0;

                            let custo = $(this).find('td:eq(' + pos_custo + ')').text();
                            if(custo === "")
                                custo = 0;

                            let venda = $(this).find('td:eq(' + pos_total + ')').text();
                            let qtd = $(this).find('td:eq(' + pos_qtd_venda + ')').text();

                            est_total+=parseInt(est);

                            custo_total+= parseFloat(custo);
                            venda_total+= parseFloat(venda);
                            sug_total+= parseInt(sugestao);
                            venda = (parseFloat(venda) / parseInt(qtd)).toFixed(2);

                            let venda_sug = parseFloat(venda) * parseInt(sugestao);
                            venda_sug_total += venda_sug;

                            obj.tabela.push({
                                'produto': produto, 'codigo': codigo, 'sugestao': sugestao,
                                'preco': preco, 'estoque': est, 'custo': custo, 'venda': venda, 'venda_total': venda_sug
                            });
                        }

                    }

                });

                let produto =$('#table-excel').find('tbody tr:last').find('td:first').text();
                let codigo = $('#table-excel').find('tbody tr:last').find('td:eq(' + pos_cod + ')').text();
                let preco = $('#table-excel').find('tbody tr:last').find('td:eq(' + pos_preco + ')').text();

                obj.tabela.push({
                    'produto': produto, 'codigo': codigo, 'sugestao': sug_total,
                    'preco': preco, 'estoque': est_total, 'custo': custo_total, 'venda': venda_total, 'venda_total': venda_sug_total
                });

                localStorage.setItem('storeObj', JSON.stringify(obj));

                window.open('{{route('relatorio.tabela')}}', '_blank');

            });

            $('#btn_export_table_pdf').click(function(){
                let obj = {
                    'tabela': [],
                    'thead': [],
                    'titulo': []
                };

                obj.thead.push({
                    'produto': 'Produto', 'codigo': 'Código', 'sugestao': 'Sugestão',
                    'preco': 'Custo', 'estoque': 'Estoque Atual', 'custo': 'Custo Total', 'venda': 'Venda', 'venda_total': 'Venda Total'
                });

                obj.titulo.push({'title': 'Relatório de Compra/Reposição'});

                let pos_cod = verifica_pos_qtd("Código", $('#table-excel'));
                let pos_sug = verifica_pos_qtd("Sugestão", $('#table-excel'));
                let pos_preco = verifica_pos_qtd("Preço", $('#table-excel'));
                let pos_est = verifica_pos_qtd("Qtde Estoque", $('#table-excel'));
                let pos_total = verifica_pos_qtd("Total Venda", $('#table-excel'));
                let pos_custo = verifica_pos_qtd("Valor unitário", $('#table-excel'));
                let pos_qtd_venda = verifica_pos_qtd("Qtde", $('#table-excel'));
                let custo_total = 0;
                let venda_total = 0;
                let sug_total = 0;
                let venda_sug_total = 0;
                let est_total = 0;

                $.each($('#table-excel').find('tbody tr:not(:last)'), function(idx, result){

                    if(idx !== 0) {

                        //if ($(this).find('td:eq(' + pos_sug + ')').text() > 0) {
                            let produto = $(this).find('td:first').text();
                            let codigo = $(this).find('td:eq(' + pos_cod + ')').text();
                            let sugestao = $(this).find('td:eq(' + pos_sug + ')').text();
                            let preco = $(this).find('td:eq(' + pos_preco + ')').text();
                            let est = $(this).find('td:eq(' + pos_est + ')').text();
                            let custo = $(this).find('td:eq(' + pos_custo + ')').text();
                            let venda = $(this).find('td:eq(' + pos_total + ')').text();
                            let qtd = $(this).find('td:eq(' + pos_qtd_venda + ')').text();

                            est_total+=parseInt(est);

                            custo_total+= parseFloat(custo);
                            venda_total+= parseFloat(venda);
                            sug_total+= parseInt(sugestao);
                            venda = (parseFloat(venda) / parseInt(qtd)).toFixed(2);

                            let venda_sug = parseFloat(venda) * parseInt(sugestao);
                            venda_sug_total += venda_sug;

                            obj.tabela.push({
                                'produto': produto, 'codigo': codigo, 'sugestao': sugestao,
                                'preco': preco, 'estoque': est, 'custo': custo, 'venda': venda, 'venda_total': venda_sug
                            });
                        //}

                    }

                });

                let produto =$('#table-excel').find('tbody tr:last').find('td:first').text();
                let codigo = $('#table-excel').find('tbody tr:last').find('td:eq(' + pos_cod + ')').text();
                let preco = $('#table-excel').find('tbody tr:last').find('td:eq(' + pos_preco + ')').text();

                obj.tabela.push({
                    'produto': produto, 'codigo': codigo, 'sugestao': sug_total,
                    'preco': preco, 'estoque': est_total, 'custo': custo_total, 'venda': venda_total, 'venda_total': venda_sug_total
                });

                localStorage.setItem('storeObj', JSON.stringify(obj));

                window.open('{{route('relatorio.tabela')}}', '_blank');

            });

        });
    </script>

@stop