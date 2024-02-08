<?php

namespace App\Exceptions;

use Exception;

class OrderException extends Exception
{
    public static function create()
    {
        return new self("Create order cannot be processed");
    }
    public static function update()
    {
        return new self("Update order cannot be processed");
    }
    public static function delete()
    {
        return new self("Delete order cannot be processed");
    }
    public static function notFound()
    {
        return new self("Order not found");
    }
}
