<?php

namespace App\Policies;

use App\Models\User;
use App\Services\Admin\PermissionService;

class CommentsPolicy
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
        return $user->isSuperAdmin() || $user->can(PermissionService::COMMENTS_VIEW);
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::COMMENTS_CREATE);
    }

    public function view(User $user): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::COMMENTS_EDIT);
    }

    public function delete(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::COMMENTS_DELETE);
    }

}
