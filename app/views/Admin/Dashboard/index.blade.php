@extends('Layouts.admin')

@section('content')
    @parent
    @include('Navigation.menu')

    <div class="container">

        <div class="text-center">
            <a href="{{URL::route('Admin.Excel.HostsEvents')}}" class="btn btn-info">
                Izvezi podatke o organizacijama i aktivnostima
            </a>
        </div>
        <hr>

        <div class="text-left">
            <a href="{{URL::route('Admin.Excel.Users')}}" class="btn btn-info">
                Izvezi korisnike
            </a>
            <a href="{{URL::route('Admin.Excel.Hosts')}}" class="btn btn-info">
                Izvezi organizatore
            </a>
            <a href="{{URL::route('Admin.Excel.Events')}}" class="btn btn-info">
                Izvezi događaje
            </a>
            <a href="{{URL::route('Admin.Excel.News')}}" class="btn btn-info">
                Izvezi članke
            </a>
        </div>
        <hr>
    </div>


@stop

@section('scripts')
    @parent

@stop
