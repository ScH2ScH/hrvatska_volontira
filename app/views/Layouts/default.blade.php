<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>

    <title>{{{$title or ''}}}</title>

    <meta name="keywords" content="{{{ $meta_keywords or '' }}}"/>
    <meta name="author" content="{{{ $author or '' }}}"/>
    <meta name="description" content="{{{ $meta_description  or ''}}}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    @section('stylesheets')
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.css">
        <link rel="stylesheet" href="{{asset('assets/css/theme.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    @show


</head>

<body>
<div class="global-notifications">
    @section('notifications')
        @if (Session::get('error'))
            <div class="alert alert-error alert-danger">{{{ Session::get('error') }}}</div>
        @endif

        @if (Session::get('notice'))
            <div class="alert alert-success">{{{ Session::get('notice') }}}</div>
        @endif
    @show
</div>

@yield('content')

@section('scripts')
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" language="javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
@show
</body>
</html>
