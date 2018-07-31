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
            <h1><i class="fa fa-list-alt"></i>&nbsp;&nbsp;Lista de Produtos</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Produtos</a></li>
                <li class="active">Lista de Produtos</li>
            </ol>
        </section>

        <section class="content">

        @include('partials.admin._alerts')

        <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div id="botoesBling">
                        <button id="btnBuscaProd" type="button" class="btn btn-primary" disabled>Buscar Produtos</button>
                        <button id="btnCategoria" type="button" class="btn btn-info">Buscar Categorias</button>

                    </div>
                    <!-- Botão pesquisar -->
                    <div style="padding-left: 70%">
                        <div>
                            <input type="search" id="search" value="" class="form-control">
                        </div>
                    </div>
                    <div>&nbsp;</div>

                    <div class="dataTables_length" style="padding-left: 90%" id="example1_length">
                        <select name="example1_length" aria-controls="example1" class="form-control form-control-sm">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>

                    <label id="texto_informativo" hidden style="font-size: 12px"><i style="color: red !important;">*</i>&nbsp;OS PRODUTOS QUE POSSUEM A SITUAÇÃO DESABILITADA É PORQUE UM DOS CAMPOS NECESSÁRIOS PARA SALVAR O PRODUTO NÃO FOI PREENCHIDO CORRETAMENTE NO BLING</label>


                    <!-- Tabelas dos produtos -->

                    <table class="table" id="table">
                        <thead>
                            <tr id="indexProd">

                            </tr>
                        </thead>
                        <tbody id="resultProd">

                        </tbody>
                    </table>

                    <table id="tabelaEscondida" hidden class="table">
                        <thead class="table-bordered">
                        <tr id="indexProdHidden">

                        </tr>
                        </thead>
                        <tbody id="resultProdHidden" class="table-bordered">

                        </tbody>
                    </table>

                    <!-- Moda Variações -->
                </div>
            </div>
        </section>
    </div>

    <script src="{{asset('js/admin/jquery.cookie.js')}}"></script>
    <script src="{{asset('js/admin/jquery.blockUI.js')}}"></script>
    <script src="{{asset('js/admin/sweetalert.min.js')}}"></script>
    {{--<script src="{{asset('js/admin/integracaoBling.js')}}"></script>--}}
    <script>

        $(document).ready(function(){
            var arrayCat = [];
            var arrayCatLoja = [];

            //=====================================================================================================
            //BOTÃO PARA BUSCAR TODAS AS CATEGORIAS CADASTRADAS NO BLING

            var objCategoria = null;
            var objCatLoja = null;
            var existeDadosEmpresa = false;
            $('#btnCategoria').click(function(){
                try{

                    $.ajax({
                        url: '{{route('verify.company.data')}}',
                        type: 'GET',
                        success: function(data){
                            existeDadosEmpresa = data.message;
                        }
                    }).done(function(){
                        if(existeDadosEmpresa){
                            $(this).attr('disabled', 'disabled');

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

                            $.ajax({
                                url: '{{route('category.api.bling')}}',
                                type: 'get',
                                //url: 'blingCategoria.php',
                                //type: 'post',
                                success: function(data){
                                    objCategoria = JSON.parse(data);
                                    console.log(objCategoria);
                                }
                            })
                                .done(function(){

                                    try{
                                        for(var i = 0; i<objCategoria.retorno.categorias.length; i++){
                                            arrayCat.push(objCategoria.retorno.categorias[i]);
                                        }

                                        $('#btnArrayCat').removeAttr('disabled');
                                        ajaxCategoriaLoja();
                                    }
                                    catch(Exception){
                                        $.unblockUI();
                                        swal("Ops", "A Api Key é inválida.", "warning");
                                    }
                                });
                        }
                        //END IF
                        else{
                            swal("Ops", "Cadastre os dados da empresa antes de buscar produtos no Bling.", "warning");
                        }

                    });


                }
                catch(Exception){
                    swal("Erro", "Ocorreu um erro no processo de busca das categorias, tente novamente mais tarde.", "warning");
                }

            });

            //=====================================================================================================
            //FUNÇÃO PARA BUSCAR AS CATEGORIAS DA LOJA

            function ajaxCategoriaLoja(){
                $.ajax({
                    url: '{{route('storeCategory.api.bling')}}',
                    type: 'get',
                    success: function(data){
                        objCatLoja = JSON.parse(data);
                    }
                })
                    .done(function(){

                        for(var i = 0; i < objCatLoja.retorno.categoriasLoja.length; i++){
                            arrayCatLoja.push(objCatLoja.retorno.categoriasLoja[i]);
                        }

                        //$('#btnCategoria').removeAttr('disabled');
                        $('#btnBuscaProd').removeAttr('disabled');
                        $.unblockUI();
                    });
            }

            //=====================================================================================================
            //BOTÃO BUSCAR PRODUTOS
            var proxPag = 1;
            $('#btnBuscaProd').on("click", function(){
                swal({
                    title: "Você tem certeza?",
                    text: "Este pode ser um processo demorado e durar alguns minutos.",
                    icon: "info",
                    buttons: true,
                })
                    .then((vaiBuscar) => {
                        if (vaiBuscar) {
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

                            try{
                                $(this).attr('disabled', 'disabled');
                                buscaProdutos(proxPag);
                            }
                            catch(Exception){
                                $.unblockUI();
                                swal("Erro", "Ocorreu um erro no processo de busca dos produtos, tente novamente mais tarde.", "warning");
                            }

                        }
                    });
            });

            //=====================================================================================================
            //FUNÇÃO PARA BUSCAR OS PRODUTOS

            var deuErro = false;
            var entrouEach = false;
            var contador = 0;
            var contadorSituacao = 0;
            var arrayNames = ['cd_sku',
                'nm_produto',
                'vl_produto',
                'ds_produto',
                'ds_peso',
                'cd_ean',
                'ds_largura',
                'ds_altura',
                'ds_profundidade',
                'cd_categoria',
                'nm_categoria',
                'cd_sub_categoria',
                'nm_sub_categoria',
                'qt_produto',
                'ic_ativo'];
            var arrayImagens = [];
            var imagens = [];
            var arrayDesc = [];
            var descricao = [];

            function buscaProdutos(pag){
                if(!deuErro){
                    var page = 'page=' + pag;

                    console.log("****************PAGINA " + proxPag + "****************");

                    $.ajax({
                        url: '{{url('/admin/api/bling')}}/' + page,
                        type: 'get',
                        success: function(data){
                            try{
                                var objProd = JSON.parse(data);
                                //console.log(objProd);


                                for(var i = 0; i < objProd.retorno.produtos.length; i++){
                                    contador++;
                                    var arrayHead = [];
                                    var arrayBody = [];
                                    imagens = [];
                                    descricao = [];
                                    var temCategoria = false;
                                    var trBody = "<tr id='trProd" + contador + "'></tr>";
                                    var trBodyHidden = "<tr id='trProdHidden" + contador + "'></tr>";
                                    $('#resultProd').append(trBody);
                                    $('#resultProdHidden').append(trBodyHidden);

                                    console.log("PAGINA " + proxPag + " - PRODUTO " + i);
                                    $.each(objProd.retorno.produtos[i].produto, function(index, resultado){

                                        if(index == "codigo" && resultado == ""){
                                            return false;
                                        }

                                        if(index == "codigo" || index == "descricao" || index == "situacao" ||
                                            index == "preco" || index == "descricaoCurta" || index == "pesoBruto" ||
                                            index == "gtin" || index == "larguraProduto" || index == "alturaProduto" ||
                                            index == "profundidadeProduto" || index == "imagem" || index == "estoqueAtual" ||
                                            index == "produtoLoja"){

                                            if(index == "produtoLoja"){
                                                var categoriaProd = objProd.retorno.produtos[i].produto.produtoLoja.categoria;
                                                var categoriaBling = null;
                                                var pai = 0;
                                                var paiDesc = null;
                                                $.each(categoriaProd[categoriaProd.length - 1], function(categoria, respCat){

                                                    if(categoria == "id"){
                                                        categoriaBling = verificaCategoria(respCat);
                                                    } else if (categoria == "idCategoriaPai" && respCat != "0"){
                                                        pai = verificaCategoria(respCat);
                                                        //console.log("*" + pai.descricaoVinculo);
                                                        paiDesc = pai.descricaoVinculo;
                                                        pai = pai.idVinculoLoja;
                                                    }

                                                    if(categoria == "descricao"){
                                                        arrayHead.push(categoria + "Cat");
                                                    }else{
                                                        arrayHead.push(categoria);
                                                    }

                                                    //arrayBody.push(respCat);
                                                    temCategoria = true;
                                                });
                                                arrayHead.push("descCatPai");
                                                arrayBody.push(categoriaBling.idVinculoLoja);
                                                arrayBody.push(categoriaBling.descricaoVinculo);
                                                arrayBody.push(pai);
                                                arrayBody.push(paiDesc);
                                            }
                                            else if(index == "imagem"){
                                                arrayHead.push(index);
                                                if(resultado == ""){
                                                    arrayBody.push("");
                                                }else{

                                                    var linkFinal = null;

                                                    for(var j = 0; j < index.length; j++){
                                                        $.each(objProd.retorno.produtos[i].produto.imagem[j], function(img, link){
                                                            if(img == "link"){
                                                                linkFinal = link;
                                                                imagens.push(link);

                                                            }
                                                        });
                                                    }

                                                    arrayBody.push(linkFinal);
                                                }
                                            }
                                            else if(index == "descricaoCurta"){
                                                arrayHead.push(index);
                                                arrayBody.push(resultado);
                                                //console.log("INDEX RESULTADO: " + resultado);
                                                descricao.push(resultado);
                                            }
                                            else if(index == "pesoBruto"){
                                                arrayHead.push(index);
                                                var pesoEmGramas = resultado * 1000;
                                                arrayBody.push(pesoEmGramas);
                                            }
                                            else{
                                                arrayHead.push(index);
                                                arrayBody.push(resultado);
                                            }

                                        }

                                    });

                                    //console.log(arrayHead.length);
                                    /* for(var j = 0; j < arrayHead.length; j++){

                                        console.log(arrayHead[j] + " : " + arrayBody[j]);

                                    } */

                                    console.log("============================================");

                                    if(temCategoria){

                                        if(!entrouEach){

                                            for(var iH = 0; iH<arrayHead.length; iH++){
                                                if(arrayHead[iH]!="situacao"){
                                                    var campoHead = "<td>" + arrayHead[iH] + "</td>";
                                                    $('#indexProdHidden').append(campoHead);
                                                }

                                                if(arrayHead[iH]=="codigo" || arrayHead[iH]=="descricao" ||
                                                    arrayHead[iH]=="tipo" || arrayHead[iH]=="preco" || arrayHead[iH]=="gtin" ||
                                                    arrayHead[iH]=="descricaoCat" || arrayHead[iH]=="descCatPai" ||
                                                    arrayHead[iH]=="estoqueAtual"){
                                                    var campoHead = "<td>" + arrayHead[iH] + "</td>";
                                                    $('#indexProd').append(campoHead);
                                                }
                                            }

                                            var campoHead = "<td>situacao</td>";
                                            $('#indexProd').append(campoHead);
                                            $('#indexProdHidden').append(campoHead);
                                            entrouEach = true;
                                        }

                                        var valor = 0;
                                        var checkado = "";
                                        var semCatPai = false;
                                        var temDisabled = "";
                                        for(var iB = 0; iB<arrayBody.length; iB++){
                                            if(arrayHead[iB]!="situacao"){
                                                if(arrayHead[iB]=="imagem"){
                                                    console.log(arrayBody[1] + " : " + arrayBody[iB]);

                                                    var urls = "";

                                                    for(var img = 0; img < imagens.length; img++){
                                                        urls= urls + " " + imagens[img];
                                                    }
                                                    arrayImagens.push(urls);
                                                    var tBody = "<td>" + urls + "</td>";
                                                    $('#trProdHidden' + contador).append(tBody);

                                                }
                                                else if(arrayHead[iB] == "descricaoCurta"){

                                                    if(descricao[0] != null){
                                                        var novaDesc = descricao[0].replace(/<p>/gi, "");
                                                        novaDesc = novaDesc.replace(/<\/p>/gi, "\n");
                                                        arrayDesc.push(novaDesc);
                                                        console.log("DESCRIÇÃO: " + novaDesc);
                                                        //arrayDesc.push(descricao[0]);
                                                    }
                                                    else{
                                                        arrayDesc.push(descricao[0]);
                                                    }

                                                    var tBody = "<td>" + arrayBody[iB] + "</td>";
                                                    $('#trProdHidden' + contador).append(tBody);
                                                }
                                                else{
                                                    var tBody = "<td>" + arrayBody[iB] + "</td>";
                                                    $('#trProdHidden' + contador).append(tBody);
                                                }
                                                /*var tBody = "<td>" + arrayBody[iB] + "</td>";
                                                $('#trProdHidden' + contador).append(tBody);
                                                if(arrayHead[iB] == "imagem"){
                                                    arrayImagens.push(arrayBody[iB]);
                                                }*/
                                            }

                                            if((arrayHead[iB] == "idCategoriaPai" && arrayBody[iB] == "0") ||
                                                (arrayHead[iB] == "larguraProduto" && arrayBody[iB] == "null") ||
                                                (arrayHead[iB] == "alturaProduto" && arrayBody[iB] == "null") ||
                                                (arrayHead[iB] == "profundidadeProduto" && arrayBody[iB] == "null") ||
                                                (arrayHead[iB] == "pesoBruto" && arrayBody[iB] == "0.000"))
                                            {
                                                semCatPai = true;
                                                temDisabled = "disabled";
                                            }

                                            if(arrayHead[iB]=="codigo" || arrayHead[iB]=="descricao" ||
                                                arrayHead[iB]=="tipo" || arrayHead[iB]=="preco" || arrayHead[iB]=="gtin" ||
                                                arrayHead[iB]=="descricaoCat" || arrayHead[iB]=="descCatPai" ||
                                                arrayHead[iB]=="estoqueAtual" || arrayHead[iB]=="situacao" ){
                                                if(arrayHead[iB]=="situacao"){

                                                    if(arrayBody[iB] == "Ativo"){
                                                        valor = 1;
                                                        checkado = "checked";
                                                    }

                                                }
                                                else{
                                                    var tBody = "<td>" + arrayBody[iB] + "</td>";
                                                    $('#trProd' + contador).append(tBody);
                                                }

                                            }
                                        }

                                        if(semCatPai){
                                            checkado = "";
                                            valor = 0;
                                        }else{
                                            $('#trProd'+contador).addClass('checkado');
                                            $('#trProdHidden'+contador).addClass('checkado');
                                        }

                                        var tBody = "<td><div class='switch__container pull-left'><input " + temDisabled + "id='switch" + contadorSituacao + "' class='switch switch--shadow' value='" + valor + "' type='checkbox'" + checkado + " ><label for='switch" + contadorSituacao + "'></label></div></td>";
                                        $('#trProd' + contador).append(tBody);
                                        var tBodyHidden = "<td><div class='switch__container pull-left'><input " + temDisabled + "id='switch" + contadorSituacao + "hidden' class='switch switch--shadow' value='" + valor + "' type='checkbox'" + checkado + " ><label for='switch" + contadorSituacao + "'></label></div></td>";
                                        $('#trProdHidden' + contador).append(tBodyHidden);
                                        contadorSituacao++;
                                    }
                                    else{
                                        $('#trProd'+contador).remove();
                                        $('#trProdHidden'+contador).remove();
                                    }
                                }
                            }catch(err){
                                console.log(err);
                                deuErro = true;
                            }
                        },
                        error: function(){
                            $.unblockUI();
                            swal("Erro", "Ocorreu um erro no processo de busca dos produtos, tente novamente mais tarde.", "warning");
                        }
                    })
                        .done(function(){
                            //if(proxPag >=7){
                            if(deuErro){
                                $('#btnBusca').removeAttr('disabled');
                                //cor branco
                                $("table tbody tr:odd").css("background-color", "#fff");
                                //cor cinza
                                $("table tbody tr:even").css("background-color", "#f5f5f5");
                                ativaCheckBox();
                                criarBotaoSalvarProd();
                                buscaInterativa();
                                $.unblockUI();
                            }
                            else{
                                proxPag++;
                                buscaProdutos(proxPag);
                            }
                        });
                }
            }

            //=====================================================================================================
            //FUNÇÃO COMPARAR CATEGORIAS

            function verificaCategoria(idCat){
                var retorno = null;
                for(var i=0; i<arrayCatLoja.length; i++){
                    if(idCat == arrayCatLoja[i].categoria.idCategoria){
                        retorno = arrayCatLoja[i].categoria;
                    }
                }

                return retorno;
            }

            //=====================================================================================================
            //FUNÇÃO PARA ATIVAR O CHECKBOX

            function ativaCheckBox(){
                //console.log("ativaCheck");
                //console.log(contadorSituacao);

                $('.switch').click(function(e){
                    var id=e.target.id;
                    if($(this).parent().find('input#' + id).prop("checked")){
                        console.log("checked");
                        $(this).val("1");
                        $('input#' + id + "hidden").val("1");
                        $(this).parent().find('input#' + id).attr("checked", "checked");
                        $('input#' + id + "hidden").attr("checked", "checked");
                        console.log($(this).parent().parent().parent());
                        $(this).parent().parent().parent().addClass('checkado');
                        $('input#' + id + "hidden").parent().parent().parent().addClass("checkado");
                    }
                    else{
                        $(this).val("0");
                        $('input#' + id + "hidden").val("0");
                        console.log("unchecked");
                        $(this).parent().find('input#' + id).removeAttr("checked");
                        $('input#' + id + "hidden").removeAttr("checked");
                        $(this).parent().parent().parent().removeClass('checkado');
                        $('input#' + id + "hidden").parent().parent().parent().removeClass("checkado");
                    }
                });

            }

            //=====================================================================================================
            //FUNÇÃO PARA BUSCA DOS DADOS INTERATIVA NA TABELA

            function buscaInterativa(){
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
                });
            }

            //=====================================================================================================
            //FUNÇÃO PARA ADICIONAR O BOTÃO DE SALVAR

            function criarBotaoSalvarProd(){
            //<button id="btnCategoria" type="button" class="btn btn-info">Buscar Categorias</button>
                var botaoSalvar = "<button id='btnSalvarProds' type='button' class='btn btn-info'>Salvar Produtos</button>";
                $('#botoesBling').append(botaoSalvar);
                AtivarBotaoSalvar();
                $('#texto_informativo').removeAttr('hidden');
            }

            //=====================================================================================================
            //FUNÇÃO PARA ADICIONAR OS EVENTOS BOTÃO DE SALVAR

            var arrayProduto = [];
            function AtivarBotaoSalvar(){
                $('#btnSalvarProds').click(function(){
                    console.log("oi");

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

                    try{
                        colunaProdutos();
                    }
                    catch(Exception){
                        $.unblockUI();
                        swal("Erro", "Ocorreu um erro no processo de salvamento, tente novamente mais tarde.", "warning");
                    }
                });
            }

            //=====================================================================================================
            //FUNÇÃO QUE PASSA ATRAVEZ DAS COLUNAS DA TABELA PARA SALVAR OS PRODUTOS

            var posProd = -1;
            function colunaProdutos(){
                posProd++;
                for(var i = posProd; i < $('#resultProdHidden').children().length; i++){
                    arrayProduto = [];
                    posProd = i;
                    if($('#resultProdHidden').find('tr:eq(' + i + ')').hasClass('checkado')){
                        console.log('=============================================');
                        for(var j = 0; j<arrayNames.length; j++){
                            if( j == 9 ){
                                arrayProduto.push(arrayImagens[i]);
                                console.log(arrayImagens[i]);
                            }
                            else if( j == 3){
                                arrayProduto.push(arrayDesc[i]);
                                console.log("Array Desc: " + arrayDesc[i]);
                            }
                            else{
                                arrayProduto.push($('#resultProdHidden').find('tr:eq(' + i + ')').find('td:eq(' + j + ')').html());
                                console.log($('#resultProdHidden').find('tr:eq(' + i + ')').find('td:eq(' + j + ')').html());
                            }

                        }

                        consultaSku(arrayProduto);
                        return false;
                    }
                }

                $.unblockUI();
            }

            //=====================================================================================================
            //FUNÇÃO PARA CONSULTAR O SKU DOS PRODUTOS

            function consultaSku(array){
                var existeSku = false;
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{route('bling.sku.products')}}',
                    type: 'post',
                    data: {_token: CSRF_TOKEN, cd_sku: array[0]},
                    dataType: 'JSON',
                    success: function(data){
                        existeSku = data.message;
                    },
                    error: function(){
                        $.unblockUI();
                        swal("Erro", "Ocorreu um erro no processo de salvamento, tente novamente mais tarde.", "warning");
                    }
                }).done(function(){
                    if(!existeSku){
                        console.log("nao existe sku");
                        salvarCategoria(array);
                    }
                    else{
                        console.log("já existe sku");
                        colunaProdutos();
                    }
                        //salvarCategoria(array);

                })
            }

            //=====================================================================================================
            //FUNÇÃO PARA SALVAR AS CATEGORIAS

            function salvarCategoria(array){
                console.log('/*/*/*/*/*/*/*/*');
                console.log(array[12]);
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var cd_categoria = null;


                $.ajax({
                    url: '{{route('category.bling.save')}}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, nm_categoria: array[13]},
                    dataType: 'JSON',
                    success: function(data){
                        console.log(data[0][0].cd_categoria);
                        cd_categoria = data[0][0].cd_categoria;
                    },
                    error: function(){
                        $.unblockUI();
                        swal("Erro", "Ocorreu um erro no processo de salvamento, tente novamente mais tarde.", "warning");
                    }
                }).done(function () {
                    salvarSubCat(CSRF_TOKEN, array[11], cd_categoria, array);
                });

                console.log('/*/*/*/*/*/*/*/*');
            }


            //=====================================================================================================
            //FUNÇÃO PARA SALVAR AS CATEGORIAS DA LOJA

            function salvarSubCat(CSRF_TOKEN, nm_sub_cat, cd_categoria, array){
                var cd_sub_categoria = null;
                $.ajax({
                    url: '{{route('subcategory.bling.save')}}',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN, nm_sub_categoria: nm_sub_cat},
                    dataType: 'JSON',
                    success: function (data) {
                        console.log(data[0][0].cd_sub_categoria);
                        cd_sub_categoria = data[0][0].cd_sub_categoria;
                    },
                    error: function(){
                        $.unblockUI();
                        swal("Erro", "Ocorreu um erro no processo de salvamento, tente novamente mais tarde.", "warning");
                    }
                }).done(function(){
                    salvarAssoc(CSRF_TOKEN, cd_categoria, cd_sub_categoria, array);
                });
            }

            //=====================================================================================================
            //FUNÇÃO PARA SALVAR AS ASSOCIAÇÕES DE CATEGORIAS

            function salvarAssoc(CSRF_TOKEN, cd_categoria, cd_sub_categoria, array){
                $.ajax({
                    url: '{{route('assoc.bling.save')}}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {_token: CSRF_TOKEN, cd_categoria: cd_categoria, cd_sub_categoria: cd_sub_categoria},
                    success: function(data){
                        console.log(data.message);
                    },
                    error: function(){
                        $.unblockUI();
                        swal("Erro", "Ocorreu um erro no processo de salvamento, tente novamente mais tarde.", "warning");
                    }
                }).done(function(){
                    var qt_prod = array[14];

                    if(qt_prod < 0 )
                        qt_prod = 0;

                    salvarProd(CSRF_TOKEN, cd_categoria, cd_sub_categoria, array, qt_prod);
                });
            }

            //=====================================================================================================
            //FUNÇÃO PARA SALVAR OS PRODUTOS

            function salvarProd(CSRF_TOKEN, cd_categoria, cd_sub_categoria, array, qt_prod){
                console.log(array.length);

                for(var i=0; i<array.length; i++){
                    console.log(array[i]);
                }

                var regInicio = new RegExp("^\\s+");
                var urls = "";
                console.log(array[9] + " : " + array[9].length);
                if(array[9].length > 0){
                    urls = array[9].replace(regInicio, '');
                    urls = urls.split(' ');
                }


                if(array[3] != null){
                    if(array[3].length > 1500){
                        array[3] = array[3].substr(0, 1500);
                    }
                }
                else{
                    array[3] = array[1];
                }


                $.ajax({
                    url: '{{route('bling.save.products')}}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {_token: CSRF_TOKEN, cd_sku: array[0], nm_produto: array[1],
                            vl_produto: array[2], ds_produto: array[3], ds_peso: array[4],
                            cd_ean: array[5], ds_largura: array[6], ds_altura: array[7], ds_comprimento: array[8],
                            cd_categoria: cd_categoria, cd_sub_categoria: cd_sub_categoria,
                            qt_produto: qt_prod, status: 'on', images: urls},
                    success: function(data){

                    },
                    error: function(){
                        $.unblockUI();
                        swal("Erro", "Ocorreu um erro no processo de salvamento, tente novamente mais tarde.", "warning");
                    }
                }).done(function(){
                    colunaProdutos();
                });
            }

        });

    </script>

    <script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>

@stop

