@extends('layouts.admin.panel')
@section('content')
    <!--login-box -->
    <div class="login-box">
    <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Entre para iniciar sua sessão</p>

            <form action="{{ route('admin.login.submit') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="nm_email" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Senha">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> Lembrar de mim
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center">
                <p>- OU -</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i>Entre usando o Facebook</a>
            </div>
            <!-- /.social-auth-links -->

            <a href="{{ route('admin.password.request') }}">Esqueci a minha senha</a><br>
            <a href="{{ route('admin.register' )}}" class="text-center">Registre uma nova conta</a>

        </div>
        <!-- /.login-box-body -->
    </div>

    <script>
        () => {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '30%' /* optional */
            });
        };
    </script>
    <!-- /.login-box -->
@stop





