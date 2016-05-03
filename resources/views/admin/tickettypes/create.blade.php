@extends('admin.layout')

@section('title') Create a Ticket Type @stop

@section('content')
    <div class="row">
        {!!open(['route' => 'admin.tickettypes.store', 'id' => 'ticket-type-form'])!!}

        @include('admin.tickettypes.form')

        {!!close()!!}
    </div>
@stop


@section('scripts')
    @include('admin.tickettypes/partials.js')
@endsection