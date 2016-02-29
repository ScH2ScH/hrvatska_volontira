@if($item->isDivider())
    <li class="divider"></li>

@elseif($item->hasChildren())
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            {{ $item->getLabel() }}
            <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
            @foreach($item->getChildren() as $child)
                @include('Navigation.menu-item', array('item' => $child))
            @endforeach
        </ul>
    </li>

@else
    <li>
        @if($item->isLink())
            <a href="{{{ $item->getUrl() }}}" class="item">
                {{ $item->getLabel() }}
            </a>
        @else
            <a class="item">
                {{{ $item->getLabel() }}}
            </a>
        @endif
    </li>
@endif