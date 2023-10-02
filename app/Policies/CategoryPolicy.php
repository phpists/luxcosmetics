<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use App\Services\Admin\PermissionService;

class CategoryPolicy
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
        return $user->isSuperAdmin() || $user->can(PermissionService::CATEGORIES_VIEW);
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::CATEGORIES_CREATE);
    }

    public function view(User $user, Category $category): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user, Category $category): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::CATEGORIES_EDIT);
    }

    public function delete(User $user, Category $category): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::CATEGORIES_DELETE);
    }

}
