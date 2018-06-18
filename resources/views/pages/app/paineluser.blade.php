@extends('layouts.app.app')

@section('content')


    <!-- ****** Quick View Modal Area Start ****** -->
    <div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="modal-body">
                    <div class="quickview_body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-5">
                                    <div class="quickview_pro_img">
                                        <img id="imgProdModal" src="" alt="">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="quickview_pro_des">
                                        <h4 class="title">Boutique Silk Dress</h4>
                                        <div class="top_seller_product_rating mb-15">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        <h5 class="price">R$ 0000</h5>
                                        <p>Desc prod</p>
                                        <a href="#">Ver detalhes completos do produto</a>
                                    </div>
                                    <!-- Add to Cart Form -->
                                    <form class="cart" method="post">
                                        <div class="quantity">
                                            <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>

                                            <input type="number" class="qty-text" id="qty" step="1" min="1" max="12" name="quantity" value="1">

                                            <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                        </div>
                                        <button type="submit" name="addtocart" value="5" class="cart-submit">Add ao carrinho</button>
                                        <!-- Wishlist -->
                                        <div class="modal_pro_wishlist">
                                            <a href="wishlist.html" target="_blank"><i class="ti-heart"></i></a>
                                        </div>
                                        <!-- Compare -->
                                        <div class="modal_pro_compare">
                                            <a href="compare.html" target="_blank"><i class="ti-stats-up"></i></a>
                                        </div>
                                    </form>

                                    <div class="share_wf mt-30">
                                        <p>Compartilhe com amigos</p>
                                        <div class="_icon">
                                            <a href="https://www.facebook.com/Celestial-Moda-Evang%C3%A9lica-480913635394202/"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                            <a href="https://www.instagram.com/celestial_moda_evangelica/?hl=pt-br"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ****** Quick View Modal Area End ****** -->

    <!-- ****** Welcome Slides Area Start ****** -->
    <section class="welcome_area">
        <div class="welcome_slides owl-carousel">
            <!-- Single Slide Start -->
            <div class="single_slide height-800 bg-img background-overlay" style="background-image: url(img/app/bg-img/bg-1.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <div class="welcome_slide_text">
                                <h6 data-animation="bounceInDown" data-delay="0" data-duration="500ms">* Only today we offer free shipping</h6>
                                <h2 data-animation="fadeInUp" data-delay="500ms" data-duration="500ms">Fashion Trends</h2>
                                <a href="#" class="btn karl-btn" data-animation="fadeInUp" data-delay="1s" data-duration="500ms">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Slide Start -->
            <div class="single_slide height-800 bg-img background-overlay" style="background-image: {{ asset('img/app/bg-img/bg-4.jpg') }} );">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <div class="welcome_slide_text">
                                <h6 data-animation="fadeInDown" data-delay="0" data-duration="500ms">* Only today we offer free shipping</h6>
                                <h2 data-animation="fadeInUp" data-delay="500ms" data-duration="500ms">Summer Collection</h2>
                                <a href="#" class="btn karl-btn" data-animation="fadeInLeftBig" data-delay="1s" data-duration="500ms">Check Collection</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Slide Start -->
            <div class="single_slide height-800 bg-img background-overlay" style="background-image: url(img/app/bg-img/bg-2.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <div class="welcome_slide_text">
                                <h6 data-animation="fadeInDown" data-delay="0" data-duration="500ms">* Only today we offer free shipping</h6>
                                <h2 data-animation="bounceInDown" data-delay="500ms" data-duration="500ms">Women Fashion</h2>
                                <a href="#" class="btn karl-btn" data-animation="fadeInRightBig" data-delay="1s" data-duration="500ms">Check Collection</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ****** Welcome Slides Area End ****** -->

    <!-- ****** Area de Produtos ****** -->
    <section class="new_arrivals_area section_padding_100_0 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_heading text-center text-left">
                        <h3><i class="fa fa-sliders"></i>&nbsp; Minhas Conta</h3>
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
                                </div>
                                <div class="tab-pane" id="tab_default_4">
                                    <p></p>
                                    <p></p>
                                    <p></p>
                                </div>
                                <div class="tab-pane" id="tab_default_5">
                                    <p></p>
                                    <p></p>
                                    <p></p>
                                </div>
                                <div class="tab-pane" id="tab_default_6">
                                    <p></p>
                                    <p></p>
                                    <p></p>
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
