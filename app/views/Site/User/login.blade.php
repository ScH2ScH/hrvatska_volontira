@extends('Layouts.site')

@section('content')

    <div class="material-body">

    @if(!Auth::check())

        @include('Site.Modules.login-form')

    @else
        <div class="text-center">
            <p>Već ste prijavljeni</p>
            @include('Site.Modules.logout-button')
        </div>

    @endif
    </div>
@endsection