@extends('layout')

@section('keywords') furniture, patio, deck, hearth, cleveland, ohio, northeast, ohio, cuyahoga, geauga, lake, portage, akron, outdoor furniture, wicker furniture, wicker, outdoor, chairs, ratton @stop

@section('title') Visit / Contact Patio Deck & Hearth Shop @stop

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-info">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="page_content_offset">
        <div class="container">
            <div class="row clearfix">
                <section class="col-md-12">
                    <h2 class="tt_uppercase color_dark m_bottom_25">Visit / Contact Patio Deck & Hearth Shop</h2>
                    <div class="r_corners photoframe map_container shadow m_bottom_45 google-maps">
                        <iframe src="http://www.maps.ie/create-google-map/map.php?width=100%&amp;height=600&amp;hl=en&amp;q=10359%20Kinsman%20Rd.%20Newbury%2C%20Ohio%2044065+(Patio%2C%20Deck%20%26%20Hearth%20Shop)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=A&amp;output=embed"
                                frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-12 m_xs_bottom_30" style="margin-bottom: 30px;">
                            <h2 class="tt_uppercase color_dark m_bottom_25">Contact Info</h2>
                            <ul class="c_info_list">
                                <li class="m_bottom_10">
                                    <div class="clearfix m_bottom_15">
                                        <i class="fa fa-map-marker f_left color_dark"></i>
                                        <p class="contact_e">15 minutes east of Chagrin Falls<br/>
                                            10359 Kinsman Rd. (Route 87)<br/>
                                            Newbury, Ohio 44065</p>
                                    </div>
                                </li>
                                <li class="m_bottom_10">
                                    <div class="clearfix m_bottom_10">
                                        <i class="fa fa-phone f_left color_dark"></i>
                                        <p class="contact_e">phone: (440) 564-2290</p>
                                        <p class="contact_e">fax: (440) 564-2295</p>
                                    </div>
                                </li>
                                {{--<li class="m_bottom_10">--}}
                                {{--<div class="clearfix m_bottom_10">--}}
                                {{--<i class="fa fa-envelope f_left color_dark"></i>--}}
                                {{--<a class="contact_e default_t_color" href="mailto:#">info@companyname--}}
                                {{--.com</a>--}}
                                {{--</div>--}}
                                {{--</li>--}}
                                <li>
                                    <div class="clearfix">
                                        <i class="fa fa-clock-o f_left color_dark"></i>
                                        <p class="contact_e">Monday through Friday: 10 AM - 6 PM<br/>
                                            Saturday: 10 AM - 5 PM<br/>
                                            Sunday: Noon - 5 PM</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 m_xs_bottom_30">
                            <h2 class="tt_uppercase color_dark m_bottom_25">Contact Form</h2>
                            <p class="m_bottom_10">Send an email. All fields with an <span
                                        class="scheme_color">*</span> are required.</p>
                            {{ open(['route' => 'contact.post']) }}
                            <ul>
                                <li class="clearfix m_bottom_15">
                                    <div class="f_left half_column">
                                        {{ label('name', 'Your Name', ['class' => 'required d_inline_b m_bottom_5']) }}
                                        {{ input('text','name', old('name'), ['class' => 'full_width r_corners']) }}
                                    </div>
                                    <div class="f_left half_column">
                                        {{ label('email', 'Email', ['class' => 'required d_inline_b m_bottom_5']) }}
                                        {{ input('email','email', old('email'), ['class' => 'full_width r_corners']) }}
                                    </div>
                                </li>
                                <li class="m_bottom_15">
                                    {{ label('message', 'Message', ['class' => 'required m_bottom_5 m_bottom_5'])}}
                                    {{ textarea('message', old('message'), ['class' => 'full_width r_corners', 'rows' => 10]) }}
                                </li>
                                <li>
                                    <button class="button_type_4 bg_light_color_2 r_corners mw_0 tr_all_hover color_dark">
                                        Send
                                    </button>
                                </li>
                            </ul>
                            {{close()}}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@stop
