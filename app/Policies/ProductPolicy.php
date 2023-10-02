<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use App\Services\Admin\PermissionService;

class ProductPolicy
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
        return $user->isSuperAdmin() || $user->can(PermissionService::PRODUCTS_VIEW);
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::PRODUCTS_CREATE);
    }

    public function view(User $user, Product $product): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user, Product $product): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::PRODUCTS_EDIT);
    }

    public function delete(User $user, Product $product): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::PRODUCTS_DELETE);
    }

}
