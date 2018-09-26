@extends('layouts.admin.app')

@section('content')

    <!-- ESTILO DO CHECKBOX DA APPLE -->
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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><i class="fa fa-th-large"></i>&nbsp;&nbsp;Configuração dos Produtos</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Configuração Home</a></li>
                <li class="active">Vitrine</li>
            </ol>
        </section>
        <div class="row">
            @include('partials.admin._alerts')
            <div class="col-md-7">
                <!-- ALTERAÇÃO DOS PRODUTOS HOME -->
                <!-- Tabelas dos produtos -->

                <section class="content">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <form action="{{ route('produtos.vitrine.page') }}" method="post">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar Vitrine</button>
                                    <table class="table table-striped" id="table">
                                        <thead>
                                        <tr>
                                            <th style="text-align: left">Nº</th>
                                            <th style="text-align: left">Nome</th>
                                            <th>
                                                <input id="btnPrincipal" class='switch switch--shadow' value='0' name="bntPrincipal" type='checkbox'>
                                                <label for="btnPrincipal" style="margin-bottom:0 !important;"></label>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($produtos as $produto)
                                                <tr>
                                                    <td>{{ $produto->cd_produto }} </td>
                                                    <td>{{ $produto->nm_produto }} </td>
                                                    <td class="text-right">
                                                        @if($produto->ativo_vitrine == 0)
                                                            <input id="" class='' value='{{ $produto->cd_produto }}' name="codProd[]" type='text' hidden>
                                                            <div class='switch__container'>
                                                                <input id="{{ $produto->cd_produto }}" class='switch switch--shadow' value='0,{{ $produto->cd_produto }}' name="bntForm[]" type='checkbox'>
                                                                <label for="{{ $produto->cd_produto }}" style="margin-bottom:0 !important;"></label>
                                                            </div>
                                                        @else
                                                            <input id="" class='' value='{{ $produto->cd_produto }}' name="codProd[]" type='text' hidden>
                                                            <div class='switch__container'>
                                                                <input id="{{ $produto->cd_produto }}" class='switch switch--shadow' value='1,{{ $produto->cd_produto }}' name="bntForm[]" checked type='checkbox'>
                                                                <label for="{{ $produto->cd_produto }}" style="margin-bottom:0 !important;"></label>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </form>
                                <div align="center">
                                    {{ $produtos->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-4">
                <!-- NUMEROS DE ITENS NA HOME -->
                <section class="content">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <form action="{{ route('numemro.itens.vitrine.page') }}" method="post">
                                {{ csrf_field() }}
                                <div class="col-md-12" >
                                    <label>Produtos (Linhas)</label>
                                    <div class="input-group" style="margin-bottom: 15px;">
                                        <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                        <select id="vitrineItens" class="form-control select2" style="width: 100%;" name="nItens">
                                            @foreach($nItensVitrine as $nItenVitrine)
                                                <option value="{{$nItenVitrine->id_menu_itens_vitrine}}" class="ativo{{$nItenVitrine->menu_itens_vitrine_ativo}}">{{$nItenVitrine->menu_itens_vitrine}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success  pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>
    <script>
        /*const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');*/

        $(function(){
            function selecionaAtivo(){
                $('#vitrineItens').val($('.ativo1').val());
            }
            selecionaAtivo();
        });

        $('.switch').click(function(){
            //console.log($(this));
            if($(this).prop('checked'))
                $(this).val('1,' + $(this).attr('id'));
            else
                $(this).val('0,' + $(this).attr('id'));
        });

        //FUNÇÃO PARA ATIVAR AS FUNÇÕES DO SWITCH
        $('#btnPrincipal').click(function() {
            var isChecked = $(this).prop("checked");
            if(isChecked ==  true){
                //console.log($(this).val()+ ',' + 1);
                //console.log(isChecked);
                $('.switch').each(function(){
                   if(!$(this).prop('checked'))
                       $(this).click();
                });
            }else {
                //console.log($(this).val()+ ',' + 0);
                //console.log(isChecked);
                $('.switch').each(function(){
                    if($(this).prop('checked'))
                        $(this).click();
                });
            }
            $('#table tr:has(td)').find('input[type="checkbox"]').prop('checked', isChecked);
        });

        $('#table tr:has(td)').find('input[type="checkbox"]').click(function() {
            var isChecked = $(this).prop("checked");
            var isHeaderChecked = $("#btnPrincipal").prop("checked");

            if (isChecked == false && isHeaderChecked){
                $("#btnPrincipal").prop('checked', isChecked);
            }
            else {
                $('#table tr:has(td)').find('input[type="checkbox"]').each(function() {
                    if ($(this).prop("checked") == false){
                        isChecked = false;
                    }
                });
                $("#btnPrincipal").prop('checked', isChecked);
                //console.log($(this).val()+ ',' + $(this).attr('id'));
            }
        });
    </script>
@stop
