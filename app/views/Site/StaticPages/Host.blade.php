@section('social-tags')
    <!-- for Facebook -->
    <meta property="og:title" content="Hrvatska Volontira :: {{$host->name}}"/>
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
                <div class="col-md-12">
                    <div class="host-card">
                        <h1>{{$host->name}}</h1>

                        <p>
                            <a href="{{$host->web}}">{{$host->name}}</a>, {{$host->getType()->name}}
                        </p>

                        <p>
                            <i class="fa fa-map-marker"></i> {{$host->address}}
                        </p>

                        <p>
                            <i class="fa fa-user"></i> {{$host->contact_person}}
                        </p>

                        <p>
                            <i class="fa fa-phone"></i> {{$host->phone}}
                        </p>

                        <p id="event-text">
                            {{$host->additional_note}}
                        </p>


                        @foreach($host->events()->get() as $h)
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-image">
                                        @if (count($h->images()->get()))
                                            @foreach($h->images()->get() as $key => $image)
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

                                        <span class="card-title">{{$h->name}}</span>
                                    </div>
                                    <div class="card-content">
                                        <div class="col-md-6">
                                            <span class="start-time"><i class="fa fa-clock-o"></i>{{$h->start}}</span>
                                        </div>
                                        <div class="col-md-6">
                                            <span class="start-time">{{$h->getCity()->name}}</span>
                                        </div>
                                        <hr>
                                        <p>{{$h->description}}</p>
                                    </div>
                                    <div class="card-tag">
                                    </div>

                                    <div class="card-action">
                                        <a href="{{ URL::route('Site.StaticPages.Event', array('id'=>$h->id)) }}">Detalji</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
