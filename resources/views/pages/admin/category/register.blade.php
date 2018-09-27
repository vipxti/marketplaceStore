@extends('layouts.admin.app')

@section('content')


    <link rel="stylesheet" href="{{asset('css/admin/TreeViewEstilo.css')}}">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
           <h1 style="padding: 0 20px"><i class="fa fa-tags"></i>&nbsp;&nbsp;Categorias</h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Produtos</a></li>
                <li><a href="#">Atributos</a></li>
                <li><a class="active">Cadastrar Categorias</a></li>
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
                                <h3 class="box-title">Categoria</h3>
                                <div class="box-tools">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Categoria</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                            <select id="categorias" class="form-control select2-selection select2-selection--single" name="cd_categoria" >
                                                <option selected value="0"></option>
                                                @foreach($categorias as $categoria)
                                                    <option value="{{ $categoria->cd_categoria }}">{{ $categoria->nm_categoria }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <form id="fCat" class="form-horizontal" action="{{ route('category.save') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-right: 0 !important;">
                                            <label>Cadastrar/Alterar</label>
                                            <div class="input-group-prepend">
                                                    <input class="form-control" type="hidden" id="delCat" name="delCat" value="0">
                                                <input class="form-control" type="hidden" id="cd_categoria" name="cd_categoria">
                                                <div class="input-group col-md-12">
                                                    <input type="text" id="nm_categoria" class="form-control" name="nm_categoria" maxlength="35">
                                                    {{--<span class="input-group-btn">
                                                      <button id="" type="submit" class="btn  btn-flat" disabled><i class="fa fa-close"></i></button>
                                                    </span>--}}
                                                </div>

                                            </div>
                                        </div>
                                        <button id="btnSalvarCat" type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                        <button id="btnDelCat" type="button" class="btn btn-danger pull-right" disabled style="margin-right: 10px"><i class="fa fa-trash"></i>&nbsp;&nbsp;Deletar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>

               <!-- Cadastrar Sub-Categoria -->
               <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Sub-Categoria</h3>
                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sub-Categoria</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                        <select id="subcategorias" class="form-control form-control select2-selection select2-selection--single" style="width: 100%;" name="cd_sub_categoria" >
                                            <option value=""></option>
                                            @foreach($subcategorias as $subcategoria)
                                                <option value="{{ $subcategoria->cd_sub_categoria }}">{{ $subcategoria->nm_sub_categoria }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <form id="fCat" class="form-horizontal" action="{{ route('subcategory.save') }}" method="post">
                                {{ csrf_field() }}
                                <div class="col-md-6">
                                    <div class="form-group" style="margin-right: 0 !important;">
                                        <label>Cadastrar/Alterar</label>
                                        <div class="input-group-prepend">
                                            <input class="form-control" type="hidden" id="delSubCat" name="delSubCat" value="0">
                                            <input class="form-control" type="hidden" id="cat_sub_Id" name="cd_sub_categoria">
                                            <div class="input-group col-md-12">
                                                <input type="text" id="nm_sub_categoria" class="form-control" name="nm_sub_categoria" maxlength="35">
                                               {{-- <span class="input-group-btn">
                                                      <button id="" type="submit" class="btn btn-flat" disabled><i class="fa fa-close"></i></button>
                                                </span>--}}
                                            </div>
                                        </div>
                                    </div>
                                    <button id="btnSalvarSub" type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                    <button id="btnDelSubCat" type="button" class="btn btn-danger pull-right" disabled style="margin-right: 10px"><i class="fa fa-trash"></i>&nbsp;&nbsp;Deletar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>

            <div class="row">
                <!-- Associação Categoria > SubCategoria -->
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
                            <form id="fCat" class="form-horizontal" action="{{ route('catsubcat.associate') }}" method="post">
                                {{ csrf_field() }}
                                <div>
                                    <div>
                                        <div class="col-md-6">
                                            <div class="input-group-prependp">
                                                <label>Categoria Principal</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                                    <select id="categorias" class="form-control form-control select2-selection select2-selection--single" style="width: 100%;" name="cd_categoria" >
                                                        <option selected value="0"></option>
                                                        @foreach($categorias as $categoria)
                                                            <option value="{{ $categoria->cd_categoria }}">{{ $categoria->nm_categoria }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="margin-right: 0 !important;">
                                        <label>Associar Sub-Categoria</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                            <select id="subcategorias" class="form-control select2 form-control select2-selection select2-selection--single" multiple="multiple" style="width: 100%;" name="cd_sub_categorias[]" >
                                                @foreach($subcategorias as $subcategoria)
                                                    <option value="{{ $subcategoria->cd_sub_categoria }}">{{ $subcategoria->nm_sub_categoria }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button id="btnSalvarAssoc" type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                                    <button id="btnModalRemoverAssoc" type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#modal-default" style="margin-right: 10px"><i class="fa fa-trash"></i>&nbsp;&nbsp;Remover</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Moda Variações -->
                <form action="{{route('catsubcat.remove.assoc')}}" method="post" enctype="multipart/form-data">
                    <!-- MODAL ATUALIZA DADOS -->
                    <div class="modal fade" id="modal-default">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Atualizar Dados do Produto</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">

                                        <div class="col-md-12">

                                        {{ csrf_field() }}

                                            <div class="row">

                                                <!-- Códigos SKU e Ean  -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Categoria</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                                            <select id="categoriasModal" class="form-control select2-selection select2-selection--single" name="cd_categoria" >
                                                                <option selected value="0"></option>
                                                                @foreach($categorias as $categoria)
                                                                    <option value="{{ $categoria->cd_categoria }}">{{ $categoria->nm_categoria }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Sub-Categoria</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                                            <select id="subcategoriasModal" class="form-control form-control select2-selection select2-selection--single" style="width: 100%;" name="cd_sub_categoria" >
                                                                <option value=""></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="btnSairModal" type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>
                                    <button id="btnRemoverAssoc" type="submit" class="btn btn-danger">Remover Associação</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </form>

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
                                            <li id="liCategoria" onclick="listarSubCategorias({{$categoria->cd_categoria}}, this)"><a href="#">
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

        $('#btnSalvarSub').click(function(){
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
            var regLetraNumEspaco = new RegExp(/^[a-zA-Z0-9 ]+$/);

            if(!regLetraNumEspaco.exec($(this).val())){
                $('#btnSalvarCat').attr('disabled', 'disabled');
            }
            else{
                $('#btnSalvarCat').removeAttr('disabled');
            }
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

            var regLetraNumEspaco = new RegExp(/^[a-zA-Z0-9 ]+$/);

            if(!regLetraNumEspaco.exec($(this).val())){
                $('#btnSalvarSub').attr('disabled', 'disabled');
            }
            else{
                $('#btnSalvarSub').removeAttr('disabled');
            }
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
            var cdCat = $('#cd_categoria').val();
            var nmCat = $('#nm_categoria').val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            console.log("Token: " + CSRF_TOKEN);
            console.log("Id: " + cdCat);
            console.log("Nome: " + nmCat);
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

                        $.ajax({
                            url: '{{route('category.save')}}',
                            type: 'post',
                            data: {_token: CSRF_TOKEN, cd_categoria: cdCat, nm_categoria: nmCat, delCat: delCat},
                            dataType: 'json',
                            success: function(e){
                                console.log(e.message);

                                if(e.message == true){
                                    swal("Categoria deletada com sucesso!", {
                                        icon: "success",
                                    }).then(()=>{
                                        window.location.href = '{{url('admin/category')}}';
                                    });
                                }
                                else {
                                    swal("Erro ao deletar a categoria!", {
                                        icon: "warning",
                                    }).then(()=>{
                                        window.location.href = '{{url('admin/category')}}';
                                    });
                                }

                            }
                        });

                    }
                });



        });

        $("#subcategorias").change(function(){
            var cdSubCat = $(this).val();
            $('#btnSalvarSub').removeAttr("disabled");
            if(cdSubCat == 0) {
                $("#btnDelSubCat").attr("disabled", "disabled");
                //$("#btnDelSubCat").removeClass("btn-danger");
            }else{
                $("#btnDelSubCat").removeAttr("disabled");//.addClass("btn-danger");
            }
            $("#delSubCat").val($("#delSubCat").val());
            $("#cat_sub_Id").val($("#subcategorias option:selected").val());
            $("#nm_sub_categoria").val($("#subcategorias option:selected").text());
        });

        $("#btnDelSubCat").click(function(){
            $("#delSubCat").val("1");
            var delSubCat = $('#delSubCat').val();
            var cdSubCat = $('#cat_sub_Id').val();
            var nmSubCat = $('#nm_sub_categoria').val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            console.log("Token: " + CSRF_TOKEN);
            console.log("Id: " + cdSubCat);
            console.log("Nome: " + nmSubCat);
            console.log("Deleção: " + delSubCat);

            swal({
                title: "Você tem certeza que deseja deletar ?",
                text: "Uma vez deletada, você não terá mais acesso a essa sub categoria.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '{{route('subcategory.save')}}',
                            type: 'post',
                            data: {_token: CSRF_TOKEN, cd_sub_categoria: cdSubCat, nm_sub_categoria: nmSubCat, delSubCat: delSubCat},
                            dataType: 'json',
                            success: function(e){
                                console.log(e.message);

                                if(e.message == true){
                                    swal("Sub Categoria deletada com sucesso!", {
                                        icon: "success",
                                    }).then(()=>{
                                        window.location.href = '{{url('admin/category')}}';
                                    });
                                }
                                else {
                                    swal("Erro ao deletar a sub categoria!", {
                                        icon: "warning",
                                    }).then(()=>{
                                        window.location.href = '{{url('admin/category')}}';
                                    });
                                }

                            }
                        });

                    }
                });

        });

        //==============================================================================================================
        //AO MUDAR UMA CATEGORIA DO MODAL ELE PESQUISA AS SUBCATEGORIAS ASSOCIADAS A CATEGORIA
        $('#categoriasModal').change(function(){
            buscaSubCategoria($(this).val());
        });

        function buscaSubCategoria(cdCategoria){
            $.ajax({
                url: '{{ url('/admin/subcat') }}/' + cdCategoria,
                type: 'GET',
                success: function (data) {

                    $('#subcategoriasModal').empty();

                    $.each(data.subcat, function(index, subcategoria) {

                        $('#subcategoriasModal').append(`<option value="` + subcategoria.cd_sub_categoria + `">` + subcategoria.nm_sub_categoria + `</option>`);
                    })

                }
            });
        }

        $(function(){
            $('.select2').select2();
        })
    </script>
@stop
