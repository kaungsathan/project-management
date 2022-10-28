<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index() {
        $employees = Employee::all();

        return response()->json($employees);
    }

    // create employee
    public function create(Request $request) {
        // logger($request->all());

        Employee::create($request->all());
        return response()->json([
            'emp' => 'created'
        ]);
    }

    // update employee
    public function update(Request $request,$id) {
        $employees = Employee::find($id);
        $employees->update($request->all());

        return response()->json([
            'status' => 'employee updated'
        ]);
    }

    // delete employee
    public function deleteEmp($id) {

        $employee = Employee::find($id);
        $employee->delete();

        return response()->json('Employee deleted!');
    }
}
