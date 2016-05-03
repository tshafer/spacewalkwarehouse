
@extends('layout')

@section('title') Sign into PDH.com @stop

@section('content')
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
            <li class="m_right_5 m_bottom_10 m_xs_bottom_5 animate_ftr">
                <button class="button_type_2 bg_light_color_1 r_corners tr_delay_hover tt_uppercase box_s_none"
                        data-filter=".indoor">Indoor
                </button>
            </li>
            <li class="m_right_5 m_bottom_10 m_xs_bottom_5 animate_ftr">
                <button class="button_type_2 bg_light_color_1 r_corners tr_delay_hover tt_uppercase box_s_none"
                        data-filter=".outdoor">Outdoor
                </button>
            </li>
            <li class="m_right_5 m_bottom_10 m_xs_bottom_5 animate_ftr">
                <button class="button_type_2 bg_light_color_1 r_corners tr_delay_hover tt_uppercase box_s_none"
                        data-filter=".fireplace_and_hearth">Fireplace & Hearth
                </button>
            </li>
        </ul>
        <!--products-->
        <section class="products_container clearfix m_bottom_25 m_sm_bottom_15">
            <!--product item-->
            <div class="product_item indoor">
                <figure class="r_corners photoframe shadow relative hit animate_ftb long">
                    <!--product preview-->
                    <a href="index.html#" class="d_block relative pp_wrap">
                        <img src="images/pdh/home-furniture-indoor-wicker-rattan.jpg" class="tr_all_hover" alt="">
                    </a>
                    <!--description and price of product-->
                    <figcaption>
                        <h5 class="m_bottom_10"><a href="index.html#" class="color_dark">Wicker & Rattan</a></h5>
                        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">see more
                            styles
                        </button>
                    </figcaption>
                </figure>
            </div>
            <!--product item-->
            <div class="product_item outdoor">
                <figure class="r_corners photoframe shadow relative hit animate_ftb long">
                    <!--product preview-->
                    <a href="index.html#" class="d_block relative pp_wrap">
                        <img src="images/pdh/home-furniture-outdoor-aluminum.jpg" class="tr_all_hover" alt="">
                    </a>
                    <!--description and price of product-->
                    <figcaption>
                        <h5 class="m_bottom_10"><a href="index.html#" class="color_dark">Aluminum</a></h5>
                        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">see more
                            styles
                        </button>
                    </figcaption>
                </figure>
            </div>
            <!--product item-->
            <div class="product_item outdoor">
                <figure class="r_corners photoframe shadow relative hit animate_ftb long">
                    <!--product preview-->
                    <a href="index.html#" class="d_block relative pp_wrap">
                        <img src="images/pdh/home-furniture-outdoor-cast-aluminum.jpg" class="tr_all_hover" alt="">
                    </a>
                    <!--description and price of product-->
                    <figcaption>
                        <h5 class="m_bottom_10"><a href="index.html#" class="color_dark">Cast Aluminum</a></h5>
                        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">see more
                            styles
                        </button>
                    </figcaption>
                </figure>
            </div>
            <!--product item-->
            <div class="product_item outdoor">
                <figure class="r_corners photoframe shadow relative hit animate_ftb long">
                    <!--product preview-->
                    <a href="index.html#" class="d_block relative pp_wrap">
                        <img src="images/pdh/home-furniture-outdoor-wrought-aluminum.jpg" class="tr_all_hover" alt="">
                    </a>
                    <!--description and price of product-->
                    <figcaption>
                        <h5 class="m_bottom_10"><a href="index.html#" class="color_dark">Wrought Aluminum</a></h5>
                        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">see more
                            styles
                        </button>
                    </figcaption>
                </figure>
            </div>
            <!--product item-->
            <div class="product_item outdoor">
                <figure class="r_corners photoframe shadow relative hit animate_ftb long">
                    <!--product preview-->
                    <a href="index.html#" class="d_block relative pp_wrap">
                        <img src="images/pdh/home-furniture-outdoor-all-weather-wicker.jpg" class="tr_all_hover" alt="">
                    </a>
                    <!--description and price of product-->
                    <figcaption>
                        <h5 class="m_bottom_10"><a href="index.html#" class="color_dark">All-Weather Wicker</a></h5>
                        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">see more
                            styles
                        </button>
                    </figcaption>
                </figure>
            </div>
            <!--product item-->
            <div class="product_item outdoor">
                <figure class="r_corners photoframe shadow relative hit animate_ftb long">
                    <!--product preview-->
                    <a href="index.html#" class="d_block relative pp_wrap">
                        <img src="images/pdh/home-furniture-outdoor-wood.jpg" class="tr_all_hover" alt="">
                    </a>
                    <!--description and price of product-->
                    <figcaption>
                        <h5 class="m_bottom_10"><a href="index.html#" class="color_dark">Wood</a></h5>
                        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">see more
                            styles
                        </button>
                    </figcaption>
                </figure>
            </div>
            <!--product item-->
            <div class="product_item outdoor">
                <figure class="r_corners photoframe shadow relative hit animate_ftb long">
                    <!--product preview-->
                    <a href="index.html#" class="d_block relative pp_wrap">
                        <img src="images/pdh/home-furniture-outdoor-marine-grade-polymer.jpg" class="tr_all_hover"
                             alt="">
                    </a>
                    <!--description and price of product-->
                    <figcaption>
                        <h5 class="m_bottom_10"><a href="index.html#" class="color_dark">Marine Grade Polymer</a></h5>
                        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">see more
                            styles
                        </button>
                    </figcaption>
                </figure>
            </div>
            <!--product item-->
            <div class="product_item outdoor">
                <figure class="r_corners photoframe shadow relative hit animate_ftb long">
                    <!--product preview-->
                    <a href="index.html#" class="d_block relative pp_wrap">
                        <img src="images/pdh/home-furniture-outdoor-misc-accessories.jpg" class="tr_all_hover" alt="">
                    </a>
                    <!--description and price of product-->
                    <figcaption>
                        <h5 class="m_bottom_10"><a href="index.html#" class="color_dark">Misc. & Accessories</a></h5>
                        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">see more
                            styles
                        </button>
                    </figcaption>
                </figure>
            </div>
            <!--product item-->
            <div class="product_item fireplace_and_hearth">
                <figure class="r_corners photoframe shadow relative hit animate_ftb long">
                    <!--product preview-->
                    <a href="index.html#" class="d_block relative pp_wrap">
                        <img src="images/pdh/home-furniture-fireplace-and-hearth-fire-pits.jpg" class="tr_all_hover"
                             alt="">
                    </a>
                    <!--description and price of product-->
                    <figcaption>
                        <h5 class="m_bottom_10"><a href="index.html#" class="color_dark">Fire Pits</a></h5>
                        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">see more
                            styles
                        </button>
                    </figcaption>
                </figure>
            </div>
            <!--product item-->
            <div class="product_item fireplace_and_hearth">
                <figure class="r_corners photoframe shadow relative hit animate_ftb long">
                    <!--product preview-->
                    <a href="index.html#" class="d_block relative pp_wrap">
                        <img src="images/pdh/home-furniture-fireplace-and-hearth-gas-burning.jpg" class="tr_all_hover"
                             alt="">
                    </a>
                    <!--description and price of product-->
                    <figcaption>
                        <h5 class="m_bottom_10"><a href="index.html#" class="color_dark">Gas Burning</a></h5>
                        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">see more
                            styles
                        </button>
                    </figcaption>
                </figure>
            </div>
            <!--product item-->
            <div class="product_item fireplace_and_hearth">
                <figure class="r_corners photoframe shadow relative hit animate_ftb long">
                    <!--product preview-->
                    <a href="index.html#" class="d_block relative pp_wrap">
                        <img src="images/pdh/home-furniture-fireplace-and-hearth-wood-burning.jpg" class="tr_all_hover"
                             alt="">
                    </a>
                    <!--description and price of product-->
                    <figcaption>
                        <h5 class="m_bottom_10"><a href="index.html#" class="color_dark">Wood Burning</a></h5>
                        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">see more
                            styles
                        </button>
                    </figcaption>
                </figure>
            </div>
            <!--product item-->
            <div class="product_item fireplace_and_hearth">
                <figure class="r_corners photoframe shadow relative hit animate_ftb long">
                    <!--product preview-->
                    <a href="index.html#" class="d_block relative pp_wrap">
                        <img src="images/pdh/home-furniture-fireplace-and-hearth-electric-fireplaces.jpg"
                             class="tr_all_hover" alt="">
                    </a>
                    <!--description and price of product-->
                    <figcaption>
                        <h5 class="m_bottom_10"><a href="index.html#" class="color_dark">Electric Fireplaces</a></h5>
                        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">see more
                            styles
                        </button>
                    </figcaption>
                </figure>
            </div>
            <!--product item-->
            <div class="product_item fireplace_and_hearth">
                <figure class="r_corners photoframe shadow relative hit animate_ftb long">
                    <!--product preview-->
                    <a href="index.html#" class="d_block relative pp_wrap">
                        <img src="images/pdh/home-furniture-fireplace-and-hearth-glass-doors-screens.jpg"
                             class="tr_all_hover" alt="">
                    </a>
                    <!--description and price of product-->
                    <figcaption>
                        <h5 class="m_bottom_10"><a href="index.html#" class="color_dark">Glass Doors & Screens</a></h5>
                        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">see more
                            styles
                        </button>
                    </figcaption>
                </figure>
            </div>
            <!--product item-->
            <div class="product_item fireplace_and_hearth">
                <figure class="r_corners photoframe shadow relative hit animate_ftb long">
                    <!--product preview-->
                    <a href="index.html#" class="d_block relative pp_wrap">
                        <img src="images/pdh/home-furniture-fireplace-and-hearth-stainless-steel-burners.jpg"
                             class="tr_all_hover" alt="">
                    </a>
                    <!--description and price of product-->
                    <figcaption>
                        <h5 class="m_bottom_10"><a href="index.html#" class="color_dark">Stainless Steel Burners</a>
                        </h5>
                        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">see more
                            styles
                        </button>
                    </figcaption>
                </figure>
            </div>
            <!--product item-->
            <div class="product_item fireplace_and_hearth">
                <figure class="r_corners photoframe shadow relative hit animate_ftb long">
                    <!--product preview-->
                    <a href="index.html#" class="d_block relative pp_wrap">
                        <img src="images/pdh/home-furniture-fireplace-and-hearth-accessories.jpg" class="tr_all_hover"
                             alt="">
                    </a>
                    <!--description and price of product-->
                    <figcaption>
                        <h5 class="m_bottom_10"><a href="index.html#" class="color_dark">Fire Accessories</a></h5>
                        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">see more
                            styles
                        </button>
                    </figcaption>
                </figure>
            </div>
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
            <a href="index.html#" class="d_block t_align_c animate_fade"><img src="images/pdh/logo-braxton-culler.png"
                                                                              alt="Braxton Cullter"></a>
            <a href="index.html#" class="d_block t_align_c animate_fade"><img src="images/pdh/logo-hanamint.png"
                                                                              alt="Hanamint"></a>
            <a href="index.html#" class="d_block t_align_c animate_fade"><img src="images/pdh/logo-jensen-leisure.png"
                                                                              alt="Jensen Leisure"></a>
            <a href="index.html#" class="d_block t_align_c animate_fade"><img src="images/pdh/logo-lloyd-flanders.png"
                                                                              alt="Lloyd Flanders"></a>
            <a href="index.html#" class="d_block t_align_c animate_fade"><img
                        src="images/pdh/logo-patio-renaissance.png" alt="Patio Renaissance"></a>
            <a href="index.html#" class="d_block t_align_c animate_fade"><img src="images/pdh/logo-summer-classics.png"
                                                                              alt="Summer Classics"></a>
            <a href="index.html#" class="d_block t_align_c animate_fade"><img src="images/pdh/logo-telescope-casual.png"
                                                                              alt="Telescope Casual"></a>
            <a href="index.html#" class="d_block t_align_c animate_fade"><img src="images/pdh/logo-tropitone.png"
                                                                              alt="Tropitone"></a>
            <a href="index.html#" class="d_block t_align_c animate_fade"><img src="images/pdh/logo-windham.png"
                                                                              alt="Windham"></a>
        </div>
        <!--banners-->
        <div class="row clearfix">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <a href="index.html#"
                   class="d_block animate_ftb h_md_auto m_xs_bottom_15 banner_type_2 r_corners red t_align_c tt_uppercase vc_child n_sm_vc_child">
								<span class="d_inline_middle">
									<img class="d_inline_middle m_md_bottom_5" src="images/banner_img_3.png" alt="">
									<span class="d_inline_middle m_left_10 t_align_l d_md_block t_md_align_c">
										<b>Largest Selection</b><br><span class="color_dark">In Northeast Ohio</span>
									</span>
								</span>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <a href="index.html#"
                   class="d_block animate_ftb h_md_auto m_xs_bottom_15 banner_type_2 r_corners green t_align_c tt_uppercase vc_child n_sm_vc_child">
								<span class="d_inline_middle">
									<img class="d_inline_middle m_md_bottom_5" src="images/banner_img_4.png" alt="">
									<span class="d_inline_middle m_left_10 t_align_l d_md_block t_md_align_c">
										<b>Delivery and Setup</b><br><span class="color_dark">Available</span>
									</span>
								</span>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <a href="index.html#"
                   class="d_block animate_ftb h_md_auto banner_type_2 r_corners orange t_align_c tt_uppercase vc_child n_sm_vc_child">
								<span class="d_inline_middle">
									<img class="d_inline_middle m_md_bottom_5" src="images/banner_img_5.png" alt="">
									<span class="d_inline_middle m_left_10 t_align_l d_md_block t_md_align_c">
										<b>Special Orders</b><br><span class="color_dark">Are Our Speciality</span>
									</span>
								</span>
                </a>
            </div>
        </div>
    </div>
</div>

@stop
