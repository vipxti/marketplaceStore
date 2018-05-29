<!DOCTYPE html>

<html lang="pt-br">

    <head>

        @include('partials.app._head')

    </head>

    <body>

        <div id="wrapper">

            @include('partials.app._header')
            
            @yield('content')
            
            @include('partials.app._footer')

        </div>

        @include('partials.app._scripts')

    </body>

</html>