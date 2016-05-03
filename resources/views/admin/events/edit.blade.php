@extends('admin.layout')

@section('title') Edit Event @stop

@section('subtitle') {{$event->title}} @stop

@section('content')
    <div class="row">
        {!!model($event, ['route' => ['admin.events.update', $event->id], 'method' => 'patch', 'id' => 'event-form'])!!}

        @include('admin.events.form')

        {!!close()!!}
    </div>
@stop

@section('scripts')
    @include('admin.events/partials.js')
@endsection