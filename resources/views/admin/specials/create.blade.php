@extends('admin.layout')

@section('title') Create a Special @stop

@section('content')
    <div class="row">
        {!!open(['route' => 'admin.specials.store', 'id' => 'special-form', 'files' => true])!!}

        @include('admin.specials.form')

        {!!close()!!}
    </div>
@stop
