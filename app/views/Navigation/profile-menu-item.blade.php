<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-user"></i>
            {{{ Auth::user()->username }}}
            <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            <li>
                <a href="{{ route('Public.Logout') }}">
                    <i class="fa fa-lock"></i>
                    Logout
                </a>
            </li>
        </ul>
    </li>
</ul>