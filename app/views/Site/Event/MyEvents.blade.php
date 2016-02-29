@extends('Layouts.site')

@section('content')

    <div class="material-body">

        <div class="container animated fadeIn">
            <div class="row">
                <div class="card register-card">
                    <div class="row">
                        <div class="col-md-8">
                            @if(empty($model->id))
                                <h1>Nova aktivnost</h1>
                            @else
                                <h1>Uredi aktivnost</h1>
                            @endif
                            @include('Site.Event.event-form')
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::route('Public.Logout') }}" class="user-logout">ODJAVA
                                <i class="fa fa-sign-out fa-2x"></i>
                            </a>

                            <div class="user-panel-profile">
                                <img class="img-circle" src="{{asset('/assets/images/hv_logo.png')}}">

                                <p>{{{ Auth::getUser()->username}}}</p>
                                <a href="#"></a>
                            </div>
                            <hr>
                            <a href="{{ URL::route('Site.MyEvents') }}" class="btn btn-light-add"><i
                                        class="fa fa-plus"></i>Prijavi volontersku aktivnost</a>
                            <hr>

                            <h1>Moje aktivnosti</h1>

                            <div id="event-list">
                                @foreach($events as $event)
                                    <div class="event-list-item">
                                        <a href="{{ URL::route('Site.MyEvent', array('id'=>$event->id)) }}">
                                        <span class="event-name">
                                            {{ $event->name }}
                                        </span>
                                        </a>
                                        <hr>
                                    <span class="event-datetime">
                                        {{ $event->start }} - {{ $event->end }}
                                    </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
