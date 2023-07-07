@php($parent_category = $category->parent)
@if($parent_category)
    @if($parent_category->parent)
        @include('categories.parts.parent_category', ['category' => $parent_category])
    @endif
    <li class="crumbs__item"><a href="{{ route('categories.show', ['alias' => $parent_category->alias]) }}">{{ $parent_category->name }}</a></li>
@endif
