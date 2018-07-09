@extends('layouts.admin.app')

@section('content')

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
                    <div>
                        <button id="btnBuscaProd" type="button" class="btn btn-primary">Buscar Produtos</button>
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

                    <!-- Tabelas dos produtos -->

                    <table class="table" id="table">
                        <thead>
                            <tr id="indexProd">
                                {{--<th style="text-align: left">SKU</th>
                                <th style="text-align: left">Gtin</th>
                                <th style="text-align: left">Gtin Embalagem</th>
                                <th style="text-align: left">Nome</th>
                                <th style="text-align: left">Tipo</th>
                                <th style="text-align: left">Un</th>
                                <th style="text-align: left">Preço</th>
                                <th style="text-align: left">Ps Liquido</th>
                                <th style="text-align: left">Ps Bruto</th>
                                <th style="text-align: left">Imagen</th>
                                <th style="text-align: left">Descrição</th>
                                <th style="text-align: left">LarG Produo</th>
                                <th style="text-align: left">Alt Produto</th>
                                <th style="text-align: left">Comprimento</th>
                                <th style="text-align: left">Situação</th>--}}
                            </tr>
                        </thead>
                        <tbody id="resultProd">
                            {{--<tr>
                                <td></td>
                                <td>T74747474747</td>
                                <td>0998876654635</td>
                                <td>0998876654665</td>
                                <td>PROD TESTE</td>
                                <td>PRODUTO<BR>SERVICO</td>
                                <td>Un</td>
                                <td>Preço</td>
                                <td>UN<BR>
                                    PC<BR>
                                    CX<BR>
                                    KIT<BR>
                                </td>
                                <td>R$ 300,00</td>
                                <td>IMG</td>
                                <td>2CM</td>
                                <td>3CM</td>
                                <td>4CM</td>
                                <td>ATIVO<BR>INATIVO</td>
                            </tr>--}}
                        </tbody>
                    </table>
                    <!-- Moda Variações -->
                </div>
            </div>
        </section>
    </div>

    <script src="{{asset('js/admin/jquery.cookie.js')}}"></script>
    {{--<script src="{{asset('js/admin/integracaoBling.js')}}"></script>--}}
    <script>
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

        //Abrir o modal ao clicar no botão Atributos
        $('#btn_atributos').click(function(e){

            // e.preventDefault();
            //
            // var my_cookie = $.cookie($('.modal-check').attr('name'));
            // if (my_cookie && my_cookie == "true") {
            //     $(this).prop('checked', my_cookie);
            //     console.log('checked checkbox');
            // }
            // else{
            //     $('#myModal').modal('show');
            //     console.log('uncheck checkbox');
            // }
            //
            // $(".modal-check").change(function() {
            //     $.cookie($(this).attr("name"), $(this).prop('checked'), {
            //         path: '/',
            //         expires: 1
            //     });
            // });
        });

        $('#btnBuscaProd').one("click", function(){
            buscaProdutos();
        });

        function buscaProdutos(){
            var numPag = 0;
            var numProds=0;
            var num = 1;
            var erro = false;
            var erroMsg = "Sem erros por enquanto";
            var primeiroProd = true;
            var entrouEach = false;
            var contadorProd = 0;

            while(!erro){
                numPag++;
                var pagina = 'page=' + numPag;


                $.ajax({
                    url: '{{url('/admin/api/bling')}}/' + pagina,
                    type: 'GET',
                    //data: {pagina: pagina},
                    async: false,
                    success: function(data){
                        var obj = JSON.parse(data);

                        try{

                            for(var i=0; i<obj.retorno.produtos.length ; i++){
                                //obj.retorno.produtos.length
                                var arrayHead = [];
                                var arrayBody = [];
                                numProds++;
                                var temCategoria = false;
                                var trBody = "<tr id='trProd" + i + "'></tr>";
                                $('#resultProd').append(trBody);

                                $.each(obj.retorno.produtos[i].produto, function(index, resposta){
                                    if(index == "codigo" && resposta == ""){
                                        return false;
                                    }

                                    if(index == "codigo" || index == "descricao" || index == "tipo" || index == "situacao" ||
                                        index == "unidade" || index == "preco" || index == "descricaoCurta" ||
                                        index == "marca" || index == "pesoLiq" || index == "pesoBruto" || index == "gtin" ||
                                        index == "gtinEmbalagem" || index == "larguraProduto" || index == "alturaProduto" ||
                                        index == "profundidadeProduto" || index == "imagem" || index == "estoqueAtual" ||
                                        index == "produtoLoja"){

                                        if(index == "produtoLoja"){
                                            var nomeId;
                                            var nomeDesc;
                                            var nomeIdPai;
                                            var nomeDescPai;
                                            for(var j = 0; j < index.length; j++){
                                                $.each(obj.retorno.produtos[i].produto.produtoLoja.categoria[j], function(cate){

                                                    if(cate == "id"){
                                                        nomeId = cate + "Categoria";
                                                    }
                                                    else if(cate == "descricao") {
                                                        nomeDesc = cate + "Categoria";
                                                    }
                                                    else{
                                                        nomeIdPai = cate;
                                                        nomeDescPai = "descCatPai";
                                                    }
                                                });
                                            }
                                            arrayHead.push(nomeId);
                                            arrayHead.push(nomeDesc);
                                            arrayHead.push(nomeIdPai);
                                            arrayHead.push(nomeDescPai);
                                        }
                                        else{
                                            arrayHead.push(index);
                                        }


                                        if(index=="imagem"){
                                            if(resposta == ""){
                                                arrayBody.push("");
                                            }
                                            for(var j = 0; j < index.length; j++){
                                                $.each(obj.retorno.produtos[i].produto.imagem[j], function(img, link){
                                                    if(img == "link"){
                                                        arrayBody.push(link);
                                                    }
                                                });

                                            }
                                        }
                                        else if(index == "produtoLoja"){
                                            var idProd = "kk";
                                            var descProd = "ppp";
                                            var paiProd = 0;
                                            var nomePai = "";
                                            //100 é a qntd de produto por pagina que o bling disponibiliza
                                            for(var j = contadorProd; j < 100; j++){
                                                $.each(obj.retorno.produtos[i].produto.produtoLoja.categoria[j], function(cate, campo){
                                                    if(cate == "id"){
                                                        idProd = campo;
                                                    }
                                                    else if(cate == "descricao"){
                                                        descProd = campo;
                                                    }
                                                    else{
                                                        paiProd = campo;
                                                    }

                                                });

                                            }

                                            arrayBody.push(idProd);
                                            arrayBody.push(descProd);

                                            if(paiProd != 0){
                                                nomePai = buscarCategoriaPai(paiProd);
                                                arrayBody.push(paiProd);
                                                arrayBody.push(nomePai);
                                            }
                                            else{
                                                arrayBody.push(null);
                                                arrayBody.push(null);
                                            }

                                            contadorProd++;
                                        }
                                        else {
                                            arrayBody.push(resposta);
                                        }

                                    }

                                });

                                for(var iH = 0; iH < arrayHead.length; iH++){
                                    if(arrayHead[iH] == "idCategoria"){
                                        temCategoria = true;
                                    }
                                }

                                if(temCategoria){
                                    if(!entrouEach){
                                        for(var iH = 0; iH < arrayHead.length; iH++){
                                            if(arrayHead[iH] == "codigo" || arrayHead[iH] == "descricao" ||
                                                arrayHead[iH] == "tipo" || arrayHead[iH] == "preco" || arrayHead[iH] == "gtin" ||
                                                arrayHead[iH] == "descricaoCategoria" || arrayHead[iH] == "descCatPai" ||
                                                arrayHead[iH] == "estoqueAtual"){
                                                var campoHead = "<td>" + arrayHead[iH] + "</td>";
                                                $('#indexProd').append(campoHead);
                                            }
                                            entrouEach = true;
                                        }
                                    }

                                    console.log("PRODUTO " + numProds);
                                    for(var iH = 0; iH < arrayBody.length; iH++){
                                        if(arrayHead[iH] == "codigo" || arrayHead[iH] == "descricao" ||
                                            arrayHead[iH] == "tipo" || arrayHead[iH] == "preco" || arrayHead[iH] == "gtin" ||
                                            arrayHead[iH] == "descricaoCategoria" || arrayHead[iH] == "descCatPai" ||
                                            arrayHead[iH] == "estoqueAtual"){

                                            console.log(arrayBody[iH]);
                                            var tdBody = "<td>" + arrayBody[iH] + "</td>";
                                            $('#trProd' + i).append(tdBody);
                                        }
                                    }
                                    console.log("---------------------------------------");
                                }

                            }

                        }
                        catch(err){
                            erroMsg = err;
                        }

                        try{
                            $.each(obj.retorno.erros[0].erro, function(index, resposta){
                                if(resposta == "14"){
                                    console.log(index + ":" + resposta);
                                }
                            });
                            erro = true;
                        }
                        catch(err){
                            erroMsg = err;
                        }

                    }
                });

                if(erro){
                    console.log("Erro: " + erro);
                    console.log(erroMsg);
                }
            }
        }

        function buscarCategoriaPai(id){
            var idCat = id;
            var nomePai = "";

            $.ajax({
                url: "{{url('admin/api/bling/cat')}}/" + idCat,
                type: "GET",
                //data: {idCategoria: idCat},
                async: false,
                success: function(data){
                    var obj = JSON.parse(data);

                    for(var i = 0; i < obj.retorno.categorias.length; i++){
                        $.each(obj.retorno.categorias[i].categoria, function(index, dado){
                            if(index == "descricao"){
                                nomePai = dado;
                            }
                        });
                    }
                }
            });

            return nomePai;
        }

    </script>

    <script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>
    {{--<!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap4.js"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- page script -->--}}



@stop

