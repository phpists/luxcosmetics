<?php

namespace App\Policies;

use App\Models\CatalogItem;
use App\Models\User;
use App\Services\Admin\PermissionService;

class CatalogItemPolicy
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
        return $user->isSuperAdmin() || $user->can(PermissionService::CATALOG_ITEMS_VIEW);
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::CATALOG_ITEMS_CREATE);
    }

    public function view(User $user, CatalogItem $catalogItem): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user, CatalogItem $catalogItem): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::CATALOG_ITEMS_EDIT);
    }

    public function delete(User $user, CatalogItem $catalogItem): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::CATALOG_ITEMS_DELETE);
    }

}
