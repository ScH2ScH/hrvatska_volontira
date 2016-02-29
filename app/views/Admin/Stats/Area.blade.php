@extends('Layouts.admin')

@section('content')
    @parent
    @include('Navigation.menu')

    <div class="container">

        <div class="notifications"></div>
        <div class="col-lg-12">
            <h1 class="text-center">Area of activity stats by location</h1>

            <div class="row text-center">
                <a class="change-category" id="stats-city">Hosts</a>
                <a class="change-category" id="stats-county">Volunteering hours</a>
                <a class="change-category" id="stats-region">Number of volunteers</a>
            </div>
            <div class="col-lg-6 stats-start">
                <h4 class="text-center" id="stats-name"></h4>
                <canvas id="volunteersChart" width="600" height="400"></canvas>
            </div>
            <div class="col-lg-6">
                <ul id="top-ten">
                </ul>
            </div>
        </div>

    </div>

@stop

@section('scripts')
    @parent
    <script src="{{asset('assets/js/Chart.min.js')}}"></script>
    <script src="{{asset('assets/js/charts.stats.js')}}"></script>
    <script>
        $('#stats-city').click(function () {
            emptyPrevious('Number of hosts by area of activity')
            var city_url = '/stats/stats-area-hosts/'
            getStats(city_url)
        });


        $('#stats-county').click(function () {
            emptyPrevious('Number of volunteers by organizaiton type')
            var counties_url = '/stats/stats-area-volunteers/'
            getStats(counties_url)

        });

        $('#stats-region').click(function () {
            emptyPrevious('Working hours by organization type')
            var regions_url = '/stats/stats-area-working-hours/';
            getStats(regions_url)
        });
    </script>

@stop
