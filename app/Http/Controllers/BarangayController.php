<?php

namespace App\Http\Controllers;

use App\Exceptions\BarangayException;
use App\Http\Resources\BarangayResource;
use App\Models\Barangay;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BarangayController extends Controller
{
    public function findOrFail(int $id)
    {
        try {
            return Barangay::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException) {
            throw BarangayException::notFound();
        }
    }
    public function index()
    {
        $barangay = Barangay::get();
        return BarangayResource::collection($barangay);
    }
    public function create(Request $request)
    {
        $payload = $request->only('district', 'city', 'name');
        try {
            $barangay = Barangay::create($payload);
        } catch (QueryException) {
            throw BarangayException::create();
        }
        return new BarangayResource($barangay);
    }
    public function show(int $id)
    {
        $barangay = $this->findOrFail($id);
        return new BarangayResource($barangay);
    }
    public function update(int $id, Request $request)
    {
        $playload = $request->only('district', 'city', 'name');
        $barangay = $this->findOrfail($id);
        try {
            $barangay->update($playload);
        } catch (QueryException) {
            throw BarangayException::update();
        }
        return new BarangayResource($barangay);
    }
    public function delete(int $id)
    {
        $barangay = $this->findOrFail($id);
        try {
            $barangay->delete();
        } catch (QueryException) {
            throw BarangayException::delete();
        }
        return response()->json(['message' => 'Barangay successfully deleted'], 200);
    }
}
