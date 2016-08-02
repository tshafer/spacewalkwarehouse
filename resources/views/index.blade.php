@extends('layout')

@section('title') Space Walk Sales @stop

@section('content')

    <div class="container main-container">
        <div class="row">

            <div class="col-lg-12 col-md-12">
                <div class="slider">
                    <ul class="bxslider">
                        @if($sliders->count() > 0)
                            @foreach($sliders as $slider)
                                @if($slider->getMedia('sliders')->count() > 0)
                                    <li>
                                        <a href="{{$slider->url}}">
                                            <img src="{{url('/')}}{{$slider->media->first()->getUrl()}}"
                                                 alt="{{ $slider->title }}" class="img-responsive"/>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="well">
                    {{open(['route' => 'search'])}}
                    <div class="input-group">

                        {{ input('text', 'q', null, ['class' => 'form-control input-search', 'placeholder' => 'Enter Something to Search']) }}
                        <span class="input-group-btn">
                            <button class="btn btn-default no-border-left" type="submit"><i class="fa fa-search"></i>
                            </button>
                        </span>

                    </div>
                    {{close()}}
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Featured -->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <span class="title">MOST RECENT PRODUCTS</span>
                @if($products->count() > 0)
                    @foreach($products->chunk(3) as $chunkedProducts)
                        <div class="row">
                            @foreach($chunkedProducts as $product)
                                <div class="col-lg-4 col-sm-4 hero-feature text-center">
                                    <div class="thumbnail">
                                        <a href="{{route('product', [$product->categories->first()->slug, $product->slug])}}">
                                            @if($product->getMedia('products')->count() > 0)
                                                <img src="{{url('/')}}{{$product->getMedia('products')->first()->getUrl('thumb')}}"
                                                     alt="{{ $product->name }}"/>
                                            @endif
                                        </a>

                                        <div class="caption prod-caption">
                                            <h4>
                                                <a href="{{route('product', [$product->categories->first()->slug, $product->slug])}}"
                                                   class="color_dark">
                                                    {{ $product->name }}
                                                </a>
                                            </h4>
                                            <p>{{$product->description}}</p>
                                            <div class="btn-group">
                                                <a href="{{route('product', [$product->categories->first()->slug, $product->slug])}}"
                                                   class="btn btn-primary">View</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@stop