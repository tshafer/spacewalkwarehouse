<!DOCTYPE html>
<html lang="en">
<head>
    <title>Washingtonian Fit Fest | Washingtonian Magazine</title>
    <meta charset="UTF-8">
    <meta name=description content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="http://vjs.zencdn.net/4.6/video-js.css" rel="stylesheet">
    <script src="http://vjs.zencdn.net/4.6/video.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/sweetalert.css">
    <script src="assets/js/sweetalert.min.js"></script>
    <!--[if IE 7]>
    <link rel="stylesheet" href="http://www.washingtonian.com/tickets/fitfest/fonts/fontello_V7/css/fontello-ie7.css">
    <![endif]-->
    @yield('styles')
</head>
<body>

<div class="container">

    <div class="main clearfix">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="schedule">
                <div class="bold">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

</div>

<!-- jQuery -->
<script src="//code.jquery.com/jquery.js"></script>
<!-- Bootstrap JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>


@yield('scripts')
</body>
</html>
