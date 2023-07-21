<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;

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
        return $user->roles()->find(2);
    }

    public function before(?User $user): bool|null
    {
        $role_name = $this->findRole($user)->name;
        if ($role_name == 'Lead') {
            return true;
        }
        return null;
    }
    public function hasProjectAccess(User $user, $projectId = null)
    {

        if ($this->before($user)) return true;

        if ($projectId == null) return false;
        $isUserHaveAccessToProject = $user->projects()->where('projects.id', $projectId)->exists();
        // dd($isUserHaveAccessToProject);
        return $isUserHaveAccessToProject;
    }
    public function hasTaskAccess(User $user, $taskId = null)
    {
        if ($this->before($user)) return true;
        $task = Task::findOrFail($taskId);
        $projectId = $task->id;

        if (!$this->hasProjectAccess($user, $projectId)) return false;
        $role_name = $this->findRole($user)->name;
        if ($role_name == 'Senior') {
            return true;
        }

        $isUserHaveAccessToTask = $user->tasks()->where('tasks.id', $taskId)->exists();
        return $isUserHaveAccessToTask;
    }
}
