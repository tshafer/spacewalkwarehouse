@extends('admin.layout')

@section('title') All Submissions @stop

@section('content')
  <div class="block">
    <div class="block-title">
      <div class="block-options pull-right">
          {{--{!! Html::search($users) !!}--}}
      </div>
      <h2>All Submissions</h2>
    </div>

    <table class="table table-striped table-hover">
      <thead>
        <tr>
            <th>Photo</th>
            <th>{!! Html::sort('First Name', 'first_name') !!}</th>
            <th>{!! Html::sort('Last Name', 'last_name') !!}</th>
            <th>{!! Html::sort('Phone', 'Phone') !!}</th>
            <th>{!! Html::sort('Created At', 'created_at') !!}</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
          @if($asktheexperts->count() > 0)
            @foreach($asktheexperts as $asktheexpert)
              <tr>
                  <td>
                      @if($asktheexpert->photo)
                        <img src="/uploads/{{$asktheexpert->photo}}" width="150"/>
                      @else
                        None
                      @endif
                  </td>

                <td>{{$asktheexpert->first_name}}</td>
                <td>{{$asktheexpert->last_name}}</td>
                  <td>{{$asktheexpert->phone}}</td>
                  <td>{{$asktheexpert->created_at}}</td>
                <td class="min">
                    {!!$asktheexpert->getTableLinks()!!}
                </td>
              </tr>
            @endforeach
          @else
             <tr><td colspan="6">There are no submissions available</td></tr>
          @endif

      </tbody>
    </table>
      @if($asktheexperts->count() > 0)
        {!! paginate($asktheexperts) !!}
      @endif
  </div>
@stop