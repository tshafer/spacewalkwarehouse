@extends('admin.layout')

@section('title') Manufacturers @stop

@section('content')
    <div class="block">
        <div class="block-title">
            <div class="block-options pull-right">
                {!! toolbar_link('admin.manufacturers.create', 'fa-plus', 'New Manufacturer') !!}
            </div>
            <h2>Manufacturers</h2>
        </div>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th class="min">ID</th>
                <th>Name</th>
                <th>Enabled</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if($manufacturers->count() > 0)
                @foreach($manufacturers as $manufacturer)
                    <tr>
                        <td>{{$manufacturer->id}}</td>
                        <td>{{$manufacturer->name}}</td>
                        <td>{{$manufacturer->is_enabled}}</td>
                        <td>
                            @if($manufacturer->getMedia()->count() > 0)
                                <img src="{!! $manufacturer->getMedia('manufacturers')->first()->getUrl('adminThumb')!!}"/>
                            @endif
                        </td>
                        <td class="min">
                            {!!$manufacturer->getTableLinks()!!}
                        </td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">
                        There are no Manufacturers Available
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
        {!! paginate($manufacturers) !!}
    </div>
@stop