@extends('admin.layout')

@section('title') Submission @stop

@section('subtitle') {{$fitfests->name}} @stop

@section('content')
  <div class="row">
    <div class="col-md-12">

      <div class="block">
        <div class="block-title">
          <h2>Submission Information</h2>
        </div>
          {!!label('name') !!}: {{$fitfests->name}} <br/>
          {!!label('email') !!}: {!!Html::mailto($fitfests->email)!!} <br/>

          <table class="table table-striped">
              <thead>
                  <tr>
                    <th>Class</th>
                    <th>Time</th>
                  </tr>
              </thead>
          @foreach($fitfests->classes as $class)
            <tr>
                <td>{!! link_to_route('admin.fitclasses.show',$class->name, $class->id)!!}</td>
                <td>{{$class->classTime->start_date}}
                    @if( $class->classTime->end_date != '-0001-11-30 00:00:00')
                        - {{$class->classTime->end_date}}
                    @endif
                </td>
            </tr>
          @endforeach
          </table>
      </div>

    </div>
  </div>
@stop