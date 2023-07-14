<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskUser;

class UserTaskAssignmentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
        $validated = $request->validate([
            'task_id' => ['required', 'numeric', function ($attribute, $value, $fail) {
                $task = Task::find($value);
                if (!$task) {
                    $fail("Invalid task id");
                }
            }],
            'user_id' => ['required', 'numeric', function ($attribute, $value, $fail) {
                $user = User::find($value);
                if (!$user) {
                    $fail('Invalid user id.');
                }
            }]
        ]);
        $task_user = new TaskUser();
        $task_user->task_id = $validated['task_id'];
        $task_user->user_id = $validated['user_id'];
        $task_user->save();
        return response()->json($task_user);
    }
}
