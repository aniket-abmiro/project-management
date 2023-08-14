<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProjectsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $user)
    {
        $projects = $user->projects;
        // $user = User::with('projects', 'projects.tasks', 'projects.tasks.subtasks')->find($user->id);
        // // dd($user);
        return response()->json($projects);
    }
}
