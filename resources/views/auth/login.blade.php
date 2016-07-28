@extends('layout')

@section('title') Sign in to Space Walk Online @stop

@section('content')
    <div class="container">
        @include('flash::messages')
        <h1 class="center">Sign into Space Walk Online</h1>
        <br/>
        {!! open(['route' => 'auth.login', 'method' => 'post']) !!}
        <div class="form-group">
            {!! label('email') !!}
            {!! text('email', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! label('Password') !!}
            {!! password('password', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! link_to_route('auth.password', 'Forgot Password?') !!}
        </div>
        <div class="form-group">
            {!! submit('Login', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! close() !!}
    </div>

@stop