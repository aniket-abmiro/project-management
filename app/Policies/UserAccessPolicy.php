<?php

namespace App\Policies;

use App\Models\Task;
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
        return $user->roles()->find(10);
    }

    public function before(?User $user): ?bool
    {
        $role_name = $this->findRole($user)->name;
        if ($role_name == 'Lead') {
            return true;
        }

        return false;
    }

    public function hasProjectAccess(User $user, $projectId = null)
    {
        if ($this->before($user)) {
            return true;
        }
        if ($projectId == null) {
            return false;
        }
        $isUserHaveAccessToProject = $user->projects()->where('projects.id', $projectId)->exists();

        return $isUserHaveAccessToProject;
    }

    public function hasTaskAccess(User $user, $taskId = null)
    {
        if ($this->before($user)) {
            return true;
        }
        $task = Task::findOrFail($taskId);
        $projectId = $task->project_id;

        if (! $this->hasProjectAccess($user, $projectId)) {
            return false;
        }
        $roleName = $this->findRole($user)->name;
        if ($roleName == 'Senior') {
            return true;
        }

        $isUserHaveAccessToTask = $user->tasks()->where('tasks.id', $taskId)->exists();

        return $isUserHaveAccessToTask;
    }
}
