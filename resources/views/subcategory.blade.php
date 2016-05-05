@extends('layout')

@section('title')  @stop

@section('content')

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
            @if($subcategory->manufacturers()->count())
                <aside class="col-lg-4 col-md-4 col-sm-4 m_xs_bottom_30">
                    <h5 class="fw_medium m_bottom_10">Featured Manufacturers</h5>
                    @foreach($subcategory->manufacturers()->get() as $manufacturer)
                        <p class="m_bottom_10"><i class="fa fa-angle-double-right"></i> {{$manufacturer->name}}</p>
                    @endforeach
                </aside>
            @endif
        </div>

        <!--products-->
        <section class="products_container clearfix m_bottom_25 m_sm_bottom_15">
            <!--product item-->
            @if($subcategory->products()->count() > 0)
                @foreach($subcategory->products()->get() as $product)
                    <div class="product_item">
                        <figure class="r_corners photoframe shadow relative hit animate_ftb long">
                            <!--product preview-->
                            <a href="{{route('product', [$category->slug, $subcategory->slug, $product->slug])}}" class="d_block relative pp_wrap">
                                @if($product->getMedia('products')->count() > 0)
                                    <img src="{{url('/')}}{{$product->getMedia('products')->first()->getUrl('thumb')}}"
                                         class="tr_all_hover" alt="{{ $product->name }}">
                                @endif
                            </a>
                            <!--description of product-->
                            <figcaption>
                                <h4>
                                    @if($product->manufacturers->count() > 0)
                                        @foreach($product->manufacturers as $manufacturer)
                                            {{$manufacturer->name}}<br/>
                                        @endforeach
                                    @endif
                                </h4>
                                <h5 class="m_bottom_10"><a href="{{route('product', [$category->slug, $subcategory->slug, $product->slug])}}" class="color_dark">
                                        {{ $product->name }}
                                    </a></h5>
                                <a href="{{route('product', [$category->slug, $subcategory->slug, $product->slug])}}">
                                    <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">
                                        view details
                                    </button>
                                </a>
                            </figcaption>
                        </figure>
                    </div>
                @endforeach
            @endif

        </section>
        @include('partials.banners')
    </div>


</div>

@stop
