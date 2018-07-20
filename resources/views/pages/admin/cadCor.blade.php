@extends('layouts.admin.app')

@section('content')
    <link rel="stylesheet" href="{{asset('css/admin/sweetalert.css')}}">
    <style type="text/css">
        /* Estilo iOS */
        .mHswitch{
            cursor: pointer;
            margin-left: 2% !important;
        }
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
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><i class="fa fa-paint-brush"></i>&nbsp;&nbsp;Cadastrar Cor</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Produto</a></li>
                <li class="active">Cadastrar Cor</li>
            </ol>
        </section>

        <section class="content-header">
            <div class="content">

                @include('partials.admin._alerts')
                
                <div class="row">

                    <!-- Alteração das cores -->
                    <div class="col-md-12">

                        <!-- Lista das cores cadastradas -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Lista de Cores</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="box-body">
                                <!-- Tabelas dos produtos -->
                                <table class="table" id="table">
                                    <thead>
                                    <tr>
                                        <th class="text-left">Código</th>
                                        <th class="text-left">#Hex</th>
                                        <th class="text-left">Cor</th>
                                        <th class="text-left">Status</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($cores as $cor)
                                        <tr class="text-center">
                                            <td id="id_cor" class="text-left">{{ $cor->cd_cor }}</td>
                                            <td id="id_cor" style="vertical-align: inherit !important; width: 60px !important;"><div style="height: 15px; width: 35px; background-color:{{ $cor->hex }};"></div></td>
                                            <td id="nome_cor" class="text-left">{{ $cor->nm_cor }}</td>
                                            <td id="status" class="text-left">
                                                @if($cor->ic_ativo == 0)
                                                    <div class="switch__container pull-left">
                                                        <input id="{{ $cor->cd_cor }}" class="switch switch--shadow" value="0" type="checkbox" name="status">
                                                        <label for="{{ $cor->cd_cor }}"></label>
                                                    </div>
                                                @else
                                                    <div class="switch__container pull-left">
                                                        <input id="{{ $cor->cd_cor }}" class="switch switch--shadow" value="1" type="checkbox" name="status" checked>
                                                        <label for="{{ $cor->cd_cor }}"></label>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
        </section>
    </div>


    <script src="{{asset('js/admin/jquery.blockUI.js')}}"></script>
    <script src="{{asset('js/admin/sweetalert.min.js')}}"></script>
    <script src="{{asset('js/admin/switchery.js')}}"></script>
    <script>

        $(document).ready(function(){

            //cor branco
            $("table tbody tr:odd").css("background-color", "#fff");
            //cor cinza
            $("table tbody tr:even").css("background-color", "#f5f5f5");

            $('.switch').click(function(e){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var id = e.target.id;
                var status = null;
                console.log(id);
                console.log($(this).val());
                if($(this).val()== '0'){
                    $(this).val('1');
                    status = 1;
                }
                else{
                    $(this).val('0');
                    status = 0;
                }
                $.ajax({
                    url: '{{ route('color.update') }}',
                    type: 'POST',
                    data:{_token: CSRF_TOKEN, cd_cor: id, ic_ativo: status},
                    dataType:'JSON',
                    success:function (data) {
                        console.log(data.message);
                    }
                });

            });

        });


        $('#btnSalvarCor').click(function(){
            $.blockUI({
                message: 'Salvando...',
                css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: .5,
                    color: '#fff'
                } });

            setTimeout($.unblockUI, 12000);
        });

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

    </script>

    <script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>

@stop
