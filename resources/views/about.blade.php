@extends('layout')

@section('title', 'Visit / Contact SpaceWalk Online')

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-info">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="container main-container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">

                <!-- RECENT PRODUCT -->
                <div class="col-lg-12 col-md-12 col-sm-12 visible-lg visible-md">
                    <div class="no-padding">
                        <span class="title">RECENT PRODUCT</span>
                    </div>
                    <div class="thumbnail col-lg-12 col-md-12 col-sm-6 visible-lg visible-md text-center">
                        <a href="detail.html" class="link-p">
                            <img src="http://res.cloudinary.com/spacewalk/image/upload/e_trim,w_650/7090c33058c01488dd52e717e943b8fe.jpg" alt="">
                        </a>
                        <div class="caption prod-caption">
                            <h4><a href="detail.html">3 Lane Mega Thrill</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut, minima!</p>
                            <p>
                            <div class="btn-group">
                                <a href="about.html#" class="btn btn-default">$ 928.96</a>
                                <a href="about.html#" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Buy</a>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- End RECENT PRODUCT -->

            </div>

            <div class="clearfix visible-sm"></div>

            <!-- Cart -->
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="col-lg-12 col-sm-12">
                    <span class="title">ABOUT US</span>
                </div>
                <div class="col-lg-12 col-sm-12 hero-feature">
                    <h4>Lorem ipsum dolor sit amet conse ctetur adipisicing elit</h4>
                    <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <ul>
                        <li>Lorem ipsum dolor sit amet</li>
                        <li>Conse ctetur</li>
                        <li>Aadipisicing elit</li>
                        <li>Sed do eiusmod tempor</li>
                    </ul>
                    <h4>Dolor sit amet conse ctetur adipisicing elit</h4>
                    <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
            <!-- End Cart -->


        </div>
    </div>

@stop
