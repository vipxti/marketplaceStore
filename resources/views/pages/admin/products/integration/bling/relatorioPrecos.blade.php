@extends('layouts.admin.app')

@section('content')
    <!-- ESTILO DO BOTÃO TRANSPARENTE NA TABLE -->
    <style type="text/css">
        /*deixar botão transparente*/
        .btn_transparente {
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
            <h1><i class="fa fa-check-square-o"></i>&nbsp;&nbsp;Relatorio Preços Bling</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Bling</a></li>
                <li><a class="active">Relatorio Preços</a></li>
            </ol>
        </section>

        <!--SESSÃO DO SORTEIO-->
        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Relatorio Preços</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Escolha as lojas para relatório:</label>
                            <button id="btn_lojas" class="btn btn-primary" style="width: 100%"
                                    data-toggle="modal" data-target="#modal_lojas">
                                    Selecionar Lojas
                            </button>
                        </div>
                        <div class="col-md-offset-1 col-md-4 pull-left paragrafoPag" hidden>
                            <label>Pesquise produto por SKU:</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input id="inputPesqSku" type="text" class="form-control">
                                    <span class="input-group-addon" title="Pesquisar SKU">
                                <a id="btnPesqSku" href="javascript:void(0)">
                                    <i class="fa fa-search"></i>
                                </a>
                            </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 pull-right paragrafoPag" hidden>
                            <label>Escolha a página que você deseja:</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input id="inputEscolhaPag" type="text" class="form-control">
                                    <span class="input-group-addon" title="Pesquisar Página">
                                <a id="btnEscolhaPag" href="javascript:void(0)">
                                    <i class="fa fa-search"></i>
                                </a>
                            </span>
                                </div>
                            </div>
                        </div>
                        <br/>
                    </div>


                    <div class="row paragrafoPag" hidden>
                        <div class="col-md-12">
                            <p class="paragrafoPag text-center" hidden>
                                <a id="btnPagAnt" href="javascript:void(0)" title="Página Anterior">
                                    <span class="fa fa-chevron-circle-left" style="font-size: 17px;"></span>
                                </a>
                                &nbsp;
                                Página <span id="spanNumPag"></span>
                                &nbsp;
                                <a id="btnProxPag" href="javascript:void(0)" title="Próxima Página">
                                    <span class="fa fa-chevron-circle-right" style="font-size: 17px;"></span>
                                </a>
                            </p>
                        </div>
                    </div>

                    <div id="table_relatorio" class="row" hidden>
                        <div class="col-md-12 table-responsive">
                            <table id="table" class="table table-striped">
                                <thead>
                                    <tr id="thead">

                                    </tr>
                                </thead>
                                <tbody id="tbody">

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- MODAL CONFIGURAÇÃO DE PÚBLICO -->
                    <div class="modal fade" id="modal_lojas">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Lojas</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="padding: 25px;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>Lojas Disponíveis: (escolha até 5 lojas)</h5>
                                            <br/>
                                        </div>

                                        @foreach($lojas as $loja)
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input loja_checkada" id="{{$loja->id_loja}}" value="{{$loja->nome_loja}}">
                                                    <label class="form-check-label" for="{{$loja->id_loja}}">{{$loja->nome_loja}}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="btn_sair_modal" type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                                    <button id="btn_ajax_lojas" type="button" class="btn btn-primary">Salvar Público</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIM DO MODAL -->
                </div>
            </div>
        </section>
    </div>

    <script src="{{asset('js/admin/jquery.blockUI.js')}}"></script>
    <script src="{{asset('js/admin/sweetalert.min.js')}}"></script>
    <script>

        let page = 1;
        //==============================================================================================================
        //FUNÇÃO QUE VERIFICA A QUANTIDADE DE LOJAS
        $('.loja_checkada').click(function(){
            let contador = 0;

            $('.loja_checkada').each(function(){
                if($(this).is(':checked')){
                    contador+=1;
                }
            });

            if(contador > 5){
                swal('Ops', 'Permitido até 5 lojas', 'info');
                $(this).prop('checked', false);
            }

        });

        //==============================================================================================================
        //FUNÇÃO QUE CRIA AS THs DO THEAD
        function criaTH(texto){
            let div = $('<div></div>');
            div.css('width', '100%')/*.css('height', '80px')*/.css('overflow', 'auto');
            let th= $('<th></th>');
            th.css('width', '130px');
            div.text(texto);
            th.append(div);
            th.appendTo($('#thead'));
        }

        //==============================================================================================================
        //FUNÇÃO QUE CRIA A THEAD
        let nomesTh = ['SKU', 'Produto', 'Preço Custo', 'Preço'];
        function criaTHead(){
            $('#thead').empty();

            nomesTh.forEach(function(texto, idx, array){
                criaTH(texto);
            });

            $('.loja_checkada').each(function(){
                if($(this).is(':checked')) {
                    criaTH($(this).val());
                }
            });
        }

        //==============================================================================================================
        //FUNÇÃO QUE INSERE O PREÇO DAS LOJAS NA TABELA
        function precosLojas(produto, tr){
            let precos = '';
            try{
                let produtoLoja = produto.produtoLoja;

                let precoLoja = $('<td></td>');
                precos = parseFloat(produtoLoja.preco.preco);
                precoLoja.text(precos.toFixed(2)).css('text-align', 'center').appendTo(tr);
            }
            catch (e) {
                let precoLoja = $('<td></td>');
                precoLoja.text('-').css('text-align', 'center').appendTo(tr);
            }

        }

        //==============================================================================================================
        //FUNÇÃO QUE BUSCA OS PRODUTOS DAS LOJAS
        let arrayLojas = [];

        function funcaoBuscar(pagina){
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

            $('#tbody').empty();
            let indice = 0;

            buscaLojas(indice, pagina);

        }

        function buscaLojas(indice, pag){

            try{
                let id_loja = arrayLojas[indice];
                let pagina = "page=" + pag;

                $.ajax({
                    url: '{{url('/admin/product/bling/search/prods/')}}/' + pagina + '/' + id_loja,
                    type: 'get',
                    success: function(data){
                        let obj = JSON.parse(data);
                        obj = obj.retorno.produtos;
                        console.log(obj);

                        try {
                            if ($('#tbody').find('tr').length === 0) {

                                for (let i = 0; i < obj.length; i++) {
                                    let produto = obj[i].produto;

                                    let tr = $('<tr></tr>');
                                    let precos = '';
                                    let sku = $('<td></td>');
                                    sku.text(produto.codigo).appendTo(tr);
                                    let nomeProd = $('<td></td>');
                                    nomeProd.text(produto.descricao).appendTo(tr);
                                    let precoCusto = $('<td></td>');
                                    precos = parseFloat(produto.precoCusto);
                                    precoCusto.text(precos.toFixed(2)).appendTo(tr);
                                    let preco = $('<td></td>');
                                    precos = parseFloat(produto.preco);
                                    preco.text(precos.toFixed(2)).appendTo(tr);

                                    precosLojas(produto, tr);

                                    tr.addClass('tr' + i);
                                    tr.appendTo($('#tbody'));
                                }

                            }
                            else {
                                console.log('maior que zero');

                                for (let i = 0; i < obj.length; i++) {
                                    let produto = obj[i].produto;

                                    let tr = $('.tr' + i);

                                    precosLojas(produto, tr);

                                }

                            }
                        }
                        catch (e) {
                            swal('Erro', 'Ocorreu algum erro.', 'error');
                        }

                    }
                })
                    .done(function(){
                        $('#spanNumPag').text(pag);
                        if(indice < arrayLojas.length - 1)
                            buscaLojas(++indice, pag);
                        else
                            $.unblockUI();
                    });
            }
            catch(e){
                swal('Erro', 'Houve um erro na consulta dos preços', 'error');
            }
        }

        function buscaLojasSku(indice, sku){

            try{
                let id_loja = arrayLojas[indice];

                $.ajax({
                    url: '{{url('/admin/product/bling/search/prods/name/')}}/' + sku + '/' + id_loja,
                    type: 'get',
                    success: function(data){
                        let obj = JSON.parse(data);
                        obj = obj.retorno.produtos;
                        console.log(obj);

                        try {
                            if ($('#tbody').find('tr').length === 0) {

                                for (let i = 0; i < obj.length; i++) {
                                    let produto = obj[i].produto;

                                    let tr = $('<tr></tr>');
                                    let precos = '';
                                    let sku = $('<td></td>');
                                    sku.text(produto.codigo).appendTo(tr);
                                    let nomeProd = $('<td></td>');
                                    nomeProd.text(produto.descricao).appendTo(tr);
                                    let precoCusto = $('<td></td>');
                                    precos = parseFloat(produto.precoCusto);
                                    precoCusto.text(precos.toFixed(2)).appendTo(tr);
                                    let preco = $('<td></td>');
                                    precos = parseFloat(produto.preco);
                                    preco.text(precos.toFixed(2)).appendTo(tr);

                                    precosLojas(produto, tr);

                                    tr.addClass('tr' + i);
                                    tr.appendTo($('#tbody'));
                                }

                            }
                            else {
                                console.log('maior que zero');

                                for (let i = 0; i < obj.length; i++) {
                                    let produto = obj[i].produto;

                                    let tr = $('.tr' + i);

                                    precosLojas(produto, tr);

                                }

                            }
                        }
                        catch (e) {
                            swal('Erro', 'Ocorreu algum erro.', 'error');
                        }

                    }
                })
                    .done(function(){
                        $('#spanNumPag').text(page);
                        if(indice < arrayLojas.length - 1)
                            buscaLojasSku(++indice, sku);
                        else
                            $.unblockUI();
                    });
            }
            catch(e){
                swal('Erro', 'Houve um erro na consulta dos preços', 'error');
            }
        }

        //==============================================================================================================
        //BOTÃO QUE CHAMA A FUNCÇA BUSCALOJAS
        $('#btn_ajax_lojas').click(function(){
            $('#btn_sair_modal').click();

            criaTHead();
            $('#table_relatorio').removeAttr('hidden');
            $('.paragrafoPag').removeAttr('hidden');

            $('.loja_checkada').each(function(){
                if($(this).is(':checked')) {
                    arrayLojas.push($(this).attr("id"));
                }
            });

            page = 1;

            funcaoBuscar(page);

        });

        //==============================================================================================================
        //BOTÃO PARA BUSCAR OS PRODUTOS DA PÁGINA ANTERIOR
        $('#btnPagAnt').click(function(){
            funcaoBuscar(--page);
        });

        //==============================================================================================================
        //BOTÃO PARA BUSCAR OS PRODUTOS DA PRÓXIMA PÁGINA
        $('#btnProxPag').click(function(){
            funcaoBuscar(++page);
        });

        //==============================================================================================================
        //BOTÃO PARA BUSCAR OS PRODUTOS PELA PÁGINA DEFINIDA
        $('#btnEscolhaPag').click(function(){
            page = $('#inputEscolhaPag').val();
            funcaoBuscar(page);
        });

        $('#inputEscolhaPag').keypress(function(event){
            let keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                $('#btnEscolhaPag').click();
            }
        });

        //==============================================================================================================
        //BOTÃO PARA BUSCAR OS PRODUTOS PELO SKU
        $('#btnPesqSku').click(function(){
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

            $('#tbody').empty();
            let sku = $('#inputPesqSku').val();
            let indice = 0;
            buscaLojasSku(indice, sku);
        });

        $('#inputPesqSku').keypress(function(event){
            let keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                $('#btnPesqSku').click();
            }
        });

    </script>
@stop