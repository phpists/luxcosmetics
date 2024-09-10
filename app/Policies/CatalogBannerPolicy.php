<?php

namespace App\Policies;

use App\Models\CatalogBanner;
use App\Models\User;
use App\Services\Admin\PermissionService;
use Illuminate\Auth\Access\HandlesAuthorization;

class CatalogBannerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::CATALOG_BANNERS_VIEW);
    }

    public function view(User $user, CatalogBanner $catalogBanner): bool
    {
        return $this->viewAny($user);
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::CATALOG_BANNERS_CREATE);
    }

    public function update(User $user, CatalogBanner $catalogBanner): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::CATALOG_BANNERS_EDIT);
    }

    public function delete(User $user, CatalogBanner $catalogBanner): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::CATALOG_BANNERS_DELETE);
    }

}
