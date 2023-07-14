<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectTasksSubtasksController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Project $project)
    {
        $projects_tasks_subtasks = Project::with('tasks', 'tasks.subtasks')->findOrFail($project->id);
        return response()->json($projects_tasks_subtasks);
    }
}
