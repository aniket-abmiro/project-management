<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Project $project)
    {
        $projects_tasks = Project::with('tasks')->findOrFail($project->id);

        return response()->json($projects_tasks);
    }
}
