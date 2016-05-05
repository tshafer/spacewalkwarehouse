<!doctype html>
<!--[if IE 9 ]>
<html class="ie9" lang="en"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en"><!--<![endif]-->
<head>
    <title>Patio Deck & Hearth Shop - Outdoor Furniture & Fireplaces - Cleveland, Ohio @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!--meta info-->
    <meta name="description" content="Cleveland's largest selection of indoor and outdoor furniture and fireplaces">
    <!--<link rel="icon" type="image/ico" href="images/fav.ico">-->
    <!--stylesheet include-->
    <link rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/css/settings.css">
    <link rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/css/owl.transitions.css">
    <link rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/css/jquery.custom-scrollbar.css">
    <link rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/css/style.css">
    <!--font include-->
    <link href="{{url('/')}}/css/font-awesome.min.css" rel="stylesheet">
    <script src="{{url('/')}}/js/modernizr.js"></script>
</head>
<body>
<!--boxed layout-->
<div class="boxed_layout relative w_xs_auto">
    <!--[if (lt IE 9) | IE 9]>
    <div style="background:#fff;padding:8px 0 10px;">
        <div class="container" style="width:1170px;">
            <div class="row wrapper">
                <div class="clearfix" style="padding:9px 0 0;float:left;width:83%;"><i
                        class="fa fa-exclamation-triangle scheme_color f_left m_right_10"
                        style="font-size:25px;color:#e74c3c;"></i><b style="color:#e74c3c;">Attention! This page may not
                    display correctly.</b> <b>You are using an outdated version of Internet Explorer. For a faster,
                    safer
                    browsing experience.</b></div>
                <div class="t_align_r" style="float:left;width:16%;"><a
                        href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode"
                        class="button_type_4 r_corners bg_scheme_color color_light d_inline_b t_align_c" target="_blank"
                        style="margin-bottom:2px;">Update Now!</a></div>
            </div>
        </div>
    </div>
    <![endif]-->
    <!--markup header-->
    <header role="banner">
        <!--header top part-->
        <section class="h_top_part">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 t_xs_align_c">
                        <p class="f_size_small"><b class="color_dark">(440) 564-2290 | Cleveland's largest selection of
                                indoor and outdoor furniture and fireplaces.</b></p>
                    </div>
                </div>
            </div>
        </section>
        <!--header bottom part-->
        <section class="h_bot_part container">
            <div class="clearfix row">
                <div class="col-lg-12 col-md-12 col-sm-12 t_xs_align_c">
                    <span class="logotype">Patio, Deck & Hearth Shop</span>
                </div>
            </div>
        </section>
        <!--main menu container-->
        <section class="menu_wrap relative">
            <div class="container clearfix">
                <!--button for responsive menu-->
                <button id="menu_button" class="r_corners centered_db d_none tr_all_hover d_xs_block m_bottom_10">
                    <span class="centered_db r_corners"></span>
                    <span class="centered_db r_corners"></span>
                    <span class="centered_db r_corners"></span>
                </button>
                <!--main menu-->
                <nav role="navigation" class="f_left f_xs_none d_xs_none">
                    <ul class="horizontal_list main_menu clearfix">
                        <li class="{{active_class('/')}}" relative f_xs_none m_xs_bottom_5">
                        <a href="{{url('/')}}" class="tr_delay_hover color_light tt_uppercase"><b>Home</b></a>
                        </li>
                        @foreach($categories as $category)
                            <li class="relative f_xs_none m_xs_bottom_5">
                                <a href="{{route('category', $category->slug)}}"
                                   class=" tr_delay_hover color_light tt_uppercase"><b> {{$category->name}}</b></a>
                                <!--sub menu-->
                                @if($category->children()->whereEnabled(1)->count() > 0)
                                    <div class="sub_menu_wrap top_arrow d_xs_none type_2 tr_all_hover clearfix r_corners">
                                        <ul class="sub_menu">
                                            @foreach($category->children()->whereEnabled(1)->get() as $child)
                                                <li>
                                                    <a class="color_dark tr_delay_hover"
                                                       href="{{route('subcategory',[ $category->slug, $child->slug])}}">{{$child->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                        <li class="relative f_xs_none m_xs_bottom_5">
                            <a href="/contact" class="tr_delay_hover color_light tt_uppercase">
                                <b>Visit/Contact</b>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </section>
    </header>