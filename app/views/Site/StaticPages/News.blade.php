@section('social-tags')
    <!-- for Facebook -->
    <meta property="og:title" content="Hrvatska Volontira :: Novosti"/>
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
                        <input type="search" placeholder="Pretraži novosti" id="searchBox"/>
                    </form>
                </div>
            </div>
            @foreach ($news as $new)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-image">
                            <h1>{{$new->title}}</h1>
                        </div>
                        <div class="card-content">
                            {{$new->menu_caption}}
                        </div>
                        <div class="card-action">
                            <a href="/{{$new->slug}}">Više</a>
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
