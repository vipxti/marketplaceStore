@extends('layouts.admin.app')

@section('content')

<style>
    /* Estilo iOS */

    .switch {
        visibility: hidden;
        position: absolute;
        margin-left: -9999px;

    }

    .switch + label {
        display: block;
        position: relative;
        cursor: pointer;
        outline: none;
        user-select: none;
    }

    .switch--shadow + label {
        padding: 2px;
        width: 45px;
        height: 20px;
        background-color: #dddddd;
        border-radius: 60px;
    }
    .switch--shadow + label:before,
    .switch--shadow + label:after {
        display: block;
        position: absolute;
        top: 1px;
        left: 1px;
        bottom: 1px;
        content: "";
    }
    .switch--shadow + label:before {
        right: 1px;
        background-color: #f1f1f1;
        border-radius: 60px;
        transition: background 0.4s;
    }
    .switch--shadow + label:after {
        width: 18px;
        background-color: #fff;
        border-radius: 100%;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        transition: all 0.4s;
    }
    .switch--shadow:checked + label:before {
        background-color: #8ce196;
    }
    .switch--shadow:checked + label:after {
        transform: translateX(26px);
    }

    /* Estilo Flat */
    .switch--flat + label {
        padding: 2px;
        width: 120px;
        height: 60px;
        background-color: #dddddd;
        border-radius: 60px;
        transition: background 0.4s;
    }
    .switch--flat + label:before,
    .switch--flat + label:after {
        display: block;
        position: absolute;
        content: "";
    }
    .switch--flat + label:before {
        top: 2px;
        left: 2px;
        bottom: 2px;
        right: 2px;
        background-color: #fff;
        border-radius: 60px;
        transition: background 0.4s;
    }
    .switch--flat + label:after {
        top: 4px;
        left: 4px;
        bottom: 4px;
        width: 56px;
        background-color: #dddddd;
        border-radius: 52px;
        transition: margin 0.4s, background 0.4s;
    }
    .switch--flat:checked + label {
        background-color: #8ce196;
    }
    .switch--flat:checked + label:after {
        margin-left: 60px;
        background-color: #8ce196;
    }
</style>
<link rel="stylesheet" href="{{ asset('css/admin/btInterativo.css') }}">

<div class="content-wrapper">
    <section class="content-header">
        <h1><i class="fa fa-search"></i>&nbsp;&nbsp;Atualizar Produtos Bling</h1>
        <ol class="breadcrumb">
            <li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li><a href="javascript:void(0)">Integração</a></li>
            <li><a href="javascript:void(0)">Bling</a></li>
            <li><a href="javascript:void(0)">Atualizar Produtos</a></li>
            <li class="active">Atualizar Produtos</li>
        </ol>
    </section>

    <section class="content">

    @include('partials.admin._alerts')

    <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Atualizar Produtos</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Selecione uma loja:</label>
                            <div class="input-group">
                                <select id="selectLoja" class="form-control">
                                    <option></option>
                                    @foreach($lojas as $loja)
                                        <option value="{{$loja->id_loja}}">{{$loja->nome_loja}}</option>
                                    @endforeach
                                </select>
                                <span class="input-group-addon" title="Pesquisar Produtos">
                                <a id="btnBuscaProd" href="javascript:void(0)">
                                    <i class="fa fa-search"></i>
                                </a>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pull-left paragrafoPag" hidden>
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

                </div>
                <div class="row paragrafoPag" hidden>
                    <hr/>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group paragrafoPag" hidden>
                            <label>Selecione um canal:</label>
                            <div class="input-group">
                                <select id="selectCanal" class="form-control">
                                    <option value="-1"></option>
                                    @foreach($canais as $canal)
                                        <option value="{{$canal->id_canais}}">{{$canal->nome_canal}}</option>
                                    @endforeach
                                </select>
                                <span class="input-group-addon">
                                    <i class="fa fa-key"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 paragrafoPag" hidden>
                        <div class="form-group">
                            <label>Markup: (%)</label>
                            <div class="input-group">
                                <input id="input_markup" type="text" class="form-control">
                                <span class="input-group-addon" title="Aplicar Markup">
                                <a id="btn_markup" href="javascript:void(0)">
                                    <i class="fa fa-search"></i>
                                </a>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>

                <p>&nbsp;</p>
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

                <!-- Tabelas dos produtos -->

                <div id="divTable" class="table-responsive" hidden>
                    <table class="table table-striped" id="table">
                        <thead>
                        <tr id="indexProd">
                            <th>SKU</th>
                            <th>ID Loja</th>
                            <th>Nome Produto</th>
                            <th>Preço</th>
                            <th>Preço Custo</th>
                            <th>Preço Sugerido</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="resultProd">

                        </tbody>
                    </table>
                </div>
                <p>&nbsp;</p>
                <div class="row paragrafoPag" hidden>
                    <div class="col-md-12">
                        <button id="btn_atualiza_preco"
                                type="button"
                                class="btn btn-success pull-right">
                            <i class="fa fa-upload"></i>
                            &nbsp;&nbsp;Atualizar Preço
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{asset('js/admin/jquery.cookie.js')}}"></script>
<script src="{{asset('js/admin/jquery.blockUI.js')}}"></script>
<script src="{{asset('js/admin/sweetalert.min.js')}}"></script>

