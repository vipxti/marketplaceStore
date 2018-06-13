<form action="#" method="post" enctype="multipart/form-data">
    <div class='modal fade' id='myModal'>
        <div class='modal-dialog'>
            <div class='modal-content' style="width: 130%">
                <div class='modal-header'>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class='modal-title'>
                        <strong><i class="fa fa-sort-amount-desc"></i>&nbsp;&nbsp;Cadastrar Variações</strong>
                    </h4>
                </div>

                <div class='modal-body'>

                    <!-- Nome do Produto (Modal) -->
                    <table style="width: 100%">
                        <tr>
                            <td>
                                <div>
                                    <div class="form-group">
                                        <label>Nome do Produto</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                            <input type="text" class="form-control campo_nome_modal" name="nm_produto" maxlength="50">
                                        </div>
                                        <i class="msg_nome_prod"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <!-- Códigos SKU e Ean (Modal) -->
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 50%">
                                <div>
                                    <div class="form-group">
                                        <label>Código (SKU)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                            <input id="campo_sku" type="text" class="form-control campo_sku_modal" name="cd_sku" maxlength="20" style="text-transform: uppercase">

                                        </div>
                                        <i class="msg_sku"></i>
                                    </div>
                                </div>
                            </td>

                            <td>&nbsp;&nbsp;&nbsp;</td>

                            <td style="width: 50%">
                                <div>
                                    <div class="form-group">
                                        <label>Código (EAN)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                            <input id="campo_ean" type="text" class="form-control campo_ean_modal" name="cd_ean" maxlength="13">
                                        </div>
                                        <i class="msg_ean"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <!-- Categorias (Modal) -->
                    <table style="width: 100%">
                        <tr>

                            <input type="hidden" id="categorias" class="form-control select2 campo_cat_modal" style="width: 100%;" name="cd_categoria">

                            <td>&nbsp;&nbsp;&nbsp;</td>

                            <input type="hidden" id="subcategorias" class="form-control select2 campo_subcat_modal" style="width: 100%;" name="cd_sub_categoria" >

                        </tr>
                    </table>
                    <br>

                    <!-- Tamanhos (Modal) -->
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 50%">
                                <label>Tamanho (Letra)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                    <select id="sl_tamanho_letra" class="form-control select2" style="width: 100%;" name="cd_tamanho_letra">
                                        <option value=""></option>
                                        @foreach($tamanhosLetras as $tamanhoLetra)
                                            <option value="{{ $tamanhoLetra->cd_tamanho_letra }}">{{ $tamanhoLetra->nm_tamanho_letra }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <i class="msg_tam_letra"></i>
                            </td>

                            <td>&nbsp;&nbsp;&nbsp;</td>

                            <td style="width: 50%">
                                <label>Tamanho (Número)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                    <select id="sl_tamanho_num" class="form-control select2" style="width: 100%;" name="cd_tamanho_num">
                                        <option value=""></option>
                                        @foreach($tamanhosNumeros as $tamanhoNumero)
                                            <option value="{{ $tamanhoNumero->cd_tamanho_num }}">{{ $tamanhoNumero->nm_tamanho_num }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <i class="msg_tam_num"></i>
                            </td>
                        </tr>
                    </table>
                    <br>

                    <!-- Cor (Modal) -->
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 51%">
                                <label>Cor</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-paint-brush"></i></span>
                                    <select class="form-control select2" style="width: 100%;" name="cd_cor" >
                                        <option value=""></option>
                                        @foreach($cores as $cor)
                                            <option value="{{ $cor->cd_cor }}">{{ $cor->nm_cor }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <i class="msg_cor"></i>
                            </td>

                            <td>&nbsp;&nbsp;&nbsp;</td>

                            <td style="width: 25%">
                                <div>
                                    <label>Preço</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        <input type="number" class="form-control campo_preco_modal" name="vl_produto" min="0">
                                    </div>
                                    <i class="msg_preco"></i>
                                </div>
                            </td>

                            <td>&nbsp;&nbsp;&nbsp;</td>

                            <td style="width: 25%">
                                <div>
                                    <label>Quantidade</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">0-9</span>
                                        <input type="number" class="form-control campo_qtd_modal" name="qt_produto" min="0">
                                    </div>
                                    <i class="msg_qtd"></i>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <br>

                    <!-- Laegura, Altura e Peso (Modal) -->
                    <table style="width: 100%">
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label>Largura</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                                        <input type="number" class="form-control campo_largura_modal" name="ds_largura" min="0">
                                    </div>
                                    <i class="msg_largura"></i>
                                </div>
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;</td>

                            <td>
                                <div class="form-group">
                                    <label>Altura</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-arrows-v"></i></span>
                                        <input type="number" class="form-control campo_altura_modal" name="ds_altura" min="0">
                                    </div>
                                    <i class="msg_altura"></i>
                                </div>
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;</td>

                            <td>
                                <div class="form-group">
                                    <label>Peso (g)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                                        <input type="number" class="form-control campo_peso_modal" name="ds_peso" min="0">
                                    </div>
                                    <i class="msg_preco"></i>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <!-- Descrição (Modal)  -->
                    <table style="width: 100%">
                        <tr>
                            <td>
                                <div>
                                    <div class="form-group">
                                        <label>Descrição do Produto</label>
                                        <div class="input-group">
                                          <textarea id="bold" class="campo_desc_modal" name="ds_produto" rows="5" cols="112%" style="line-height: 40px; border: 1px solid #dddddd; padding: 2px; resize: none"  maxlength="1500">
                                          </textarea>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><p class="msg_desc"></p></td>
                        </tr>
                        <tr>
                            <td><p><span class="qtd_palavras">1500</span> caracteres</p></td>
                        </tr>
                    </table>

                    <!-- Imagens e Status (Modal) -->
                    <table style="width: 100%">
                        <tr>
                            <td>
                                <div>
                                    <div>
                                        <div class="form-group">
                                            <label>Imagens</label>
                                            <div class="input-group">
                                                <div class="file-loading">
                                                    <input id="input-41" name="images[]" type="file" accept="image/*" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div>
                                    <div class="box-header"><h3 class="box-title">Ativa/Desativar Produto</h3></div>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="checkbox" class="flat-red campo_status" name="status" checked>
                                            <label class="">Status</label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <!-- Botão Salvar (Modal) -->
                    <div style="width: 100%" class="text-right">
                        <button type="submit" id="btn_salvar" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Salvar</button>
                    </div>
                </div>
                <!-- / modal-body -->
            </div>
            <!-- / modal-content -->
        </div>
        <!--/ modal-dialog -->
    </div>
    <!-- / modal -->
</form>