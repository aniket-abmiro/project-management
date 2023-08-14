<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class ProjectPolicy
{
    /**
     * Create a new policy instance.
     */
    public function assignProject(?User $user): Response
    {
        return Response::deny('You do not have permission');
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

    public function viewProject(?User $user)
    {
        $role = $this->findRole($user);
        $role_id = $role->id;
        $role_name = $role->name;
        $permission_name = 'view-project';
        //$role = Role::findOrFail($role_id);

        // dd($role);
        $isUserHavePermission = $role->permissions()->where('name', $permission_name)->exists();

        return $isUserHavePermission;
    }

    public function createProject(?User $user)
    {
        $role = $this->findRole($user);
        $role_id = $role->id;
        $role_name = $role->name;
        $permission_name = 'create-project';
        //$role = Role::findOrFail($role_id);

        // dd($role);
        $isUserHavePermission = $role->permissions()->where('name', $permission_name)->exists();

        return $isUserHavePermission;
    }

    public function updateProject(?User $user)
    {
        $role = $this->findRole($user);
        $role_id = $role->id;
        $role_name = $role->name;
        $permission_name = 'update-project';
        //$role = Role::findOrFail($role_id);

        $isUserHavePermission = $role->permissions()->where('name', $permission_name)->exists();

        return $isUserHavePermission;
    }

    public function deleteProject(?User $user)
    {
        $role = $this->findRole($user);
        $role_id = $role->id;
        $role_name = $role->name;
        $permission_name = 'delete-project';
        //$role = Role::findOrFail($role_id);

        $isUserHavePermission = $role->permissions()->where('name', $permission_name)->exists();

        return $isUserHavePermission;
    }
}
