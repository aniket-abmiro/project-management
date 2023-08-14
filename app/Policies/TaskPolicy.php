<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function findRole($user)
    {
        return $user->roles()->find(10);
    }

    public function before(?User $user): ?bool
    {
        $roleName = $this->findRole($user)->name;
        if ($roleName == 'Lead' || $roleName == 'Senior') {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $role = $this->findRole($user);
        $permissionName = 'view-task';
        $isUserHavePermission = $role->permissions()->where('name', $permissionName)->exists();

        return $isUserHavePermission;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
        return $this->viewAny($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $role = $this->findRole($user);
        $permissionName = 'create-task';
        $isUserHavePermission = $role->permissions()->where('name', $permissionName)->exists();

        return $isUserHavePermission;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
        $role = $this->findRole($user);
        $permissionName = 'update-task';
        $isUserHavePermission = $role->permissions()->where('name', $permissionName)->exists();

        return $isUserHavePermission;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
        $role = $this->findRole($user);
        $permissionName = 'delete-task';
        $isUserHavePermission = $role->permissions()->where('name', $permissionName)->exists();

        return $isUserHavePermission;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Task $task): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Task $task): bool
    {
        return false;
    }

    public function assignTask(?User $user): bool
    {
        return false;
    }
}
