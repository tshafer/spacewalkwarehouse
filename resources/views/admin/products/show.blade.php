@extends('admin.layout')

@section('title') Product @stop

@section('subtitle')
    {{$product->name}}
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">

            <div class="block">
                <div class="block-title">
                    <h2>Product Content</h2>
                    <div class="block-options pull-right">

                        {!! toolbar_link(['admin.products.edit', $product->id], 'fa-edit', 'Edit Product') !!}
                        {!! toolbar_link('admin.products.create', 'fa-plus', 'New Product') !!}
                        <a class="btn btn-alt btn-sm btn-default" href="{{route('product', [$product->categories()->first()->slug, $product->categories()->first()->parent()->first()->slug, $product->slug])}}" target="_blank">
                            <i class="fa fa-external-link" aria-hidden="true" ></i>
                            </a>
                    </div>
                </div>
                <h3>{{$product->name}}</h3>
                <table class="table table-striped table-hover">

                    <tr>
                        <td> Description</td>
                        <td colspan="2">{!! $product->description!!}</td>
                    </tr>
                    <tr>
                        <td>Enabled</td>
                        <td colspan="2">{!! $product->is_enabled!!}</td>
                    </tr>
                    @if($product->categories()->count() > 0)
                        <tr>
                            <td>Categories</td>
                            <td colspan="2">
                                @foreach($product->categories()->get() as $category)
                                    <a href="{{route('admin.categories.show', $category->id)}}">{{ $category->name }}</a>
                                @endforeach
                            </td>
                        </tr>
                    @endif
                    @if($product->manufacturers()->count() > 0)
                        <tr>
                            <td>Manufacturers</td>
                            <td colspan="2">
                                @foreach($product->manufacturers()->get() as $manufacturer)
                                    <a href="{{route('admin.manufacturers.show', $manufacturer->id)}}">{{ $manufacturer->name }}</a>
                                    @if(!$loop->last)
                                        |
                                    @endif
                                @endforeach
                            </td>

                        </tr>
                    @endif
                    @if($product->getMedia()->count() > 0)
                        <tr>
                            <td>Image</td>
                            <td>
                                <img src="{!! $product->getMedia('products')->first()->getUrl('adminThumb')!!}"/><br/>
                            </td>
                            <td>
                                <a href="{{ route('admin.products.removeimage',[$product->id, $product->getMedia('products')->first()->id]) }}"
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
                {!! Form::open(['route' => ['admin.products.destroy', $product->id], 'method' => 'delete']) !!}
                {!! Form::submit('DELETE PRODUCT', ['class' => 'btn btn-block btn-danger']) !!}
                {!! Form::close() !!}
                <br/>
            </div>
        </div>
    </div>
@stop