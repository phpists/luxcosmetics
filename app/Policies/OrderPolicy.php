<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use App\Services\Admin\PermissionService;

class OrderPolicy
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
        return $user->isSuperAdmin() || $user->can(PermissionService::ORDERS_VIEW);
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::ORDERS_CREATE);
    }

    public function view(User $user, Order $order): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user, Order $order): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::ORDERS_EDIT);
    }

    public function delete(User $user, Order $order): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::ORDERS_DELETE);
    }

}
