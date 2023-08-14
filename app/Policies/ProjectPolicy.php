<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function findRole($user)
    {
        return $user->roles()->find(3);
    }

    public function before(?User $user): ?bool
    {
        $roleName = $this->findRole($user)->name;
        if ($roleName == 'Lead') {
            return true;
        }

        return null;
    }

    public function viewAny(User $user): bool
    {
        $role = $this->findRole($user);
        $permissionName = 'view-project';
        $isUserHavePermission = $role->permissions()->where('name', $permissionName)->exists();

        return $isUserHavePermission;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $project): bool
    {
        return $this->viewAny($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $role = $this->findRole($user);
        $permissionName = 'create-project';
        $isUserHavePermission = $role->permissions()->where('name', $permissionName)->exists();

        return $isUserHavePermission;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Project $project): bool
    {
        $role = $this->findRole($user);
        $permissionName = 'update-project';
        $isUserHavePermission = $role->permissions()->where('name', $permissionName)->exists();

        return $isUserHavePermission;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Project $project): bool
    {
        $role = $this->findRole($user);
        $permissionName = 'delete-project';
        $isUserHavePermission = $role->permissions()->where('name', $permissionName)->exists();

        return $isUserHavePermission;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Project $project): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Project $project): bool
    {
        return false;
    }

    public function assignProject(?User $user): bool
    {
        return false;
    }
}
