<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::where('is_public', true)->with('type', 'technologies')->orderBy('updated_at', 'DESC')->paginate(5);

        // Assemble url image in backend
        foreach ($projects as $project) {
            if ($project->image) $project->image = url('storage/' . $project->image);
            else $project->image = 'https://marcolanci.it/utils/placeholder.jpg';
        }
        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();
        if (!$project) return response(null, 404);

        // Assemble url image in backend
        if ($project->image) $project->image = url('storage/' . $project->image);
        else $project->image = 'https://marcolanci.it/utils/placeholder.jpg';
        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function typeProjectsIndex(string $id)
    {
        $type = Type::find($id);
        if (!$type) return response(null, 404);

        $projects = $type->projects;

        // Assemble url image in backend
        foreach ($projects as $project) {
            if ($project->image) $project->image = url('storage/' . $project->image);
            else $project->image = 'https://marcolanci.it/utils/placeholder.jpg';
        }
        return response()->json(compact('projects', 'type'));
    }
}
