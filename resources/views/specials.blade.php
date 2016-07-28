@extends('layout')

@section('title', 'Specials')

@section('content')
    <div class="container main-container">
        <div class="row">

            <div class="col-md-12">
                <div class="col-lg-12 col-sm-12">
                    <span class="title">Specials</span>
                </div>
                <div class="col-lg-12 col-sm-12 hero-feature">
                    @foreach($specials as $special)
                        <h3>{{$special->title}}</h3>
                        @if($special->getMedia('specials')->count() > 0)
                            <img src="{{url('/')}}{{$special->media->first()->getUrl()}}" alt="{{ $special->title }}" class="img-responsive"/>
                        @endif
                        {{ $special->description }}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
