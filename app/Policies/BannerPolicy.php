<?php

namespace App\Policies;

use App\Models\User;
use App\Services\Admin\PermissionService;

class BannerPolicy
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
        return $user->isSuperAdmin() || $user->can(PermissionService::BANNERS_VIEW);
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::BANNERS_CREATE);
    }

    public function view(User $user): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::BANNERS_EDIT);
    }

    public function delete(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::BANNERS_DELETE);
    }

}
