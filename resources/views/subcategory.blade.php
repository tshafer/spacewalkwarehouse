@extends('layout')

@section('title')  @stop

@section('content')

        <!--breadcrumbs-->
@include('partials.breadcrumb', ['category' => $subcategory])

<div class="page_content_offset">
    <div class="container">
        @if($category->title)
            <h2 class="tt_uppercase m_bottom_20 color_dark heading1 animate_ftr">{{$subcategory->title}}</h2>
        @endif

        <div class="row clearfix">
            @if($subcategory->intro_text)
                <section class="col-lg-8 col-md-8 col-sm-8 m_bottom_25">
                    {{$subcategory->intro_text}}
                </section>
            @endif
            <aside class="col-lg-4 col-md-4 col-sm-4 m_xs_bottom_30">
                <h5 class="fw_medium m_bottom_10">Featured Manufacturers</h5>
                <p class="m_bottom_10"><i class="fa fa-angle-double-right"></i> Tropitone & Telescope Casual</p>
            </aside>
        </div>

        <!--products-->
        <section class="products_container clearfix m_bottom_25 m_sm_bottom_15">
            <!--product item-->
            <div class="product_item">
                <figure class="r_corners photoframe shadow relative hit animate_ftb long">
                    <!--product preview-->
                    <a href="subcategory.html#" class="d_block relative pp_wrap">
                        <img src="images/pdh/subcategory-outdoor-aluminum-tropitone-ur-comfort.jpg"
                             class="tr_all_hover" alt="">
                    </a>
                    <!--description of product-->
                    <figcaption>
                        <h4>Tropitone</h4>
                        <h5 class="m_bottom_10"><a href="product.html" class="color_dark">URComfort Montreux
                                Cushion</br>Seating</a></h5>
                        <a href="product.html">
                            <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">
                                view details
                            </button>
                        </a>
                    </figcaption>
                </figure>
            </div>
            <!--product item-->
            <div class="product_item">
                <figure class="r_corners photoframe shadow relative hit animate_ftb long">
                    <!--product preview-->
                    <a href="subcategory.html#" class="d_block relative pp_wrap">
                        <img src="images/pdh/subcategory-outdoor-aluminum-tropitone-radiance-sling-dining.jpg"
                             class="tr_all_hover" alt="">
                    </a>
                    <!--description of product-->
                    <figcaption>
                        <h4>Tropitone</h4>
                        <h5 class="m_bottom_10"><a href="subcategory.html#" class="color_dark">Radiance Sling
                                Dining</a></h5>
                        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">view
                            details
                        </button>
                    </figcaption>
                </figure>
            </div>

        </section>
        @include('partials.banners')
    </div>


</div>

@stop
