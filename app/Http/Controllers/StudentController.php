<?php

namespace App\Http\Controllers;

use App\Exceptions\StudentException;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function findOrFail(int $id)
    {
        try {
            return Student::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException) {
            throw StudentException::notFound();
        }
    }
    public function index()
    {
        $student = Student::get();
        return StudentResource::collection($student);
    }
    public function create(Request $request)
    {
        $payload = $request->only('student_id', 'studentname', 'address', 'department', 'number', 'age', 'gender');
        try {
            $student = Student::create($payload);
        } catch (QueryException) {
            throw StudentException::create();
        }
        return new StudentResource($student);
    }
    public function show(int $id)
    {
        $student = $this->findOrFail($id);
        return new StudentResource($student);
    }
    public function update(int $id, Request $request)
    {
        $playload = $request->only('student_id', 'studentname', 'address', 'department', 'number', 'age', 'gender');
        $student = $this->findOrfail($id);
        try {
            $student->update($playload);
        } catch (QueryException) {
            throw StudentException::update();
        }
        return new StudentResource($student);
    }
    public function delete(int $id)
    {
        $student = $this->findOrFail($id);
        try {
            $student->delete();
        } catch (QueryException) {
            throw StudentException::delete();
        }
        return response()->json(['message' => 'Student successfully deleted'], 200);
    }
}
