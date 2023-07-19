<section id="menu">
    <ul>
        @foreach($menu_items->whereNull('parent_id')->where('type', \App\Models\Menu::TOP_MENU) as $menu_item)
            <li><a href="{{$menu_item->link}}">{{$menu_item->title}}</a>
                @if(sizeof($menu_item->getChildren($menu_items)) > 0)
                    <ul>
                        @foreach($menu_item->getChildren($menu_items) as $submenu)
                            <li><a href="{{$submenu->link}}">{{$submenu->title}}</a>
                                @include('layouts.parts.mobile-submenu', ['menu_item' => $submenu, 'items' => $menu_items])
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
        @include('layouts.parts.mobile-submenu', ['menu_items' => $menu_items])
    </ul>
</section>
