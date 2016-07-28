@extends('admin.layout')

@section('title') Special @stop

@section('subtitle')
    {{$special->name}}
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">

            <div class="block">
                <div class="block-title">
                    <h2>Category Content</h2>
                    <div class="block-options pull-right">

                        {!! toolbar_link(['admin.specials.edit', $special->id], 'fa-edit', 'Edit Special') !!}
                        {!! toolbar_link('admin.specials.create', 'fa-plus', 'New Special') !!}
                    </div>
                </div>
                <h3>{{$special->name}}</h3>
                <table class="table table-striped table-hover">

                    <tr>
                        <td> Title</td>
                        <td colspan=2">{!! $special->title!!}</td>
                    </tr>

                    <tr>
                        <td> Description</td>
                        <td colspan=2">{!! $special->description!!}</td>
                    </tr>


                    @if($special->getMedia('specials')->count() > 0)
                        <tr>
                            <td>Image</td>
                            <td>
                                <img src="{{url('/')}}{!! $special->getMedia('specials')->first()->getUrl('adminThumb')!!}"/><br/>
                            </td>
                            <td>
                                <a href="{{ route('admin.specials.removeimage',[$special->id, $special->getMedia('specials')->first()->id]) }}"
                                   class="btn btn-warning btn-sm">Remove </a>
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
                {!! Form::open(['route' => ['admin.specials.destroy', $special->id], 'method' => 'delete']) !!}
                {!! Form::submit('DELETE SPECIAL', ['class' => 'btn btn-block btn-danger']) !!}
                {!! Form::close() !!}
                <br/>
            </div>
        </div>
    </div>
@stop