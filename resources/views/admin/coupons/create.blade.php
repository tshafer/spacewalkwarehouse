@extends('admin.layout')

@section('title') Create a Coupon @stop

@section('content')
    <div class="row">
        {!!open(['route' => 'admin.coupons.store', 'id' => 'coupon-form'])!!}

        @include('admin.coupons.form')

        {!!close()!!}
    </div>
@stop

@section('scripts')
    @include('admin.coupons/partials.js')
@endsection