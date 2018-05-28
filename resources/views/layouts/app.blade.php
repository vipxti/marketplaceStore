<!DOCTYPE html>

<html lang="pt-br">

    <head>

        @include('partials._head')

    </head>

    <body>

        <div id="wrapper">

            @include('partials._header')

            @yield('contentindex')

        </div>

        @include('partials._scripts')

    </body>

</html>