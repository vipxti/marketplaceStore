<!DOCTYPE html>

<html lang="pt-br">

  <head>

    @include('partials.admin._head')
    
  </head>

  <body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">

      @include('partials.admin._header')

      @include('partials.admin._aside')

      @yield('content')

      @include('partials.admin._footer')

    </div>
    <!-- ./wrapper -->

  </body>

</html>
