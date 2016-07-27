@extends('layout')

@section('title', 'Contact')

@section('content')

    <div class="container main-container">
        <div class="row">
            @include('flash::messages')
            @if(Session::has('message'))
                <div class="alert alert-info">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="col-lg-3 col-md-3 col-sm-12">

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="no-padding">
                        <span class="title">OUR LOCATION</span>
                    </div>
                    Online Shop<br/>
                    Street address<br/>
                    Store Town<br/>
                    ZIP
                    <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                            src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=cihanjuang&amp;sll=37.0625,-95.677068&amp;sspn=56.637293,79.013672&amp;ie=UTF8&amp;hq=&amp;hnear=Cihanjuang.,+Cimahi+Utara,+Cimahi,+Jawa+Barat,+Indonesia&amp;t=m&amp;z=14&amp;ll=-6.858623,107.5664&amp;output=embed"></iframe>
                    <br/>
                    <small>
                        <a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=cihanjuang&amp;sll=37.0625,-95.677068&amp;sspn=56.637293,79.013672&amp;ie=UTF8&amp;hq=&amp;hnear=Cihanjuang.,+Cimahi+Utara,+Cimahi,+Jawa+Barat,+Indonesia&amp;t=m&amp;z=14&amp;ll=-6.858623,107.5664"
                           style="color:#0000FF;text-align:left">View Larger Map</a></small>
                </div>
                <!-- End OUR LOCATION -->

            </div>

            <div class="clearfix visible-sm"></div>


            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="col-lg-12 col-sm-12">
                    <span class="title">CONTACT US</span>
                </div>
                <div class="col-lg-12 col-sm-12 hero-feature">
                    <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    {{ open(['route' => 'contact.post']) }}

                    <div class="row form-group">
                        <div class="col-md-12">
                            {{ label('name', 'Your Name') }}
                            {{ input('text','name', old('name'), ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            {{ label('email', 'Email') }}
                            {{ input('email','email', old('email'), ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>


                    <div class="row form-group">
                        <div class="col-md-12">
                            {{ label('message', 'Message')}}
                            {{ textarea('message', old('message'), ['class' => 'form-control', 'rows' => 10, 'required']) }}
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <div class="btn-group btns-cart">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
