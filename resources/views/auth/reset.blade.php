@extends('layout')

@section('title') Reset Password @stop

@section('content')

    <div class="col-md-6 col-md-offset-3">
        @include('partials.flash')
        <h1 class="center">Reset Password</h1>
        {!! Form::open(['route' => 'auth.reset', 'method' => 'post']) !!}

        {!! Form::hidden('token', $token) !!}

        <div class="form-group">
            {!! Form::label('email') !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Password') !!}
            {!! Form::password('password',  ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Confirm Password') !!}
            {!! Form::password('password_confirmation',  ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Reset Password', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>

@stop
