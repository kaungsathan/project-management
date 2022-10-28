<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // get all project
    public function index() {
        $project = Project::all();
        return response()->json($project);
    }

    //create project
    public function createProject(Request $request) {
        // logger($request->all());

        Project::create($request->all());

        return response()->json('project created');
    }

    // update project
    public function updateProject(Request $request,$id) {
        $project = Project::find($id);
        $project->update($request->all());
        return response()->json('project updated');
    }

    // delete project
    public function deleteProject($id) {
        $project = Project::find($id);
        $project->delete();

        return response()->json('project deleted');
    }

    // get project by id
    public function getProject($id) {
        $project = Project::where('id',$id)->first();
        $worker = Employee::all();

        return response()->json([
            'project' => $project,
            'worker' => $worker
        ]);

    }
}
