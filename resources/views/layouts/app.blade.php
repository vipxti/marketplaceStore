<!DOCTYPE html>

<html lang="pt-br">

    <head>

        @include('partials._head')

    </head>

    <body>

        <div id="wrapper">

            @include('partials._header')
            
            @yield('content')
            
            @include('partials._footer')

        </div>

        @include('partials._scripts')

    </body>

</html>