<?php

namespace App\Exceptions;

use Exception;

class SampleException extends Exception
{
    public  static function create(){
        return new self("Create employee cannot be processed");
    }

    public  static function update(){
        return new self("Update employee cannot be processed");
    }

    public  static function delete(){
        return new self("delete employee cannot be processed");
    }
    public static function notFound(){
        return new self("Employee not found");
    }
    
}
