<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;
use App\Services\Admin\PermissionService;

class PropertyPolicy
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
        return $user->isSuperAdmin() || $user->can(PermissionService::PROPERTIES_VIEW);
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::PROPERTIES_CREATE);
    }

    public function view(User $user, Property $property): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user, Property $property): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::PROPERTIES_EDIT);
    }

    public function delete(User $user, Property $property): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::PROPERTIES_DELETE);
    }

}
