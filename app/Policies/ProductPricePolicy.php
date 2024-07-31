<?php

namespace App\Policies;

use App\Models\ProductPrice;
use App\Models\User;
use App\Services\Admin\PermissionService;

class ProductPricePolicy
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
        return $user->isSuperAdmin() || $user->can(PermissionService::PRODUCT_PRICES_VIEW);
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::PRODUCT_PRICES_CREATE);
    }

    public function view(User $user, ProductPrice $productPrice): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user, ProductPrice $productPrice): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::PRODUCT_PRICES_EDIT);
    }

    public function delete(User $user, ProductPrice $productPrice): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::PRODUCT_PRICES_DELETE);
    }

}
