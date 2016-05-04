@extends('admin.layout')

@section('title') Manufacturers @stop

@section('subtitle')
    {{$manufacturer->name}}
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">

            <div class="block">
                <div class="block-title">
                    <h2>Manufacturer Content</h2>
                    <div class="block-options pull-right">

                        {!! toolbar_link(['admin.manufacturers.edit', $manufacturer->id], 'fa-edit', 'Edit Manufacturer') !!}
                        {!! toolbar_link('admin.manufacturers.create', 'fa-plus', 'New Manufacturer') !!}
                    </div>
                </div>
                <h3>{{$manufacturer->name}}</h3>
                <table class="table table-striped table-hover">


                    <tr>
                        <td> Description</td>
                        <td colspan=2">{!! $manufacturer->description!!}</td>
                    </tr>
                    <tr>
                        <td>Enabled</td>
                        <td colspan=2">{!! $manufacturer->is_enabled!!}</td>
                    </tr>
                    @if($manufacturer->getMedia()->count() > 0)
                        <tr>
                            <td>Image</td>
                            <td>
                                <img src="{!! $manufacturer->getMedia('manufacturers')->first()->getUrl('adminThumb')!!}"/><br/>

                            </td>
                            <td>
                                <a href="{{ route('admin.manufacturers.removeimage',[$manufacturer->id, $manufacturer->getMedia('manufacturers')->first()->id]) }}"
                                   class="btn btn-warning btn-sm">Remove </a></td>
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
                {!! Form::open(['route' => ['admin.manufacturers.destroy', $manufacturer->id], 'method' => 'delete']) !!}
                {!! Form::submit('DELETE MANUFACTURER', ['class' => 'btn btn-block btn-danger']) !!}
                {!! Form::close() !!}
                <br/>
            </div>
        </div>
    </div>
@stop