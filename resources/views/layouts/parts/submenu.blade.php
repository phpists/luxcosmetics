<ul>
    @foreach($category->categories as $subcategory)
        <li><a href="/categories/{{$subcategory->alias}}">{{$subcategory->name}}</a></li>
        @include('layouts.parts.submenu', ['category' => $subcategory])
    @endforeach
</ul>
