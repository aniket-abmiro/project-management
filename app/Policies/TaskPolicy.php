<?php

namespace App\Policies;

use App\Models\User;


class TaskPolicy
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
        return $user->roles()->find(2);
    }

    public function before(?User $user): bool|null
    {
        $role_name = $this->findRole($user)->name;

        if ($role_name == 'Lead' || $role_name == 'Senior') {
            return true;
        }

        return null;
    }

    public function assignTask(?User $user): bool
    {
        return false;
        // $role = $this->findRole($user);
        // $role_id = $role->id;
        // $role_name = $role->name;
        // $permission_name = 'assign-' . '' . last(request()->segments());
        // //$role = Role::findOrFail($role_id);

        // // dd($role);
        // $isUserHavePermission = $role->permissions()->where('name', $permission_name)->get();

        // if ($isUserHavePermission->count() == 0) {
        //     return Response::deny('You do not have permission');
        // }
        // return true;
    }

    public function  viewTask(?User $user)
    {
        $role = $this->findRole($user);
        $role_id = $role->id;
        $role_name = $role->name;
        $permission_name = 'view-task';
        //$role = Role::findOrFail($role_id);

        // dd($role);
        $isUserHavePermission = $role->permissions()->where('name', $permission_name)->exists();
        return $isUserHavePermission;
    }

    public function createTask(?User $user)
    {
        $role = $this->findRole($user);
        $role_id = $role->id;
        $role_name = $role->name;
        $permission_name = 'create-task';
        //$role = Role::findOrFail($role_id);

        // dd($role);
        $isUserHavePermission = $role->permissions()->where('name', $permission_name)->exists();
        return $isUserHavePermission;
    }
    public function  updateTask(?User $user)
    {
        $role = $this->findRole($user);
        $role_id = $role->id;
        $role_name = $role->name;
        $permission_name = 'update-task';
        //$role = Role::findOrFail($role_id);


        $isUserHavePermission = $role->permissions()->where('name', $permission_name)->exists();
        return $isUserHavePermission;
    }

    public function  deleteTask(?User $user)
    {
        $role = $this->findRole($user);
        $role_id = $role->id;
        $role_name = $role->name;
        $permission_name = 'delete-task';
        //$role = Role::findOrFail($role_id);


        $isUserHavePermission = $role->permissions()->where('name', $permission_name)->exists();
        return $isUserHavePermission;
    }
}
