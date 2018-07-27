@extends('layouts.admin.app')

@section('content')


    <link rel="stylesheet" href="{{asset('css/admin/TreeViewEstilo.css')}}">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 style="padding: 0 20px"><i class="fa fa-tags"></i>&nbsp;&nbsp;Menus</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Produtos</a></li>
                <li><a href="#">Atributos</a></li>
                <li><a class="active">Cadastrar Menus</a></li>
            </ol>
        </section>

        <!-- Cadastrar Categorias -->
        <section class="content">
            @include('partials.admin._alerts')

            <div class="row">
                <!-- Cadastrar Categoria -->
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Menu</h3>
                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Menu</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                        <select id="categorias" class="form-control select2-selection select2-selection--single" name="cd_menu" >
                                            <option selected value="0"></option>
                                            @foreach($menus as $menu)
                                                <option value="{{ $menu->cd_menu }}">{{ $menu->nm_menu}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <label id="texto_informativo" style="font-size: 12px"><i style="color: red !important;">*</i>&nbsp;Permitido no máximo 5 menus</label>
                            </div>

                            <form id="formMenu" class="form-horizontal" action="{{ route('menu.save') }}" method="post">
                                {{ csrf_field() }}
                                <div class="col-md-6">
                                    <div class="form-group" style="margin-right: 0 !important;">
                                        <label>Cadastrar/Alterar</label>
                                        <div class="input-group-prepend">
                                            <input class="form-control" type="hidden" id="delCat" name="delCat" value="0">
                                            <input class="form-control" type="hidden" id="cd_categoria" name="cd_menu">
                                            <div class="input-group col-md-12">
                                                <input type="text" id="nm_categoria" class="form-control" name="nm_menu" maxlength="35">
                                                {{--<span class="input-group-btn">
                                                  <button id="" type="submit" class="btn  btn-flat" disabled><i class="fa fa-close"></i></button>
                                                </span>--}}
                                            </div>

                                        </div>

                                    </div>

                                    <button id="btnSalvarCat" type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                    <button id="btnDelCat" type="button" class="btn btn-danger pull-right" disabled style="margin-right: 10px"><i class="fa fa-trash"></i>&nbsp;&nbsp;Deletar</button>
                                    <br>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- Associação Menu > Categoria -->
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Associação</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <form id="fCat" class="form-horizontal" action="{{ route('menucat.associate') }}" method="post">
                                {{ csrf_field() }}
                                <div>
                                    <div>
                                        <div class="col-md-6">
                                            <div class="input-group-prepend">
                                                <label>Menu Principal</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                                    <select id="categorias" class="form-control form-control select2-selection select2-selection--single" style="width: 100%;" name="fk_cd_menu" >
                                                        <option selected value="0"></option>
                                                        @foreach($menus as $menu)
                                                            <option value="{{ $menu->cd_menu }}">{{ $menu->nm_menu }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="margin-right: 0 !important;">
                                        <label>Associar Categoria</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                            <select id="subcategorias" class="form-control select2 form-control select2-selection select2-selection--single" multiple="multiple" style="width: 100%;" name="fk_cd_categorias[]" >
                                                @foreach($categorias as $categoria)
                                                    <option value="{{ $categoria->cd_categoria }}">{{ $categoria->nm_categoria }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button id="btnSalvarAssoc" type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Forma Apresentação</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="col-md-12">
                                <label>Escolha a forma de apresentação do menu de navegação no site:</label>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        @if($menuNavegacao == 1)
                                            <input type="radio" id="radioMenu" name="radioNav" val="1" checked>
                                            <label for="radioMenu">Menu</label><br>
                                            <input type="radio" id="radioCat" name="radioNav" val="0">
                                            <label for="radioCat">Categoria</label>
                                        @else
                                            <input type="radio" id="radioMenu" name="radioNav" val="1">
                                            <label for="radioMenu">Menu</label><br>
                                            <input type="radio" id="radioCat" name="radioNav" val="0" checked>
                                            <label for="radioCat">Categoria</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lista das categorias cadastradas -->
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Lista de Categorias</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    @foreach($categorias as $categoria)
                                        <ul class="treeview lista">
                                            <li id="liCategoria" onclick="listarSubCategorias('{{$categoria->cd_categoria}}', this)"><a href="#">
                                                    {{$categoria->nm_categoria}}
                                                    <ul class="ulFilho"></ul>
                                                </a>
                                            </li>
                                        </ul>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <script src="{{ asset('js/admin/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/admin/TreeViewScript.js') }}"></script>
    <script src="{{asset('js/admin/jquery.blockUI.js')}}"></script>
    <script src="{{asset('js/admin/sweetalert.min.js')}}"></script>
    <script>
        var arrayCat = [];
        var verificaCat = false;
        function listarSubCategorias(categoria, elementLi){

            for(var i=0; i < arrayCat.length; i++){
                if(categoria == arrayCat[i]){
                    verificaCat = true;
                }
            }

            if(!verificaCat) {
                $.ajax({
                    url: '{{ url('/admin/subcat') }}/' + categoria,
                    type: 'GET',
                    success: function (data) {
                        //console.log(data.subcat);
                        //console.log($(elementLi).find(".filho"));
                        $(elementLi).find(".filho").empty();
                        $.each(data.subcat, function (index, subcategoria) {
                            $(elementLi).append(`<ul><li class="filho">` + subcategoria.nm_sub_categoria + `</li></ul>`);
                        })

                        arrayCat.push(categoria);
                    }
                });
            }
            verificaCat = false;
        }

       $('#radioMenu').click(function(){
            $.ajax({

            })
       });

        $('#btnSalvarCat').click(function(){
            $.blockUI({
                message: 'Salvando...',
                css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: .5,
                    color: '#fff'
                } });

            setTimeout($.unblockUI, 12000);
        });

        $('#btnSalvarAssoc').click(function(){
            $.blockUI({
                message: 'Salvando...',
                css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: .5,
                    color: '#fff'
                } });

            setTimeout($.unblockUI, 12000);
        });

        $('#categorias').change(function (e) {
            e.preventDefault();
            $('#btnSalvarCat').removeAttr("disabled");
            $cd_categoria = $(this).val();
            if($cd_categoria == 0) {
                $("#btnDelCat").attr("disabled", "disabled");
                //$("#btnDelCat").removeClass("btn-danger");
            }else{
                $("#btnDelCat").removeAttr("disabled");//.addClass("btn-danger");
            }
            $("#delCat").val($('#delCat').val());
            $("#cd_categoria").val($('#categorias option:selected').val());
            $("#nm_categoria").val($('#categorias option:selected').text());
        });


        //Carrega as categorias já cadastrados dentro de um array
        var arrayCadCat = [];
        $('#nm_categoria').one("click", function(){
            carregaArray($('#categorias option'), arrayCadCat);
        });

        //Ao digitar faz a verificação se determinada categoria já existe
        var verificaCat = false;
        $('#nm_categoria').on("input", function(){
            verificaArray($('#nm_categoria'), arrayCadCat, verificaCat, $('#btnSalvarCat'));
        });

        //Carrega as categorias já cadastrados dentro de um array
        var arrayCadSub = [];
        $('#nm_sub_categoria').one("click", function(){
            carregaArray($('#subcategorias option'), arrayCadSub);
        });

        //Ao digitar faz a verificação se determinada sub-categoria já existe
        var verificaSub = false;
        $('#nm_sub_categoria').on("input", function(){
            verificaArray($('#nm_sub_categoria'), arrayCadSub, verificaSub, $('#btnSalvarSub'));
        });

        //Função para carregar os arrays
        function carregaArray(opcoes, array){
            opcoes.each(function(){
                array.push($(this).text().toUpperCase());
            });
        }

        //Função que faz a verificação dos arrays
        function verificaArray(opcInput, array, verifica, botao){
            var regInicio = new RegExp("^\\s+");
            var regMeio = new RegExp("\\s+");
            var regFinal = new RegExp("\\s+$");
            for(var i = 0; i < array.length; i++){
                if(opcInput.val().toUpperCase().replace(regInicio, "").replace(regFinal, "").replace(regMeio, " ") == array[i])
                    verifica = true;
            }
            if(verifica)
                botao.attr("disabled", "disabled");
            else
                botao.removeAttr("disabled");

            verifica = false;
        }

        $("#btnDelCat").click(function(){
            $("#delCat").val("1");
            var delCat = $('#delCat').val();
            var cdMenu = $('#cd_categoria').val();
            var nmMenu = $('#nm_categoria').val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            console.log("Token: " + CSRF_TOKEN);
            console.log("Id: " + cdMenu);
            console.log("Nome: " + nmMenu);
            console.log("Deleção: " + delCat);

            swal({
                title: "Você tem certeza que deseja deletar ?",
                text: "Uma vez deletada, você não terá mais acesso a essa categoria.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#formMenu').submit();
                    }
                });

        });

        $(function(){
            $('.select2').select2();
        })
    </script>
@stop
