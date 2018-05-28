<!DOCTYPE html>

<html lang="pt-br">

    <head>

        @include('partials._head')

    </head>

    <body>

        <div id="wrapper">

            @include('partials._header')

        </div>

        @yield('content')

        @include('partials._scripts')

    </body>

</html>