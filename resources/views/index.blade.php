@extends('layout')

@section('title') Patio Deck & Hearth Shop - Outdoor Furniture & Fireplaces - Cleveland, Ohio @stop

@section('meta_description', '')

@section('content')

@include('partials.slider')
        <!--content-->
<div class="page_content_offset">
    <div class="container">
        <h2 class="tt_uppercase m_bottom_20 color_dark heading1 animate_ftr">All Categories</h2>
        <!--filter navigation of products-->

        <ul class="horizontal_list clearfix tt_uppercase isotope_menu f_size_ex_large">

            <li class="active m_right_5 m_bottom_10 m_xs_bottom_5 animate_ftr">
                <button class="button_type_2 bg_light_color_1 r_corners tr_delay_hover tt_uppercase box_s_none"
                        data-filter="*">All
                </button>
            </li>

            @foreach($categories as $category)
                @if($category->children()->whereEnabled(1)->count() > 0)
                    <li class="m_right_5 m_bottom_10 m_xs_bottom_5 animate_ftr">
                        <button class="button_type_2 bg_light_color_1 r_corners tr_delay_hover tt_uppercase box_s_none"
                                data-filter=".{{$category->slug}}">{{$category->name}}
                        </button>
                    </li>
                @endif
            @endforeach
        </ul>
        <section class="products_container clearfix m_bottom_25 m_sm_bottom_15">
            @foreach($categories as $category)
                @foreach($category->children()->whereEnabled(1)->get() as $child)
                    <div class="product_item {{$category->slug}}">
                        <figure class="r_corners photoframe shadow relative hit animate_ftb long">
                            <a href="{{route('subcategory',[$category->slug, $child->slug])}}" class="d_block relative pp_wrap">
                                <img src="{{url('/')}}{{$child->media->first()->getUrl('thumb')}}" class="tr_all_hover" alt="{{$child->name}}"/>
                            </a>
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
            @endforeach
        </section>
        <!--product brands-->
        <div class="clearfix m_bottom_25 m_sm_bottom_20">
            <h2 class="tt_uppercase color_dark f_left heading2 animate_fade f_mxs_none m_mxs_bottom_15">Featured
                Manufacturers</h2>
            <div class="f_right clearfix nav_buttons_wrap animate_fade f_mxs_none">
                <button class="button_type_7 bg_cs_hover box_s_none f_size_ex_large t_align_c bg_light_color_1 f_left tr_delay_hover r_corners pb_prev">
                    <i class="fa fa-angle-left"></i></button>
                <button class="button_type_7 bg_cs_hover box_s_none f_size_ex_large t_align_c bg_light_color_1 f_left m_left_5 tr_delay_hover r_corners pb_next">
                    <i class="fa fa-angle-right"></i></button>
            </div>
        </div>
        <!--product brands carousel-->
        <div class="product_brands m_bottom_45 m_sm_bottom_35">
            @foreach($manufacturers as $manufacturer)
                <img src="{{url('/')}}{{$manufacturer->media->first()->getUrl('thumb')}}" alt="{{$manufacturer->name}}">
            @endforeach
        </div>
        <!--banners-->
        @include('partials.banners')
    </div>
</div>

@stop
