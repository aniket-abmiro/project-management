<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //check user authorized
        $this->isUserHavePermission('view-project');
        $response = Gate::inspect('check-project-access');
        if (!$response->allowed()) {
            $projects = User::findOrFail(Auth()->user()->id)->projects;
        } else {
            $projects = Project::all();
        }


        return response()->json($projects);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //check user autherized
        $this->isUserHavePermission('create-project');


        $validated = $request->validate(['project_name' => 'required|max:250|min:1']);
        $project = new Project();
        $project->project_name = $validated["project_name"];
        $project->save();
        return response()->json($project);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //check authorized or not
        $this->isUserHavePermission('view-project');
        $this->isUserHaveAccessToProject($id);

        $project = Project::findOrFail($id);
        return response()->json($project);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //check authorized or not
        $this->isUserHavePermission('update-project');
        $this->isUserHaveAccessToProject($id);

        $validated = $request->validate(['project_name' => 'required|max:250|min:1']);
        $project = project::findOrFail($id);
        $project->project_name = $validated['project_name'];
        $project->save();

        return response()->json($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //check authorized or not
        $this->isUserHavePermission('delete-project');
        $this->isUserHaveAccessToProject($id);

        $project = Project::findOrFail($id);
        $project->delete();
        // dd($id);
        return response()->json($project);
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
