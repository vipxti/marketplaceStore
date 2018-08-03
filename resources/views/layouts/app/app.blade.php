<!DOCTYPE html>

<html lang="pt-br">

    <head>

        @include('partials.app._head')

    </head>

    <body>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K88JHSV" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
        <div id="wrapper">

            @include('partials.app._header')
            
            @yield('content')
            
            @include('partials.app._footer')

        </div>

    </body>

</html>