@section('social-tags')
    <!-- for Facebook -->
    <meta property="og:title" content="Hrvatska Volontira :: {{$action->name}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="{{asset("assets/images/social-banner.jpg")}}"/>
    <meta property="og:url" content="{{Request::url()}}"/>
    <meta property="og:description"
          content="Ove Vas godine ponovno pozivamo da volontirate s nama – bilo da se radi o već postojećim, redovnim aktivnostima Vaše organizacije ili o nekim novim aktivnostima, pridružite se manifestaciji Hrvatska volontira!"/>
@endsection
@extends('Layouts.site')

@section('content')
    <div class="material-body">
        <div class="container animated fadeIn">
            <div class="row">
                <div class="col-md-6">
                    <div class="event-card">
                        @if (count($action->images()->get()))
                            @foreach($action->images()->get() as $key => $image)
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
                            {{$action->name}}
                        </h1>

                        <p>
                            <i class="fa fa-clock-o"></i> Početak :  {{$action->start}}
                        </p>

                        <p>
                            <i class="fa fa-times-circle"></i> Završetak :  {{$action->end}}
                        </p>

                        <div class="social-share">
                            <div class="col-md-2">
                                <div class="fb-share-button"
                                     data-href="https://www.facebook.com/sharer/sharer.php?u=www.test.com"
                                     data-layout="button"></div>
                            </div>
                            <div class="col-md-2">
                                <a href="https://twitter.com/share" class="twitter-share-button"
                                   data-count="none">Tweet</a>
                                <script>!function (d, s, id) {
                                        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                                        if (!d.getElementById(id)) {
                                            js = d.createElement(s);
                                            js.id = id;
                                            js.src = p + '://platform.twitter.com/widgets.js';
                                            fjs.parentNode.insertBefore(js, fjs);
                                        }
                                    }(document, 'script', 'twitter-wjs');</script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="event-card">
                        <p id="event-text">
                            {{$action->description}}
                        </p>

                        <div>
                            <h1>Volonterske aktivnosti</h1>

                            <div id="event-list">
                                @foreach($action->events()->get() as $event)
                                    <div class="event-list-item">
                                        <a href="{{ URL::route('Site.StaticPages.Event', array('id'=>$event->id)) }}">
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
                <div class="col-md-12 event-gallery">
                    @foreach($action->images()->get() as $key => $image)
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
