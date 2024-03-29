@foreach($categories->sortBy('position') as $category)
    <li class="dd-item dd3-item" data-id="{{$category->id}}">
        <div class="dd-handle dd3-handle">Drag</div>
        <div class="dd3-content">
            <span>{{$category->name}}</span>
            <span>
                @if((bool)$category->status)
                    <span>
                        <i class="flaticon-eye"></i>
                    </span>
                @endif
                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::CATEGORIES_DELETE))
                <a href="{{ route('admin.category.delete', $category->id) }}"
                   class="btn btn-sm btn-clean btn-icon"
                   onclick="return confirm('Вы уверенны, что хотите удалить запись?')">
                    <i class="las la-trash"></i>
                </a>
                @endif
                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::CATEGORIES_EDIT))
                    <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-sm btn-clean btn-icon">
                        <i class="las la-edit"></i>
                    </a>
                @endif
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
                                @if((bool)$subcategory->status)
                                    <span>
                                        <i class="flaticon-eye"></i>
                                    </span>
                                @endif
                                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::CATEGORIES_DELETE))
                                <a href="{{ route('admin.category.delete', $subcategory->id) }}"
                                   class="btn btn-sm btn-clean btn-icon"
                                   onclick="return confirm('Вы уверенны, что хотите удалить запись?')">
                                    <i class="las la-trash"></i>
                                </a>
                                @endif
                                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::CATEGORIES_EDIT))
                                <a href="{{ route('admin.category.edit', $subcategory->id) }}" class="btn btn-sm btn-clean btn-icon">
                                    <i class="las la-edit"></i>
                                </a>
                                @endif
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
