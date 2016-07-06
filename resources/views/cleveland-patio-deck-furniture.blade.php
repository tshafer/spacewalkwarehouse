@extends('layout')

@section('keywords') furniture, patio, deck, hearth, cleveland, ohio, northeast, ohio, cuyahoga, geauga, lake, portage, akron, outdoor furniture, wicker furniture, wicker, outdoor, chairs, ratton @stop

@section('title') Patio, Deck & Hearth Shop: {{ $galleryTitle }} - Perfect Patios and Decks near Cleveland" @stop

@section('content')

    <div class="page_content_offset outdoor-cleveland">
        <div class="container cleveland-patio-deck-furniture">

            <div class="row clearfix">
                <div class="col-md-12">
                    <h2>PERFECT PATIOS & DECKS IN CLEVELAND</h2>
                    <h1>{{ $galleryTitle }}</h1>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-md-12">
                    <b>{{ $galleryDescription }}</b>
                    @if($galleryPhotos)

                        <ul id="imageGallery">
                            @foreach ($galleryPhotos as $photo)
                                <li data-thumb="{{ config('app.public_url') }}/images/perfect-patios-decks/thumbnails/IMG_{{$photo}}.jpg"
                                    data-src="{{ config('app.public_url') }}/images/perfect-patios-decks/fullsized/IMG_{{$photo}}.jpg">
                                    <img src="{{ config('app.public_url') }}/images/perfect-patios-decks/fullsized/IMG_{{$photo}}.jpg"/>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <br/><br/>
                    <b>View more Perfect Patios & Decks:</b>
                    <?php $count = 0;?>
                    <table>
                        @foreach ($xml->Gallery as $gallery)
                            @if ($count % 2 == 0)
                                <tr>@endif
                                    <td>
                        <span style="font-family: Georgia,Arial,Verdana,Helvetica,sans-serif; font-size: 13px;">
                @if ($gallery->ID != $page)
                                <a href="{{ config('app.public_url') }}/cleveland-patio-deck-furniture/{{$gallery->ID}}/{{$gallery->KeywordsForURL}}"> {{$gallery->Title}}</a>
                            @else
                                {{ $gallery->Title }}
                            @endif
                </span></td>
                                    @if ($count % 2 == 1) </tr> @endif
                        @endforeach
                    </table>
                    <br><br>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    <h2>MORE STYLES ON DISPLAY IN OUR SHOWROOM</h2>
                    Patio, Deck & Hearth Shop is one of the leading outdoor furniture and fireplace stores in Cleveland,
                    Ohio. We take pride in our highly experienced and
                    knowledgeable staff, our unique and extensive selection, and our reputation for standing behind the
                    quality furniture we sell. Please stop by and see our showroom today.
                    <br><br>
                    <b><a href="{{ config('app.public_url') }}/visit-patio-deck-hearth-furniture">Click here</a> for hours and directions to our showroom or call (440) 564-2290.</b>
                </div>
            </div>

        </div>
    </div>

@stop
