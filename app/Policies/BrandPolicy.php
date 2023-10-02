<?php

namespace App\Policies;

use App\Models\Brand;
use App\Models\User;
use App\Services\Admin\PermissionService;

class BrandPolicy
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
        return $user->isSuperAdmin() || $user->can(PermissionService::BRANDS_VIEW);
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::BRANDS_CREATE);
    }

    public function view(User $user, Brand $brand): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user, Brand $brand): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::BRANDS_EDIT);
    }

    public function delete(User $user, Brand $brand): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::BRANDS_DELETE);
    }

}
