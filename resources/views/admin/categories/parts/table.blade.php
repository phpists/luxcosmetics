@foreach($categories->sortBy('position') as $category)
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
        @if(sizeof($category->subcategories) > 0)
            <ol class="dd-list">
                @foreach($category->subcategories->sortBy('position') as $subcategory)
                    <li class="dd-item dd3-item" data-id="{{$subcategory->id}}">
                        <div class="dd-handle dd3-handle">Drag</div>
                        <div class="dd3-content">
                            <span>{{$subcategory->name}}</span>
                            <span>
                                <a href="{{ route('admin.category.delete', $subcategory->id) }}"
                                   class="btn btn-sm btn-clean btn-icon"
                                   onclick="return confirm('Вы уверенны, что хотите удалить запись?')">
                                    <i class="las la-trash"></i>
                                </a>
                                <a href="{{ route('admin.category.edit', $subcategory->id) }}" class="btn btn-sm btn-clean btn-icon">
                                    <i class="las la-edit"></i>
                                </a>
                            </span>
                        </div>
                        @if(sizeof($subcategory->categories) > 0)
                            <ol class="dd-list">
                                @foreach($subcategory->categories->sortBy('position') as $sub_2_category)
                                    @include('admin.categories.parts.subcategory', ['category' => $sub_2_category])
                                @endforeach
                            </ol>
                        @endif
                    </li>
                @endforeach
            </ol>
        @endif
    </li>
@endforeach
