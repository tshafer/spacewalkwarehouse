@extends('admin.layout')

@section('title') All Classes @stop

@section('content')
    <div class="block">
        <div class="block-title">
            <div class="block-options pull-right">
                {!! link_to_route('fitfest.export', 'Export to Excel') !!}
            </div>
            <h2>All Classes</h2>

        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>{!! Html::sort('Name', 'name') !!}</th>
                    <th>{!! Html::sort('Student Count', 'student_count') !!}</th>
                    <th>{!! Html::sort('Max Students', 'max_students') !!}</th>
                    <th>{!! Html::sort('Created At', 'created_at') !!}</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($classes->count() > 0)
                    @foreach($classes as $class)
                        <tr>
                            <td>{{$class->name}}</td>
                            <td>{{$class->students->count()}}</td>
                            <td>{{$class->max_students}}</td>
                            <td>{{$class->created_at}}</td>
                            <td class="min">
                                {!!$class->getTableLinks()!!}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="6">There are no classes available</td></tr>
                @endif

            </tbody>
        </table>
        {!! paginate($class) !!}
    </div>
@stop