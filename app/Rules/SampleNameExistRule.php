<?php

namespace App\Rules;

use App\Models\Employee;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class SampleNameExistRule implements ValidationRule
{
    private $employeeId;
    public function __construct($employeeId = null)
    {
        $this->employeeId = $employeeId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $name = strtolower(str_replace("", "", $value));

        $employees = Employee::select(DB::raw('LOWER(REPLACE(name, " ", "")) as lower'));
        if (isset($this->employeeId)) {
            $employees->whereNot('id', $this->employeeId);
        }
        $employees = $employees->pluck('lower')->toArray();

        if (in_array($name, $employees)) {
            $fail('The :attribute already exists');
        }
    }
}
