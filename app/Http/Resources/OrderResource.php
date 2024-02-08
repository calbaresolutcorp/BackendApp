<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "product_id" => $this->product->name,
            "quantity" => $this->quantity,
            "created_at" => Carbon::parse($this->created_at)->format("F d, Y h:i A")
        ];
    }
}
