<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// employee
// get employee
Route::get('/employees',[EmployeeController::class,'index']);
// create employee
Route::post('/employees/create',[EmployeeController::class,'create']);
// update employee
Route::put('/employees/update/{id}',[EmployeeController::class,'update']);
// delete employee
Route::delete('/employees/delete/{id}',[EmployeeController::class,'deleteEmp']);

// project
// get project
Route::get('/project',[ProjectController::class,'index']);
// create project
Route::post('/project/create',[ProjectController::class,'createProject']);
// update project
Route::post('/project/update/{id}',[ProjectController::class,'updateProject']);
// delete project
Route::get('/project/delete/{id}',[ProjectController::class,'deleteProject']);

// get project by id
Route::get('/project/{id}',[ProjectController::class,'getProject']);
// get task by project id
Route::get('/task/{id}',[TaskController::class,'getTask']);
// create task
Route::post('/task/create',[TaskController::class,'createTask']);
// status update task
Route::post('/task/status/{id}',[TaskController::class,'updateStatus']);
// delete task
Route::get('/task/delete/{id}',[TaskController::class,'deleteTask']);
