@extends('layouts.admin.app')

@section('content')
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
                <li class="active">Compra/Reposição</li>
            </ol>
        </section>

        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 id="titulo" class="box-title"></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr id="thead">
                                    </tr>
                                </thead>
                                <tbody id="tbody-table">

                                </tbody>
                            </table>
                        </div>
                        <!-- .col-md-12 -->
                        <div class="col-md-6">
                            <p id="data_atual"></p>
                            <p id="p_titulo">{{--Responsável: (Compra/Reposição)--}}</p>
                            <p>Ass:___________________________</p>
                        </div>
                        <div id="div_lidos" class="col-md-6" style="display: none;">
                            <p>Lidos a mais: <span id="lido_mais"></span></p>
                            <p>Lidos a menos: <span id="lido_menos"></span></p>
                            <p>Não lidos: <span id="nao_lido"></span></p>
                        </div>
                    </div>
                    <!-- .row -->
                </div>
                <!-- .box-body -->
            </div>
            <!-- .box-primary -->
        </section>
    </div>
    <!-- .content-wrapper -->

    <script>
        $(function() {
            let obj = JSON.parse(localStorage.getItem('storeObj'));

            if(obj !== null) {
                $('#titulo').text(obj.titulo[0].title);
                $('#p_titulo').text(obj.titulo[0].title);

                //for(let i = 0; i < obj.thead.length; i++){
                    if(obj.hasOwnProperty('thead')) {

                        let td_prod = $('<th>');
                        let td_cod = $('<th>');
                        let td_sug = $('<th>');
                        let td_preco = $('<th>');
                        let td_est = $('<th>');
                        let td_custo = $('<th>');
                        let td_venda = $('<th>');
                        let td_venda_total = $('<th>');

                        td_prod.text(obj.thead[0].produto);
                        td_cod.text(obj.thead[0].codigo);
                        td_sug.text(obj.thead[0].sugestao);
                        td_preco.text(obj.thead[0].preco);
                        td_est.text(obj.thead[0].estoque);
                        td_custo.text(obj.thead[0].custo);
                        td_venda.text(obj.thead[0].venda);
                        td_venda_total.text(obj.thead[0].venda_total);

                        $('#thead').append(td_prod, td_cod, td_est, td_sug, td_custo, td_preco, td_venda, td_venda_total);

                    }else{
                        let td_prod = $('<th>');
                        let td_cod = $('<th>');
                        let td_qtd = $('<th>');
                        let td_lidos = $('<th>');
                        let td_dif = $('<th>');
                        let td_obs = $('<th>');
                        let td_est_att = $('<th>');

                        td_cod.text(obj.inventario[0].codigo);
                        td_prod.text(obj.inventario[0].produto);
                        td_qtd.text(obj.inventario[0].qtd);
                        td_lidos.text(obj.inventario[0].lidos);
                        td_dif.text(obj.inventario[0].dif);
                        td_obs.text(obj.inventario[0].obs);
                        td_est_att.text("");

                        $('#thead').append(td_cod, td_prod, td_qtd, td_lidos, td_dif, td_obs, td_est_att);

                        $('#div_lidos').css('display', 'block');
                        $('#lido_mais').text(obj.options[0].lidos_mais);
                        $('#lido_menos').text(obj.options[0].lidos_menos);
                        $('#nao_lido').text(obj.options[0].nao_lidos);
                    }
                //}

                for (let i = 0; i < obj.tabela.length; i++) {
                    //console.log(obj.tabela[i]);
                    let tr = $('<tr>');

                    if(obj.hasOwnProperty('thead')) {

                        let td_prod = $('<td>');
                        let td_cod = $('<td>');
                        let td_sug = $('<td>');
                        let td_preco = $('<td>');
                        let td_est = $('<td>');
                        let td_custo = $('<td>');
                        let td_venda = $('<td>');
                        let td_venda_total = $('<td>');

                        td_prod.text(obj.tabela[i].produto);
                        td_cod.text(obj.tabela[i].codigo);
                        td_sug.text(obj.tabela[i].sugestao);
                        td_preco.text(obj.tabela[i].preco);
                        td_est.text(obj.tabela[i].estoque);
                        td_custo.text("R$ " + parseFloat(obj.tabela[i].custo).toFixed(2));
                        td_venda.text("R$ " + parseFloat(obj.tabela[i].venda).toFixed(2));
                        td_venda_total.text("R$ " + parseFloat(obj.tabela[i].venda_total).toFixed(2));

                        tr.append(td_prod, td_cod, td_est, td_sug, td_custo, td_preco, td_venda, td_venda_total);


                    }else{
                        let td_prod = $('<td>');
                        let td_cod = $('<td>');
                        let td_qtd = $('<td>');
                        let td_lidos = $('<td>');
                        let td_dif = $('<td>');
                        let td_obs = $('<td>');
                        let td_est_att = $('<td>');

                        td_cod.text(obj.tabela[i].codigo);
                        td_prod.text(obj.tabela[i].produto);
                        td_qtd.text(obj.tabela[i].qtd);
                        td_lidos.text(obj.tabela[i].lidos);
                        td_dif.text(obj.tabela[i].dif);

                        if(obj.tabela[i].dif != 0)
                            td_dif.addClass('nao_lido');

                        td_obs.text(obj.tabela[i].obs);

                        if(obj.tabela[i].obs !== "Lido")
                            td_obs.addClass('nao_lido');

                        td_est_att.text(obj.tabela[i].est_att);

                        let re = new RegExp(' ', 'g');

                        if(obj.tabela[i].est_att.replace(re, '') === 'Estoquenaoatualizado')
                            td_est_att.addClass('nao_lido');


                        tr.append(td_cod, td_prod, td_qtd, td_lidos, td_dif, td_obs, td_est_att);
                    }

                    $('#tbody-table').append(tr);
                }

                let data = new Date();
                data = data.getDate() + "/" + (data.getMonth() + 1)+ "/" + data.getFullYear();
                $('#data_atual').text(data);

                window.print();

                localStorage.clear();
            }
            else{
                window.close();
            }
        });
    </script>

@stop