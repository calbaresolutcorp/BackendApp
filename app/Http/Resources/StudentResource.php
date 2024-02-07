<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "student_id" => $this->student_id,
            "studentname" => $this->studentname,
            "address"=> $this->address,
            "department"=> $this->department,
            "number"=> $this->number,
            "age"=> $this->age,
            "gender"=> $this->gender,
        ];
    }
}
