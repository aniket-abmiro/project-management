<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Traits\Access;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use Access;

    public function __construct()
    {
        $this->authorizeResource(Task::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //check user authorized
        $projectTasks = null;
        if (! $this->isUserHaveAccessToProject(null)) {
            $projectTasks = User::with('projects', 'projects.tasks')->findOrFail(Auth()->user()->id);
        } else {
            $projectTasks = Project::with('tasks')->get();
        }

        return response()->json($projectTasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //check user autherized
        if (! $this->isUserHaveAccessToProject($request->input('project_id'))) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'project_id' => ['required', 'numeric', function ($attribute, $value, $fail) {
                $project = Project::find($value);
                if (! $project) {
                    $fail('Invalid project_id');
                }
            }],
            'task_name' => 'required',
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
    public function show(Task $task)
    {
        //check user autherized
        if (! $this->isUserHaveAccessToTask($task->id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //check user autherized
        if (! $this->isUserHaveAccessToTask($task->id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'project_id' => ['required', 'numeric', function ($attribute, $value, $fail) {
                $project = Project::find($value);
                if (! $project) {
                    $fail('Invalid project_id.');
                }
            }],
            'task_name' => 'required',
        ]);

        $task->project_id = $validated['project_id'];
        $task->task_name = $validated['task_name'];
        $task->save();

        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if (! $this->isUserHaveAccessToTask($task->id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        dd($task);
        $task->delete();

        return response()->json($task);
    }
}
