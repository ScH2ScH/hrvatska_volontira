@section('social-tags')
    <!-- for Facebook -->
    <meta property="og:title" content="Hrvatska Volontira :: Statistike"/>
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="{{asset("assets/images/social-banner.jpg")}}"/>
    <meta property="og:url" content="{{Request::url()}}"/>
    <meta property="og:description"
          content="Ove Vas godine ponovno pozivamo da volontirate s nama – bilo da se radi o već postojećim, redovnim aktivnostima Vaše organizacije ili o nekim novim aktivnostima, pridružite se manifestaciji Hrvatska volontira!"/>
@endsection
@extends('Layouts.site')

@section('subnavigation')
    @include('Site.Modules.stats-navigation')
@endsection

@section('content')
    @yield('statistics','
        <div class="material-body animated fadeIn">
        <section id="stats" class="about animated fadeInLeft">
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


                            <div id="number-hosts"></div>
                            <p>Organizacija</p>

                            <div>
                                <i class="fa fa-university fa-2x"></i>
                            </div>
                        </div>

                        <!--total number of events--->
                        <div class="col-md-4 main-page-stats">


                            <div id="number-events"></div>
                            <p>Volonterskih aktivnosti</p>

                            <div>
                                <i class="fa fa-heart-o fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>')

@endsection
@section('scripts')
    @parent
    <script src="{{asset('assets/js/charts.stats.js')}}"></script>
    <script>
        $(document).ready(function () {
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