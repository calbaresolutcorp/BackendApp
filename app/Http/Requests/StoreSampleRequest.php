<?php

namespace App\Http\Requests;

use App\Rules\SampleNameExistRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSampleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'employee_id' => ['required', 'max:255','numeric'],
            // 'name' => ['required', new SampleNameExistRule()],
            'name' => $this->nameRules(),
            'position' => ['required'],
            'address' => ['required'],
            'gender' => ['required' ,'in:M,F'],
            'birthday' => ['required' , 'date' , 'date_format:Y-m-d']
        ];
    }
    public function nameRules()
    {
        $rules = [
            'required',
            'max:255'
        ];
        if (request()->method == 'PUT') {
            array_push($rules, new SampleNameExistRule(request()->id));
        } else {
            array_push($rules, new SampleNameExistRule());
        }
        return $rules;
    }
}
