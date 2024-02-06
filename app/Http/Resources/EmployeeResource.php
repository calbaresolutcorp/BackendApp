<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            "id" => $this->id,
            "employee_id" => $this->employee_id,
            "name" => $this->name,
            "position" => $this->position,
            "gender" => $this->gender,
            "birthday" => Carbon::parse($this->birthday)->format("F d, Y")

        ];
    }
}
