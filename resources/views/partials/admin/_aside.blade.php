<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('img/admin/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- /.search form -->

        <!-- sidebar menu: : style can be found in sidebar.less -->

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU</li>
            <li>
                <a href="{{route('admin.dashboard')}}">
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
                    <li><a href="{{route('admin.cadProd')}}"><i class="fa fa-plus-square"></i>Cadastrar</a></li>
                    <li><a href="{{route('admin.cadProd')}}"><i class="fa fa-edit"></i>Alterar</a></li>
                   <li><a href="{{route('admin.listProd')}}"><i class="fa fa-list-alt"></i>Lista de Produtos</a></li>
                    <li class="treeview">
                        <a href="{{route('admin.cadProd')}}"><i class="fa fa-diamond">
                            </i>Atributos<span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('admin.cadCatego')}}"><i class="fa fa-tag"></i>Cadastrar Categorias</a></li>
                            <li><a href="{{route('admin.cadCor')}}"><i class="fa fa-paint-brush"></i>Cadastrar Cores</a></li>
                            <li><a href="{{route('admin.cadTamanho')}}"><i class="fa fa-arrows-h"></i>Cadastrar Tamanhos</a></li>
                            <li><a href="{{route('admin.cadEmbalagem')}}"><i class="fa fa-cube"></i>Cadastrar Embalagem</a></li>
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
                    <li><a href="{{route('usuario.dados')}}"><i class="fa fa-edit"></i>Alterar Dados do Usuário</a></li>
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
                    <li><a href="{{route('admin.indexMenu')}}"><i class="fa fa-th-list"></i>Menu</a></li>
                    <li><a href="{{route('admin.indexBanner')}}"><i class="fa fa-picture-o"></i>Banner</a></li>
                    <li><a href="{{route('admin.indexConfigproduto')}}"><i class="fa fa-th-large"></i>Produtos Home</a></li>
                    <li><a href="{{route('admin.indexHotpost')}}"><i class="fa fa-newspaper-o"></i>Hot Post</a></li>
                </ul>
            </li>
        </ul>
    </section>
<!-- /.sidebar -->
</aside>