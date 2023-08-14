<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksSubtasksController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Task $task)
    {
        $task_subtasks = Task::with('subtasks')->findOrFail($task->id);

        return response()->json($task_subtasks);
    }
}
