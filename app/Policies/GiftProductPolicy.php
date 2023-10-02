<?php

namespace App\Policies;

use App\Models\GiftProduct;
use App\Models\User;
use App\Services\Admin\PermissionService;

class GiftProductPolicy
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
        return $user->isSuperAdmin() || $user->can(PermissionService::GIFTS_VIEW);
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::GIFTS_CREATE);
    }

    public function view(User $user, GiftProduct $giftProduct): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user, GiftProduct $giftProduct): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::GIFTS_EDIT);
    }

    public function delete(User $user, GiftProduct $giftProduct): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::GIFTS_DELETE);
    }

}
