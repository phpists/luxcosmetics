@foreach($items->whereNull('parent_id')->sortBy('position') as $item)
    <li class="dd-item dd3-item" data-id="{{$item->id}}">
        <div class="dd-handle dd3-handle">Drag</div>
        <div class="dd3-content">
            <span>{{$item->title}}</span>
            <span>
                @if((bool)$item->is_active)
                    <span>
                        <i class="flaticon-eye"></i>
                    </span>
                @endif
                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::MENUS_DELETE))
                <a href="{{ route('admin.menu.delete', $item->id) }}"
                   class="btn btn-sm btn-clean btn-icon"
                   onclick="return confirm('Вы уверенны, что хотите удалить запись?')">
                    <i class="las la-trash"></i>
                </a>
                @endif
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::MENUS_EDIT))
                <a href="{{ route('admin.menu.edit', $item->id) }}" class="btn btn-sm btn-clean btn-icon">
                    <i class="las la-edit"></i>
                </a>
                    @endif
            </span>
        </div>
        <ol class="dd-list">
            @foreach($item->getChildren($items)->sortBy('position') as $subitem)
                <li class="dd-item dd3-item" data-id="{{$subitem->id}}">
                    <div class="dd-handle dd3-handle">Drag</div>
                    <div class="dd3-content">
                        <span>{{$subitem->title}}</span>
                        <span>
                            @if((bool)$subitem->is_active)
                                <span>
                                        <i class="flaticon-eye"></i>
                                    </span>
                            @endif
                            @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::MENUS_DELETE))
                                <a href="{{ route('admin.menu.delete', $subitem->id) }}"
                                   class="btn btn-sm btn-clean btn-icon"
                                   onclick="return confirm('Вы уверенны, что хотите удалить запись?')">
                                    <i class="las la-trash"></i>
                                </a>
                            @endif
                                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::MENUS_EDIT))
                                <a href="{{ route('admin.menu.edit', $subitem->id) }}" class="btn btn-sm btn-clean btn-icon">
                                    <i class="las la-edit"></i>
                                </a>
                                @endif
                            </span>
                    </div>
                    <ol class="dd-list">
                        @foreach($subitem->getChildren($items)->sortBy('position') as $sub_2_item)
                            @include('admin.menu.parts.subchildren', ['item' => $sub_2_item, 'items' => $items])
                        @endforeach
                    </ol>
                </li>
            @endforeach
        </ol>
    </li>
@endforeach
