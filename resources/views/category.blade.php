@extends('layout')

@section('title', $category->name )

@section('content')

    <div class="container main-container">
        <div class="row">

            <div class="col-md-12">
                <span class="title">{{ $category->title }}</span>
                @if($products->count() > 0)
                    @foreach($products->chunk(3) as $chunkedProducts)
                        <div class="row">
                            @foreach($chunkedProducts as $product)
                                <div class="col-lg-4 col-sm-4 hero-feature text-center">
                                    <div class="thumbnail">
                                        <a href="{{route('product', [$category->slug, $product->slug])}}">
                                            {!! defaultProductImage($product) !!}
                                        </a>

                                        <div class="caption prod-caption">
                                            <h4><a href="{{route('product', [$category->slug, $product->slug])}}"
                                                   class="color_dark">
                                                    {{ $product->name }}
                                                </a>
                                            </h4>
                                            <div class="btn-group">
                                                <a href="{{route('product', [$category->slug, $product->slug])}}"
                                                   class="btn btn-primary">View</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12">
                        Sorry, we have no products in this category.
                    </div>
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
