@extends('admin.layout')

@section('title') Create a Event @stop

@section('content')
    <div class="row">
        {!!open(['route' => 'admin.events.store', 'id' => 'event-form'])!!}

        @include('admin.events.form')

        {!!close()!!}
    </div>
@stop

@section('scripts')
 @include('admin.events/partials.js')
@endsection