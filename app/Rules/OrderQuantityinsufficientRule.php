<?php

namespace App\Rules;

use App\Models\Order;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class OrderQuantityinsufficientRule implements ValidationRule
{
    private $orderId;
    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // $orders = Order::where("product_id", $this->orderId)->sum("quantity");
        $product = Product::where("id", $this->orderId)->first();
        $total = $product->quantity - $value;

        if ($total <= 0) {
            $fail('Insufficient :attribute');
        }
    }
}
