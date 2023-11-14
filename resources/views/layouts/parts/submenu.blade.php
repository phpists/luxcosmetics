<ul>
    @php
        $uri_path = '/'.request()->path();
    @endphp
    @foreach($menu_item->getChildren($menu_items) as $submenu)
        <li><a class="@if($uri_path == $submenu->link) active @endif" href="{{$submenu->link}}">{{$submenu->title}}</a></li>
        @include('layouts.parts.submenu', ['menu_item' => $submenu, 'items' => $menu_items])
    @endforeach
</ul>
