<?php

namespace App\Exceptions;

use Exception;

class StudentException extends Exception
{
    public static function create()
    {
        return new self("Create student cannot be processed");
    }

    public static function update()
    {
        return new self("Update student cannot be processed");
    }

    public static function delete()
    {
        return new self("delete student cannot be processed");
    }
    public static function notFound()
    {
        return new self("Student not found");
    }
}
