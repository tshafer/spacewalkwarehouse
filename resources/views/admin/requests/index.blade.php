@extends('admin.layout')

@section('title') Requests @stop

@section('content')
    <div class="block">
        <div class="block-title">
            <h2>Requests</h2>
        </div>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th class="min">ID</th>
                <td>Date</td>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Branch Name</th>
                <th>Unit Count</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if($unitRequests->count() > 0)
                @foreach($unitRequests as $request)
                    <tr>
                        <td>{{$request->id}}</td>
                        <td>{{ $request->created_at}}</td>
                        <td>{{$request->first_name}}</td>
                        <td>{{$request->last_name}}</td>
                        <td>{{$request->branch_name}}</td>
                        <td>{{$request->units()->count()}}</td>
                        <td class="min">
                            {!!$request->getTableLinks()!!}
                        </td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">
                        There are no requests available
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
        {!! $unitRequests->links() !!}
    </div>
@stop
