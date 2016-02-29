<!-- Navigation -->
<a id="menu-toggle" href="javascript:void(0);" class="btn btn-light btn-lg toggle">
    <i class="fa fa-bars fa-2x"></i>
</a>
<nav id="sidebar-wrapper">
    <ul class="sidebar-nav ">
        <a id="menu-close" href="javascript:void(0);" class="btn btn-light btn-lg pull-right toggle">
            <i class="fa fa-times"></i></a>
        <li class="sidebar-brand">
            <a href="#top"></a>
        </li>
        <li class="tampon">
        </li>
        @if(!Auth::check())
            <li>
                <i class="fa fa-lock fa-2x"></i><a href="{{ URL::route('Public.Registration') }}"
                                                   class="navigation-text">&nbsp;Prijava organizatora</a>
            </li>
            <li class="tampon">
            </li>
        @else
            <li>
                <a>Dobrodošao, {{{ Auth::getUser()->username }}}</a>
            </li>
            <li>
                <i class="fa fa-plus fa-2x"></i><a href="{{ URL::route('Site.MyEvents') }}" class="navigation-text">Prijavi
                    aktivnost</a>
            </li>
            <li>
                <i class="fa fa-sign-out fa-2x"></i><a href="{{ URL::route('Public.Logout') }}" class="navigation-text">Odjava</a>
            </li>
            <li class="tampon">
            </li>
        @endif


        <li>
            <i class="fa fa-calendar-o fa-2x"></i><a href="{{ URL::route('Site.StaticPages.Events') }}"
                                                     class="navigation-text">Popis aktivnosti u RH</a>
        </li>
        <li>
            <i class="fa fa-pie-chart fa-2x"></i><a href="{{ URL::route('Site.StaticPages.Stats') }}"
                                                    class="navigation-text">Statistike</a>
        </li>
        <li>
            <i class="fa fa-bell-o fa-2x"></i> <a href="{{ URL::route('Site.StaticPages.News') }}"
                                                  class="navigation-text">Novosti</a>
        </li>
        <li>
            <i class="fa fa-heart fa-2x"></i><a href="{{URL::action('Site.StaticPages.Action', array('id' => 1));}}"
                                               class="navigation-text">
                O manifestaciji</a>
        </li>
        <li>
            <i class="fa fa-envelope-o fa-2x"></i><a href="{{ URL::route('Site.StaticPages.Contact') }}"
                                                     class="navigation-text">Kontakt</a>
        </li>
        <li class="tampon">
        </li>
        <li>
            <i class="fa fa-home fa-2x"></i> <a href="{{ URL::route('Site.Home') }}" class="navigation-text">Početna</a>
        </li>
    </ul>
</nav>