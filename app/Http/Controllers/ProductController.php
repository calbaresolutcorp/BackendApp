<?php

namespace App\Http\Controllers;

use App\Exceptions\ProductException;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResources;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::get();
        return ProductResources::collection($product);
    }
    public function create(StoreProductRequest $request)
    {
        // $payload = $request->only('name', 'quantity');
        $payload = $request->validated();
        try {
            $product = Product::create($payload);
        } catch (QueryException) {
            throw ProductException::create();
        }
        return new ProductResources($product);
    }
    public function show(int $id)
    {
        $product = $this->findOrFail($id);
        return new ProductResources($product);
    }
    public function update(int $id, StoreProductRequest $request)
    {
        // $playload = $request->only('name', 'quantity');
        $payload = $request->validated();
        $product = $this->findOrfail($id);
        try {
            $product->update($payload);
        } catch (QueryException) {
            throw ProductException::update();
        }
        return new ProductResources($product);
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
        $product = $this->findOrFail($id);
        try {
            $product->delete();
        } catch (QueryException) {
            throw ProductException::delete();
        }
        return response()->json(['message' => 'Product successfully deleted'], 200);
    }
}
