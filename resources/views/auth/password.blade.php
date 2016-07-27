@extends('layout')

@section('title') Forgot Password @stop

@section('content')

    @include('flash::messages')

    <div class="col-md-6 col-md-offset-3">
        <h1 class="center">Forgot Password? It's ok, we all do it.</h1>
        {!! open(['route' => 'auth.password', 'method' => 'post']) !!}

        <div class="form-group">
            {!! label('email') !!}
            {!! text('email', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! submit('Send Reminder', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! close() !!}
    </div>

@stop