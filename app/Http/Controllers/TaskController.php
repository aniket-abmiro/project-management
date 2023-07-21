<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //check user authorized
        $response = Gate::inspect('view-task');
        if (!$response->allowed()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $response = Gate::inspect('check-project-access');
        $project_tasks = null;
        if (!$response->allowed()) {
            $project_tasks = User::with('projects', 'projects.tasks')->findOrFail(Auth()->user()->id);
        } else {
            $project_tasks = Project::with('tasks')->get();
        }

        return response()->json($project_tasks);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //check user autherized
        $response = Gate::inspect('create-task');
        if (!$response->allowed()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $response = Gate::inspect('check-project-access', [$request->input('project_id')]);
        if (!$response->allowed()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'project_id' => ['required', 'numeric', function ($attribute, $value, $fail) {
                $project = Project::find($value);
                if (!$project) {
                    $fail('Invalid project_id');
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

        //check user autherized
        $response = Gate::inspect('view-task');
        if (!$response->allowed()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $response = Gate::inspect('check-task-access', [$id]);
        if (!$response->allowed()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //check user autherized
        $response = Gate::inspect('update-task');
        if (!$response->allowed()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $response = Gate::inspect('check-task-access', [$id]);
        if (!$response->allowed()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

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
        $response = Gate::inspect('delete-task');
        if (!$response->allowed()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $response = Gate::inspect('check-task-access', [$id]);
        if (!$response->allowed()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        dd("deleted");
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json($task);
    }

    public function isUserHavePermission($permission)
    {
        $response = Gate::inspect($permission);
        if (!$response->allowed()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    public function isUserHaveAccessToProject($projectId)
    {
        $response = Gate::inspect('check-project-access', [$projectId]);

        if (!$response->allowed()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}
