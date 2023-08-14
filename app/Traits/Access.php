<?php

namespace App\Traits;

use Illuminate\Support\Facades\Gate;

trait Access
{
    public function isUserHaveAccessToProject($projectId)
    {
        $response = Gate::inspect('check-project-access', [$projectId]);
        if (! $response->allowed()) {
            return false;
        }

        return true;
    }

    public function isUserHaveAccessToTask($taskId)
    {
        $response = Gate::inspect('check-task-access', [$taskId]);
        if (! $response->allowed()) {
            return false;
        }

        return true;
    }
}
