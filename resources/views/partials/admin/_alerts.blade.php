@if($flash = session('Mensagem'))

    <div class="alert alert-success flash" role="alert">

        {{ $flash }}

    </div>

@endif

@if (count($errors))

    <div class="form-group flash">

        <div class="alert alert-danger">

            <ul>

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    </div>

@endif

<script>

    setTimeout(function() {

        $('#flash').fadeOut('slow');

        }, 5000);

</script>