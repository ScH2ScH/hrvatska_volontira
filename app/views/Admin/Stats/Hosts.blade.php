@extends('Layouts.admin')

@section('content')
    @parent
    @include('Navigation.menu')

    <div class="container">

        <div class="notifications"></div>

        <div class="col-lg-12">
            <h1 class="text-center">Hosts stats by geolocation</h1>

            <div class="row text-center">
                <a class="change-category" id="stats-city">City</a>
                <a class="change-category" id="stats-county">County</a>
                <a class="change-category" id="stats-region">Region</a>
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
            emptyPrevious('Number of hosts by city')
            var city_url = '/stats/stats-volunteers-city/'
            getStats(city_url)
        });

        $('#stats-county').click(function () {
            emptyPrevious('Number of hosts by county')
            var counties_url = '/stats/stats-volunteers-county/'
            getStats(counties_url)
        });

        $('#stats-region').click(function () {
            emptyPrevious('Number of hosts by region')
            var regions_url = '/stats/stats-volunteers-region/';
            getStats(regions_url)
        });
    </script>
@stop
