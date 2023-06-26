@foreach($users as $user)
    <tr>
        <td class="text-center pl-0">
            {{ $user->id }}
        </td>
        <td class="text-center pr-0">
            {{ $user->email }}
        </td>
        <td class="text-center pr-0">
            {{ $user->name }}
        </td>
        <td class="text-center pr-0">
            {{ $user->last_name }}
        </td>
        <td class="text-center pr-0">
            {{ $user->phone }}
        </td>
        <td class="text-center pr-0">
            {{ $user->last_active ? date('H:i | d.m.y', strtotime($user->last_active)) : '(не задано)' }}
        </td>
        <td class="text-center pr-0">
            {{ date('H:i | d.m.y', strtotime($user->created_at)) }}
        </td>
        <td class="text-center pr-0 status">
            <span class="@if($user->status == true) text-success @else text-danger @endif">{{ $user->status == true ? 'Активний' : 'Заблокований' }}</span>
        </td>
        <td class="text-center pr-0">
            <a href="{{ route('admin.user.show', $user->id) }}"
               class="btn btn-sm btn-clean btn-icon">
                <i class="las la-eye"></i>
            </a>
            <a href="{{ route('admin.user.edit', $user->id) }}"
               class="btn btn-sm btn-clean btn-icon">
                <i class="las la-edit"></i>
            </a>
            <a href="{{ route('admin.user.change_status', $user->id) }}"
               class="btn btn-sm btn-clean btn-icon">
                <i class="las fa-user-times"></i>
            </a>
            <a href="{{ route('admin.users.remind_password', $user->id) }}"
               class="btn btn-sm btn-clean btn-icon">
                <i class="las flaticon-multimedia-2"></i>
            </a>
        </td>
    </tr>
@endforeach
