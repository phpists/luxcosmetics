<?php

namespace App\Policies;

use App\Models\User;
use App\Services\Admin\PermissionService;

class ProductQuestionPolicy
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
        return $user->isSuperAdmin() || $user->can(PermissionService::QUESTIONS_VIEW);
    }

    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::QUESTIONS_CREATE);
    }

    public function view(User $user): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::QUESTIONS_EDIT);
    }

    public function delete(User $user): bool
    {
        return $user->isSuperAdmin() || $user->can(PermissionService::QUESTIONS_DELETE);
    }

}
