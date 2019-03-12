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

        .lido {
            /*background-color: #7eaeca;*/
            background-color: #dcebf9;
            transition:background-color 1s ease;
        }

        .ok {
            color: #0088ff;
            font-weight: 700;
        }

        .nao_lido {
            color: #cc0000;
            font-weight: 700;
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
                <li class="active">Inventário</li>
            </ol>
        </section>

        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Inventário</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="input-excel">Excel lista de estoque da marca:</label>
                            <input type="file" id="input-excel" accept=".xlsx, .csv, .xls"/>
                        </div>
                        <!-- .col-md-6 -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="deposito">Deposito</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-cube"></i></span>
                                    <select id="deposito" class="form-control">
                                        <option value="">Selecione a opção</option>
                                    </select>
                                </div>
                            </div>
                            <!-- .form-group -->
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-danger pull-right" style="margin-top: 26px;"
                                    data-toggle="modal" data-target="#modal_pdf">
                                <i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Exportar PDF</button>
                            <button id="btn_export_excel" type="button" class="btn btn-success pull-right" style="margin: 26px 15px 0 0;">
                                <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Exportar Excel</button>
                            <button id="btn_att_est" type="button" class="btn btn-primary pull-right" style="margin: 26px 15px 0 0;">
                                <i class="fa fa-upload"></i>&nbsp;&nbsp;Atualizar Estoque Tabela</button>
                        </div>
                        <!-- .col-md-5 -->
                        <div class="col-md-12">
                            <hr/>
                        </div>
                        <!-- .col-md-12 -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="input_id">Digite o código do produto:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                    <input type="text" id="input_id" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <!-- .col-md-12 -->
                        <div id="div-excel" class="col-md-12 table-responsive">

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

    <!-- MODAL TABELA GANHADORAS -->
    <div class="modal fade" id="modal_pdf">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Escolha a forma para salvar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 25px;">
                    <div class="col-md-2"></div>
                    <div class="row col-md-8">

                        <button id="btn_export_pdf_erros" type="button" class="btn btn-danger pull-right">
                            <i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Exportar PDF Erros</button>
                        <button id="btn_export_pdf" type="button" class="btn btn-danger pull-right" style="margin-right: 5px;">
                            <i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Exportar PDF</button>

                    </div>
                    <div class="col-md-2"></div>
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

    <script src={{asset('js/admin/xlsx.full.min.js')}}></script>
    <script src="{{asset('js/admin/jquery.blockUI.js')}}"></script>
    <script src="{{asset('js/admin/jquery.base64.js')}}"></script>
    <script src="{{asset('js/admin/jquery.btechco.excelexport.js')}}"></script>
    <script src="{{asset('js/admin/sweetalert.min.js')}}"></script>
    <script>
        $(function() {

            getDepositos();

            function getDepositos(){
                $.ajax({
                    url: '{{route('get.depositos')}}',
                    type: 'get',
                    success: function(data){
                        let obj = JSON.parse(data);
                        obj = obj.retorno.depositos;
                        console.log(obj);

                        for(let i =0; i < obj.length; i++){
                            if(obj[i].deposito.situacao !== "Inativo") {
                                let option = $('<option>').text(obj[i].deposito.descricao).val(obj[i].deposito.id);
                                $('#deposito').append(option);
                            }
                        }
                    }
                })
            }

            //gera a tabela pelo arquivo excel selecionado
            $('#input-excel').change(function(e){

                if($(this).val().length !== 0) {
                    bloqueia_tela();
                    let reader = new FileReader();
                    reader.readAsArrayBuffer(e.target.files[0]);
                    reader.onload = function (e) {
                        let data = new Uint8Array(reader.result);
                        let wb = XLSX.read(data, {type: 'array'});
                        let htmlstr = XLSX.write(wb, {sheet: "", type: 'binary', bookType: 'html'});

                        $('#div-excel').find('table').remove();
                        $('#div-excel')[0].innerHTML += htmlstr;

                        $('#div-excel').find('table').addClass('table table-striped').attr('id', 'table-excel');
                        $('#table-excel').find('tbody tr:first').css('font-weight', '700');

                        let pos_cod, pos_prod, pos_qtd;

                        let pos_lidos = verifica_pos("Lidos", $('#table-excel'));
                        console.log(pos_lidos);

                        if (pos_lidos === 0) {
                            $.each($('#table-excel').find('tbody tr'), function (idx, result) {
                                check_utf8($(this).find('td:first'));
                                check_utf8($(this).find('td:eq(1)'));

                                if (idx !== 0) {
                                    //variáveis declaradas aqui pois é necessário corrigir o texto
                                    //com o check_utf8 antes de consultar
                                    pos_cod = verifica_pos("Código", $('#table-excel'));
                                    pos_prod = verifica_pos("Produto", $('#table-excel'));
                                    pos_qtd = verifica_pos("Quantidade", $('#table-excel'));

                                    let prod = $(this).find('td:eq(' + pos_prod + ')').text();

                                    if (prod !== "") {

                                        let qtd = $(this).find('td:eq(' + pos_qtd + ')').text();
                                        qtd = parseInt(qtd);
                                        $(this).find('td:eq(' + pos_qtd + ')').text(qtd);

                                        retira_dados_desnecessarios($(this), pos_cod, pos_prod, pos_qtd);

                                        //montar_tr(0, $(this), "");
                                        let td = $('<td>');
                                        let p = $('<p>').text(0);
                                        p.attr('id', 'alterar_lidos');
                                        td.append(p);
                                        $(this).append(td);

                                        montar_tr(qtd, $(this), "none");
                                        montar_tr("Não lido", $(this), "");

                                        $(this).find('td:last').addClass('nao_lido');

                                        let td_botao = `<td id="col_botao" style="width: 250px;">
                                            <span id="aviso" style="font-weight: 700; color: #cc0000;">Estoque nao atualizado</span> <i id="icone" class="fa fa-times" style="color: #cc0000"></i>
                                            <button id="btn_atualizar" class="fa fa-upload btn btn-outline-warning" style="color: #367fa9"></button>
                                        </td>`;

                                        $(this).append(td_botao);

                                        pos_qtd = verifica_pos("Quantidade", $('#table-excel'));
                                        $(this).find('td:eq(' + (pos_qtd - 1) + ')').css('display', 'none');

                                        //deixa "Não Lido" em vermelho
                                        //$(this).find('td:last').addClass('nao_lido').css('width', '250px');
                                    }
                                    else {
                                        $(this).remove();
                                    }

                                }

                            });

                            retira_dados_desnecessarios($('#table-excel').find('tbody tr:first'), pos_cod, pos_prod, pos_qtd);

                            montar_tr("Lidos", $('#table-excel').find('tbody tr:first'), "");
                            montar_tr("Diferenca", $('#table-excel').find('tbody tr:first'), "none");
                            montar_tr("Observacao", $('#table-excel').find('tbody tr:first'), "");
                            montar_tr("", $('#table-excel').find('tbody tr:first'), "");

                            $('#table-excel').find('tbody tr:first').find('td:eq(' + (pos_qtd - 1) + ')').css('display', 'none');
                        }
                        else {
                            console.log('reposição');

                            $.each($('#table-excel').find('tbody tr'), function (idx, result) {
                                pos_qtd = verifica_pos("Quantidade", $('#table-excel'));
                                let pos_dif = verifica_pos("Diferenca", $('#table-excel'));
                                let pos_obs = verifica_pos("Observacao", $('#table-excel'));
                                let pos_lidos = verifica_pos("Lidos", $('#table-excel'));
                                let lidos = $(this).find('td:eq(' + pos_lidos + ')');
                                let qtd_lidos = lidos.text();

                                $(this).find('td:eq(' + pos_qtd + ')').css('display', 'none');
                                $(this).find('td:eq(' + pos_dif + ')').css('display', 'none');

                                let obs = $(this).find('td:eq(' + pos_obs + ')');
                                let est_att = $(this).find('td:last');
                                let re = new RegExp(' ', 'g');

                                if (obs.text() === "Lido" && idx !== 0)
                                    obs.addClass('ok');
                                else if (idx !== 0)
                                    obs.addClass('nao_lido');

                                let td_botao = `<button id="btn_atualizar" class="fa fa-upload btn btn-outline-warning" style="color: #367fa9"></button>`;

                                if (idx !== 0) {
                                    let p = $("<p>").text(qtd_lidos);
                                    p.attr('id', 'alterar_lidos');
                                    lidos.text("");
                                    lidos.append(p);
                                }

                                if (est_att.text().replace(re, '') === 'Estoquenaoatualizado' && idx !== 0) {
                                    let texto = est_att.text();
                                    est_att.text("");

                                    let span = $("<span>");
                                    span.text(texto);
                                    span.attr("id", "aviso");

                                    est_att.css("font-weight", "700").css("color", "#cc0000");

                                    let icone = $('<i>');
                                    icone.addClass('fa fa-times').css("color", "#cc0000");
                                    icone.attr("id", "icone");

                                    est_att.append(span, icone, td_botao);
                                }
                                else if (idx !== 0) {
                                    let texto = est_att.text();
                                    est_att.text("");

                                    let span = $("<span>");
                                    span.text(texto);
                                    span.attr("id", "aviso");

                                    est_att.css("font-weight", "700").css('color', '#008d4c');

                                    let icone = $('<i>');
                                    icone.addClass('fa fa-check').css("color", "#008d4c");
                                    icone.attr("id", "icone");

                                    est_att.append(span, icone, td_botao);
                                }

                            });
                        }

                        $('#table-excel').find('tbody tr:first').addClass('titulo');

                        ativa_botao();

                    }
                    $.unblockUI();
                }

            });

            function retira_dados_desnecessarios(tr, pos_cod, pos_prod, pos_qtd){
                let tam = tr.find('td').length;

                for(let i = (tam - 1); i > 0; i--){
                    if(i !== pos_cod && i !== pos_prod && i!== pos_qtd)
                        tr.find('td:eq(' + i + ')').remove();
                }
            }

            //função para verificar se os nomes e cidades estão no formato utf-8
            function check_utf8(td){
                let texto;

                try{
                    texto = decode_utf8(td.text());
                }
                catch(e){
                }

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

            //procura a posição de uma determinada td na tabela passada por parametro
            function verifica_pos(texto, table){
                let pos_qtd = 0;
                $.each(table.find('tbody tr:first td'), function(idx, result){

                    if($(this).text() === texto)
                        pos_qtd = idx;

                });
                return pos_qtd;
            }

            //vincula as tds com as trs
            function montar_tr(texto, tr, estilo){
                let td = $('<td>>').text(texto);
                td.css('display', estilo);
                tr.append(td);
            }

            $('#input_id').focus(function(){
                $(this).select();
            });

            let tr_errada = null;
            $('#input_id').keypress(function(event){
                let keycode = (event.keyCode ? event.keyCode : event.which);

                if(keycode === 13){
                    let re = new RegExp(' ', 'g');
                    $(this).val($(this).val().replace(re, ''));
                    let id = $(this).val();
                    let tem_sku = false;

                    $.each($('#table-excel').find('tbody tr:not(:first)'), function(){

                        if(id.toUpperCase() === $(this).find('td:first').text().toUpperCase()){
                            let pos_lidos = verifica_pos("Lidos", $('#table-excel'));
                            let pos_dif = verifica_pos("Diferenca", $('#table-excel'));
                            let pos_obs = verifica_pos("Observacao", $('#table-excel'));

                            let lidos = $(this).find('td:eq(' + pos_lidos + ')').text();
                            let dif = $(this).find('td:eq(' + pos_dif + ')').text();
                            lidos = (parseInt(lidos) + 1);
                            dif = (parseInt(dif) - 1);

                            //incrementa e decrementa os campos lidos e diferença
                            $(this).find('td:eq(' + pos_lidos + ')').find('#alterar_lidos').text(lidos);
                            $(this).find('td:eq(' + pos_dif + ')').text(dif);

                            //realoca a tr que foi lida para a primeira posição
                            $('.titulo').after($(this));

                            //seleciona o input para que possa ser lido dnv
                            $('#input_id').select();

                            let est = $(this).find('td:last');
                            troca_status_estoque(est);

                            $(this).find('td:eq(' + pos_obs + ')').text("Lido").removeClass('nao_lido').addClass('ok');
                            efeito_troca($(this));

                            tem_sku = true;

                            return false;
                        }
                    });

                    if(!tem_sku)
                        swal("Ops", "SKU não encontrado.", "warning");
                }
            });

            function troca_status_estoque(est){
                est.find('#aviso').css('font-weight', '700').css('color', "#cc0000");
                est.find('#aviso').text('Estoque nao atualizado ');
                est.find("#icone").addClass('fa-times').removeClass('fa-check');
                est.find("#icone").css('color', '#cc0000');
            }

            function efeito_troca(tr){
                tr.toggleClass('lido');

                setTimeout(() => {
                    tr.toggleClass('lido');
                }, 1000);
            }

            function export_pdf(tabela_toda){
                let obj = {
                    'tabela': [],
                    'inventario': [],
                    'titulo': [],
                    'options': [],
                };

                obj.inventario.push({
                    'produto': 'Produto', 'codigo': 'Código', 'qtd': 'Quantidade',
                    'lidos': 'Lidos', 'dif': 'Diferença', 'obs': 'Observação'
                });

                obj.titulo.push({'title': 'Inventário'});

                let pos_cod = verifica_pos('Código', $('#table-excel'));
                let pos_produto= verifica_pos('Produto', $('#table-excel'));
                let pos_qtd = verifica_pos('Quantidade', $('#table-excel'));
                let pos_lidos = verifica_pos('Lidos', $('#table-excel'));
                let pos_dif = verifica_pos('Diferenca', $('#table-excel'));
                let pos_obs = verifica_pos('Observacao', $('#table-excel'));
                let lidos_mais = 0;
                let lidos_menos = 0;
                let nao_lidos = 0;

                $.each($('#table-excel').find('tbody tr:not(:last)'), function(idx, result){

                    if(idx !== 0) {

                        let produto = $(this).find('td:eq(' + pos_produto + ')').text();
                        let codigo = $(this).find('td:eq(' + pos_cod + ')').text();
                        let qtd = $(this).find('td:eq(' + pos_qtd + ')').text();
                        let lidos = $(this).find('td:eq(' + pos_lidos + ')').text();
                        let dif = $(this).find('td:eq(' + pos_dif + ')').text();
                        let obs = $(this).find('td:eq(' + pos_obs + ')').text();
                        let est_att = $(this).find('td:last').find('#aviso').text();

                        if(dif > 0)
                            lidos_mais++;
                        else  if(dif < 0)
                            lidos_menos++;

                        //let texto_nao_lido = removerAcentos(obs);

                        if(obs === 'Nao lido' || obs === 'Não lido')
                            nao_lidos++;

                        if(tabela_toda === true) {
                            obj.tabela.push({
                                'codigo': codigo, 'produto': produto, 'qtd': qtd,
                                'lidos': lidos, 'dif': dif, 'obs': obs, 'est_att': est_att
                            });
                        }else if(dif != 0){
                            obj.tabela.push({
                                'codigo': codigo, 'produto': produto, 'qtd': qtd,
                                'lidos': lidos, 'dif': dif, 'obs': obs, 'est_att': est_att
                            });
                        }
                    }

                });

                obj.options.push({
                    'lidos_mais': lidos_mais, 'lidos_menos': lidos_menos, 'nao_lidos': nao_lidos
                });

                localStorage.setItem('storeObj', JSON.stringify(obj));

                window.open('{{route('relatorio.tabela')}}', '_blank');
            }

            $('#btn_export_pdf').click(function(){
                export_pdf(true);
            });

            $('#btn_export_pdf_erros').click(function(){
                export_pdf(false);
            });

            $('#btn_att_est').click(function(){
                if($('#deposito').val() !== "") {
                    bloqueia_tela();

                    atualiza_todos_estoques();
                }
                else{
                    swal("Deposito", "Selecione o deposito antes de atualizar o estoque.", "info");
                }

            });

            let contador = 1;
            function atualiza_todos_estoques(){
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                let sku = $('#table-excel').find('tbody tr:eq(' + contador + ') td:first').text();
                let produto = $('#table-excel').find('tbody tr:eq(' + contador + ') td:eq(1)').text();
                let estoque = $('#table-excel').find('tbody tr:eq(' + contador + ') td:eq(3)').text();
                let id_deposito = $('#deposito').val();

                $.ajax({
                    url: '{{ route('att.estoque.deposito') }}',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                        sku: sku,
                        estoque: estoque,
                        produto: produto,
                        id_deposito: id_deposito
                    },
                    success: function (d) {
                        console.log(d);
                        let parser = new DOMParser();
                        let obj = parser.parseFromString(d, "text/xml");

                        if(obj.getElementsByTagName('erros').length === 0) {
                            let data = new Date();
                            let aviso = $('#table-excel').find('tbody tr:eq(' + contador + ')').find('td:last').find('#aviso');
                            aviso.css('color', '#008d4c');
                            let icone = $('#table-excel').find('tbody tr:eq(' + contador + ')').find('td:last').find('#icone');
                            icone.removeClass('fa-times').addClass('fa-check').css('color', '#008d4c');
                            aviso.text("Atualizado " + data.getDate() + '/' + (data.getMonth() + 1) + '/' + data.getFullYear() + " " + data.getHours() + ":" + data.getMinutes());
                        }

                    },
                    error: function(d){
                        swal('Ops', 'Ocorreu um erro com o servidor.', 'error');
                        $.unblockUI()
                    }
                })
                    .done(function () {
                        contador++;
                        if (contador <= ($('#table-excel').find('tbody tr:not(:first)').length - 1))
                            atualiza_todos_estoques();
                        else {
                            contador = 1;
                            $.unblockUI();
                        }
                    });
            }

            function atualiza_estoque(campo_tr){
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                let sku = campo_tr.find('td:first').text();
                let produto = campo_tr.find('td:eq(1)').text();
                let estoque = campo_tr.find('td:eq(3)').text();
                let id_deposito = $('#deposito').val();

                let erro = false;

                $.ajax({
                    url: '{{ route('att.estoque.deposito') }}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, sku: sku, estoque: estoque, produto: produto, id_deposito: id_deposito},
                    success: function(data){
                        let parser = new DOMParser();
                        let obj = parser.parseFromString(data, "text/xml");

                        if(obj.getElementsByTagName('erros').length === 0){
                            let data = new Date();
                            let aviso = campo_tr.find('td:last').find('#aviso');
                            aviso.css('color', '#008d4c');
                            let icone = campo_tr.find('td:last').find('#icone');
                            icone.removeClass('fa-times').addClass('fa-check').css('color', '#008d4c');
                            aviso.text("Atualizado " + data.getDate() + '/' + (data.getMonth() + 1) + '/' + data.getFullYear() + " " + data.getHours() + ":" + data.getMinutes());
                        }
                        else{
                            swal('Ops', 'Ocorreu um erro ao atualizar o estoque do produto: \nSKU: ' + sku + '\nProduto: ' + produto, 'error');
                        }

                        console.log(data);

                    },
                    error: function(xhr, r){
                        swal('Ops', 'Ocorreu um erro com o servidor.', 'error');
                        $.unblockUI()
                    }
                })
                    .done(function(){
                        $.unblockUI();
                        $('#input_id').focus();
                    });
            }

            //transforma a tabela das ganhadoras em um arquivo excel
            $("#btn_export_excel").click(function(){
                bloqueia_tela();

                $.each($('#table-excel').find('tbody tr'), function(idx, result){
                    let nova_string;
                    nova_string = removerAcentos($(this).find('td:first').text());
                    $(this).find('td:first').text(nova_string);
                    nova_string = removerAcentos($(this).find('td:eq(1)').text());
                    $(this).find('td:eq(1)').text(nova_string);
                    nova_string = removerAcentos($(this).find('td:eq(5)').text());
                    $(this).find('td:eq(5)').text(nova_string);

                    if(idx === 0){
                        nova_string = removerAcentos($(this).find('td:eq(2)').text());
                        $(this).find('td:eq(2)').text(nova_string);
                        nova_string = removerAcentos($(this).find('td:eq(3)').text());
                        $(this).find('td:eq(3)').text(nova_string);
                        nova_string = removerAcentos($(this).find('td:eq(4)').text());
                        $(this).find('td:eq(4)').text(nova_string);
                    }
                });

                let data = new Date();
                data = data.getDate() + "-" + (data.getMonth() + 1)+ "-" + data.getFullYear();

                $("#table-excel").btechco_excelexport({
                    containerid: "table-excel",
                    datatype: $datatype.Table,
                    filename: 'inventario ' + data
                });

                $.unblockUI();
            });

            function removerAcentos( newStringComAcento ) {
                let string = newStringComAcento;
                let mapaAcentosHex 	= {
                    a : /[\xE0-\xE6]/g,
                    e : /[\xE8-\xEB]/g,
                    i : /[\xEC-\xEF]/g,
                    o : /[\xF2-\xF6]/g,
                    u : /[\xF9-\xFC]/g,
                    c : /\xE7/g,
                    n : /\xF1/g
                };

                for (let letra in mapaAcentosHex) {
                    let expressaoRegular = mapaAcentosHex[letra];
                    console.log(letra);
                    console.log(expressaoRegular);
                    console.log(string);
                    string = string.replace(expressaoRegular, letra);
                }

                return string;
            }

            function bloqueia_tela(){
                $.blockUI({
                    message: 'Carregando...',
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

            function ativa_botao(){
                $('button#btn_atualizar').click(function(){

                    if($("#deposito").val() !== "") {
                        let campo_tr = $(this).parent().parent();

                        bloqueia_tela();

                        atualiza_estoque(campo_tr);
                    }
                    else{
                        swal("Deposito", "Selecione o deposito antes de atualizar o estoque.", "info");
                    }

                });

                $("p#alterar_lidos").dblclick(function(){
                    let campo_tr = $(this).parent().parent();
                    let sku = campo_tr.find('td:first').text();
                    let prod = campo_tr.find('td:eq(1)').text();
                    let p_atual = $(this);


                    swal({
                        title: "Você tem certeza que deseja zerar ?",
                        text: "SKU: " + sku + '\nProduto: ' + prod,
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then((vai_apagar) => {
                            if (vai_apagar) {
                                let pos_obs = verifica_pos("Observacao", $('#table-excel'));
                                let pos_qtd = verifica_pos("Quantidade", $('#table-excel'));
                                let pos_dif = verifica_pos("Diferenca", $('#table-excel'));
                                let obs = campo_tr.find('td:eq(' + pos_obs + ')');
                                let qtd = campo_tr.find('td:eq(' + pos_qtd + ')').text();
                                let est = campo_tr.find('td:last');

                                campo_tr.find('td:eq(' + pos_dif+ ')').text(qtd);

                                p_atual.text(0);
                                obs.text("Não lido").removeClass('ok').addClass('nao_lido');

                                troca_status_estoque(est);
                            }
                        });

                });
            }

        });
    </script>

@stop