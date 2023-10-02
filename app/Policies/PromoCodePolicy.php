<?php

namespace App\Policies;

use App\Models\PromoCode;
use App\Models\User;
use App\Services\Admin\PermissionService;

class PromoCodePolicy
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
        return $user->isSuperAdmin() || $user->can(PermissionService::PROMO_CODES_VIEW);
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::PROMO_CODES_CREATE);
    }

    public function view(User $user, PromoCode $promoCode): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user, PromoCode $promoCode): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::PROMO_CODES_EDIT);
    }

    public function delete(User $user, PromoCode $promoCode): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::PROMO_CODES_DELETE);
    }

}
