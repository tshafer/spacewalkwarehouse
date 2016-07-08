@extends('layout')

@section('title','Patio, Deck & Hearth Shop:  Perfect Patios and Decks near Cleveland')

@section('meta_description', '')

@section('content')

    <div class="page_content_offset outdoor-cleveland">
        <div class="container">
            <div class="row clearfix">
                <div class="col-md-12">

                    <h1>PERFECT PATIOS & DECKS IN CLEVELAND</h1>

                    <p>We've furnished some of the most perfect patios and decks in Northeast Ohio.</b> Below are links to
                    nine Cleveland-area photo galleries showcasing a variety of our outdoor furniture brands, styles and
                    materials.
                    From Sagamore Hills to South Russell, we've created an outdoor space just waiting to inspire
                    you.</p>

                    @foreach (array_chunk($data['Gallery'],2) as $gallery)
                        <div class="row title clearfix">
                            @foreach($gallery as $galleryRows)
                                <div class="col-md-6">
                                    <a href=" {{ route('cleveland-patio-deck-furniture', [$galleryRows['ID'], $galleryRows['KeywordsForURL']]) }}"
                                       class="galleryTitle">{{ $galleryRows['Title'] }}</a>


                                    <div class="row images clearfix">
                                        <div class="col-md-12">
                                            <a href=" {{ route('cleveland-patio-deck-furniture', [$galleryRows['ID'], $galleryRows['KeywordsForURL']]) }}">
                                                <img src="{{ config('app.public_url') }}/images/perfect-patios-decks/fullsized/IMG_{{array_first($galleryRows['TeaserPhotos']['TeaserPhoto'])}}.jpg"
                                                     class="img-responsive">
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row clearfix description">
                                        <div class="col-md-12">
                                            <a href=" {{ route('cleveland-patio-deck-furniture', [$galleryRows['ID'], $galleryRows['KeywordsForURL']]) }}">
                                                {{ $galleryRows['Description'] }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@stop
