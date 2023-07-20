<?php

namespace App\Policies;

use App\Models\User;

class UserAccessPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function findRole($user)
    {
        return $user->roles()->first();
    }

    public function before(?User $user): bool|null
    {
        $role_name = $this->findRole($user)->name;

        if ($role_name == 'Lead') {
            return true;
        }
        return false;
    }
    public function hasProjectAccess(User $user, $id = null)
    {
        if ($id == null) return false;
        $isUserHaveAccessToProject = $user->projects()->where('projects.id', $id)->exists();

        return $isUserHaveAccessToProject;
    }
}
