@section('social-tags')
    <!-- for Facebook -->
    <meta property="og:title" content="Hrvatska Volontira :: Volonterske akcije"/>
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
                <div class="col-md-12 search-bar" id="eventSearch">
                    <form class="searchbox" action="">
                        <input type="search" placeholder="Pretraži akcije" id="searchBox"/>
                    </form>
                </div>
            </div>
            @foreach ($actions as $action)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-image">

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

                            <span class="card-title">
                                <a href="/actions/action/{{$action->id}}">
                                    {{$action->name}}
                                </a>
                            </span>
                        </div>
                        <div class="card-content">
                            <div class="start-time">
                                <span class="start-time">Početak :{{date_format(new DateTime($action->start), 'd-m-Y')}}</span>
                            </div>
                            <p>{{$action->description}}</p>
                        </div>
                        <div class="card-action">
                            <a href="/actions/action/{{$action->id}}">Više</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="{{asset('assets/js/charts.stats.js')}}"></script>
@endsection
