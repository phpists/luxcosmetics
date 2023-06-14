<ul>
    @foreach($menu_item->getChildren($menu_items) as $submenu)
        <li><a href="{{$submenu->link}}">{{$submenu->title}}</a></li>
        @include('layouts.parts.submenu', ['menu_item' => $submenu, 'items' => $menu_items])
    @endforeach
</ul>
