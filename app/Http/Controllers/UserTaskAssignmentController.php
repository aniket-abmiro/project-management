<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use App\Traits\Access;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserTaskAssignmentController extends Controller
{
    use Access;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $response = Gate::inspect('assign-task');
        if (! $response->allowed()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if (! $this->isUserHaveAccessToTask($request->input('task_id'))) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'task_id' => ['required', 'numeric', function ($attribute, $value, $fail) {
                $task = Task::find($value);
                if (! $task) {
                    $fail('Invalid task id');
                }
            }],
            'user_id' => ['required', 'numeric', function ($attribute, $value, $fail) {
                $user = User::find($value);
                if (! $user) {
                    $fail('Invalid user id.');
                }
            }],
        ]);
        $task_user = new TaskUser();
        $task_user->task_id = $validated['task_id'];
        $task_user->user_id = $validated['user_id'];
        $task_user->save();

        return response()->json($task_user);
    }
}
