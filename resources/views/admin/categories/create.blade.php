@extends('admin.layout')

@section('title') Create a Category @stop

@section('content')
    <div class="row">
        {!!open(['route' => 'admin.categories.store', 'id' => 'category-form', 'files' => true])!!}

        @include('admin.categories.form')

        {!!close()!!}
    </div>
@stop
