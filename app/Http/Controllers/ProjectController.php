<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Traits\Access;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use Access;

    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->authorizeResource(Project::class);
    }

    public function index()
    {
        //check user authorized
        if (! $this->isUserHaveAccessToProject(null)) {
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
        $validated = $request->validate(['project_name' => 'required|max:250|min:1']);
        $project = new Project();
        $project->project_name = $validated['project_name'];
        $project->save();

        return response()->json($project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //check authorized or not
        if (! $this->isUserHaveAccessToProject($project->id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

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
    public function update(Request $request, Project $project)
    {
        //check authorized or not
        if (! $this->isUserHaveAccessToProject($project->id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate(['project_name' => 'required|max:250|min:1']);
        $project = project::findOrFail($project->id);
        $project->project_name = $validated['project_name'];
        $project->save();

        return response()->json($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //check authorized or not
        if (! $this->isUserHaveAccessToProject($project->id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $project = Project::findOrFail($project->id);
        $project->delete();

        return response()->json($project);
    }

    public function hello()
    {
        return 'hello';
    }
}
