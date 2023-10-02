<?php

namespace App\Policies;

use App\Models\User;
use App\Services\Admin\PermissionService;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }



    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::USERS_VIEW);
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::USERS_CREATE);
    }

    public function view(User $user): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::USERS_EDIT);
    }

    public function delete(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::USERS_DELETE);
    }

}
