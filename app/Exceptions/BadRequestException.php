<?php

namespace App\Exceptions;

use Exception;

class BadRequestException extends Exception
{
    private $errors;

    public function __construct($message, $errors = [], $code = 400)
    {
        parent::__construct($message, $code);
        $this->errors = $errors;
    }

    public function errors()
    {
        return $this->errors;
    }
}
