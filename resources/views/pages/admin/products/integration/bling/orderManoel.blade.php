@extends('layouts.admin.app')

@section('content')
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
                        {{--<div class="col-md-4">
                            <div class="btn btn-group">
                                <button id="btn_busca_pedidos" type="button" class="btn btn-primary">Buscar Pedidos</button>
                            </div>
                        </div>--}}
                        <div class="col-md-4">
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
                        </div>
                    </div>
                    <!-- .row -->

                    <div class="table-responsive removerHidden" hidden>
                        <table class="table table-striped">
                            <thead>
                            <tr id="indexPedido">
                                <th>Numero Pedido</th>
                                <th>SKU</th>
                                <th>Preço Custo</th>
                                <th>Valor Unidade</th>
                                <th>Quantidade</th>
                                <th>Total Venda</th>
                                <th>Situação</th>
                                <th>Integração</th>
                            </tr>
                            </thead>
                            <tbody id="resultPedido">

                            </tbody>
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
                                <h4><b>Situação: </b><span id="span_situacao"></span></h4>
                            </div>
                            <div class="col-md-12">
                                <h4><b>Integração: </b><span id="span_integracao"></span></h4>
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
                                <h4>Resultado Final: <b><span class="spanResultadoFinal"></span></b></h4>
                                <h4 id="gerouLucro" style="display: none; color: #1bc11b;"><i class="fa fa-check"></i>Está venda gerou lucro.</h4>
                                <h4 id="gerouPrejuizo" style="display: none; color: red;"><i class="fa fa-times"></i>Está venda gerou prejuízo.</h4>
                            </div>
                            <div class="col-md-4">
                                <ul class="list-group">
                                    <li class="list-group-item active">Valor Total: <span id="spanValorTotal"></span></li>
                                    <li class="list-group-item">Comissão: -<span id="spanComissao"></span></li>
                                    <li class="list-group-item">Taxa do Canal: -<span id="spanTaxa"></span></li>
                                    <li class="list-group-item">Imposto: -<span id="spanImposto"></span></li>
                                    <li class="list-group-item">PAC: -<span id="spanPac"></span></li>
                                    <li class="list-group-item">Despesa Fixa: -<span id="spanDespesa"></span></li>
                                    <li class="list-group-item">Taxa Cartão: -<span id="spanTaxaCartao"></span></li>
                                    <li class="list-group-item">Marketing: -<span id="spanMarketing"></span></li>
                                    <li class="list-group-item active">Resultado Final: <span class="spanResultadoFinal"></span></li>
                                </ul>
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

    <script src="{{asset('js/admin/jquery.blockUI.js')}}"></script>
    <script>
        $(function(){
            //=====================================================================================================
            //BOTÃO QUE BUSCA TODOS OS PEDIDOS DO BLING
            {{-- $('#btn_busca_pedidos').click(function(){
                console.log('oi');
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: '{{route('search.orders.bling')}}',
                    type: 'get',
                    success: function(data){
                        console.log(data);

                        let obj = JSON.parse(data);
                        console.log(obj);
                    }
                });
            });--}}

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
                console.log('oi');
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

                            if(obj.situacao != "Cancelado"){
                                console.log(obj);
                                //insere frete do produto no input da frete
                                frete = parseFloat(obj.valorfrete);
                                //insere a integração do produto no input da integração
                                integracao = obj.tipoIntegracao;

                                for(let j=0; j<obj.itens.length; j++){
                                    console.log(obj.itens[j].item);

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
                                    //insere total venda do produto no array
                                    arrayPedidos.push(obj.totalvenda);
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
                                    $('#resultPedido').append(tr);

                                    arrayPedidos = [];
                                }
                            }
                        }

                        $('#fretePedido').val(frete);
                        $('#integracaoPedido').val(integracao);
                        $('.removerHidden').removeAttr('hidden');
                        $('#inputEscolhaPedido').blur();
                    }
                }).done(function(){
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
                console.log('oi');

                $('.ulProdutos').remove();
                $('.divForm').remove();
                $('.resultadoPedido').attr('hidden', true);

                let situacao = $('tr > td:eq(6)').text();
                let integracao = $('tr > td:eq(7)').text();
                let contadorTR = 1;

                $('#span_situacao').text(situacao);
                $('#span_integracao').text(integracao);
                $('#input_frete').val($('#fretePedido').val());

                //vai percorrer todas as trs da table
                $('tbody').find('tr').each(function(){

                    let div = $("<div></div>");
                    div.addClass("col-md-6 ulProdutos");
                    let contador = 0;
                    let ul = $("<ul></ul>");
                    ul.addClass("list-group");

                    //vai percorrer todas as tds pertencentes a tr
                    $(this).find("td").each(function(){
                        if(contador == 1||contador == 2||contador == 3||contador == 4||contador == 5){
                            console.log($(this).text());

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
                            else if(contador == 5){
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
                let valorTotal = parseFloat($('.liPrecoTotal:first').text());
                imposto = ((imposto / 100) * valorTotal);
                comissao = ((comissao / 100) * valorTotal);
                despesa_fixa = ((despesa_fixa / 100) * valorTotal);
                taxa_cartao = ((taxa_cartao / 100) * valorTotal);
                marketing = ((marketing / 100) * valorTotal);
                if($('#integracaoPedido').val() == "MercadoLivre")
                    taxa = taxa * qtd;

                let resultado = (comissao + taxa + imposto + custoProd + pac + despesa_fixa + taxa_cartao + marketing + parseFloat($('#input_frete').val()));
                let resultadoFinal = valorTotal - resultado;

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
                $('#spanComissao').text(comissao.toFixed(2));
                $('#spanTaxa').text(taxa.toFixed(2));
                $('#spanImposto').text(imposto.toFixed(2));
                $('#spanPac').text(pac.toFixed(2));
                $('#spanDespesa').text(despesa_fixa.toFixed(2));
                $('#spanTaxaCartao').text(taxa_cartao.toFixed(2));
                $('#spanMarketing').text(marketing.toFixed(2));
                $('#spanValorTotal').text(valorTotal.toFixed(2));
                $('.spanResultadoFinal').text(resultadoFinal.toFixed(2));

            });
        });
    </script>

@stop