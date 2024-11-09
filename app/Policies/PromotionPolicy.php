<?php

namespace App\Policies;

use App\Models\Promotion;
use App\Models\User;
use App\Services\Admin\PermissionService;
use Illuminate\Auth\Access\HandlesAuthorization;

class PromotionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::PROMOTIONS_VIEW);
    }

    public function view(User $user, Promotion $promotion): bool
    {
        return $this->viewAny($user);
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::PROMOTIONS_CREATE);
    }

    public function update(User $user, Promotion $promotion): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::PROMOTIONS_EDIT);
    }

    public function delete(User $user, Promotion $promotion): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::PROMOTIONS_DELETE);
    }
}
