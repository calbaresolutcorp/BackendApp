<?php

namespace App\Http\Controllers;

use App\Exceptions\DepartmentException;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function findOrFail(int $id)
    {
        try {
            return Department::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException) {
            throw DepartmentException::notFound();
        }
    }
    public function index()
    {
        $department = Department::get();
        return DepartmentResource::collection($department);
    }
    public function create(Request $request)
    {
        $payload = $request->only('departmentname', 'count');
        try {
            $department = Department::create($payload);
        } catch (QueryException) {
            throw DepartmentException::create();
        }
        return new DepartmentResource($department);
    }
    public function show(int $id)
    {
        $department = $this->findOrFail($id);
        return new DepartmentResource($department);
    }
    public function update(int $id, Request $request)
    {
        $playload = $request->only('departmentname', 'count');
        $department = $this->findOrfail($id);
        try {
            $department->update($playload);
        } catch (QueryException) {
            throw DepartmentException::update();
        }
        return new DepartmentResource($department);
    }
    public function delete(int $id)
    {
        $department = $this->findOrFail($id);
        try {
            $department->delete();
        } catch (QueryException) {
            throw DepartmentException::delete();
        }
        return response()->json(['message' => 'Department successfully deleted'], 200);
    }
}
