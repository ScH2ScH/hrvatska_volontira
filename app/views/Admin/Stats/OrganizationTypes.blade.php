@extends('Layouts.admin')

@section('content')
    @parent
    @include('Navigation.menu')

    <div class="container">

        <div class="notifications"></div>
        <div class="col-lg-12">
            <h1 class="text-center">Organization types stats by geolocation</h1>

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
            emptyPrevious('Hosts by organization type')
            var city_url = '/stats/stats-organization-types-hosts/'
            getStats(city_url)
        });


        $('#stats-county').click(function () {
            emptyPrevious('Volunteering hours by organization type')
            var counties_url = '/stats/stats-organization-types-working-hours/'
            getStats(counties_url)

        });

        $('#stats-region').click(function () {
            emptyPrevious('Volunteers number by organization type')
            var regions_url = '/stats/stats-organization-types-volunteers/';
            getStats(regions_url)
        });
    </script>

@stop
