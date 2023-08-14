<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserProjectAssignmentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //autherization
        $response = Gate::inspect('assign-project');
        if (! $response->allowed()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'project_id' => ['required', 'numeric', function ($attribute, $value, $fail) {
                $project = Project::findOrFail($value);
                if (! $project) {
                    $fail('Invalid project_id');
                }
            }],
            'user_id' => ['required', 'numeric', function ($attribute, $value, $fail) {
                $user = User::find($value);
                if (! $user) {
                    $fail('Invalid user_id.');
                }
            }],
        ]);
        $projectUser = new ProjectUser();
        $projectUser->project_id = $validated['project_id'];
        $projectUser->user_id = $validated['user_id'];
        $projectUser->save();

        return response()->json($projectUser);
    }
}
