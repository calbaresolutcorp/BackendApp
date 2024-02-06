<?php

namespace App\Http\Controllers;

use App\Exceptions\ProductException;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\ProductResources;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return ProductResources::collection($products);
    }

    public function create(Request $request)
    {
        $payload = $request->only('name', 'quantity');
        try {
            $products = Product::create($payload);
        } catch (QueryException) {
            throw ProductException::create();
        }


        return new ProductResources($products);
    }
    public function show(int $id)
    {
        $products = $this->findOrFail($id);
        
        return new ProductResources($products);
    }

    public function update(int $id, Request $request)
    {
        $playload = $request->only('name', 'quantity');
        $products = $this->findOrfail($id);
        try {
            $products->update($playload);
        } catch (QueryException) {
            throw ProductException::update();
        }
        // return response()->json($employee, 200);
        return new ProductResources($products);
    }

    public function findOrFail(int $id)
    {
        try {
            return Product::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException) {
            throw ProductException::notFound();
        }
    }

    public function delete(int $id)
    {
        $products = $this->findOrFail($id);
        try {
            $products->delete();
        } catch (QueryException) {
            throw ProductException::delete();
        }
        return response()->json(['message' => 'Employee successfully deleted'], 200);
    }
}
