@extends('layout')

@section('title') Register @stop

@section('content')

        <div class="container">
            @include('flash::messages')
            <h1 class="center">Register with Us.</h1>
            <br/>
            {!! open(['route' => 'auth.register']) !!}
            <div class="form-group">
                {!! label('Name') !!}
                {!! text('name', null, ['class' => 'form-control']) !!}
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
