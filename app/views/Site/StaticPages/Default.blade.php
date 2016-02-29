@section('social-tags')
    <!-- for Facebook -->
    <meta property="og:title" content="Hrvatska Volontira :: {{{ $page->title }}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="{{asset("assets/images/social-banner.jpg")}}"/>
    <meta property="og:url" content="{{Request::url()}}"/>
    <meta property="og:description"
          content="{{{ $page->menu_caption }}}"/>

@endsection

@extends('Layouts.site')

@section('content')
    <div class="material-body">
        <div class="container animated fadeIn">
            <div class="card">
                <h1>{{{ $page->title }}}</h1>
                <hr>
                <div class="static-page-content col-md-12 generic-page">
                    {{ $page->body }}
                </div>
                <hr>
                <div class="social-share">
                    <div class="col-md-3">
                        <div class="fb-share-button"
                             data-href="https://www.facebook.com/sharer/sharer.php?u=www.test.com"
                             data-layout="button"></div>
                    </div>
                    <div class="col-md-3">
                        <a href="https://twitter.com/share" class="twitter-share-button"
                           data-count="none">Tweet</a>
                        <script>!function (d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                                if (!d.getElementById(id)) {
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = p + '://platform.twitter.com/widgets.js';
                                    fjs.parentNode.insertBefore(js, fjs);
                                }
                            }(document, 'script', 'twitter-wjs');</script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
