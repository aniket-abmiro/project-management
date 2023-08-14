<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProjectsTasksSubtasksController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user)
    {
        $projects_tasks_subtasks = User::with('projects', 'projects.tasks', 'projects.tasks.subtasks')->findOrFail($user->id);

        return response()->json($projects_tasks_subtasks);
    }
}
