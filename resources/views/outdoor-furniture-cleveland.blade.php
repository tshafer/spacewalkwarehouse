@extends('layout')

@section('keywords') furniture, patio, deck, hearth, cleveland, ohio, northeast, ohio, cuyahoga, geauga, lake, portage, akron, outdoor furniture, wicker furniture, wicker, outdoor, chairs, ratton @stop

@section('title') Patio, Deck & Hearth Shop:  Perfect Patios and Decks near Cleveland" @stop

@section('content')

    <div class="page_content_offset outdoor-cleveland">
        <div class="container">
            <div class="row clearfix">
                <div class="col-md-12">


                    <h1>PERFECT PATIOS & DECKS IN CLEVELAND</h1>

                    <br>
                    We've furnished some of the most perfect patios and decks in Northeast Ohio.</b> Below are links to
                    nine Cleveland-area photo galleries showcasing a variety of our outdoor furniture brands, styles and materials.
                    From Sagamore Hills to South Russell, we've created an outdoor space just waiting to inspire you.<br><br>


                    @foreach ($xml->Gallery as $gallery)
                        <div class="row title clearfix">
                            <div class="col-md-12">
                                <a href="{{config('app.public_url')}}/cleveland-patio-deck-furniture/{{$gallery->ID }}{{$gallery->KeywordsForURL}}"
                                   class="galleryTitle">{{ $gallery->Title }}</a>
                            </div>
                        </div>

                        <div class="row images clearfix">
                            <div class="col-md-12">
                                <?php $style = "style='border: 1px solid #000000;'";?>
                                @foreach ($gallery->TeaserPhotos->TeaserPhoto as $i => $Photo)
                                    <a href="{{ config('app.public_url') }}/cleveland-patio-deck-furniture/{{$gallery->ID }}/{{ $gallery->KeywordsForURL }}">
                                        <img src="{{ config('app.public_url') }}/images/perfect-patios-decks/thumbnails/IMG_{{$Photo}}.jpg"
                                             width="219"
                                             height="146" {{ $style }}>
                                    </a>
                                    <?php $style = "style='border-right: 1px solid #000000; border-top: 1px solid #000000; border-bottom: 1px solid#000000;'"; ?>
                                @endforeach
                            </div>
                        </div>

                        <div class="row clearfix description">
                            <div class="col-md-12">
                                <a href="{{ config('app.public_url') }}/cleveland-patio-deck-furniture/{{$gallery->ID }}/{{ $gallery->KeywordsForURL}}">
                                    {{ $gallery->Description }}
                                </a>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>

@stop
