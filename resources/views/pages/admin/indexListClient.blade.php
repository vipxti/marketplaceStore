@extends('layouts.admin.app')

@section('content')

    <link rel="stylesheet" href="{{asset('css/admin/daterangepicker-bs3.css')}}">
    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-users"></i>&nbsp;&nbsp;Clientes Cadastrados</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a class="active">Lista de Clientes</a></li>
            </ol>
        </section>

        <!--SESSÃO DO SORTEIO-->
        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de Clientes</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row col-md-12">
                        <button id="btnExcel" type="button" class="btn btn-success"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Exportar Para Excel</button>

                        <div class="table-responsive">
                            <br/>
                            <table id="table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>CPF/CNPJ</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Celular</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clientes as $c)
                                        <tr>
                                            <td>{{$c->cd_cliente}}</td>
                                            <td>{{$c->cd_cpf_cnpj}}</td>
                                            <td>{{$c->nm_cliente . ' ' . $c->sobrenome_cliente}}</td>
                                            <td>{{$c->email}}</td>
                                            <td>{{$c->cd_celular1}}</td>
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

    <script src="{{asset('js/admin/jquery.base64.js')}}"></script>
    <script src="{{asset('js/admin/jquery.btechco.excelexport.js')}}"></script>
    <script>
        $(function(){
            $('#btnExcel').click(function(){
                $("#table").btechco_excelexport({
                    containerid: "table",
                    datatype: $datatype.Table,
                    filename: 'Lista de Clientes'
                });
            });
        });
    </script>

@stop