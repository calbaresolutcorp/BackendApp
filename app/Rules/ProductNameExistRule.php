<?php

namespace App\Rules;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class ProductNameExistRule implements ValidationRule
{
    private $productId;
    public function __construct($productId = null)
    {
        $this->productId = $productId;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $name = strtolower(str_replace("", "", $value));

        $product_name = Product::select(DB::raw('LOWER(REPLACE(name, " ", "")) as lower'));
        if (isset($this->productId)) {
            $product_name->whereNot('id', $this->productId);
        }
        $product_name = $product_name->pluck('lower')->toArray();

        if (in_array($name, $product_name)) {
            $fail('The :attribute already exists');
        }
    }
}
