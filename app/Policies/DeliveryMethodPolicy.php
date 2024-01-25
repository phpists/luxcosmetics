<?php

namespace App\Policies;

use App\Models\User;
use App\Services\Admin\PermissionService;

class DeliveryMethodPolicy
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
        return $user->isSuperAdmin() || $user->can(PermissionService::DELIVERY_METHODS_VIEW);
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function view(User $user): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::DELIVERY_METHODS_EDIT);
    }

    public function delete(User $user): bool
    {
        return false;
    }

}
