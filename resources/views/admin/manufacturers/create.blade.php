@extends('admin.layout')

@section('title') Create a Manufacturer @stop

@section('content')
    <div class="row">
        {!!open(['route' => 'admin.manufacturers.store', 'id' => 'manufacturer-form', 'files' => true])!!}

        @include('admin.manufacturers.form')

        {!!close()!!}
    </div>
@stop
