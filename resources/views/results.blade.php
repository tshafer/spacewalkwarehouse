@extends('layout')

@section('title', 'Search Results for: '.$query )

@section('content')
    
    <div class="container main-container">
         <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="well">
                    {{Form::open(['route' => 'search','style' => 'margin-bottom: 0px', ])}}
                    <div class="input-group">

                        {{ Form::input('text', 'q', $query, ['class' => 'form-control input-search','placeholder' => 'Enter Something to Search']) }}
                        <span class="input-group-btn">
                            <button class="btn btn-default no-border-left" type="submit" style="padding: 9px;"><i class="fa fa-search"></i>
                            </button>
                        </span>

                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <span class="title">Search Results for: {{ $query }}</span>
            </div>
        </div>

        @if($results->count() > 0)
            @foreach($results->groupByType() as $type => $modelSearchResults)
                <div class="row">
                    @foreach($modelSearchResults as $searchResult)
                        @if(!$searchResult->searchable->product)
                            @continue
                        @endif
                        <div class="col-lg-4 col-sm-4 hero-feature text-center">
                            <div class="thumbnail">
                                <a href="{{ $searchResult->url }}">
                                    {!! defaultProductImage($searchResult->searchable->product) !!}
                                </a>

                                <div class="caption prod-caption">
                                    <h4>
                                        <a href="{{$searchResult->url}}"
                                           class="color_dark">
                                            {{ $searchResult->searchable->product->name }}
                                        </a>
                                    </h4>
                                    <p>
                                        Size: {{$searchResult->searchable->width}} x {{$searchResult->searchable->length}} x {{$searchResult->searchable->height}}
                                        <br/>
                                        Weight: {{$searchResult->searchable->weight}}<br/>
                                        Grade: {{$searchResult->searchable->grade}}<br/>
                                    </p>
                                    <div class="btn-group">
                                        <a href="{{ $searchResult->url }}"
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
    </div>


@stop
