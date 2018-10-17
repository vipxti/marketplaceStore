<form action="{{route('client.update')}}" method="post" enctype="multipart/form-data">

    {{ csrf_field() }}
    <!-- Nome -->
    <div class="row">
        <!-- Nome do Cliente  -->
        <div class="col-md-6">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" name="nm_cliente" required maxlength="50" value="{{ Auth::user()->nm_cliente }}">
                    <label class="form-label">Nome</label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" name="sobrenome_cliente" required maxlength="50" value="{{ Auth::user()->sobrenome_cliente }}">
                    <label class="form-label">Sobrenome</label>
                </div>
            </div>
        </div>
    </div>

    <!-- E-mail, Data de Nascimento -->
    <div class="row">
        <!-- E-mail -->
        {{--<div class="col-md-6">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" name="email" required maxlength="20" value="{{ Auth::user()->email }}">
                    <label class="form-label">E-mail</label>
                </div>
            </div>
        </div>--}}

        <!-- Data de Nascimento -->
        <div class="col-md-6">
            <div class="form-group form-float">
                <div class="form-line">
                    {{--<input type="text" class="form-control" name="dt_nascimento" required maxlength="20" value="{{ \Carbon\Carbon::parse(Auth::user()->dt_nascimento)->format('d/m/Y') }}">--}}
                    <input type="text" id="data_nasc" class="form-control" name="dt_nascimento"
                    data-inputmask='"mask": "99/99/9999"' data-mask required maxlength="20"
                    value="{{ \Carbon\Carbon::parse(Auth::user()->dt_nascimento)->format('d/m/Y') }}">
                    <label class="form-label">Data de Nascimento</label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" name="cd_celular1"
                           data-inputmask='"mask": "(99) 99999-9999"' data-mask required maxlength="20">
                    <label class="form-label">Telefone</label>
                </div>
            </div>
        </div>
    </div>

    <!-- Senha,CPF, e CNPJ -->
    <div class="row">

        <div class="col-md-6" hidden>
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" name="cd_cpf_cnpj" required maxlength="20" value="{{ Auth::user()->cd_cpf_cnpj }}">
                    <label class="form-label">CPF ou CNPJ</label>
                </div>
            </div>
        </div>
    </div>

    <!-- Foto Cliente -->
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label></label>Foto</label>
                <div class="input-group">
                    <div class="file-loading">
                        <input id="input-41" name="images[]" type="file" accept="image/*" multiple>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <br><br><br>

    <!-- Botão Atualizar dados -->
    <div class="row">
        <div class="col-md-2">
            {{--<input type="button" class="btn btn-danger" value="Atualizar dados" style="width: 150px; background-color: #d59431">--}}
            <button type="submit" class="btn btn-template">Atualizar dados</button>
        </div>
    </div>

</form>
