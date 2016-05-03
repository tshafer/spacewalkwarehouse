@extends('layout')

@section('title') Register @stop

@section('content')

    <div class="col-md-6 col-md-offset-3">
        <h1 class="center">Register with Us.</h1>
        {!! open(['route' => 'register.post']) !!}
        <div class="form-group">
            {!! label('First Name') !!}
            {!! text('first_name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! label('Last Name') !!}
            {!! text('last_name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! label('Email') !!}
            {!! email('email', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! label('Password') !!}
            {!! password('password', ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! label('Password Confirmation') !!}
            {!! password('password_confirmation', ['class' => 'form-control']) !!}
        </div>

        {!! submit('Join',['class' => 'btn btn-primary']) !!}
        {!! close() !!}
    </div>
@endsection
