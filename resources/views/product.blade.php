@extends('layout')

@section('title', $product->manufacturers()->first()->name.' - '.$product->name.' - Cleveland Ohio')

@section('meta_description', $product->meta_description)

@section('content')

@include('partials.breadcrumb', ['product' => $product])

<div class="page_content_offset">
    <div class="container">
        <h2 class="tt_uppercase m_bottom_20 color_dark heading1 animate_ftr">{{$product->manufacturers()->first()->name}}
            : {{ $product->name }}
            Seating</h2>
        <div class="row clearfix">
            <section class="col-lg-8 col-md-8 col-sm-8 m_bottom_25">
                <div class="photoframe r_corners shadow wrapper m_bottom_30">
                    @if($product->media->count())
                        <img src="{{url('/')}}{{$product->media->first()->getUrl('full')}}" alt="{{$product->name}}"
                             class="tr_all_long_hover">
                    @endif
                </div>
            </section>
            <section class="col-lg-4 col-md-4 col-sm-4 m_xs_bottom_30">
               {{$product->description }}<br/><br/>
                    <a href="{{route('contact')}}" class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">store hours
                        and directions
                    </a>
            </section>
        </div>
        @include('partials.banners')
    </div>
</div>

@stop
