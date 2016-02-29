@extends('Site.StaticPages.Stats')
@section('statistics')
    <div class="stats-container">
        <div class="container">
            <div class="notifications"></div>
            <div class="col-lg-12">
                <h1 class="text-center">Vrste organizacija prema</h1>

                <div class="row text-center">
                    <a class="change-category" id="stats-hosts">Organizatori</a>
                    <a class="change-category" id="stats-working-hours">Volonterski sati</a>
                    <a class="change-category" id="stats-volunteers">Broj volontera</a>
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
                            <input type="search" placeholder="Pretraži po tipu org" id="searchBox"/>
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
                <div class="col-lg-6 stats-start">
                    <h4 class="text-center" id="stats-name"></h4>
                    <canvas id="volunteersChart" width="600" height="400"></canvas>
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
        $("#organizacije").addClass("stats-active")

        $(document).ready(function () {
            fillSelectBox()

            $('#stats-hosts').addClass("change-category-active")
            emptyPrevious('')
            getStats(new Date().getFullYear() - 1, homeUrl + '/stats/stats-organization-types-hosts/', "empty")

            $('#SearchBtn').click(function () {
                var generic_path = $('.change-category-active').attr('id')
                generic_path = generic_path.split('-')
                generic_path[2] = generic_path[1]
                generic_path[1] = "organization-types"
                if (generic_path[2] == "working")
                    generic_path[2] = "working-hours"

                generic_path = generic_path.join('-')
                var path = '/stats/' + generic_path + '/'
                var action = $("#selectAction option:selected").val();
                var year = $("#selectYear option:selected").val();
                getStats(year, path, action)
            })
        });

        $('#stats-hosts').click(function () {
            removeActiveClassAlternative()

            $(this).addClass("change-category-active")
            emptyPrevious('')
            getStats(new Date().getFullYear() - 1, '/stats/stats-organization-types-hosts/', "empty")
        });

        $('#stats-working-hours').click(function () {
            removeActiveClassAlternative()

            $(this).addClass("change-category-active")
            emptyPrevious('')
            getStats(new Date().getFullYear() - 1, '/stats/stats-organization-types-working-hours/', "empty")
        });

        $('#stats-volunteers').click(function () {
            removeActiveClassAlternative()

            $(this).addClass("change-category-active")
            emptyPrevious('')
            getStats(new Date().getFullYear() - 1, '/stats/stats-organization-types-volunteers/', "empty")

        });
    </script>

@stop
