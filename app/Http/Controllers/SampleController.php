<?php

namespace App\Http\Controllers;

use App\Exceptions\SampleException;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function index()
    {
        $employees = Employee::get();
        // return response()->json($employees, 200);
        return EmployeeResource::collection($employees);
    }
    public function create(Request $request)
    {
        $payload = $request->only('employee_id', 'name', 'position', 'address', 'gender', 'birthday');
        // dd($payload);
        try {
            $employee = Employee::create($payload);
        } catch (QueryException) {
            throw SampleException::create();
        }


        // return response()->json($employee, 201);
        return new EmployeeResource($employee);
    }
    public function show(int $id)
    {

        $employee = $this->findOrFail($id);
        // return response()->json($employee, 200);
        return new EmployeeResource($employee);
    }

    public function update(int $id, Request $request)
    {
        $playload = $request->only('employee_id', 'name', 'position', 'address', 'gender', 'birthday');
        $employee = $this->findOrfail($id);
        try {
            $employee->update($playload);
        } catch (QueryException) {
            throw SampleException::update();
        }
        // return response()->json($employee, 200);
        return new EmployeeResource($employee);
    }

    public function findOrFail(int $id)
    {
        try {
            return Employee::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException) {
            throw SampleException::notFound();
        }
    }

    public function delete(int $id)
    {
        $employee = $this->findOrFail($id);
        try {
            $employee->delete();
        } catch (QueryException) {
            throw SampleException::delete();
        }
        return response()->json(['message' => 'Employee successfully deleted'], 200);
    }
}
