<?php

namespace App\Exceptions;

use Exception;

class CompanyException extends Exception
{
    public static function create()
    {
        return new self("Create company cannot be processed");
    }
    public static function update()
    {
        return new self("Update company cannot be processed");
    }
    public static function delete()
    {
        return new self("Delete company cannot be processed");
    }
    public static function notFound()
    {
        return new self("Company not found");
    }
}
