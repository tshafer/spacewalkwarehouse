@extends('layout')

@section('title') Reset Password @stop

@section('content')

    @include('flash::messages')

    <div class="col-md-6 col-md-offset-3">
        <h1 class="center">Reset Password</h1>
        {!! open(['route' => 'auth.reset', 'method' => 'post']) !!}

        {!! hidden('token', $token) !!}

        <div class="form-group">
            {!! label('email') !!}
            {!! text('email', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! label('Password') !!}
            {!! password('password',  ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! label('Confirm Password') !!}
            {!! password('password_confirmation',  ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! submit('Reset Password', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! close() !!}
    </div>

@stop