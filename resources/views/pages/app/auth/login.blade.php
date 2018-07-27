@extends('layouts.app.app')

@section('content')

    <link rel="stylesheet" href="{{asset('css/app/input.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/_all.css')}}">

    <section class="new_arrivals_area section_padding_100_0 clearfix">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section_heading text-center">
                        <h3><i class="fa fa-unlock-alt"></i>&nbsp; Login Cliente</h3>
                    </div>
                </div>
            </div>

            <p>&nbsp;</p>

            <form action="{{ route('client.login.submit') }}" method="post">
                {{ csrf_field() }}
            
                <!-- E-mail login  -->
                <div class="row">
                    <div class="col-12 col-md-4 offset-md-4">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="email" class="form-control" name="email" required maxlength="50">
                                <label class="form-label">Email</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Senha login -->
                <div class="row">
                    <div class="col-12 col-md-4 offset-md-4">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="password" class="form-control" name="password" required maxlength="50" width="">
                                <label class="form-label">Senha</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                 <div class="row">
                    <div class="col-md-8" style="padding-left: 34%">
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="customControlAutosizing" checked>
                            <label class="custom-control-label" for="customControlAutosizing">Lembrar de mim</label>
                        </div>
                    </div>
                </div>
                <p>&nbsp;</p>

                <!-- Botão Logar -->
                <div class="row">
                    <div class="col-12 text-center">
                        <div>
                            <button type="submit" id="btn_salvar" class="btn btn-danger" style="width: 290px; background-color: #d89531; border-radius: 0px">Logar</button>
                        </div>
                    </div>
                </div>
                
                <br>

                <div class="row">
                    <div class="col-12 text-center">
                        <div class="checkbox icheck">
                            <a href="{{ route('client.register') }}">Registre uma nova conta</a>
                        </div>
                    </div>
                </div>
                
                <p>&nbsp;</p>
            
            </form>

        </div>

    </section>

    <script src="{{asset('js/app/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/app/waves.js')}}"></script>
    <script src="{{asset('js/app/input.js')}}"></script>
    <script src="{{asset('js/app/form-validation.js')}}"></script>
    <script src="{{asset('js/admin/icheck.min.js')}}"></script>
    <script src="{{asset('js/admin/jquery.inputmask.js')}}"></script>

    <script>
        function(){
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-blue'
            })
        }
    </script>

@stop
