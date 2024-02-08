<?php

namespace App\Http\Requests;

use App\Rules\ProductNameExistRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => $this->nameRules(),
            'quantity' => ['required', 'max:100000', 'numeric'],
        ];
    }
    public function nameRules()
    {
        $rules = [
            'required',
            'max:30'
        ];
        if (request()->method == 'PUT') {
            array_push($rules, new ProductNameExistRule(request()->id));
        } else {
            array_push($rules, new ProductNameExistRule());
        }
        return $rules;
    }
}
