<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('img/admin/' . Auth::guard('admin')->user()->im_usuario)  }}" class="user-image" alt="User Image">
            </div>
            <div class="pull-left info">
                <p></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- /.search form -->

        <!-- sidebar menu: : style can be found in sidebar.less -->

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU</li>
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-shopping-bag"></i>
                    <span>Produtos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('product.register') }}"><i class="fa fa-plus-square"></i>Cadastrar</a></li>
                    <li><a href="#"><i class="fa fa-edit"></i>Alterar</a></li>
                   <li><a href="{{ route('products.list') }}"><i class="fa fa-list-alt"></i>Lista de Produtos</a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-diamond">
                            </i>Atributos<span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('category.register') }}"><i class="fa fa-tag"></i>Cadastrar Categorias</a></li>
                            <li><a href="{{ route('color.page') }}"><i class="fa fa-paint-brush"></i>Cadastrar Cores</a></li>
                            <li><a href="{{ route('size.register') }}"><i class="fa fa-arrows-h"></i>Cadastrar Tamanhos</a></li>
                        </ul>
                    </li>
                </ul>
                <li class="treeview">
                <a href="#">
                    <i class="fa fa-credit-card"></i> <span>Formas de Pagamento</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Cadastrar</a></li>
                    <li><a href="#"><i class="fa fa-edit"></i>Alterar</a></li>
                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-truck"></i>
                    <span>Pedidos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i>#</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Clientes</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i>#</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-circle-o"></i><span>Usuários</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('user.data')}}"><i class="fa fa-edit"></i>Alterar Dados do Usuário</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-home"></i><span>Configuração Home</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('menu.edit') }}"><i class="fa fa-th-list"></i>Menu</a></li>
                    <li><a href="{{ route('banner.edit') }}"><i class="fa fa-picture-o"></i>Banner</a></li>
                    <li><a href="{{ route('product.config') }}"><i class="fa fa-th-large"></i>Produtos Home</a></li>
                    <li><a href="{{ route('hotpost.edit') }}"><i class="fa fa-newspaper-o"></i>Hot Post</a></li>
                </ul>
            </li>
        </ul>
    </section>
<!-- /.sidebar -->
</aside>