@extends('admin.layout')

@section('title') Users @stop

@section('subtitle') @stop

@section('content')
  <div class="block">
    <div class="block-title">
        <div class="block-options pull-right">
            {{--{!! Html::search($users) !!}--}}
            {!! toolbar_link('admin.users.create', 'fa-plus', 'New User') !!}
            {{--{!! trashed_link( 'admin.users', 'Users') !!}--}}
        </div>
      <h2>All Users</h2>
    </div>

    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th class="min">ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Joined At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
          <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{!! Html::mailto($user->email) !!}</td>
            <td>{{$user->created_at}}</td>
            <td class="min">
               {!!$user->getTableLinks()!!}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

      {!! paginate($users) !!}
  </div>
@stop