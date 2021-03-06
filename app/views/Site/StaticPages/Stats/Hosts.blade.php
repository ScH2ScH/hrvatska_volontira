@extends('Site.StaticPages.Stats')
@section('statistics')
    <div class="stats-container">
        <div class="container">
            <div class="notifications"></div>
            <div class="col-lg-12">
                <h1 class="text-center">Volonterske aktivnosti prema</h1>

                <div class="row text-center">
                    <a class="change-category" id="stats-city">Gradovima</a>
                    <a class="change-category" id="stats-county">Županijama</a>
                    <a class="change-category" id="stats-region">Regijama</a>
                </div>
                <!--Spinner-->
                <div class="sk-spinner sk-spinner-three-bounce" id="loadingDiv">
                    <div class="sk-bounce1"></div>
                    <div class="sk-bounce2"></div>
                    <div class="sk-bounce3"></div>
                </div>

                <div class="col-lg-4">
                    <div class="col-md-12 search-bar" id="statsSearch">
                        <form class="searchbox-min" action="">
                            <input type="search" placeholder="Pretraži po lokaciji" id="searchBox"/>
                        </form>
                    </div>

                    <select id="selectYear" class="search-stats">
                    </select>

                    <select id="selectAction" class="search-stats">
                    </select>

                    <div class="col-centered">
                        <button id="SearchBtn" class="btn btn-light-search">Traži</button>
                    </div>
                    <!--legend of contents-->
                    <ul id="top-ten">
                    </ul>
                </div>
                <div class="col-lg-8 stats-start">
                    <h4 class="text-center" id="stats-name"></h4>
                    <canvas id="volunteersChart" width="500" height="500"></canvas>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @parent
    <script src="{{asset('assets/js/Chart.min.js')}}"></script>
    <script src="{{asset('assets/js/charts.stats.js')}}"></script>
    <script>
        $("#organizatori").addClass("stats-active")

        $(document).ready(function () {

            fillSelectBox()
            $('#stats-city').addClass("change-category-active")
            emptyPrevious('')
            getStats(new Date().getFullYear(), homeUrl + "/stats/stats-hosts-city/", "empty")

            $('#SearchBtn').click(function () {
                var generic_path = $('.change-category-active').attr('id')
                generic_path = generic_path.split('-')
                generic_path[2] = generic_path[1]
                generic_path[1] = "hosts"
                generic_path = generic_path.join('-')
                var path = '/stats/' + generic_path + '/'

                var action = $("#selectAction option:selected").val();
                var year = $("#selectYear option:selected").val();
                getStats(year, path, action)
            })
        });

        $('#stats-city').click(function () {
            removeActiveClass()

            $(this).addClass("change-category-active")
            emptyPrevious('')
            getStats(new Date().getFullYear(), "/stats/stats-hosts-city/", "empty")
        });

        $('#stats-county').click(function () {
            removeActiveClass()

            $(this).addClass("change-category-active")
            emptyPrevious('')
            getStats(new Date().getFullYear(), "/stats/stats-hosts-county/", "empty")
        });

        $('#stats-region').click(function () {
            removeActiveClass()

            $(this).addClass("change-category-active")
            emptyPrevious('')
            getStats(new Date().getFullYear(), "/stats/stats-volunteers-region/", "empty")
        });


    </script>
@stop
