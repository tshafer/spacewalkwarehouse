@extends('admin.layout')

@section('title') Coupon @stop

@section('subtitle') {{$coupon->code}} @stop

@section('content')
  <div class="row">
    <div class="col-md-8">

      <div class="block">
        <div class="block-title">
          <h2>Coupon Content</h2>
          <div class="block-options pull-right">
            {!! toolbar_link('admin.coupons.create', 'fa-plus', 'New Coupon') !!}
          </div>
        </div>
        <h2>{{$coupon->code}}</h2>
        <dl class="dl-horizontal">
          <dt>Event</dt><dd>{!!link_to_route('admin.events.show',$coupon->event->name, [$coupon->event->id])!!}</dd>
          <dt>Amount Off</dt><dd>{{$coupon->amount_off}}</dd>
          <dt>Max Redemptions</dt><dd>{{$coupon->max_redemptions}}</dd>
          <dt>Percent Off</dt><dd>{{$coupon->percent_off}}</dd>
          <dt>Redeem by</dt><dd>{{$coupon->redeem_by}}</dd>
          <dt>Event</dt><dd>{{$coupon->event->name}}</dd>
          <dt>Created At</dt><dd>{{$coupon->created_at}}</dd>
          <dt>Updated At</dt><dd>{{$coupon->updated_at}}</dd><br/>
        </dl>
      </div>

    </div>
    <div class="col-md-4">


      <div class="block">
        <div class="block-title">
          <h2>DANGER ZONE</h2>
        </div>
        {!! Form::open(['route' => ['admin.coupons.destroy', $coupon->id], 'method' => 'delete']) !!}
          {!! Form::submit('DELETE COUPON', ['class' => 'btn btn-block btn-danger']) !!}
        {!! Form::close() !!}
        <br/>
      </div>
    </div>
  </div>
@stop