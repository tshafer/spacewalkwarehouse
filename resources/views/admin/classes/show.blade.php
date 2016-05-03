@extends('admin.layout')

@section('title') Class @stop

@section('subtitle') {{$fitclass->name}} @stop

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="block">
                <div class="block-title">
                    <h2>Class Information</h2>
                </div>
                {!!label('name') !!}: {{$fitclass->name}} <br/>
                {!!label('max_students') !!}: {{$fitclass->max_students}} <br/>
                {!!label('total_students') !!}: {{$students->count()}} <br/>

                <h3>Students</h3>
                <table class="table table-striped">
                    <thead>
                        <th>{!! Html::sort('First Name', 'first_name') !!}</th>
                        <th>{!! Html::sort('Last Name', 'last_name') !!}</th>
                        <th>{!! Html::sort('Email', 'email') !!}</th>
                    </thead>

                    @foreach($students as $student)
                        <tr>
                            <td>{!!link_to_route('admin.fitfests.show', $student->first_name, $student->id)!!}</td>
                            <td>{!!link_to_route('admin.fitfests.show', $student->last_name, $student->id)!!}</td>
                            <td>{{$student->email}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

        </div>
    </div>
@stop