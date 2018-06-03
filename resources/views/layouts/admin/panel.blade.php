<!DOCTYPE html>

<html lang="pt-br">

    <head>

        @include('partials.admin._headpanel')

    </head>

    <body class="hold-transition login-page">

        <div class="top_logo" align="center">

            <a href="#"><img src="{{asset('img/app/core-img/logo.png')}}" alt=""></a>

        </div>

        @yield('content')

        <!-- jQuery 3 -->
        <script src="{{asset('js/admin-js.js')}}"></script>

    </body>

</html>
