<!DOCTYPE html>

<html lang="pt-br">

    <head>

        @include('partials._head')

    </head>

    <body>

        <div id="wrapper">

            @include('partials._header')

        </div>

        <div class="container">

            @yield('corpo')

        </div>

        @include('partials._scripts')

    </body>

</html>