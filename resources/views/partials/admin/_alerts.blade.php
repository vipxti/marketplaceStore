@if(session('success'))

    <div class="alert alert-success text-center msg" role="alert">

        {{ session('success') }}

    </div>

@endif

@if(session('nosuccess'))

    <div class="alert alert-danger text-center msg" role="alert">

        {{ session('nosuccess') }}

    </div>

@endif

@if (count($errors))

    <div class="form-group">

        <div class="alert alert-danger msg text-center" role="alert">

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

        $('.msg').fadeOut('slow');

        }, 4000);

</script>