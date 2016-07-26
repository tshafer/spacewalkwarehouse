<!doctype html>
<!--[if IE 9 ]>
<html class="ie9" lang="en"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en"><!--<![endif]-->
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="keywords" content=""/>
    <meta name="description" content="@yield('meta_description')">
    <!--<link rel="icon" type="image/ico" href="images/fav.ico">-->

    <link rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/css/jquery.bxslider.css">
    <link rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/css/style.css">
    <link rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/css/lightslider.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.2.19/css/lightgallery.min.css" />

</head>
<body>

<header>
    <div class="container">
        <div class="row">

            <!-- Logo -->
            <div class="col-md-3 hidden-sm hidden-xs">
                <div class="well logo">
                    <img src="/images/swlogo.png" class="img-responsive">
                </div>
            </div>
            <div class="col-md-9"></div>
        </div>
    </div>
</header>

<!-- Navigation -->
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- text logo on mobile view -->
            <a class="navbar-brand visible-xs" href={{route('home')}}>Space Walk</a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{route('home')}}" class="{{active_class('home')}}"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Home</a></li>
                <li class="nav-dropdown">
                    <a href="#" class="{{active_class('category/*')}} dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-list" aria-hidden="true"></i>&nbsp;Categories <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('category', $category->slug) }}" class="{{active_class('category/'.$category->slug.'/*')}}">
                                    @if($category->getMedia('categories')->first())
                                        <img src=" {{$category->getMedia('categories')->first()->getUrl('adminThumb')}}"
                                             class="menu-icon">
                                    @endif
                                    {{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="cart.html"><i class="fa fa-gift" aria-hidden="true"></i>&nbsp;Specials</a></li>
                <li><a href="checkout.html"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Checkout</a>
                </li>
                <li><a href="{{ route('contact') }}"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Contact</a>
                </li>
            </ul>
            <div class="pull-right cart-menu">
                <div class="btn-group btn-group-cart">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="pull-left"><i class="fa fa-shopping-cart icon-cart"></i></span>
                        <span class="pull-left">Shopping Cart: 2 item(s)</span>
                        <span class="pull-right"><i class="fa fa-caret-down"></i></span>
                    </button>
                    <ul class="dropdown-menu cart-content" role="menu">
                        <li>
                            <a href="detail.html">
                                <IMG SRC="http://res.cloudinary.com/spacewalk/image/upload/e_trim,w_80/7090c33058c01488dd52e717e943b8fe.jpg"><b>3
                                    Lane Mega Thrillt</b>
                                <span>x1 $528.96</span>
                            </a>
                        </li>
                        <li>
                            <a href="detail.html">
                                <IMG SRC="http://res.cloudinary.com/spacewalk/image/upload/e_trim,w_80/7090c33058c01488dd52e717e943b8fe.jpg"><b>3
                                    Lane Mega Thrillt</b>
                                <span>x1 $528.96</span>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="cart.html">Total: $957.92</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>