@extends('layout')

@section('title', 'Search Results for: '.$query )

@section('content')

    <div class="container main-container">
        <div class="row">
            <div class="col-md-12">
                <span class="title">Search Results for: {{ $query }}</span>
            </div>
        </div>

        @if($results->count() > 0)
            @foreach($results->chunk(3) as $chunkedResults)
                <div class="row">
                    @foreach($chunkedResults as $result)
                        <div class="col-lg-4 col-sm-4 hero-feature text-center">
                            <div class="thumbnail">
                                <a href="{{route('product', [$result->product->categories->slug, $result->product->slug])}}">
                                    {!! defaultProductImage($result->product) !!}
                                </a>

                                <div class="caption prod-caption">
                                    <h4>
                                        <a href="{{route('product', [$result->product->categories->slug, $result->product->slug])}}"
                                           class="color_dark">
                                            {{ $result->product->name }}
                                        </a>
                                    </h4>
                                    <p>
                                        Size: {{$result->width}} x {{$result->length}} x {{$result->height}}
                                        <br/>
                                        Weight: {{$result->weight}}<br/>
                                        Grade: {{$result->grade}}<br/>
                                    </p>
                                    <div class="btn-group">
                                        <a href="{{route('product', [$result->product->categories->slug, $result->product->slug])}}"
                                           class="btn btn-primary">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            <div class="row">
                <div class="col-md-12">
                    Sorry, we have no products for this search.
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="paginate">
                    {{$results->render()}}
                </div>
            </div>
        </div>
    </div>


@stop
