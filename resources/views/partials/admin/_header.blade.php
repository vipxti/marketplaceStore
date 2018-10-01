<header class="main-header">
    <!-- Logo -->
  <a href="{{route('admin.dashboard')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Mak</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Maktub</b>Admin</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          @if(Auth::guard('admin')->check())

              <li class="dropdown user user-menu">
                <a href="" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{ asset('img/admin/' . Auth::guard('admin')->user()->im_usuario)  }}" class="user-image" alt="User Image">
                  <span class="hidden-xs"></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{ asset('img/admin/' . Auth::guard('admin')->user()->im_usuario)  }}" class="user-image" alt="User Image">
                    <p>
                      <small>{{ Auth::guard('admin')->user()->nm_usuario }}</small>
                      <small>{{ Auth::guard('admin')->user()->email }}</small>
                    </p>
                  </li>
                </ul>
              </li>

            @else

              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="" class="user-image" alt="User Image">
                  <span class="hidden-xs"></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="" class="user-image" alt="User Image">
                    <p>
                      <small>Membro desde Out 2018</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Sair</a>
                    </div>
                  </li>
                </ul>
              </li>

            @endif

          <!-- User Account: style can be found in dropdown.less -->

          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="{{ route('index') }}"><i class="fa fa-home"></i></a>
          </li>
          <li>
            <a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>