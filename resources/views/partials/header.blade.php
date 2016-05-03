
<head>
    <meta charset="UTF-8">
    <title> @yield('title') | Washingtonian</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="/apple-touch-icon-57x57-precomposed.png"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <meta http-equiv="cleartype" content="on">

    <link rel="stylesheet" href="/assets/blogs.css">
    <link rel="stylesheet" href="/assets/footer.css">
    <link rel="stylesheet" href="/assets/bootstrap.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <meta name="robots" content="all" />
    <meta name="google-site-verification" content="vvVTsFEd7-c5BCuE1p4P_yz2s99Ensy3QhC-odFrCjQ" />
    <meta property="fb:admins" content="100002475007199" />
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="{{ elixir("assets/js/vendor.js") }}"></script>
    <script src="{{ elixir("assets/js/app.js") }}"></script>
    <script src="/assets/js/jquery.inputmask.bundle.js"></script>
>
    {{--<script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=washaddthis" async="async"></script>--}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.1/jquery.form-validator.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    @yield('styles')
    <style type="text/css">
        #content-container {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
        h1 {
            font-size: 15px;
            padding: 10px 0 20px 0;
        }
        .alert.alert-danger {
            font-size: 15px;
            padding: 20px;
        }
        .alert.alert-danger ul {
            margin-left: 20px;
            padding-left: 0;
            padding-top: 20px;
        }
        #form-body h4 {
            font-size: 17px;
            padding:20px 0;
        }
        #content-container label {
            font-size:13px;
        }
        #content-container h3 {
            font-weight: 200;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            letter-spacing: -1px;
            color: #343434;
            margin: 3px 0;
            font-size: 40px;
            text-transform: capitalize;
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
