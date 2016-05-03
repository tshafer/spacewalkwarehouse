@extends('admin.layout')

@section('title') Submission @stop

@section('subtitle') {{$asktheexpert->name}} @stop

@section('content')
  <div class="row">
    <div class="col-md-12">

      <div class="block">
        <div class="block-title">
          <h2>Submission Information</h2>

        </div>
          {!!label('Profile Size') !!}: {{$asktheexpert->placement}} <br/>
          {!!label('name') !!}: {{$asktheexpert->name}} <br/>
          {!!label('phone') !!}: {{$asktheexpert->phone}} <br/>
          {!!label('address') !!}: <br/>{!!$asktheexpert->full_address!!}<br/><br/>
          {!!label('address 2') !!}: <br/>{!!$asktheexpert->full_address_2!!}<br/><br/>
          {!!label('address 3') !!}: <br/>{!!$asktheexpert->full_address_3!!}<br/><br/>
          {!!label('website') !!}: {!!$asktheexpert->website!!}<br/>
          {!!label('headline') !!}: {!!$asktheexpert->headline!!}<br/>
          {!!label('sub_headline') !!}: {!!$asktheexpert->sub_headline!!}<br/>
          @if($asktheexpert->specialization)
            {!!label('specialization') !!}: {!!$asktheexpert->specialization!!}<br/>
          @endif
          @if($asktheexpert->designations)
            {!!label('designations') !!}: {!!$asktheexpert->designations!!}<br/>
          @endif
          {!!label('Ad Copy') !!}: {!!$asktheexpert->body!!}
          @if($asktheexpert->photo)
              <br/>{!!label('Photo Provided') !!}: <a class="btn btn-sm btn-primary" href="/uploads/{{$asktheexpert->photo}}" download="{{$asktheexpert->photo}}">Download</a><br/><br/>
            <img src="/uploads/{{$asktheexpert->photo}}"/><br/><br/>
              {!!label('Names of people in photo (left to right)') !!}: {!!$asktheexpert->peoples_names!!}<br/><br/>
          @endif
          <br/>
          <br/>
          {!!label('Needs Photo?') !!}<br/>
          {!!label('Contact Name') !!}: {!!$asktheexpert->need_name!!}<br/>
          {!!label('Contact Phone') !!}: {!!$asktheexpert->need_phone!!}<br/>
          {!!label('Contact Email') !!}: {!!$asktheexpert->need_email!!}<br/>
      </div>

    </div>
  </div>
@stop