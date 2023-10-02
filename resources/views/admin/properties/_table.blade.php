<!--begin::Table-->
<div class="table-responsive">
    <table class="table table-head-custom table-vertical-center">
        <thead>
        <tr>
            <th class="pl-0 text-center">
                ID
            </th>
            <th class="pr-0 text-center">
                Название
            </th>
            <th class="text-center pr-0">
                Измерение
            </th>
            <th class="pr-0 text-center">
                Действия
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($properties as $property)
            <tr data-id="{{ $property->id }}">
                <td class="text-center pl-0">
                    {{ $property->id }}
                </td>
                <td class="text-center position">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $property->name }}
                                        </span>
                </td>
                <td class="text-center">
                                        <span class="text-dark-75 d-block font-size-lg">
                                            {{ $property->measure }}
                                        </span>
                </td>
                <td class="text-center pr-0">
                        @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::PROPERTIES_EDIT))
                            <a href="{{route('admin.properties.edit', $property->id)}}" class="btn btn-sm btn-clean btn-icon">
                                <i class="las la-edit"></i>
                            </a>
                        @endif
                            @if(!in_array($property->id, [1, 2]))
                                @if(auth()->user()->isSuperAdmin() || auth()->user()->can(\App\Services\Admin\PermissionService::PROPERTIES_DELETE))
                                    <form action="{{ route('admin.properties.delete', $property->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-clean btn-icon btn_delete"
                                            onclick="return confirm('Ви впевнені, що хочете видалити питання \'{{ $property->name }}\'?')"
                                            title="Delete"><i class="las la-trash"></i>
                                    </button>
                                    </form>
                                @endif
                            @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!--end::Table-->
{{ $properties->links('vendor.pagination.super_admin_pagination') }}
