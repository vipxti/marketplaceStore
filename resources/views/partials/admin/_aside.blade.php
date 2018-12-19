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
                    <li><a href="{{ route('products.list') }}"><i class="fa fa-list-alt"></i>Lista de Produtos</a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-diamond">
                            </i>Atributos<span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('category.register') }}"><i class="fa fa-tag"></i>Categorias</a></li>
                            <li><a href="{{ route('color.page') }}"><i class="fa fa-paint-brush"></i>Cores</a></li>
                            <li><a href="{{ route('size.register') }}"><i class="fa fa-arrows-h"></i>Tamanhos</a></li>
                            <li><a href="{{ route('marca.page') }}"><i class="fa fa-puzzle-piece"></i>Marcas</a></li>
                        </ul>
                    </li>
                </ul>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-building" aria-hidden="true"></i> <span>Empresa</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('company.data')}}"><i class="fa fa-address-card-o" aria-hidden="true"></i>Dados Cadastrais</a></li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-user-circle-o"></i><span>Usuários</span>
                                    <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{route('admin.data')}}"><i class="fa fa-edit"></i>Alterar Dados do Usuário</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('listar.clientes') }}">
                            <i class="fa fa-users"></i>
                            <span>Clientes</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-book"></i>
                            <span>Pedidos</span>
                            <span class="pull-right-container">
                                <small id="sPendente" class="label pull-right bg-yellow" title="Pendente"></small>
                                <small id="sAprovado" class="label pull-right bg-green" title="Aprovado"></small>
                                <small id="sReprovado" class="label pull-right bg-red" title="Reprovado"></small>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('order.list')}}"><i class="fa fa-file-text"></i>Listar Pedidos</a></li>
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
                            <li><a href="{{ route('video.edit') }}"><i class="fa fa-picture-o"></i>Video</a></li>
                            {{--<li><a href="{{ route('hotpost.edit') }}"><i class="fa fa-newspaper-o"></i>Hot Post</a></li>--}}
                            <li><a href="{{route('vitrine.page')}}"><i class="fa fa-th"></i>Vitrine</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="{{route('product.list.bling')}}">
                            <i class="fa fa-exchange"></i><span>Integração</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="treeview">
                                <a href="javascript:void(0)">
                                    <i class="fa fa fa-exclamation" style="color: #a1bf1a !important;"></i><span>Bling</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="treeview">
                                        <a href="javascript:void(0)">
                                            <i class="fa fa-share-square-o"></i>
                                            Cadastros
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li>
                                                <a href="{{route('channel.bling')}}">
                                                    <i class="fa fa-key"></i>
                                                    Cadastrar Canais
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route('index.store.bling')}}">
                                                    <i class="fa fa-home"></i>
                                                    Cadastrar Lojas
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="treeview">
                                        <a href="javascript:void(0)">
                                            <i class="fa fa-search"></i>
                                            Busca de Produtos
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li>
                                                <a href="{{route('bond.category.bling')}}">
                                                    <i class="fa fa-tags"></i>
                                                    Vincular Categorias
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route('product.list.bling')}}">
                                                    <i class="fa fa-search"></i>
                                                    Buscar Produtos
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="{{route('order.bling')}}">
                                            <i class="fa fa-file-text"></i>
                                            Buscar Pedidos
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('index.atualizaProd.bling')}}">
                                            <i class="fa fa-refresh"></i>
                                            Atualizar Produtos
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('relatorio.precos.bling')}}">
                                            <i class="fa fa-pencil"></i>
                                            Relatorio de Preços
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="javascript:void(0)" style="padding-left: 8px;">
                                    <img src="{{asset('img/admin/pagseguro.png')}}" style="width: 18px; height: 15px;">
                                    <span>&nbsp;&nbsp;PagSeguro</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <a href="{{route('pagseguro.page')}}">
                                            <i class="fa fa-file-text"></i>
                                            Pedidos PagSeguro
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="javascript:void(0)" style="padding-left: 8px;">
                                    <img src="{{asset('img/admin/google shop.png')}}" style="width: 18px; height: 15px;">
                                    <span>&nbsp;&nbsp;Google Shop</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <a href="{{route('googleshop.page')}}">
                                            <i class="fa fa-file-code-o"></i>
                                            Gerar XML
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {{--<li class><a href="{{ route('product.list.bling') }}"><i class="fa fa fa-exclamation" style="color: #a1bf1a !important;"></i>Bling</a></li>--}}
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-trophy"></i><span>Sorteio</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('lottery.participant.page') }}"><i class="fa fa-user-plus"></i>Cadastrar Participante</a></li>
                            <li><a href="{{ route('lottery.prize.page') }}"><i class="fa fa-check-square-o"></i>Gerar Sorteio</a></li>
                        </ul>
                    </li>
                </ul>
    </section>
<!-- /.sidebar -->
</aside>
<script>
    $( document ).ready(function() {
        $.ajax({
            url: '{{ route('order.modal.status') }}',
            type: 'get',
            success: function(data){
                let stTotalPedido = data.stPedido;
                let aprovado = 0;
                let reprovado = 0;
                let pendente = 0;
                $.each( stTotalPedido, function( key, value ) {
                    switch(value.cd_status) {
                        case 1:
                            pendente+=1;
                            $("#sPendente").html(pendente);
                            break;
                        case 3:
                            aprovado+=1;
                            $("#sAprovado").html(aprovado);
                            break;
                        case 7:
                            reprovado+=1;
                            $("#sReprovado").html(reprovado);
                            break;
                        default:
                            $("#sPendente").html(pendente);
                            $("#sAprovado").html(aprovado);
                            $("#sReprovado").html(reprovado);
                    }
                });
            }
        });
    });
</script>