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

                                            <?php
                                            if ($product->media->count() > 0) {
                                                $defaultItem = $product->media->reject(function ($item) {
                                                    return array_get($item->custom_properties, 'default') == false;
                                                });
                                                if ($defaultItem->count() > 0) {
                                                    echo '<img src="' . url('/') . $defaultItem->first()->getUrl('thumb') . '" alt="' . $product->name . '"/>';
                                                } else {
                                                    echo '<img src="' . url('/') . $product->media->first()->getUrl('thumb') . '" alt="' . $product->name . '"/>';
                                                }
                                            }
                                            ?>
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
                                                <a href="{{route('product', [$category->slug, $product->slug])}}"
                                                   class="btn btn-primary">View</a>
                                            </div>
                                            </p>
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
