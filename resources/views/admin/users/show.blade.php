@extends('admin.layout')

@section('title') View User @stop

@section('subtitle') {{$user->name}} @stop

@section('content')
  <div class="col-md-8">
    <div class="block">
      <div class="block-title">
        <h2>User</h2>
      </div>
        <dl class="dl-horizontal">
          <dt>Name</dt><dd>{{$user->name}}</dd>
          <dt>Email</dt><dd>{!! Html::mailto($user->email) !!}</dd>
          <dt>Created At</dt><dd>{{$user->created_at}}</dd>
          <dt>Updated At</dt><dd>{{$user->updated_at}}</dd>
        </dl>

      </div>
    </div>

@stop