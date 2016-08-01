@extends('admin.layout')

@section('title') Slider @stop

@section('subtitle')
    {{$slider->name}}
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">

            <div class="block">
                <div class="block-title">
                    <h2>Slider Content</h2>
                    <div class="block-options pull-right">

                        {!! toolbar_link(['admin.sliders.edit', $slider->id], 'fa-edit', 'Edit Slider') !!}
                        {!! toolbar_link('admin.sliders.create', 'fa-plus', 'New Slider') !!}
                    </div>
                </div>
                <table class="table table-striped table-hover">

                    <tr>
                        <td> Title</td>
                        <td colspan=2">{!! $slider->title!!}</td>
                    </tr>

                    <tr>
                        <td> Description</td>
                        <td colspan=2">{!! $slider->url!!}</td>
                    </tr>


                    @if($slider->getMedia('sliders')->count() > 0)
                        <tr>
                            <td>Image</td>
                            <td>
                                <img src="{{url('/')}}{!! $slider->getMedia('sliders')->first()->getUrl('adminThumb')!!}"/><br/>
                            </td>
                            <td>
                                <a href="{{ route('admin.sliders.removeimage',[$slider->id, $slider->getMedia('sliders')->first()->id]) }}"
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
                {!! Form::open(['route' => ['admin.sliders.destroy', $slider->id], 'method' => 'delete']) !!}
                {!! Form::submit('DELETE SLIDER', ['class' => 'btn btn-block btn-danger']) !!}
                {!! Form::close() !!}
                <br/>
            </div>
        </div>
    </div>
@stop