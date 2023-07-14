<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubTask;
use App\Models\Task;

class SubTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $subtasks = SubTask::all();
        return response()->json($subtasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_id' => ['required', 'numeric', function ($attribute, $value, $fail) {
                $task = Task::find($value);
                if (!$task) {
                    $fail('Invalid task_id.');
                }
            }],
            'subtask_name' => 'required'
        ]);

        $subtask = new SubTask();
        $subtask->task_id = $validated['task_id'];
        $subtask->subtask_name = $validated['subtask_name'];
        $subtask->save();
        return response()->json($subtask);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $subtask = SubTask::findOrFail($id);
        return response()->json($subtask);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate([
            'task_id' => ['required', 'numeric', function ($attribute, $value, $fail) {
                $task = Task::find($value);
                if (!$task) {
                    $fail('Invalid task_id.');
                }
            }],
            'subtask_name' => 'required'
        ]);

        $subtask = SubTask::findOrFail($id);
        $subtask->task_id = $validated['task_id'];
        $subtask->subtask_name = $validated['subtask_name'];
        $subtask->save();
        return response()->json($subtask);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $subtask  = SubTask::findOrFail($id);
        $subtask->delete();
        return response()->json($subtask);
    }
}
