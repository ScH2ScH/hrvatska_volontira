@extends('Layouts.site')

@section('content')
    <div class="material-body">
        @if(!Auth::check())

            @include('Site.Modules.register-form')

        @else
            <div class="text-center">
                <h1>You are already logged in</h1>
                @include('Site.Modules.logout-button')
            </div>
    </div>
    @endif
@endsection