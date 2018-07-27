@extends('layouts.app.app')

@section('content')

    <link rel="stylesheet" href="{{asset('css/app/estiloWizard.css')}}">
    <link rel="stylesheet" href="{{asset('css/app/input.css')}}">


    <section class="new_arrivals_area section_padding_100_0 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <!-- cep -->
                    <div class="col-md-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="cep" required>
                                <label class="form-label">Cep</label>
                            </div>
                        </div>
                    </div>

                    <!-- Estado e Cidade -->
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group form-float col-md-6">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="estado" required>
                                    <label class="form-label">Estado</label>
                                </div>
                            </div>

                            <div class="form-group form-float col-md-6">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="cidade" required>
                                    <label class="form-label">Cidade</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rua/Avenida -->
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group form-float col-md-6">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="endereco" required>
                                    <label class="form-label">Rua/Avenida</label>
                                </div>
                            </div>

                            <div class="form-group form-float col-md-6">
                                <div class="form-line">
                                    <input type="numero" class="form-control" name="numero" required>
                                    <label class="form-label">Número</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Complemento -->
                    <div class="col-md-12">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="complemento" required>
                                <label class="form-label">Complemento</label>
                            </div>
                        </div>
                    </div>

                    <!-- Bairro -->
                    <div class="col-md-6">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="bairro" required>
                                <label class="form-label">Bairro</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </section>


    <script src="{{asset('js/app/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/app/waves.js')}}"></script>
    <script src="{{asset('js/app/input.js')}}"></script>
    <script src="{{asset('js/app/form-validation.js')}}"></script>


@stop
