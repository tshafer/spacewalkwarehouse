@extends('admin.layout')

@section('title') Requests @stop

@section('subtitle')
    {{$unitRequest->name}}
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">

            <div class="block">
                <div class="block-title">
                    <h2>Request Content</h2>
                    <div class="block-options pull-right">

                        {!! toolbar_link(['admin.unitrequests.edit', $unitRequest->id], 'fa-edit', 'Edit Request') !!}
                    </div>
                </div>
                <h3>{{$unitRequest->first_name}} {{$unitRequest->last_name}}</h3>
                <table class="table table-striped table-hover">

                    <tr>
                        <td>Company Name</td>
                        <td>{!! $unitRequest->company_name!!}</td>
                    </tr>
                    <tr>
                        <td>Company Website</td>
                        <td>{!! $unitRequest->company_website!!}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{!! $unitRequest->email!!}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{!! $unitRequest->phone!!}</td>
                    </tr>
                    <tr>
                        <td>Message</td>
                        <td>{!! $unitRequest->message!!}</td>
                    </tr>
                    @if($unitRequest->units->count() > 0)
                        <tr>
                            <td>Units</td>
                            <td>
                                @foreach($unitRequest->units()->get() as $unit)
                                    <a href="{{route('admin.units.show', $unit->id)}}">{{ $unit->name }}</a><br/>
                                @endforeach
                            </td>
                        </tr>
                    @endif
                </table>
            </div>

        </div>

        <div class="col-md-4">
            <div class="block">
                <div class="block-title">
                    <h2>DANGER ZONE</h2>
                </div>
                {!! Form::open(['route' => ['admin.unitrequest.destroy', $unitRequest->id], 'method' => 'delete']) !!}
                {!! Form::submit('DELETE REQUESTS', ['class' => 'btn btn-block btn-danger']) !!}
                {!! Form::close() !!}
                <br/>
            </div>
        </div>
    </div>


@stop