<script>
    $(function(){
        let page = 1;
        let arrayProdutos = [];
        //==============================================================================================================
        //BOTÃO PARA BUSCAR OS PRODUTOS
        $('#btnBuscaProd').click(function(){
            buscaProdutos(page);
        });

        //==============================================================================================================
        //BOTÃO PARA BUSCAR OS PRODUTOS DA PÁGINA ANTERIOR
        $('#btnPagAnt').click(function(){
            buscaProdutos(--page);
        });

        //==============================================================================================================
        //BOTÃO PARA BUSCAR OS PRODUTOS DA PRÓXIMA PÁGINA
        $('#btnProxPag').click(function(){
            buscaProdutos(++page);
        });

        //==============================================================================================================
        //FUNÇÃO PARA BUSCAR TODOS PRODUTOS
        function buscaProdutos(pag){
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

            let id_loja = $('#selectLoja').val();
            let pagina = "page=" + pag;
            let temDisabled = "";
            let contadorTR = 0;
            $.ajax({
                url: '{{url('/admin/product/bling/search/prods/')}}/' + pagina + '/' + id_loja,
                type: 'get',
                success: function(data){
                    $('#resultProd').find('tr').remove();
                    $('#spanNumPag').text(page);

                    let obj = JSON.parse(data);
                    obj = obj.retorno.produtos;
                    console.log(obj);

                    try {
                        for (let i = 0; i < obj.length; i++) {
                            let produto = obj[i].produto;
                            temDisabled = "";
                            contadorTR++;

                            try {
                                let qtd = produto.produtoLoja.length;
                                let produtoLoja = produto.produtoLoja;
                                console.log(produto);
                                console.log(produtoLoja);

                                arrayProdutos.push(produto.codigo);
                                arrayProdutos.push(produtoLoja.idProdutoLoja);
                                arrayProdutos.push(produto.descricao);
                                arrayProdutos.push(produtoLoja.preco.preco);
                                arrayProdutos.push(produto.precoCusto);

                                let tr = $('<tr></tr>');
                                for (let j = 0; j < arrayProdutos.length; j++) {
                                    let td = $('<td></td>');
                                    td.text(arrayProdutos[j]);
                                    tr.append(td);
                                }
                                //td do preço sugerido
                                let td = $('<td></td>');
                                td.text(0.00);

                                //td para switch de escolha
                                if(produto.precoCusto == 0 || produtoLoja.idProdutoLoja == null) {
                                    temDisabled = "disabled";
                                    tr.css('color', '#cc0000');
                                }

                                var tBody = "<td><div class='switch__container pull-left'>" +
                                    "<input " + temDisabled + " id='switch" + contadorTR + "' class='switch switch--shadow' value='0' type='checkbox'>" +
                                    "<label for='switch" + contadorTR + "'></label></div></td>";

                                tr.append(td, tBody);
                                $('#resultProd').append(tr);


                                arrayProdutos = [];

                            }
                            catch (e) {
                            }
                        }
                    }
                    catch (e) {
                        swal('Erro', 'Ocorreu um erro ao buscar os produtos.', 'error');
                    }

                },
                error: function(data){
                    //let obj = JSON.parse(data);
                    //console.log(obj);
                    $.unblockUI();
                    swal('Erro', 'Ocorreu um erro ao buscar os produtos.', 'error');
                }
            })
                .done(function(){
                    $.unblockUI();
                    ativaSwitch();
                    $('#divTable').removeAttr('hidden');
                    $('.paragrafoPag').removeAttr('hidden');
                });
        }

        //==============================================================================================================
        //BOTÃO PARA BUSCAR OS PRODUTOS PELA PÁGINA DEFINIDA
        $('#btnEscolhaPag').click(function(){
            page = $('#inputEscolhaPag').val();
            buscaProdutos(page);
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
            let sku = $('#inputPesqSku').val();
            let id_loja = $('#selectLoja').val();
            buscarProdutosNome(sku, id_loja);
        });

        $('#inputPesqSku').keypress(function(event){
            let keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                $('#btnPesqSku').click();
            }
        });

        //==============================================================================================================
        //FUNÇÃO PARA BUSCAR PRODUTOS POR SKU
        function buscarProdutosNome(codigo, id_loja){
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
            let temDisabled = "";
            let contadorTR = 0;

            $.ajax({
                url: '{{url('/admin/product/bling/search/prods/name/')}}/' + codigo + '/' + id_loja,
                type: 'get',
                success: function(data){
                    $('#resultProd').find('tr').remove();
                    $('#spanNumPag').text(page);

                    let obj = JSON.parse(data);
                    obj = obj.retorno.produtos;
                    console.log(obj);

                    try {
                        for (let i = 0; i < obj.length; i++) {
                            let produto = obj[i].produto;
                            temDisabled = "";
                            contadorTR++;

                            try {
                                let qtd = produto.produtoLoja.length;
                                let produtoLoja = produto.produtoLoja;
                                //console.log(produto);
                                //console.log(produtoLoja);

                                arrayProdutos.push(produto.codigo);
                                arrayProdutos.push(produtoLoja.idProdutoLoja);
                                arrayProdutos.push(produto.descricao);
                                arrayProdutos.push(produtoLoja.preco.preco);
                                arrayProdutos.push(produto.precoCusto);

                                let tr = $('<tr></tr>');
                                for (let j = 0; j < arrayProdutos.length; j++) {
                                    let td = $('<td></td>');
                                    td.text(arrayProdutos[j]);
                                    tr.append(td);
                                }


                                //td do preço sugerido
                                let td = $('<td></td>');
                                td.text(0.00);

                                //td para switch de escolha
                                if(produto.precoCusto == 0 || produtoLoja.idProdutoLoja == null) {
                                    temDisabled = "disabled";
                                    tr.css('color', '#cc0000');
                                }

                                let tBody = "<td><div class='switch__container pull-left'>" +
                                    "<input " + temDisabled + " id='switch" + contadorTR + "' class='switch switch--shadow' value='0' type='checkbox'>" +
                                    "<label for='switch" + contadorTR + "'></label></div></td>";


                                tr.append(td, tBody);
                                $('#resultProd').append(tr);

                                arrayProdutos = [];

                            }
                            catch (e) {
                            }
                        }
                    }
                    catch (e) {
                        swal('Erro', 'Ocorreu um erro ao buscar os produtos.', 'error');
                    }
                },
                error: function(data){
                    let obj = JSON.parse(data);
                    console.log(obj);
                    swal('Erro', 'Ocorreu um erro ao buscar o produto.', 'error');
                }
            })
                .done(function(){
                    $.unblockUI();
                    ativaSwitch()
                    $('#divTable').removeAttr('hidden');
                    $('.paragrafoPag').removeAttr('hidden');
                });
        }

        //==============================================================================================================
        //FUNÇÃO PARA BUSCAR PRODUTOS POR SKU
        let comissao, taxa, imposto, pac, taxa_cartao, despesa_fixa,marketing;
        $('#selectCanal').change(function(){
            let id_canal = $(this).val();

            $.ajax({
                url: '{{url('/admin/order/bling/channels/')}}'+ '/' + id_canal,
                type:'get',
                success: function(data){
                    console.log(data);

                    comissao = data.comissao;
                    taxa = data.taxa;
                    imposto = data.imposto;
                    pac = data.pac;
                    taxa_cartao = data.taxa_cartao;
                    despesa_fixa = data.despesa_fixa;
                    marketing = data.marketing;

                }
            });
        });

        //==============================================================================================================
        //FUNÇÃO PARA ATIVAR AS FUNÇÕES DO SWITCH
        function ativaSwitch(){
            $('.switch').click(function(){
                let id = $(this).attr('id');
                console.log(id);

                if($(this).prop('checked')){
                    console.log("checkado");
                    $(this).val(1);
                }
                else{
                    console.log("não checkado");
                    $(this).val(0);
                }
            });
        }

        //==============================================================================================================
        //BOTÃO PARA FAZER O CALCULO DO PREÇO SUGERIDO
        $('#btn_markup').click(function(){
            if($('#selectCanal').val() == -1 || $('#input_markup').val() == ""){
                swal('Ops', 'Um dos campos necessários não foi preenchido.', 'info');
            }
            else{
                console.log("canal valido");
                let tamanhoTable = $('#table tr').length;
                let markup = $('#input_markup').val();
                markup = markup / 100;
                let resultado;

                for(let i=0; i<tamanhoTable; i++){
                    $('#table tr:eq('+i+')').find('td:eq(5)').text(0).css('color', '#333');
                    $('#table tr:eq('+i+')').find('td:eq(5)').text(0).css('font-weight', 'normal');
                    if($('#table tr:eq('+i+')').find('td:last').find('.switch').prop('checked')){
                        let preco = $('#table tr:eq('+i+')').find('td:eq(3)').text();
                        let preco_custo = parseFloat($('#table tr:eq('+i+')').find('td:eq(4)').text());
                        let comissaoCalc = comissao, impostoCalc = imposto, despesa_fixaCalc = despesa_fixa;
                        let taxa_cartaoCalc = taxa_cartao, marketingCalc = marketing;

                        resultado = (preco_custo * markup) + preco_custo;
                        comissaoCalc = (comissao / 100) * resultado;
                        impostoCalc = (imposto / 100) * resultado;
                        despesa_fixaCalc = (despesa_fixa / 100) * resultado;
                        taxa_cartaoCalc = (taxa_cartao / 100) * resultado;
                        marketingCalc = (marketing / 100) * resultado;

                        let lucroPrejuizo = (comissaoCalc + taxa + impostoCalc + preco_custo + pac + despesa_fixaCalc + taxa_cartaoCalc + marketingCalc);
                        lucroPrejuizo = resultado - lucroPrejuizo;

                        let textoLucroPrejuizo;
                        if(lucroPrejuizo > 0) {
                            textoLucroPrejuizo = "Lucro: ";
                            $('#table tr:eq('+i+')').find('td:eq(5)').css('color', '#0095ff');
                        }
                        else {
                            textoLucroPrejuizo = "Prejuizo: ";
                            $('#table tr:eq('+i+')').find('td:eq(5)').css('color', '#cc0000');
                        }

                        console.log("Resultado: " + resultado.toFixed(2));
                        let texto = resultado.toFixed(2) + " " + textoLucroPrejuizo + lucroPrejuizo.toFixed(2);
                        $('#table tr:eq('+i+')').find('td:eq(5)').text(texto).css('font-weight', 'bold');
                    }
                }
            }
        });

        //==============================================================================================================
        //BOTÃO PARA ATUALIZAR OS PREÇOS NO BLING DOS PRODUTOS SELECIONADO
        $('#btn_atualiza_preco').click(function(){
            ajaxAtualizaPreco(1);
        });

        //==============================================================================================================
        //FUNÇÃO PARA ATUALIZAR OS PREÇOS NO BLING DOS PRODUTOS SELECIONADO
        function ajaxAtualizaPreco(tableRow){
            let tamanhoTable = $('#table tr').length;
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            let loja = $('#selectLoja').val();
            let sku = $('#table tr:eq('+ tableRow +')>td:first').text();
            let id_loja = $('#table tr:eq('+ tableRow + ')>td:eq(1)').text();
            //console.log(sku);

            if(tableRow <= tamanhoTable){
                if($('#table tr:eq('+tableRow+')').find('td:last').find('.switch').prop('checked')){
                    console.log($('#table tr:eq('+tableRow+')'));
                    let valor_atualizar = $('#table tr:eq('+tableRow+')').find('td:eq(5)').text();
                    valor_atualizar = valor_atualizar.split(' ');

                    if(valor_atualizar[0] != 0) {
                        console.log(valor_atualizar[0]);
                        $('#table tr:eq('+tableRow+')').css('color', '#00a65a');
                        $('#table tr:eq('+tableRow+')').find('td:last').find('.switch').click();

                        $.ajax({
                            url: '{{route('alter.price.prods.bling')}}',
                            type: 'post',
                            data: {_token: CSRF_TOKEN, loja: loja, sku: sku, preco: valor_atualizar[0], id_loja: id_loja},
                            success: function(data){
                                console.log(data);
                            },
                            error: function(data){
                                console.log(data);

                            }
                        });
                    }
                }

                ajaxAtualizaPreco(++tableRow);
            }
            else{
                console.log('acabou');
            }
        }
    });
</script>
@stop