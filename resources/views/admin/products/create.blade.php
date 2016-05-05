@extends('admin.layout')

@section('title') Create a Product @stop

@section('content')
    <div class="row">
        {!!open(['route' => 'admin.products.store', 'id' => 'product-form', 'files' => true])!!}

        @include('admin.products.form')

        {!!close()!!}
    </div>
@stop
