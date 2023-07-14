<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserProjectsTasksController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user)
    {
        $projects_tasks = User::with('projects', 'projects.tasks')->findOrFail($user->id);
        return response()->json($projects_tasks);
    }
}
