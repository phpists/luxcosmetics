<ul>
    @foreach($menu_item->getChildren($menu_items) as $submenu)
        <li><a href="{{$submenu->link}}">{{$submenu->title}}</a>
            @include('layouts.parts.mobile-submenu', ['menu_item' => $submenu, 'items' => $menu_items])
        </li>
    @endforeach
</ul>
