@extends('layouts.admin.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Cadastrar Usuário</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="#">Usuário</a></li>
                <li class="active">Cadastrar Usuário</li>
            </ol>
        </section>

        <!-- CADASTRO USUARIO -->

        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Cadastrar</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <form action="{{ route('product.save') }}" method="post">
                        {{ csrf_field() }}

                     <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Celular 1</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                    <input type="number" class="form-control" name="cd_celular1" required maxlength="11">
                                </div>
                            </div>
                        </div>

                         <div class="col-md-3">
                             <div class="form-group">
                                 <label>Celular 2</label>
                                 <div class="input-group">
                                     <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                     <input type="number" class="form-control" name="cd_celular2" maxlength="11">
                                 </div>
                             </div>
                         </div>
                     </div>


                     <div class="col-md-12">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>CEP</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="text" maxlength="9" class="form-control" name="cd_cep"">
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <label>Cidade</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa  fa-map-signs"></i></span>
                                    <select class="form-control select2" name="nm_cidade" >
                                        <option selected="selected" value="1">Alabama</option>
                                        <option value="2">Alaska</option>
                                        <option value="3">California</option>
                                        <option value="4">Delaware</option>
                                        <option value="5">Tennessee</option>
                                        <option value="6">Texas</option>
                                        <option value="7">Washington</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Endereço</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                        <input type="text" class="form-control" name="ds_endereco">
                                    </div>
                                </div>
                            </div>
                     </div>

                     <div class="col-md-12">

                            <div class="col-md-3">
                                <label>Bairro</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-street-view"></i></span>
                                    <select class="form-control select2" name="nm_bairro" >
                                        <option selected="selected" value="1">Alabama</option>
                                        <option value="2">Alaska</option>
                                        <option value="3">California</option>
                                        <option value="4">Delaware</option>
                                        <option value="5">Tennessee</option>
                                        <option value="6">Texas</option>
                                        <option value="7">Washington</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <label>País</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map"></i></span>
                                    <select class="form-control select2" name="nm_pais" >
                                        <option selected="selected" value="1">Alabama</option>
                                        <option value="2">Alaska</option>
                                        <option value="3">California</option>
                                        <option value="4">Delaware</option>
                                        <option value="5">Tennessee</option>
                                        <option value="6">Texas</option>
                                        <option value="7">Washington</option>
                                    </select>
                                </div>
                            </div>
                     </div>

                        <div>&nbsp;</div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Foto Usuário</label>
                                <div class="input-group"><div class="file-loading">
                                        <input id="input-41" name="input41[]" type="file" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>

                       <div class="col-md-12 text-right">
                       <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                       </div>

                    </form>
                </div>
            </div>
        </section>
    </div>
@stop
