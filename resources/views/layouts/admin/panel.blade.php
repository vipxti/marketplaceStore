<!DOCTYPE html>

<html lang="pt-br">

    <head>

        @include('partials.admin._headpanel')

    </head>

    <body class="hold-transition login-page">

        <div class="top_logo" align="center">

            <a href="{{route('index')}}"><img src="{{asset('img/app/core-img/logo1.png')}}" alt="" style="width: 175px !important; height: 100px !important; margin: 3% 0 -4% 0 !important"></a>

        </div>

        @yield('content')

        <!-- jQuery 3 -->


    </body>

</html>
