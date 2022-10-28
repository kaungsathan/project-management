<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // get task by project
    public function getTask($id) {

        $task = Task::select('tasks.*','employees.name as worker_name','employees.email as worker_email')
        ->leftJoin('employees','tasks.worker','employees.id')
        ->where('tasks.project_id',$id)->get();

        return response()->json([
            'task' => $task
        ]);
    }

    //create task
    public function createTask(Request $request) {
        Task::create($request->all());

        return response()->json('task created');
    }

    // update task status
    public function updateStatus(Request $request,$id) {
        Task::where('id',$id)->update([ 'status' => $request->status ]);

        return response()->json('status updated');
    }

    // delete task
    public function deleteTask($id) {
        Task::where('id',$id)->delete();
        return response()->json('task deleted');
    }
}
