<?php

namespace App\Exceptions;

use Exception;

class UserException extends Exception
{
    public static function create()
    {
        return new self("Create User cannot be processed");
    }
}
