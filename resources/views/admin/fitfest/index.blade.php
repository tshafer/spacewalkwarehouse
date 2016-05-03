@extends('admin.layout')

@section('title') All Fitfest Submissions @stop

@section('content')
    <div class="block">
        <div class="block-title">
            <div class="block-options pull-right">
                {!! link_to_route('fitfest.export', 'Export to Excel') !!}
            </div>
            <h2>All Fitfest Submissions</h2>

        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>{!! Html::sort('First Name', 'first_name') !!}</th>
                    <th>{!! Html::sort('Last Name', 'last_name') !!}</th>
                    <th>{!! Html::sort('Email', 'email') !!}</th>
                    <th>{!! Html::sort('Created At', 'created_at') !!}</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($fitfests->count() > 0)
                    @foreach($fitfests as $fitfest)
                        <tr>
                            <td>{{$fitfest->first_name}}</td>
                            <td>{{$fitfest->last_name}}</td>
                            <td>{!!Html::mailto($fitfest->email)!!}</td>
                            <td>{{$fitfest->created_at}}</td>
                            <td class="min">
                                {!!$fitfest->getTableLinks()!!}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="6">There are no submissions available</td></tr>
                @endif

            </tbody>
        </table>
        {!! paginate($fitfests) !!}
    </div>
@stop