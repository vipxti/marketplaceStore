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
    <link rel="stylesheet" href="{{asset('css/admin/daterangepicker-bs3.css')}}">
    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-tags"></i>&nbsp;&nbsp;Vincular</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Integração</a></li>
                <li><a href="#">Bling</a></li>
                <li class="active">Buscar Pedidos</li>
            </ol>
        </section>

        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Buscar Pedidos</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-3">
                            <label>Escolha a data dos pedidos:</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="reservation">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>

                                <button id="btn_busca_pedidos" type="button" class="btn btn-primary">Buscar Pedidos</button>

                        </div>
                        <div id="divFiltroCanal" class="col-md-2" hidden>
                            <label>Filtre por canal:</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <select id="filtroCanal" class="form-control">
                                    </select>
                                    <span class="input-group-addon"><i class="fa fa-filter"></i></span>
                                </div>
                            </div>
                        </div>
                        <div id="divTaxasCanal" class="col-md-2" hidden>
                            <label>Escolha canal para aplicar valores:</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <select id="taxasCanal" class="form-control">
                                        <option value=""></option>
                                        @foreach($canais as $c)
                                            <option value="{{$c->id_canais}}">{{$c->nome_canal}}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-addon"><i class="fa fa-filter"></i></span>
                                </div>
                            </div>
                        </div>
                        <div id="divFiltroPgto" class="col-md-2" hidden>
                            <label>Filtre por forma de pgto.</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <select id="filtroPgto" class="form-control">
                                        <option value=""></option>
                                    </select>
                                    <span class="input-group-addon"><i class="fa fa-filter"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 pull-right">
                            <label>Escolha o pedido que você deseja:</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input id="inputEscolhaPedido" type="number" class="form-control">
                                    <span class="input-group-addon" title="Pesquisar Pedido">
                                        <a id="btnEscolhaPedido" href="javascript:void(0)">
                                            <i class="fa fa-search"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <button id="gerarPDFTabela" type="button" class="btn btn-danger pull-right" style="display: none;">
                                <i class="fa fa-file-pdf-o"></i>
                                &nbsp;&nbsp;Gerar PDF Pedidos</button>
                        </div>
                    </div>
                    <!-- .row -->

                    <div class="table-responsive removerHidden" hidden>
                        <table class="table table-striped">
                            <thead>
                                <tr id="indexPedido">
                                    <th>Pedido</th>
                                    <th>SKU</th>
                                    <th>Preço Custo</th>
                                    <th>Valor Unidade</th>
                                    <th>Quantidade</th>
                                    <th>Custo Total</th>
                                    <th>Total Venda</th>
                                    <th>Frete</th>
                                    <th>Situação</th>
                                    <th>Integração</th>
                                    <th>Forma Pgto</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="resultPedido">

                            </tbody>
                            <tfoot>
                                <th colspan="4"></th>
                                <th>Qtd: <span id="spanQtdTotal"></span></th>
                                <th>Custo: <span id="spanCustoTotal"></span></th>
                                <th>Venda: <span id="spanVendaTotal"></span></th>
                                <th>Frete: <span id="spanFreteTotal"></span></th>
                                <th colspan="3"></th>
                            </tfoot>
                        </table>
                    </div>
                    <!-- table-responsive -->

                    <input type="hidden" id="fretePedido">
                    <input type="hidden" id="integracaoPedido">

                    <div class="row removerHidden" hidden>
                        <div class="col-md-12">
                                <button id="btn_calculo" type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-default">
                                    <i class="fa fa-pencil-square-o"></i>
                                    &nbsp;&nbsp;Calcular
                                </button>
                        </div>
                    </div>

                    <div id="divComissao" class="row" hidden>
                        <hr/>
                        <div class="col-md-2">
                            <label>Comissão Total: <span id="comissaoTotal"></span></label><br/>
                            <label>Imposto Total: <span id="impostoTotal"></span></label><br/>
                            <label>PAC Total: <span id="pacTotal"></span></label>
                        </div>
                        <div class="col-md-2">
                            <label>Despesa Fixa Total: <span id="despesaTotal"></span></label><br/>
                            <label>Taxa Cartão Total: <span id="taxaCartaoTotal"></span></label><br/>
                            <label>Marketing: <span id="marketingTotal"></span></label>
                        </div>
                        <div class="col-md-2">
                            <label>Taxa Total: <span id="taxaTotal"></span></label>
                            <label>Resultado Total: <span id="vendaTotalResultado"></span></label>
                        </div>
                    </div>

                </div>
                <!-- .box-body -->
            </div>
            <!-- .box-primary -->
        </section>

        <!-- MODAL ATUALIZA DADOS -->
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Calcular</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 id="h4Pedido"><b>Pedido: </b><span id="span_pedido"></span></h4>
                            </div>
                            <div class="col-md-12">
                                <h4 id="h4Situacao"><b>Situação: </b><span id="span_situacao"></span></h4>
                            </div>
                            <div class="col-md-12">
                                <h4 id="h4Integracao"><b>Integração: </b><span id="span_integracao"></span></h4>
                                <hr/>
                            </div>
                        </div>
                        <!-- .row -->

                        <div class="row dadosPedido">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Canal da compra:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <select id="selectCanais" class="form-control">
                                            <option value=""></option>
                                            @foreach($canais as $c)
                                                <option value="{{$c->id_canais}}">{{$c->nome_canal}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Comissão: (%)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                        <input id="input_comissao" type="text" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Taxa do Canal:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input id="input_taxa" type="text" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Imposto: (%)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-line-chart"></i></span>
                                        <input id="input_imposto" type="text" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>PAC:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-bar-chart"></i></span>
                                        <input id="input_pac" type="text" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Despesa Fixa: (%)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-bar-chart"></i></span>
                                        <input id="input_despesa" type="text" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Taxa do Cartão: (%)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-bar-chart"></i></span>
                                        <input id="input_taxa_cartao" type="text" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Marketing: (%)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-bar-chart"></i></span>
                                        <input id="input_marketing" type="text" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Frete:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-bar-chart"></i></span>
                                        <input id="input_frete" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .row -->
                        <div class="row listaPedidos">
                            <div class="col-md-12">
                                <hr/>
                                <p><b>Produtos do pedido:</b></p>
                            </div>
                        </div>
                        <!-- .row -->
                        <div class="row resultadoPedido" hidden>
                            <hr/>
                            <div class="col-md-12">
                                <h4 id="h4ResultadoFinal">Resultado Final: <b><span class="spanResultadoFinal"></span></b></h4>
                                <h4 id="gerouLucro" style="display: none; color: #1bc11b;"><i class="fa fa-check"></i>Esta venda gerou lucro.</h4>
                                <h4 id="gerouPrejuizo" style="display: none; color: red;"><i class="fa fa-times"></i>Esta venda gerou prejuízo.</h4>
                            </div>
                            <div class="col-md-4">
                                <ul class="list-group ulResultadoCalculo">
                                    <li class="list-group-item active">Valor Total: <span id="spanValorTotal"></span></li>
                                    <li class="list-group-item">Custo Protudo: -<span id="spanCustoProduto"></span></li>
                                    <li class="list-group-item">Quantidade: <span id="spanQtdProduto"></span></li>
                                    <li class="list-group-item">Comissão: -<span id="spanComissao"></span></li>
                                    <li class="list-group-item">Taxa do Canal: -<span id="spanTaxa"></span></li>
                                    <li class="list-group-item">Imposto: -<span id="spanImposto"></span></li>
                                    <li class="list-group-item">PAC: -<span id="spanPac"></span></li>
                                    <li class="list-group-item">Despesa Fixa: -<span id="spanDespesa"></span></li>
                                    <li class="list-group-item">Taxa Cartão: -<span id="spanTaxaCartao"></span></li>
                                    <li class="list-group-item">Marketing: -<span id="spanMarketing"></span></li>
                                    <li class="list-group-item">Resultado: <span id="spanResultado"></span></li>
                                    <li class="list-group-item active">Resultado Final: <span class="spanResultadoFinal"></span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row resultadoPedido" hidden>
                            <div class="col-md-12">
                                <button id="gerarPDF" type="button" class="btn btn-danger pull-right">
                                    <i class="fa fa-file-pdf-o"></i>
                                    &nbsp;&nbsp;Gerar PDF</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btnSairModal" type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>
                        <button id="btn_calcular_pedidos" type="submit" class="btn btn-primary">
                            <i class="fa fa-pencil-square-o"></i>
                            &nbsp;&nbsp;Calcular
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>


<script src="{{asset('js/admin/select2.full.min.js')}}"></script>
<script src="{{asset('js/admin/jquery.inputmask.js')}}"></script>
<script src="{{asset('js/admin/moment.min.js')}}"></script>
<script src="{{asset('js/admin/daterangepicker.js')}}"></script>
<script src="{{asset('js/admin/jquery.blockUI.js')}}"></script>
<script src="{{asset('js/admin/sweetalert.min.js')}}"></script>
<script src="{{asset('js/admin/jspdf.min.js')}}"></script>
<script>
    $(function(){
        //Initialize Select2 Elements
        $('.select2').select2();

        //Date range picker
        $('#reservation').daterangepicker({
            format: 'DD/MM/YYYY'
        });

        //=====================================================================================================
        //BOTÃO QUE BUSCA TODOS OS PEDIDOS DO BLING
        var pag = 1;
        $('#btn_busca_pedidos').click(function(){
            //console.log('oi');
            $('#btn_calculo').css('display', 'none');
            $('#resultPedido').empty();
            //var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            let arrayData = $('#reservation').val().replace(/\s/g, '').split('-');
            arrayData[0] = arrayData[0].replace(/\//g, '-');
            arrayData[1] = arrayData[1].replace(/\//g, '-');
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

            buscarPedidos(pag, arrayData);
        });

        //=====================================================================================================
        //FUNÇÃO QUE BUSCA TODOS OS PEDIDOS COM OS PARAMETROS PASSADOS
        let arrayNumeroPedido = [];
        let arrayFiltroCanal = [''];
        let arrayFiltroPgto = [''];
        let existeNumeroPedido = false;
        let loja = 'Loja Física';
        function buscarPedidos(pagina, datas){
            let deuErro = true;
            let existeFiltro = false;

            pagina = "page=" + pagina;
            //try {
                $.ajax({
                    url: '{{url('/admin/order/bling/search')}}/' + pagina + '/' + datas,
                    type: 'get',
                    success: function (data) {
                        let objPedido = JSON.parse(data);

                        try{
                            let erro = objPedido.retorno.erros[0];
                            deuErro = true;
                            return;
                        }
                        catch(e){
                            deuErro = false;
                        }

                        objPedido = objPedido.retorno.pedidos;
                        let obj;
                        console.log(objPedido);
                        // console.log("Tamanho array filtro: " + arrayFiltroCanal.length);


                        //try {
                            for (let i = 0; i < objPedido.length; i++) {
                                obj = objPedido[i].pedido;
                                existeNumeroPedido = false;
                                existeFiltro = false;



                                if (obj.situacao != "Cancelado" && obj.situacao != "Venda Agenciada") {
                                    //console.log(obj);
                                    //console.log(obj.parcelas[0].parcela.forma_pagamento.descricao);
                                    console.log(obj.numero);
                                    let integracao;
                                    if(jQuery.type(obj.tipoIntegracao) == "undefined")
                                        integracao = loja;
                                    else
                                        integracao = obj.tipoIntegracao;


                                    if(!arrayFiltroCanal.includes(integracao)){
                                        arrayFiltroCanal.push(integracao);
                                    }

                                    try {
                                        if (!arrayFiltroPgto.includes(obj.parcelas[0].parcela.forma_pagamento.descricao)) {
                                            arrayFiltroPgto.push(obj.parcelas[0].parcela.forma_pagamento.descricao);
                                        }
                                    }
                                    catch(e){
                                        console.log("erro pagamento");
                                    }

                                    for (let j = 0; j < obj.itens.length; j++) {
                                        //console.log(obj.itens[j].item);
                                        let qtd = Math.trunc(obj.itens[j].item.quantidade);
                                        let custo = 0;

                                        if(obj.itens[j].item.precocusto != null)
                                            custo = parseFloat(obj.itens[j].item.precocusto);
                                        else
                                            custo = 0.0;

                                        let custoTotal = custo * qtd;

                                        //insere numero pedido no array
                                        arrayPedidos.push(obj.numero);
                                        arrayNumeroPedido.push(obj.numero);
                                        //insere sku do produto no array
                                        arrayPedidos.push(obj.itens[j].item.codigo);
                                        //insere preço custo do produto no array
                                        arrayPedidos.push(custo.toFixed(2));
                                        //insere valor unidade do produto no array
                                        arrayPedidos.push(obj.itens[j].item.valorunidade);
                                        //insere quantidade do produto no array
                                        arrayPedidos.push(Math.trunc(obj.itens[j].item.quantidade));
                                        //insere custo total do produto no array
                                        arrayPedidos.push(custoTotal.toFixed(2));
                                        //insere total venda do produto no array
                                        arrayPedidos.push(obj.totalvenda);
                                        //insere frete do produto no array
                                        arrayPedidos.push(obj.valorfrete);
                                        //insere situação do produto no array
                                        arrayPedidos.push(obj.situacao);
                                        //insere tipo integração do produto no array
                                        arrayPedidos.push(obj.tipoIntegracao);
                                        //insere a forma de pgto do produto no array
                                        try{
                                            arrayPedidos.push(obj.parcelas[0].parcela.forma_pagamento.descricao);
                                        }
                                        catch(e){
                                            arrayPedidos.push("");
                                        }

                                        let tr = $('<tr></tr>');
                                        for (let k = 0; k < arrayPedidos.length; k++) {
                                            let td = $('<td></td>');

                                            td.text(arrayPedidos[k]);
                                            tr.append(td);
                                        }

                                        if (!existeNumeroPedido) {
                                            let td = $('<td></td>');
                                            let button = $('<button></button>');
                                            let button2 = $('<button></button>');
                                            let p = $('<p></p>');
                                            button.addClass('btn btn-outline-warning fa fa-pencil-square-o');
                                            button.attr('id', 'btn_tr_calcular');
                                            button.attr('data-toggle', 'modal');
                                            button.attr('data-target', '#modal-default');
                                            button.css('color', '#3c8dbc');
                                            button2.addClass('btn btn-outline-warning fa fa-pencil-square-o');
                                            button2.attr('id', 'btn_tr_calculo_rapido');
                                            button2.css('color', '#00a65a');
                                            p.css('display', 'none');
                                            p.addClass('paragrafAviso');
                                            td.css('text-align', 'center');
                                            td.append(button);
                                            td.append(button2);
                                            td.append(p);
                                            tr.append(td);
                                            existeNumeroPedido = true;
                                        }
                                        else {
                                            let td = $('<td></td>');

                                            td.text("");
                                            tr.append(td);
                                        }
                                        if(custo == 0)
                                            tr.css('color', 'red');

                                        $('#resultPedido').append(tr);


                                        arrayPedidos = [];
                                    }


                                }
                            }
                            $('#divTaxasCanal').removeAttr('hidden');
                            $('#divFiltroPgto').removeAttr('hidden');
                            $('#divFiltroCanal').removeAttr('hidden');
                            $('.removerHidden').removeAttr('hidden');
                            //$('#gerarPDFTabela').css('display', 'block');
                       /* }
                        catch (e) {
                            deuErro = true;
                            pag = 1;
                            // console.log(pag);
                        }*/
                    },
                    error: function(data){
                        swal('Ops', 'Ocorreu um erro ao buscar os dados.' +
                            'Tente novamente mais tarde.', 'error');
                        $.unblockUI();
                    }
                })
                    .done(function () {
                        if (!deuErro)
                            buscarPedidos(++pag, datas);
                        else {
                            geraCustoTotal();
                            geraVendaTotal();
                            ativaBotao();
                            filtroSelect();
                            $.unblockUI();
                        }
                    });
            /*}
            catch(e){
                swal('Ops', 'Ocorreu um erro ao buscar os dados.' +
                            'Tente novamente mais tarde.', 'error');
                $.unblockUI();
            }*/
        }

        //=====================================================================================================
        //FUNÇÃO QUE GERA O CUSTO TOTAL DOS PRODUTOS APRESENTADOS NA TABELA
        function geraCustoTotal(){
            let custoTotal = 0;
            let qtdTotal = 0;
            let freteTotal = 0;
            taxa_total_canal = 0;

            $('#resultPedido').find('tr').each(function(){
                if(!$(this).hasClass('trDesativa') && !$(this).hasClass('trDesativaPagto')) {
                    let custo = parseFloat($(this).find('td:eq(5)').text());
                    let qtd = parseFloat($(this).find('td:eq(4)').text());
                    let frete = parseFloat($(this).find('td:eq(7)').text());
                    let valor_unidade = parseFloat($(this).find('td:eq(3)').text());
                    valor_unidade = valor_unidade.toFixed(2);
                    let calc = 0;

                    if(valor_unidade <= 120)
                        calc = taxa_select * qtd;

                    taxa_total_canal+= calc;
                    //console.log("taxa total " + calc);
                    custoTotal += custo;
                    qtdTotal += qtd;
                    freteTotal += frete;
                }
            });

            $('#spanCustoTotal').text(custoTotal.toFixed(2));
            $('#spanQtdTotal').text(qtdTotal);
            $('#spanFreteTotal').text(freteTotal.toFixed(2));
            $('#taxaTotal').text(taxa_total_canal.toFixed(2));

        }

        let taxa_total_canal = 0;
        function geraVendaTotal(){
            let vendaTotal = 0;
            let arrayPedido = [];
            let existeNumero = false;
            $('#resultPedido').find('tr').each(function(){
                if(!$(this).hasClass('trDesativa') && !$(this).hasClass('trDesativaPagto')) {
                    existeNumero = false;
                    let pedido = $(this).find('td:first').text();

                    for (let i = 0; i < arrayPedido.length; i++) {
                        if (pedido == arrayPedido[i])
                            existeNumero = true;
                    }

                    if (!existeNumero) {
                        //console.log($(this));
                        arrayPedido.push(pedido);
                        let venda = parseFloat($(this).find('td:eq(6)').text());
                        vendaTotal += venda;
                    }
                }
            });

            $('#spanVendaTotal').text(vendaTotal.toFixed(2));
        }

        //=====================================================================================================
        //FUNÇÃO QUE ADICIONA O NOME DOS CANAIS NO SELECT DO FILTRO
        function filtroSelect(){
            $('#filtroCanal').empty();
            $('#filtroPgto').empty();
            for(let i = 0; i < arrayFiltroCanal.length; i++){
                let option = $('<option></option>');
                option.text(arrayFiltroCanal[i]);
                option.val(arrayFiltroCanal[i]);
                $('#filtroCanal').append(option);
                //console.log(jQuery.type(arrayFiltroCanal[i]));
                //console.log(arrayFiltroCanal[i]);
            }

            for(let i = 0; i < arrayFiltroPgto.length; i++){
                let option = $('<option></option>');
                option.text(arrayFiltroPgto[i]);
                option.val(arrayFiltroPgto[i]);
                $('#filtroPgto').append(option);
                //console.log(jQuery.type(arrayFiltroCanal[i]));
                //console.log(arrayFiltroCanal[i]);
            }

            $('#divFiltroCanal').removeAttr('hidden');
            $('#divTaxasCanal').removeAttr('hidden');
            $('#divFiltroPgto').removeAttr('hidden');
        }

        //=====================================================================================================
        //CASO O USUARIO CLIQUE "ENTER" NO INPUT DA ESCOLHA ELE VAI EXECUTAR O EVENTO CLICK DO BOTÃO DA ESCOLHA
        $('#inputEscolhaPedido').keypress(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                $('#btnEscolhaPedido').click();
            }
        });

        //=====================================================================================================
        //BOTÃO DE ESCOLHA, QUE BUSCA PEDIDO POR SEU NÚMERO
        var arrayPedidos = [];
        $('#btnEscolhaPedido').click(function(){
            $('#btn_calculo').css('display', 'block');
            //console.log('oi');
            let numeroPedido = $('#inputEscolhaPedido').val();
            let frete = 0;
            let integracao = "";
            $('#resultPedido').empty();

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
                url: '{{url('/admin/order/bling/searchorders/number')}}/' + numeroPedido,
                type: 'get',
                success: function(data){
                    let obj = JSON.parse(data);
                    obj = obj.retorno.pedidos;

                    for(let i=0; i<obj.length; i++){
                        obj = obj[i].pedido;
                        let existeNumeroPedido = false;

                        if(obj.situacao != "Cancelado"){
                            //console.log(obj);
                            //insere frete do produto no input da frete
                            frete = parseFloat(obj.valorfrete);
                            //insere a integração do produto no input da integração
                            integracao = obj.tipoIntegracao;

                            for(let j=0; j<obj.itens.length; j++){
                                //console.log(obj.itens[j].item);

                                let qtd = Math.trunc(obj.itens[j].item.quantidade);
                                let custo = parseFloat(obj.itens[j].item.precocusto);
                                let custoTotal = custo * qtd;

                                //insere numero pedido no array
                                arrayPedidos.push(obj.numero);
                                //insere sku do produto no array
                                arrayPedidos.push(obj.itens[j].item.codigo);
                                //insere preço custo do produto no array
                                arrayPedidos.push(obj.itens[j].item.precocusto);
                                //insere valor unidade do produto no array
                                arrayPedidos.push(obj.itens[j].item.valorunidade);
                                //insere quantidade do produto no array
                                arrayPedidos.push(Math.trunc(obj.itens[j].item.quantidade));
                                //insere custo total do produto no array
                                arrayPedidos.push(custoTotal.toFixed(2));
                                //insere total venda do produto no array
                                arrayPedidos.push(obj.totalvenda);
                                //insere frete do produto no array
                                arrayPedidos.push(obj.valorfrete);
                                //insere situação do produto no array
                                arrayPedidos.push(obj.situacao);
                                //insere tipo integração do produto no array
                                arrayPedidos.push(obj.tipoIntegracao);

                                let tr = $('<tr></tr>');
                                for(let k = 0; k < arrayPedidos.length; k++){
                                    let td = $('<td></td>');

                                    td.text(arrayPedidos[k]);
                                    tr.append(td);
                                }

                                if (!existeNumeroPedido) {
                                    let td = $('<td></td>');
                                    let button2 = $('<button></button>');
                                    let p = $('<p></p>');
                                    button2.addClass('btn btn-outline-warning fa fa-pencil-square-o');
                                    button2.attr('id', 'btn_tr_calculo_rapido');
                                    button2.css('color', '#00a65a');
                                    p.css('display', 'none');
                                    p.addClass('paragrafAviso');
                                    td.css('text-align', 'center');
                                    td.append(button2);
                                    td.append(p);
                                    tr.append(td);
                                    existeNumeroPedido = true;
                                }
                                else {
                                    let td = $('<td></td>');

                                    td.text("");
                                    tr.append(td);
                                }

                                $('#resultPedido').append(tr);

                                arrayPedidos = [];
                            }
                        }
                    }

                    $('#fretePedido').val(frete);
                    $('#integracaoPedido').val(integracao);
                    $('.removerHidden').removeAttr('hidden');
                    $('#gerarPDFTabela').css('display', 'none');
                    $('#inputEscolhaPedido').blur();
                }
            }).done(function(){
                geraCustoTotal();
                geraVendaTotal();
                ativaBotao();
                filtroSelect();
                $.unblockUI();
            });
        });

        //=====================================================================================================
        //AO MUDAR O CANAL PREENCHE OS CAMPOS COM OS DETERMINADOS VALORES
        $('#selectCanais').change(function(){
            let id_canal = $(this).val();

            $('#input_comissao').val("Aguarde...");
            $('#input_taxa').val("Aguarde...");
            $('#input_imposto').val("Aguarde...");
            $('#input_pac').val("Aguarde...");
            $('#input_despesa').val("Aguarde...");
            $('#input_taxa_cartao').val("Aguarde...");
            $('#input_marketing').val("Aguarde...");

            if(id_canal != "") {
                $.ajax({
                    url: '{{url('/admin/order/bling/channels')}}/' + id_canal,
                    type: 'get',
                    success: function (data) {

                        $('#input_comissao').val(data.comissao);
                        $('#input_taxa').val(data.taxa);
                        $('#input_imposto').val(data.imposto);
                        $('#input_pac').val(data.pac);
                        $('#input_despesa').val(data.despesa_fixa);
                        $('#input_taxa_cartao').val(data.taxa_cartao);
                        $('#input_marketing').val(data.marketing);

                    }
                });
            }
            else{
                $('#input_comissao').val("");
                $('#input_taxa').val("");
                $('#input_imposto').val("");
                $('#input_pac').val("");
                $('#input_despesa').val("");
                $('#input_taxa_cartao').val("");
                $('#input_marketing').val("");
            }
        });

        //=====================================================================================================
        //BOTÃO DE CALCULAR QUE PASSA VALORES DA TABELA PARA MODAL
        $('#btn_calculo').click(function(){
            //console.log('oi');

            $('.ulProdutos').remove();
            $('.divForm').remove();
            $('.resultadoPedido').attr('hidden', true);

            let pedido = $('tr > td:eq(0)').text();
            let situacao = $('tr > td:eq(8)').text();
            let integracao = $('tr > td:eq(9)').text();
            if(integracao == "")
                integracao = "Loja Física";
            let contadorTR = 1;

            $('#span_pedido').text(pedido);
            $('#span_situacao').text(situacao);
            $('#span_integracao').text(integracao);
            $('#input_frete').val($('#fretePedido').val());

            //vai percorrer todas as trs da table
            $('#resultPedido').find('tr').each(function(){
                //console.log($(this));
                let div = $("<div></div>");
                div.addClass("col-md-6 ulProdutos");
                let contador = 0;
                let ul = $("<ul></ul>");
                ul.addClass("list-group");

                //vai percorrer todas as tds pertencentes a tr
                $(this).find("td").each(function(){
                    if(contador == 1||contador == 2||contador == 3||contador == 4||contador == 6){
                        //console.log($(this).text());

                        let li = $("<li></li>");
                        li.addClass("list-group-item");
                        li.text($(this).text());

                        if(contador == 1)
                            li.addClass("active");
                        else if(contador == 2){
                            let divForm = $("<div></div>");
                            divForm.addClass("col-md-4 divForm");
                            let divInput = $("<div></div>");
                            divInput.addClass("form-group inputPreco");
                            let label = $("<label></label>");
                            label.text("Preço Custo Produto " + contadorTR + ":");
                            let input = $("<input>");
                            input.attr("id", "inputPreco" + contadorTR);
                            input.addClass("form-control");
                            input.val($(this).text());

                            divInput.append(label, input);
                            divForm.append(divInput);

                            $('.dadosPedido').append(divForm);
                        }
                        else if(contador == 4){
                            li.addClass("liQtd");
                        }
                        else if(contador == 6){
                            li.addClass("liPrecoTotal");
                        }

                        ul.append(li);

                    }
                    contador++;
                });

                div.append(ul);
                $('.listaPedidos').append(div);
                contadorTR++;
            });

        });

        //=====================================================================================================
        //BOTÃO PARA CALCULAR OS GASTOS COM OS VALORES APRESENTADOS
        $('#btn_calcular_pedidos').click(function(){
            $('.resultadoPedido').removeAttr('hidden');

            //DECLARAÇÃO DAS VARIAVEIS USADAS
            let comissao = parseFloat($("#input_comissao").val());
            let taxa = parseFloat($("#input_taxa").val());
            let imposto = parseFloat($("#input_imposto").val());
            let pac = parseFloat($("#input_pac").val());
            let despesa_fixa = parseFloat($("#input_despesa").val());
            let taxa_cartao = parseFloat($("#input_taxa_cartao").val());
            let marketing = parseFloat($("#input_marketing").val());
            let aux, qtd = 0, arrayCusto = [], arrayQtd = [], custoProd = 0;

            $(".inputPreco").find("input").each(function(){
                arrayCusto.push(parseFloat($(this).val().replace(',', '.')));
            });

            $(".liQtd").each(function(){
                aux = parseFloat($(this).text());
                arrayQtd.push(aux);
                qtd += aux;
            });

            for(let i = 0; i < arrayCusto.length; i++){
                custoProd += (arrayCusto[i] * arrayQtd[i]);
            }

            //CALCULO DOS CUSTOS
            let valorSemFrete = 0;
            let valorTotal = parseFloat($('.liPrecoTotal:first').text());
            let frete = parseFloat($('#input_frete').val());
            valorSemFrete = valorTotal - frete;
            imposto = ((imposto / 100) * valorSemFrete);
            comissao = ((comissao / 100) * valorTotal);
            despesa_fixa = ((despesa_fixa / 100) * valorSemFrete);
            taxa_cartao = ((taxa_cartao / 100) * valorSemFrete);
            marketing = ((marketing / 100) * valorSemFrete);
            if($('#span_integracao').text() == "MercadoLivre")
                taxa = taxa * qtd;

            /*console.log("integração: " + $('#span_integracao').text());
            console.log("valorTotal: " + valorTotal + " " + jQuery.type(valorTotal));
            console.log("valorSemFrete: " + valorSemFrete + " " + jQuery.type(valorSemFrete));
            console.log("comissão: " + comissao + " " + jQuery.type(comissao));
            console.log("qtd: " + qtd + " " +jQuery.type(qtd));
            console.log("taxa: " + taxa + " " +jQuery.type(taxa));
            console.log("imposto: " + imposto +" " + jQuery.type(imposto));
            console.log("custoProd: " + custoProd  +" " + jQuery.type(custoProd));
            console.log("pac: " + pac +" " + jQuery.type(pac));
            console.log("despesa_fixa: " + despesa_fixa +" " + jQuery.type(despesa_fixa));
            console.log("frete: " + frete + " " +jQuery.type(frete));
            console.log("taxa_cartao: " + taxa_cartao + " " +jQuery.type(taxa_cartao));
            console.log("marketing: " + marketing +" " + jQuery.type(marketing));*/

            let resultado = (comissao + taxa + imposto + custoProd + pac + despesa_fixa + taxa_cartao + marketing + frete);
            let resultadoFinal = valorTotal - resultado;

            /*console.log("resultado: " + resultado);
            console.log("resultadoFinal: " + resultadoFinal);
            console.log(resultadoFinal.toFixed(2));*/

            //CRIAÇÃO DA DOM DOS RESULTADOS
            $('#spanResultadoFinal').text(resultadoFinal.toFixed(2));

            //VERIFICA SE CUSTOS DEU LUCRO OU PREJUÍZO
            if(resultadoFinal > 0){
                $('#gerouLucro').css('display', 'block');
                $('#gerouPrejuizo').css('display', 'none');
            }
            else{
                $('#gerouLucro').css('display', 'none');
                $('#gerouPrejuizo').css('display', 'block');
            }

            //CRIA UL MOSTRANDO OS GASTOS
            $('#spanCustoProduto').text(custoProd.toFixed(2));
            $('#spanQtdProduto').text(qtd);
            $('#spanComissao').text(comissao.toFixed(2));
            $('#spanTaxa').text(taxa.toFixed(2));
            $('#spanImposto').text(imposto.toFixed(2));
            $('#spanPac').text(pac.toFixed(2));
            $('#spanDespesa').text(despesa_fixa.toFixed(2));
            $('#spanTaxaCartao').text(taxa_cartao.toFixed(2));
            $('#spanMarketing').text(marketing.toFixed(2));
            $('#spanValorTotal').text(valorTotal.toFixed(2));
            $('#spanResultado').text(resultado.toFixed(2));
            $('.spanResultadoFinal').text(resultadoFinal.toFixed(2));

        });

        //=====================================================================================================
        //FUNÇÃO PARA ATIVAR OS BOTÕES
        function ativaBotao() {
            //=====================================================================================================
            //BOTÃO DE CALCULAR QUE PASSA VALORES DA TABELA PARA MODAL
            $('button#btn_tr_calcular').click(function () {
                let campoTR = $(this).parent().parent().addClass('trBotao');
                let numeroPedido = campoTR.find('td:eq(0)').text();
                let contadorTR = 1;

                //remove coisas do modal para que nao tenha conflito
                $('.ulProdutos').remove();
                $('.divForm').remove();
                $('.resultadoPedido').attr('hidden', true);

                //pega a sitação e tipo de integração e mostra para o usuario
                let pedido = $('.trBotao > td:eq(0)').text();
                let situacao = $('.trBotao > td:eq(8)').text();
                let integracao = $('.trBotao > td:eq(9)').text();
                if(integracao == "")
                    integracao = "Loja Física";
                $('#span_pedido').text(pedido);
                $('#span_situacao').text(situacao);
                $('#span_integracao').text(integracao);

                //procura todos as trs que seja do mesmo pedido da que foi clicada
                $('#resultPedido').find('tr').each(function(){
                    if($(this).find('td:eq(0)').text() == numeroPedido){
                        //$(this).addClass('trBotao');
                        //console.log($(this));
                        let div = $("<div></div>");
                        div.addClass("col-md-6 ulProdutos");
                        let contador = 0;
                        let ul = $("<ul></ul>");
                        ul.addClass("list-group");

                        //vai percorrer todas as tds pertencentes a tr
                        $(this).find("td").each(function(){
                            if(contador == 1||contador == 2||contador == 3||contador == 4||contador == 6){
                                //console.log($(this).text());

                                let li = $("<li></li>");
                                li.addClass("list-group-item");
                                li.text($(this).text());

                                if(contador == 1)
                                    li.addClass("active");
                                else if(contador == 2){
                                    let divForm = $("<div></div>");
                                    divForm.addClass("col-md-4 divForm");
                                    let divInput = $("<div></div>");
                                    divInput.addClass("form-group inputPreco");
                                    let label = $("<label></label>");
                                    label.text("Preço Custo Produto " + contadorTR + ":");
                                    let input = $("<input>");
                                    input.attr("id", "inputPreco" + contadorTR);
                                    input.addClass("form-control");
                                    input.val($(this).text());

                                    divInput.append(label, input);
                                    divForm.append(divInput);

                                    $('.dadosPedido').append(divForm);
                                }
                                else if(contador == 4){
                                    li.addClass("liQtd");
                                }
                                else if(contador == 6){
                                    li.addClass("liPrecoTotal");
                                }

                                ul.append(li);

                            }
                            contador++;
                        });

                        div.append(ul);
                        $('.listaPedidos').append(div);
                        contadorTR++;
                    }
                });

                $('#input_frete').val(campoTR.find('td:eq(7)').text());
                //$(this).parent().parent().removeClass('trBotao');
                $('.trBotao').removeClass('trBotao');
            });

            //=====================================================================================================
            //BOTÃO DE CALCULO RAPIDO QUE APRESENTA O RESULTADO NA PROPRIA TABELA
            $('button#btn_tr_calculo_rapido').click(function(){
                let campoTR = $(this).parent().parent().addClass('adicionaPDF');
                let campoTD = $(this).parent();
                let numeroPedido = campoTR.find('td:eq(0)').text();
                //DECLARAÇÃO DAS VARIAVEIS USADAS
                let comissao = comissao_select;
                let taxa = taxa_select;
                let imposto = imposto_select;
                let pac = pac_select;
                let despesa_fixa = despesa_fixa_select;
                let taxa_cartao = taxa_cartao_select;
                let marketing = marketing_select;
                let arrayCusto = [], arrayQtd = [];
                let qtd = 0, custoProd = 0, valorTotal = 0, frete = 0, integracao = "", valorSemFrete = 0;

                $('#resultPedido').find('tr').each(function(){
                    if($(this).find('td:eq(0)').text() == numeroPedido){
                        //console.log($(this));

                        valorTotal = parseFloat($(this).find('td:eq(6)').text());
                        arrayCusto.push(parseFloat($(this).find('td:eq(2)').text()));
                        arrayQtd.push(parseInt($(this).find('td:eq(4)').text()));
                        integracao = $(this).find('td:eq(9)').text();
                        frete = parseFloat($(this).find('td:eq(7)').text());

                    }
                });

                for(let i = 0; i<arrayCusto.length; i++){
                    custoProd += (arrayCusto[i] * arrayQtd[i]);
                    qtd += arrayQtd[i];
                }

                valorSemFrete = valorTotal - frete;
                imposto= ((imposto/ 100) * valorSemFrete);
                comissao= ((comissao / 100) * valorTotal);
                despesa_fixa = ((despesa_fixa/ 100) * valorSemFrete);
                taxa_cartao= ((taxa_cartao/ 100) * valorSemFrete);
                marketing= ((marketing/ 100) * valorSemFrete);

                if(integracao == "MercadoLivre")
                    taxa= taxa * qtd;

                /*console.log("integração: " + integracao);
                console.log("valorTotal: " + valorTotal + " " + jQuery.type(valorTotal));
                console.log("valorSemFrete: " + valorSemFrete + " " + jQuery.type(valorSemFrete));
                console.log("comissão: " + comissao + " " + jQuery.type(comissao));
                console.log("qtd: " + qtd + " " +jQuery.type(qtd));
                console.log("taxa: " + taxa + " " +jQuery.type(taxa));
                console.log("imposto: " + imposto +" " + jQuery.type(imposto));
                console.log("custoProd: " + custoProd  +" " + jQuery.type(custoProd));
                console.log("pac: " + pac +" " + jQuery.type(pac));
                console.log("despesa_fixa: " + despesa_fixa +" " + jQuery.type(despesa_fixa));
                console.log("frete: " + frete + " " +jQuery.type(frete));
                console.log("taxa_cartao: " + taxa_cartao + " " +jQuery.type(taxa_cartao));
                console.log("marketing: " + marketing +" " + jQuery.type(marketing));*/

                let resultado = parseFloat(comissao) + parseFloat(taxa) + parseFloat(imposto) + parseFloat(custoProd) + parseFloat(pac) + parseFloat(despesa_fixa) + parseFloat(frete) + parseFloat(taxa_cartao) + parseFloat(marketing);
                let resultadoFinal = valorTotal - resultado;

                /*console.log("resultado: " + resultado);
                console.log("resultadoFinal: " + resultadoFinal);
                console.log(resultadoFinal.toFixed(2));*/


                //$('p.paragrafAviso').css('display', 'none');
                if(resultadoFinal > 0){
                    campoTD.find('p').text('Lucro: ' + resultadoFinal.toFixed(2)).css('color', '#00a65a').css('font-weight', 'bold').css('display', 'block');
                }
                else{
                    campoTD.find('p').text('Prejuízo: ' + resultadoFinal.toFixed(2)).css('color', '#cc0000').css('font-weight', 'bold').css('display', 'block');
                }

            });

        }

        //=====================================================================================================
        //SELECT PARA FAZER O FILTRO DOS DADOS DA TABELA
        $('#filtroCanal').change(function(){
            let valor = $(this).val();
            // console.log(valor);

            if(valor != "") {
                if(valor == loja)
                    valor = "";

                $('#resultPedido').find('tr').each(function () {
                    if ($(this).find('td:eq(9)').text() != valor) {
                        // console.log($(this));
                        $(this).attr('hidden', true).addClass('trDesativa');
                    }
                    else {
                        $(this).removeClass('trDesativa');

                        if(!$(this).hasClass('trDesativaPagto'))
                            $(this).removeAttr('hidden');
                    }

                });

                $('#divComissao').removeAttr('hidden');
            }else{
                $('#resultPedido').find('tr').each(function () {
                    $(this).removeClass('trDesativa');

                    if(!$(this).hasClass('trDesativaPagto'))
                        $(this).removeAttr('hidden');
                });
                $('#divComissao').attr('hidden', true);
                $('#gerarPDFTabela').css('display', 'none');
            }

            geraCustoTotal();
            geraVendaTotal();

            if($('#taxasCanal').val() != ""){
                if($('#filtroCanal').val() != "") {
                    let custoTotal = parseFloat($('#spanVendaTotal').text());
                    let frete = parseFloat($('#spanFreteTotal').text());
                    let qtd = parseInt($('#spanQtdTotal').text());
                    let custoProd = parseFloat($('#spanCustoTotal').text());
                    let custoSemFrete = custoTotal - frete;
                    let comissao = (comissao_select / 100) * custoTotal;
                    let imposto = (imposto_select / 100) * custoSemFrete;
                    let pac = pac_select * qtd;
                    let despesa = (despesa_fixa_select / 100) * custoSemFrete;
                    let taxa_cartao = (taxa_cartao_select / 100) * custoSemFrete;
                    // let taxa = taxa_select * qtd;
                    let marketing = (marketing_select / 100) * custoSemFrete;
                    let vendaTotal = (custoSemFrete - custoProd - comissao - imposto - pac - despesa - taxa_total_canal - taxa_cartao - marketing);
                    $('#comissaoTotal').text(comissao.toFixed(2));
                    $('#impostoTotal').text(imposto.toFixed(2));
                    $('#pacTotal').text(pac.toFixed(2));
                    $('#despesaTotal').text(despesa.toFixed(2));
                    $('#taxaCartaoTotal').text(taxa_cartao.toFixed(2));
                    $('#marketingTotal').text(marketing.toFixed(2));
                    $('#taxaTotal').text(taxa_total_canal.toFixed(2));
                    $('#vendaTotalResultado').text(vendaTotal.toFixed(2));
                    $('#gerarPDFTabela').css('display', 'block');
                }
            }
        });

        $('#filtroPgto').change(function(){
            let valor = $(this).val();

            if(valor!=""){
                $('#resultPedido').find('tr').each(function () {
                    if ($(this).find('td:eq(10)').text() != valor) {
                        // console.log($(this));
                        $(this).attr('hidden', true).addClass('trDesativaPagto');
                    }
                    else {
                        $(this).removeClass('trDesativaPagto');

                        if(!$(this).hasClass('trDesativa'))
                            $(this).removeAttr('hidden');
                    }

                });

                $('#divComissao').removeAttr('hidden');
            }else{
                $('#resultPedido').find('tr').each(function () {
                    $(this).removeClass('trDesativaPagto');

                    if(!$(this).hasClass('trDesativa'))
                        $(this).removeAttr('hidden');
                });
                $('#divComissao').attr('hidden', true);
                $('#gerarPDFTabela').css('display', 'none');
            }

            geraCustoTotal();
            geraVendaTotal();

            if($('#taxasCanal').val() != ""){
                if($('#filtroCanal').val() != "") {
                    let custoTotal = parseFloat($('#spanVendaTotal').text());
                    let frete = parseFloat($('#spanFreteTotal').text());
                    let qtd = parseInt($('#spanQtdTotal').text());
                    let custoProd = parseFloat($('#spanCustoTotal').text());
                    let custoSemFrete = custoTotal - frete;
                    let comissao = (comissao_select / 100) * custoTotal;
                    let imposto = (imposto_select / 100) * custoSemFrete;
                    let pac = pac_select * qtd;
                    let despesa = (despesa_fixa_select / 100) * custoSemFrete;
                    let taxa_cartao = (taxa_cartao_select / 100) * custoSemFrete;
                    // let taxa = taxa_select * qtd;
                    let marketing = (marketing_select / 100) * custoSemFrete;
                    let vendaTotal = (custoSemFrete - custoProd - comissao - imposto - pac - despesa - taxa_total_canal - taxa_cartao - marketing);
                    $('#comissaoTotal').text(comissao.toFixed(2));
                    $('#impostoTotal').text(imposto.toFixed(2));
                    $('#pacTotal').text(pac.toFixed(2));
                    $('#despesaTotal').text(despesa.toFixed(2));
                    $('#taxaCartaoTotal').text(taxa_cartao.toFixed(2));
                    $('#marketingTotal').text(marketing.toFixed(2));
                    $('#taxaTotal').text(taxa_total_canal.toFixed(2));
                    $('#vendaTotalResultado').text(vendaTotal.toFixed(2));
                    $('#gerarPDFTabela').css('display', 'block');
                }
            }
        });

        //=====================================================================================================
        //SELECT PARA PEGAR OS DADOS DAS TAXAS PARA APLICAR NO CALCULO RÁPIDO
        let comissao_select, taxa_select, imposto_select, pac_select, despesa_fixa_select, taxa_cartao_select, marketing_select;
        $('#taxasCanal').change(function(){
            let id_canal = $(this).val();
            //console.log(id_canal);
            if(id_canal != "") {
                $.ajax({
                    url: '{{url('/admin/order/bling/channels')}}/' + id_canal,
                    type: 'get',
                    success: function (data) {

                        comissao_select = data.comissao;
                        taxa_select = data.taxa;
                        imposto_select = data.imposto;
                        pac_select = data.pac;
                        despesa_fixa_select = data.despesa_fixa;
                        taxa_cartao_select = data.taxa_cartao;
                        marketing_select = data.marketing;

                    }
                }).done(function () {
                    if($('#filtroCanal').val() != "") {
                        geraCustoTotal();
                        geraVendaTotal();
                        let custoTotal = parseFloat($('#spanVendaTotal').text());
                        let frete = parseFloat($('#spanFreteTotal').text());
                        let qtd = parseInt($('#spanQtdTotal').text());
                        let custoProd = parseFloat($('#spanCustoTotal').text());
                        let custoSemFrete = custoTotal - frete;
                        let comissao = (comissao_select / 100) * custoTotal;
                        let imposto = (imposto_select / 100) * custoSemFrete;
                        let pac = pac_select * qtd;
                        let despesa = (despesa_fixa_select / 100) * custoSemFrete;
                        let taxa_cartao = (taxa_cartao_select / 100) * custoSemFrete;
                        let marketing = (marketing_select / 100) * custoSemFrete;
                        let vendaTotal = (custoSemFrete - custoProd - comissao - imposto - pac - despesa - taxa_total_canal - taxa_cartao - marketing);
                        $('#comissaoTotal').text(comissao.toFixed(2));
                        $('#impostoTotal').text(imposto.toFixed(2));
                        $('#pacTotal').text(pac.toFixed(2));
                        $('#despesaTotal').text(despesa.toFixed(2));
                        $('#taxaCartaoTotal').text(taxa_cartao.toFixed(2));
                        $('#marketingTotal').text(marketing.toFixed(2));
                        $('#vendaTotalResultado').text(vendaTotal.toFixed(2));
                        $('#gerarPDFTabela').css('display', 'block');
                    }
                });
            }
            else{
                $('#comissaoTotal').text("");
                $('#impostoTotal').text("");
                $('#pacTotal').text("");
                $('#despesaTotal').text("");
                $('#taxaCartaoTotal').text("");
                $('#marketingTotal').text("");
                $('#vendaTotalResultado').text("");
                $('#gerarPDFTabela').css('display', 'none');
            }

        });

        //=====================================================================================================
        //BOTÃO PARA GERAR O PDF COM OS DADOS DAS TAXAS
        $('#gerarPDF').click(function(){
            if($('#selectCanais').val() != ""){

                let doc = new jsPDF();
                doc.setFontSize(14);
                doc.text($('#h4Pedido').text(), 10, 20);
                doc.text($('#h4Situacao').text(), 10, 30);
                doc.text($('#h4Integracao').text(), 10, 40);
                doc.text('____________________________________________________________________', 10, 50);
                doc.setFontSize(12);

                //LINHA 70
                doc.setFontSize(14);
                doc.text('Despesas: R$ ' + $('#spanResultado').text(), 10, 60);
                doc.setFontSize(12);
                doc.text('Comissão: ' + $('#input_comissao').val() + '% /R$ ' + $('#spanComissao').text(), 10, 70);
                doc.text('Tx. Canal: R$ ' + $('#spanTaxa').text(), 68, 70);
                doc.text('Imposto: ' + $('#input_imposto').val() + '% /R$ ' + $('#spanImposto').text(), 122, 70);
                doc.text('PAC: R$ ' + $('#input_pac').val(), 172, 70);

                //LINHA 80
                doc.text('Desp. Fixa: ' + $('#input_despesa').val() + '% /R$ ' + $('#spanDespesa').text(), 10, 80);
                doc.text('Tx. Cartão: ' + $('#input_taxa_cartao').val() + '% /R$ ' + $('#spanTaxaCartao').text(), 68, 80);
                doc.text('Marketing: ' + $('#input_marketing').val() + '% /R$ ' + $('#spanMarketing').text(), 122, 80);
                doc.text('Frete: R$ ' + $('#input_frete').val(), 172, 80);

                //LINHA 90
                doc.text('_______________________________________________________________________________', 10, 90);
                doc.setFontSize(14);
                doc.text('Produtos do pedido: ', 10, 100);
                doc.setFontSize(12);

                let linha = 110;
                $('.ulProdutos').each(function(){

                    doc.text("SKU: " + $(this).find('li:first').text(), 10, linha);
                    let preco = parseFloat($(this).find('li:eq(1)').text());
                    doc.text("Preço Custo: R$ " + preco.toFixed(2), 68, linha);
                    let valor = parseFloat($(this).find('li:eq(2)').text());
                    doc.text("Valor Un.: R$ " + valor.toFixed(2), 122, linha);
                    doc.text("Qtd: " + $(this).find('li:eq(3)').text(), 172, linha);

                    linha+=10;
                    if(linha == 300){
                        linha = 20;
                        doc.addPage();
                    }
                });

                doc.text('_______________________________________________________________________________', 10, linha);
                linha+=10;
                if(linha == 300){
                    linha = 20;
                    doc.addPage();
                }

                doc.text("Valor Total: R$ " + $('#spanValorTotal').text(), 10, linha);
                doc.text("Result. Final: R$ " + $('.spanResultadoFinal:first').text(), 68, linha);
                let resultado = parseFloat($('.spanResultadoFinal:first').text());
                if(resultado > 0)
                    doc.text($('#gerouLucro').text(), 122, linha);
                else
                    doc.text($('#gerouPrejuizo').text(), 122, linha);

                doc.save("Pedido " + $('#span_pedido').text() + ".pdf");
            }
        });

        //=====================================================================================================
        //BOTÃO PARA GERAR O PDF COM OS DADOS DAS TAXAS DE TODOS OS PEDIDOS DA TABELA
        $('#gerarPDFTabela').click(function(){
            //console.log('oi');
            let data = $('#reservation').val().replace(/\s/g, '').split('-');
            let canal = $('#filtroCanal').val();
            let doc = new jsPDF();

            doc.setFontSize(12);
            doc.text("Canal: " + canal, 10, 20);
            if($('#filtroPgto').val() != "")
                doc.text("Forma Pagto: " + $('#filtroPgto').val(), 50, 20);
            doc.text("Data: " + data[0] + " até " + data[1], 140, 20);
            doc.text('___________________________________________________________________________________', 10, 30);
            doc.text("Total das vendas: R$ " + $('#spanVendaTotal').text(), 10, 40);
            doc.text("Custo produtos: R$ " + $('#spanCustoTotal').text(), 80, 40);
            doc.text("Frete: R$ " + $('#spanFreteTotal').text(), 150, 40);
            doc.text("Comissão: R$ " + $('#comissaoTotal').text(), 10, 50);
            doc.text("Imposto: R$ " + $('#impostoTotal').text(), 60, 50);
            doc.text("PAC: R$ " + $('#pacTotal').text(), 110, 50);
            doc.text("Desp. Fixa: R$ " + $('#despesaTotal').text(), 150, 50);
            doc.text("Tx. Cartão: R$ " + $('#taxaCartaoTotal').text(), 10, 60);
            doc.text("Marketing: R$ " + $('#marketingTotal').text(), 60, 60);
            doc.text("Taxa: R$ " + $('#taxaTotal').text(), 110, 60);
            doc.text("Resultado Final: R$ " + $('#vendaTotalResultado').text(), 10, 70);
            doc.text('___________________________________________________________________________________', 10, 80);

            let qtdPedido = 0;
            let linha = 90;
            $('#resultPedido').find('tr').each(function(){
                if(!$(this).hasClass('trDesativa') && !$(this).hasClass('trDesativaPagto')){
                    doc.text("Pedido: " + $(this).find('td:eq(0)').text(), 10, linha);
                    doc.text("Custo: R$ " + $(this).find('td:eq(5)').text(), 40, linha);
                    doc.text("Qtd: " + $(this).find('td:eq(4)').text(), 80, linha);
                    doc.text("Venda: R$ " + $(this).find('td:eq(6)').text(), 100, linha);
                    doc.text("Frete: R$ " + $(this).find('td:eq(7)').text(), 140, linha);

                    qtdPedido += 1;
                    linha+=10;
                    if(linha == 300){
                        linha = 20;
                        doc.addPage();
                    }
                }
            });

            doc.text("Quantidade de pedidos: " + qtdPedido, 10, linha);

            if($('#filtroPgto').val() == "")
                doc.save("Relatorio " + canal + ".pdf");
            else
                doc.save("Relatorio " + canal + " " + $('#filtroPgto').val() + ".pdf");
        });
    });
</script>

@stop