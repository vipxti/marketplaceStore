<div class="modal fade" id="modalNewAddress" tabindex="-1" role="dialog" aria-labelledby="modalNewAddressLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="modalNewAddressLabel">Novo Endereço</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">

                @component('pages.app.components.forms.address.register')                    
                @endcomponent

            </div>

        </div>

    </div>

</div>