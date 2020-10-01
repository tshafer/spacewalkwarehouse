@extends('layout')

@section('title') Forgot Password @stop

@section('content')

    <div class="col-md-6 col-md-offset-3">
        @include('partials.flash')
        <h1 class="center">Forgot Password? It's ok, we all do it.</h1>
        {!! Form::open(['route' => 'auth.password', 'method' => 'post']) !!}

        <div class="form-group">
            {!! Form::label('email') !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Send Reminder', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>

@stop
