<?php

namespace App\Http\Controllers;

use App\Exceptions\CompanyException;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function findOrFail(int $id)
    {
        try {
            return Company::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException) {
            throw CompanyException::notFound();
        }
    }
    public function index()
    {
        $company = Company::get();
        return CompanyResource::collection($company);
    }
    public function create(Request $request)
    {
        $payload = $request->only('companyname', 'address', 'type', 'number');
        try {
            $company = Company::create($payload);
        } catch (QueryException) {
            throw CompanyException::create();
        }
        return new CompanyResource($company);
    }
    public function show(int $id)
    {
        $company = $this->findOrFail($id);
        return new CompanyResource($company);
    }
    public function update(int $id, Request $request)
    {
        $playload = $request->only('companyname', 'address', 'type', 'number');
        $company = $this->findOrfail($id);
        try {
            $company->update($playload);
        } catch (QueryException) {
            throw CompanyException::update();
        }
        return new CompanyResource($company);
    }
    public function delete(int $id)
    {
        $company = $this->findOrFail($id);
        try {
            $company->delete();
        } catch (QueryException) {
            throw CompanyException::delete();
        }
        return response()->json(['message' => 'Company successfully deleted'], 200);
    }
}
