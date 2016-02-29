@extends('Layouts.site')

@section('social-tags')
    <!-- for Facebook -->
    <meta property="og:title" content="Hrvatska Volontira :: Volontiranja"/>
    <meta property="og:type" content="article"/>
    <meta property="og:image" content="{{asset("assets/images/social-banner.jpg")}}"/>
    <meta property="og:url" content="{{Request::url()}}"/>
    <meta property="og:description"
          content="Ove Vas godine ponovno pozivamo da volontirate s nama – bilo da se radi o već postojećim, redovnim aktivnostima Vaše organizacije ili o nekim novim aktivnostima, pridružite se manifestaciji Hrvatska volontira!"/>

@endsection

@section('content')
    <div class="material-body">
        <div class="container animated fadeIn">
            <div class="row">
                <div class="col-md-12 search-bar" id="eventSearch">
                    <form class="searchbox" action="">
                        <input type="search" placeholder="Pretraži volontiranja prema  nazivu, mjestu, regiji, oznakama..." id="searchBox"/>
                    </form>
                </div>

                @foreach ($events as $event)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-image">
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
                                <span class="card-title">
                                    <a href="/events/event/{{$event->id}}">{{$event->name}}</a>
                                </span>
                            </div>
                            <div class="card-content">
                                <div class="col-md-4">
                                    <span class="start-time"><i
                                                class="fa fa-clock-o"></i>{{date_format(new DateTime($event->start), 'd.m.Y')}} </span>
                                </div>
                                <div class="col-md-8">
                                    <span class="start-time">{{$event->getCity()->name}}, {{$event->getCounty()->name}}
                                        , {{$event->getRegion()->name}}</span>
                                </div>
                                <hr>
                                <p>{{$event->description}}</p>
                            </div>
                            <div class="card-tag">
                                @foreach( $event->tags()->get() as $tag)
                                    <span class="badge badge-alert">#
                                        {{$tag->name}}
                                </span>
                                @endforeach
                            </div>
                            <div class="card-action">
                                <a href="/events/event/{{$event->id}}">Detalji</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script src="{{asset('assets/js/charts.stats.js')}}"></script>
@endsection