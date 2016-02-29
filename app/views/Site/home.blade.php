@section('social-tags')
    <!-- for Facebook -->
    <meta property="og:title" content="Hrvatska Volontira :: Naslovna"/>
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="{{asset("assets/images/social-banner.jpg")}}"/>
    <meta property="og:url" content="{{Request::url()}}"/>
    <meta property="og:description"
          content="Ove Vas godine ponovno pozivamo da volontirate s nama – bilo da se radi o već postojećim, redovnim aktivnostima Vaše organizacije ili o nekim novim aktivnostima, pridružite se manifestaciji Hrvatska volontira!"/>
@endsection

@extends('Layouts.site')

@section('header')
@endsection

@section('content')

    <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center">
            <img src="{{asset("assets/images/homepage/HVneg_transparent.png")}}" class="hidden-sm hidden-xs" alt="logo" data-start="opacity:1;transform:perspective(300px) rotateX(0deg) scale(1) translate(0px,0px)" data-top-bottom="opacity:0;transform: perspective(100px) rotateX(25deg) scale(0.3) translate(0px,-100px)">

            <h1>Hrvatska <span class="white float">Volontira</span>!</h1>

            <!--item-->
            <div class="col-sm-4">
                <div class="service-item">
                    <a href="{{URL::route('Site.StaticPages.Events')}}">
                                <span class="fa-stack fa-4x float">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-smile-o fa-stack-1x text-primary"></i>
                            </span>

                        <div class="main-title">
                            Popis volonterskih aktivnosti
                        </div>
                    </a>
                </div>
            </div>

            <!--item-->
            <div class="col-sm-4">
                <div class="service-item">
                    <a href="{{ URL::route('Public.Registration') }}">
                                <span class="fa-stack fa-4x float">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-paper-plane fa-stack-1x text-primary"></i>
                            </span>

                        <div class="main-title">
                            Prijava organizatora
                        </div>
                    </a>
                </div>
            </div>


            <!--item-->
            <div class="col-sm-4">
                <div class="service-item">
                    <a href="{{ URL::route('Site.StaticPages.Stats') }}">
                                <span class="fa-stack fa-4x float">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-pie-chart fa-stack-1x text-primary"></i>
                            </span>

                        <div class="main-title">
                            Volontiranje u brojkama
                        </div>
                    </a>
                </div>
            </div>
            <br>
        </div>
        <div class="arrow-container">
            <a href="#about" class="arrow animated bounce scrollable"></a>
        </div>
    </header>

    <!--Quotes slider--->
    <section id="services" class="services bg-primary">
        <div class="container">
            <div class="row text-center">
                <h3>
                    <div class="carousel slide"
                         id="fade-quote-carousel"
                         data-ride="carousel"
                         data-interval="6000">
                        <div class="carousel-inner">
                            <div class="active item">
                                <blockquote>
                                    <p class="carousel-text">
                                        "Budi promjena koju želiš vidjeti u svijetu" –

                                        Mahatma Gandhi
                                    </p>
                                </blockquote>
                            </div>
                            <div class="item">
                                <blockquote>
                                    <p class="carousel-text">
                                        "Budi promjena koju želiš vidjeti u svijetu" –

                                        Mahatma Gandhi </p>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </h3>
            </div>
        </div>
    </section>

    <!--Few words about volunteering action-->
    @if(($homepage->title))
        <section id="about" class="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1>{{$homepage->title}}</h1>

                        <div class="col-lg-12">
                            <p class="homepage-action-description">
                                {{$homepage->general}}
                            </p>
                        </div>
                        <h1>{{$homepage->subtitle}}</h1>

                        <div class="col-lg-12">
                            <p class="homepage-action-description">
                                {{$homepage->specific}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif



    @if(count($homepage->images()->get()))
        <section id="partners" class="bg-primary">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 event-gallery">
                        <h2>Partneri</h2>

                        <div id="owl-partners">
                            @foreach($homepage->images()->get() as $key => $image)
                                <div class="item">
                                    <img src="{{asset("data/images/original/$image->filename")}}"
                                         alt={{$image->filename}} class="homepage-partners">
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </section>
    @endif

    <section>

    </section>

    <section id="stats-home" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <!--total number of volunteers--->
                    <div class="col-md-4 main-page-stats">

                        <div id="number-volunteers"></div>
                        <p>Volontera</p>

                        <div>
                            <i class="fa fa-users fa-2x"></i>
                        </div>
                    </div>

                    <!--total number of organizations--->
                    <div class="col-md-4 main-page-stats">
                        <p>

                        <div id="number-hosts"></div>
                        <p>Organizacija</p>

                        <div>
                            <i class="fa fa-university fa-2x"></i>
                        </div>
                    </div>

                    <!--total number of events--->
                    <div class="col-md-4 main-page-stats">


                        <div id="number-events"></div>
                        <p>Volonterske aktivnosti</p>

                        <div>
                            <i class="fa fa-heart-o fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Volunteering photo--->
    <section class="homepage-horizontal-img-1 hidden-xs hidden-sm">
    </section>
@endsection
@section('scripts')
    @parent
    <script src="{{asset('assets/js/charts.stats.js')}}"></script>
    <script src="{{asset('assets/js/site/skrollr.js')}}"></script>
    <script>
        $(document).ready(function () {

            skrollr.init({
                smoothScrolling: true
            });

            $("#owl-partners").owlCarousel({
                autoPlay: 3000, //Set AutoPlay to 3 seconds
                items: 1,
                itemsDesktop: [1199, 1],
                itemsDesktopSmall: [979, 1]
            });

            var urls = ['/stats/total-volunteers/', '/stats/total-events/', '/stats/total-hosts/'];
            $.each(urls, function (i, val) {
                getGeneralStats(val)
            })
        })

        function getGeneralStats(url) {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'text',
                data: {year: new Date().getFullYear()},
                success: function (data) {
                    switch (url) {
                        case '/stats/total-volunteers/':
                            parseStats(data, '#number-volunteers')
                            break
                        case '/stats/total-events/':
                            parseStats(data, '#number-events')
                            break
                        default :
                            parseHosts(data, '#number-hosts')
                    }
                },
                error: function (data) {
                }
            });
        }

        function parseStats(data, id) {
            var json = $.parseJSON(data);
            $.each(json, function (k, v) {
                if (k == 'value') {
                    $(id).text(v)
                }
            });
        }

        function parseHosts(data, id) {
            var json = $.parseJSON(data);
            $.each(json['hosts'], function (k, v) {
                $(id).text(v)
            });
        }
    </script>
@stop