@extends('admin.layout')

@section('title') All Coupons @stop

@section('content')
  <div class="block">
    <div class="block-title">
      <div class="block-options pull-right">
        {!! toolbar_link('admin.coupons.create', 'fa-plus', 'New Coupon') !!}
      </div>
      <h2>All Coupons</h2>
    </div>

    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th class="min">ID</th>
          <th>{!! Html::sort('Coupon Code', 'code') !!}</th>
          <th>Event</th>
          <th>{!! Html::sort('Amount Off', 'amount_off') !!}</th>
          <th>{!! Html::sort('Percent Off', 'percent_off') !!}</th>

          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @if($coupons->count() > 0)
          @foreach($coupons as $coupon)
            <tr>
              <td>{{$coupon->id}}</td>
              <td>{{$coupon->code}}</td>
              <td>{!!link_to_route('admin.events.show',$coupon->event->name, [$coupon->event->id])!!}</td>
              <td>{{$coupon->amount_off}}</td>
              <td>{{$coupon->percent_off}}</td>
              <td class="min">
                {!!$coupon->getTableLinks()!!}
              </td>
            </tr>
          @endforeach
        @else
          <tr><td colspan="6">
              There are no coupons Available
            </td></tr>
        @endif

      </tbody>
    </table>
    {!! paginate($coupons) !!}
  </div>
@stop