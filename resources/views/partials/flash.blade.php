@if ($errors->any())
    <div class="alert alert-danger text-center">
        <ul style="list-style-type: none; padding: 0;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('message'))
    <div class="alert alert-info text-center">
        <p>{!! session()->get('message') !!}</p>
    </div>
@endif

@if (session()->has('status'))
    <div class="alert alert-info text-center">
        <p>{!! session()->get('status') !!}</p>
    </div>
@endif
