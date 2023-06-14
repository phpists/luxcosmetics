<li class="dd-item dd3-item" data-id="{{$category->id}}">
    <div class="dd-handle dd3-handle">Drag</div>
    <div class="dd3-content">
        <span>{{$category->name}}</span>
        <span>
            <a href="{{ route('admin.category.delete', $category->id) }}"
               class="btn btn-sm btn-clean btn-icon"
               onclick="return confirm('Вы уверенны, что хотите удалить запись?')">
                <i class="las la-trash"></i>
            </a>
            <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-sm btn-clean btn-icon">
                <i class="las la-edit"></i>
            </a>
        </span>
    </div>
    @if(sizeof($category->categories) > 0)
        <ol class="dd-list">
{{--            @dd($category)--}}
            @foreach($category->categories as $subcategory)
                @include('admin.categories.parts.subcategory', ['category' => $subcategory])
            @endforeach
        </ol>
    @endif
</li>
