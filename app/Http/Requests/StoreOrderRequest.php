<?php

namespace App\Http\Requests;

use App\Rules\OrderQuantityinsufficientRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'max:100', 'numeric'],
            'quantity' => $this->quantityRules()
        ];
    }
    public function quantityRules()
    {
        $rules = [
            'required',
            'numeric'
        ];
        if (request()->method == 'PUT') {
            array_push($rules, new OrderQuantityinsufficientRule(request()->id));
        } else {
            array_push($rules, new OrderQuantityinsufficientRule(request()->product_id));
        }
        return $rules;
    }
}
