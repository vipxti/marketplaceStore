@extends('layouts.admin.app')

@section('content')

    <link rel="stylesheet" href="{{asset('css/admin/daterangepicker-bs3.css')}}">
    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-check-square-o"></i>&nbsp;&nbsp;Pedidos PagSeguro</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">PagSeguro</a></li>
                <li><a class="active">Pedidos PagSeguro</a></li>
            </ol>
        </section>

        <!--SESSÃO DO SORTEIO-->
        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Pedidos PagSeguro</h3>
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
                            <button id="btn_busca_pedidos" class="btn btn-primary">Buscar Pedidos</button>
                        </div>
                        <div class="col-md-3 pull-right">
                            <label>Escolha o pedido que você deseja:</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input id="inputEscolhaPedido" type="text" class="form-control">
                                    <span class="input-group-addon" title="Pesquisar Pedido">
                                        <a id="btnEscolhaPedido" href="javascript:void(0)">
                                            <i class="fa fa-search"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br/>

                    <div id="table_pedido" class="row" hidden>
                        <div class="col-md-12 table-responsive">
                            <table id="table" class="table table-striped">
                                <thead>
                                    <tr>
                                       <th>Referência</th>
                                       <th>Status</th>
                                       <th>Método de pagamento</th>
                                       <th>Valor compra</th>
                                       <th>Data de Alteração</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4 pull-right">
                            <button id="btn_atualiza" class="btn btn-success pull-right"><i class="fa fa-upload"></i>&nbsp;&nbsp;Atualizar Status</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="{{asset('js/admin/select2.full.min.js')}}"></script>
    <script src="{{asset('js/admin/jquery.inputmask.js')}}"></script>
    <script src="{{asset('js/admin/moment.min.js')}}"></script>
    <script src="{{asset('js/admin/daterangepicker.js')}}"></script>
    <script src="{{asset('js/admin/jquery.blockUI.js')}}"></script>
    <script src="{{asset('js/admin/sweetalert.min.js')}}"></script>
    <script>
        $(function(){
            //Initialize Select2 Elements
            $('.select2').select2();

            //Date range picker
            $('#reservation').daterangepicker({
                format: 'DD/MM/YYYY'
            });

            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            //=====================================================================================================
            //BOTÃO PARA BUSCAR OS PEDIDOS
            $('#btn_busca_pedidos').click(function(){

                let arrayData = $('#reservation').val().replace(/\s/g, '').split('-');

                let dateAr = arrayData[0].split('/');
                let novaData1 = dateAr[1] + '/' + dateAr[0] + '/' + dateAr[2];
                dateAr = arrayData[1].split('/');
                let novaData2 = dateAr[1] + '/' + dateAr[0] + '/' + dateAr[2];

                let date1 = new Date(novaData1);
                let date2 = new Date(novaData2);
                let timeDiff = Math.abs(date2.getTime() - date1.getTime());
                let diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                console.log(diffDays);

                if(diffDays <= 30) {
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

                    arrayData[0] = arrayData[0].replace(/\//g, '-');
                    arrayData[1] = arrayData[1].replace(/\//g, '-');

                    $('#tbody').empty();
                    buscaPedidos(1, arrayData)
                }
            });

            function criaTabela(objPedido){
                let tr = $('<tr></tr>');

                let tdReferencia = $('<td></td>');
                tdReferencia.text(objPedido.reference).appendTo(tr);


                let tdStatus = $('<td></td>');
                let status = '';
                switch(objPedido.status){
                    case '1':
                        status = 'Aguardando Pagamento';
                        break;
                    case '2':
                        status = 'Em Análise';
                        break;
                    case '3':
                        status = 'Pago';
                        break;
                    case '4':
                        status = 'Disponível';
                        break;
                    case '5':
                        status = 'Em Disputa';
                        break;
                    case '6':
                        status = 'Devolvido';
                        break;
                    case '7':
                        status = 'Cancelado';
                        break;
                    case '8':
                        status = 'Debitado';
                        break;
                    case '9':
                        status = 'Retenção Temporária';
                        break;

                }
                tdStatus.text(objPedido.status + ' - ' + status).appendTo(tr);


                let tdPagto = $('<td></td>');
                let pagto = '';
                switch (objPedido.paymentMethod.type){
                    case '1':
                        pagto = 'Cartão de crédito';
                        break;
                    case '2':
                        pagto = 'Boleto';
                        break;
                }
                tdPagto.text(objPedido.paymentMethod.type + " - " + pagto).appendTo(tr);


                let tdValor = $('<td></td>');
                tdValor.text(objPedido.grossAmount).appendTo(tr);

                let tdDataAlteracao = $('<td></td>');
                let dataAlt = objPedido.lastEventDate;
                dataAlt = dataAlt.split('T');
                let horaAlt = dataAlt[1].split('.');
                tdDataAlteracao.text(dataAlt[0] + " " + horaAlt[0]).appendTo(tr);

                tr.appendTo($('#tbody'));
            }

            //=====================================================================================================
            //FUNÇÃO PARA BUSCAR OS PEDIDOS PELA API DO PAGSEGURO
            let existePag = true;
            function buscaPedidos(page, arrayData){
                $.ajax({
                    url: '{{route('pagseguro.pedido.transacao')}}',
                    type: 'post',
                    data: {_token: CSRF_TOKEN, pagina: page, datas: arrayData},
                    success: function(data){
                        console.log(data);
                        try {
                            let obj = data[0].transactions.transaction;
                            console.log(obj);

                            for (let i = 0; i < obj.length; i++) {
                                let objPedido = obj[i];

                                criaTabela(objPedido);

                            }

                            $('#table_pedido').removeAttr('hidden');
                        }
                        catch (e) {
                            existePag = false;
                        }
                    },
                    error: function(data){
                        console.log('erro');
                        console.log(data);
                    }
                })
                    .done(function(){
                        if(existePag == true)
                            buscaPedidos(++page, arrayData);
                        else{
                            $.unblockUI();
                            existePag = true;
                        }
                    });
            }

            //=====================================================================================================
            //BOTÃO DE ESCOLHA, QUE BUSCA PEDIDO POR SEU NÚMERO
            $('#btnEscolhaPedido').click(function(){
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

                let transacao = $('#inputEscolhaPedido').val();
                $('#tbody').empty();
                buscaPedidoTransacao(transacao);
            });

            $('#inputEscolhaPedido').keypress(function(){
                let keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13'){
                    $('#btnEscolhaPedido').click();
                }
            });

            //=====================================================================================================
            //BOTÃO PARA BUSCAR OS PEDIDOS POR CODIGO DE TRANSACAO
            function buscaPedidoTransacao(transacao){
                $.ajax({
                    url: '{{route('pagseguro.pedido.codigo.transacao')}}',
                    type: 'post',
                    data: {_token: CSRF_TOKEN, transacao: transacao},
                    success: function(data){
                        console.log(data);
                        let obj = data[0];

                        try {
                            criaTabela(obj);
                        }
                        catch(e){
                            swal('Ops', 'Pedido não encontrado.', 'warning');
                        }
                    },
                    error: function(data){

                    }
                })
                    .done(function () {
                        $.unblockUI();
                    });
            }

            //=====================================================================================================
            //BOTÃO PARA BUSCAR ATUALIZAR SITUAÇÃO DOS PEDIDOS
            $('#btn_atualiza').click(function(){
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

                atualizaSituacao(1);
            });

            function atualizaSituacao(tableRow){
                let tamanhoTable = $('#table tr').length;
                let cd_referencia = $('#table tr:eq(' + tableRow + ')').find('td:first').text();
                let status = $('#table tr:eq(' + tableRow + ')').find('td:eq(1)').text();
                status = status.replace(/\s/g, '').split('-');
                let data = $('#table tr:eq(' + tableRow + ')').find('td:last').text();
                data = data.split(' ');
                console.log(data[0]);
                console.log(status[0]);

                if(tableRow < tamanhoTable) {
                    $.ajax({
                        url: '{{route('pagseguro.atualiza.situacao')}}',
                        type: 'post',
                        data: {_token: CSRF_TOKEN, referencia: cd_referencia, status: status[0], data: data[0]},
                        success: function (data) {
                            if(data.deuErro == true){
                                //swal('Ops', 'Ocorreu um erro ao tentar atualizar o status de um dos produtos.', 'error');
                                console.log("ERRO" + cd_referencia);
                                console.log("ERRO STATUS" + status[0]);
                            }
                            else{
                                console.log(data);
                            }
                        }
                    })
                        .done(function () {
                            atualizaSituacao(++tableRow);
                        });
                }
                else{
                    $.unblockUI();
                }
            }

        });
    </script>

@stop