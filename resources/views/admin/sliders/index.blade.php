@extends('admin.layout')

@section('title') Sliders @stop

@section('content')
    <div class="block">
        <div class="block-title">
            <div class="block-options pull-right">
                {!! toolbar_link('admin.sliders.create', 'fa-plus', 'New Slider') !!}
            </div>
            <h2>Sliders</h2>
        </div>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th class="min">ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if($sliders->count() > 0)
                @foreach($sliders as $slider)
                    <tr>
                        <td>{{$slider->id}}</td>
                        <td>{{$slider->title}}</td>
                        <td>
                            @if($slider->media->count() > 0)
                                <img src="{!! $slider->media->first()->getUrl('adminThumb')!!}"/>
                            @endif
                        </td>
                        <td class="min">
                            {!!$slider->getTableLinks()!!}
                        </td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">
                        There are no sliders available
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
        {!! $sliders->links() !!}
    </div>
@stop
