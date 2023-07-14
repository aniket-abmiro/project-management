<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => ['required', 'numeric', function ($attribute, $value, $fail) {
                $project = Project::find($value);
                if (!$project) {
                    $fail('Invalid project_id.');
                }
            }],
            'task_name' => 'required'
        ]);

        $task = new Task();
        $task->project_id = $validated['project_id'];
        $task->task_name = $validated['task_name'];
        $task->save();

        return response()->json($task);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate([
            'project_id' => ['required', 'numeric', function ($attribute, $value, $fail) {
                $project = Project::find($value);
                if (!$project) {
                    $fail('Invalid project_id.');
                }
            }],
            'task_name' => 'required'
        ]);
        $task = Task::findOrFail($id);
        $task->project_id = $validated['project_id'];
        $task->task_name = $validated['task_name'];
        $task->save();
        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json($task);
    }
}
