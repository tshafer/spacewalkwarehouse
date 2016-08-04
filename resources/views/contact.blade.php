@extends('layout')

@section('title', 'Contact')

@section('content')

    <div class="container main-container">
        <div class="row">
            @include('flash::messages')

            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="no-padding">
                    <span class="title">OUR LOCATION</span>
                </div>
                Space Walk Sales<br/>
                450 31st St.<br/>
                Kenner, LA 70065<br/>
                Phone:<br/>
                Email: {{ mailto('sales@herecomesfun.com', 'sales@herecomesfun.com') }}<br/>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="visible-xs visible-sm mobile-spacing"></div>
                <span class="title">CONTACT US</span>
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

@stop
