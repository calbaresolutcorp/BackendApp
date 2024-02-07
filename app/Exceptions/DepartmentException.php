<?php

namespace App\Exceptions;

use Exception;

class DepartmentException extends Exception
{
    public  static function create(){
        return new self("Create department cannot be processed");
    }
    public  static function update(){
        return new self("Update department cannot be processed");
    }
    public  static function delete(){
        return new self("Delete department cannot be processed");
    }
    public static function notFound(){
        return new self("Department not found");
    }
}
