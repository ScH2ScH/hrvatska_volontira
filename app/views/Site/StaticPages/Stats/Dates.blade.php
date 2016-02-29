@extends('Site.StaticPages.Stats')
@section('statistics')
    <div class="container">
        <div class="notifications"></div>
        <div class="col-lg-12">
            <h1 class="text-center">Datumi</h1>

            <div class="row text-center">
                <a class="change-category" id="stats-city">Organizatori</a>
                <a class="change-category" id="stats-county">Sati volontiranja</a>
                <a class="change-category" id="stats-region">Broj volontera</a>
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

@stop
