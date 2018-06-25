@extends('layouts.app.app')

@section('content')

    <!-- ****** Area de Produtos ****** -->
    <section class="new_arrivals_area section_padding_100_0 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_heading text-center text-left">
                        <h3><i class="fa fa-sliders"></i>&nbsp; Minha Conta</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-panel">
                        <div class="tabbable-line">
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a href="#tab_default_1" data-toggle="tab">Pedidos</a>
                                </li>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <li>
                                    <a href="#tab_default_2" data-toggle="tab">Compras</a>
                                </li>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <li>
                                    <a href="#tab_default_3" data-toggle="tab">Cadastro</a>
                                </li>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <li>
                                    <a href="#tab_default_4" data-toggle="tab">Endereço</a>
                                </li>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <li>
                                    <a href="#tab_default_5" data-toggle="tab">Atendimento</a>
                                </li>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <li>
                                    <a href="#tab_default_6" data-toggle="tab">Sair</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_default_1">
                                    <p></p>
                                    <p></p>
                                    <p></p>
                                </div>
                                <div class="tab-pane" id="tab_default_2">
                                    <p></p>
                                    <p></p>
                                    <p></p>
                                </div>
                                <div class="tab-pane" id="tab_default_3">
                                    <br>
                                    <br>
                                    <!-- Botões alterar senha e e-mail -->
                                    <div class="col-md-12">
                                        <div>
                                            <button type="submit" class="btn btn-danger" style="width: 150px; background-color: #ff084e"><i class="fa fa fa-edit"></i>&nbsp;&nbsp;Alterar Senha</button>
                                        &nbsp;&nbsp;&nbsp;
                                            <button type="submit" class="btn btn-danger" style="width: 150px; background-color: #ff084e"><i class="fa fa fa-edit"></i>&nbsp;&nbsp;Alterar E-mail</button>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <!-- Nome do Cliente  -->
                                    <div class="col-md-7">
                                        <div>
                                            <div class="form-group">
                                                <label>Nome</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" class="form-control" name="nm_cliente" required maxlength="50">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- E-mail -->
                                    <div class="col-md-7">
                                        <div>
                                            <div class="form-group">
                                                <label>E-mail</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="nm_email" required maxlength="20">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Senha e data de nascimento -->
                                    <div class="col-md-5" >
                                        <form>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <label>Senha</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input type="password" class="form-control" name="ds_senha" required maxlength="20">
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>&nbsp;&nbsp;&nbsp;</td>

                                                    <td>
                                                        <div class="form-group">
                                                            <label>Data de Nascimento</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input type="number" class="form-control" name="dt_nascimento" required maxlength="20">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>

                                    <!-- CPF -->
                                    <div class="col-md-5">
                                        <form>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <div class="form-group" style="width:204px">
                                                            <label>CPF ou CNPJ</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input type="number" class="form-control" name="cd_cpf_cnpj" required maxlength="20">
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>

                                    <!-- Telefone -->
                                    <div class="col-md-5">
                                        <form>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <label>Telefone</label>
                                                            <div class="input-group" style="width: 204px">
                                                                <span class="input-group-addon"></span>
                                                                <input type="number" class="form-control" name="fk_cd_telefone" required maxlength="20">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>

                                    <!-- Foto Cliente -->
                                    <div class="col-md-5">
                                        <div>
                                            <div class="form-group">
                                                <label></label>Foto</label>
                                                <div class="input-group">
                                                    <div class="file-loading">
                                                        <input id="input-41" name="images[]" type="file" accept="image/*" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <!-- Botões Salvar -->
                                    <div class="col-md-5">
                                        <div>
                                            <button type="submit" id="btn_salvar" class="btn btn-danger" style="width: 250px; background-color: #ff084e"><i class="fa fa-save"></i>&nbsp;&nbsp;Cadastrar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_default_4">
                                    <br>
                                    <br>
                                    <!-- Nome do destinatário -->
                                    <div class="col-md-5" style="width: 37.30%">
                                        <div>
                                            <div class="form-group">
                                                <label>Nome do destinatário</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"></span>
                                                    <input type="text" class="form-control" name="" required maxlength="50">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cep e Tipo de endereço -->
                                    <div class="col-md-5" >
                                        <form>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <label>Tipo de endereço</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <select id="categorias" class="form-control select2" required name="">
                                                                    <option value="apatamento">Apartamento</option>
                                                                    <option value="casa">Casa</option>
                                                                    <option value="comercio">Comercio</option>
                                                                    <option value="outro">Outro</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>&nbsp;&nbsp;&nbsp;</td>

                                                    <td>
                                                        <div class="form-group">
                                                            <label>Cep</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input type="number" class="form-control" name="dt_nascimento" required maxlength="20">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                    <br>

                                    <!-- Botões Salvar -->
                                    <div class="col-md-5">
                                        <div>
                                            <button type="submit" id="btn_salvar" class="btn btn-danger" style="width: 375px; background-color: #ff084e"><i class="fa fa-save"></i>&nbsp;&nbsp;Adicionar Endereço</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_default_5">
                                </div>
                                <div class="tab-pane" id="tab_default_6">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- ****** New Arrivals Area End ****** -->


    <!-- ****** Popular Brands Area Start ****** -->
    <section class="karl-testimonials-area section_padding_100">
    </section>
    <!-- ****** Popular Brands Area End ****** -->

    <script>


        $('#quickview').on('show', function (e) {

            var link = e.relatedTarget(),
                $modal = $(this)

            console.log($modal);

        });


    </script>

@stop
