@extends('layouts.app.app')

@section('content')

    <link rel="stylesheet" href="{{asset('css/app/estiloWizard.css')}}">
    <link rel="stylesheet" href="{{asset('css/app/input.css')}}">

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
                                    <a href="#tab_default_3" data-toggle="tab">Dados Pessoais</a>
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
                                    <!-- Nome do Cliente  -->
                                    <div class="col-md-7">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="nm_cliente" required maxlength="50">
                                                <label class="form-label">Nome</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- E-mail -->
                                    <div class="col-md-7">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="nm_email" required maxlength="20">
                                                <label class="form-label">E-mail</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Senha e data de nascimento -->
                                    <div class="col-md-7" >
                                        <form>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="password" class="form-control" name="ds_senha" required maxlength="20">
                                                                <label class="form-label">Senha</label>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>&nbsp;&nbsp;&nbsp;</td>

                                                    <td>
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="dt_nascimento" required maxlength="20">
                                                                <label class="form-label">Data de Nascimento</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>

                                    <!-- CPF -->
                                    <div class="col-md-7">
                                        <form>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="cd_cpf_cnpj" required maxlength="20">
                                                                <label class="form-label">CPF ou CNPJ</label>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>

                                    <!-- Telefone -->
                                    <div class="col-md-7">
                                        <form>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="fk_cd_telefone" required maxlength="20">
                                                                <label class="form-label">Telefone</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                    <br>

                                    <!-- Foto Cliente -->
                                    <div class="col-md-7">
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

                                    {{--<!-- Botões Salvar -->
                                    <div class="col-md-7">
                                        <input type="button" value="Cadastrar" style="width: 200px">
                                    </div>--}}
                                </div>
                                <div class="tab-pane" id="tab_default_4">
                                    <br>
                                    <br>
                                    <!-- Nome do destinatário -->
                                    <div class="col-md-7">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="" required maxlength="50">
                                                <label class="form-label">Nome do destinatário</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Nome -->
                                    <div class="col-md-7">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="number" class="form-control" name="cep" required>
                                                <label class="form-label">Cep</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Estado e Cidade -->
                                    <div class="col-md-7">
                                        <div class="row">
                                            <div class="form-group form-float col-md-6">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="estado" required>
                                                    <label class="form-label">Estado</label>
                                                </div>
                                            </div>

                                            <div class="form-group form-float col-md-6">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="cidade" required>
                                                    <label class="form-label">Cidade</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Complemnto -->
                                    <div class="col-md-7">
                                        <div class="row">
                                            <div class="form-group form-float col-md-6">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="endereco" required>
                                                    <label class="form-label">Rua/Avenida</label>
                                                </div>
                                            </div>

                                            <div class="form-group form-float col-md-6">
                                                <div class="form-line">
                                                    <input type="numero" class="form-control" name="numero" required>
                                                    <label class="form-label">Número</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Complemento -->
                                    <div class="col-md-7">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="complemento" required>
                                                <label class="form-label">Complemento</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Bairro -->
                                    <div class="col-md-7">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="bairro" required>
                                                <label class="form-label">Bairro</label>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <!-- Botões Salvar -->
                                    <div class="col-md-5">
                                        <input type="button" value="Adicionar Endereço" style="width: 200px;">
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




    <section class="karl-testimonials-area section_padding_100">
    </section>

    <script src="{{asset('js/app/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/app/waves.js')}}"></script>
    <script src="{{asset('js/app/input.js')}}"></script>
    <script src="{{asset('js/app/form-validation.js')}}"></script>

    <script>


        $('#quickview').on('show', function (e) {

            var link = e.relatedTarget(),
                $modal = $(this)

            console.log($modal);

        });


    </script>

@stop
