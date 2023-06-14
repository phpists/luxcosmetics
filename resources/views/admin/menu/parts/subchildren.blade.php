<li class="dd-item dd3-item" data-id="{{$item->id}}">
    <div class="dd-handle dd3-handle">Drag</div>
    <div class="dd3-content">
        <span>{{$item->title}}</span>
        <span>
            <a href="{{ route('admin.menu.delete', $item->id) }}"
               class="btn btn-sm btn-clean btn-icon"
               onclick="return confirm('Вы уверенны, что хотите удалить запись?')">
                <i class="las la-trash"></i>
            </a>
            <a href="{{ route('admin.menu.edit', $item->id) }}" class="btn btn-sm btn-clean btn-icon">
                <i class="las la-edit"></i>
            </a>
        </span>
    </div>
    <ol class="dd-list">
        {{--            @dd($menu)--}}
        @foreach($item->getChildren($items) as $child)
            @include('admin.menu.parts.subchildren', ['item' => $child])
        @endforeach
    </ol>
</li>
