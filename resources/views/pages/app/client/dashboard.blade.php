@extends('layouts.app.app')

@section('content')

    <link rel="stylesheet" href="{{asset('css/app/input.css')}}">

    <section class="new_arrivals_area section_padding_100_0 clearfix">

        <div class="container">

            <div class="row">

                <div class="col-md-12">

                    @include('partials.app._alerts')

                </div>

            </div>

            <div class="row">

                <div class="col-12">

                    <div class="section_heading text-center text-left">

                        <h3>
                            <i class="fa fa-sliders"></i>&nbsp;Minha Conta
                        </h3>
                    
                    </div>
                
                </div>
            
            </div>

            <ul class="nav nav-tabs flex-column flex-sm-row nav-justified" id="myAccountTabs" role="tablist">

                <li class="nav-item">
                    <a class="flex-sm-fill text-sm-center nav-link active" id="myorders-tab" data-toggle="tab" href="#myorders" role="tab" aria-controls="myorders" aria-selected="true">Meus pedidos</a>
                </li>

                <li class="nav-item">
                    <a class="flex-sm-fill text-sm-center nav-link" id="mydata-tab" data-toggle="tab" href="#mydata" role="tab" aria-controls="mydata" aria-selected="false">Dados Pessoais</a>
                </li>

                <li class="nav-item">
                    <a class="flex-sm-fill text-sm-center nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="false">Endereço</a>
                </li>

                <li class="nav-item">
                    <a class="flex-sm-fill text-sm-center nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Atendimento</a>
                </li>

            </ul>
            
            <div class="tab-content" id="tabs">

                {{-- Aba minhas compras --}}
                <div class="tab-pane fade show active" id="myorders" role="tabpanel" aria-labelledby="myorders-tab">

                    <p>&nbsp;</p>

                    <div class="row">

                        <div class="col-12 d-flex justify-content-center">

                            <!-- Tabelas dos Pedidos -->
                            <table class="table" id="table">
                                <thead style="border-bottom: none !important;">
                                    <tr >
                                        <th style="text-align: left; border-bottom: none !important;">Nº</th>
                                        <th style="text-align: left; border-bottom: none !important;">Data</th>
                                        <th style="text-align: left; border-bottom: none !important;">Status</th>
                                        <th style="text-align: left; border-bottom: none !important;"></th>
                                        <th style="text-align: left; border-bottom: none !important;"></th>
                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach($listOrder as $order)
                                        <tr>
                                            <td>{{$order->cd_pedido}}</td>
                                            <td>{{ date( 'd/m/Y' , strtotime($order->dt_compra))}}</td>
                                            <td class="ext-center" style="width: 1% !important;">
                                                @switch($order->cd_status)
                                                    @case(1)
                                                        &nbsp;<i class="fa fa-circle-o text-warning" title="Aguardando pagamento"></i>
                                                    @break
                                                    @case(2)
                                                        &nbsp;<i class="fa fa-circle-o text-info" title="Em análise"></i>
                                                    @break
                                                    @case(3)
                                                        &nbsp;<i class="fa fa-circle-o text-success" title="Paga"></i>
                                                    @break
                                                    @case(4)
                                                        &nbsp;<i class="fa fa-circle-o text-success" title="Disponível"></i>
                                                    @break
                                                    @case(5)
                                                        &nbsp;<i class="fa fa-circle-o text-info" title="Em disputa"></i>
                                                    @break
                                                    @case(6)
                                                        &nbsp;<i class="fa fa-circle-o text-info" title="Devolvida"></i>
                                                    @break
                                                    @case(7)
                                                        &nbsp;<i class="fa fa-circle-o text-danger" title="Reprovado"></i>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td class=" text-center">
                                                <a href="#" class="btn btn-default mt-0 mb-0 p-0" data-toggle="modal" data-target="#modal-default">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                            <td class=" text-center" id="btn_atributos">
                                                <a class="btn btn-default mt-0 mb-0 p-0" href="#"><i class="fa fa-print"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>                 

                    </div>

                    <p>&nbsp;</p><p>&nbsp;</p>

                    <div class="row d-flex justify-content-center">

                        <div class="col-12 col-md-2">

                            <a href="{{route('products.page')}}" class="btn btn-template w-100">Compre agora</a>

                        </div>

                    </div>

                </div>

                {{-- Aba dados pessoais --}}
                <div class="tab-pane fade" id="mydata" role="tabpanel" aria-labelledby="mydata-tab">

                    <p>&nbsp;</p><p>&nbsp;</p>

                    <div class="row d-flex justify-content-center">

                        <div class="col-12 col-md-3">

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUpdateClientData">

                                Atualizar

                            </button>

                        </div>

                    </div>

                </div>

                {{-- Aba endereço --}}
                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">

                    <p>&nbsp;</p>

                    <div class="row">

                        @foreach ($endereco as $key => $e)

                            @if ($e->ic_principal == 1)

                                <div class="col-12 col-md-6 d-flex justify-content-center">

                                    <div class="card w-75" style="border: 1px solid #d59431;">

                                        <div class="card-body">

                                            <h6 class="card-subtitle">

                                                <p class="h3">{{ $e->nm_destinatario }}</p>

                                            </h6>

                                            <p class="card-text">
                                                
                                                {{ $e->ds_endereco }}, {{$e->cd_numero_endereco}}
                                                <br>
                                                {{ $e->nm_bairro }} - {{$e->nm_cidade}}/{{$e->sg_uf}}

                                                <p>&nbsp;</p>

                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUpdateAddress" data-address="{{ $e }}">

                                                    Atualizar endereço

                                                </button>
                                            
                                            </p>

                                        </div>

                                    </div> 

                                </div>
                                
                            @else

                                <div class="col-12 col-md-6 d-flex justify-content-center">

                                    <div class="card w-75">

                                        <div class="card-body">

                                            <h6 class="card-subtitle">

                                                <p class="h3">{{ $e->nm_destinatario }}</p>

                                            </h6>

                                            <p class="card-text">
                                                
                                                {{ $e->ds_endereco }}, {{$e->cd_numero_endereco}}
                                                <br>
                                                {{ $e->nm_bairro }} - {{$e->nm_cidade}}/{{$e->sg_uf}}

                                                <p>&nbsp;</p>

                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUpdateAddress" data-address="{{ $e }}">

                                                    Atualizar endereço

                                                </button>
                                            
                                            </p>

                                        </div>

                                    </div> 

                                </div>
                                
                            @endif

                        @endforeach

                        
                    </div>

                    <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>

                    <div class="row d-flex justify-content-center">

                        <div class="col-12 col-md-3">

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNewAddress">

                                Adicionar novo endereço

                            </button>

                        </div>

                    </div>

                </div>

                {{-- Aba atendimento --}}
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                    <p>&nbsp;</p>

                    <div class="row d-flex justify-content-center">

                        <div class="col-12">

                            <p>Atendimento</p>

                        </div>

                    </div>

                </div>

            </div>

            <p>&nbsp;</p>

        </div>

        {{-- Modais --}}

        <!-- Modal novo endereço -->
        @component('pages.app.components.modals.newaddress')                                                
        @endcomponent

        <!-- Modal aualizar endereço -->
        @component('pages.app.components.modals.updateaddress')                                                
        @endcomponent

        <!-- Modal aualizar dados cliente -->
        @component('pages.app.components.modals.updateclientdata')                                                
        @endcomponent

    </section>

    <script src="{{asset('js/app/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/app/waves.js')}}"></script>
    <script src="{{asset('js/app/input.js')}}"></script>
    <script src="{{asset('js/app/form-validation.js')}}"></script>

    <script>
    
        $('#modalUpdateAddress').on('show.bs.modal', function (e) {

            let button = $(e.relatedTarget)
            let dataAddress = button.data('address')
        
            let modal = $(this)

            modal.find('.nm_destinatario').val(dataAddress.nm_destinatario)
            modal.find('.cd_cep').val(dataAddress.cd_cep)
            modal.find('.nm_cidade').val(dataAddress.nm_cidade)
            modal.find('.sg_uf').val(dataAddress.sg_uf)
            modal.find('.ds_endereco').val(dataAddress.ds_endereco)
            modal.find('.cd_numero_endereco').val(dataAddress.cd_numero_endereco)
            modal.find('.ds_complemento').val(dataAddress.ds_complemento)
            modal.find('.ds_ponto_referencia').val(dataAddress.ds_ponto_referencia)
            modal.find('.nm_bairro').val(dataAddress.nm_bairro)

        })
    
    </script>

@stop
