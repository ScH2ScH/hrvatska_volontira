@section('social-tags')
    <!-- for Facebook -->
    <meta property="og:title" content="Hrvatska Volontira :: {{$event->name}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="{{asset("assets/images/social-banner.jpg")}}"/>
    <meta property="og:url" content="{{Request::url()}}"/>
    <meta property="og:description"
          content="Ove Vas godine ponovno pozivamo da volontirate s nama – bilo da se radi o već postojećim, redovnim aktivnostima Vaše organizacije ili o nekim novim aktivnostima, pridružite se manifestaciji Hrvatska volontira!"/>

@endsection
@extends('Layouts.site')
@section('content')
    <div class="material-body">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="event-card">
                        @if (count($event->images()->get()))
                            @foreach($event->images()->get() as $key => $image)
                                @if($key==0)
                                    <img class="img-responsive event-head-image"
                                         src="{{asset("data/images/original/$image->filename")}}"
                                         alt={{$image->title}}>
                                @endif
                            @endforeach
                        @else
                            <img class="img-responsive event-head-image"
                                 src="{{asset("assets/images/no-image.jpg")}}"
                                 alt="test">
                        @endif
                        <h1>
                            {{$event->name}}
                        </h1>

                        <p>
                            <a href='{{ URL::route('Site.StaticPages.Action', array('id'=>$event->getAction()->id))}}'>{{$event->getAction()->name}}</a>
                        </p>

                        <p>
                            <a href="{{ URL::route('Site.StaticPages.Host', array('id'=>$event->getHost()->id))}}">{{$event->getHost()->name}}</a>
                        </p>

                        <p><i class="fa fa-building-o"></i>  {{$event->getCity()->name}}</p>

                        <p>
                            <i class="fa fa-user"></i>   {{$event->contact_person}}
                        </p>

                        <p>
                            <i class="fa fa-phone"></i>   {{$event->phone}}
                        </p>

                        <p>
                            <i class="fa fa-envelope-o"></i> <a href="mailto:{{$event->email}}">{{$event->email}}</a>
                        </p>

                        <p>
                            <i class="fa fa-map-marker"></i>   {{$event->address}}
                        </p>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="event-card">
                        <p id="event-text">
                            {{$event->description}}
                        </p>

                        <p>
                            <i class="fa fa-users"></i> Broj volontera :   {{$event->estimated_volunteers_no}}
                        </p>

                        <p>
                            <i class="fa fa-calendar-o"></i> Početak volontiranja:   {{$event->start}}
                        </p>

                        <p>
                            <i class="fa fa-times-circle"></i> Kraj volontiranja :  {{$event->end}}
                        </p>

                        <p>
                            <i class="fa fa-clock-o"></i> Vrijeme volontiranja : {{$event->working_hours}}
                        </p>

                        <p>
                            <i class="fa fa-bullseye"></i> Ukupno sati:{{$event->total_hours}}
                        </p>

                        <p>
                            <i class="fa fa-info-circle"></i> Otvoreno za volontiranje: {{$event->additional_note}}
                        </p>
                    </div>
                </div>


                <div class="col-md-12 event-gallery">
                    @foreach($event->images()->get() as $key => $image)
                        <div class="col-md-2">
                            <a class="fancybox" rel="group"
                               href="{{asset("data/images/original/$image->filename")}}">
                                <div class="card"><img
                                            src="{{asset("data/images/thumbnail/$image->filename")}}"
                                            alt="{{$image->title}}"/></div>
                            </a>
                        </div>
                    @endforeach
                </div>


            </div>
        </div>
    </div>
@endsection
