@extends('admin.layout')

@section('title') Edit Ticket Type @stop

@section('subtitle') {{$ticketType->ticket_name}} @stop

@section('content')
    <div class="row">
        {!!model($ticketType, ['route' => ['admin.tickettypes.update', $ticketType->id], 'method' => 'patch', 'id' => 'ticket-types-form'])!!}

        @include('admin.tickettypes.form')

        {!!close()!!}
    </div>
@stop


@section('scripts')
    @include('admin.tickettypes/partials.js')
@endsection