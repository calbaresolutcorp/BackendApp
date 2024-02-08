<?php

namespace App\Http\Controllers;

use App\Exceptions\OrderException;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function findOrFail(int $id)
    {
        try {
            return Order::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException) {
            throw OrderException::notFound();
        }
    }
    public function index()
    {
        $order = Order::get();
        return OrderResource::collection($order);
    }
    public function create(StoreOrderRequest $request)
    {
        // $payload = $request->only('product_id', 'quantity');
        $payload = $request->validated();
        try {
            $order = Order::create($payload);
        } catch (QueryException) {
            throw OrderException::create();
        }
        return new OrderResource($order);
    }
    public function show(int $id)
    {
        $order = $this->findOrFail($id);
        return new OrderResource($order);
    }
    public function update(int $id, StoreOrderRequest $request)
    {
        $payload = $request->validated();
        $order = $this->findOrfail($id);
        try {
            $order->update($payload);
        } catch (QueryException) {
            throw OrderException::update();
        }
        return new OrderResource($order);
    }
    public function delete(int $id)
    {
        $order = $this->findOrFail($id);
        try {
            $order->delete();
        } catch (QueryException) {
            throw OrderException::delete();
        }
        return response()->json(['message' => 'Order successfully deleted'], 200);
    }
}
