<?php

namespace App\Http\Controllers;

use Attribute;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectUser;
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
        if (!$response->allowed()) {
            return response()->json($response->message());
        }

        $validated = $request->validate([
            'project_id' => ['required', 'numeric', function ($attribute, $value, $fail) {
                $project = Project::findOrFail($value);
                if (!$project) {
                    $fail("Invalid project_id");
                }
            }],
            'user_id' => ['required', 'numeric', function ($attribute, $value, $fail) {
                $user = User::find($value);
                if (!$user) {
                    $fail('Invalid user_id.');
                }
            }]
        ]);
        $project_user = new ProjectUser();
        $project_user->project_id = $validated['project_id'];
        $project_user->user_id = $validated['user_id'];
        $project_user->save();
        return response()->json($project_user);
    }
}
