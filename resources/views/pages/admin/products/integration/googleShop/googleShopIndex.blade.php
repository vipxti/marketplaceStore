@extends('layouts.admin.app')

@section('content')

    <link rel="stylesheet" href="{{asset('css/admin/daterangepicker-bs3.css')}}">
    <div class="content-wrapper">
        <section class="content-header">
            <h1><i class="fa fa-file-code-o"></i>&nbsp;&nbsp;Gerar XML</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Google Shop</a></li>
                <li><a class="active">Gerar XML</a></li>
            </ol>
        </section>

        <!--SESSÃO DO SORTEIO-->
        <section class="content">
            @include('partials.admin._alerts')
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Gerar XML de Produtos</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{route('googleshop.page.xml')}}" target="_blank" class="btn btn-github">
                                <i class="fa fa-file-code-o"></i>&nbsp;&nbsp;
                                Página XMl Produtos
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@stop