@extends('layout')

@section('title', $category->name .' - Space Walk Online')

@section('meta_description', $category->meta_description)

@section('content')

    <div class="container main-container">
        <div class="row">

            <div class="col-md-12">
                <div class="col-lg-12 col-sm-12">
                    <span class="title">{{ $category->title }}</span>
                </div>

                @if($products->count() > 0)
                    @foreach($products as $product)
                        <div class="col-lg-4 col-sm-4 hero-feature text-center">
                            <div class="thumbnail">
                                <a href="{{route('product', [$category->slug, $product->slug])}}">
                                    @if($product->getMedia('products')->count() > 0)
                                        <img src="{{url('/')}}{{$product->media->first()->getUrl('thumb')}}"
                                             alt="{{ $product->name }}"/>
                                    @endif
                                </a>

                                <div class="caption prod-caption">
                                    <h4><a href="{{route('product', [$category->slug, $product->slug])}}"
                                           class="color_dark">
                                            {{ $product->name }}
                                        </a>
                                    </h4>
                                    <p>{{$product->description}}</p>
                                    <p>
                                    <div class="btn-group">
                                        <a href="{{route('product', [$category->slug, $product->slug])}}" class="btn btn-primary">View</a>
                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="paginate">
                        {{$products->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
