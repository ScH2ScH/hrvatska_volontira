<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="utf-8"/>

    <title>{{{$title or 'Hrvatska volontira'}}}</title>

    <meta name="keywords" content="{{{ $meta_keywords or '' }}}"/>
    <meta name="author" content="{{{ $author or '' }}}"/>
    <meta name="description" content="{{{ $meta_description  or ''}}}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @yield('social-tags')

    <!--Favicons-->
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('assets/images/icons/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('assets/images/icons/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/images/icons/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/images/icons/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/images/icons/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets/images/icons/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('assets/images/icons/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/images/icons/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/images/icons/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('assets/images/icons//android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/images/icons//favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/images/icons//favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/icons//favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets/images/icons//manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('assets/images/icons//ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    @section('stylesheets')
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.css">

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2-bootstrap.min.css">

        <link rel="stylesheet" href="{{asset('assets/css/site-theme.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/site-style.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/select2-bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/owl.theme.css')}}">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700,800&subset=latin,latin-ext'
              rel='stylesheet' type='text/css'>
        <link href='//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css' rel='stylesheet'
              type='text/css'>
        <link rel="stylesheet"
              href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>
        <link rel="stylesheet" href="http://css-spinners.com/css/spinner/spinner.css" type="text/css">    @show
</head>

<body>
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&appId=373029106155439&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

@section('header')
    @include('Site.Modules.header')
@show

@section('navigation')
    @include('Site.Modules.navigation')
@show

@section('notifications')
    <div class="global-notifications text-center">
        @if (Session::get('error'))
            <div class="alert alert-error alert-danger">{{{ Session::get('error') }}}</div>
        @endif

        @if (Session::get('notice'))
            <div class="alert alert-success">{{{ Session::get('notice') }}}</div>
        @endif
    </div>
@show

@yield('content')

@section('footer')
    @include('Site.Modules.footer')
@show

@section('scripts')
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" language="javascript"
            src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript"
            src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script type="text/javascript" language="javascript"
            src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js"></script>
    <script type="text/javascript"
            src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>

    <script type="text/javascript" language="javascript"
            src="//cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2.min.js"></script>


    <script type="text/javascript" language="javascript" src="{{asset('assets/js/site/site-application.js')}}"></script>
    <script type="text/javascript" language="javascript"
            src="{{asset('assets/js/site/site-sticky-footer.js')}}"></script>
    <script type="text/javascript" language="javascript"
            src="{{asset('assets/js/site/owl.carousel.min.js')}}"></script>

    <script>
        var homeUrl = "{{ URL::route('Site.Home') }}";
        var usernameCheckUrl = "{{ URL::route('Api.CheckUsername') }}";
        var emailCheckUrl = "{{ URL::route('Api.CheckEmail') }}";

        jQuery(function () {

            console.log("ready");

            jQuery(".fancybox").fancybox({
                openEffect: 'none',
                closeEffect: 'none',
                helpers: {
                    overlay: {
                        locked: false
                    }
                }
            });

            jQuery(".select2").select2();

            // Closes the sidebar menu
            jQuery("#menu-close").click(function (e) {
                e.stopPropagation();
                jQuery("#sidebar-wrapper").toggleClass("active");
            });

            // Opens the sidebar menu
            jQuery("#menu-toggle").on('click', function (e) {
                e.stopPropagation();
                jQuery("#sidebar-wrapper").toggleClass("active");
            });

            jQuery('a.scrollable[href*=#]:not([href=#])').click(function () {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                    var target = $(this.hash);
                    target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        jQuery('html,body').animate({
                            scrollTop: target.offset().top
                        }, 1000);
                        return false;
                    }
                }
            });
        });
    </script>

@show
</body>
</html>
