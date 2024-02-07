<?php

namespace App\Exceptions;

use Exception;

class BarangayException extends Exception
{
    public  static function create(){
        return new self("Create barangay cannot be processed");
    }
    public  static function update(){
        return new self("Update barangay cannot be processed");
    }
    public  static function delete(){
        return new self("Delete barangay cannot be processed");
    }
    public static function notFound(){
        return new self("Barangay not found");
    }
}
