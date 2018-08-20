<div class="modal fade" id="modalUpdateAddress" tabindex="-1" role="dialog" aria-labelledby="modalUpdateAddressLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="modalUpdateAddressLabel">Atualizar Endereço</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">

                @component('pages.app.components.forms.address.update')                    
                @endcomponent

            </div>

        </div>

    </div>

</div>