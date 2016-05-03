@extends('layout')

@section('title') Sign into Washingtonian.com @stop

@section('content')
  <div class="col-md-6 col-md-offset-3">
    <h1 class="center">Sign into Washingtonian.com</h1>
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