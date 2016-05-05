@extends('layout')

@section('title')  @stop

@section('content')
        <!--breadcrumbs-->
@include('partials.breadcrumb', ['category' => $category])

        <!--content-->
<div class="page_content_offset">
    <div class="container">
        @if($category->title)
            <h2 class="tt_uppercase m_bottom_20 color_dark heading1 animate_ftr">
                {{$category->title}}
            </h2>
        @endif

        @if($category->intro_text)
            <div class="row clearfix">
                <section class="col-lg-8 col-md-8 col-sm-8 m_bottom_25">
                    <p class="m_bottom_10">{{$category->intro_text}}</p>
                </section>
            </div>@endif

                    <!--products-->
            <section class="products_container clearfix m_bottom_25 m_sm_bottom_15">
                <!--product item-->

                @foreach($category->children()->whereEnabled(1)->get() as $child)
                    <div class="product_item">
                        <figure class="r_corners photoframe shadow relative hit animate_ftb long">
                            <!--product preview-->
                            <a href="{{route('subcategory',[$category->slug, $child->slug])}}" class="d_block relative pp_wrap">
                                <img src="{{url('/')}}{{$child->getMedia('categories')->first()->getUrl('thumb')}}"
                                     class="tr_all_hover"
                                     alt="{{$child->name}}">
                            </a>
                            <!--description and price of product-->
                            <figcaption>
                                <h5 class="m_bottom_10">
                                    <a href="{{route('subcategory',[$category->slug, $child->slug])}}" class="color_dark">{{$child->name}}</a>
                                </h5>
                                <a href="{{route('subcategory',[$category->slug, $child->slug])}}">
                                    <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">
                                        see more styles
                                    </button>
                                </a>
                            </figcaption>
                        </figure>
                    </div>
                @endforeach

            </section>
            <!--banners-->
            @include('partials.banners')
    </div>
@stop
