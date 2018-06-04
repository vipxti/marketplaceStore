@if(session()->has('msg.level'))

    <div class="alert alert-{{ session('msg.level') }} flash" role="alert">

        {{ session('msg.content') }}

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

        $('.flash').fadeOut('slow');

        }, 5000);

</script>