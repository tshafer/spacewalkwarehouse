@extends('admin.layout')

@section('title') Edit Manufacturer @stop

@section('subtitle') {{$manufacturer->name}} @stop

@section('content')
    <div class="row">
        {!!model($manufacturer, ['route' => ['admin.manufacturers.update', $manufacturer->id], 'method' => 'patch', 'id' => 'manufacturer-form','files' => true])!!}

        @include('admin.manufacturers.form')

        {!!close()!!}
    </div>
@stop
