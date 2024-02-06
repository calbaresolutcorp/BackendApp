<?php

namespace App\Exceptions;

use Exception;

class ProductException extends Exception
{
    public  static function create(){
        return new self("Create product cannot be processed");
    }
    public  static function update(){
        return new self("Update product cannot be processed");
    }
    public  static function delete(){
        return new self("delete product cannot be processed");
    }
    public static function notFound(){
        return new self("Product not found");
    }
}