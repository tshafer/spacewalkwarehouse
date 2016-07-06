@extends('layout')

@section('keywords') furniture, patio, deck, hearth, cleveland, ohio, northeast, ohio, cuyahoga, geauga, lake, portage, akron, outdoor furniture, wicker furniture, wicker, outdoor, chairs, ratton @stop

@section('title') Patio, Deck & Hearth Shop:  Perfect Patios and Decks near Cleveland" @stop

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-info">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="page_content_offset">
        <div class="container">
            <div class="row clearfix">
                <div class="col-md-12">

                    <!--left content column-->
                    <section class="col-md-12">
                        <h2 class="tt_uppercase color_dark m_bottom_25">Contact Us</h2>
                        <div class="r_corners photoframe map_container shadow m_bottom_45">
                            <div style="min-height:100%;max-width:100%;list-style:none; transition: none;overflow:hidden;"><div id="embed-map-canvas" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=10359+Kinsman+Rd.+(Route+87)+Newbury,+Ohio+44065&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU"></iframe></div><a class="embedded-map-html" href="https://www.dog-checks.com" id="enable-maps-data">dog checks</a><style>#embed-map-canvas img{max-width:none!important;background:none!important;font-size: inherit;}</style></div><script src="https://www.dog-checks.com/google-maps-authorization.js?id=9df8c80b-92bb-61e3-a25a-986817d1cb8b&c=embedded-map-html&u=1467837060" defer="defer" async="async"></script>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-12 m_xs_bottom_30" style="margin-bottom: 30px;">
                                <h2 class="tt_uppercase color_dark m_bottom_25">Contact Info</h2>
                                <ul class="c_info_list">
                                    <li class="m_bottom_10">
                                        <div class="clearfix m_bottom_15">
                                            <i class="fa fa-map-marker f_left color_dark"></i>
                                            <p class="contact_e">10 minutes east of Chagrin Falls<br/>
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
                                        {{ label('subject', 'Subject', ['class' => 'required d_inline_b m_bottom_5']) }}
                                        {{ input('text','subject', old('subject'), ['class' => 'full_width r_corners']) }}
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
    </div>

@stop
