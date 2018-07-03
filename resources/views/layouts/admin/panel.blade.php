<!DOCTYPE html>

<html lang="pt-br">

    <head>

        @include('partials.admin._headpanel')

    </head>

    <body class="hold-transition login-page">

        <div class="top_logo" align="center">

            <a href="{{route('index')}}"><img src="{{asset('img/app/core-img/logo.png')}}" alt="" style="width: 119px !important; height: 102px !important; margin: 2% 0 -7% 0 !important"></a>

        </div>

        @yield('content')

        <!-- jQuery 3 -->


    </body>

</html>
